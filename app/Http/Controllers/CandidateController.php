<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\JobRole;
use App\Models\Language;
use App\Models\Profession;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;


class CandidateController extends Controller
{


    public function candidates(Request $request)
    {
        $search = $request->search;

        $candidates = User::whereHas('roles', function ($query) {
            $query->where('name', 'candidate');
        })->with('jobRole', 'experience');

        if (!empty($search)) {
            $searchDate = date('Y-m-d', strtotime($search));

            $candidates->where(function ($query) use ($search, $searchDate) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhereRaw("STR_TO_DATE(created_at, '%Y-%m-%d') = ?", [$searchDate]);
            });
        }

        $candidates = $candidates->paginate(10);
        return view('superadmin.candidate.index', compact('candidates'));
    }



    public function create()
    {

        $data['professions'] = Profession::where('status', 'active')->pluck('profession', 'id')->toArray();
        $data['experiences'] = Experience::where('status', 'active')->pluck('experiences', 'id')->toArray();
        $data['job_roles'] = JobRole::where('status', 'active')->pluck('job_role', 'id')->toArray();
        $data['educations'] = Education::where('status', 'active')->pluck('education', 'id')->toArray();
        $data['language'] = Language::where('status', 'active')->get();
        $data['skills'] = Skill::where('status', 'active')->get();

        return view('superadmin.candidate.add', compact('data'));
    }



    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'mobile_number' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required',],
            'profession_id' => ['required',],
            'experience_level' => ['required',],
            'job_role' => ['required',],
            'education_level' => ['required',],
            'gender' => ['required',],
            'marital_status' => ['nullable',],
            'dob' => ['required',],
            'personal_website' => ['nullable',],
            'language_id' => ['required',],
            'skill' => ['required',],
            'biography' => ['nullable',],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'resume' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,pdf,doc', 'max:2048'],

        ]);

        DB::beginTransaction();
        try {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'profession_id' => $request->profession_id,
                'experience_level' => $request->experience_level,
                'job_role' => $request->job_role,
                'education_level' => $request->education_level,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'dob' => $request->dob,
                'personal_website' => $request->personal_website ?? null,
                'language_id' => json_encode($request->language_id) ?? null,
                'skill' => json_encode($request->skill) ?? null,
                'biography' => $request->biography ?? null,
            ];


            // Profile Image
            if ($request->hasFile('profile_image')) {
                $profile_image = $request->file('profile_image');
                $filename = uniqid() . '.' . $profile_image->getClientOriginalExtension();
                $profile_image->move(public_path('backend/profile_images/'), $filename);
                $data['profile_image'] = 'backend/profile_images/' . $filename;
            }

            // CV
            if ($request->hasFile('resume')) {
                $resume = $request->file('resume');
                $filename = uniqid() . '.' . $resume->getClientOriginalExtension();
                $resume->move(public_path('backend/resume/'), $filename);
                $data['resume'] = 'backend/resume/' . $filename;
            }

            $candidate =  User::create($data);

            // Assign the "Candidate" role
            $candidate->assignRole('candidate');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.candidates')->with('status', 'Candidate created Successfully done!');
    }



    public function view($candidate_id)
    {
        $candidate = User::with('professions', 'experience', 'jobRole', 'educations', 'language', 'skill')->where('id', $candidate_id)->first();
        return view('superadmin.candidate.view', compact('candidate'));
    }



    public function edit(User $candidate)
    {
        $data['professions'] = Profession::where('status', 'active')->pluck('profession', 'id')->toArray();
        $data['experiences'] = Experience::where('status', 'active')->pluck('experiences', 'id')->toArray();
        $data['job_roles'] = JobRole::where('status', 'active')->pluck('job_role', 'id')->toArray();
        $data['educations'] = Education::where('status', 'active')->pluck('education', 'id')->toArray();
        $data['language'] = Language::where('status', 'active')->get();
        $data['skills'] = Skill::where('status', 'active')->get();

        return view('superadmin.candidate.edit', compact('candidate', 'data'));
    }


    public function update(Request $request, $candidate)
    {

        $validated = $request->validate([
            'name' => ['required', 'string',],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($candidate)],
            'mobile_number' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($candidate)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'resume' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,pdf,doc', 'max:2048'],
        ]);

        DB::beginTransaction();
        try {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'profession_id' => $request->profession_id,
                'experience_level' => $request->experience_level,
                'job_role' => $request->job_role,
                'education_level' => $request->education_level,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'dob' => $request->dob,
                'personal_website' => $request->personal_website ?? null,
                'language_id' => json_encode($request->language_id) ?? null,
                'skill' => json_encode($request->skill) ?? null,
                'biography' => $request->biography ?? null,
            ];


            // Profile Image
            if ($request->hasFile('profile_image')) {
                // Delete the old image if it exists
                if ($candidate->profile_image && is_file(public_path($candidate->profile_image))) {
                    unlink(public_path($candidate->profile_image));
                }

                // Upload new profile_image
                $profile_image = $request->file('profile_image');
                $filename = uniqid() . '.' . $profile_image->getClientOriginalExtension();
                $profile_image->move(public_path('backend/profile_image/'), $filename);
                $data['profile_image'] = 'backend/profile_image/' . $filename;
            }

            // CV
            if ($request->hasFile('resume')) {
                // Delete the old image if it exists
                if ($candidate->resume && is_file(public_path($candidate->resume))) {
                    unlink(public_path($candidate->resume));
                }

                // Upload new resume
                $resume = $request->file('resume');
                $filename = uniqid() . '.' . $resume->getClientOriginalExtension();
                $resume->move(public_path('backend/resume/'), $filename);
                $data['resume'] = 'backend/resume/' . $filename;
            }


            $candidate = User::find($request->id);

            $candidate->update($data);

            // Assign the "Candidate" role
            $candidate->assignRole('candidate');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.candidates')->with('status', 'Candidate Updated Successfully done!');
    }


    // Delete Candidate
    public function delete(User $candidate)
    {
        DB::beginTransaction();
        try {
            $candidate->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.candidates')->with('status', 'Candidate Profile Deleted Successfully!');
    }


    // Candidate status change
    public function candidateAccountStatusUpdate($candidate)
    {
        $candidateAccountStatus = User::find($candidate);
        $candidateAccountStatus->account_status = $candidateAccountStatus->account_status == 'activated' ? 'deactivated' : 'activated';
        $candidateAccountStatus->update();

        return redirect()->back()->with('status', 'Candidate status has been updated.');
    }
}
