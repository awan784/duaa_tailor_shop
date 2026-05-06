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
                                    <h3>Add Customers</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Add Customers
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
                                <form action="{{route('customers.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Customer Name</label>
                                            <input name="name" type="text" class="form-control" id="name" placeholder="Customer Name" required />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="email">Customer Email</label>
                                            <input name="email" type="email" class="form-control" id="email" placeholder="Customer Email" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="phone">Customer Number</label>
                                            <input name="phone" type="text" class="form-control" id="phone" placeholder="Customer Number" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Address"></textarea>
                                        </div>
                                        <!-- Additional Fields -->
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="neck">Neck</label>
                                            <input name="neck" type="text" class="form-control" id="neck" placeholder="Neck" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="shoulders">Shoulders</label>
                                            <input name="shoulders" type="text" class="form-control" id="shoulders" placeholder="Shoulders" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="sleeve_length">Sleeve Length</label>
                                            <input name="sleeve_length" type="text" class="form-control" id="sleeve_length" placeholder="Sleeve Length" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="length">Length</label>
                                            <input name="length" type="text" class="form-control" id="length" placeholder="Length" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="sleeve_opening">Sleeve Opening</label>
                                            <input name="sleeve_opening" type="text" class="form-control" id="sleeve_opening" placeholder="Sleeve Opening" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="chest">Chest</label>
                                            <input name="chest" type="text" class="form-control" id="chest" placeholder="Chest" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="waist">Waist</label>
                                            <input name="waist" type="text" class="form-control" id="waist" placeholder="Waist" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="hips">Hips</label>
                                            <input name="hips" type="text" class="form-control" id="hips" placeholder="Hips" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="Asaan">Asaan</label>
                                            <input name="Asaan" type="text" class="form-control" id="Asaan" placeholder="Asaan" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="Thighs">Thighs</label>
                                            <input name="Thighs" type="text" class="form-control" id="Thighs" placeholder="Thighs" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="bottom_length">Bottom Length</label>
                                            <input name="bottom_length" type="text" class="form-control" id="bottom_length" placeholder="Bottom Length" />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="mori">Mori</label>
                                            <input name="mori" type="text" class="form-control" id="mori" placeholder="Mori" />
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
