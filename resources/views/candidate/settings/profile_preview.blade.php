@extends('partials.backend.app')
@section('adminTitle', 'Candidate Profile')
@section('content')

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <a href="modal" data-toggle="modal" data-target="#modal">
                                <img src="{{ asset(auth()->user()->profile_image) }}" alt="Avatar"
                                    class="avatar-photo img-thumbnail text-center ml-lg-4" width="100" height="80">
                            </a>

                            <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center ">
                                            <div class="img-container">
                                                <img id="image" src="{{ asset(auth()->user()->profile_image) }}" alt="Picture">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{-- <input type="submit" value="Update" class="btn btn-primary"> --}}
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="text-center h5 mb-0">Name : {{ $candidate->name }}</h5>
                        <p class="text-center text-muted font-14">Role : {{ Str::ucfirst($candidate->jobRole->job_role )}}</p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Candidate Information</h5>
                            <ul>
                                <li>
                                    <span>Professional Title/Tagline</span>
                                    {{ $candidate->professional_title?? '' }}
                                </li>

                                <li>
                                    <span>Email Address:</span>
                                    {{ $candidate->email ?? '' }}
                                </li>

                                <li>
                                    <span>Phone Number:</span>
                                    {{ $candidate->mobile_number?? '' }}
                                </li>

                                <li>
                                    <span>Alternate Number:</span>
                                    {{ $candidate->secondary_phone?? '' }}
                                </li>

                                <li>
                                    <span>Website Url:</span>
                                    {{ $candidate->website_url?? '' }}
                                </li>

                                <li>
                                    <span>Address:</span>
                                    {!! $candidate->address ?? '' !!}
                                </li>
                            </ul>
                        </div>
                        <div class="profile-social">
                            <h5 class="mb-20 h5 text-blue">Social Links</h5>
                            <ul class="clearfix">

                                <li><a href="{{auth()->user()->linkedin ?? ''}}" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>

                                <li><a href="{{auth()->user()->skype ?? ''}}" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-skype"></i></a></li>

                                <li><a href="{{auth()->user()->facebook ?? ''}}" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>

                                <li><a href="{{auth()->user()->twitter ?? ''}}" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>

                                <li><a href="{{auth()->user()->youtube ?? ''}}" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-youtube"></i></a></li>

                                <li><a href="{{auth()->user()->instagram ?? ''}}" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">

                        <div class="mt-lg-4 m-4">
                            <strong>Candidate Profile Preview</strong>
                            <a href="{{route('candidate.settings')}}" class="btn btn-primary float-right">Profile Settings</a>
                        </div><hr>
                        <div class="row mt-lg-4 m-2 d-flex justify-content-end">

                            <div class="col-md-12">
                                <strong>Gender :</strong>
                                <span>{{$candidate->gender ?? '-'}}</span>
                            </div>

                            <div class="col-md-12 mt-4">
                                <strong>Marital Status :</strong>
                                <span>{{$candidate->marital_status ?? '-'}}</span>
                            </div>

                            <div class="col-md-12 mt-4">
                                <strong>Website :</strong>
                                <span>{{$candidate->personal_website ?? '-'}}</span>
                            </div>

                            <div class="col-md-12 mt-4">
                                <strong>Experience :</strong>
                                <span>{{$candidate->experience->experiences ?? '-'}}</span>
                            </div>

                            <div class="col-md-12 mt-4">
                                <strong>Educations:</strong>
                                <span>{{$candidate->educations->education ?? '-'}}</span>
                            </div>


                            <div class="col-md-12 mt-4">
                                <strong>Job Role :</strong>
                                <span>{{$candidate->jobRole->job_role ?? '-'}}</span>
                            </div>


                            <div class="col-md-12 mt-4">
                                <strong>Language :</strong>
                                <span>{{$candidate->language->language ?? '-'}}</span>
                            </div>


                            <div class="col-md-12 mt-4">
                                <strong>Skill :</strong>
                                <span>{{$candidate->skill->skill ?? '-'}}</span>
                            </div>

                            <div class="col-md-12 mt-4">
                                <strong>Biography :</strong>
                                <p>{{$candidate->biography ?? '-'}}</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
