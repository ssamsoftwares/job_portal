<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;



class AuthController extends Controller
{

    // Login

    public function login()
    {
        return view('auth.authentication.login');
    }



    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember_me' => ['nullable', 'boolean'],
        ]);

        DB::beginTransaction();

        try {

            $credentials = $request->only('email', 'password');
            $remember_me = $request->has('remember_me') ? true : false;

            if (Auth::attempt($credentials, $remember_me)) {
                $user = Auth::user();

                if ($user->status === 'verified') {

                    // Check if the user account is activated
                    if ($user->account_status === 'activated') {
                        // Check if the user has the 'superadmin' role
                        if ($user->hasRole('employer')) {
                            return redirect()->route('employer.dashboard')->with('success', 'You have logging');
                        } elseif ($user->hasRole('candidate')) {
                            return redirect()->route('candidate.dashboard')->with('success', 'You have logging');
                        } else {
                            Auth::logout();
                            return redirect()->back()->with('error', 'You do not have permission to access this page.');
                        }
                    } else {
                        Auth::logout();
                        return redirect()->back()->with('error', 'Your account is deactivated.');
                    }


                }elseif($user->status == 'pending'){
                    return redirect()->route('employer.employerverificationForm');
                }
                else {
                    echo "Rejected Your Application";
                }


            }




        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status', $e->getMessage());
        }
    }


    // Candidate Register View
    public function candidateRegisterView()
    {
        return view('auth.authentication.candidate_register');
    }


    // Candidate Register Store
    public function candidateRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'mobile_number' => ['required', 'string', 'max:255', 'unique:' . User::class],
            // 'password' => ['required','min:6','max:8','confirmed', Rules\Password::defaults()],.
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'accept_terms' => ['required', 'accepted'],
        ], [
            'accept_terms' => 'You must accept our terms and conditions',
            // 'password.min' => 'The password must not be greater than 6 characters.',
        ]);

        DB::beginTransaction();
        try {

            $candidateRegister = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'accept_terms' => $request->accept_terms,
                'status' => 'verified',
            ];

            $candidateRegister['password'] = Hash::make($request['password']);

            $user = User::create($candidateRegister);
            // Assign the "candidate" role
            $user->assignRole('candidate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('login')->with('success', 'Register Successfully Done.');
    }


    // Employer Register View
    public function employerRegisterView()
    {
        return view('auth.authentication.employer_register');
    }


    // Employer Register
    public function employerRegister(Request $request)
    {
        $request->validate([
            // 'company_name' => ['nullable', 'string', 'company_name', 'max:255', 'unique:' . User::class],
            'company_name' => ['nullable', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'mobile_number' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'accept_terms' => ['required', 'accepted'],
            'employer_type' => ['required'],
        ], [
            'accept_terms' => 'You must accept our terms and conditions',
        ]);

        DB::beginTransaction();
        try {

            $employerRegister = [
                'company_name' => $request->company_name ?? null,
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'accept_terms' => 1,
                'employer_type' => $request->employer_type,
                'status' => 'pending',
            ];

            $employerRegister['password'] = Hash::make($request['password']);

            $user = User::create($employerRegister);
            // Assign the "employer" role
            $user->assignRole('employer');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('success', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('login')->with('success', $request->name . ' Successfully Done.');
    }
}
