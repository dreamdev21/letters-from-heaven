<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">

    <!-- Styles -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="/admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Jqgrid style -->
    <link href="/admin/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href="/admin/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="/admin/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/admin/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="/admin/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">


    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css" rel="stylesheet">

    <link href="/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
</head>
<body>


        @yield('content')

</body>
</html>
