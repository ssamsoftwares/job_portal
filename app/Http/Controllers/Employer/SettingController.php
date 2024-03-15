<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EmployerMiddleware;
use App\Models\IndustryType;
use App\Models\OrganizationType;
use App\Models\TeamSize;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(EmployerMiddleware::class)->only('settings');
    }

    public function employerverificationForm(){
        return view('employer.emp_verification');
    }


    public function profilePreview(){
        $employer = User::where('id', auth()->user()->id)
        ->with('organizationType', 'industryType', 'teamSize')
        ->first();

        // echo "<pre>";
        // print_r($employer->toArray());
        // die;

        return view('employer.settings.profile_preview',compact('employer'));
    }


    public function settings()
    {
        $employer = Auth::user();

        $organizationType = OrganizationType::where('status', 'active')->pluck('organization_type', 'id')->toArray();

        $industryType = IndustryType::where('status', 'active')->pluck('industry_type', 'id')->toArray();

        $teamSize = TeamSize::where('status', 'active')->pluck('team_size', 'id')->toArray();

        return view('employer.settings.settings', compact('employer', 'organizationType', 'industryType', 'teamSize'));
    }


    // Company Info

    public function companyInfo(Request $request)
    {

        $validated = $request->validate([
            'company_name' => ['required', 'string',],
            'about_us' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

        ]);

        DB::beginTransaction();
        try {

            $companyInfo = User::where(['id' =>$request->id,'email' =>$request->email])->first();

            $data = [
                'company_name' => $request->company_name,
                'about_us' => $request->about_us,
            ];

            // LOGO
            if ($request->hasFile('logo')) {
                // Delete the old image if it exists
                if ($companyInfo->logo && is_file(public_path($companyInfo->logo))) {
                    unlink(public_path($companyInfo->logo));
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
                if ($companyInfo->banner && is_file(public_path($companyInfo->banner))) {
                    unlink(public_path($companyInfo->banner));
                }

                // Upload new banner
                $banner = $request->file('banner');
                $filename = uniqid() . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('backend/company_banner/'), $filename);
                $data['banner'] = 'backend/company_banner/' . $filename;
            }


            $companyInfo->update($data);


        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Company Info updated Successfully done!');
    }


    // Founding Info
    public function foundingInfo(Request $request)
    {

        $validated = $request->validate([
            'organization_type' => ['required', 'string',],
            'industry_type' => ['required', 'string',],
            'team_size' => ['required', 'string',],
            'year_of_establishment' => ['required'],
            'website_url' => ['required', 'string',],
            'company_vision' => ['required', 'string'],

        ]);

        DB::beginTransaction();
        try {

            $foundingInfo =  User::where(['id' =>$request->id,'email' =>$request->email])->first();

            $data = [
                'organization_type' => $request->organization_type,
                'industry_type' => $request->industry_type,
                'team_size' => $request->team_size,
                'year_of_establishment' => $request->year_of_establishment,
                'website_url' => $request->website_url,
                'company_vision' => $request->company_vision,
            ];


            $foundingInfo->update($data);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Founding Info updated Successfully done!');
    }


     // Social Media Profile
     public function socialMediaProfile(Request $request)
     {

         $validated = $request->validate([
             'linkedin' => ['required'],
             'skype' => ['required'],
             'facebook' => ['nullable'],
             'instagram' => ['nullable'],
             'youTube' => ['nullable'],
             'twitter' => ['nullable'],
             'other_social_media' => ['nullable'],

         ]);

         DB::beginTransaction();
         try {

             $socialMediaProfile =  User::where(['id' =>$request->id,'email' =>$request->email])->first();

             $data = [
                 'linkedin' => $request->linkedin,
                 'skype' => $request->skype,
                 'facebook' => $request->facebook ?? null,
                 'instagram' => $request->instagram ?? null,
                 'youTube' => $request->youTube ?? null,
                 'twitter' => $request->twitter ?? null,
                 'other_social_media' => $request->other_social_media ?? null,
             ];


             $socialMediaProfile->update($data);

         } catch (Exception $e) {
             DB::rollBack();
             return Redirect::back()->with('status', $e->getMessage());
         }
         DB::commit();
         return Redirect::back()->with('status', 'Social Media Profile updated Successfully done!');
     }


       // Account Setting
       public function accountsetting(Request $request)
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
