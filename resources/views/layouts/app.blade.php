<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('site/favicon.ico') }}">
    <link href='https://fonts.googleapis.com/css?family=Sacramento' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet'>
    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">
    <!--<link rel="stylesheet" href="site/css/bootstrap-theme.min.css">-->


    <!--For Plugins external css-->
    <link rel="stylesheet" href="{{ asset('site/css/plugins.css') }}"/>
    <!--<link rel="stylesheet" href="site/css/mdb.css"/>-->
    <link rel="stylesheet" href="{{ asset('site/css/opensans-web-font.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/css/montserrat-web-font.css') }}"/>

    <!--For font-awesome css-->
    <link rel="stylesheet" href="{{ asset('site/css/font-awesome.min.css') }}"/>

    <!--Theme custom css -->
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/paritclejs.css') }}">

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="{{ asset('site/css/responsive.css') }}"/>

    <link href='https://fonts.googleapis.com/css?family=Julius Sans One' rel='stylesheet'>

    <script src="{{ asset('site/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
</head>
<body>
<header>

    <nav class="mainmenu navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="brand-bg" style="float: left;">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div id="logo" class="col-lg-12">
                            <span style="font-size: 40px;">Letter</span><span> from</span>
                            <p style="font-size: 40px;margin-top: 5px;">Heaven</p>
                        </div>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse" style="float: left;    font-family:Julius Sans One;
    font-size: 1rem;">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/voice') }}">Voice</a></li>
                        <li><a href="{{ url('/shop') }}">Shop</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                        @if (!Auth::guest())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/home">
                                            My Orders
                                        </a>

                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @else
                            <li><a href="{{ route('login') }}">Login/Register</a></li>
                        @endif
                        <li><a href="/cart"><i class="fa fa-shopping-cart">
                                    @if(Cart::getContent()->count())
                                    ({{Cart::getContent()->count()}})
                                    -$
                                        {{Cart::getTotal()}}
                                        @endif
                                </i></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class='preloader' style="position: relative !important;">
    <div class='loaded'>&nbsp;</div>
</div>
@yield('content')

<footer



>
    <div class="container">

        <div class="row text-center" style="margin-top: 3rem;">
            <hl>Join our mailing list Never miss an update</hl>
        </div>
        <div class="row text-center"
             style="background: #ffffff;    position: relative;    margin-left: 20%;    margin-right: 20%;    ">
            <div class="col-lg-8 text-center">
                <form class="navbar-form">
                    <div class="form-group">
                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon"
                                  style="    background: #ffffff;    border: white;    border-bottom: 1px solid;    border-radius: 0;"><i
                                        class="fa fa-envelope-o fa-fw"></i></span>
                            <input class="form-control" type="text" placeholder="Email address"
                                   style="border: none;border-radius: 0;box-shadow: none;border-bottom: 1px solid #605e5e;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4" style="padding: 10px;">
                <button type="submit" class="btn btn-default"
                        style="background: #2f2e2e;color: #ffffff;padding: 0;border-radius: 0;border: 3px solid #81919c;width: 160px;    height: 35px;">
                    SubScribe Now
                </button>
            </div>
        </div>
        <div class="row text-center" style="    margin-top: 1rem;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="social-network">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>

        </div>
    </div>
</footer>
<!-- Scripts -->

<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
    window.__lc = window.__lc || {};
    window.__lc.license = 9382860;
    (function() {
        var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
    })();
</script>
<!-- End of LiveChat code -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
