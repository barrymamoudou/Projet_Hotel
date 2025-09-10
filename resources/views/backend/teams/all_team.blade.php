@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <a href="{{ route('add.team') }}" class="px-5 btn btn-outline-primary radius-30">Add Team</a>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Team</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Facebook</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($teams as $key => $team )
                    <tbody>
                        <tr>
                            <td>{{ $key+1 }}</td>

                            <td>
                                <img src="{{ asset(  $team->image) }}" alt="Image" width="70" ; height="40px">

                            </td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->position }}</td>
                            <td>
                                <a href="{{ $team->facebook }}" target="_blank">
                                    {{ $team->facebook }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('team.edit', $team->id) }}"
                                    class="px-3 btn btn-warning radius-30 ">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>

                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>

@endsection