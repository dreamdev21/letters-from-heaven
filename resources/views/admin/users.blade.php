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
                    <li  class="active">
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
                    <h2>Users</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Users</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <!--<div class="ibox-content pull-right">-->

                            <button class="btn btn-warning pull-right" type="button" data-toggle="modal" data-target="#myModalnew"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span
                                        class="bold">New</span></button>

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
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Zip</th>
                                        <th>Phone Number</th>
                                        <th>Date of birth</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr class="gradeX" data-toggle="modal" data-target="#myModal{{$user->id}}">
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->firstname}}</td>
                                            <td>{{$user->lastname}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->password}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->state}}</td>
                                            <td>{{$user->zip}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->dateofbirth}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @foreach($users as $user)
                <div id="myModal{{$user->id}}" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12"><h3 class="m-t-none m-b" style="text-align: center">Details</h3>
                                        {{ Form::open(['method' => 'Update','route' => ['users/update', $user->id],'style'=>'display:inline','class'=>'form-horizontal']) }}
                                            <div class="form-group"><label class="col-md-4 control-label">No :</label>
                                                <div class="col-md-6">
                                                <p class="form-control-static"> {{ $user->id }}</p>

                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-md-4 control-label">First Name :</label>
                                                <div class="col-md-6">
                                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-md-4 control-label">Last Name :</label>
                                                <div class="col-md-6">
                                                    <input id="lastname"
                                                           type="text"
                                                           class="form-control"
                                                           name="lastname"
                                                           value="{{ $user->lastname }}"
                                                           required
                                                           autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group"><label class="col-md-4 control-label">Email :</label>
                                                <div class="col-md-6">
                                                    <input id="no" type="email"
                                                           class="form-control"
                                                           name="email"
                                                           value="{{ $user->email }}"
                                                           required autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-md-4 control-label">Password :</label>
                                                <div class="col-md-6">
                                                    <span><input id="no"
                                                                 type="text"
                                                                 class="form-control"
                                                                 name="password"
                                                                 value="{{ $user->password }}"
                                                                 required
                                                                 autofocus></span>
                                                </div>

                                            </div>
                                            <div class="form-group"><label class="col-md-4 control-label">Address :</label>
                                                <div class="col-md-6">
                                                    <input id="geocomplete" type="text"
                                                           class="form-control"
                                                           name="address"
                                                           value="{{ $user->address }}"
                                                           required autofocus>
                                                </div>

                                            </div>
                                            <div class="form-group"><label class="col-md-4 control-label">State :</label>
                                                <div class="col-md-6">
                                                    <input id="no" type="text"
                                                           class="form-control"
                                                           name="state"
                                                           value="{{ $user->state }}"
                                                           required autofocus>
                                                </div>

                                            </div>
                                            <div class="form-group"><label class="col-md-4 control-label">Zip :</label>
                                                <div class="col-md-6">
                                                    <input id="no" type="text"
                                                           class="form-control"
                                                           name="zip"
                                                           value="{{ $user->zip }}"
                                                           required autofocus>
                                                </div>

                                            </div>
                                            <div class="form-group"><label class="col-md-4 control-label">Phone Number :</label>
                                                <div class="col-md-6">
                                                    <input id="no"
                                                           type="text"
                                                           class="form-control"
                                                           name="phone"
                                                           value="{{ $user->phone }}"
                                                           required
                                                           autofocus>
                                                </div>

                                            </div>
                                            <div class="form-group" id="data_2">
                                                <label for="dateofbirth" class="col-md-4 control-label">Date of birth</label>
                                                <div class="input-group date col-md-6">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name = "dateofbirth" value="{{ $user->dateofbirth }} " required
                                                                                                                                autofocus>
                                                </div>
                                            </div>

                                        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-success pull-right m-t-n-xs','style' => 'margin-right: 60px;']) }}

                                        {{ Form::close() }}
                                        {{ Form::open(['method' => 'Destroy','route' => ['users/delete', $user->id],'style'=>'display:inline','class'=>'form-horizontal']) }}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger pull-left m-t-n-xs','style' => 'margin-left: 60px;']) }}

                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        @endforeach
        <div id="myModalnew" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12"><h3 class="m-t-none m-b" style="text-align: center">Create New User</h3>

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('users/save') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">First Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Last Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>


                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="address" class="col-md-4 control-label">Address</label>

                                        <div class="col-md-6">
                                            <input id="geocomplete" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>


                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-4 control-label">state</label>

                                        <div class="col-md-6">
                                            <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required autofocus>


                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                                        <label for="zip" class="col-md-4 control-label">Zip</label>

                                        <div class="col-md-6">
                                            <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" required autofocus>


                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">Phone</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>


                                        </div>
                                    </div>
                                    <div class="form-group" id="data_2">
                                        <label for="dateofbirth" class="col-md-4 control-label">Date of birth</label>
                                        <div class="input-group date col-md-6">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name = "dateofbirth" value="08/25/2014">
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-4 control-label">Role</label>

                                        <div class="col-md-6"><select class="form-control m-b" name="is_Admin">
                                                <option value="0">User</option>
                                                <option value="1">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Register
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
    <!-- Data picker -->
    <script src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <!-- Geo location -->
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>--}}

    <script src="{{ asset('admin/js/jquery.geocomplete.js') }} "></script>
    <script src="{{ asset('admin/js/logger.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#geocomplete").geocomplete()
                .bind("geocode:result", function(event, result){
                    $.log("Result: " + result.formatted_address);
                })
                .bind("geocode:error", function(event, status){
                    $.log("ERROR: " + status);
                })
                .bind("geocode:multiple", function(event, results){
                    $.log("Multiple: " + results.length + " results found");
                });

            $("#find").click(function(){
                $("#geocomplete").trigger("geocode");
            });


            $("#examples a").click(function(){
                $("#geocomplete").val($(this).text()).trigger("geocode");
                return false;
            });
            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });
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
@endsection