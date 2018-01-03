@extends('layouts.admin')

@section('content')
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element" style="text-align: center;"> <span>
                            <img alt="image" class="img-circle" src="/admin/img/profile_small.jpg"/>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">Sachiyo Totani</strong>
                             </span> <span class="text-muted text-xs block">Administrator</span> </span> </a>

                        </div>
                        <div class="logo-element">
                            L.F.H
                        </div>
                    </li>
                    <li  class="active">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-th-large"></i> <span
                                    class="nav-label">Dashboard</span></a>

                    </li>
                    <li>
                        <a href="{{ url('admin/contact') }}"><i class="fa fa-bell-o"></i> <span class="nav-label">Messages</span>
                            @if( $newcontact != "0")
                                <span class="label label-primary pull-right">NEW({{ $newcontact }})</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Orders</span><span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Email orders</a>
                                <ul class="nav nav-third-level">
                                    <li><a href="{{ route('order/email/inbox') }}">Email</a></li>
                                    <li><a href="{{ route('order/email/sent') }}">Sent</a></li>
                                    <li><a href="{{ route('order/email/draft') }}">Draft</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Flower orders</a>
                                <ul class="nav nav-third-level">
                                    <li><a href="{{ route('order/flower/standby') }}">Flower</a></li>
                                    <li><a href="{{ route('order/flower/sent') }}">Sent</a></li>
                                    <li><a href="{{ route('order/flower/draft') }}">Draft</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Email Management</span><span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('email/template') }}">Email Template</a></li>
                            <!--<li><a href="sample_letter_pad.html">Sample Letter Pad</a></li>-->
                            <li><a href="{{ route('email/draft') }}">Draft</a></li>
                            <li><a href="{{ route('email/deletebox') }}">Deletebox</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pagelines"></i><span class="nav-label">Flower Management</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('flower/template') }}">Flower manage</a></li>
                            <li><a href="{{ route('flower/draft') }}">Draft</a></li>
                            <li><a href="{{ route('flower/deletebox') }}">Deletebox</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('users') }}"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
                    </li>
                </ul>

            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                        </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to Letter From Heaven Admin.</span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>
                                @if( $newcontact != "0")
                                    <span class="label label-danger">{{ $newcontact }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="{{ url('admin/contact') }}">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have {{ $newcontact }} messages!
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin/logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">All</span>
                            <h5>Users</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $users }}</h1>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">Total</span>
                            <h5>Revenue</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">${{ $revenue }}</h1>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">All</span>
                            <h5>Email Orders</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $emailorders }}</h1>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">All</span>
                            <h5>Flower Orders</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $flowerorders }}</h1>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">All</span>
                            <h5>Letter Orders</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $letterorders }}</h1>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">All</span>
                            <h5>Gift Orders</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $giftorders }}</h1>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('admin/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('admin/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('admin/js/inspinia.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ asset('admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('admin/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('admin/js/plugins/toastr/toastr.min.js') }}"></script>


    <script>
        $(document).ready(function () {
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Responsive Admin Dashboard', 'Welcome to Letter From Heaven');

            }, 1300);

        });
    </script>

@endsection
