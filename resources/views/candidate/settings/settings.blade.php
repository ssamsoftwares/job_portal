@extends('partials.backend.app')
@section('adminTitle', 'Candidate Settings')
@section('content')

    <x-status-message />


    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Candidate Details</h4>
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
                                <a class="nav-link active" data-toggle="tab" href="#basic1" role="tab"
                                    aria-selected="true">Basic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile1" role="tab"
                                    aria-selected="false">Profile</a>
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

                            {{-- Basic Info --}}
                            <div class="tab-pane fade show active" id="basic1" role="tabpanel">
                                <div class="pd-20">
                                    <form action="{{ route('candidate.basicDetails', ['id' => $candidate->id]) }}"
                                        method="post" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="id" value="{{$candidate->id ?? ''}}">
                                        <input type="hidden" name="email" value="{{auth()->user()->email ?? ''}}">

                                        <div class="row">

                                            {{-- profile_image --}}
                                            <div class="col-lg-8 mt-lg-4">
                                                <label for="">{{ 'Profile Image' }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" accept="image/*" name="profile_image"
                                                    id="profile_image" class="form-control"
                                                    onchange="loadFile(event,'output1')">


                                                <span class="text-danger">
                                                    @error('profile_image')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="col-lg-4 mt-lg-4">
                                                @if (!empty($candidate->profile_image))
                                                    <img src="{{ asset($candidate->profile_image) }}" class="mt-lg-4"
                                                        id="output1" alt=""
                                                        style="max-width: 50%; max-height: 100px;">
                                                @else
                                                    <img src="" id="output1" alt="" class="mt-lg-4"
                                                        style="max-width: 50%; max-height: 100px;">
                                                @endif
                                            </div>
                                            {{-- profile_image End --}}


                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="name" label="Full Name"
                                                    value="{{ $candidate->name ?? '' }}" placeholder="Full Name"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <x-form.input name="professional_title" label="Professional Title/Tagline"
                                                    value="{{ $candidate->professional_title ?? '' }}" />
                                            </div>


{{--
                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="mobile_number" label="Mobile Number"
                                                    placeholder="" value="{{ $candidate->mobile_number }}"
                                                    required="true" />
                                            </div>


                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="secondary_phone" label="Secondary Number" placeholder="" value="{{ $candidate->secondary_phone ?? '' }}"
                                                   />
                                            </div> --}}

                                            <div class="col-md-4 mt-4">
                                                <x-form.select label="Experience Level *"
                                                    chooseFileComment="--Select Experience Level --"
                                                    name="experience_level" :options="$data['experienceLevel']" :selected="$candidate->experience_level" />
                                            </div>

                                            <div class="col-md-4 mt-4">
                                                <x-form.select label="Job Role *" chooseFileComment="--Select One--" name="job_role"
                                                    :options="$data['job_roles']" :selected="$candidate->job_role" />
                                            </div>


                                            <div class="col-md-4 mt-4">
                                                <x-form.select label="Education Level*"
                                                    chooseFileComment="--Select Education Level--" name="education_level"
                                                    :options="$data['educationLevel']" :selected="$candidate->education_level" />

                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="personal_website" label="Personal Website"
                                                    value="{{ $candidate->personal_website ?? '' }}"
                                                    placeholder="Website Url" />
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="date" name="dob" label="Date Of Birth"
                                                    value="{{ $candidate->dob ?? '' }}" required="true" />
                                            </div>


                                            <div class="col-md-8">
                                                <x-form.input type="file" name="resume" label="Resume/CV"
                                                    placeholder="" required="true" />
                                            </div>

                                            <div class="col-lg-4 mt-lg-4">
                                                @if (!empty($candidate->resume))
                                                    <strong>{{ basename($candidate->resume) }}</strong>
                                                @else
                                                    <strong class="text-danger">Not Found Resume</strong>
                                                @endif
                                            </div>


                                            <div class="col-md-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ 'Save Changes' }}</button>
                                            </div>


                                        </div>

                                    </form>
                                </div>
                            </div>


                            {{-- Profile Info --}}
                            <div class="tab-pane fade" id="profile1" role="tabpanel">
                                <div class="pd-20">

                                    <form action="{{ route('candidate.profileInfo', ['id' => $candidate->id]) }}"
                                        method="post" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="id" value="{{ $candidate->id ?? '' }}">
                                        <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">

                                        <div class="row">

                                            <div class="col-md-6 mt-4">
                                                <x-form.select label="Gender *" chooseFileComment="--Select Gender--"
                                                    name="gender" :options="['male', 'female', 'other']" :selected="$candidate->gender" />
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <x-form.select label="Marital Status *"
                                                    chooseFileComment="--Select Marital Status--" name="marital_status"
                                                    :options="['single', 'married']" :selected="$candidate->marital_status" />

                                            </div>


                                            <div class="col-md-6 mt-4">
                                                <x-form.select label="Profession *"
                                                    chooseFileComment="--Select Profession--" name="profession_id"
                                                    :options="$data['professions']" :selected="$candidate->profession_id" />

                                            </div>


                                            <div class="col-md-6 mt-4">
                                                <x-form.select label="Your availability *"
                                                    chooseFileComment="--Select One--" name="your_availability"
                                                    :options="['Available', 'Not Available', 'Available In']" :selected="$candidate->your_availability" />

                                            </div>


                                            <div class="col-md-12 mt-4">
                                                <label for="skill">{{ 'Skills' }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="skill[]" id="skill" class="form-control w-100"
                                                    multiple>
                                                    <option value="">--Select skills--</option>

                                                    @foreach ($data['skills'] as $skill)
                                                        @php
                                                            $savedSkills = json_decode($candidate->skill, true);
                                                            $selected =
                                                                is_array($savedSkills) &&
                                                                in_array($skill->skill, $savedSkills)
                                                                    ? 'selected'
                                                                    : '';
                                                        @endphp

                                                        <option value="{{ $skill->skill }}" {{ $selected }}>
                                                            {{ $skill->skill }}</option>
                                                    @endforeach
                                                </select>

                                                <span class="text-danger">
                                                    @error('skill')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>


                                            <div class="col-md-12 mt-4">
                                                <label for="tags_id">{{ 'Language' }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="language_id[]" id="language_id" class="form-control"
                                                    multiple>
                                                    <option value="">--Select Language--</option>
                                                    @foreach ($data['language'] as $lang)
                                                        @php
                                                            $savedLanguages = json_decode($candidate->language_id);
                                                            $selected = in_array($lang->language, $savedLanguages)
                                                                ? 'selected'
                                                                : '';
                                                        @endphp
                                                        <option value="{{ $lang->language }}" {{ $selected }}>
                                                            {{ $lang->language }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('language_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <x-form.textarea name="biography" label="Biography"
                                                    value="{{ $candidate->biography ?? '' }}" />
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
                                    <form action="{{ route('candidate.socialMediaProfile', ['id' => $candidate->id]) }}"
                                        method="post">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $candidate->id ?? '' }}">
                                        <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="linkedin" label="Linkedin"
                                                    value="{{ $candidate->linkedin ?? '' }}" placeholder="linkedin"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="skype" label="Skype"
                                                    value="{{ $candidate->skype ?? '' }}" placeholder="skype"
                                                    required="true" />
                                            </div>


                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="facebook" label="Facebook"
                                                    value="{{ $candidate->facebook ?? '' }}" placeholder="facebook" />
                                            </div>

                                            <div class="col-md-6  mt-4">
                                                <x-form.input type="text" name="instagram" label="Instagram"
                                                    value="{{ $candidate->instagram ?? '' }}" placeholder="instagram" />
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <x-form.input type="text" name="youTube" label="YouTube"
                                                    value="{{ $candidate->youTube ?? '' }}" placeholder="youTube" />
                                            </div>


                                            <div class="col-md-6  mt-4">
                                                <x-form.input type="text" name="twitter" label="Twitter"
                                                    value="{{ $candidate->twitter ?? '' }}" placeholder="twitter" />
                                            </div>


                                            <div class="col-md-12 mt-2">
                                                <x-form.textarea name="other_social_media" label="Other Social Media"
                                                    value="{{ $candidate->other_social_media ?? '' }}" />
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

                                    <form action="{{ route('candidate.accountsetting', ['id' => $candidate->id]) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $candidate->id ?? '' }}">
                                        <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">
                                        <div class="row">

                                            <div class="col-md-12 mt-2">
                                                <x-form.textarea name="address" label="Address"
                                                    value="{{ $candidate->address ?? '' }}" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="name" label="Name"
                                                    value="{{ $candidate->name ?? '' }}" placeholder="Name"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="email" name="email" label="Email"
                                                    value="{{ $candidate->email ?? '' }}" placeholder="Email Address"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="mobile_number" label="Phone"
                                                    value="{{ $candidate->mobile_number ?? '' }}" placeholder="Phone"
                                                    required="true" />
                                            </div>

                                            <div class="col-md-6">
                                                <x-form.input type="text" name="secondary_phone"
                                                    label="Alternate Number"
                                                    value="{{ $candidate->secondary_phone ?? '' }}"
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

                                    {{-- Change Password --}}
                                    <form action="{{ route('candidate.updatePassword') }}" method="post">
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
        $('#biography').wysihtml5({
            html: true
        });

        $('#company_vision').wysihtml5({
            html: true
        });

        $('#other_social_media').wysihtml5({
            html: true
        });
    </script>
    <script>
        $(document).ready(function() {

            // $('#skill').select2({
            // });

            // $('#language_id').select2({
            // });

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
