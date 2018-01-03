@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/site/css/email_choose.css">
    <section id="email_choose" class="sections" style="margin-top: 7rem;color: #0dcbde;">
        <div class="container">
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

            <div class="row text-center div-main-m padding-bottom-20">
                <div class="col-xs-12"
                     style="background-image: url('/site/images/slide-2.jpg');height:27rem;padding-left: 15px;padding-right: 15px;">
                    <div class="row">
                        <div class="text-left" style="padding: 3rem;font-family: fantasy;">
                            <h1>5 YEARS /10 YEARS /20 YEARS PLAN</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6  col-sm-12 text-center"
                             style="padding: 3rem;font-family: fantasy;">
                            <h3>SAVE UP TO 25%!</h3>
                            <h5>We will remember the special day every year for</h5>
                            <span style="font-size:1.1rem;">BIRTHDAY/ANNIVERSARY/CHRISMAS/VALENTINESDAY</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center div-main-m">
                <div class="col-md-6 col-sm-12 col-xs-12 vertical-align pull-right"
                     style="background-image: url('/site/images/flower.jpg');height:17rem;width: 49%;">
                    <div class="row text-center" style="vertical-align: middle;">

                        <h1 style="margin-top: 8rem;color:white;">PLANT</h1>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12"
                     style="background-image: url('/site/images/flower.jpg');height:17rem;width: 49%;">
                    <div class="text-center" style="vertical-align: middle;">
                        <h1 style="margin-top: 8rem;color:white;">FLOWER</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-right: 0px;padding-left: 0px;">
                    <div class="div-main-m">
                        <h1 style="margin-top: 2rem;margin-bottom: 2rem;">POPULAR ITEMS</h1>
                    </div>
                    <div class="row text-center" style="padding-right: 0px;padding-left: 0px;">
                        @foreach($templates as $template)
                            <div id="email_choose_container" class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

                                <a href="/shop/flower/{{ $template->id }}">
                                    <div id="" style="    background-color: gainsboro;">

                                        <div id="emailtemplateimage" class="row">

                                            {{--<a href="#" data-toggle="modal" data-target="#myModal{{ $template->id }}">--}}
                                                <img
                                                        class="imagecontainer"
                                                        src="/images/{{ $template->image }}"
                                                        style="width: 13rem;height: 13rem;">
                                            {{--</a>--}}
                                            <div class="row text-center" style="padding: 1rem; font-size: 1rem;">
                                                {{ $template ->name }}
                                            </div>

                                            <div class="row text-center" style="font-size: 1rem;">
                                                <strong>${{ $template ->price }}</strong>
                                            </div>
                                            {{--<div class="row text-center" style="font-size: 1rem;">--}}
                                            {{--<a href="/shop/flower/{{ $template->id }}"--}}
                                            {{--style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"--}}
                                            {{--class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"--}}
                                            {{--title="" target="_self"><span>ADD TO CART</span></a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
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
    </section>
    </div>
    <script src="/site/js/vendor/jquery-1.11.2.min.js"></script>
    {{--<script src="/site/js/vendor/bootstrap.min.js"></script>--}}

    <script src="/site/js/plugins.js"></script>
    <script src="/site/js/main.js"></script>
@endsection
