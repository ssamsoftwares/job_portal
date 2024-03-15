@extends('partials.backend.app')
@section('adminTitle', 'View Job Post')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>{{ 'View Job Post' }}</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ 'Jobs Title -' }}</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">{{ $jobPost->title ?? null }}</li>
                            </div>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="pull-right">
                        <a href="javascript:void(0);" onclick="window.history.back()"
                            class="btn btn-success  btn-sm scroll-click" rel="content-y" data-toggle="collapse"
                            role="button"><i class="fa fa-backward" aria-hidden="true"></i>  {{ 'Back' }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4"></h4>
                <a href="{{ route('admin.jobPost') }}" class="btn btn-primary">{{ 'Job' }}</a>
                <a href="{{ route('admin.jobPost.edit',['jobPost'=>$jobPost->id]) }}" class="btn btn-success">Edit Post</a>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="card pd-20 card-box mb-30 m-lg-2">
                        <div class="row">

                            <div class="col-md-12 mt-2">
                                <strong>Job Status :</strong>
                                <span class="text-danger">{{ $jobPost->status == 'active' ? 'ACTIVE':'BLOCK' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Job Title :</strong>
                                <span>{{ $jobPost->title ?? 'No title' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Comapny Name :</strong>
                                <span>{{ $jobPost->company->name ?? 'No company' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Job Category :</strong>
                                <span>{{ $jobPost->jobCategory->category ?? 'Job Category ' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Total Vacancie :</strong>
                                <span>{{ $jobPost->total_vacancies ?? 'No Total Vacancie' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Deadline :</strong>
                                <span>{{ $jobPost->deadline ?? 'No Deadline' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Select Options :</strong>
                                <span>{{ $jobPost->salary_option ?? ' No Salary Type' }}</span>
                                <hr>
                            </div>


                            <div class="col-md-6 mt-2">
                                <strong>Minimum Salary :</strong>
                                <span>{{ $jobPost->minimum_salary ?? 'No Minimum Salary ' }}</span>

                            </div>

                            <div class="col-md-6 mt-2">
                                <strong>Maximum Salary:</strong>
                                <span>{{ $jobPost->maximum_salary ?? 'No Maximum Salary' }}</span>

                            </div>

                            <div class="col-md-12 mt-2">
                                <hr>
                            </div>


                            <div class="col-md-6 mt-2">
                                <strong>Salary Type :</strong>
                                <span>{{ $jobPost->salaryType->salary_type ?? ' No Salary' }}</span>
                            </div>

                            <div class="col-md-6 mt-2">
                                <strong>Custom Salary:</strong>
                                <span>{{ $jobPost->custom_salary ?? 'No Custom Salary' }}</span>
                            </div>

                            <div class="col-md-12 mt-2">
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Job Promote:</strong>
                                <span>{{ $jobPost->job_featured_type ?? 'No Job Promote' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Job Working Type:</strong>
                                <span>{{ $jobPost->job_working_type ?? 'No Job Promote' }}</span>
                                <hr>
                            </div>


                        </div>
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="card pd-20 card-box mb-30 m-lg-2">
                        <div class="row">

                            <div class="col-md-12 mt-2">
                                <strong>Experience :</strong>
                                <span>{{ $jobPost->experience->experiences }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Job Role :</strong>
                                <span>{{ $jobPost->jobRole->job_role }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Tags :</strong>
                                @foreach (json_decode($jobPost->tags_id) as $tag)
                                    <span>{{ $tag }}</span><br>
                                @endforeach
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Skills :</strong>

                                @foreach (json_decode($jobPost->skills_id) as $skill)
                                    <span>{{ $skill }}</span><br>
                                @endforeach
                                <hr>

                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Benefits :</strong>
                                <span>{{ $jobPost->benefits }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Location :</strong>
                                <span>{{ $jobPost->location }}</span>
                                <hr>
                            </div>


                            <div class="col-md-12 mt-2">
                                <strong>Description  :</strong>
                                <span>{{ $jobPost->description }}</span>
                                <hr>

                            </div>


                        </div>

                    </div>
                </div>


            </div>

        </div>

    @endsection

    @push('script')
    @endpush
