@extends('partials.backend.app')
@section('adminTitle', 'View Candidate')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>{{ 'View Candidate' }}</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ 'Candidate Name -' }}</a>
                            </li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">{{ $candidate->name ?? '' }}</li>
                            </div>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="pull-right">
                        <a href="javascript:void(0);" onclick="window.history.back()"
                            class="btn btn-success  btn-sm scroll-click" rel="content-y" data-toggle="collapse"
                            role="button"><i class="fa fa-backward" aria-hidden="true"></i> {{ 'Back' }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4"></h4>
                <a href="{{ route('admin.candidates') }}" class="btn btn-primary">{{ 'Candidate' }}</a>
                <a href="{{ route('admin.candidate.edit', ['candidate' => $candidate->id]) }}" class="btn btn-success">Edit
                    Candidate</a>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="card pd-20 card-box mb-30 m-lg-2">
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                @if (!empty($candidate->profile_image))
                                    <img src="{{ asset($candidate->profile_image) }}" class="mt-lg-4" id="output1"
                                        alt="" style="max-width: 50%; max-height: 100px;">
                                @else
                                    <img src="" id="output1" alt="" class="mt-lg-4"
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Account Status :</strong>
                                <span class="text-danger">{{ $candidate->status == 'active' ? 'ACTIVE' : 'BLOCK' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Candidate Name :</strong>
                                <span>{{ $candidate->name ?? 'No title' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Comapny Name :</strong>
                                <span>{{ $candidate->company_name ?? 'No company' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Candidate Email :</strong>
                                <span>{{ $candidate->email ?? 'No Email' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong> Mobile Number :</strong>
                                <span>{{ $candidate->mobile_number ?? '-' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Secondary Phone :</strong>
                                <span>{{ $candidate->secondary_phone ?? '-' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Gender :</strong>
                                <span>{{ $candidate->gender ?? '-' }}</span>
                                <hr>
                            </div>


                            <div class="col-md-12 mt-2">
                                <strong>Marital Status :</strong>
                                <span>{{ $candidate->marital_status ?? '-' }}</span>
                                <hr>
                            </div>


                            <div class="col-md-12 mt-2">
                                <strong>Birth Date :</strong>
                                <span>{{ $candidate->dob ? \Carbon\Carbon::parse($candidate->dob)->format('d-M-Y') : '' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Website :</strong>
                                <span>{{ $candidate->website_url ?? 'No Website ' }}</span>
                                <hr>
                            </div>


                            <div class="col-md-12 mt-2">
                                <strong>Address :</strong>
                                <span>{{ $candidate->address ?? 'No Address ' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <hr>
                            </div>



                        </div>
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="card pd-20 card-box mb-30 m-lg-2">
                        <div class="row">


                            <div class="col-md-12 mt-2">
                                <strong>Resume/CV :</strong>
                                @if (!empty($candidate->resume))
                                    <span>{{ basename($candidate->resume) }}</span>
                                @else
                                    <span class="text-danger">Not Found Resume</span>
                                @endif
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Profession :</strong>
                                <span>{{ $candidate->professions->profession }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Profession :</strong>
                                <span>{{ $candidate->professions->profession }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Experience :</strong>
                                <span>{{ $candidate->experience->experiences }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Job Role :</strong>
                                <span>{{ $candidate->jobRole->job_role ?? '' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Education :</strong>
                                <span>{{ $candidate->educations->education ?? '' }}</span>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Skills :</strong>

                                @foreach (json_decode($candidate->skill) as $skill)
                                    <span>{{ $skill }}</span><br>
                                @endforeach
                                <hr>

                            </div>

                            <div class="col-md-12 mt-2">
                                <strong>Language :</strong>

                                @foreach (json_decode($candidate->language_id) as $lang)
                                    <span>{{ $lang }}</span><br>
                                @endforeach
                                <hr>

                            </div>


                            <div class="col-md-12 mt-2">
                                <strong>Biography :</strong>
                                <span>{{ $candidate->biography }}</span>
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
