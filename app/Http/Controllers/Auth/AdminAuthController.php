<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminAuthController extends Controller
{

    // Superadmin Login View
    public function loginView(){
        return view('auth.login');
    }

    public function login(Request $request)
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
                // Check if the user account is activated
                if ($user->account_status === 'activated') {
                    // Check if the user has the 'superadmin' role
                    if ($user->hasRole('superadmin')) {
                        return redirect()->route('admin.dashboard')->with('success');
                    } else {
                        Auth::logout();
                        return redirect()->back()->with('error', 'You do not have permission to access this page.');
                    }
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Your account is deactivated.');
                }
            } else {
                return redirect()->back()->with('error', 'These credentials do not match our records.');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status', $e->getMessage());
        }
    }
    

    public function logout()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                Auth::logout();
                return redirect()->route('superadmin.loginView')->with('success', 'Logged out successfully.');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('success', 'Logged out successfully.');
            }
        }
    }


}
