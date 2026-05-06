
<style>
    .ml-newQty{
        margin-left: 83%;
    }
    body {
        max-width: 950px;
        margin: auto
    }
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
        }

        .main-container {
            width: 100% !important;
        }

        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #thead {
            background-color: #84e8ff;
        }

        h1, h2, h3, h4, h5, h6, p, ul {
            margin: 0;
            padding: 0;
        }

        .main-container {
            width: 1000px;
            margin: 0 auto;
        }

        table tbody tr td {
            font-family: Arial !important;
            font-size: 13px !important;
        }

        table thead tr th {
            font-family: Arial !important;
            font-size: 13px !important;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        table tbody tr td {
            font-family: Arial !important;
            font-size: 13px !important;
        }

        table thead tr th {
            font-family: Arial !important;
            font-size: 13px !important;
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }
        .ml-newQty{
            margin-left: 74%;
        }
        p {
            margin-bottom: 4px;
        }
        h1{
            margin-bottom: 20px;
        }
    }
</style>
<div id="left" style="margin: 0px;width: 50%;float: left;">
    <h1>Stock Report</h1>
    <p>Start Date: {{ request('started_date') }}</p>
    <p>End Date: {{ request('ended_date') }}</p>
    <p>Print Date: {{ date('Y-m-d') }}</p>
    <p>Total Purchase: {{number_format($totalPurchasePrice, 2)}}</p>
    <p></p>
</div>
<div class="main-container">
</div>
<div id="right"></div>
<table width="100%" border="" cellpadding="2" cellspacing="0">
    <thead>
        <tr>
            <th scope="col">Sr#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Unit</th>
            <th scope="col">Quantity</th>
            <th scope="col">Purchase Price</th>
            <th scope="col">Sale Price</th>
            <th scope="col">Sku</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($totalData))
            @foreach ($totalData as $key => $data)
            <tr class="{{$data->remaining_quantity() <= 0 ? 'bg-danger childDivColorWhite' : '' }}">
                <th>{{$key+1}}</td>
                <th scope="row">{{$data->name}}</th>
                <th scope="row">{{$data->category ? $data->category->name : ''}}</th>
                <th scope="row">{{$data->unit ? $data->unit->name : ''}}</th>
                <th scope="row">{{$data->remaining_quantity()}}</th>
                <th scope="row">{{$data->purchase_price}}</th>
                <th scope="row">{{$data->sale_price}}</th>
                <th>{{$data->sku}}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

<script>
    window.onload = window.print();
</script>
