@extends('partials.backend.guest')
@section('authTitle', 'Employer Register')
@section('authContent')
    @push('style')
        <style>
            .hidden {
                display: none;
            }
        </style>
    @endpush

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <x-status-message />

            <div class="row align-items-center">
                <div class="col-md-4 col-lg-6">
                    <img src="{{ asset('backend/assets/vendors/images/login-page-img.png') }}" alt="">
                </div>

                <div class="col-md-8 col-lg-6 mb-lg-4">

                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="login-title">
                            <h4 class="text-center text-primary">{{ 'Registration For Employer' }}</h4>
                            <p class="m-4">Already have an account? <u> <i><a href="{{ route('login') }}"
                                            class="text-primary">Log In</a></i></u></p>
                        </div>



                        <form class="form-horizontal mb-lg-4" method="POST" action="{{ route('employerRegister') }}">
                            @csrf

                            <div class="employer_type m-4">
                                <b>You want to register</b>
                                <div class="col-md-8 col-sm-12 m-2">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="company" value="company" name="employer_type"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="company">On behalf of your
                                            company/business</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="individual" value="individual" name="employer_type"
                                            class="custom-control-input" checked>
                                        <label class="custom-control-label" for="individual">As an
                                            individual/proprietor</label>
                                    </div>
                                </div>

                            </div>


                            {{-- Company Name --}}


                            <div class="form-group row company_name_input" style="display: none;">
                                <label class="col-sm-4 col-form-label">Your Company Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="company_name" value="{{ old('company_name') }}"
                                        class="form-control" placeholder="What is your company name?">

                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            {{-- Full Name --}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Your Full Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        placeholder="What is your name?">

                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            {{-- Username/Email Address --}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Your official email <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        placeholder="Your email address">
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                            </div>


                            {{-- password --}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Password <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="(Minimum 6 characters)">

                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                            </div>


                            {{-- Confirm Password --}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Confirm Password <span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-8">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Confirm-password">

                                        <span class="text-danger">
                                            @error('password_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>
                            </div>


                            {{-- Mobile Number --}}

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Your mobile number <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="mobile_number" value="{{old('mobile_number')}}" placeholder="Enter your number"
                                        class="form-control">
                                        <span class="text-danger">
                                            @error('mobile_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                </div>

                            </div>

                            {{-- Terms of Service  --}}
                            <div class="row pb-30">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="accept_terms" class="custom-control-input"
                                            id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1"> I've read and agree with <a
                                                href="#" class="text-muted"> Terms of Servic</a></label>
                                    </div>
                                    <span class="text-danger">
                                        @error('accept_terms')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>



                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Register">
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

@push('script')
    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                if ($(this).attr("id") == "company" && $(this).is(":checked")) {
                    $(".company_name_input").show();
                } else {
                    $(".company_name_input").hide();
                }
            });
        });
    </script>
@endpush
