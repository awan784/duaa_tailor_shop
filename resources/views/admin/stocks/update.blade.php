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
                                    <h3>Edit Stocks</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Edit Stocks
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
                                <form action="{{route('stocks.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="put" />
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Product Name</label>
                                            <input name="name" value="{{old('name') ? old('name') : $edit->name }}" type="text" class="form-control" id="name" placeholder="" required />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="category_id">Category</label>
                                            <select name="category_id" class="form-control" id="category_id" required>
                                                <option></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{ old('category_id', $edit->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="sku">SKU</label>
                                            <input name="sku" type="text" value="{{old('sku') ? old('sku') : $edit->sku }}" class="form-control {{ $errors->first('sku', 'has-error') }}" id="sku" placeholder="SKU" readonly/>
                                            {!! $errors->first('sku', '<span class="text-danger help-block">:message</span>') !!}
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="purchase_price">Purchase Price</label>
                                            <input name="purchase_price" value="{{old('purchase_price') ? old('purchase_price') : $edit->purchase_price }}" type="text" class="form-control" id="purchase_price" placeholder="Purchase Price" required/>
                                        </div>
                                       <div class="col-md-6 mt-3">
    <label class="form-label" for="sub_category">Sub Category</label>
    <select name="sub_category" class="form-control" id="sub_category" required>
        <option value="">Select a subcategory</option>
        @foreach ($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}" {{ $edit->sub_category == $subcategory->id ? 'selected' : '' }}>
                {{ $subcategory->name }}
            </option>
        @endforeach
    </select>
</div>
<!--                                           <div class="col-md-6 mt-3">
                                            <label class="form-label" for="purchase_price">Ware House</label>
                                            <input name="ware_house" type="text"  value="{{$edit->warehouse}}" class="form-control" id="purchase_price" placeholder="Ware House" />
                                        </div> -->

                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="quantity">Quantity</label>
                                            <input name="quantity" value="{{old('quantity') ? old('quantity') : $edit->quantity }}" type="quantity" class="form-control" id="quantity" placeholder="Quantity" required />
                                        </div>
                                        {{-- <div class="col-md-6 mt-3">
                                            <label class="form-label" for="detail">Detail</label>
                                            <textarea name="detail" id="detail" class="form-control" rows="3" placeholder="Detail">{{$edit->detail}}</textarea>
                                        </div> --}}
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="unit_id">Unit</label>
                                            <select name="unit_id" class="form-control" id="unit_id" required>
                                                <option></option>
                                                @foreach ($units as $unit)
                                                    <option value="{{$unit->id}}" {{ old('unit_id', $edit->unit_id) == $unit->id ? 'selected' : '' }}>{{$unit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            @if ($edit->images)
                                                <div class="form-group mt-3">
                                                    <input type="hidden" name="already_images" value="{{$edit->images}}">
                                                    <label for="">Already Uploaded Images</label>
                                                    <div id="existingImages" class="image-preview">
                                                        @foreach (json_decode($edit->images) as $image)
                                                            <div class="image-container">
                                                                <img src="{{ asset($image) }}" alt="Image">
                                                                <button type="button" class="btn btn-danger btn-sm remove-image" data-image="{{ $image }}"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group mt-3">
                                                <label class="form-label" for="images">Images</label>
                                                <input type="file"  name="images[]" id="images" class="form-control" multiple>
                                                <div id="imagesPreview" class="image-preview"></div>
                                            </div>
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
    
    <style>
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }
        .image-container {
            position: relative;
            display: inline-block;
        }
        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 2px 5px;
        }
    </style>
    <!-- FORM END -->
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#category_id').select2({
            placeholder: 'Choose Category',
            allowClear: true 
        });
        $('#unit_id').select2({
            placeholder: 'Choose Unit',
            allowClear: true 
        });
        
        
        document.getElementById('images').addEventListener('change', function() {
            previewImages(this, 'imagesPreview');
        });
        function previewImages(input, previewElementId) {
            const preview = document.getElementById(previewElementId);
            preview.innerHTML = ''; // Clear the existing images
            const files = input.files;

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                
                reader.readAsDataURL(file);
            });
        }
        $('.remove-image').click(function() {
                var image = $(this).data('image');
                var container = $(this).closest('.image-container');
                var inputField = container.closest('.form-group').find('input[type=hidden]');
                
                var images = JSON.parse(inputField.val());
                var index = images.indexOf(image);
                if (index !== -1) {
                    images.splice(index, 1);
                }
                inputField.val(JSON.stringify(images));
                container.remove();
            });
    </script>
@endsection