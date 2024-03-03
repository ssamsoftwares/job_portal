@extends('partials.backend.app')
@section('adminTitle', 'Employer Settings')
@section('content')

    <x-status-message />


    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Employer Details</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employer.dashboard') }}">Home</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Settings</li>
                            </div>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="pull-right">
                        <a href="javascript:void(0);" onclick="window.history.back()"
                            class="btn btn-success  btn-sm scroll-click" rel="content-y" data-toggle="collapse"
                            role="button"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <h5 class="h4 text-blue mb-20">Settings</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#company_info1" role="tab"
                                    aria-selected="true">Company Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#founding_info1" role="tab"
                                    aria-selected="false">Founding Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#social_media1" role="tab"
                                    aria-selected="false">Social Media Profile</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#account_setting1" role="tab"
                                    aria-selected="false">Account Setting</a>
                            </li>


                        </ul>
                        <div class="tab-content">

                            {{-- Company Info --}}
                            <div class="tab-pane fade show active" id="company_info1" role="tabpanel">
                                <div class="pd-20">
                                    <form action="{{route('employer.companyInfo',['id'=>$employer->id])}}" method="post" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="id" value="{{$employer->id ?? ''}}">
                                        <input type="hidden" name="email" value="{{auth()->user()->email ?? ''}}">

                                        <div class="row">
                                            {{-- LOGO --}}
                                            <div class="col-lg-8 mt-lg-4">
                                                <label for="">{{ 'Logo' }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" accept="image/*" name="logo" id="logo"
                                                    class="form-control" onchange="loadFile(event,'output1')">


                                                    <span class="text-danger">
                                                        @error('logo')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                            </div>

                                            <div class="col-lg-4 mt-lg-4">
                                                @if (!empty($employer->logo))
                                                    <img src="{{ asset($employer->logo) }}" class="mt-lg-4" id="output1"
                                                        alt="" style="max-width: 50%; max-height: 100px;">
                                                @else
                                                    <img src="" id="output1" alt="" class="mt-lg-4"
                                                        style="max-width: 50%; max-height: 100px;">
                                                @endif
                                            </div>

                                            {{-- Company Banner --}}

                                            <div class="col-lg-8 mt-lg-4">
                                                <label for="">{{ 'Banner' }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" accept="image/*" name="banner" id="banner"
                                                    class="form-control" onchange="loadFile(event,'output2')">

                                                    <span class="text-danger">
                                                        @error('banner')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                            </div>

                                            <div class="col-lg-4 mt-lg-4">
                                                @if (!empty($employer->banner))
                                                    <img src="{{ asset($employer->banner) }}" class="mt-lg-4" id="output2"
                                                        alt="" style="max-width: 50%; max-height: 100px;">
                                                @else
                                                    <img src="" id="output2" alt="" class="mt-lg-4"
                                                        style="max-width: 50%; max-height: 100px;">
                                                @endif
                                            </div>


                                            <div class="col-md-12 mt-4">
                                                <x-form.input type="text" name="company_name" label="Comapny Name"
                                                    value="{{ $employer->company_name ?? '' }}" placeholder="Comapny Name"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <x-form.textarea name="about_us" label="About Us" required="true"
                                                    value="{{ $employer->about_us ?? '' }}" />
                                            </div>


                                            <div class="col-md-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ 'Save Changes' }}</button>
                                            </div>



                                        </div>

                                    </form>
                                </div>
                            </div>


                            {{-- Founding Info --}}
                            <div class="tab-pane fade" id="founding_info1" role="tabpanel">

                                <div class="pd-20">
                                    <form action="{{route('employer.foundingInfo',['id'=>$employer->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$employer->id ?? ''}}">
                                        <input type="hidden" name="email" value="{{auth()->user()->email ?? ''}}">

                                        <div class="row">

                                            <div class="col-md-4">
                                                <x-form.select label="Organization Type*"
                                                    chooseFileComment="--Select Organization Type--"
                                                    name="organization_type" :options="$organizationType" :selected="$employer->organization_type" />
                                            </div>

                                            <div class="col-md-4">
                                                <x-form.select label="Industry Type*"
                                                    chooseFileComment="--Select Industry Type--" name="industry_type"
                                                    :options="$industryType" :selected="$employer->industry_type" />

                                            </div>

                                            <div class="col-md-4">
                                                <x-form.select label="Team Size*" chooseFileComment="--Select Team Size--"
                                                    name="team_size" :options="$teamSize" :selected="$employer->team_size" />
                                            </div>


                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="date" name="year_of_establishment"
                                                    label="Year of Establishment" value="{{ $employer->year_of_establishment ?? '' }}"
                                                    placeholder="Year of Establishment" required="true" />
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="website_url" label="Website Url"
                                                    value="{{ $employer->website_url ?? '' }}" placeholder="Website Url"
                                                    required="true" />
                                            </div>


                                            <div class="col-md-12 mt-2">
                                                <x-form.textarea name="company_vision" label="Company Vision"
                                                    required="true" value="{{ $employer->company_vision ?? '' }}" />
                                            </div>


                                            <div class="col-md-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ 'Save Changes' }}</button>
                                            </div>



                                        </div>

                                    </form>
                                </div>

                            </div>


                            {{-- Social Media Profile --}}
                            <div class="tab-pane fade" id="social_media1" role="tabpanel">
                                <div class="pd-20">
                                    <form action="{{route('employer.socialMediaProfile',['id'=>$employer->id])}}" method="post">
                                        @csrf

                                        <input type="hidden" name="id" value="{{$employer->id ?? ''}}">
                                        <input type="hidden" name="email" value="{{auth()->user()->email ?? ''}}">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="linkedin" label="Linkedin"
                                                    value="{{ $employer->linkedin ?? '' }}" placeholder="linkedin"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="skype" label="Skype"
                                                    value="{{ $employer->skype ?? '' }}" placeholder="skype"
                                                    required="true" />
                                            </div>


                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="facebook" label="Facebook"
                                                    value="{{ $employer->facebook ?? '' }}" placeholder="facebook" />
                                            </div>

                                            <div class="col-md-6  mt-4">
                                                <x-form.input type="text" name="instagram" label="Instagram"
                                                    value="{{ $employer->instagram ?? '' }}" placeholder="instagram" />
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="youTube" label="YouTube"
                                                    value="{{ $employer->youTube ?? '' }}" placeholder="youTube" />
                                            </div>


                                            <div class="col-md-6  mt-4">
                                                <x-form.input type="text" name="twitter" label="Twitter"
                                                    value="{{ $employer->twitter ?? '' }}" placeholder="twitter" />
                                            </div>


                                            <div class="col-md-12 mt-2">
                                                <x-form.textarea name="other_social_media" label="Other Social Media"
                                                    value="{{ $employer->other_social_media ?? '' }}" />
                                            </div>

                                            <div class="col-md-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ 'Save Changes' }}</button>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>

                            {{-- Account setting --}}

                            <div class="tab-pane fade" id="account_setting1" role="tabpanel">

                                <div class="pd-20">

                                    <form action="{{route('employer.accountsetting',['id'=>$employer->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$employer->id ?? ''}}">
                                        <input type="hidden" name="email" value="{{auth()->user()->email ?? ''}}">
                                        <div class="row">

                                            <div class="col-md-12 mt-2">
                                                <x-form.textarea name="address" label="Comapny Address"
                                                    value="{{ $employer->address ?? '' }}" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="name" label="Name"
                                                    value="{{ $employer->name ?? '' }}" placeholder="Name"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="email" name="email" label="Email"
                                                    value="{{ $employer->email ?? '' }}" placeholder="Email Address"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="mobile_number" label="Phone"
                                                    value="{{ $employer->mobile_number ?? '' }}" placeholder="Phone"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="secondary_phone"
                                                    label="Alternate Number"
                                                    value="{{ $employer->secondary_phone ?? '' }}"
                                                    placeholder="Alternate Number" />
                                            </div>

                                            <div class="col-md-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ 'Save Changes' }}</button>
                                            </div>

                                        </div>
                                    </form>


                                    <div class="mt-4">
                                        <h5>Change Password</h5>
                                    </div>

                                    {{-- Account Details --}}
                                    <form action="{{ route('employer.updatePassword') }}" method="post">
                                        @csrf
                                        <div class="row mt-4">

                                            <div class="col-md-6">
                                                <x-form.input type="password" name="password" label="Password"
                                                    value="" placeholder="Password" required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="password" name="password_confirmation"
                                                    label="Confirm Password" value=""
                                                    placeholder="confirm-password" required="true" />
                                            </div>


                                            <div class="col-md-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ 'Save Changes' }}</button>
                                            </div>

                                        </div>
                                    </form>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
@push('script')
    <script>
        $('#about_us').wysihtml5({
            html: true
        });

        $('#company_vision').wysihtml5({
            html: true
        });

        $('#other_social_media').wysihtml5({
            html: true
        });
    </script>


    {{-- Image Preview Script --}}
    <script>
        function loadFile(event, outputId) {
            var output = document.getElementById(outputId);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // Free up memory
            };
        }
    </script>
@endpush
