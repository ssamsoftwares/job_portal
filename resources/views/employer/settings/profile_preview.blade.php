@extends('partials.backend.app')
@section('adminTitle', 'Profile')
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
                                <img src="{{ asset(auth()->user()->logo) }}" alt="Avatar"
                                    class="avatar-photo img-thumbnail text-center ml-lg-4" width="100" height="80">
                            </a>

                            <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center ">
                                            <div class="img-container">
                                                <img id="image" src="{{ asset(auth()->user()->logo) }}" alt="Picture">
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
                        <h5 class="text-center h5 mb-0">Company Name :{{ $employer->company_name }}</h5>
                        <p class="text-center text-muted font-14">{{ Str::ucfirst($employer->employer_type )}}</p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Employer Information</h5>
                            <ul>
                                <li>
                                    <span>Year of Establishment:</span>
                                    {{ $employer->year_of_establishment?? '' }}
                                </li>

                                <li>
                                    <span>Name:</span>
                                    {{ $employer->name ?? '' }}
                                </li>

                                <li>
                                    <span>Email Address:</span>
                                    {{ $employer->email ?? '' }}
                                </li>

                                <li>
                                    <span>Phone Number:</span>
                                    {{ $employer->mobile_number?? '' }}
                                </li>

                                <li>
                                    <span>Alternate Number:</span>
                                    {{ $employer->secondary_phone?? '' }}
                                </li>

                                <li>
                                    <span>Website Url:</span>
                                    {{ $employer->website_url?? '' }}
                                </li>

                                <li>
                                    <span>Address:</span>
                                    {!! $employer->address ?? '' !!}
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
                            <strong>Employer Profile Preview</strong>
                            <a href="{{route('employer.settings')}}" class="btn btn-primary float-right">Profile Settings</a>
                        </div><hr>
                        <div class="row mt-lg-4 m-2 d-flex justify-content-end">

                            <div class="col-md-12">
                                <strong>Organization Type :</strong>
                                <span>{{$employer->organizationType->organization_type ?? ''}}</span>
                            </div>

                            <div class="col-md-12 mt-4">
                                <strong>Industry Type :</strong>
                                <span>{{$employer->industryType->industry_type ?? ''}}</span>
                            </div>


                            <div class="col-md-12 mt-4">
                                <strong>Team Size :</strong>
                                <span>{{$employer->teamSize->team_size ?? ''}}</span>
                            </div>


                            <div class="col-md-12 mt-4">
                                <strong>About Us</strong>
                                <p>{{$employer->about_us ?? ''}}</p>
                            </div>


                            <div class="col-md-12 mt-4">
                                <strong>Company Vision</strong>
                                <p>{{$employer->company_vision ?? ''}}</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
