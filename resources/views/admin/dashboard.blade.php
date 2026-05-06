@extends('admin.layout.interface')
@section('content')
    <div class="main_content_iner overly_inner">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex align-items-center justify-content-between">
                        <div class="page_title_left">
                            <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Darzi Shop</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0);">Dashboard</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white_card pt-4">
                <div class="row mx-auto w-100">
                    <div class="col-lg-4 mb-4">
                        <div class="card text-white bg-customers">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Customers</h5>
                                    <p class="card-text">Total: {{$cardCount['totalCustomers']}}</p>
                                </div>
                                <div class="icon"><i class="fas fa-users"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card text-white bg-companies">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Stocks</h5>
                                    <p class="card-text">Total: {{$cardCount['totalStocks']}}</p>
                                </div>
                                <div class="icon"><i class="fas fa-building"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 mb-4">
                        <div class="card text-white bg-drivers">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Drivers</h5>
                                    <p class="card-text">Total: {{$cardCount['totalDrivers']}}</p>
                                </div>
                                <div class="icon"><i class="fas fa-truck"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card text-white bg-cash-payment">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Cash Payment</h5>
                                    <p class="card-text">Today: {{$cardCount['todayCashPayment']}}</p>
                                </div>
                                <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card text-white bg-cash-received">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Cash Received</h5>
                                    <p class="card-text">Today: {{$cardCount['todayCashReceive']}}</p>
                                </div>
                                <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            border: 0px;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: white;
        }

        .card-text {
            font-size: 1rem;
            color: white;
        }

        .card-body .icon {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 50%;
            color: #1cc7b4;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card-body .icon i {
            font-size: 28px;
            padding: 5px;
        }

        .bg-customers {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .bg-companies {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .bg-drivers {
            background: linear-gradient(135deg, #fa709a 0%, #fe4052 100%);
        }

        .bg-cash-received {
            background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        }

        .bg-cash-payment {
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
        }
    </style>
@endsection
