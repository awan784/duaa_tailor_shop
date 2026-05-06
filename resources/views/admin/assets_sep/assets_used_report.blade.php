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
                        Used Assets
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
                            Assets
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
                                <h4 class="px-4">Assets Report Filter</h4>
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
                                            <a href="{{ route('report.assets.print', request()->query()) }}" target="_blank" class="btn_1">Print</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr#</th>
                                                <th scope="col">Asset Name</th>
                                                <th scope="col">Used Qty</th>
                                                <th scope="col">Used Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($totalData))
                                                @foreach ($totalData as $key => $data)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                              <td>{{ $data->assets->name ?? 'N/A' }}</td>
                                                              <td>{{ $data->qty }}</td>
                                                              <td>{{ $data->used_date }}</td>

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
                let printUrl = "{{ route('report.assets.print') }}";
                
                // If start_date and end_date exist, add them to the URL
                if (startedDate && endedDate) {
                    printUrl += `?started_date=${startedDate}&ended_date=${endedDate}`;
                    window.open(printUrl, '_blank');
                }
            });
        });
    </script>
@endsection