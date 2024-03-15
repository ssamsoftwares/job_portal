@extends('partials.backend.app')
@section('adminTitle', 'Candidates')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Candidates</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Candidates</li>
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

                <div class="row mt-lg-4">
                    <div class="col-md-8">
                        <h4 class="text-blue h4"></h4>
                        <a href="{{ route('admin.candidate.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            Add New </a>

                    </div>

                    <div class="col-md-4">
                        <form action="{{ route('admin.candidates') }}" method="get">
                            <div class="justify-content-end d-flex">
                                <input type="search" name="search"
                                    value="{{ isset($_REQUEST['search']) ? $_REQUEST['search'] : '' }}" class="form-control"
                                    placeholder="Search.....">
                                <button type="submit" class="btn btn-primary btn-sm">{{ 'Search' }}</button>
                                <a href="{{ route('admin.candidates') }}" class="btn btn-secondary m-1">{{'Reset'}}</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="pb-20">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>{{ '#' }}</th>
                                <th>{{ 'Image' }}</th>
                                <th>{{ 'Candidate' }}</th>
                                <th>{{ 'Role/Experience' }}</th>
                                <th>{{ 'Account Status' }}</th>
                                <th>{{ 'Created Date' }}</th>
                                <th>{{ 'Action' }}</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($candidates as $can)
                                <tr>

                                    <td>
                                        {{ ($candidates->currentPage() - 1) * $candidates->perPage() + $loop->index + 1 }}
                                    </td>

                                    <td>
                                        @if (!empty($can->profile_image))
                                            <img src="{{ asset($can->profile_image) }}" alt="logo" width="85">
                                        @else
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ799fyQRixe5xOmxYZc3kAy6wgXGO-GHpHSA&usqp=CAU"
                                                alt="" width="85">
                                        @endif
                                    </td>

                                    <td>
                                        <strong>{{ $can->name }}</strong><br>
                                        <span>{{ $can->email }}</span>
                                    </td>

                                    <td>
                                        <strong>{{ $can->jobRole->job_role }}</strong><br>
                                        <span>Exp. - {{ $can->experience->experiences }}</span>
                                    </td>



                                    <td>
                                        @if ($can->account_status == 'activated')
                                            <a href="{{ route('admin.candidate.accountStatus', $can->id) }}"
                                                class="btn btn-success btn-sm"
                                                onclick="return confirm('Are you sure Deactivated This Candidate')">Activated</a>
                                        @else
                                            <a href="{{ route('admin.candidate.accountStatus', $can->id) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure Activated This Candidate')">Deactivated</a>
                                        @endif

                                    </td>


                                    <td>{{ \Carbon\Carbon::parse($can->created_at)->format('d-M-Y') }}</td>

                                    <td>

                                      <a href="{{ route('admin.candidate.view', ['candidate_id' => $can->id]) }}"
                                            class="btn btn-primary btn-sm m-2"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('admin.candidate.delete', ['candidate' => $can->id]) }}"
                                            class="btn btn-danger btn-sm m-2"
                                            onclick="return confirm('Are you sure delete this candidate')"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $candidates->appends(request()->query())->links() }}
                </div>

            </div>
        </div>

    </div>


@endsection


@push('script')
@endpush
