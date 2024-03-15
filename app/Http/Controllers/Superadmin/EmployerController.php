<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\IndustryType;
use App\Models\OrganizationType;
use App\Models\TeamSize;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;



class EmployerController extends Controller
{


    public function employers(Request $request)
    {
        $search = $request->search;
        $organizationType = OrganizationType::where('status', 'active')->pluck('organization_type', 'id')->toArray();

        $industryType = IndustryType::where('status', 'active')->pluck('industry_type', 'id')->toArray();

        $teamSize = TeamSize::where('status', 'active')->pluck('team_size', 'id')->toArray();

        $employers = User::role('employer')->with('industryType', 'organizationType', 'teamSize');


        if (!empty($request->organization_type)) {
            $employers->where('organization_type', $request->organization_type);
        }


        if (!empty($request->industry_type)) {
            $employers->where('industry_type', $request->industry_type);
        }


        if (!empty($request->team_size)) {
            $employers->where('team_size', $request->team_size);
        }


        if (!empty($request->account_status)) {
            $employers->where('account_status', $request->account_status);
        }


        if (!empty($request->verification_status)) {
            $employers->where('status', $request->account_status);
        }


        if (!empty($search)) {
            $searchDate = date('Y-m-d', strtotime($search));

            $employers->where(function ($query) use ($search, $searchDate) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('company_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhereRaw("STR_TO_DATE(year_of_establishment, '%Y-%m-%d') = ?", [$searchDate]);
            });
        }

        $employers = $employers->paginate(10);
        return view('superadmin.company.index', compact('employers', 'organizationType', 'industryType', 'teamSize'));
    }




    public function create()
    {

        $organizationType = OrganizationType::where('status', 'active')->pluck('organization_type', 'id')->toArray();

        $industryType = IndustryType::where('status', 'active')->pluck('industry_type', 'id')->toArray();

        $teamSize = TeamSize::where('status', 'active')->pluck('team_size', 'id')->toArray();

        return view('superadmin.company.add', compact('organizationType', 'industryType', 'teamSize'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'employer_type' => ['nullable'],
            'company_name' => ['nullable'],
            'name' => ['required'],
            'email' => ['required', 'max:255'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile_number' => ['required'],
            'secondary_phone' => ['nullable'],
            'address' => ['nullable'],

            'about_us' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

            'organization_type' => ['required', 'string',],
            'industry_type' => ['required', 'string',],
            'team_size' => ['required', 'string',],
            'year_of_establishment' => ['required'],
            'website_url' => ['required', 'string',],
            'company_vision' => ['nullable', 'string'],

            'linkedin' => ['required'],
            'skype' => ['nullable'],
            'facebook' => ['nullable'],
            'instagram' => ['nullable'],
            'youTube' => ['nullable'],
            'twitter' => ['nullable'],
            'other_social_media' => ['nullable'],
            'account_status' => ['required'],
            'status' => ['required'],
            'status_reason' => ['nullable'],

        ]);


        DB::beginTransaction();

        try {

            $data = [
                'employer_type' => $request->employer_type,
                'company_name' => $request->company_name ?? null,
                'name' => $request->name,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'mobile_number' => $request->mobile_number,
                'secondary_phone' => $request->secondary_phone ?? null,
                'address' => $request->address ?? null,
                'about_us' => $request->about_us ?? null,
                'organization_type' => $request->organization_type ?? null,
                'industry_type' => $request->industry_type ?? null,
                'team_size' => $request->team_size ?? null,
                'year_of_establishment' => $request->year_of_establishment ?? null,
                'website_url' => $request->website_url ?? null,
                'company_vision' => $request->company_vision ?? null,
                'linkedin' => $request->linkedin ?? null,
                'skype' => $request->skype ?? null,
                'facebook' => $request->facebook ?? null,
                'instagram' => $request->instagram ?? null,
                'youTube' => $request->youTube ?? null,
                'twitter' => $request->twitter ?? null,
                'other_social_media' => $request->other_social_media ?? null,
                'status_reason' => $request->status_reason ?? null,
                'account_status' => $request->account_status,
                'status' => $request->status,
            ];


            // LOGO
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('backend/company_logo/'), $filename);
                $data['logo'] = 'backend/company_logo/' . $filename;
            }

            // BANNER
            if ($request->hasFile('banner')) {
                $aadharBackImg = $request->file('banner');
                $filename = uniqid() . '.' . $aadharBackImg->getClientOriginalExtension();
                $aadharBackImg->move(public_path('backend/company_banner/'), $filename);
                $data['banner'] = 'backend/company_banner/' . $filename;
            }


            $user = User::create($data);

            // Assign the "employer" role
            $user->assignRole('employer');

        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();

        return redirect()->route('admin.employers')->with('status', 'Employer Created Successfully!');
    }



