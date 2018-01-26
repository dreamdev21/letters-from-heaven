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
<?php
list($width, $height, $type, $attr) = getimagesize("images/" . $order->pro_image);
?>
{{--<div style="background-image: url('/images/{{$order->pro_image}}');width: 100%;height: 100%;padding:20px;    background-repeat: no-repeat;">--}}
<div class="Editor-editor" contenteditable="true" style="text-align: left;background-image: url('/images/{{$order->pro_image}}'); background-repeat: no-repeat; padding-top:96px; padding-left:120px; padding-right:120px; padding-bottom:96px;height:{{ $height }}">
{!! $order->pro_text !!}
</div>
</body>
</html>