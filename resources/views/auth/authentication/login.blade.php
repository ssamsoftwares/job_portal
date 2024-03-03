@extends('partials.backend.guest')
@section('authTitle', 'Sign in !')
@section('authContent')



<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <x-status-message />

        <div class="row align-items-center">
            <div class="col-md-4 col-lg-7">
                <img src="{{ asset('backend/assets/vendors/images/login-page-img.png') }}" alt="">
            </div>

            <div class="col-md-8 col-lg-5">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h3 class="text-center text-primary">{{'Sign in !'}}</h3>
                    </div>

                    <form class="form-horizontal mt-3" method="POST" action="{{route('userloginPost')}}">
                        @csrf

                        {{-- Username/Email Address --}}
                        <div class="input-group custom">
                            <input type="text" name="email" class="form-control form-control-lg"
                                placeholder="Full Name">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>

                        <div class="text-danger mb-4">
                            @error('email')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- password --}}
                        <div class="input-group custom">
                            <input type="password" name="password" class="form-control form-control-lg"
                                placeholder="**********">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>
                        <div class="text-danger mb-4">
                            @error('password')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Remember Me  --}}
                        <div class="row pb-30">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck1">Remember</label>
                                </div>
                            </div>

                            {{-- Forgot Password --}}
                            @if (Route::has('password.request'))
                                <div class="col-6">
                                    <div class="forgot-password"><a href="{{ route('password.request') }}">Forgot Password</a>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login">
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
