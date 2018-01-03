@extends('layouts.app')

@section('content')

    <div id="particles-js"></div>
    <header class="home-bg ">
        <div class="overlay-img">


            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12"
                         style="text-align: center;font-family:libre baskerville;">
                        <div class="header-details">
                            <p style="font-size: 5rem;    line-height: 1;">Letter from Heaven</p>
                            <p style="font-size: 1.5rem;">Touch the heart of your beloved ones from Heaven!</p>
                            <span style="font-size:1.5rem;">Send them your love in a letter or surprise them with a thoughtful gift!</span>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style" style="right:0px; top:150px;">

            <a class="a2a_button_facebook"><i class="fa fa-facebook"></i></a>
            <a class="a2a_button_instagram"><i class="fa fa-instagram"></i></a>
            <a class="a2a_button_twitter"><i class="fa fa-twitter"></i></a>
            <a class="a2a_button_pinterest"><i class="fa fa-pinterest"></i></a>
            <a class="a2a_button_youtube"><i class="fa fa-youtube-play"></i></a>
        </div>

        <script async src="https://static.addtoany.com/menu/page.js"></script>
    </header>

    <!-- Sections -->
    <section id="promotion-area" class="sections">
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12"
                     style="text-align: center;font-size:3rem;padding: 3rem;">
                    <div class="header-details">
                        <h1 style="letter-spacing: 6px;">Services</h1>
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-5 col-md-offset-1 col-sm-5 col-md-offset-1  col-xs-12 .photo_text">
                        <div class="row" id="email_photo" style="    margin-bottom: 100px;">
                            <div class="content"
                                 style="    font-size: 3rem;    text-align: center;    margin-top: 10rem;    font-family: Alex Brush;    font-weight: 700;">
                                Hand Writing/<br>
                                E-Mail
                            </div>
                            <div class="content" style="font-size: 2rem;text-align: center;    letter-spacing: 6px;">
                                Letter
                            </div>
                            <div class="row text-center"><a href="{{ url('/shop/email') }}" style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"
                                                            class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                            title="" target="_self"><span>See More</span></a>
                            </div>
                        </div>
                        <div class="row" id="email">
                            <div class="content"
                                 style="    font-size: 3rem;    text-align: center;    margin-top:5rem;    font-family: Alex Brush;    font-weight: 700;">
                                Concierge
                            </div>
                            <div class="content" style="font-size: 2rem;text-align: center;    letter-spacing: 6px;">
                                Tailored Service
                            </div>
                            <div class="row text-center"><a href=" {{url('/tailorcontact')}}" style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"
                                                            class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                            title="" target="_self"><span>See More</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="row" id="gift" style="    margin-bottom: 40px;height: 250px">
                            <div class="content"
                                 style="    font-size: 3rem;    text-align: center;    margin-top:5rem;    font-family: Alex Brush;    font-weight: 700;">
                                Personal
                            </div>
                            <div class="content" style="font-size: 2rem;text-align: center;    letter-spacing: 6px;">
                                Gift
                            </div>
                            <div class="row text-center"><a href="#" style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"
                                                            class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                            title="" target="_self"><span>See More</span></a>
                            </div>
                        </div>
                        <div class="row" id="flower">
                            <div class="content"
                                 style="    font-size: 3rem;  color: white;  text-align: center;    margin-top: 10rem;    font-family: Alex Brush;    font-weight: 700;">
                                Fresh Gift
                            </div>
                            <div class="content" style="font-size: 2rem;text-align: center;    letter-spacing: 6px;">
                                Flowers & Plants
                            </div>
                            <div class="row text-center"><a href="{{ url('/shop/flower') }}" style="vertical-align: middle;float: initial;font-family:  helvetica-w01-light,helvetica-w02-light,sans-serif;"
                                                            class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                            title="" target="_self"><span>See More</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- /container -->
    </section>


    <section id="our-team" class="sections">
        <div class="container" id="ourteam">
            <!-- Example row of columns -->
            <div class="row">
                <div class="team-heading">
                    <h1>​We will deliver your thoughts for you</h1>
                    <p>Everyone equally has an end to their lives and we never know when it comes.<br>
                        Are you prepared for that time to come? Are you aware how sad your family will become and miss you
                        so much?
                        You may feel regret in heaven you couldn't tell your family or friends properly your last words
                        .<br>
                        We can have your back for you. We can send your letter or gift to your friend or family even after
                        you are raised to heaven!
                        Surprise them by remembering their special days even from heaven! It will put smile on their face
                        and remember you!<br>
                        ​
                        On any unexpected occasion one day may happen to you, be prepared for your loved ones to be informed
                        all the important information about you .
                        It's your responsibility to care the people left behind!<br>
                        ​
                        ( to be continued)</p>
                </div>

            </div>

        </div> <!-- /container -->
    </section>
    <section id="stories" class="sections" >
        <div class="row">
            <div class=""
                 style="text-align: center;font-family:libre baskerville;font-size:2rem;min-height: 5rem;">
                <div class="header-details">
                    <h1>Voice From Customers</h1>
                </div>
            </div>
        </div>
        <div class="container col-lg-5 col-lg-offset-3 col-md-8 col-md-offset-2 col-xs-12" >
            <div class="row">
                <!-- Example row of columns -->

                <div class="row text-left"  style=" background: #f7f7f9;margin-bottom: 1rem;">
                    <div class="row " style="font-size: 2rem;">
                        Prepare now then no regret from heaven!
                    </div>
                    <div class="row ">
                        16.03.2016
                    </div>
                    <div class="row text-center">
                        <div class="row" style="margin-top: 1rem;margin-bottom: 1rem;">
                            <img src="{{ asset('/site/images/mailphoto.PNG') }}">
                        </div>
                    </div>
                    <div class="row ">
                        <div  class="row" style="font-size: 1rem">
                            To create your first blog post, click here and select 'Manage Posts' > New Post. Blogs are a great way to connect with your audience and keep them coming back. To really engage your site visitors we suggest you blog about subjects that are related to your site or busin.
                        </div>
                    </div>
                    <div class="row text-left"><a href="voice.html" style="vertical-align: middle;float: initial;"
                                                  class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                  title="" target="_self"><span>Read more</span></a>
                    </div>

                </div>
                <div class="row text-left" id="voice"  style=" background: #f7f7f9;margin-bottom: 1rem;">
                    <div class="row " style="font-size: 2rem;">
                        I can't wait to see my wife's surprised face from heaven!
                    </div>
                    <div class="row ">
                        16.03.2016
                    </div>
                    <div class="row text-center">
                        <div class="row" style="margin-top: 1rem;margin-bottom: 1rem;">
                            <img src="{{ asset('/site/images/wife.PNG') }}">
                        </div>
                    </div>
                    <div class="row ">
                        <div class="row" style="font-size: 1rem">
                            To create your first blog post, click here and select 'Manage Posts' > New Post. Blogs are a great way to connect with your audience and keep them coming back. To really engage your site visitors we suggest you blog about subjects that are related to your site or busin.
                        </div>
                    </div>
                    <div class="row text-left"><a href="voice.html" style="vertical-align: middle;float: initial;"
                                                  class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                  title="" target="_self"><span>Read more</span></a>
                    </div>

                </div>
                <div class="row text-left"  style=" background: #f7f7f9;margin-bottom: 1rem;">
                    <div class="row " style="font-size: 2rem;">

                        You won't disappoint your partner on his/her special day!
                    </div>
                    <div class="row ">
                        16.03.2016
                    </div>
                    <div class="row text-center">
                        <div class="row" style="margin-top: 1rem;margin-bottom: 1rem;">
                            <img src="{{ asset('/site/images/gift.PNG') }}">
                        </div>
                    </div>
                    <div class="row ">
                        <div class="row" style="font-size: 1rem">
                            To create your first blog post, click here and select 'Manage Posts' > New Post. Blogs are a great way to connect with your audience and keep them coming back. To really engage your site visitors we suggest you blog about subjects that are related to your site or busin.
                        </div>
                    </div>
                    <div class="row text-left"><a href="#" style="vertical-align: middle;float: initial;"
                                                  class="btn-element btn-element-1 btn btn-fullblack    btn-icon--before btn--rounded"
                                                  title="" target="_self"><span>Read more</span></a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-xs-12">
            <div style="margin-left: 15px;margin-right: 15px;">
                <section class="panel panel-default" style="border-radius: 0;">
                    <a href="#">
                        <header class="panel-heading">
                            <h5 class="panel-title text-center">Sample Letters</h5>
                        </header>
                    </a>
                    <div class="panel-body" style="padding: 0;">
                        <p><img src="{{ asset('/site/images/meet.PNG') }}" style="    width: 100%;"></p>
                    </div>
                </section>
                <section class="panel panel-default" style="border-radius: 0;">
                    <a href="#">
                        <header class="panel-heading">
                            <h6 class="panel-title text-center">We donate not support.</h6>
                            <h6  class="panel-title text-center">We donate 10% of your payment to support international children in need.</h6>
                        </header>
                    </a>
                    <div class="panel-body" style="padding: 0;">
                        <p><img src="{{ asset('/site/images/galley.PNG') }}" style="width: 100%;"></p>
                    </div>
                </section>
            </div>
        </div>
    </section>


    <script src="{{ asset('site/js/vendor/jquery-2.1.1.js') }}"></script>
    {{--<script src="{{ asset('site/js/vendor/bootstrap.min.js') }}"></script>--}}
    <script src="{{ asset('site/js/particlehome.js') }}"></script>

    <script src="{{ asset('site/js/plugins.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>
    <script src="{{ asset('site/js/particle.js') }}"></script>
@endsection
