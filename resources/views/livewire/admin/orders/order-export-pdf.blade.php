<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        table th{
            text-align: left;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .font{
            font-size: 15px;
        }
        .authority {
            /*text-align: center;*/
            float: right
        }
        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }
        .thanks p {
            color: green;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>
<body>

<table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
            <!-- {{-- <img src="" alt="" width="150"/> --}} -->
            <h2 style="color: green; font-size: 26px;"><strong>Directory Listing</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               EasyShop Head Office
               Email:support@invoice.com <br>
               Mob: 1111222255 <br>
               100254 Barnes Street,United States <br>
            </pre>
        </td>
    </tr>

</table>

<br>
<table width="100%" style="background:white; padding:2px;">
    <tr>
        <td valign="top">
            <strong>Deliver To:</strong><br>
            <strong>Name:</strong> {!! @$order->user->name !!}
            <br>
            <strong>Email:</strong> {!! @$order->user->email !!}
            <br>
            <strong>Payment Method:</strong><br>
            {{ $order->payment_method }}<br>
            <strong>Payment Status: </strong>
            @if(strtoupper($order->payment_status) == 'COMPLETED')
                <span style="color: green">COMPLETED</span>
            @elseif(strtoupper($order->payment_status) == 'PENDING')
                <span style="color: orange">PENDING</span>
            @else
                <span style="color: red">{{ $order->payment_status }}</span>
            @endif

        </td>
        <td align="right">
            <h2>Invoice</h2>
            <div class="invoice-number">Order #{{ $order->order_id }}</div>
            <br>
            <strong>Order Date:</strong><br>
            {{ date('F d, Y / H:i', strtotime($order->created_at)) }}
            <br><br>
            <strong>Order Status:</strong><br>
            @if($order->order_status === 'delivered')
                <span style="color: green">Delivered</span>
            @elseif($order->order_status === 'declined')
                <span style="color: red">Declined</span>
            @else
                <span style="color: orange">{{ $order->order_status }}</span>
            @endif
            <br><br>
        </td>
    </tr>
</table>

<table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">

    <thead class="table-light">
    <tr>
        <th>#</th>
        <th>Package</th>
        <th class="text-center">Price</th>
        <th class="text-center">Paid in </th>
        <th class="text-right">Totals</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>{{ $order->package->name }}</td>
            <td class="text-center">{{ $order->base_amount }} {{ $order->base_currency }}</td>
            <td class="text-center">{{ $order->paid_amount }} {{ $order->paid_currency }}</td>
            <td class="text-right">{{ $order->base_amount }} {{ $order->base_currency }}</td>
        </tr>
    </tbody>

</table>
<br/>

<table class="table test_table" style="float: right" border="none">
    <tr>
        <td style="font-weight: bold">Total</td>
        <td style="font-weight: bold">{{ $order->base_amount }} {{ $order->base_currency }}</td>
    </tr>
</table>

<table class="table test_table" style="float:right; border:none">

</table>


<div class="thanks mt-3">
    <p>Thanks For Your Ordering..!!</p>
</div>

</body>
</html>
