@extends('partials.backend.app')
@section('adminTitle', 'Edit Employer')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Employer Profile</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Edit Employer Profile</li>
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
                <a href="#" class="btn btn-primary">{{ 'Employer' }}</a>
            </div>


            <div class="pd-20 card-box mb-30">
                <form method="post" action="{{route('admin.employer.update',['employer'=>$employer->id])}}" id="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$employer->id}}">

                    <div class="row">

                        {{-- LOGO --}}
                        <div class="col-lg-8 mt-lg-4">
                            <label for="">{{ 'Logo' }}</label>
                            <input type="file" accept="image/*" name="logo" id="logo" class="form-control"
                                onchange="loadFile(event,'output1')">


                            <span class="text-danger">
                                @error('logo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-4 mt-lg-4">
                            @if (!empty($employer->logo))
                                <img src="{{ asset($employer->logo) }}" class="mt-lg-4" id="output1" alt=""
                                    style="max-width: 50%; max-height: 100px;">
                            @else
                                <img src="" id="output1" alt="" class="mt-lg-4"
                                    style="max-width: 50%; max-height: 100px;">
                            @endif
                        </div>

                        {{-- Company Banner --}}

                        <div class="col-lg-8 mt-lg-4">
                            <label for="">{{ 'Banner' }} <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" name="banner" id="banner" class="form-control"
                                onchange="loadFile(event,'output2')">

                            <span class="text-danger">
                                @error('banner')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-4 mt-lg-4">
                            @if (!empty($employer->banner))
                                <img src="{{ asset($employer->banner) }}" class="mt-lg-4" id="output2" alt=""
                                    style="max-width: 50%; max-height: 100px;">
                            @else
                                <img src="" id="output2" alt="" class="mt-lg-4"
                                    style="max-width: 50%; max-height: 100px;">
                            @endif
                        </div>


                        <div class="col-md-6 mt-lg-4">
                            <div class="employer_type m-4">
                                <strong>Employer register type <span class="text-danger">*</span></strong>
                                <div class="col-md-8 col-sm-12 m-2">
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="company" value="company" name="employer_type"
                                           {{ $employer === 'company' ? 'checked' : '' }}  class="custom-control-input">
                                        <label class="custom-control-label" for="company">On behalf of your
                                            company/business</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="individual" value="individual" name="employer_type"
                                        {{ $employer === 'individual' ? 'checked' : '' }}   class="custom-control-input" checked>
                                        <label class="custom-control-label" for="individual">As an
                                            individual/proprietor</label>
                                    </div>
                                </div>

                                <span class="text-danger">
                                    @error('employer_type')
                                        {{ $message }}
                                    @enderror
                                </span>


                            </div>
                        </div>



                        {{-- Company Name --}}

                        <div class="col-md-12" style="display: none;">
                            <label class="">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" value="{{ $employer->company_name ?? '' }}"
                                class="form-control" placeholder="">
                            <span class="text-danger">
                                @error('company_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        {{-- Full Name --}}
                        <div class="col-md-12 mt-4">
                            <label class="">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $employer->name ?? '' }}"
                                class="form-control" placeholder="Name">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="col-md-4 mt-4">
                            <x-form.input type="text" name="email" label="Email" placeholder=""
                                value="{{ $employer->email ?? '' }}" required="true" />
                        </div>

                        <div class="col-md-4 mt-4">
                            <x-form.input type="password" name="password" label="Password" placeholder=""
                                required="true" />
                        </div>

                        <div class="col-md-4 mt-4">
                            <x-form.input type="password" name="confirm-password" label="Confirm Password"
                                placeholder="" required="true" />
                        </div>


                        <div class="col-md-6">
                            <x-form.input type="text" name="mobile_number" label="Phone"
                                value="{{ $employer->mobile_number ?? '' }}" placeholder="Phone" required="true" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input type="text" name="secondary_phone" label="Alternate Number"
                                value="{{ $employer->secondary_phone ?? '' }}" placeholder="Alternate Number" />
                        </div>


                        <div class="col-md-4">
                            <x-form.select label="Organization Type*" chooseFileComment="--Select Organization Type--"
                                name="organization_type" :options="$organizationType" :selected="$employer->organization_type" />
                        </div>

                        <div class="col-md-4">
                            <x-form.select label="Industry Type*" chooseFileComment="--Select Industry Type--"
                                name="industry_type" :options="$industryType" :selected="$employer->industry_type" />

                        </div>

                        <div class="col-md-4">
                            <x-form.select label="Team Size*" chooseFileComment="--Select Team Size--" name="team_size"
                                :options="$teamSize" :selected="$employer->team_size" />
                        </div>


                        <div class="col-md-6 mt-4">
                            <x-form.input type="date" name="year_of_establishment" label="Year of Establishment"
                                value="{{ $employer->year_of_establishment ?? '' }}" placeholder="Year of Establishment"
                                required="true" />
                        </div>

                        <div class="col-md-6 mt-4">
                            <x-form.input type="text" name="website_url" label="Website Url"
                                value="{{ $employer->website_url ?? '' }}" placeholder="Website Url" required="true" />
                        </div>


                        {{-- Socail Media Links --}}
                        <div class="col-md-6">
                            <x-form.input type="text" name="linkedin" label="Linkedin"
                                value="{{ $employer->linkedin ?? '' }}" placeholder="linkedin" required="true" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input type="text" name="skype" label="Skype"
                                value="{{ $employer->skype ?? '' }}" placeholder="skype" required="true" />
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



                        <div class="col-md-12 mt-2">
                            <x-form.textarea name="address" label="Address" required="true"
                                value="{{ $employer->address ?? '' }}" />
                        </div>

                        <div class="col-md-6 mt-2">
                            <x-form.textarea name="about_us" label="About Us" required="true"
                                value="{{ $employer->about_us ?? '' }}" />
                        </div>

                        <div class="col-md-6 mt-2">
                            <x-form.textarea name="company_vision" label="Company Vision" required="true"
                                value="{{ $employer->company_vision ?? '' }}" />
                        </div>


                        <div class="col-md-3 mt-4">
                            <label for="account_status">{{ 'Account Status' }} <span class="text-danger">*</span></label>
                            <select name="account_status" id="account_status" class="form-control">
                                <option value="activated"
                                    {{ $employer->account_status == 'activated' ? 'selected' : '' }}>Activated</option>

                                <option value="deactivated"
                                    {{ $employer->account_status == 'deactivated' ? 'selected' : '' }}>Deactivated</option>

                            </select>
                        </div>


                        <div class="col-md-3 mt-4">
                            <label for="status">{{ 'Comapny Verification Status' }} <span
                                    class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $employer->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>

                                <option value="verified" {{ $employer->status == 'verified' ? 'selected' : '' }}>Verified
                                </option>

                                <option value="rejected" {{ $employer->status == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </div>


                        <div class="col-md-6 mt-2" id="status_reason_div" style="display: none;">
                            <x-form.textarea name="status_reason" label="Account Rejection Reason" required="true"
                                value="{{ $employer->status_reason ?? '' }}" />
                        </div>


                        <div class="col-md-12 mt-lg-4 text-center">
                            <button type="submit" class="btn btn-primary">{{ 'Update Employer Profile' }}</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                if ($(this).attr("id") == "company" && $(this).is(":checked")) {
                    $("input[name='company_name']").closest('.col-md-12').show();
                } else {
                    $("input[name='company_name']").closest('.col-md-12').hide();
                }
            });


            // status_reason_div
            $('#status').change(function() {
                if ($(this).val() == 'rejected') {
                    $('#status_reason_div').show();
                } else {
                    $('#status_reason_div').hide();
                }
            });


        });
    </script>


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
        $('#about_us').wysihtml5({
            html: true
        });

        $('#company_vision').wysihtml5({
            html: true
        });

        $('#other_social_media').wysihtml5({
            html: true
        });

        $('#status_reason').wysihtml5({
            html: true
        });
    </script>
@endpush
