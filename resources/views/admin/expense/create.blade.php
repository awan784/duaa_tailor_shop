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
                                    <h3>Add Stocks</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Add Expense
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
                                <form action="{{route('stocks.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="name">Expense Name</label>
                                            <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" placeholder="" required />
                                            <input name="expense" type="hidden" class="form-control" id="name" value="1" placeholder="" required />
                                            <input name="quantity" type="hidden" class="form-control" id="name" value="1" placeholder="" required />
                                        </div>
                                      
                                          <div class="col-md-6 mt-3" hidden>
                                            <label class="form-label" for="sku">SKU</label>
                                            <input name="sku" type="text" value="{{$sku}}" class="form-control {{ $errors->first('sku', 'has-error') }}" id="sku" placeholder="SKU" readonly/>
                                            {!! $errors->first('sku', '<span class="text-danger help-block">:message</span>') !!}
                                        </div>

                                    
<!--                                                <div class="col-md-6 mt-3">
                                  <label class="form-label" for="sub_category_id">Sub Category</label>
                                  <select name="sub_category" class="form-control" id="sub_category" required>
                                      <option value="">Select a subcategory</option>
                                  </select>
                              </div> -->
<!--                                                                   <div class="col-md-6 mt-3">
                                            <label class="form-label" for="purchase_price">Ware House</label>
                                            <input name="ware_house" type="text"  value="{{ old('purchase_price') }}" class="form-control" id="purchase_price" placeholder="Ware House" />
                                        </div> -->
<!--                                         <div class="col-md-6 mt-3">
                                            <label class="form-label" for="purchase_price">Purchase Price</label>
                                            <input name="purchase_price" type="number" step="0.0001" value="{{ old('purchase_price') }}" class="form-control" id="purchase_price" placeholder="Purchase Price" required/>
                                        </div> -->
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="sale_price">Price</label>
                                            <input name="sale_price" type="number" step="0.0001" class="form-control" id="sale_price" placeholder="Sale Price" required/>
                                        </div>
<!--                                         <div class="col-md-6 mt-3">
                                            <label class="form-label" for="quantity">Quantity</label>
                                            <input name="quantity" type="number" value="{{ old('quantity') }}" class="form-control" id="quantity" placeholder="Quantity" required />
                                        </div> -->
<!--                                          <div class="col-md-6 mt-3">
                                            <label class="form-label" for="detail">Detail</label>
                                            <textarea name="detail" id="detail" class="form-control" rows="3" placeholder="Detail"></textarea>
                                        </div>  -->

<!--                                         <div class="col-md-6 mt-3">
                                            <label class="form-label" for="images">Images</label>
                                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                                            <div id="imagesPreview" class="image-preview"></div>
                                        </div> -->
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
        .input-group .bootstrap-select {
            width: auto !important;
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
    </script>


<script>
document.addEventListener('DOMContentLoaded', function () {
 
    const categorySelect = document.getElementById('category_id');
    const subCategorySelect = document.getElementById('sub_category');
    $('#category_id').on('change', function () {
      
       const categoryId = $(this).val();
       const $subCategorySelect = $('#sub_category');

       $subCategorySelect.html('<option value="">Loading...</option>');
      
                fetch(`{{ url('/get-subcategories') }}/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                  console.log('data', data);
                    let options = '<option value="">Select a subcategory</option>';
                    data.forEach(function (subCategory) {
                        options += `<option value="${subCategory.id}">${subCategory.name}</option>`;
                    });
                    subCategorySelect.innerHTML = options;
                })
                .catch(error => {
                    console.error('Error fetching subcategories:', error);
                    subCategorySelect.innerHTML = '<option value="">Error loading</option>';
                });

    })
   
//         categorySelect.addEventListener('change', function () {
//            console.log('data oading----');
//             const categoryId = this.value;
//             subCategorySelect.innerHTML = '<option value="">Loading...</option>';

//             fetch(`/get-subcategories/${categoryId}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     let options = '<option value="">Select a subcategory</option>';
//                     data.forEach(function (subCategory) {
//                         options += `<option value="${subCategory.id}">${subCategory.name}</option>`;
//                     });
//                     subCategorySelect.innerHTML = options;
//                 })
//                 .catch(error => {
//                     console.error('Error fetching subcategories:', error);
//                     subCategorySelect.innerHTML = '<option value="">Error loading</option>';
//                 });
//         });
    
});
</script>
@endsection

