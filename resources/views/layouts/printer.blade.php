<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
  <title>Punto de Venta </title>

  <!-- Bootstrap Core CSS -->
  <link href="{{ asset('themes/eliteadmin-inverse/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ asset('themes/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

  <!-- Menu CSS -->
  <link href="{{ asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
  <!-- toast CSS -->
  <link href="{{ asset('themes/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
  <!-- morris CSS -->
  <link href="{{ asset('themes/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
  <!-- chosen CSS -->
  <link href="{{ asset('themes/plugins/chosen/chosen.min.css') }}" rel="stylesheet">
  <!-- animation CSS -->
  <link href="{{ asset('themes/eliteadmin-inverse/css/animate.css') }}" rel="stylesheet">

  <!-- datepicker CSS -->
  <link href="{{ asset('themes/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('themes/plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />

  <link href="{{ asset('themes/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />

  <link href="{{ asset('themes/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />

  <link href="{{ asset('themes/plugins/bower_components/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />

  <!-- timepicker CSS -->
  <link href="{{ asset('themes/plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />

  <!-- sweetalert CSS -->
  <link href="{{ asset('themes/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet">

  <!-- Dropify CSS -->
  <link href="{{ asset('themes/plugins//bower_components/dropify/dist/css/dropify.css') }}" rel="stylesheet">

</head>

<body>

  <div id="wrapper">

    @yield('content')

  </div>

</body>
