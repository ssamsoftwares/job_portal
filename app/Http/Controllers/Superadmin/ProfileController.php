<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{


    /**
     * Display the user's profile form.
     */
    public function editProfile(Request $request)
    {
        $user = $request->user();
        return view('superadmin.profile.profile')->with(compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'max:255'],
            'mobile_number ' => ['string'],
            'address' => ['string'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

        ]);

        $user = $request->user();
        $user->fill($request->all());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Profile IMG
        if ($request->hasFile('profile_image')) {
            // Delete the old image if it exists
            if ($user->profile_image && is_file(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            // Upload new profile image
            $profile_image = $request->file('profile_image');
            $filename = uniqid() . '.' . $profile_image->getClientOriginalExtension();
            $profile_image->move(public_path('backend/profile_images/profile_image/'), $filename);
            $user->profile_image = 'backend/profile_images/profile_image/' . $filename;
        }


        $request->user()->save();
        return Redirect::back()->with('status', 'Profile updated');
    }


    public function update_password(Request $request)
    {

        $validated = $request->validate([
            // 'current_password' => ['required', 'current_password','sometimes'],
            'password' => ['required', Password::defaults(), 'confirmed', 'sometimes'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $request->user()->save();

        return Redirect::back()->with('status', 'Password updated');
    }


}
