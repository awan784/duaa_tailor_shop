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
                        Customers
                    </h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Darzi Shop </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('customers.index')}}">Customers</a>
                        </li>
                        <li class="breadcrumb-item active">
                          Ledger
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
                              <div class="white_box_tittle list_header align-items-end">
                                <div class="d-flex gap-5">
                                  <div>
                                    <h4>Account Summary</h4>
                                    <p>Customer: <strong>{{$customer->name}}</strong></p>
                                    <p>Total Debit: <strong>{{$customer->accountSummary['debit']}}</strong></p>
                                    <p>Total Credit: <strong>{{$customer->accountSummary['credit']}}</strong></p>
                                    <p>Total Remaining: <strong>{{$customer->accountSummary['remaining']}}</strong></p>
                                  </div>
                                  <div>
                                    <button type="button" class="btn btn-primary btn-sm openLedgerModal" data-transaction_type="credit">Add Credit</button>
                                    <button type="button" class="btn btn-primary btn-sm openLedgerModal" data-transaction_type="debit">Add Debit</button>
                                  </div>
                                </div>
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
                                </div>
                              </div>
                              <div class="QA_table mb_30">
                                <table class="table lms_table_active">
                                  <thead>
                                    <tr>
                                      <th scope="col">Sr#</th>
                                      <th scope="col">Date</th>
                                      <th scope="col">Type</th>
                                      <th scope="col">Reference no</th>
                                      <th scope="col">Debit</th>
                                      <th scope="col">Credit</th>
                                      <th scope="col">Balance</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php $balance = 0; @endphp
                                    @foreach ($customer->ledgers as $key => $ledger)
                                      @php
                                        $debit = 0; $credit = 0;
                                        if ($ledger->transaction_type == 'debit') {
                                          $debit = $ledger->amount;
                                          $balance -= $ledger->amount;
                                        }else{
                                          $credit = $ledger->amount;
                                          $balance += $ledger->amount;
                                        }
                                      @endphp
                                      <tr>
                                        <td>{{$key+1}}</td>
                                        <th scope="row">{{$ledger->created_at->format("m-d-Y")}}</th>
                                        <td>{{$ledger->detail}}</td>
                                        <td>{{$ledger->sale ? $ledger->sale->bill_no : ''}}</td>
                                        <td>{{$debit}}</td>
                                        <td>{{$credit}}</td>
                                        <td>{{$balance}}</td>
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
    <!-- TABLE END -->
    {{-- Add Customer Modals  --}}
    <div class="modal" id="addLedgerModal" tabindex="-1" aria-labelledby="addLedgerModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
          <form action="{{route('customer.ledger.store',$customer->id)}}" method="post" id="addLedgerForm">
            @csrf
              <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title" id="addLedgerModalLabel">
                      Add Ledger
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!-- Modal Body -->
                  <div class="modal-body">
                    <div class="form-group my-3">
                      <label class="form-label" for="amount">Amount</label>
                      <input name="amount" type="number" step="0.001" min="1" class="form-control" id="amount" placeholder="Amount" required />
                    </div>
                  </div>
                  <!-- Modal Footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Cancel
                    </button>
                    <input type="hidden" name="transaction_type" id="transaction_type">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(function() {
      $(".openLedgerModal").on("click", function(){
        var transaction_type = $(this).data("transaction_type");
        $("#addLedgerModal #amount").val("");
        $("#addLedgerModal #transaction_type").val(transaction_type);
        $("#addLedgerModal").modal("show");
      })
    });
  </script>
@endsection
