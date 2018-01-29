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
                            <div class="form-group"><img style="width: 10rem;"
                                        src="{{ asset('images/tumbnail/724x980/') }}/{{$item->pro_image}}">
                            </div>
                            <div class="form-group"><label>Name
                                    : </label> {{$item->pro_name}}</div>
                            <div class="form-group"><label>Price : </label>
                                ${{$item->pro_price}}</div>
                            <div class="form-group"><label>Qty : </label> {{$item->pro_qty}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group text-left"><h5>Delivery Info</h5>
                            </div>
                            <div class="form-group"><label>Title : </label>
                                @if($item->title == "0")
                                    Mr
                                @elseif($item->title == "1")
                                    Mrs
                                @elseif($item->title == "2")
                                    Miss
                                @elseif($item->title == "3")
                                    Ms
                                @elseif($item->title == "4")
                                    Mr & Ms
                                @elseif($item->title == "5")
                                    Dr
                                @else

                                @endif
                            </div>
                            <div class="form-group"><label>Extended Info : </label>
                                @if($item->extendedinfo == "0")
                                    family
                                @elseif($item->extendedinfo == "1")
                                    staff
                                @elseif($item->extendedinfo == "2")
                                    company
                                @else

                                @endif
                            </div>
                            <div class="form-group"><label>Name
                                    : </label> {{$item->firstname}} , {{$item->lastname}}
                            </div>
                            <div class="form-group"><label>Address
                                    : </label> {{$item->deliveryadd1}}
                                , {{$item->deliveryadd2}}
                            </div>
                            <div class="form-group"><label>City : </label> {{$item->city}}
                            </div>
                            <div class="form-group"><label>State : </label> {{$item->state}}
                            </div>
                            <div class="form-group"><label>Postal Code
                                    : </label> {{$item->postalcode}}</div>
                            <div class="form-group"><label>Country : </label>
                                @if($item->country == "0")
                                    USA
                                @endif
                            </div>
                            <div class="form-group"><label>Delivery Date
                                    : </label> {{$item->deliverydate}}</div>
                            <div class="form-group"><label>Card Message
                                    : </label> {{$item->cardmessage}}</div>
                            <div class="form-group"><label>Signature
                                    : </label> {{$item->signature}}</div>
                            <div class="form-group"><label>Email
                                    : </label> {{$item->reemail}}</div>
                            <div class="form-group"><label>Phone
                                    : </label> {{$item->rephone}}</div>
                        </div>
                    </div>
                    <hr>
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
                                            $ {{ $item->pro_price }}
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
                                            $ {{ $item->pro_price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="    color: white;"><span>Pay with</span></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row text-left">
                                    <div class="radio">
                                        <label><input id="paypal" class="" type="radio"
                                                      name="paymethod" value="0" required><img
                                                    src="/site/images/paypal.png"
                                                    width="80%"></label>
                                        <label><input id="creditcard" class="" type="radio" data-toggle="modal"
                                                      data-target="#myModalcreditinfo"
                                                      name="paymethod" value="1" required><img
                                                    src="/site/images/credit.png"
                                                    width="80%"
                                                    style="    padding: 6px;"></label>
                                    </div>
                                    {{ Form::open(['method' => 'post','route' => ['/home/paywithpaypalordered',$item->id],'style'=>'display:inline','class'=>'form-horizontal','id'=>'paypalform']) }}
                                    <div class="col-lg-12">
                                        <div class="row text-right" style="margin-top: 18px;">
                                            <input type="submit" class="btn btn-success" value="Pay now"
                                                   id="paywith-credit-btn">
                                        </div>
                                    </div>
                                    {{ Form::close() }}


                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModalcreditinfo" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    {{ Form::open(['method' => 'post','route' => ['/home/paywithcreditcardordered',$item->id],'style'=>'display:inline','class'=>'form-horizontal','id'=>'creditcardform']) }}
                    <legend style="text-align: center">Credit Card Information</legend>
                    <div id="creditcardinfo" class="form-group text-left" role="form">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-3 col-sm-offset-3 control-label">First Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control-delivery"
                                           name="cardfirstname" required
                                           id="card-holder-name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-sm-offset-3 control-label" for="card-holder-name">Last Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control-delivery" name="cardlastname" required
                                           id="card-holder-name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-sm-offset-3 control-label" for="card-number">Card
                                    Number</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control-delivery" name="card-number" required
                                           id="card-number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  col-sm-offset-3 control-label" for="expiry-month">Expiration
                                    Date</label>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <div class="col-xs-4" style="padding-left: 0px;">
                                            <input type="text" class="form-control-delivery"
                                                   name="expiredatemonth" style="width: 40px;" required
                                                   placeholder="MM">
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control-delivery"
                                                   name="expiredateyear" style="width: 62px;" required
                                                   placeholder="YYYY">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  col-sm-offset-3 control-label" for="cvv">CVV</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control-delivery" name="cvv" required
                                           id="cvv">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <legend style="text-align: center">Billing Address</legend>
                    <div class="row" id="billingaddressinfo">
                        <div class="row text-left">
                            <div class="col-sm-6 col-sm-offset-4">
                                <label><input id="samedelivery" class="" type="radio"
                                              name="billingmethod" value="0" required>Same as shipping
                                    address</label><br>
                                <label><input id="differdelivery" class="" type="radio"
                                              name="billingmethod" value="1" required>Use a different
                                    billing address</label>
                            </div>
                        </div>
                        <br>
                        <div class="row text-left">
                            <div id="billinginfo" class="form-group" role="form">
                                <fieldset>

                                    <div class="form-group text-left">
                                        <label class="col-sm-3  col-sm-offset-3  control-label" for="card-holder-name">First
                                            name</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control-delivery"
                                                   name="billingfirstname"
                                                   id="card-holder-name">
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label class="col-sm-3  col-sm-offset-3  control-label" for="card-holder-name">Last
                                            name</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control-delivery"
                                                   name="billinglastname"
                                                   id="card-holder-name">
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label class="col-sm-3  col-sm-offset-3  control-label" for="card-number">Address
                                            1</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control-delivery"
                                                   name="billingaddress1"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label class="col-sm-3  col-sm-offset-3  control-label" for="card-number">Address
                                            2</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control-delivery"
                                                   name="billingaddress2"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label class="col-sm-3  col-sm-offset-3  control-label" for="card-number">City</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control-delivery"
                                                   name="billingcity"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label class="col-sm-3  col-sm-offset-3  control-label" for="cvv">Country</label>
                                        <div class="col-sm-3">
                                            <select class="form-control-delivery" name="billingcountry"
                                                    style="width: 50%!important;">
                                                <option value="0">USA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label class="col-sm-3  col-sm-offset-3  control-label"
                                               for="card-number">State</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control-delivery"
                                                   name="billingaddressstate"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <label class="col-sm-3  col-sm-offset-3  control-label" for="cvv">Postal Code</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control-delivery"
                                                   name="billingpostalcode">
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <div class="row text-right" style="margin-top: 18px;">
                                    <input type="submit" class="btn btn-success" value="Continue">
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/site/js/vendor/jquery-1.11.2.min.js"></script>
    {{--<script src="site/js/vendor/bootstrap.min.js"></script>--}}

    <script src="/site/js/plugins.js"></script>
    <script src="/site/js/main.js"></script>

    <script type="text/javascript">
        $('#creditcardform').hide();
        $('#billingaddressinfo').hide();
        $('#paypalform').hide();
        $('#creditcard').on('click', function () {
            $('#creditcardform').show('1000');
            $('#billingaddressinfo').show('1000');
            $('#paypalform').hide();
        });
        $('#paypal').on('click', function () {
            $('#creditcardform').hide('1000');
            $('#billingaddressinfo').hide('1000');
            $('#paypalform').show('1000');

        });

        $('#billinginfo').hide();
        $('#differdelivery').on('click', function () {
            $('#billinginfo').show('1000');
            $('input').prop('required',true);
        });
        $('#samedelivery').on('click', function () {
            $('#billinginfo').hide('1000');
            $('#card-holder-name').removeAttr('required');
        });
    </script>

@endsection
