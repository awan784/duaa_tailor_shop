@extends('admin.layout.interface')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <!-- FORM START -->
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard_header mb_50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dashboard_header_title">
                                    <h3>Edit Tailors</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Edit Tailors
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_body">
                            <div class="card-body">
                                <div class="white_card_header">
                                    <div class="box_header m-0">
                                        <div class="main-title">
                                            <h3 class="m-0">Info</h3>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('tailors.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="put" />
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Tailor Name</label>
                                            <input name="name" value="{{$edit->name}}" type="text" class="form-control" id="name" placeholder="Tailor Name" required />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="email">Tailor Email</label>
                                            <input name="email" value="{{$edit->email}}" type="email" class="form-control" id="email" placeholder="Tailor Email" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="phone">Tailor Number</label>
                                            <input name="phone" value="{{$edit->phone}}" type="text" class="form-control" id="phone" placeholder="Tailor Number" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Address">{{$edit->address}}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FORM END -->
@endsection
