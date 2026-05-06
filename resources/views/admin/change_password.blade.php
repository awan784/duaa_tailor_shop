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
                                    <h3>Edit Profile</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i>Edit Profile
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
                                <form action="{{route('password.change.post')}}" id="editProfileForm" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="current_password">Current Password</label>
                                            <input name="current_password" type="password" class="form-control {{ $errors->first('current_password', 'has-error') }}" id="current_password" placeholder="Current Password" required />
                                            {!! $errors->first('current_password', '<span class="help-block text-danger">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="new_password">New Password</label>
                                            <input name="new_password" type="password" class="form-control {{ $errors->first('new_password', 'has-error') }}" id="new_password" placeholder="New Password" required />
                                            {!! $errors->first('new_password', '<span class="help-block text-danger">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="confirm_password">Confirm Password</label>
                                            <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required />
                                            <p class="text-danger error-message"></p>
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
@endsection

@section('js')
    <script>
        $(".error-message").hide();
        $("#editProfileForm").submit(function(e){
            e.preventDefault();
            if($("#new_password").val() !== $("#confirm_password").val()){
                $(".error-message").text("New password does not match with confirm password.");
                $(".error-message").show();
            } else {
                this.submit();
            }
        });
    </script>
@endsection


