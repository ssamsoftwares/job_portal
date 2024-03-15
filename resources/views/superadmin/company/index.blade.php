@extends('partials.backend.app')
@section('adminTitle', 'Employers')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Employers</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Employers</li>
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
                {{-- <strong>{{ 'Product Filter' }}</strong> --}}
                <form action="{{route('admin.employers')}}" method="get">

                    <div class="row mt-lg-4">

                        <div class="col-md-4">
                            <x-form.select label="Organization Type" chooseFileComment="All"
                                name="organization_type" :options="$organizationType" selected="{{isset($_REQUEST['organization_type']) ? $_REQUEST['organization_type'] : ''}}" />
                        </div>

                        <div class="col-md-4">
                            <x-form.select label="Industry Type" chooseFileComment="All"
                                name="industry_type" :options="$industryType" selected="{{isset($_REQUEST['organization_type']) ? $_REQUEST['organization_type'] : ''}}" />

                        </div>

                        <div class="col-md-4">
                            <x-form.select label="Team Size" chooseFileComment="All" name="team_size"
                                :options="$teamSize" selected="{{isset($_REQUEST['organization_type']) ? $_REQUEST['organization_type'] : ''}}" />
                        </div>


                        <div class="col-md-4 mt-4">
                            <x-form.select name="account_status" label="Account Status" chooseFileComment="All" :options="[
                                'activated' => 'Activated',
                                'deactivated' => 'Deactivated',
                            ]"
                             :selected="isset($_REQUEST['account_status']) ? $_REQUEST['account_status'] : ''" />
                        </div>

                        <div class="col-md-4 mt-4">
                            <x-form.select name="verification_status" label="Status" chooseFileComment="All" :options="[
                                'pending' => 'pending',
                                'rejected' => 'Rejected',
                                'verified' => 'Verified',
                            ]"
                             :selected="isset($_REQUEST['verification_status']) ? $_REQUEST['verification_status'] : ''" />
                        </div>

                        <div class="col-md-4 mt-4">
                            <x-form.select name="employer_type" label="Employer Type" chooseFileComment="All" :options="[
                                'company' => 'Company',
                                'individual' => 'Individual',
                            ]"
                             :selected="isset($_REQUEST['employer_type']) ? $_REQUEST['employer_type'] : ''" />
                        </div>


                        <div class="col-md-6 mt-4">
                            <label for="search">Search</label>
                            <input type="search" name="search"
                            value="{{ isset($_REQUEST['search']) ? $_REQUEST['search'] : '' }}" class="form-control"
                            placeholder="Search.....">
                        </div>


                        <div class="col-md-2 mt-2"><br>
                            <input type="submit" class="btn btn-success btn-sm mt-4" value="Filter">
                            <a href="{{route('admin.employers')}}" class="btn btn-secondary btn-sm mt-4">{{'Reset'}}</a>
                        </div>

                    </div>
                </form>

                <br>
                <hr>
                <div class="row mt-lg-4">
                    <div class="col-md-8">
                        <h4 class="text-blue h4"></h4>
                        <a href="{{ route('admin.employer.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            Add New </a>

                    </div>

                    <div class="col-md-4">
                        {{-- <form action="{{ route('admin.employers') }}" method="get">
                            <div class="justify-content-end d-flex">
                                <input type="search" name="search"
                                    value="{{ isset($_REQUEST['search']) ? $_REQUEST['search'] : '' }}" class="form-control"
                                    placeholder="Search.....">
                                <button type="submit" class="btn btn-primary btn-sm">{{ 'Search' }}</button>
                            </div>
                        </form> --}}
                    </div>
                </div>

            </div>
            <div class="pb-20">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>{{ '#' }}</th>
                                <th>{{ 'Logo' }}</th>
                                <th>{{ 'Comapny Name' }}</th>
                                <th>{{ 'Establishment Date' }}</th>
                                <th>{{ 'Employer Type' }}</th>
                                <th>{{ 'Organization Type' }}</th>
                                <th>{{ 'Industry Type' }}</th>
                                {{-- <th>{{ 'Address' }}</th> --}}
                                <th>{{ 'Account Status' }}</th>
                                <th>{{ 'Status' }}</th>
                                <th>{{ 'Action' }}</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($employers as $emp)
                                <tr>

                                    <td>
                                        {{ ($employers->currentPage() - 1) * $employers->perPage() + $loop->index + 1 }}
                                    </td>

                                    <td>
                                        @if (!empty($emp->logo))
                                            <img src="{{ asset($emp->logo) }}" alt="logo" width="85">
                                        @else
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ799fyQRixe5xOmxYZc3kAy6wgXGO-GHpHSA&usqp=CAU"
                                                alt="" width="85">
                                        @endif
                                    </td>

                                    <td>
                                        @if ($emp->employer_type == 'company')
                                            <strong>{{ Str::ucfirst($emp->company_name) }}</strong><br>
                                        @else
                                            <strong>{{ $emp->name }}</strong><br>
                                        @endif
                                        <span>{{ $emp->email }}</span>
                                    </td>


                                    <td>{{ \Carbon\Carbon::parse($emp->year_of_establishment)->format('d-M-Y') }}</td>

                                    <td>
                                        @if ($emp->employer_type == 'company')
                                            <span class="badge badge-primary">Comapny</span>
                                        @else
                                            <span class="badge badge-info">Individual</span>
                                        @endif

                                    </td>

                                    <td>{{ $emp->organizationType->organization_type ?? '-' }}</td>
                                    <td>{{ $emp->industryType->industry_type ?? '-' }}</td>

                                    {{-- <td>{!! wordwrap(strip_tags(Str::ucfirst($emp->address)), 50, "<br />\n", true) !!}
                                        <br>
                                    </td> --}}

                                    <td>
                                        @if ($emp->account_status == 'activated')
                                            <a href="{{ route('admin.employer.employerAccountStatusUpdate', $emp->id) }}"
                                                class="btn btn-success btn-sm"
                                                onclick="return confirm('Are you sure Deactivated This User')">Activated</a>
                                        @else
                                            <a href="{{ route('admin.employer.employerAccountStatusUpdate', $emp->id) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure Activated This User')">Deactivated</a>
                                        @endif

                                    </td>

                                    <td>
                                        @if ($emp->status == 'verified')
                                            <span class="badge badge-info">Verified</span>
                                        @elseif ($emp->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('admin.employer.edit', ['employer' => $emp->id]) }}"
                                            class="btn btn-primary btn-sm m-2"><i class="fa fa-pencil-square-o"></i></a>

                                        <a href="{{ route('admin.employer.delete', ['employer' => $emp->id]) }}"
                                            class="btn btn-danger btn-sm m-2"
                                            onclick="return confirm('Are you sure delete this employer')"><i
                                                class="fa fa-trash-o"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employers->appends(request()->query())->links() }}
                </div>

            </div>
        </div>

    </div>


@endsection


@push('script')
@endpush
