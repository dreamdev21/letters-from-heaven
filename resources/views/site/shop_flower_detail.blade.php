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

    <div class="container" style="margin-top: 7rem;color: #7cc2cb">
        <div class="col-xs-12">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/shop') }}">Shop</a>
                </li>
                <li>
                    <a href="{{ url('/shop/flower') }}">Flower</a>
                </li>
                <li class="active">
                    <a href="#">{{ $template->name }}</a>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <h4><span class="yahei" >Categories</span></h4>
                <nav id="sidebar" class="reuters">
                    <ul class="list-unstyled components" style="line-height:2;font-size: 12px;">
                        <li class="active">Flower
                        </li>
                        <li>Plant</li>
                        <li>5/10/20 Year</li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-6 col-md-6">
                {{--<section id="fancy">--}}
                    {{--<div class="row">--}}
                        {{--<div class="large-5 column">--}}
                            {{--<div class="xzoom-container">--}}
                                {{--<img class="xzoom4" id="xzoom-fancy" src="/images/{{ $template->image }}"--}}
                                     {{--name="mainimage"--}}
                                     {{--xoriginal="/images/flowerpreview.jpg" style="width:410px;"/>--}}
                                {{--<div class="xzoom-thumbs">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="large-7 column"></div>--}}
                    {{--</div>--}}
                {{--</section>--}}
                <div class="row">
                    <img src="/images/{{ $template->image }}" name="mainimage" id="xzoom-fancy" style="width: 100%;">
                </div>
                <div class="row">
                    <?php for ($i = 1; $i < 20; $i++) {
                        $imgnum = "image" . $i;
                        if ($template[$imgnum]) {
                            $imgpath = "/images/" . $template->$imgnum;
                            echo("<div class='" . "col-lg-4" . "'>
                                        <img
                                                class='" . "image-small-container" . "'
                                                src='" . $imgpath . "' onclick='" . "changeimage" . $i . "()" . "'>
                                </div>");

                            echo(
                                "<script type='" . "text/javascript" . "'>
                                    function changeimage" . $i . "(){
                                        document.mainimage.src='" . $imgpath . "';
                                    }" . "</script>"
                            );
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4  col-md-4">
                <div class="row large-12 column"><h3><span class="yahei">{{ $template->name }}</span> (<span
                              style="color:red;">${{ $template->price }}</span>)</h3></div>
                <div class="row text-left">
                    <p style="color: #7cc2cb" class="reuters">{{ $template->detail }}</p>
                </div>
                <div style="padding-top: 1rem;">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="    color: white;"><span>1.Your Item</span></div>
                        <div class="panel-body reuters">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row text-left">
                                        <div class="col-sm-6">
                                        <label>{{ $template->name }} </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>$ {{ $template->price }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::open(['method' => 'post','route' => ['/checkout', $template->id],'style'=>'display:inline','class'=>'form-horizontal']) }}
                    {{ csrf_field() }}

                    <div class="panel panel-default">
                        <div class="panel-heading" style="    color: white;"><span>2.Your receipient</span></div>
                        <div class="panel-body reuters">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row"><label for="title">Title</label></div>
                                    <div class="row"><select class="form-control-delivery" name="title"
                                                             placeholder="optional">
                                            <option value=""></option>
                                            <option value="0">Mr</option>
                                            <option value="1">Mrs</option>
                                            <option value="2">Miss</option>
                                            <option value="3">Ms</option>
                                            <option value="4">Mr & Ms</option>
                                            <option value="5">Dr</option>
                                        </select></div>
                                </div>
                                <div class="col-lg-6 text-left">
                                    <div class="row"><label for="title">Extended Info:</label></div>
                                    <div class="row"><select class="form-control-delivery" name="extendedinfo"
                                                             placeholder="optional">
                                            <option value=""></option>
                                            <option value="0">& family</option>
                                            <option value="1">& staff</option>
                                            <option value="2">& company</option>
                                        </select></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 text-left">
                                    <div class="row"><label for="delivery_firstname">FirstName*</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ old('delivery_firstname') }}"
                                                            name="delivery_firstname" required></div>
                                </div>
                                <div class="col-lg-6 text-left">
                                    <div class="row"><label for="delivery_lastname">LastName*</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ old('delivery_lastname') }}"
                                                            name="delivery_lastname" required></div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Delivery Address*</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6" style="padding-right: 0px;"><input
                                                class="form-control-delivery" type="text"
                                                value="{{ old('delivery_address1') }}"
                                                name="delivery_address1" required></div>
                                    <div class="col-lg-6" style="padding-right: 0px;"><input
                                                class="form-control-delivery" type="text"
                                                value="{{ old('delivery_address2') }}"
                                                name="delivery_address2" placeholder="optional"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4" style="padding-right: 0px;">
                                    <div class="row"><label for="delivery_city">City*</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ old('delivery_city') }}"
                                                            name="delivery_city" required style="width: 100%;"></div>
                                </div>
                                <div class="col-lg-4" style="padding-right: 0px;">
                                    <div class="row"><label for="delivery_state">State*</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ old('delivery_state') }}"
                                                            style="width: 100%;"
                                                            name="delivery_state" required></div>
                                </div>
                                <div class="col-lg-4" style="padding-right: 0px;">
                                    <div class="row"><label for="delivery_code">Postal code*</label></div>
                                    <div class="row"><input class="form-control-delivery" type="text"
                                                            value="{{ old('delivery_postalcode') }}"
                                                            style="width: 100%;"
                                                            name="delivery_postalcode" required></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row"><label for="delivery_city">Country*</label></div>
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
                                    <label>Recipient's Phone</label>
                                    <input class="form-control-delivery" type="text" value="{{ old('delivery_phone') }}"
                                           name="delivery_phone" placeholder="optional">

                                </div>
                                <div class="col-lg-6">
                                    <label>Recipient's Email</label>
                                    <input class="form-control-delivery" type="email"
                                           value="{{ old('delivery_email') }}"
                                           name="delivery_email" placeholder="optional">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Save this address?</label>
                                    <div class="radio">
                                        <label><input type="radio" name="saveaddress" value="0" required>Yes,Save
                                            address in my
                                            address book</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="saveaddress" value="1">No,Do not save this
                                            address</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
                                                                                                     value="{{ old('delivery_date') }}"
                                                                                                     class="form-control"
                                                                                                     name="delivery_date" required>
                                            </div>
                                        </div>
                                        <div class="label-text"><span>Your date is not there? Please <a
                                                        href="{{ url('/tailorcontact') }}"><span style="color: blue;">Contact Us!</span> </a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="    color: white;"><span>4.Enter card message</span></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row text-left">
                                        <label>Enter your message:</label>
                                    </div>
                                    <div class="row">
                                        <textarea id="TextBox1" name="cardmessage" style="height: 100px;width: 100%"
                                                  >{{ old('cardmessage') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row text-left">
                                        <label>Signature E.g. Love Steve</label>
                                    </div>
                                    <div class="row">
                                        <input type="text" name="signature" style="width: 100%"
                                               value="{{ old('signature') }}">
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row text-left">
                                        <input type="submit" class="btn-addcart" value="Save as Draft">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row text-right">
                                        <input type="submit" class="btn-addcart" value="Add to Cart" id="add-cart">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            {{ Form::close() }}
        </div>

    <div class="row" style="color: black">
        <div class="col-md-4">
            <div class="row" id="gift" style="    margin-bottom: 40px;height: 20rem">
                <div class="content"
                     style="    font-size: 3rem;    text-align: center;    margin-top:5rem;    font-family: Alex Brush;    font-weight: 700;">
                    Personal
                </div>
                <div class="content" style="font-size: 2rem;text-align: center;    letter-spacing: 6px;">
                    Gift
                </div>
                <div class="row text-center"><a href="#"
                                                style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"
                                                class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                title="" target="_self"><span>See More</span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row" id="email_photo" style="height: 20rem;  margin-bottom: 40px;">
                <div class="content"
                     style="    font-size: 3rem;    text-align: center;    margin-top: 1.7rem;    font-family: Alex Brush;    font-weight: 700;">
                    Hand Writing/<br>
                    E-Mail
                </div>
                <div class="content" style="font-size: 2rem;text-align: center;    letter-spacing: 6px;">
                    Letter
                </div>
                <div class="row text-center"><a href="{{ url('/shop/email') }}"
                                                style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"
                                                class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                title="" target="_self"><span>See More</span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row" id="email" style="margin-top: 0px !important;">
                <div class="content"
                     style="    font-size: 3rem;    text-align: center;    margin-top:5rem;    font-family: Alex Brush;    font-weight: 700;">
                    Concierge
                </div>
                <div class="content" style="font-size: 2rem;text-align: center;    letter-spacing: 6px;">
                    Tailored Service
                </div>
                <div class="row text-center"><a href=" {{url('/tailorcontact')}}"
                                                style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"
                                                class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                title="" target="_self"><span>See More</span></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
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


    </script>
@endsection

