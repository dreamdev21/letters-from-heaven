@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/site/css/email_choose.css">
    <style type="text/css">
        footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            background: black;
            color: #ffffff;
            font-size: 2rem;
            font-family:"Sitka Subheading";

        }
    </style>
    <section id="email_choose" class="sections" style="margin-top: 5rem;">
        <div class="container">
            {{--<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding: 2rem;">--}}
                {{--<h4>Choose Design</h4>--}}
                {{--<nav id="sidebar">--}}
                    {{--<ul class="list-unstyled components">--}}
                        {{--<li class="active">--}}
                            {{--<a href="#homeSubmenu"  data-toggle="collapse" aria-expanded="false">Industry</a>--}}
                            {{--<ul class="collapse list-unstyled" id="homeSubmenu">--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Automotive & Transportation<span style="color: #00b0ff;"> (111)</span></a>--}}
                                {{--</li>--}}
                                {{--<li><a href="#">Beauty & Spa<span style="color: #00b0ff;"> (11)</span></a></li>--}}
                                {{--<li><a href="#">Business Services<span style="color: #00b0ff;"> (1331)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                            {{--</ul>--}}
                            {{--<hr style="margin-top: 1px;    margin-left: 9px;    margin-right: 18px;">--}}
                        {{--</li>--}}
                        {{--<li>--}}

                            {{--<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>--}}
                            {{--<ul class="collapse list-unstyled" id="pageSubmenu">--}}
                                {{--<li><a href="#">Art & Entertainment<span style="color: #00b0ff;"> (1511)</span></a></li>--}}
                                {{--<li><a href="#">Automotive & Transportation<span style="color: #00b0ff;"> (111)</span></a>--}}
                                {{--</li>--}}
                                {{--<li><a href="#">Beauty & Spa<span style="color: #00b0ff;"> (11)</span></a></li>--}}
                                {{--<li><a href="#">Business Services<span style="color: #00b0ff;"> (1331)</span></a></li>--}}
                            {{--</ul>--}}
                            {{--<hr style="margin-top: 1px;    margin-left: 9px;    margin-right: 18px;">--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">Portfolio</a>--}}
                            {{--<hr style="margin-top: 1px;    margin-left: 9px;    margin-right: 18px;">--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">Contact</a>--}}

                        {{--</li>--}}
                    {{--</ul>--}}


                {{--</nav>--}}

            {{--</div>--}}
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="padding: 2rem;">


                <div class="row text-center">
                    @foreach($templates as $template)
                        <div id="email_choose_container" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div id="">

                                <div id="emailtemplateimage" class="row">

                                    <a href="#" data-toggle="modal" data-target="#myModal{{ $template->id }}"> <img class="imagecontainer"
                                                                                                  src="/images/{{ $template->image }}" style="width: 10rem;height: 15rem;"></a>
                                </div>

                            </div>

                        </div>
                        <div class="modal inmodal" id="myModal{{ $template->id }}" tabindex="-1" role="dialog"
                             aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
{{--                                {{ Form::open(['method' => 'Update','route' => ['email/template/update', $template->id],'style'=>'display:inline','class'=>'form-horizontal']) }}--}}
                                <form action="{{ route('shop/email/edit',$template->id) }}" method="POST" class="side-by-side">
                                    {!! csrf_field() !!}
                                    <div class="modal-content animated flipInY">
                                        {{--<div class="modal-header">--}}
                                            {{--<h4 class="modal-title">Email Template Detail</h4>--}}
                                        {{--</div>--}}
                                        <div class="row">

                                            <div class="modal-body">
                                                <div class="col-md-12">

                                                    <div id="">
                                                        {{--<input type="hidden" name="id" value="{{ $template->id }}">--}}
                                                        {{--<h4>Name : {{$template->name}}</h4>--}}
                                                        {{--<h4>Price : $ <span style="color: red;">{{ $template->price }}</span>--}}
                                                        {{--</h4>--}}
                                                        <div id="emailtemplateimage" class="row">

                                                            <img class="shop-email-select"
                                                                 src="/images/{{ $template->image }}"
                                                                 >
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                            <input type="submit" class="btn btn-success btn-lg" value="Select">
                                            {{--<a href="#"> <button type="button" class="btn btn-primary" style="margin-left: 0">Next</button></a>--}}
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
    </section>

    <script src="/site/js/vendor/jquery-1.11.2.min.js"></script>
    {{--<script src="/site/js/vendor/bootstrap.min.js"></script>--}}

    <script src="/site/js/plugins.js"></script>
    <script src="/site/js/main.js"></script>
@endsection
