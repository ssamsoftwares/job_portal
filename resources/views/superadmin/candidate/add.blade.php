@extends('partials.backend.app')
@section('adminTitle', 'Create Candiate')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Create Candiate</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Create Candiate </li>
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

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4"></h4>
                <a href="#" class="btn btn-primary">{{ 'Candiate' }}</a>
            </div>

            {{-- <div class="card m-4 mb-lg-4"> --}}
            <div class="pd-20 card-box mb-30">

                <form action="{{route('admin.candidate.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                <strong>Add Candidate Details</strong>
                <hr>


                <div class="row m-4">
                    {{-- Profile Image Start --}}
                    <div class="col-lg-7">
                        <label for="">{{ 'Profile Image' }} <span class="text-danger">*</span></label>
                        <input type="file" accept="image/*" name="profile_image" id="profile_image"
                            onchange="loadFile(event, 'output1')" class="form-control">
                        @error('profile_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-5">
                        <img id="output1" src="" alt="" style="max-width: 50%; max-height: 100px;">
                    </div>
                    {{-- Profile Image End --}}


                    <div class="col-md-4 mt-4">
                        <x-form.input type="text" name="name" label="Name" placeholder="" required="true" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.input type="text" name="mobile_number" label="Mobile Number" placeholder=""
                            required="true" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.input type="text" name="email" label="Email" placeholder="" required="true" />
                    </div>

                    <div class="col-md-6 mt-4">
                        <x-form.input type="password" name="password" label="Password" placeholder="" required="true" />
                    </div>

                    <div class="col-md-6 mt-4">
                        <x-form.input type="password" name="password_confirmation" label="Confirm Password" placeholder=""
                            required="true" />
                    </div>

                    <div class="col-md-12 mt-2">
                        <x-form.textarea name="address" label="Address" required="true" value="{{ old('address') }}" />
                    </div>

                </div>

                <strong>Profile Details</strong>
                <hr>
                <div class="row m-4">

                    <div class="col-md-9 mt-4">
                        <x-form.input type="file" name="resume" label="Resume?CV" placeholder="" required="true" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.select label="Profession *" chooseFileComment="--Select One--" name="profession_id"
                            :options="$data['professions']" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.select label="Experience *" chooseFileComment="--Select One--" name="experience_level"
                            :options="$data['experiences']" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.select label="Job Role *" chooseFileComment="--Select One--" name="job_role"
                            :options="$data['job_roles']" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.select label="Education *" chooseFileComment="--Select One--" name="education_level"
                            :options="$data['educations']" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.select label="Gender *" chooseFileComment="--Select One--" name="gender"  :options="[
                               'male',
                                'female',
                                'other',
                            ]" />
                    </div>

                    <div class="col-md-4 mt-4">
                        <x-form.select label="Marital Status *" chooseFileComment="--Select One--" name="marital_status"
                            :options="[
                                'single',
                                'married',
                            ]" />
                    </div>

                    <div class="col-md-6 mt-4">
                        <x-form.input type="date" name="dob" label="Birth Date" placeholder="" required="true"  />
                    </div>

                    <div class="col-md-6 mt-4">
                        <x-form.input type="text" name="personal_website" label="Website" placeholder="" />
                    </div>


                    <div class="col-md-6 mt-4">
                        <label for="tags_id">{{ 'Language' }} <span class="text-danger">*</span></label>
                        <select name="language_id[]" id="language_id" class="form-control" multiple>
                            <option value="">--Select Language--</option>
                            @foreach ($data['language'] as $lang)
                                <option value="{{ $lang->language }}">{{ $lang->language }}</option>
                            @endforeach
                        </select>

                        <span class="text-danger">
                            @error('language_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="col-md-6 mt-4">
                        <label for="skills">{{ 'Skills' }} <span class="text-danger">*</span></label>
                        <select name="skill[]" id="skill" class="form-control" multiple>
                            <option value="">--Select skills--</option>

                            @foreach ($data['skills'] as $skill)
                                <option value="{{ $skill->skill }}">{{ $skill->skill }}</option>
                            @endforeach
                        </select>

                        <span class="text-danger">
                            @error('skill')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-md-12 mt-2">
                        <x-form.textarea name="biography" label="Bio" required="true"
                            value="{{ old('biography') }}" />
                    </div>


                    <div class="col-md-12 mt-2 text-lg-center">
                       <button type="submit" class="btn btn-success max-width-1000">{{'Save'}}</button>
                    </div>
                </div>

            </form>
            </div>



        </div>

    </div>

@endsection

@push('script')
    <script>
        function loadFile(event, outputId) {
            var output = document.getElementById(outputId);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // Free up memory
            };
        }
    </script>



    <script>
        $(document).ready(function() {

            $('#profession_id').select2({
                placeholder: "-Select options-"
            });

            $('#skill').select2({
                placeholder: "-Select options-"
            });

            $('#language_id').select2({
                placeholder: "-Select options-"
            });

            $('#experience_level').select2({
                placeholder: "-Select options-"
            });

            $('#job_role').select2({
                placeholder: "-Select options-"
            });

            $('#education_level').select2({
                placeholder: "-Select options-"
            });

            $('#gender').select2({});
             $('#marital_status').select2({});
        });


        $('#biography').wysihtml5({
            html: true
        });
    </script>
@endpush
