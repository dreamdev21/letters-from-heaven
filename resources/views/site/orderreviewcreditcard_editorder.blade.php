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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
            <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group text-left"><h5>Product Info</h5></div>
                            <div class="form-group"><img
                                        src="{{ asset('images/') }}/{{$order->pro_image}}">
                            </div>
                            <div class="form-group"><label>Name
                                    : </label> {{$order->pro_name}}</div>
                            <div class="form-group"><label>Price : </label>
                                ${{$order->pro_price}}</div>
                            <div class="form-group"><label>Qty : </label> {{$order->pro_qty}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group text-left"><h5>Delivery Info</h5>
                            </div>
                            <div class="form-group"><label>Title : </label>
                                @if($order->title == "0")
                                    Mr
                                @elseif($order->title == "1")
                                    Mrs
                                @elseif($order->title == "2")
                                    Miss
                                @elseif($order->title == "3")
                                    Ms
                                @elseif($order->title == "4")
                                    Mr & Ms
                                @elseif($order->title == "5")
                                    Dr
                                @else

                                @endif
                            </div>
                            <div class="form-group"><label>Extended Info : </label>
                                @if($order->extendedinfo == "0")
                                    family
                                @elseif($order->extendedinfo == "1")
                                    staff
                                @elseif($order->extendedinfo == "2")
                                    company
                                @else

                                @endif
                            </div>
                            <div class="form-group"><label>Name
                                    : </label> {{$order->firstname}} , {{$order->lastname}}
                            </div>
                            <div class="form-group"><label>Address
                                    : </label> {{$order->deliveryadd1}}
                                , {{$order->deliveryadd2}}
                            </div>
                            <div class="form-group"><label>City : </label> {{$order->city}}
                            </div>
                            <div class="form-group"><label>State : </label> {{$order->state}}
                            </div>
                            <div class="form-group"><label>Postal Code
                                    : </label> {{$order->postalcode}}</div>
                            <div class="form-group"><label>Country : </label>
                                @if($order->country == "0")
                                    USA
                                @endif
                            </div>
                            <div class="form-group"><label>Delivery Date
                                    : </label> {{$order->deliverydate}}</div>
                            <div class="form-group"><label>Card Message
                                    : </label> {{$order->cardmessage}}</div>
                            <div class="form-group"><label>Signature
                                    : </label> {{$order->signature}}</div>
                            <div class="form-group"><label>Email
                                    : </label> {{$order->reemail}}</div>
                            <div class="form-group"><label>Phone
                                    : </label> {{$order->rephone}}</div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="    color: white;"><span>Detail</span></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row text-ceter">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-holder-name">Order
                                            Subtotal </label>
                                        <div class="col-sm-6">
                                            $ {{ $order->pro_price }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-ceter">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-holder-name">Shipping </label>
                                        <div class="col-sm-6">
                                            $ 0
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-ceter">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-holder-name">Tax </label>
                                        <div class="col-sm-6">
                                            $ 0
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-ceter">
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-holder-name">Order
                                            Total </label>
                                        <div class="col-sm-6">
                                            $ {{ $order->pro_price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="    color: white;"><span>Credit card Info</span></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                {{ Form::open(['method' => 'post','route' => ['/home/paywithcreditcardorderedprocess'],'style'=>'display:inline','class'=>'form-horizontal','id'=>'creditcardform']) }}
                                <div id="creditcardinfo" class="form-group" role="form">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-holder-name">Card
                                            firstname</label>
                                        <div class="col-sm-6">
                                            <label class="control-label"
                                                   style="font-weight: 300;">{{ $cardinfo[0]->cardfirstname }}</label>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-holder-name">Card
                                            lastname</label>
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                   style="font-weight: 300;">{{ $cardinfo[0]->cardlastname }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-number">Card Number</label>
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                   style="font-weight: 300;">{{ $cardinfo[0]['card-number'] }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="expiry-month">Expiration
                                            Date</label>
                                        <div class="col-sm-5">
                                                    <label class="control-label"
                                                           style="font-weight: 300;">{{ $cardinfo[0]->expiredatemonth }}
                                                        /{{ $cardinfo[0]->expiredateyear }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="cvv">Card CVV</label>
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                   style="font-weight: 300;">{{ $cardinfo[0]->cvv }}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="row text-right" style="margin-top: 18px;">
                                            <a href="/home/paywithcreditcardorderedprocess" class="btn btn-success">Pay Now</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/site/js/vendor/jquery-1.11.2.min.js"></script>
    {{--<script src="/site/js/vendor/bootstrap.min.js"></script>--}}

    <script src="/site/js/plugins.js"></script>
    <script src="/site/js/main.js"></script>


@endsection
