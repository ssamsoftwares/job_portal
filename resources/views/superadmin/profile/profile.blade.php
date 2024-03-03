@extends('partials.backend.app')
@section('adminTitle', 'Superadmin Profile')
@section('content')


    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Personal Details</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
        {{-- <x-status-message /> --}}
        <!-- Profile Start -->
        <div class="pd-20 card-box mb-30">


            <form method="post" action="{{ route('admin.profile.update') }}" type="multfor" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <x-form.input name="name" label="Name" :value="$user->name" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="mobile_number" label="Phone Number" :value="$user->mobile_number" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="email" label="Email" :value="$user->email" />
                    </div>

                    <div class="col-md-12">
                        <x-form.input name="address" label="Address" :value="$user->address" />
                    </div>

                    {{-- Profile Image --}}
                    <div class="col-lg-8 mt-lg-4">
                        <label for="">{{ 'Profile Image' }} <span class="text-danger">*</span></label>
                        <input type="file" accept="image/*" name="profile_image" id="profile_image" class="form-control"
                            onchange="loadFile(event)">
                    </div>

                    <div class="col-lg-4 mt-lg-4">
                        @if (!empty($user->profile_image))
                            <img src="{{ asset($user->profile_image) }}" class="mt-lg-4 rounded-circle" id="output" alt="" style="max-width: 50%; max-height: 100px;">
                        @else
                            <img src="" id="output" alt="" class="mt-lg-4 rounded-circle"
                                style="max-width: 50%; max-height: 50%;">
                        @endif
                    </div>

                </div>

                <div class="text-center mt-lg-4">
                    <input type="submit" class="btn btn-primary" value="Save Profile">
                </div>

            </form>
            </code></pre>
        </div>


        {{-- Chnage Password --}}

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">{{ 'Chnage Password' }}</h4>
                </div>
            </div>
            <form method="post" action="{{ route('profile.update_password') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <x-form.input type="password" name="password" label="Password" />
                    </div>
                    <div class="col-md-6">
                        <x-form.input type="password" name="password_confirmation" label="Confirm Password" />
                    </div>
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">{{ __('Change Password') }}</button>
                </div>
            </form>
        </div>


    </div>

@endsection


@push('script')
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
@endpush
