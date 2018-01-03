<!-- saved from url=(0077)https://www.vistaprint.com/Sales/Taxes/ViewTaxInvoice.aspx?id=9248726035&rd=1 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="{{ asset('/site/favicon.ico') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <title>
        Order Email Print
    </title>
</head>
<body>

<div class="row" style="background-image: url('/images/{{$order->pro_image}}');width: 100%;height: 100%;padding:20px;    background-repeat: no-repeat;" id = "emailcontent">
{!! $order->pro_text !!}
</div>
</body>
</html>