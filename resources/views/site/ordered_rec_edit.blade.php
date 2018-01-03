@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="/site/css/xzoom.css" media="all"/>
    <link type="text/css" rel="stylesheet" media="all" href="/site/css/jquery.fancybox.css"/>
    <link type="text/css" rel="stylesheet" media="all" href="/site/css/magnific-popup.css"/>
    <link href='https://fonts.googleapis.com/css?family=Libre Baskerville' rel='stylesheet'>
    <style>
        body .panel-heading{
            font-family: Julius Sans One;
        }
        .yahei{
            font-family: Julius Sans One;
        }
        .reuters{
            font-family: Libre Baskerville !important;
        }
    </style>
    <section id="email_choose" class="sections" style="margin-top: 12rem;margin-bottom:10rem;color: #7cc2cb">
        {{ Form::open(['method' => 'get','route' => ['/home/email/edit/receipinfo',$template->id],'style'=>'display:inline','class'=>'form-horizontal','id'=>'textcontent']) }}
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="    color: white;"><span>1.Please select delivery type</span></div>
                        <div class="panel-body reuters">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if($template->orderstate !="0")
                                        @if($template->deliverytype == "0")
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="0" required id = "checkbox1" checked disabled>Only Email <span style="color: red">$ 50</span>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="1" id = "checkbox2" disabled>Email and Post <span style="color: red">$ 100</span></label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="2" id = "checkbox3" disabled>Only Post <span style="color: red">$ 80</span></label>
                                            </div>
                                        @elseif($template->deliverytype == "1")
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="0" required id = "checkbox1"  disabled>Only Email <span style="color: red">$ 50</span>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="1" id = "checkbox2" checked disabled>Email and Post <span style="color: red">$ 100</span></label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="2" id = "checkbox3" disabled>Only Post <span style="color: red">$ 80</span></label>
                                            </div>
                                        @else
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="0" required id = "checkbox1"  disabled>Only Email <span style="color: red">$ 50</span>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="1" id = "checkbox2"  disabled>Email and Post <span style="color: red">$ 100</span></label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="deliverytype" value="2" id = "checkbox3" checked disabled>Only Post <span style="color: red">$ 80</span></label>
                                            </div>
                                        @endif
                                    @else
                                        <div class="radio">
                                            <label><input type="radio" name="deliverytype" value="0" required id = "checkbox1">Only Email <span style="color: red">$ 50</span>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="deliverytype" value="1" id = "checkbox2">Email and Post <span style="color: red">$ 100</span></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="deliverytype" value="2" id = "checkbox3">Only Post <span style="color: red">$ 80</span></label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="    color: white;"><span>2.Your receipient</span></div>
                        <div class="panel-body reuters">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row"><label for="title">Title</label></div>
                                    <div class="row"><select class="form-control-delivery" name="title"
                                                             placeholder="optional">
                                            @if($template->title == "0")
                                                <option value="0" selected>Mr</option>
                                                <option value="1">Mrs</option>
                                                <option value="2">Miss</option>
                                                <option value="3">Ms</option>
                                                <option value="4">Mr & Ms</option>
                                                <option value="5">Dr</option>
                                            @elseif($template->title == "1")
                                                <option value="0" >Mr</option>
                                                <option value="1" selected>Mrs</option>
                                                <option value="2">Miss</option>
                                                <option value="3">Ms</option>
                                                <option value="4">Mr & Ms</option>
                                                <option value="5">Dr</option>
                                            @elseif($template->title == "2")
                                                <option value="0" >Mr</option>
                                                <option value="1" >Mrs</option>
                                                <option value="2" >Miss</option>
                                                <option value="3" selected>Ms</option>
                                                <option value="4">Mr & Ms</option>
                                                <option value="5">Dr</option>
                                            @elseif($template->title == "3")
                                                <option value="0" >Mr</option>
                                                <option value="1" >Mrs</option>
                                                <option value="2" >Miss</option>
                                                <option value="3">Ms</option>
                                                <option value="4" selected>Mr & Ms</option>
                                                <option value="5">Dr</option>
                                            @else
                                                <option value="0" >Mr</option>
                                                <option value="1" >Mrs</option>
                                                <option value="2" >Miss</option>
                                                <option value="3">Ms</option>
                                                <option value="4">Mr & Ms</option>
                                                <option value="5" selected>Dr</option>
                                                @endif
                                        </select></div>
                                </div>
                                <div class="col-lg-6 text-left">
                                    <div class="row"><label for="title">Extended Info:</label></div>
                                    <div class="row"><select class="form-control-delivery" name="extendedinfo"
                                                             placeholder="optional">
                                            @if($template->extendedinfo == "0")
                                                <option value="0" selected>& family</option>
                                                <option value="1">& staff</option>
                                                <option value="2">& company</option>
                                            @elseif($template->extendedinfo == "1")
                                                <option value="0" >& family</option>
                                                <option value="1" selected>& staff</option>
                                                <option value="2">& company</option>
                                            @else
                                                <option value="0" >& family</option>
                                                <option value="1" >& staff</option>
                                                <option value="2" selected>& company</option>
                                            @endif
                                        </select></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 text-left">
                                    <div class="row"><label for="delivery_firstname">FirstName*</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ $template->firstname }}"
                                                            name="delivery_firstname" required></div>
                                </div>
                                <div class="col-lg-6 text-left">
                                    <div class="row"><label for="delivery_lastname">LastName*</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ $template->lastname }}"
                                                            name="delivery_lastname" required></div>
                                </div>
                                <div id = "delivery_address">
                                    <div class="col-lg-12">
                                        <label>Delivery Address</label>
                                    </div>
                                    <div class="row" id = "delivery_address">
                                        <div class="col-lg-6" style="padding-right: 0px;"><input
                                                    class="form-control-delivery" type="text"
                                                    value="{{ $template->deliveryadd1 }}"
                                                    name="delivery_address1"
                                            ></div>
                                        <div class="col-lg-6" style="padding-right: 0px;"><input
                                                    class="form-control-delivery" type="text"
                                                    value="{{ $template->deliveryadd2 }}"
                                                    name="delivery_address2" placeholder="optional"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="delivery_city">
                                <div class="col-lg-4" style="padding-right: 0px;">
                                    <div class="row"><label for="delivery_city">City</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ $template->city }}"
                                                            name="delivery_city"  style="width: 100%;"></div>
                                </div>
                                <div class="col-lg-4" style="padding-right: 0px;">
                                    <div class="row"><label for="delivery_state">State</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ $template->state }}"
                                                            style="width: 100%;"
                                                            name="delivery_state" ></div>
                                </div>
                                <div class="col-lg-4" style="padding-right: 0px;">
                                    <div class="row"><label for="delivery_code">Postal code</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ $template->postalcode }}"
                                                            style="width: 100%;"
                                                            name="delivery_postalcode" ></div>
                                </div>
                            </div>
                            <div class="row" id = "delivery_country">
                                <div class="col-lg-12">
                                    <div class="row"><label for="delivery_city">Country</label></div>
                                    <div class="row">
                                        <select class="form-control-delivery" name="country"
                                                style="width: 50%!important;">
                                            <option value="0">USA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Recipient's Email</label>
                                    <input class="form-control-delivery" type="email"  id = "delivery_email"
                                           value="{{ $template->reemail }}"
                                           name="delivery_email">
                                </div>
                                <div class="col-lg-6" id = delvery_phone>
                                    <label>Recipient's Phone</label>
                                    <input class="form-control-delivery" type="text" value="{{  $template->rephone }}"
                                           name="delivery_phone" placeholder="optional">

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="    color: white;"><span>3.Delivery Date</span></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="label-text"><span>Earlist Date:7 Days from Today</span></div>
                                        <div class="label-text"><span>Lastest Date:20 Years from Today</span></div>
                                        <div class="form-group" id="data_2" style="padding: 1rem;margin-bottom: 0px;">
                                            <div class="input-group date col-md-12">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span><input type="text"
                                                                                                     value="{{ $template->deliverydate }}"
                                                                                                     class="form-control"
                                                                                                     name="delivery_date"
                                                                                                     required>
                                            </div>
                                        </div>
                                        <div class="label-text"><span>Your date is not there? Please <a
                                                        href="{{ url('/tailorcontact') }}"><span style="color: blue;">Contact Us</span> </a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-xs-6 text-left" style="padding-left: 0px !important;">
                                @if($template->orderstate != "1")
                                <input type="button" class="btn-addcart" value="CREATE ORDER" id="add-cart" onclick="createorder()">
                                @endif
                            </div>
                        <div class="col-xs-6 text-right" style="padding-right: 0px !important;">
                            <input type="button" class="btn-addcart" value="UPDATE" id="add-cart" onclick="update()">
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}

        </div>

    </section>

    <link href="/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <script src="/site/js/vendor/jquery-1.11.2.min.js"></script>
    {{--<script src="site/js/vendor/bootstrap.min.js"></script>--}}

    <script src="/site/js/plugins.js"></script>
    <script src="/site/js/main.js"></script>
    <script src="/site/js/modernizr.js"></script>
    <script src="/site/js/jquery.js"></script>
    <script type="text/javascript" src="/site/js/xzoom.min.js"></script>

    <!-- hammer plugin here -->
    <script type="text/javascript" src="/site/js/jquery.hammer.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <script type="text/javascript" src="/site/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="/site/js/magnific-popup.js"></script>
    <script src="/site/js/foundation.min.js"></script>
    <script src="/site/js/setup.js"></script>
    <script src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="/site/js/MaxLength.min.js"></script>
    <script type="text/javascript">
        var date = new Date();
        var stadate = new Date();
        var endate = new Date();
        stadate.setDate(date.getDate() + 7);
        endate.setDate(date.getDate() + 7305);
        $('#data_2 .input-group.date').datepicker({
            startView: 0,
            format: "mm-dd-yyyy",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            startDate: stadate,
            endDate: endate,
        });
        $("#TextBox1").MaxLength({MaxLength: 176});
        $('#checkbox1').on('click', function () {
            $('#delivery_address').hide('1000');
            $('#delivery_city').hide('1000');
            $('#delivery_country').hide('1000');
            $('#delvery_phone').hide('1000');
        });
        $('#checkbox2').on('click', function () {
            $('#delivery_address').show('1000');
            $('#delivery_city').show('1000');
            $('#delivery_country').show('1000');
            $('#delvery_phone').show('1000');
            $('#delivery_email').attr('placeholder','');
        });
        $('#checkbox3').on('click', function () {
            $('#delivery_address').show('1000');
            $('#delivery_city').show('1000');
            $('#delivery_country').show('1000');
            $('#delvery_phone').show('1000');
            $('#delivery_email').attr('placeholder','optional');
        });

        function update(){
            $('#textcontent').append('<input type = "hidden" name = "buttonstate" value = "0">');
            $('#textcontent').submit();
        }
        function createorder(){
            $('#textcontent').append('<input type = "hidden" name = "buttonstate" value = "1">');
            $('#textcontent').submit();
        }

    </script>
@endsection
