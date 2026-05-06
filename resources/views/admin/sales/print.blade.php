@php
    $customer = $sale->customer;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice - {{ $sale->bill_no }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 100%;
            width: 100%;
        }
        .invoice-box {
            padding: 30px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: auto;
            margin-top: 20px;
            background: #f9f9f9;
            width: 95%;
            /* min-height: 100vh; */
            position: relative;
            box-sizing: border-box;
        }
        .invoice-title {
            font-size: 36px;
            color: #2c3e50;
            font-weight: bold;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 8px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-transform: uppercase;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .company-info, .customer-info, .totals-info {
            font-weight: bold;
            color: #34495e;
        }
        .totals-info p {
            font-weight: bold; 
            margin-bottom: 4px;
        }
        .totals-info p strong,
        .totals-info p span {
            display: inline-block;
        }
        .totals-info p strong {
            width: 150px;
            margin-right: 4px;
        }
        .totals-info p span {
            width: 50px;
            text-align: center
        }
        .footer-description  .bt-1 {
            border-top: 1px solid #ddd;
            padding: 20px 0px;
        }
        @media print {
            .no-print {
                display: none;
            }
            .container {
                width: 100% !important;
            }
            .invoice-box {
                padding: 20px;
                position: relative;
                min-height: calc(100vh - 45px);
                box-sizing: border-box;
                box-shadow: none;
            }
            table {
                border-top: 1px solid #ddd;
            }
            .footer-description {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                padding-top: 20px;
            }
            .footer-description  .bt-1 {
            padding: 20px 10px;
        }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mt-3 no-print">
            <button onclick="window.print();" class="btn btn-primary"><i class="bi bi-printer"></i> Print Invoice</button>
        </div>
        <div class="invoice-box">
            <div class="invoice-content">
                <div class="row mb-4 align-items-end">
                    <div class="col-sm-6">
                        <div class="mb-2">
                            <h1 class="invoice-title">Invoice</h1>
                            <p>Invoice #: {{ $sale->bill_no }}<br>
                            Date: {{ \Carbon\Carbon::parse($sale->date)->format('F j, Y') }}<br>
                            Status: <span class="badge bg-success">{{ $sale->status }}</span></p>
                        </div>
                        <div class="mb-3">
                            <div class="customer-info">
                                <strong>Bill To:</strong> {{ $customer->name }}<br>
                                @if ($customer->email)
                                    Email: {{ $customer->email }}<br>
                                @endif
                                @if ($customer->phone)
                                    Phone: {{ $customer->phone }}<br>
                                @endif
                                @if ($customer->address)
                                    Address: {{ $customer->address }}<br>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr class="heading">
                            <th>Product</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Net Unit Price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->getProducts() as $product)
                      
                            <tr class="item">
                                <td>{{ $product['name'] }}</td>
                                <td class="text-center">{{ $product['sku'] }}</td>
                                <td class="text-center">{{ number_format($product['unit_price'], 2) }}</td>
                                <td class="text-center">{{ $product['quantity'] }}</td>
                                <td class="text-end">{{ number_format($product['quantity'] * $product['unit_price'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="footer-description">
                <div class="bt-1">
                    <div class="row justify-content-end">
                        <div class="col-sm-6 text-end">
                            <div class="totals-info">
                                <p><strong>Sub Total:</strong> <span>{{ number_format($sale->sub_total, 2) }}</span></p>
                                <p><strong>Labour Cost:</strong> <span>{{ number_format($sale->labour_cost, 2) }}</span></p>
                                <p><strong>Discount:</strong> <span>{{ number_format($sale->discount, 2) }}</span></p>
                                <p><strong>Net Total:</strong> <span>{{ number_format($sale->net_total, 2) }}</span></p>
                                <p><strong>Cash Received:</strong> <span>{{ number_format($sale->ledgerAmount(), 2) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bt-1">
                    <strong>Description:</strong><br>
                    {!! nl2br(e($sale->description)) !!}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.print();
    </script>
</body>
</html>
