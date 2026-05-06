@extends('admin.layout.interface')

    {{-- select2 css --}}
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin-assets/css/sale-page.css')}}">
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
                                    <h3>Add Sale</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p>
                                        <a href="{{ url('dashboard') }}">Dashboard</a>
                                        <i class="fas fa-caret-right"></i> Add Sale
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
                                <form action="{{route('sales.store')}}" method="post" enctype="multipart/form-data" id="salesForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="customer_id">Customer Name</label>
                                            <div class="d-flex">
                                                <select name="customer_id" class="form-control" id="customer_id" required>
                                                    <option></option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6 mt-3">
                                            <label class="form-label" for="tailor_id">Tailor Name</label>
                                            <div class="d-flex">
                                                <select name="tailor_id" class="form-control" id="tailor_id" required>
                                                    <option></option>
                                                    @foreach ($tailors as $tailor)
                                                        <option value="{{$tailor->id}}">{{$tailor->name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#addTailorModal">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="date">Delivery Date</label>
                                            <input name="date" type="date" value="{{date('Y-m-d')}}" class="form-control" id="date" placeholder="Delivery Date" required/>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="bill_no">Bill No</label>
                                            <input name="bill_no" type="text" value="{{$bill_no}}" class="form-control" id="bill_no" placeholder="Bill No" readonly/>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label" for="status">Status</label>
                                            <select name="status" class="form-control select2-select" id="status" required>
                                                <option value="Inprocessing">Inprocessing</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                      
                                       <div class="col-md-6 mt-3">
                                            <label class="form-label" for="status">Category</label>
                                            <select name="category_id" class="form-control select2-select" id="category_id" required>
                                                <option value="">Select Category</option>
                                                 @foreach ($category as $cat)

                                                        <option value="{{$cat->id}}">
                                                          {{$cat->name}}
                                                        </option>

                                                @endforeach

                                            </select>
                                        </div>
                                      
                                                                 <div class="col-md-6 mt-3">
                                  <label class="form-label" for="sub_category_id">Sub Category</label>
                                  <select name="sub_category" class="form-control select2-select" id="sub_category" required>
                                      <option value="">Select a subcategory</option>
                                  </select>
                              </div>
                                      
                                      
                                        <div class="col-md-12 mt-3">
                                            <label class="form-label" for="product_id">Products</label>
                                            <select name="" class="form-control" id="product_id" data-type="product">
                                            <option value="">Select Product</option>
                                            </select>
                                        </div>
                                      
                                           <div class="col-md-12 mt-3">
                                            <label class="form-label" for="expense_id">Expense</label>
                                            <select name="" class="form-control" id="expense_id" data-type="expense">
                                                <option></option>
                                                @foreach ($expense as $stock)

                                                        <option value="{{$stock->id}}" data-name="{{$stock->name}}" data-price="{{$stock->sale_price}}" data-quantity="{{$stock->remaining_quantity()}}">
                                                            {{$stock->name}}
                                                        </option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <table class="table table-striped table-light table-hover mt-4" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>SKU</th>
                                                        <th>Net Unit Price</th>
                                                        <th>Qty</th>
                                                        <th>Subtotal ($)</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row w-100 mx-auto justify-content-end">
                                                <div class="col-lg-5 col-md-6 px-0 sale-cost-card">
                                                    <div class="form-group row">
                                                        <label class="col-sm-6 col-form-label">Sub Total</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="sub_total" id="subtotal" class="form-control text-end" value="0" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-6 col-form-label">Labour cost/charges</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="labour_cost" id="labour_cost" class="form-control" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-6 col-form-label">Discount</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="discount" id="discount" class="form-control" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-6 col-form-label"><strong>Net Total</strong></label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="net_total" id="net_total" class="form-control text-end" value="0" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-6 col-form-label">Cash Received</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="cash_received" id="cash_received" class="form-control" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="products" id="products" value="">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FORM END -->
    {{-- Add Customer Modals  --}}
    <div class="modal" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="" id="addCustomerForm">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="addCustomerModalLabel">
                        Add Customer
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
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
                                <textarea name="address" id="address" class="form-control" rows="2" placeholder="Address"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>                           
    {{-- Add Tailor Modals  --}}
    {{-- <div class="modal" id="addTailorModal" tabindex="-1" aria-labelledby="addTailorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="" id="addTailorForm">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="addTailorModalLabel">
                        Add Tailor
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6 mt-3">
                                <label class="form-label" for="name">Tailor Name</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Tailor Name" required />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label" for="email">Tailor Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Tailor Email" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label" for="phone">Tailor Number</label>
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="Tailor Number" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label" for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="2" placeholder="Address"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('admin-assets/js/sale-page.js')}}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#addCustomerForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Serialize form data
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{route('customer.add')}}", // Update with your API endpoint
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Assuming your server returns the newly added customer data
                        console.log(response);
                        
                        if (response.success) {
                            // Append the new customer option to the select
                            $('#customer_id').append(new Option(response.customer.name, response.customer.id, true, true)).trigger('change');
                            
                            // Reset the form
                            $('#addCustomerForm')[0].reset();
                            $('.select2-select').select2(); // Re-initialize select2

                            // Close the modal
                            $('#addCustomerModal').modal('hide');
                        } else {
                            // Handle error response (optional)
                            alert('Error saving customer: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        // Handle AJAX error
                        alert('An error occurred while saving the customer.');
                    }
                });
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#addTailorForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Serialize form data
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{route('tailor.add')}}", // Update with your API endpoint
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Assuming your server returns the newly added tailor data
                        console.log(response);
                        
                        if (response.success) {
                            // Append the new tailor option to the select
                            $('#tailor_id').append(new Option(response.tailor.name, response.tailor.id, true, true)).trigger('change');
                            
                            // Reset the form
                            $('#addTailorForm')[0].reset();
                            $('.select2-select').select2(); // Re-initialize select2

                            // Close the modal
                            $('#addTailorModal').modal('hide');
                        } else {
                            // Handle error response (optional)
                            alert('Error saving tailor: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        // Handle AJAX error
                        alert('An error occurred while saving the tailor.');
                    }
                });
            });
        });
    </script> --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize all select2-select elements on page load
    $('.select2-select').select2();
 
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
                    // Re-initialize select2 for subcategory dropdown
                    $('#sub_category').select2();
                })
                .catch(error => {
                    console.error('Error fetching subcategories:', error);
                    subCategorySelect.innerHTML = '<option value="">Error loading</option>';
                    // Re-initialize select2 even on error
                    $('#sub_category').select2();
                });

    });
$('#sub_category').on('change', function () {
    const categoryId = $('#category_id').val();
    const subCategoryId = $(this).val();

    if (!categoryId || !subCategoryId) {
        return;
    }

    $('#product_id').html('<option value="">Loading...</option>');

    fetch(`{{ url('/get-products') }}/${categoryId}/${subCategoryId}`)
        .then(response => response.json())
        .then(data => {
            let options = '<option value="">Select Product</option>';
            data.forEach(function (product) {
                options += `<option value="${product.id}" data-name="${product.name}" data-price="${product.purchase_price}" data-quantity="${product.remaining_quantity}" data-sku="${product.sku}">
                    ${product.name} (price: ${product.purchase_price}, Qty: ${product.remaining_quantity}, Sku: ${product.sku})
                </option>`;
            });

            // ✅ Correct jQuery + Select2 update
            $('#product_id').html(options).trigger('change.select2');
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            $('#product_id').html('<option value="">Error loading products</option>').trigger('change.select2');
        });
});
});
  
</script>
@endsection