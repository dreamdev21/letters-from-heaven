<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="{{ asset('/site/favicon.ico') }}">
    <style type="text/css">
        table {
            border-collapse: collapse;
            border: 1px solid #00539F;
            width: 600px;
            font-family: Tahoma, Arial, sans-serif;
        }

        tr {
            font-size: 12px;
            line-height: 18px;
            color: #008BC6;
        }

        td {
            padding-right: 9px;
            padding-left: 9px;
        }

        .india-gst-invoice-table {
            width: 750px;
        }

        .no-border-table {
            border: none;
        }
    </style>

    <title>

    </title></head>
<body>


<table align="center" class="">


    <tbody>
    <tr>
        <th colspan="2"
            style="color:#FFFFFF;font-size:19px;font-weight:bold;background-color:#00539F;line-height:24px;text-align:left;padding-right:9px;padding-left:9px;">
            Invoice

        </th>
    </tr>

    <tr>
        <td style="width:50%;">&nbsp;</td>
        <td style="width:50%;">&nbsp;</td>
    </tr>


    <tr style="border-top-style:none">
        <td>
            UTOP PTE.LTD.
        </td>
        <td>
            Invoice Number: #
            {{$order->order_id}}
        </td>
    </tr>
    <tr style="border-top-style:none">
        <td>
            16 Raffles Quay #33-02
        </td>
        <td>
            Invoice Date:
            <?php
            $date = new DateTime($order->created_at);
            echo $date->format('Y-m-d');
            ?>
        </td>
    </tr>
    <tr style="border-top-style:none">
        <td>
            Hong Leong Building,
        </td>
        <td>
            Delivery Date:
            <?php
            $date = DateTime::createFromFormat('m-d-Y', $order->deliverydate);
            echo $date->format('Y-m-d');
            ?>
        </td>
    </tr>
    <tr style="border-top-style:none">
        <td>
            Singapore, 048581
        </td>
        <td>
            Payment Date:
            <?php
            $date = new DateTime($order->updated_at);
            echo $date->format('Y-m-d');
            ?>
        </td>
    </tr>

    <tr style="border-top-style:none">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

    <tr style="border-top-style:none">
        <td>
            VAT ID #:
            None Provided
        </td>
        <td>
            Order Number: #
            @if($order->pro_type == "0")
                @if($order->id >99999)
                    L-B{{sprintf('%05d',($order->id - 100000))}}
                @else
                    L-A{{sprintf('%05d',$order->id)}}
                @endif
            @endif
            @if($order->pro_type == "1")
                @if($order->id >99999)
                    F-B{{sprintf('%05d',($order->id - 100000))}}
                @else
                    F-A{{sprintf('%05d',$order->id)}}
                @endif
            @endif
        </td>
    </tr>


    <tr style="line-height: 30px;">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>


    <tr>
        <th colspan="2"
            style="color:#FFFFFF;font-size:19px;font-weight:bold;background-color:#00539F;line-height:24px;text-align:left;padding-right:9px;padding-left:9px;">
            &nbsp;
        </th>
    </tr>

    <tr style="font-size: 14px; color: #008BC6;">
        <td>
            Bill To:
        </td>
        <td>
            Recipient :
        </td>
    </tr>


    <tr>
        <td>{{ $user->firstname }} {{ $user->lastname }}</td>
        <td>{{ $order->firstname }} {{ $order->lastname }}</td>
    </tr>
    <tr>
        <td>{{ $user->address }}</td>
        <td>{{ $order->deliveryadd1 }} {{ $order->deliveryadd2 }}</td>
    </tr>
    <tr>
        <td>{{ $user->state }}, {{ $user->zip }}</td>
        <td>{{ $order->state }}, {{ $order->postalcode }}</td>
    </tr>
    <tr>
        <td>US</td>
        <td>US</td>
    </tr>


    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            VAT ID #:None Provided
        </td>
        <td>
        </td>
    </tr>


    <tr style="line-height: 30px;">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>


    </tbody>
</table>


<table style="border-top-style:none" align="center">

    <tbody>
    <tr>
        <th style="font-size:12px;line-height:1em;color:#008BC6;text-align:center;background-color:#CAE8F9;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;padding-right:5px;padding-left:5px;border-top-style:none;; width: 2%;">
            No
        </th>
        <th style="font-size:12px;line-height:1em;color:#008BC6;text-align:center;background-color:#CAE8F9;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;padding-right:5px;padding-left:5px;border-top-style:none;; width: 37%;">
            Description of Supplies
        </th>
        <th style="font-size:12px;line-height:1em;color:#008BC6;text-align:center;background-color:#CAE8F9;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;padding-right:5px;padding-left:5px;border-top-style:none;; width: 12%;">
            Quantity
        </th>
        <th style="font-size:12px;line-height:1em;color:#008BC6;text-align:center;background-color:#CAE8F9;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;padding-right:5px;padding-left:5px;border-top-style:none;; width: 15%;">
            Net Amount
        </th>
        <th style="font-size:12px;line-height:1em;color:#008BC6;text-align:center;background-color:#CAE8F9;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;padding-right:5px;padding-left:5px;border-top-style:none;; width: 10%;">

            Tax %

        </th>
        <th style="font-size:12px;line-height:1em;color:#008BC6;text-align:center;background-color:#CAE8F9;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;padding-right:5px;padding-left:5px;border-top-style:none;; width: 12%;">
            Shipping Costs
        </th>
        <th style="font-size:12px;line-height:1em;color:#008BC6;text-align:center;background-color:#CAE8F9;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;padding-right:5px;padding-left:5px;border-top-style:none;; width: 21%;">
            Total
        </th>
    </tr>

    <tr>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;&nbsp;1&nbsp;&nbsp;
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            {{ $order->pro_name }}
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;"
            align="right">{{ $order->pro_qty }}
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;"
            align="right">${{$order->pro_price}}
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;"
            align="right">0%
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;"
            align="right">$0.00
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;"
            align="right">${{$order->pro_price}}
        </td>
    </tr>


    <tr style="line-height: 25px">
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;
        </td>
        <td style="border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;border-top-style:none;border-bottom-style:none;line-height:1.5em;">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td colspan="6" align="right"
            style="font-size:12px;line-height:1em;color:#008BC6;text-align:right;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;font-weight: bold">
            Subtotal
        </td>
        <td align="right"
            style="font-size:12px;line-height:1em;color:#008BC6;text-align:right;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;">
            $0.00
        </td>
    </tr>


    <tr>
        <td colspan="6" align="right"
            style="font-size:12px;line-height:1em;color:#008BC6;text-align:right;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;font-weight: bold">
            Total
        </td>
        <td align="right"
            style="font-size:12px;line-height:1em;color:#008BC6;text-align:right;border-width:1px;border-color:#00539F;border-style:solid;border-collapse:collapse;">
            ${{$order->pro_price}}
        </td>
    </tr>


    <tr>
        <td colspan="7" align="center">

        </td>
    </tr>

    <tr>
        <td colspan="7" align="center">
            This document is for your tax records only and does not represent a balance due.
        </td>
    </tr>
    <tr>
        <td colspan="7" align="center">
            <div></div>
            <a href="/home/invoice/pdf/{{$order->id}}">
                Download PDF
            </a>
        </td>
    </tr>
    </tbody>
</table>


</body>
</html>