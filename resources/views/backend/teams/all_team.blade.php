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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Facebook</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($teams as $team )
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>{{ $tem->image }}</td>
                            <td>{{ $teme->name }}</td>
                            <td>{{ $teme->position }}</td>
                            <td>{{ $teme->facebook }}</td>
                            <td>
                                <span>
                                    <a href="" class="btn btn-danger"></a>
                                </span>
                            </td>

                        </tr>

                    </tbody>
                    @endforeach

                    {{-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>

</div>

@endsection