@extends('layouts.app')

@section('content')
    <link href='https://fonts.googleapis.com/css?family=Libre Baskerville' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Source Sans Pro' rel='stylesheet'>
    <style>
        body .panel-heading {
            font-family: Julius Sans One;
        }

        body {
            font-family: Source Sans Pro;
            font-size: 15px;
        }
    </style>
    <div class="container" style="margin-top: 10rem;margin-bottom: 15rem;">
        <h1>Review Order</h1>
        <hr>
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif
        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif
        <div class="row">

            <div class="col-sm-4">
                <div class="form-group"><label>Order Number
                        : </label>
                    <span style="color: #00b0ff">
                                                @if($template->orderstate == "1"  || $template->orderstate == "2" || $template->orderstate == "5")
                            @if($template->pro_type == "0")
                                @if($template->id >99999)
                                    L-B{{sprintf('%05d',($template->id - 100000))}}
                                @else
                                    L-A{{sprintf('%05d',$template->id)}}
                                @endif
                            @endif
                            @if($template->pro_type == "1")
                                @if($template->id >99999)
                                    F-B{{sprintf('%05d',($template->id - 100000))}}
                                @else
                                    F-A{{sprintf('%05d',$template->id)}}
                                @endif
                            @endif
                        @else
                            {{ $template->order_id }}
                        @endif
                                            </span>
                </div>
                <div class="form-group"><label>Order State
                        : </label>
                    @if($template->orderstate == "0")
                        <span class="label label-default"> Draft</span>
                    @elseif($template->orderstate == "1")
                        <span class="label label-primary"> Paid</span>
                    @elseif($template->orderstate == "2")
                        <span class="label label-info"> Pending</span>
                    @elseif($template->orderstate == "3")
                        <span class="label label-danger"> Canceled</span>
                    @elseif($template->orderstate == "4")
                        <span class="label label-warning"> Refunded</span>
                    @else
                        <span class="label label-success"> Sent</span>
                    @endif
                </div>
                <div class="form-group"><label>Order Type
                        : </label>
                    @if($template->ordertype == "0")
                        <span class="label label-default"> Only Email</span>
                    @elseif($template->orderstate == "1")
                        <span class="label label-primary"> Email and Post</span>
                    @else
                        <span class="label label-info"> Only Post</span>

                    @endif
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group text-left"><h5>Product Info</h5></div>
                        <div class="form-group"><img style="width: 10rem;"
                                                     src="{{ asset('images/') }}/{{$template->pro_image}}">
                        </div>
                        <div class="form-group"><label>Name
                                : </label> {{$template->pro_name}}</div>
                        <div class="form-group"><label>Price : </label>
                            ${{$template->pro_price}}</div>
                        <div class="form-group"><label>Qty : </label> {{$template->pro_qty}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group text-left"><h5>Delivery Info</h5>
                        </div>
                        <div class="form-group"><label>Title : </label>
                            @if($template->title == "0")
                                Mr
                            @elseif($template->title == "1")
                                Mrs
                            @elseif($template->title == "2")
                                Miss
                            @elseif($template->title == "3")
                                Ms
                            @elseif($template->title == "4")
                                Mr & Ms
                            @elseif($template->title == "5")
                                Dr
                            @else

                            @endif
                        </div>
                        <div class="form-group"><label>Extended Info : </label>
                            @if($template->extendedinfo == "0")
                                family
                            @elseif($template->extendedinfo == "1")
                                staff
                            @elseif($template->extendedinfo == "2")
                                company
                            @else

                            @endif
                        </div>
                        <div class="form-group"><label>Name
                                : </label> {{$template->firstname}} , {{$template->lastname}}
                        </div>
                        <div class="form-group"><label>Address
                                : </label> {{$template->deliveryadd1}}
                            , {{$template->deliveryadd2}}
                        </div>
                        <div class="form-group"><label>City : </label> {{$template->city}}
                        </div>
                        <div class="form-group"><label>State : </label> {{$template->state}}
                        </div>
                        <div class="form-group"><label>Postal Code
                                : </label> {{$template->postalcode}}</div>
                        <div class="form-group"><label>Country : </label>
                            @if($template->country == "0")
                                USA
                            @endif
                        </div>
                        <div class="form-group"><label>Delivery Date
                                : </label> {{$template->deliverydate}}</div>

                        <div class="form-group"><label>Email
                                : </label> {{$template->reemail}}</div>
                        <div class="form-group"><label>Phone
                                : </label> {{$template->rephone}}</div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-6 text-left" style="margin-top: 20px;">
                <a href="/home/reorder/{{$template->id}}"><input type="button" class="btn-addcart" value="REORDER" id="savedraft"></a>
            </div>
            <div class="col-xs-6 text-right" style="margin-top: 20px;">
                <a href="/home"><input type="button" class="btn-addcart" value="GO TO HOME" id="addcart"></a>
            </div>
        </div>
    </div>
    <script src="/site/js/vendor/jquery-1.11.2.min.js"></script>
    <script src="/site/js/plugins.js"></script>
    <script src="/site/js/main.js"></script>
@endsection
