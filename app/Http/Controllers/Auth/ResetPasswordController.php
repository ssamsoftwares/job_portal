<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function create($token)
    {
        return view('auth.authentication.reset-password', ['token' => $token]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'email|exists:users',
            'password' => 'required|string|min:6|max:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->where('created_at', '>', Carbon::now()->subHours(24))
            ->first();

        if (!$updatePassword) {
            return back()->with('error', 'Invalid or expired token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        // if ($user->hasRole('superadmin')) {
        //     return redirect()->route('superadmin.loginView')->with('success', 'Your password has been changed!');
        // }
        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }




    public function verifyEmail()
    {
        return view('auth.email.verify-email');
    }
}
