@extends('frontend.main_master')
@section('main')
<script src="{{ asset('jquery/dist/jquery.js') }}"></script>
<!-- Inner Banner -->
<div class="inner-banner inner-bg6">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>User Dashboard </li>
            </ul>
            <h3>User Dashboard</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Service Details Area -->
<div class="service-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="service-side-bar">

                    <div class="services-bar-widget">
                        <h3 class="title">Others Services</h3>
                        @include('frontend.dashboard.menu')
                    </div>

                </div>
            </div>
            @php
            $id = Auth::user()->id;
            $profilData =App\Models\User::find($id);
            @endphp
            <div class="col-lg-9">
                <div class="service-article">

                    <section class="checkout-area pb-70">
                        <div class="container">
                            <form action="{{ route('user.profile.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-details">
                                            <h3 class="title">User Profile </h3>

                                            <div class="row">

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $profilData->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label> Email <span class="required">*</span></label>
                                                        <input type="text" name="email" class="form-control" value=" {{
                                                            $profilData->email }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" class="form-control" value="
                                                            {{$profilData->phone }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Address <span class="required">*</span></label>
                                                        <input type="text" name="address" class="form-control" value="{{
                                                            $profilData->address }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>User Profile <span class="required">*</span></label>
                                                        <input class="form-control" name="photo" type="file" id="image">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0"> </h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <img id="showImage"
                                                            src="{{ (!empty($profilData->photo)) ? url('upload/user_images/'.$profilData->photo) : url('upload/no_image.jpg') }}"
                                                            alt="Admin" class="p-1 rounded-circle bg-primary"
                                                            width="80">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-danger">Save Changes </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </section>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Service Details Area End -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection