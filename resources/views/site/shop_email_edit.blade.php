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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Julius Sans One' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/site/css/editor.css" type="text/css" rel="stylesheet"/>
    <title>Letters from heaven</title>
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
<?php
$items = Cart::getContent();

foreach($items as $item)

{
list($width, $height, $type, $attr) = getimagesize("images/" . $item->attributes->image);
if($item->id == $template->id){
?>
<script type="text/javascript">
    var imageurl = '/images/{{ $item->attributes->image }}';
    var templateId = '{{ $item->id }}';
</script>
<script>
    var editorheight = {{ $height }};
    var editorwidth = {{ $width }};

</script>
<script src="/site/js/editor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#txtEditor").Editor();
        $("#txtEditor").Editor("setText", '{!! $item->pro_text !!}');
        // $('.Editor-editor').css('overflow-y', 'hidden');
    });
</script>

<div class="container-fluid" style="margin-top: 10rem;">
    {{ Form::open(['method' => 'get','route' => ['/shop/email/saveemail'],'style'=>'display:inline','class'=>'form-horizontal','id'=>'textcontent']) }}
    {{ csrf_field() }}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="container">
        <div class="row text-center" style="margin: 0;">
            <div class="col-lg-12 nopadding" style="text-align: -webkit-center;font-size: 18px;margin-top: 10px;">
                <div class="row" id="editorcontent" style="margin: 0;text-align: -webkit-center">
                    <textarea class="form-control paginate" id="txtEditor" style="resize: none;"></textarea><label>PAGE : 1</label>
                </div>
                <div class="row"  style="width:{{ $width }}px;margin: 0">
                    <div class="col-xs-3 text-left" style="margin-top: 20px;margin-left:-15px;">
                        <input type="button" onclick="draft()" class="btn-addcart" value="SAVE AS DRAFT"
                               id="savedraft">
                    </div>
                    <div class="col-xs-3 text-center" style="margin-top: 20px;">
                        <input type="button" onclick="gotoDelivery()" class="btn-addcart" value="GO TO DELIVERY"
                               id="addcart">
                    </div>
                    <div class="col-xs-3 text-right" style="margin-top: 20px;" id = "removebtn">
                        <input type="button" onclick="removePage()" class="btn-addcart" value="REMOVE PAGE">
                    </div>
                    <div class="col-xs-3 text-right" style="margin-top: 20px;margin-left: 15px;padding-right: 0px;">
                        <input type="button" onclick="addNewPage()" class="btn-addcart" value="ADD NEW PAGE">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>

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
        <script type="text/javascript">
            var editor_count = 1;
            $("#editorcontent").on('keydown', function() {
                var currentHeight = ($(".Editor-editor")[editor_count-1].scrollHeight);
                var editorheight = {{ $height }};
                console.log(currentHeight);
                console.log(editorheight);
                if(currentHeight >  editorheight ){
                    $.confirm({
                        icon: 'fa fa-plus-circle fa-plus-circle',
                        title: 'Confirm',
                        type:'green',
                        content: 'I need more page.',
                        draggable: true,
                        dragWindowBorder: false,
                        animationBounce: 2.5, // default is 1.2 whereas 1 is no bounce.
                        animationSpeed: 500, // 2 seconds
                        theme: 'material',
                        buttons: {
                            YES: function () {
                                addNewPage();
                            },
                            NO: function () {

                            }
                        }
                    });
                }
            });

            $(function () {
                draftever10sec();
            });

            function draftever10sec() {
                $('#textcontent').append('<input type = "hidden" name = "draft" value = "0">');
                var text = $('.Editor-editor').html();
                // if(text == "<div><br></div>" && editor_count != 1){
                //     $.confirm({
                //         icon: 'fa fa-minus-circle fa-minus-circle',
                //         title: 'Are you sure reduce blank pages?',
                //         type:'green',
                //         content: 'It seems you have one more blank page. You can reduce pages directly or manually click REMOVE PAGE button.',
                //         draggable: true,
                //         dragWindowBorder: false,
                //         animationBounce: 2.5, // default is 1.2 whereas 1 is no bounce.
                //         animationSpeed: 500, // 2 seconds
                //         theme: 'material',
                //         buttons: {
                //             YES: function () {
                //                 removeAllPage();
                //             },
                //             NO: function () {
                //
                //             }
                //         }
                //     });
                // }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url: '/shop/email/updatetext',
                    data: {textcontent: text, draft: 0, id:{{ $item->id }} },
                    success: function (response) {
                        console.log(response);
                        setTimeout(function () {
                            draftever10sec();
                        }, 5000);

                    }
                });
            }

            $('#savedraft').on('click', function () {
                draft();
            });

            function draft() {
                $('#textcontent').append('<input type = "hidden" name = "draft" value = "0">');
                var text = $('.Editor-editor').html();
                console.log(text);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url: '/shop/email/saveemail',
                    data: {textcontent: text, draft: 0, id:{{ $item->id }}},
                    success: function (response) {
                        console.log(response);
                        window.location.href = response;
                    }
                });
            }

            function gotoDelivery() {
                $('#textcontent').append('<input type = "hidden" name = "draft" value = "0">');
                var text = $('.Editor-editor').html();
                $('#textcontent').append('<input type = "hidden" name = "textcontent" value = "' + text + '">');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url: '/shop/email/saveemail',
                    data: {textcontent: text, draft: 1, id:{{ $item->id }}},
                    success: function (response) {
                        console.log(response);
                        window.location.href = response;
                    }
                });
            }

            function addNewPage() {
                if(editor_count <  5){
                    editor_count++;
                    var newEditor = 'txtEditor' + editor_count;
                    var newEditorId = '#txtEditor' + editor_count;
                    $('#editorcontent').append('<textarea class="form-control" id="'+newEditor+'"></textarea><label id = "label'+newEditor+'">PAGE : '+editor_count+'</label>');
                    $(newEditorId).Editor();
                    $('.Editor-editor').css('overflow-y', 'hidden');
                }else{
                    $.alert({
                        title: 'Sorry!',
                        type: 'blue',
                        draggable: true,
                        dragWindowBorder: false,
                        animationBounce: 2.5, // default is 1.2 whereas 1 is no bounce.
                        animationSpeed: 500, // 2 seconds
                        theme: 'material',
                        content: 'We limit letter pages at 5.',
                });
                }

                // if(editor_count > 1){
                //     $('#removebtn').css('display','show');
                // }
            }
            function removePage(){
                if(editor_count != 1){
                    $('#editor' + editor_count).remove();
                    $('#txtEditor' + editor_count).remove();
                    $('#labeltxtEditor' + editor_count).remove();
                    editor_count--;
                    // if(editor_count == 1){
                    //     $('#removebtn').css('display','none');
                    // }
                }else{
                    $.alert({
                        title: 'Warning!',
                        type: 'blue',
                        draggable: true,
                        dragWindowBorder: false,
                        animationBounce: 2.5, // default is 1.2 whereas 1 is no bounce.
                        animationSpeed: 500, // 2 seconds
                        theme: 'material',
                        content: 'You should have at least 1 page!',
                    });
                }
            }

        </script>
    </div>
    <?php
    }
    }
    ?>
</footer>
</body>
</html>
