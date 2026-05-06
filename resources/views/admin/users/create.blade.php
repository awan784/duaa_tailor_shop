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
                                    <h3>Add Cash</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Add Cash
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
                                <form action="{{route('user.store')}}" method="post" id="UserForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Name</label>
                                            <input name="name" type="text" class="form-control {{ $errors->first('name', 'has-error') }}" id="name" placeholder="Name" required/>
                                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input name="email" type="email" class="form-control {{ $errors->first('email', 'has-error') }}" id="email" placeholder="Email" required/>
                                            {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input name="password" type="password" class="form-control {{ $errors->first('password', 'has-error') }}" id="password" placeholder="Password" required/>
                                            {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required/>
                                            <p class="text-danger error-message">Password and Confirm Password does not match!</p>
                                        </div>
                                    </div>
                                    <button type="submit" id="submitFormButton" class="btn btn-primary">
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

@section('js')
    <script>
        $(document).ready(function() {
            $('.error-message').hide();
            $('#UserForm').submit(function(e) {
                e.preventDefault();
                console.log(123123123);
                var password = $('#password').val();
                var confirmPassword = $('#confirm_password').val();

                if (password !== confirmPassword) {
                    $('.error-message').show();
                } else {
                    $('.error-message').hide();
                    $('#UserForm')[0].submit();
                }
            });
        });
    </script>
@endsection