    public function edit($employer)
    {

        $employer = User::find($employer);

        $organizationType = OrganizationType::where('status', 'active')->pluck('organization_type', 'id')->toArray();

        $industryType = IndustryType::where('status', 'active')->pluck('industry_type', 'id')->toArray();

        $teamSize = TeamSize::where('status', 'active')->pluck('team_size', 'id')->toArray();

        return view('superadmin.company.edit', compact('employer', 'organizationType', 'industryType', 'teamSize'));
    }



    public function update(Request $request, $employer)
    {

        $validated = $request->validate([

            'company_name' => ['nullable'],
            'name' => ['required'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'mobile_number' => ['required', Rule::unique(User::class)->ignore($request->id)],
            'secondary_phone' => ['nullable', Rule::unique(User::class)->ignore($request->id)],
            'address' => ['nullable'],

            'about_us' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

            'organization_type' => ['required', 'string',],
            'industry_type' => ['required', 'string',],
            'team_size' => ['required', 'string',],
            'year_of_establishment' => ['required'],
            'website_url' => ['required', 'string',],
            'company_vision' => ['nullable', 'string'],

            'linkedin' => ['required'],
            'skype' => ['nullable'],
            'facebook' => ['nullable'],
            'instagram' => ['nullable'],
            'youTube' => ['nullable'],
            'twitter' => ['nullable'],
            'other_social_media' => ['nullable'],
            'account_status' => ['required'],
            'status' => ['required'],
            'status_reason' => ['nullable'],

        ]);
        DB::beginTransaction();

        try {

            $employerUpdate = User::where('id', $request->id)->first();

            $data = [
                'employer_type' => $request->employer_type,

                'company_name' => $request->company_name ?? '',
                'name' => $request->name,
                'email' => $request->email,
                // 'password' => Hash::make($request->password) ?? '',
                'mobile_number' => $request->mobile_number,
                'secondary_phone' => $request->secondary_phone ?? '',
                'address' => $request->address ?? '',
                'about_us' => $request->about_us ?? '',
                'organization_type' => $request->organization_type ?? '',
                'industry_type' => $request->industry_type ?? '',
                'team_size' => $request->team_size ?? '',
                'year_of_establishment' => $request->year_of_establishment ?? '',
                'website_url' => $request->website_url ?? '',
                'company_vision' => $request->company_vision ?? '',
                'linkedin' => $request->linkedin ?? '',
                'skype' => $request->skype ?? '',
                'facebook' => $request->facebook ?? '',
                'instagram' => $request->instagram ?? '',
                'youTube' => $request->youTube ?? '',
                'twitter' => $request->twitter ?? '',
                'other_social_media' => $request->other_social_media ?? '',
                'status_reason' => $request->status_reason ?? '',
                'account_status' => $request->account_status,
                'status' => $request->status,
            ];

            if (!empty($data['password'])) {
                $data['password'] = $data['password'];
            } else {
                $data = Arr::except($data, array('password'));
            }


            // LOGO
            if ($request->hasFile('logo')) {
                // Delete the old image if it exists
                if ($employerUpdate->logo && is_file(public_path($employerUpdate->logo))) {
                    unlink(public_path($employerUpdate->logo));
                }

                // Upload new logo
                $logo = $request->file('logo');
                $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('backend/company_logo/'), $filename);
                $data['logo'] = 'backend/company_logo/' . $filename;
            }


            // BANNER
            if ($request->hasFile('banner')) {
                // Delete the old image if it exists
                if ($employerUpdate->banner && is_file(public_path($employerUpdate->banner))) {
                    unlink(public_path($employerUpdate->banner));
                }

                // Upload new banner
                $banner = $request->file('banner');
                $filename = uniqid() . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('backend/company_banner/'), $filename);
                $data['banner'] = 'backend/company_banner/' . $filename;
            }

            $employerUpdate->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.employers')->with('status', 'Employer Profile Updated Successfully!');
    }


    public function delete(User $employer)
    {
        DB::beginTransaction();
        try {
            $employer->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.employers')->with('status', 'Employer Profile Deleted Successfully!');
    }


    // Employer status change
    public function employerAccountStatusUpdate($id)
    {
        $employerBlock = User::find($id);
        $employerBlock->account_status = $employerBlock->account_status == 'activated' ? 'deactivated' : 'activated';
        $employerBlock->update();

        return redirect()->back()->with('status', 'Employer status has been updated.');
    }

    
}
