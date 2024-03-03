@extends('partials.backend.guest')
@section('authTitle', 'Forgot Password')
@section('authContent')

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('backend/assets/vendors/images/forgot-password.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Forgot Password</h2>
                        </div>
                        <h6 class="mb-20">Enter your email address to reset your password</h6>

                        <x-status-message />
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            {{-- Email Address --}}
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="input-group custom">
                                <input type="text" name="email" class="form-control form-control-lg"
                                    placeholder="Email" required>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="fa fa-envelope-o"
                                            aria-hidden="true"></i></span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit"
                                            value="Send Email Password Reset Link">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
