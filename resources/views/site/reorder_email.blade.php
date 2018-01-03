<!DOCTYPE HTML>
<html>
<head>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        var imageurl = '/images/{{ $template->pro_image }}';
        var templateId = '{{ $template->id }}';
    </script>
    <script>
        var editorheight;
        var editorwidth;
        var img = document.createElement('img');
        img.src = imageurl;
        var poll = setInterval(function () {
            if (img.naturalWidth) {
                clearInterval(poll);
                console.log(img.naturalWidth, img.naturalHeight);
                editorheight = img.naturalHeight;
                editorwidth = img.naturalWidth;
            }
        }, 1);
        img.onload = function () {
            console.log('Fully loaded');
        }
        editorheight = 1145;
        editorwidth = 816;
    </script>
    <script src="/site/js/editor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#txtEditor").Editor();
            $("#txtEditor").Editor("setText", "{!! $template->pro_text !!}")
        });
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/site/css/editor.css" type="text/css" rel="stylesheet"/>
    <title>Letter from heaven</title>
</head>
<body>
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
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login/Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
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
                    @endif
                    <li><a href="/cart"><i class="fa fa-shopping-cart">
                                @if(Cart::getContent()->count())
                                    ({{Cart::getContent()->count()}})
                                    -${{Cart::getTotal()}}
                                @endif
                            </i></a></li>

                </ul>
            </div>
        </div>
    </div>
</nav>
</header>
<div class="container-fluid" style="margin-top: 10rem;">
    {{ Form::open(['method' => 'get','route' => ['/home/editemail/reorder',$template->id],'style'=>'display:inline','class'=>'form-horizontal','id'=>'textcontent']) }}
    {{ csrf_field() }}
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 nopadding" id="editorcontent">
                    <textarea class="form-control" id="txtEditor"></textarea>
                    <div class="row">
                        <div class="col-xs-6 text-right" style="margin-top: 20px;">
                            <input type="button" onclick="reorder()" class="btn-addcart" value="REORDER" id="addcart">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
{{--<div class="container-fluid footer">--}}
{{--<p class="pull-right">&copy; Suyati Technologies--}}
{{--<script>document.write(new Date().getFullYear())</script>--}}
{{--. All rights reserved.--}}
{{--</p>--}}
{{--</div>--}}
<footer>
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
    <script type="text/javascript">
        $('#savedraft').on('click',function(){
        });
        function reorder(){
            var text = $('.Editor-editor').html();
            $('#textcontent').append('<input type = "hidden" name = "textcontent" value = "'+text+'">');
            $('#textcontent').submit();
        }

    </script>
</footer>
</body>
</html>
