@extends('admin.layout.interface')
@section('content')
    <!-- TABLE START -->
    <div class="main_content_iner overly_inner">
        <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div
                    class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">
                        Stocks
                    </h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Darzi Shop </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            Report
                        </li>
                        <li class="breadcrumb-item active">
                            Stocks
                        </li>
                    </ol>
                    </div>
                    <!-- <a href="#" class="white_btn3">Add Company</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              <div class="white_card">
                <div class="card-body">
                  <div class="container-fluid p-0">
                    <div class="row justify-content-center">
                      <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                          <div class="white_card_header">
                            <div class="m-0">
                              <div class="main-title">
                                <h4 class="px-4">Stock Report Filter</h4>
                              </div>
                            </div>
                          </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <form action="" method="get" class="d-flex gap-2 justify-content-between">
                                        <div class="input-group align-items-center">
                                          <label for="">From:</label>
                                          <input type="date" class="form-control ms-2" value="{{ request('started_date') }}" name="started_date" required>
                                        </div>
                                        <div class="input-group align-items-center">
                                          <label for="">To:</label>
                                          <input type="date" class="form-control ms-2" value="{{ request('ended_date') }}" name="ended_date" required>
                                        </div>
                                      
                                      <div class="input-group align-items-center">
                                        <label for="category">Category:</label>
                                        <select name="category" id="category" class="form-control ms-2">
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                        
                                        
                                      
                                        <div class="add_button">
                                          <button type="submit" class="btn_1">Report</button>
                                        </div>
                                    </form>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                            <form action="#">
                                                <div class="search_field">
                                                <input type="text" placeholder="Search content here..." id="customSearchDataTable"/>
                                                </div>
                                                <button type="submit">
                                                <i class="ti-search"></i>
                                                </button>
                                            </form>
                                            </div>
                                        </div>
                                        <div class="add_button ms-2">
                                            <a href="{{ route('report.stock.print', request()->query()) }}" target="_blank" class="btn_1">Print</a>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($totalData))
                                <h4 style="text-align: right;">
                                 Total Price:{{$totalPurchasePrice}}
                                  </h4> 
                                  @endif
                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr#</th>
                                                <th scope="col">Images</th>
                                                <th scope="col">Sku</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Purchase Price</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($totalData))
                                                @foreach ($totalData as $key => $data)
                                                <tr class="{{$data->remaining_quantity() <= 0 ? 'bg-danger childDivColorWhite' : '' }}">
                                                    <td>{{$key+1}}</td>
                                                  <td>
    @php
        $images = json_decode($data->images, true); // decode to array
    @endphp

    @if (!empty($images) && is_array($images))
        @foreach ($images as $img)
            <a href="{{ asset($img) }}" target="_blank">
                <img src="{{ asset($img) }}" alt="Asset Image" width="100" height="50" class="img-thumbnail">
            </a>
        @endforeach
    @else
        <span>No Image</span>
    @endif
</td>
                                                    <td>{{$data->sku}}</td>
                                                    <th scope="row">{{$data->name}}</th>
                                                    <th scope="row">{{$data->category ? $data->category->name : ''}}</th>
                                                    <th scope="row">{{$data->unit ? $data->unit->name : ''}}</th>
                                                    <th scope="row">{{$data->remaining_quantity()}}</th>
                                                    <th scope="row">{{$data->purchase_price}}</th>


                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-12"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <style>
      .childDivColorWhite > *{
        color: #fff !important;
      }
    </style>
    <!-- TABLE END -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#printButton').click(function(e) {
                e.preventDefault(); // Prevent the default anchor behavior
                
                // Get URL parameters
                const urlParams = new URLSearchParams(window.location.search);
                const startedDate = urlParams.get('started_date');
                const endedDate = urlParams.get('ended_date');
                
                // Construct the print URL
                let printUrl = "{{ route('report.stock.print') }}";
                
                // If start_date and end_date exist, add them to the URL
                if (startedDate && endedDate) {
                    printUrl += `?started_date=${startedDate}&ended_date=${endedDate}`;
                    window.open(printUrl, '_blank');
                }
            });
        });
    </script>
@endsection