@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <a href="{{ route('add.room.type') }}" class="px-5 btn btn-outline-primary radius-30">Add Type Chambre (RoomType) </a>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Type Chambre (RoomType)</h6>
    <hr />
    <div class="card">
        <div class="card-body" >
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            
                        </tr>
                    </thead>
                    @foreach ($allData as $key => $item)
                        @php
                            $rooms=App\Models\Room::where('roomtype_id',$item->id)->get();
                        @endphp
                    <tbody>
                        <tr>
                            <td>{{ $key+1 }}</td>
                                                        
                            <td>
                                <img src="{{ (!empty($item->room->image)) ? url('upload/roomimg/'.$item->room->image) : url('upload/no_image.jpg') }}" alt="" style="width: 50px; height:30px;">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @foreach ($rooms as $roo)
                                    <a href="{{ route('edit.room',$roo->id) }}" class="px-3 btn btn-warning radius-30">Edit</a>
                                    
                                    <a href="#" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                   
                                @endforeach
                                
                            </td>

                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    });
</script>

@endsection