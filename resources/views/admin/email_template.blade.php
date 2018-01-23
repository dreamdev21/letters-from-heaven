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
                    <li>
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

                    <li  class="active">
                        <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Email Management</span><span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li  class="active"><a href="{{ route('email/template') }}">Email Template</a></li>
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
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                    class="fa fa-bars"></i>
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
            <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">
                    <h2>Email Template</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li>
                            <a>Mailbox</a>
                        </li>
                        <li class="active">
                            <strong>Email Template</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <!--<div class="ibox-content pull-right">-->

                            <button class="btn btn-success pull-right" type="button" data-toggle="modal"
                                    data-target="#myModalEmailNew"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span
                                        class="bold">Upload</span></button>

                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th style="width: 7rem">No</th>
                                        <th tyle="width: 5rem">Name</th>
                                        <th style="width: 5rem">Image</th>
                                        <th>Price</th>
                                        <th>Created Date</th>
                                        <th>Updated Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($templates as $template)
                                        <tr class="gradeX" data-toggle="modal" data-target="#myModal{{$template->id}}">
                                            <td>{{$template->id}}</td>
                                            <td>{{$template->name}}</td>
                                            <td><img src="{{ asset('images/') }}/{{$template->image}}"
                                                     style="width: 5rem;height: 7rem;"></td>
                                            <td class="text-navy">${{$template->price}}</td>
                                            <td class="text-navy">{{$template->created_at}}</td>
                                            <td class="text-navy">{{$template->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @foreach($templates as $template)
                <div id="myModal{{$template->id}}" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <h3 class="m-t-none m-b  text-center">Details</h3>
                                    <div class="col-sm-6 ">
                                        {{ Form::open(['method' => 'Update','route' => ['email/template/update', $template->id],'style'=>'display:inline','class'=>'form-horizontal']) }}


                                        <div class="form-group"><label>No :</label> {{$template->id}}</div>
                                        <div class="form-group"><label>Name : </label> <input type="text" name="name"
                                                                                              required autofocus
                                                                                              value="{{$template->name}}"
                                                                                              class="form-control">
                                        </div>
                                        <div class="form-group"><label>Price : $</label> <input type="text"
                                                                                                name="price" required
                                                                                                autofocus
                                                                                                value="{{$template->price}}"
                                                                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Status : </label>

                                            <div class="col-md-12" style="padding: 0">
                                                <select class="form-control m-b" name="state">

                                                    <option value="0">Publish</option>
                                                    <option value="1">Draft</option>
                                                    <option value="2">Deleted</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div>


                                        </div>

                                        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-success pull-right m-t-n-xs','style' => 'margin-right: 60px;']) }}
                                        {{ Form::close() }}
                                        {{ Form::open(['method' => 'Destroy','route' => ['email/template/delete', $template->id],'style'=>'display:inline','class'=>'form-horizontal']) }}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger pull-left m-t-n-xs','style' => 'margin-left: 60px;']) }}

                                        {{ Form::close() }}
                                    </div>
                                    <div class="col-sm-6"><h4>Image</h4>
                                        <img src="{{ asset('images/') }}/{{$template->image}}"
                                             style="width: 26rem;height: 30rem">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="myModalEmailNew" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12"><h3 class="m-t-none m-b" style="text-align: center">Upload New
                                        Template</h3>

                                    <form class="form-horizontal" role="form" method="POST"
                                          enctype="multipart/form-data" action="{{ route('email/template/save') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Name : </label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value=""
                                                       required autofocus>


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="price" class="col-md-4 control-label">Price : </label>

                                            <div class="col-md-6">
                                                <input id="price" type="text" class="form-control" name="price"
                                                       value="" required autofocus>


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="file" class="col-md-4 control-label">Image : </label>

                                            <div class="col-md-6">
                                                <input id="image" type="file" class="form-control" name="image" value=""
                                                       required autofocus>


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="file" class="col-md-4 control-label">Status : </label>

                                            <div class="col-md-6">
                                                <select class="form-control m-b" name="state">

                                                    <option value="0">Publish</option>
                                                    <option value="1">Draft</option>
                                                    <option value="2">Deleted</option>

                                                </select>
                                            </div>
                                        </div>
                                        {{--<input type="hidden" name="state" value="0">--}}
                                        <div class="form-group">
                                            <div class="row text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    Create Template
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
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
        <script src="{{ asset('admin/js/plugins/jeditable/jquery.jeditable.js') }}"></script>

        <!-- Data Tables -->
        <script src="{{ asset('admin/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('admin/js/plugins/dataTables/dataTables.responsive.js') }}"></script>
        <script src="{{ asset('admin/js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>

        <!-- Custom and plugin javascript -->
        <script src="{{ asset('admin/js/inspinia.js') }}"></script>
        <script src="{{ asset('admin/js/plugins/pace/pace.min.js') }}"></script>
        <style>
            body.DTTT_Print {
                background: #fff;

            }

            .DTTT_Print #page-wrapper {
                margin: 0;
                background: #fff;
            }

            button.DTTT_button, div.DTTT_button, a.DTTT_button {
                border: 1px solid #e7eaec;
                background: #fff;
                color: #676a6c;
                box-shadow: none;
                padding: 6px 8px;
            }

            button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
                border: 1px solid #d2d2d2;
                background: #fff;
                color: #676a6c;
                box-shadow: none;
                padding: 6px 8px;
            }

            .dataTables_filter label {
                margin-right: 5px;

            }
        </style>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable({
                    responsive: true,
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                    }
                });

                /* Init DataTables */
                var oTable = $('#editable').dataTable();

                /* Apply the jEditable handlers to the table */
                oTable.$('td').editable('../example_ajax.php', {
                    "callback": function (sValue, y) {
                        var aPos = oTable.fnGetPosition(this);
                        oTable.fnUpdate(sValue, aPos[0], aPos[1]);
                    },
                    "submitdata": function (value, settings) {
                        return {
                            "row_id": this.parentNode.getAttribute('id'),
                            "column": oTable.fnGetPosition(this)[2]
                        };
                    },

                    "width": "90%",
                    "height": "100%"
                });


            });

            function fnClickAddRow() {
                $('#editable').dataTable().fnAddData([
                    "Custom row",
                    "New row",
                    "New row",
                    "New row",
                    "New row"]);

            }
        </script>
    </div>
@endsection
