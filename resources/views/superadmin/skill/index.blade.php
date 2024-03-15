@extends('partials.backend.app')
@section('adminTitle', 'Job skills List')
@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Job skills List</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <div class="col-md-6 col-sm-12">
                                <li class="breadcrumb-item active" aria-current="page">Jobs skills</li>
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
                <form action="{{ route('admin.skills') }}" method="get">

                    <div class="row mt-lg-2 d-flex justify-content-end">
                        <div class="col-md-4 mt-4">
                            <input type="search" name="search"
                                value="{{ isset($_REQUEST['search']) ? $_REQUEST['search'] : '' }}" class="form-control"
                                placeholder="Search.....">
                        </div>

                        <div class="col-md-2"><br>
                            <input type="submit" class="btn btn-success btn-sm" value="Search">
                            <a href="{{ route('admin.skills') }}"
                                class="btn btn-secondary btn-sm">{{ 'Reset' }}</a>
                        </div>

                    </div>
                </form>

                <div class="row mt-lg-2">
                    <div class="col-md-8">
                        <h4 class="text-blue h4"></h4>
                        <a href="javascript:void(0)" onclick="addSkill()" class="btn btn-primary"><i
                                class="fa fa-plus"></i>
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
                                <th>{{ 'Skill' }}</th>
                                <th>{{ 'Status' }}</th>
                                <th>{{ 'Action' }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skills as $skill)
                                <tr>
                                    <td>{{ $skills->perPage() * ($skills->currentPage() - 1) + $loop->index + 1 }}
                                    </td>

                                    <td>
                                        {{ $skill->skill }}
                                    </td>

                                    <td>
                                        @if ($skill->status == 'active')
                                            <a href="{{ route('admin.skill.status', ['skill' => $skill->id]) }}"
                                                class="btn btn-primary btn-sm"
                                                onclick="return confirm('Are you sure Block This skill')">Active</a>
                                        @else
                                            <a href="{{ route('admin.skill.status', ['skill' => $skill->id]) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure Active This skill')">Block</a>
                                        @endif
                                    </td>


                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-info btn-sm"
                                            onclick="editSkill(<?= $skill->id ?>)">
                                            <i class="fa fa-pencil-square"></i>
                                        </a>

                                        <a href="{{ route('admin.skill.delete', ['skill' => $skill->id]) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure delete this skill!')"><i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $skills->appends(request()->query())->links() }}
                </div>

            </div>
        </div>

    </div>


    {{-- SKILL Add Model --}}
    <div class="modal fade" id="addSkillModel" tabindex="-1" aria-labelledby="addSkillModelLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.skill.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Job Skill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" name="skill" value="{{ old('skill') }}"
                                    placeholder="Enter The Job Role" class="form-control" required>
                                <span class="text-danger">
                                    @error('skill')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <label for="">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="block">Block</option>
                                </select>

                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Job Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- SKILL Edit Model --}}
    <div class="modal fade" id="editSkillModel" tabindex="-1" aria-labelledby="editSkillModel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.skill.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Job Skill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" name="skill" value=""
                                    placeholder="Enter The Job skill" class="form-control" required>
                                <span class="text-danger">
                                    @error('skill')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <label for="">Status</label>
                                <select name="status" id="editstatus" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="block">Block</option>
                                </select>

                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Job Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@push('script')
    {{-- Add SKILL --}}
    <script>
        function addSkill() {
            $('#addSkillModel').modal('show');
        }
    </script>

    <script>
        // Edit SKILL
        function editSkill(skill_id) {
            let url = `{{ url('/admin/job-skill-edit/${skill_id}') }}`
            // console.log("Req URL: ", url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(skills) {
                    console.log("res", skills)
                    let model = $('#editSkillModel')

                    $('input[name="id"]').val(skills.data.id);
                    $('input[name="skill"]').val(skills.data.skill);

                    $('#editstatus').val(skills.data.status);
                    model.modal("show");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endpush
