@extends('layouts.app')

@section('content')

    {{--<div id="particles-js"></div>--}}
    <header class="home-bg" style="min-height: 30rem !important;">

        <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style" style="right:0px; top:150px;">

            <a class="a2a_button_facebook"><i class="fa fa-facebook"></i></a>
            <a class="a2a_button_instagram"><i class="fa fa-instagram"></i></a>
            <a class="a2a_button_twitter"><i class="fa fa-twitter"></i></a>
            <a class="a2a_button_pinterest"><i class="fa fa-pinterest"></i></a>
            <a class="a2a_button_youtube"><i class="fa fa-youtube-play"></i></a>
        </div>

        <script async src="https://static.addtoany.com/menu/page.js"></script>
    </header>



    <section id="stories" class="sections" style="font-family:libre baskerville,serif;background-color: #F9F9F9;">
        <div class="container" id="ourteam">

            <!-- Example row of columns -->
            <div class="row text-center"
                 style="font-family:helvetica-w01-light,helvetica-w02-light,sans-serif;color: #2F2E2E;    margin-bottom: 2rem;">
                <div class="header-details">
                    <h1 style="margin-top: 3rem;margin-bottom: 3rem;">​Contact Us</h1>
                </div>
            </div>
            <div class="container col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                {{ Form::open(['method' => 'post','route' => ['contact/save'],'style'=>'display:inline','class'=>'form-horizontal']) }}


                <div class="form-group"><input type="text" name="name" style="border-radius: 0px !important;border: 1px solid #000000;"
                                               required autofocus
                                               placeholder="Name"
                                               class="form-control">
                </div>
                <div class="form-group"><input type="email" name="email" style="border-radius: 0px !important;border: 1px solid #000000;"
                                               required autofocus
                                               placeholder="Email"
                                               class="form-control">
                </div>
                <div class="form-group"><input type="text" name="subject" style="border-radius: 0px !important;border: 1px solid #000000;"
                                               required autofocus
                                               placeholder="Subject"
                                               class="form-control">
                </div>
                <div class="form-group"><textarea rows= "4" name="message" style="border-radius: 0px !important;border: 1px solid #000000;"
                                               required autofocus
                                               placeholder="Message"
                                               class="form-control "></textarea>

                </div>
                <div class="form-group">
                    {{ Form::submit('Send', ['class' => 'btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded pull-right','style' => 'margin-right: 0px;margin-top: 0px;']) }}
                </div>



                {{ Form::close() }}
            </div>
        </div> <!-- /container -->
    </section>



    <script src="{{ asset('site/js/vendor/jquery-2.1.1.js') }}"></script>
    {{--<script src="{{ asset('site/js/vendor/bootstrap.min.js') }}"></script>--}}
    {{--<script src="{{ asset('site/js/particlehome.js') }}"></script>--}}

    <script src="{{ asset('site/js/plugins.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>
    {{--<script src="{{ asset('site/js/particle.js') }}"></script>--}}
@endsection
