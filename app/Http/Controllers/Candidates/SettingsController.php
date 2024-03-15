<?php

namespace App\Http\Controllers\Candidates;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Profession;
use App\Models\Experience;
use App\Models\IndustryType;
use App\Models\JobRole;
use App\Models\Language;
use App\Models\OrganizationType;
use App\Models\Skill;
use App\Models\TeamSize;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{

    public function candidateProfilePreview(){
        $candidate = User::where('id', auth()->user()->id)
        ->with('educations', 'experience', 'professions','language','skill','jobRole')
        ->first();

        return view('candidate.settings.profile_preview',compact('candidate'));
    }


    // Candidate Setting

    public function settings()
    {
        $candidate = Auth::user();

        $data['experienceLevel']  = Experience::where('status', 'active')->pluck('experiences', 'id')->toArray();

        $data['educationLevel'] = Education::where('status', 'active')->pluck('education', 'id')->toArray();
        $data['job_roles'] = JobRole::where('status', 'active')->pluck('job_role', 'id')->toArray();

        $data['professions'] = Profession::where('status', 'active')->pluck('profession', 'id')->toArray();
        $data['language'] = Language::where('status', 'active')->get();
        $data['skills'] = Skill::where('status', 'active')->get();

        return view('candidate.settings.settings',compact('candidate','data') );
    }


    public function candidateBasicDetails(Request $request){

        $validated = $request->validate([
            'name' => ['required', 'string',],
            'professional_title' => ['nullable', 'string',],
            'job_role' => ['required',],
            // 'experience_level' => ['required',],
            // 'education_level' => ['required',],
            'dob' => ['required',],
            'personal_website' => ['nullable',],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'resume' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,pdf,doc', 'max:2048'],

        ]);
        DB::beginTransaction();

        try{
        $data = [
            'name' => $request->name,
            'professional_title' => $request->professional_title ?? null,
            'experience_level' => $request->experience_level ?? null,
            'job_role' => $request->job_role ?? null,
            'education_level' => $request->education_level ?? null,
            'dob' => $request->dob ?? null,
            'personal_website' => $request->personal_website ?? null,

        ];

        $candidate = User::find($request->id);
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


        $candidate = User::where(['id' =>$request->id,'email' =>$request->email])->first();;

        $candidate->update($data);

    }
        catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Candidate Basic Details Updated Successfully done!');
    }


    public function candidateProfileDetails(Request $request){

        $validated = $request->validate([
            // 'gender' => ['required',],
            // 'marital_status' => ['nullable',],
            // 'profession_id' => ['required',],
            // 'experience_level' => ['required',],
            // 'job_role' => ['required',],
            // 'education_level' => ['required',],
            // 'language_id' => ['required',],
            // 'skill' => ['required',],
            // 'biography' => ['nullable'],
            // 'your_availability' => ['nullable',],


        ]);
        DB::beginTransaction();

        try{

            $data =[
                'gender' => $request->gender?? null,
                'marital_status' => $request->marital_status?? null,
                'profession_id' =>$request->profession_id ?? null,
                'skill' =>$request->skill ? json_encode($request->skill) : null,
                'language_id' =>$request->language_id ? json_encode($request->language_id) : null,
                'experience_level' => $request->experience_level?? null,
                'job_role' => $request->job_role?? null,
                'education_level' => $request->education_level?? null,
                'biography' => $request->biography?? null,
                'your_availability' => $request->your_availability?? null,
            ];

            $candidateProfileDetails =  User::where(['id' =>$request->id,'email' =>$request->email])->first();

            $candidateProfileDetails->update($data);

        }catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Candidate profile Details Updated Successfully done!');
    }



    public function candidateSocialMeadiaDetails(Request $request)
    {

        $validated = $request->validate([
            // 'linkedin' => ['required'],
            // 'skype' => ['nullable'],
            // 'facebook' => ['nullable'],
            // 'instagram' => ['nullable'],
            // 'youTube' => ['nullable'],
            // 'twitter' => ['nullable'],
            // 'other_social_media' => ['nullable'],

        ]);

        DB::beginTransaction();
        try {

            $candidateSocialMeadiaDetails =  User::where(['id' =>$request->id,'email' =>$request->email])->first();

            $data = [
                'linkedin' => $request->linkedin ?? null,
                'skype' => $request->skype ?? null,
                'facebook' => $request->facebook ?? null,
                'instagram' => $request->instagram ?? null,
                'youTube' => $request->youTube ?? null,
                'twitter' => $request->twitter ?? null,
                'other_social_media' => $request->other_social_media ?? null,
            ];


            $candidateSocialMeadiaDetails->update($data);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Social Media Profile updated Successfully done!');
    }


        // Account Setting
        public function candidateAccountsetting(Request $request)
        {

            $validated = $request->validate([
                'name' => ['required'],
                'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
                'mobile_number' => ['required', Rule::unique(User::class)->ignore($request->user()->id)],
                'secondary_phone' => [Rule::unique(User::class)->ignore($request->user()->id)],
                'address' => ['required'],

            ]);

            DB::beginTransaction();
            try {

                $accountsetting =  User::where(['id' =>$request->id,'email' =>$request->email])->first();

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'secondary_phone' => $request->secondary_phone,
                    'address' => $request->address,
                ];

                $accountsetting->update($data);

            } catch (Exception $e) {
                DB::rollBack();
                return Redirect::back()->with('status', $e->getMessage());
            }
            DB::commit();
            return Redirect::back()->with('status', 'Account Setting updated Successfully done!');
        }


     //    Change Password
        public function updatePassword(Request $request)
        {

            $validated = $request->validate([
                // 'current_password' => ['required', 'current_password','sometimes'],
                'password' => ['required', Password::defaults(), 'confirmed', 'sometimes'],
            ]);

            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            $request->user()->save();

            return Redirect::back()->with('status', 'Password updated Successfully changed!');
        }



}
