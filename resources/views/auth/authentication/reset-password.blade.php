<?php
    use Illuminate\Support\Facades\DB;
    $userEmail = DB::table('password_reset_tokens')->where('token', $token)->first();
    ?>

@extends('partials.backend.guest')
@section('authTitle', 'Reset Password')
@section('authContent')




    @if (!$userEmail || now()->diffInHours($userEmail->created_at) > 24)
        <div class="alert alert-danger text-center">
            <p>This password reset link is either invalid or has expired.</p>
            <p>Please request a new password reset link.</p>
        </div>
    @else
        <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
            <div class="container">
                <x-status-message />
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('backend/assets/vendors/images/forgot-password.png') }}" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="login-box bg-white box-shadow border-radius-10">
                            <div class="login-title">
                                <h2 class="text-center text-primary">Reset Password</h2>
                            </div>
                            <h6 class="mb-20">Enter your new password, confirm and submit</h6>

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <form method="POST" action="{{ route('password.update') }} ">
                                @csrf
                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $token }}">

                                {{-- Email Address --}}
                                <input id="email" type="hidden"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{$userEmail->email}}" required autocomplete="email" autofocus>

                                {{-- NEW Password --}}
                                <div class="input-group custom">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        placeholder="New Password">
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    </div>

                                </div>

                                {{-- Confirm NEW Password --}}
                                <div class="input-group custom">
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                        placeholder="Confirm New Password">
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    </div>
                                </div>


                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="input-group mb-0">
                                            <input class="btn btn-primary btn-lg btn-block" type="submit"
                                                value="Reset Password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
