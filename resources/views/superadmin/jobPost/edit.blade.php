@extends('partials.backend.app')
@section('adminTitle', 'Edit Job Post')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Job Post</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Job</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Edit Job Post </li>
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
                <a href="{{ route('admin.jobPost') }}" class="btn btn-primary">{{ 'Job List' }}</a>
            </div>

            <x-status-message />

            <div class="pd-20 card-box mb-30">
                <form method="POST" action="{{ route('admin.jobPost.update', ['jobPost' => $jobPost->id]) }}"
                    id="" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <x-form.input type="text" name="title" value="{{ $jobPost->title  ?? '' }}" label="Title"
                                placeholder="" required="true" />
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="company_id">{{ 'Select Company' }} <span class="text-danger">*</span></label>
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">--Select Company--</option>
                                @foreach ($data['company'] as $com)
                                    <option value="{{ $com->id }}"
                                        {{ $jobPost->company_id == $com->id ? 'selected' : '' }}>
                                        {{ $com->name }},{{ $com->email }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="text-danger">
                                @error('company_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>



                        <div class="col-md-6 mt-4">
                            <x-form.select label="Category *" chooseFileComment="--Select One--" name="job_category_id"
                                :options="$data['jobCategory']" :selected="$jobPost->job_category_id" />
                        </div>

                        <div class="col-md-6 mt-4">
                            <x-form.input type="text" name="total_vacancies" label="Total Vacancie" placeholder=""
                                value="{{ $jobPost->total_vacancies ?? '' }}" required="true" />
                        </div>

                        <div class="col-md-6 mt-4">
                            <x-form.input type="date" name="deadline" label="Deadline" placeholder="" required="true"
                                value="{{ $jobPost->deadline  ?? '' }}" />
                        </div>

                        <hr>
                        <div class="col-md-12 mt-4">
                            <h6>{{ 'Attributes' }}</h6>
                        </div>


                        <div class="col-md-6 mt-4">
                            <x-form.select label="Experience *" chooseFileComment="--Select One--" name="experience_id"
                                :options="$data['experience']" :selected="$jobPost->experience_id" />
                        </div>

                        <div class="col-md-6 mt-4">
                            <x-form.select label="Job Role *" chooseFileComment="--Select One--" name="jobRole_id"
                                :options="$data['jobRole']" :selected="$jobPost->jobRole_id" />
                        </div>


                        <div class="col-md-6 mt-4">
                            <x-form.select label="Education *" chooseFileComment="--Select One--" name="education_id"
                                :options="$data['education']" :selected="$jobPost->education_id" />
                        </div>


                        <div class="col-md-6 mt-4">
                            <x-form.select label="Job Type *" chooseFileComment="--Select One--" name="jobType_id"
                                :options="$data['jobType']" :selected="$jobPost->jobType_id" />
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label for="tags_id">{{ 'Tags' }} <span class="text-danger">*</span></label>

                            <select name="tags_id[]" id="tags_id" class="form-control" multiple>
                                <option value="">--Select tags--</option>

                                @foreach ($data['tags'] as $tag)
                                    @php
                                        $savedTags = json_decode($jobPost->tags_id, true);
                                        $selected =
                                            is_array($savedTags) && in_array($tag->tag, $savedTags) ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $tag->tag }}" {{ $selected }}>{{ $tag->tag }}</option>
                                @endforeach
                            </select>

                            <span class="text-danger">
                                @error('tags_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="col-md-6 mt-4">
                            <label for="skills_id">{{ 'Skills' }} <span class="text-danger">*</span></label>
                            <select name="skills_id[]" id="skills_id" class="form-control" multiple>
                                <option value="">--Select skills--</option>

                                @foreach ($data['skills'] as $skill)
                                    @php
                                        $savedSkills = json_decode($jobPost->skills_id, true);
                                        $selected =
                                            is_array($savedSkills) && in_array($skill->skill, $savedSkills) ? 'selected' : '';
                                    @endphp

                                    <option value="{{ $skill->skill }}" {{ $selected }}>{{ $skill->skill }}</option>
                                @endforeach
                            </select>

                            <span class="text-danger">
                                @error('skills_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <x-form.input type="text" name="benefits" label="Benefits" value="{{$jobPost->benefits ?? ''}}" placeholder="" />
                        </div>

                        <div class="col-md-12 mt-2">
                            <x-form.textarea name="location" label="Location" required="true"
                                value="{{$jobPost->location ?? ''}}" />
                        </div>
                    </div>




                    {{-- Salary Part Start --}}
                    <div class="row">
                        <div class="col-md-12 mt-lg-4">
                            <div class="salary_type m-4">
                                <strong>Salary Type <span class="text-danger">*</span></strong>
                                <div class="col-md-8 col-sm-12 m-2">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="salary_range" value="salary_range"
                                            name="salary_option" class="custom-control-input"   {{ $jobPost->salary_option == 'salary_range' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="salary_range">Salary Range</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="custom_salary" value="custom_salary"
                                            name="salary_option" class="custom-control-input" {{ $jobPost->salary_option == 'custom_salary' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="custom_salary">Custom Salary</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('salary_option')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        {{-- Salary Range --}}
                        <div class="col-md-6 salary_range_fields">
                            <x-form.input type="text" name="minimum_salary" label="Minimum Salary ($)"
                                placeholder="" value="{{$jobPost->minimum_salary ?? ''}}" />
                        </div>

                        <div class="col-md-6 salary_range_fields">
                            <x-form.input type="text" name="maximum_salary" label="Maximum Salary ($)"
                                placeholder="" value="{{$jobPost->maximum_salary ?? ''}}" />
                        </div>

                        {{-- Custom Salary --}}
                        <div class="col-md-6" id="">
                            <x-form.select label="Salary Type *" chooseFileComment="--Select Salary Type--"
                                name="salaryType_id" :options="$data['salaryType']" :selected="$jobPost->salaryType_id" />
                        </div>

                        <div class="col-md-6" id="custom_salary_fields" style="display: none;">
                            <x-form.input type="text" name="custom_salary" label="Custom Salary"
                                placeholder="Competitive" value="{{$jobPost->custom_salary ?? ''}}" />
                        </div>
                    </div>
                    {{-- Salary Part End --}}

                    <div class="row">
                        <div class="col-md-12 mt-lg-4">
                            <h6>{{ 'Promote' }}</h6>
                        </div>

                        <div class="col-md-12 mt-lg-4">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="job_featured_type" id="featured" value="featured"  {{ $jobPost->job_featured_type == 'featured' ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="job_featured_type" id="highlight" value="highlight"  {{ $jobPost->job_featured_type == 'highlight' ? 'checked' : '' }}>
                                <label class="form-check-label" for="highlight">Highlight</label>
                            </div>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12 mt-lg-4">
                            <h6>{{ 'Job Working Type' }}</h6>
                        </div>

                        <div class="col-md-12 mt-lg-4">

                            <div class="col-md-8 col-sm-12 m-2">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="on_site" value="on_site" name="job_working_type"
                                        class="custom-control-input" {{ $jobPost->job_working_type == 'on_site' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="on_site">On site </label>
                                </div>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="remote" value="remote" name="job_working_type"
                                        class="custom-control-input" {{ $jobPost->job_working_type == 'remote' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remote">Remote</label>
                                </div>
                            </div>
                            <span class="text-danger">
                                @error('job_working_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12 mt-lg-4">
                            <x-form.textarea name="description" label="Descriprtion" required="true"
                                value="{{ $jobPost->description ?? '' }}" />
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 mt-lg-4 text-center">
                            <button type="submit" class="btn btn-primary">{{ 'Update Job Post' }}</button>
                        </div>
                    </div>

            </div>
            </form>
        </div>
    </div>
    </div>

    </div>

@endsection

@push('script')
    <script>
        $('#description').wysihtml5({
            html: true
        });

        $(document).ready(function() {

            $('#company_id').select2({
                placeholder: "-Select options-"
            });

            $('#skills_id').select2({
                placeholder: "-Select skill-"
            });

            $('#tags_id').select2({
                placeholder: "-Select tag-"
            });

            $('#category_id').select2({
                placeholder: "-Select options-"
            });

            $('#experience_id').select2({
                placeholder: "-Select options-"
            });

            $('#jobRole_id').select2({
                placeholder: "-Select options-"
            });

            $('#education_id').select2({
                placeholder: "-Select options-"
            });

            $('#jobType_id').select2({
                placeholder: "-Select options-"
            });

            $('#job_category_id').select2({});

        });
    </script>


    <script>
        $(document).ready(function() {
            $('#salary_range').change(function() {
                if ($(this).is(':checked')) {
                    $('#salary_range_fields').show();
                    $('#custom_salary_fields').hide();
                }
            });

            $('#custom_salary').change(function() {
                if ($(this).is(':checked')) {
                    $('#salary_range_fields').hide();
                    $('#custom_salary_fields').show();
                }
            });
        });
    </script>
@endpush
