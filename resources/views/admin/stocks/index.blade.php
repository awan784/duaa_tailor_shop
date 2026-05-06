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
                                <!-- <h3 class="m-0">Data table</h3> -->
                              </div>
                            </div>
                          </div>
                          <div class="white_card_body">
                            <div class="QA_section">
                              <div class="white_box_tittle list_header">
                                <h4></h4>
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
                                    <a
                                      href="{{route('stocks.create')}}"
                                      class="btn_1"
                                      >Add New</a
                                    >
                                  </div>
                                </div>
                              </div>
                              <div class="QA_table mb_30">
                                <table class="table lms_table_active">
                                  <thead>
                                    <tr>
                                      <th scope="col">Sr#</th>
                                      <th scope="col">Image</th>
                                      <th scope="col">Sku</th>
                                      <th scope="col">Product Name</th>
                                      <th scope="col">Category</th>
                                      <th scope="col">Subcategory</th>
                                      <th scope="col">Purchase Price</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($totalData as $key => $data)
                                      <tr class="{{$data->remaining_quantity() <= 0 ? 'bg-danger childDivColorWhite' : '' }}">
                                        <td>{{$key+1}}</td>

                                       <td>
                                        @if(!empty($data->images))
                                            @php
                                                $images = json_decode($data->images, true);
                                            @endphp
                                         @foreach($images as $image)
    <a href="{{ asset($image) }}" target="_blank">
        <img src="{{ asset($image) }}" alt="image" width="40" height="40" style="object-fit: cover; margin-right: 5px;">
    </a>
@endforeach
                                        @else
                                            <span>No image</span>
                                        @endif
                                    </td>
                                                                               <td>{{$data->sku}}</td>
                                        <th scope="row">{{$data->name}}</th>
                                        <th scope="row">{{$data->category ? $data->category->name : ''}}</th>
                                        <th scope="row">
                                            @if(isset($data->subcategory_name) && $data->subcategory_name)
                                                {{$data->subcategory_name}}
                                            @elseif(isset($data->subcategory) && $data->subcategory)
                                                {{$data->subcategory->name}}
                                            @elseif($data->sub_category)
                                                @php
                                                    $subcategory = \App\Models\StockSubCategory::find($data->sub_category);
                                                @endphp
                                                {{$subcategory ? $subcategory->name : '-'}}
                                            @else
                                                -
                                            @endif
                                        </th>
                                        <th scope="row">{{$data->purchase_price}}</th>
                                        <th scope="row">{{$data->remaining_quantity()}}</th>

                                        @auth
                                                  @if(auth()->user()->user_type == 1)
                                        <td class="td-width">
                                          <a href="{{ route('stocks.edit',$data->id)}}" class="btn btn-dark btn-sm">
                                            <i class="fa fa-edit"></i>
                                          </a>
                                          <a type="button" class="btn btn-danger btn-sm modalDeleteButton" data-form-action="{{url('stocks/'.$data->id)}}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal1">
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </td>
                                        @endif
                                        @endauth
                                      </tr>
                                    @endforeach
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
