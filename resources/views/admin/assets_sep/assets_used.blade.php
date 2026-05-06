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
                                    <h3>Add Assets</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Add Use Assets
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
                                <form action="{{route('assets.used.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                      <div class="col-md-6 mt-3">
                                        <label class="form-label" for="asset_id">Asset Name</label>
                                        <select name="assets_id" id="asset_id" class="form-control" required>
                                            <option value="">-- Select Asset --</option>
                                            @foreach($assets as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                      
                                      <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Quantity</label>
                                            <input name="qty" type="text" class="form-control" id="name" placeholder="Qty" required />
                                        </div>
                                      
                                      <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Date</label>
                                            <input name="used_date" type="date" class="form-control" id="name" placeholder="Name" />
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