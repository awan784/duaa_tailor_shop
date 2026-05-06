@extends('admin.layout.interface')
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
                                    <h3>Edit User</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Edit User
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
                                <form action="{{route('user.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="put"/>
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Name</label>
                                            <input name="name" type="text" class="form-control {{ $errors->first('name', 'has-error') }}" id="name" placeholder="Name" value="{{$edit->name}}" required/>
                                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input name="email" type="email" class="form-control {{ $errors->first('email', 'has-error') }}" id="email" value="{{$edit->email}}" placeholder="Email" required/>
                                            {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="password">Password (Empty mean old password)</label>
                                            <input name="password" type="password" class="form-control {{ $errors->first('password', 'has-error') }}" id="password" placeholder="Password"/>
                                            {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
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
