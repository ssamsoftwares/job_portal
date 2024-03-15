@extends('partials.backend.app')
@section('adminTitle', 'Job List')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Job List</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Jobs</li>
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
                <form action="{{route('admin.jobPost')}}" method="get">

                    <div class="row mt-lg-4">
                        <div class="col-md-6 mt-4">
                            <label for="search">Search</label>
                            <input type="search" name="search"
                            value="{{ isset($_REQUEST['search']) ? $_REQUEST['search'] : '' }}" class="form-control"
                            placeholder="Search.....">
                        </div>


                        <div class="col-md-2 mt-2"><br>
                            <input type="submit" class="btn btn-success btn-sm mt-4" value="Filter">
                            <a href="{{route('admin.jobPost')}}" class="btn btn-secondary btn-sm mt-4">{{'Reset'}}</a>
                        </div>

                    </div>
                </form>

                <br>
                <hr>
                <div class="row mt-lg-4">
                    <div class="col-md-8">
                        <h4 class="text-blue h4"></h4>
                        <a href="{{ route('admin.jobPost.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            Add New </a>

                    </div>
                </div>

            </div>
            <div class="pb-20">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>{{ '#' }}</th>
                                <th>{{ 'Job' }}</th>
                                <th>{{ 'Category/Role' }}</th>
                                <th>{{ 'Salary' }}</th>
                                <th>{{ 'Deadline' }}</th>
                                <th>{{ 'Status' }}</th>
                                <th>{{ 'Create By' }}</th>
                                <th>{{ 'Action' }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobPosts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}} <br>
                                    {{$post->company->name}} - {{$post->job_working_type}}
                                </td>

                                <td> {{$post->jobCategory->category}} <br>
                                    {{$post->jobRole->job_role}}
                                </td>

                                <td>{{ $post->minimum_salary}} - {{$post->maximum_salary}} <br>
                                    {{ $post->salaryType->salary_type}}
                                </td>
                                <td>{{ date('d-M-Y', strtotime($post->deadline)) }} </td>

                                <td>
                                    @if ($post->status == 'active')
                                    <a href="{{route('admin.jobPost.status',['id'=>$post->id])}}" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure Block This User')">Active</a>
                                    @else
                                    <a href="{{route('admin.jobPost.status',['id'=>$post->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure Active This User')">Block</a>
                                    @endif
                                </td>
                                <td>
                                    {{$post->createBy->name}}
                                </td>

                                <td>
                                    <a href="{{route('admin.jobPost.view',['jobPost'=>$post->id])}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('admin.jobPost.delete',['jobPost'=>$post->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete this post!')"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $jobPosts->appends(request()->query())->links() }}
                </div>

            </div>
        </div>

    </div>


@endsection


@push('script')
@endpush
