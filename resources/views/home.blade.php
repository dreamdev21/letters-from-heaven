@extends('layouts.app')

@section('content')
    <meta property="og:title" content="Letter from heaven" />
    <meta property="og:description" content="This is Fantastic Letter From Heaven Service!" />
    <meta property="og:url" content="http://letter-from-heaven.com" />
    <meta property="og:image" content="https://www.google.co.uk/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" />
    <link rel="stylesheet" href="/site/css/sharetastic.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="/site/js/sharetastic.js"></script>
    <script src="/site/js/main.js"></script>
    <script type="text/javascript" src="/site/js/MaxLength.min.js"></script>
    <div class="container" style="margin-top: 7rem;font-size: 15px;margin-bottom: 35rem;">
        <div class="row">
            <div class="col-sm-6 text-left">
                <h4><strong> Welcome back {{$user[0]['firstname']}}!</strong></h4>
            </div>
            <div class="col-sm-6 text-right">
                <h4><strong>Customer # {{$user[0]['id']}}</strong></h4>
            </div>
        </div>
        <div class="row">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th style="width: 20rem;">Your Orders</th>
                                <th>Items</th>
                                <th style="width: 10rem;">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                @if($item->orderstate == "0")
                                <tr class="gradeX">
                                    <td>
                                        <div class="row">
                                            <label>Order Date : </label> {{date('Y-m-d',strtotime($item->created_at))}}
                                        </div>
                                        <div class="row">
                                            <label>Order Number : #</label> <span style="color: #00b0ff">
                                                @if($item->orderstate == "1"  || $item->orderstate == "2" || $item->orderstate == "5")
                                                    @if($item->pro_type == "0")
                                                        @if($item->id >99999)
                                                            L-B{{sprintf('%05d',($item->id - 100000))}}
                                                        @else
                                                            L-A{{sprintf('%05d',$item->id)}}
                                                        @endif
                                                    @endif
                                                    @if($item->pro_type == "1")
                                                        @if($item->id >99999)
                                                            F-B{{sprintf('%05d',($item->id - 100000))}}
                                                        @else
                                                            F-A{{sprintf('%05d',$item->id)}}
                                                        @endif
                                                    @endif
                                                @else
                                                    {{ $item->order_id }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="row">
                                            <label>Order Total : $</label>{{$item->pro_price}}
                                        </div>
                                        <div class="row">
                                            <label>Order State : </label>
                                            @if($item->orderstate == "0")
                                                <span class="label label-default" style="font-size: 1em;"> Draft</span>
                                            @elseif($item->orderstate == "1")
                                                <span class="label label-danger" style="font-size: 1em;"> Paid</span>
                                            @elseif($item->orderstate == "2")
                                                <span class="label label-info" style="font-size: 1em;"> Pending</span>
                                            @elseif($item->orderstate == "3")
                                                <span class="label label-danger" style="font-size: 1em;"> Canceled</span>
                                            @elseif($item->orderstate == "4")
                                                <span class="label label-warning" style="font-size: 1em;"> Refunded</span>
                                            @else
                                                <span class="label label-success" style="font-size: 1em;"> Sent</span>
                                            @endif
                                        </div>
                                    </td>


                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <img src="/images/{{$item->pro_image}}" >
                                            </div>
                                            <div class="col-sm-8 form-group" style="inline-size: unset;">
                                                <div class="row form-group ">
                                                    <label>Item : </label><span style="color: #00b0ff">{{$item->pro_name}}</span>
                                                    <br>
                                                    {{--<button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $item->id }}">Write Review</button>--}}
                                                    <button class="btn btn-primary"><a href="/home/orderededit/{{$item->id}}">Edit</a></button>
                                                    <button class="btn btn-primary"><a href="/home/orderedrecedit/{{$item->id}}">Edit Recipient's Info</a></button>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="sharetastic"></div>
                                                </div>
                                                @if($item->firstname)
                                                <div class="row">
                                                    <label>Recepients Name : </label><span style="color: #00b0ff">{{$item->firstname}}  {{$item->lastname}}</span>
                                                    <br>
                                                </div>
                                                @endif
                                                @if($item->deliverydate)
                                                <div class="row">
                                                    <label>Scheduled Date : </label><span style="color: #00b0ff">
                                                        <?php
                                                        $result_date = DateTime::createFromFormat('m-d-Y', $item->deliverydate);
                                                        echo ($result_date->format('Y-m-d'));
                                                        ?>
                                                    </span>
                                                    <br>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="row form-group">
                                            <button class="btn btn-primary"><a href="/home/order/view/{{$item->id}}">View Order</a></button>
                                        </div>

                                        {{--<div class="row ">--}}
                                            {{--<label>Print Invoice</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="row form-group">--}}
                                            {{--<button class="btn btn-success">Schedule New</button>--}}
                                        {{--</div>--}}
                                        <div class="row form-group">
                                            <button class="btn btn-info"><a href="/home/reorder/{{$item->id}}">Copy</a></button>
                                        </div>
                                        <div class="row form-group" >
                                            <button class="btn btn-link btn-sm" data-toggle="modal" data-target="#mycancelModal{{ $item->id }}" style="font-size: 15px;">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal inmodal" id="mycancelModal{{ $item->id }}" tabindex="-1" role="dialog"
                                     aria-hidden="true" style="display: none;text-align: center;">
                                    <div class="modal-dialog">
                                            <div class="modal-content animated flipInY">
                                                <div class="modal-header" style="text-align: center">
                                                    <h4 class="modal-title">Confirm</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="modal-body">
                                                        <span style="text-align: center;color:blue;font-size: 1rem;">Are you sure to cancel this order?</span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="text-align: center;">
                                                    <button class="btn btn-danger"><a href="/home/order/cancel/{{$item->id}}">Yes</a></button>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                                @endif
                            @endforeach
                            @foreach($items as $item)
                                @if($item->orderstate != "0")
                                <tr class="gradeX">
                                    <td>
                                        <div class="row">
                                            <label>Order Date : </label> {{date('Y-m-d',strtotime($item->created_at))}}
                                        </div>
                                        <div class="row">
                                            <label>Order Number : #</label> <span style="color: #00b0ff">
                                                @if($item->orderstate == "1"  || $item->orderstate == "2" || $item->orderstate == "5")
                                                    @if($item->pro_type == "0")
                                                        @if($item->id >99999)
                                                            L-B{{sprintf('%05d',($item->id - 100000))}}
                                                        @else
                                                            L-A{{sprintf('%05d',$item->id)}}
                                                        @endif
                                                    @endif
                                                    @if($item->pro_type == "1")
                                                        @if($item->id >99999)
                                                            F-B{{sprintf('%05d',($item->id - 100000))}}
                                                        @else
                                                            F-A{{sprintf('%05d',$item->id)}}
                                                        @endif
                                                    @endif
                                                @else
                                                    {{ $item->order_id }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="row">
                                            <label>Order Total : $</label>{{$item->pro_price}}
                                        </div>
                                        <div class="row">
                                            <label>Order State : </label>
                                            @if($item->orderstate == "0")
                                                <span class="label label-default" style="font-size: 1em;"> Draft</span>
                                            @elseif($item->orderstate == "1")
                                                <span class="label label-danger" style="font-size: 1em;"> Paid</span>
                                            @elseif($item->orderstate == "2")
                                                <span class="label label-info" style="font-size: 1em;"> Pending</span>
                                            @elseif($item->orderstate == "3")
                                                <span class="label label-danger" style="font-size: 1em;"> Canceled</span>
                                            @elseif($item->orderstate == "4")
                                                <span class="label label-warning" style="font-size: 1em;"> Refunded</span>
                                            @else
                                                <span class="label label-success" style="font-size: 1em;"> Sent</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <img src="/images/{{$item->pro_image}}" >
                                            </div>
                                            <div class="col-sm-8 form-group" style="inline-size: unset;">
                                                <div class="row ">
                                                    <label>Item : </label><span style="color: #00b0ff">{{$item->pro_name}}</span>
                                                    <br>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $item->id }}">Write Review</button>
                                                    @if($item->deliverydate)
                                                    <?php
                                                        $result_date = DateTime::createFromFormat('m-d-Y', $item->deliverydate);
                                                        $deliverytime = strtotime($result_date->format('Y-m-d'));
                                                        $limit = time()+3600*24*30;
                                                        if($item->orderstate == 1){
                                                            if($item->deliverytype == "1" || $item->deliverytype == "2"){
                                                                if(($deliverytime-$limit)< 0){
                                                                    echo ('<button class="btn btn-primary style="    margin-right: 4px;"" disabled="true">Edit</button><button class="btn btn-primary"><a href="/home/orderedrecedit/'.$item->id.'" disabled="true">Edit Recipient'."'".'s Info</a></button>');
                                                                }else{
                                                                    echo ('<button class="btn btn-primary" style="    margin-right: 4px;"><a href="/home/orderededit/'.$item->id.'">Edit</a></button><button class="btn btn-primary"><a href="/home/orderedrecedit/'.$item->id.'">Edit Recipient'."'".'s Info</a></button>');
                                                                }
                                                            }else{
                                                                echo('<button class="btn btn-primary" style="    margin-right: 4px;"><a href="/home/orderededit/'.$item->id.'">Edit</a></button><button class="btn btn-primary"><a href="/home/orderedrecedit/'.$item->id.'">Edit Recipient'."'".'s Info</a></button>');
                                                            }
                                                        }else{
                                                            echo('<button class="btn btn-primary" style="    margin-right: 4px;"><a href="/home/orderededit/'.$item->id.'">Edit</a></button><button class="btn btn-primary"><a href="/home/orderedrecedit/'.$item->id.'">Edit Recipient'."'".'s Info</a></button>');
                                                        }

                                                    ?>
                                                    @endif
                                                </div>

                                                <div class="row form-group">
                                                    <div class="sharetastic"></div>
                                                </div>
                                                <div class="row">
                                                    <label>Recepients Name : </label><span style="color: #00b0ff">{{$item->firstname}}  {{$item->lastname}}</span>
                                                    <br>
                                                </div>
                                                @if($item->deliverydate)
                                                <div class="row">
                                                    <label>Scheduled Date : </label><span style="color: #00b0ff"><?php $result_date = DateTime::createFromFormat('m-d-Y', $item->deliverydate); echo $result_date->format('Y-m-d'); ?></span>
                                                    <br>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row form-group">
                                            <button class="btn btn-primary"><a href="/home/order/view/{{$item->id}}">View Order</a></button>
                                        </div>
                                        @if($item->orderstate == "1")
                                        <div class="row  form-group">
                                            <button class="btn btn-danger"><a href="javascript://" onclick="javascript:window.open('/home/invoice/{{$item->id}}','Letter from heaven invoice','toolbar=no,status=no,menubar=no,scrollbars=yes,width=620,height=600,resizable=yes');" style="color: white !important;">Print Invoice</a></button><br>
                                        </div>
                                        <div class="row form-group">
                                            <button class="btn btn-success"><a href="/home/orderedrecedit/{{$item->id}}">Re-schedule</a></button>
                                        </div>
                                        @endif
                                        <div class="row form-group">
                                            <button class="btn btn-info"><a href="/home/editemail/reorder/{{$item->id}}">Reorder</a></button>
                                        </div>
                                        <div class="row form-group" >
                                            <button class="btn btn-link btn-sm" data-toggle="modal" data-target="#mycancelModal{{ $item->id }}" style="font-size: 15px;">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal inmodal" id="mycancelModal{{ $item->id }}" tabindex="-1" role="dialog"
                                     aria-hidden="true" style="display: none;text-align: center;">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated flipInY">
                                            <div class="modal-header" style="text-align: center">
                                                <h4 class="modal-title">Confirm</h4>
                                            </div>
                                            <div class="row">
                                                <div class="modal-body">
                                                    <span style="text-align: center;color:blue;font-size: 1rem;">Are you sure to cancel this order?</span>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="text-align: center;">
                                                <button class="btn btn-danger"><a href="/home/order/cancel/{{$item->id}}">Yes</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal inmodal" id="invoiceModal{{ $item->id }}" tabindex="-1" role="dialog"
                                     aria-hidden="true" style="display: none;text-align: center;">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated flipInY">
                                            <div class="modal-header" style="text-align: center">
                                                <h4 class="modal-title">Confirm</h4>
                                            </div>
                                            <div class="row">
                                                <div class="modal-body">
                                                    <span style="text-align: center;color:blue;font-size: 1rem;">Are you sure to cancel this order?</span>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="text-align: center;">
                                                <button class="btn btn-danger"><a href="/home/order/cancel/{{$item->id}}">Yes</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal inmodal" id="myModal{{ $item->id }}" tabindex="-1" role="dialog"
                                     aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <form action="{{ route('/orderreviewwrite',$item->id) }}" method="POST" class="side-by-side" id = "orderreviewwrite{{ $item->id }}">
                                            {!! csrf_field() !!}
                                            <div class="modal-content animated flipInY">
                                                <div class="modal-header" style="text-align: center">
                                                    <h4 class="modal-title">Write your review here</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="modal-body">
                                                        <div class="row" style="text-align: center">

                                                            <span  id="txtBox_warning_note{{ $item->id }}" style="color:red"></span >
                                                        </div>
                                                        <div class="row" style="text-align: center">

                                                            <span  id="txtBox_warning_rating{{ $item->id }}" style="color:red"></span >
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div id="">
                                                                <input type="hidden" name="orderid" value="{{ $item->id }}">
                                                                <input type="hidden" name="pro_type" value="{{ $item->pro_type }}">
                                                                <input type="hidden" name="pro_id" value="{{ $item->pro_id }}">
                                                                <label>Order Number : #</label> <span style="color: #00b0ff">
                                                                    @if($item->orderstate == "1"  || $item->orderstate == "2" || $item->orderstate == "5")
                                                                        @if($item->pro_type == "0")
                                                                            @if($item->id >99999)
                                                                                L-B{{sprintf('%05d',($item->id - 100000))}}
                                                                            @else
                                                                                L-A{{sprintf('%05d',$item->id)}}
                                                                            @endif
                                                                        @endif
                                                                        @if($item->pro_type == "1")
                                                                            @if($item->id >99999)
                                                                                F-B{{sprintf('%05d',($item->id - 100000))}}
                                                                            @else
                                                                                F-A{{sprintf('%05d',$item->id)}}
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        {{ $item->order_id }}
                                                                    @endif
                                                                </span><br>
                                                                <label>Product Name : </label> <span style="color: #00b0ff">{{$item->pro_name}}</span><br>
                                                                <label>Price : $</label> <span style="color: #00b0ff">{{$item->pro_price}}</span><br>
                                                                <div id="emailtemplateimage" class="row">
                                                                    <img class=""
                                                                         src="/images/{{ $item->pro_image }}"
                                                                         style="width: 10rem;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="col-md-6">
                                                            <div class="row" style="text-align: center">
                                                                <div id="rateYo{{ $item->id }}"></div><br>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <textarea name="orderreview{{ $item->id }}" rows="10" style="width: 100%;" id = "note{{ $item->id }}" maxlength="176"></textarea>
                                                                    <span>Maxlength 176 characters.</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="button" onclick="reviewsave{{ $item->id }}()" class="btn btn-success btn-lg" value="Save">
                                                </div>
                                                <script type="text/javascript">
                                                    $("#rateYo{{ $item->id }}").rateYo({
                                                        rating: 0,
                                                        spacing: "10px"
                                                    });
                                                    var $rateYo{{ $item->id }} = $("#rateYo{{ $item->id }}").rateYo();

                                                    function reviewsave{{ $item->id }}(){
                                                        var rating{{ $item->id }} = $rateYo{{ $item->id }}.rateYo("rating");
                                                        $('#orderreviewwrite{{ $item->id }}').append('<input type = "hidden" name = "rating{{ $item->id }}" value = "'+rating{{ $item->id }}+'">');
                                                        if(rating{{ $item->id }} == 0){
                                                            $("#txtBox_warning_rating{{ $item->id }}").text("");
                                                            $("#txtBox_warning_note{{ $item->id }}").text("");
                                                            $("#txtBox_warning_rating{{ $item->id }}").append("Please select rating!");
                                                        }else {
                                                            if ($('#note{{ $item->id }}').val().length < 10){
                                                                $("#txtBox_warning_note{{ $item->id }}").text("");
                                                                $("#txtBox_warning_rating{{ $item->id }}").text("");
                                                                $("#txtBox_warning_note{{ $item->id }}").append("Minimum 10 Characters are required");
                                                            }else{

                                                                $('#orderreviewwrite{{ $item->id }}').submit();
                                                            }
                                                        }


                                                    }
                                                    {{--$("#note{{ $item->id }}").MaxLength({MaxLength: 176});--}}
                                                </script>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.sharetastic').sharetastic();
    </script>
@endsection
