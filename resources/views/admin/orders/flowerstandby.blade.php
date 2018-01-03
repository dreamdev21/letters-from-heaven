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
                    <li class="active">
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
                            <li class="active">
                                <a href="#">Flower orders</a>
                                <ul class="nav nav-third-level">
                                    <li class="active"><a href="{{ route('order/flower/standby') }}">Flower</a></li>
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
                        <a href="#"><i class="fa fa-pagelines"></i><span class="nav-label">Flower Management</span><span
                                    class="fa arrow"></span></a>
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
                    <h2>Flower Standby</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li>
                            Orders
                        </li>
                        <li>
                            Flower
                        </li>
                        <li>
                            <strong>Standby</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="wrapper wrapper-content animated fadeInRight">
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
                                        <th style="width: 5rem">No</th>
                                        <th style="width: 7rem">Order No</th>
                                        <th style="width: 5rem">Customer</th>
                                        <th style="width: 7rem">Flower</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Recipient's email</th>
                                        <th>Recipient's phone</th>
                                        <th>Delivery Date</th>
                                        <th>Created Date</th>
                                        <th>State</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr class="gradeX" data-toggle="modal" data-target="#myModal{{$item->id}}">
                                            <td class="text-navy">{{$item->id}}</td>
                                            <td class="text-navy">
                                                @if($item->id >99999)
                                                    F-B{{sprintf('%05d',($item->id - 100000))}}
                                                @else
                                                    F-A{{sprintf('%05d',$item->id)}}
                                                @endif</td>
                                            <td class="text-navy">{{$item->useremail}}</td>
                                            <td class="text-navy"><img src="{{ asset('images/') }}/{{$item->pro_image}}"
                                                                       style="width: 5rem;height: 7rem;"></td>
                                            <td class="text-navy">{{$item->pro_qty}}</td>
                                            <td class="text-navy">${{$item->pro_price}}</td>
                                            <td class="text-navy">{{$item->reemail}}</td>
                                            <td class="text-navy">{{$item->rephone}}</td>
                                            <td class="text-navy">{{$item->deliverydate}}</td>
                                            <td class="text-navy">{{$item->created_at}}</td>
                                            <td class="text-navy">
                                                @if($item->orderstate == "0")
                                                    Draft
                                                @elseif($item->orderstate == "1")
                                                    Paid
                                                @elseif($item->orderstate == "2")
                                                    Pending
                                                @elseif($item->orderstate == "3")
                                                    Canceled
                                                @elseif($item->orderstate == "4")
                                                    Refunded
                                                @else
                                                    Sent
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @foreach($items as $item)
                                <div id="myModal{{$item->id}}" class="modal fade" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body" style="margin-bottom: 22px;">
                                                <div class="row">
                                                    <h3 class="m-t-none m-b  text-center">Order No :
                                                        @if($item->id >99999)
                                                            F-B{{sprintf('%05d',($item->id - 100000))}}
                                                        @else
                                                            F-A{{sprintf('%05d',$item->id)}}
                                                        @endif
                                                    </h3>
                                                    <div class="col-sm-6">
                                                        {{ Form::open(['method' => 'Update','route' => ['order/flower/update', $item->id],'style'=>'display:inline','class'=>'form-group']) }}

                                                        <div class="form-group text-left label-title">Product Info</div>
                                                        <div class="form-group"><label>Name
                                                                : </label> {{$item->pro_name}}</div>
                                                        <div class="form-group"><label>Price : </label>
                                                            ${{$item->pro_price}}</div>
                                                        <div class="form-group"><label>Qty : </label> {{$item->pro_qty}}
                                                        </div>
                                                        <div class="form-group"><img style="width: 7rem;"
                                                                                     src="{{ asset('images/') }}/{{$item->pro_image}}">
                                                        </div>
                                                        <div class="form-group text-left label-title">Customer Info
                                                        </div>
                                                        <div class="form-group"><label>Name
                                                                : </label> {{$item->userfirstname}}
                                                            , {{$item->userlastname}}
                                                        </div>
                                                        <div class="form-group"><label>Email
                                                                : </label> {{$item->useremail}}</div>
                                                        <div class="form-group"><label>Phone
                                                                : </label> {{$item->userphone}}</div>
                                                        <div class="form-group">
                                                            <label class="col-md-6 control-label"
                                                                   style="padding-left: 0;">Order State :</label>
                                                            <div class="col-md-6" style="margin-left: 0;">
                                                                <select class="form-control m-b" name="orderstate"
                                                                        style="padding-left: 5px;padding-right: 5px;">
                                                                    @if($item->orderstate == "0")
                                                                        <option value="0" selected>Draft</option>
                                                                        <option value="1">Paid</option>
                                                                        <option value="2">Pending</option>
                                                                        <option value="3">Canceled</option>
                                                                        <option value="4">Refunded</option>
                                                                        <option value="5">Sent</option>
                                                                    @elseif($item->orderstate == "1")
                                                                        <option value="0">Draft</option>
                                                                        <option value="1" selected>Paid</option>
                                                                        <option value="2">Pending</option>
                                                                        <option value="3">Canceled</option>
                                                                        <option value="4">Refunded</option>
                                                                        <option value="5">Sent</option>
                                                                    @elseif($item->orderstate == "2")
                                                                        <option value="0">Draft</option>
                                                                        <option value="1">Paid</option>
                                                                        <option value="2" selected>Pending</option>
                                                                        <option value="3">Canceled</option>
                                                                        <option value="4">Refunded</option>
                                                                        <option value="5">Sent</option>
                                                                    @elseif($item->orderstate == "3")
                                                                        <option value="0">Draft</option>
                                                                        <option value="1">Paid</option>
                                                                        <option value="2">Pending</option>
                                                                        <option value="3" selected>Canceled</option>
                                                                        <option value="4">Refunded</option>
                                                                        <option value="5">Sent</option>
                                                                    @elseif($item->orderstate == "4")
                                                                        <option value="0">Draft</option>
                                                                        <option value="1">Paid</option>
                                                                        <option value="2">Pending</option>
                                                                        <option value="3">Canceled</option>
                                                                        <option value="4" selected>Refunded</option>
                                                                        <option value="5">Sent</option>
                                                                    @elseif($item->orderstate == "5")
                                                                        <option value="0">Draft</option>
                                                                        <option value="1">Paid</option>
                                                                        <option value="2">Pending</option>
                                                                        <option value="3">Canceled</option>
                                                                        <option value="4">Refunded</option>
                                                                        <option value="5" selected>Sent</option>
                                                                    @endif
                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-group" style="margin-bottom: 0px;"><label>Note</label>
                                                            </div>
                                                            <div class="form-group">
                                                                    <textarea name="adminnote" rows="5"
                                                                              class="form-control">
                                                                    {{ $item->adminnote }}
                                                                    </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group text-left label-title">Delivery Info
                                                        </div>
                                                        <div class="form-group"><label>Title : </label>
                                                            @if($item->title == "0")
                                                                Mr
                                                            @elseif($item->title == "1")
                                                                Mrs
                                                            @elseif($item->title == "2")
                                                                Miss
                                                            @elseif($item->title == "3")
                                                                Ms
                                                            @elseif($item->title == "4")
                                                                Mr & Ms
                                                            @elseif($item->title == "5")
                                                                Dr
                                                            @else

                                                            @endif
                                                        </div>
                                                        <div class="form-group"><label>Extended Info : </label>
                                                            @if($item->extendedinfo == "0")
                                                                family
                                                            @elseif($item->extendedinfo == "1")
                                                                staff
                                                            @elseif($item->extendedinfo == "2")
                                                                company
                                                            @else

                                                            @endif
                                                        </div>
                                                        <div class="form-group"><label>Name
                                                                : </label> {{$item->firstname}} , {{$item->lastname}}
                                                        </div>
                                                        <div class="form-group"><label>Address
                                                                : </label> {{$item->deliveryadd1}}
                                                            , {{$item->deliveryadd2}}
                                                        </div>
                                                        <div class="form-group"><label>City : </label> {{$item->city}}
                                                        </div>
                                                        <div class="form-group"><label>State : </label> {{$item->state}}
                                                        </div>
                                                        <div class="form-group"><label>Postal Code
                                                                : </label> {{$item->postalcode}}</div>
                                                        <div class="form-group"><label>Country : </label>
                                                            @if($item->country == "0")
                                                                USA
                                                            @endif
                                                        </div>
                                                        <div class="form-group"><label>Delivery Date
                                                                : </label> {{$item->deliverydate}}</div>
                                                        <div class="form-group"><label>Card Message
                                                                : </label> {{$item->cardmessage}}</div>
                                                        <div class="form-group"><label>Signature
                                                                : </label> {{$item->signature}}</div>
                                                        <div class="form-group"><label>Email
                                                                : </label> {{$item->reemail}}</div>
                                                        <div class="form-group"><label>Phone
                                                                : </label> {{$item->rephone}}</div>


                                                    </div>
                                                </div>

                                                {{ Form::submit('Update', ['class' => 'btn btn-sm btn-success pull-right m-t-n-xs','style' => '']) }}
                                                {{ Form::close() }}
                                                {{ Form::open(['method' => 'Destroy','route' => ['order/flower/delete', $item->id],'style'=>'display:inline','class'=>'form-group']) }}
                                                @if($item->orderstate == "1"  || $item->orderstate == "2")
                                                    {{ Form::submit('Delete', ['id'=>'delete','class' => 'btn btn-sm btn-danger pull-left m-t-n-xs','style' => '','value'=>'delete','disabled'=>'true']) }}
                                                @else
                                                    {{ Form::submit('Delete', ['id'=>'delete','class' => 'btn btn-sm btn-danger pull-left m-t-n-xs','style' => 'margin-bottom:17px;','value'=>'delete']) }}
                                                @endif


                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    @endforeach
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

@endsection
