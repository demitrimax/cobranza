<?php
if (Auth::check()) {
  $user = \App\admin\Users::find(Auth::id());
  $cliente = $user->cliente;
  $prospecto = $user->prospecto;
  if (!empty($cliente) || !empty($prospecto)){
    echo '<script>top.location.href="'.url('/').'"</script>';
    die('Permiso denegado');
  }
}
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('themes/plugins/images/favicon.png')}}">
    <title>@yield('title',config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('themes/eliteadmin-inversev2/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('themes/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css')}}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{asset('themes/plugins/bower_components/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{asset('themes/plugins/bower_components/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('themes/eliteadmin-inversev2/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('themes/eliteadmin-inversev2/css/style.css')}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset('themes/eliteadmin-inversev2/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- clockpicker -->
<link href="{{ asset('themes/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css') }}"  rel="stylesheet" type="text/css" />

<link href="{{ asset('themes/plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet">
<!-- timepicker CSS -->
<link href="{{ asset('themes/plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />

<!-- sweetalert CSS -->
<link href="{{ asset('themes/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet">

<!-- Dropify CSS -->
<link href="{{ asset('themes/plugins//bower_components/dropify/dist/css/dropify.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- morris CSS -->
<link href="{{ asset('themes/plugins/bower_components/morrisjs/morris.css') }} " rel="stylesheet">

<!-- Calendar CSS -->
<link href="{{ asset('themes/plugins/bower_components/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />

  @yield('css')
    <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-19175540-9', 'auto');
    ga('send', 'pageview');
    </script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="index.html"><b><!--This is dark logo icon--><img src="{{asset('themes/plugins/images/eliteadmin-logo.png')}}" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="{{asset('themes/plugins/images/eliteadmin-logo-dark.png')}}" alt="home" class="light-logo" /></b><span class="hidden-xs"><!--This is dark logo text--><img src="{{asset('themes/plugins/images/eliteadmin-text.png')}}" alt="home" class="dark-logo" /><!--This is light logo text--><img src="{{asset('themes/plugins/images/eliteadmin-text-dark.png')}}" alt="home" class="light-logo" /></span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                      <form role="search" action="{{ url('admin/reportes/search') }}" class="app-search hidden-xs">
                        <!--
                        <input type="text" name="q" placeholder="Buscar..." class="form-control" value="<?= isset($q) ? $q : '' ?>">
                        <a href=""><i class="fa fa-search"></i></a>
                      -->
                      </form>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <div class="user-profile">
                  <div class="dropdown user-pro-body">
                    <div>
                    </div>
                    <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{{ Auth::check() ? Auth::user()->name : '--' }}} <span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
                          <li><a href="{{ url('/admin/usuario/perfil') }}"><i class="fa fa-user"></i> Mi perfil </a></li>
                          <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
                        </ul>
                  </div>
                </div>
                <ul class="nav" id="side-menu">
                  <?php

                    $roles = new \App\admin\Roles;
                    echo $roles->imprimeMenu(Auth::user()->rol_id);

                  ?>

                  <li> <a href="{{ url('/logout') }}" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Cerrar sesión</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            @yield('content')
            <footer class="footer text-center"> {{ date('Y') }} &copy; Impulsa Todos los derechos reservados </footer>
          </div>

        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{asset('themes/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('themes/eliteadmin-inversev2/bootstrap/dist/js/tether.min.js')}}"></script>
    <script src="{{asset('themes/eliteadmin-inversev2/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('themes/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js')}}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{asset('themes/eliteadmin-inversev2/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('themes/eliteadmin-inversev2/js/waves.js')}}"></script>
    <!--Counter js -->
    <script src="{{asset('themes/plugins/bower_components/waypoints/lib/jquery.waypoints.js')}}"></script>
    <script src="{{asset('themes/plugins/bower_components/counterup/jquery.counterup.min.js')}}"></script>
    <!--Morris JavaScript -->
    <script src="{{asset('themes/plugins/bower_components/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('themes/plugins/bower_components/morrisjs/morris.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{asset('themes/eliteadmin-inversev2/js/custom.min.js')}}"></script>
    <!--<script src="{{asset('themes/eliteadmin-inversev2/js/dashboard1.js')}}"></script>-->
    <!-- Chosen JavaScript -->
    <script src="{{ asset('themes/plugins/chosen/chosen.jquery.min.js') }}"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="{{asset('themes/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('themes/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js')}}"></script>
    <script src="{{asset('themes/plugins/bower_components/toast-master/js/jquery.toast.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $.toast({
            heading: 'Welcome to Elite admin',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'info',
            hideAfter: 3500,

            stack: 6
        })
    });
    </script>
    <!--Style Switcher -->
    <script src="{{asset('themes/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <!-- datepicker JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- timepicker JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- sweetalert JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/sweetalert/sweetalert.min.js') }}" ></script>
    <!--Style Switcher -->
    <script src="{{ asset('themes/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}" ></script>
    <!-- jquery Validation JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/jquery_validation/jquery.validate.min.js') }}" ></script>
    <script src="{{ asset('themes/plugins/bower_components/jquery_validation/validate.js') }}" ></script>

    <script src="{{ asset('themes/plugins/bower_components/switchery/dist/switchery.min.js') }}"></script>

    <script src="{{ asset('themes/plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('themes/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}" ></script>

    <script src="{{ asset('themes/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" ></script>
    <script src="{{ asset('themes/plugins/bower_components/multiselect/js/jquery.multi-select.js') }}" ></script>


    <!-- <script src="{{ asset('themes/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script> -->

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.js"></script>

    <script src="{{ asset('js/config_datatable.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('themes/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Dropify JS -->
    <script src="{{ asset('themes/plugins//bower_components/dropify/dist/js/dropify.min.js') }}"></script>

    <!-- jquery-clockpicker -->
    <script src="{{ asset('themes/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>


    <script src="{{ asset('themes/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
    <script src="{{ asset('themes/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}"></script>
    <script src="{{ asset('themes/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/bower_components/morrisjs/morris.js') }}"></script>

    <!-- Raphael -->
    <script src="{{ asset('themes/plugins/bower_components/raphael/raphael-min.js') }}"></script>

    <!-- Calendar JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/calendar/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('themes/plugins/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/bower_components/calendar/dist/jquery.fullcalendar.js') }}"></script>

    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="{{ asset('themes/plugins/limitkeypress/limitkeypress.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/plugins/elevatezoom/jquery.elevateZoom-3.0.8.min.js') }}"></script>

    <script type="text/javascript">
       $(document).ready(function() {

         $('.display').DataTable({
           dom: 'lBfrtip',
           "paging": false,
           "language": {
                 "lengthMenu": "Ver _MENU_ Registros / Pagina",
                 "zeroRecords": "No se encontraron registros",
                 "info": "Viendo Pagina _PAGE_ de _PAGES_",
                 "search": "Buscar: ",
                 "infoEmpty": "No hay registros a visualizar",
                 "infoFiltered": "(filtered from _MAX_ total records)",
                 "infoFiltered": "(filtered from _MAX_ total records)",
                 "paginate": {
                   "previous": "Anterior",
                   "next": "Siguiente",
                   "last": "Ultimo",
                   "first": "Primero",
                 }
             },
             buttons: [
                  {
                      extend: 'copyHtml5',
                      exportOptions: {
                       columns: ':contains("Office")'
                     },
                     orientation: 'landscape',
                     pageSize: 'LEGAL',
                  },
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'copyHtml5',
                  'print'
              ]
        });


        $.fn.datepicker.dates['es-MX'] = {
            days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
            daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Hoy",
            clear: "Limpiar",
            format: 'dd-mm-yyyy',
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };
          // var date  = new Date().toJSON().slice(0,10).split('-').reverse().join('/')

          // Translated
        $('.dropify').dropify({
          messages: {
              default: 'Arrastre el archivo o de click para cargarlo',
              replace: 'Arrastre el archivo o de click cargar y sustituir el archivo',
              remove:  'Eliminar',
              error:   'Se ha producido un error inesperado, consulte al administrador'
          }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
          return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
          alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
              console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
          drDestroy = drDestroy.data('dropify')
          $('#toggleDropify').on('click', function(e){
              e.preventDefault();
              if (drDestroy.isDropified()) {
                  drDestroy.destroy();
              } else {
                  drDestroy.init();
              }
        });

          // alert(date)
        $('.dates').datepicker({
            todayHighlight: true,
            language: 'es-MX'
        });

        $('.dateValid').datepicker({
            language: 'es-MX',
            todayHighlight: true,
            startDate : true
        });

        $('.timepicker').timepicker({
            defaultTime:'current'
          });
        });

        $('.delete').on('click',function(){

          var url = $(this).attr('data-url');

          if(url != "") {

            swal({
                title: " ¿Esta seguro ?",
                text: "¿Realmente desea realizar esta operación?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                  location =  url;

                } else {

                }
            });

          }

        });

        $('.avanza').click(function(){

          var url = $(this).data('url');

          swal({
              title: "¿ Continuar con el proceso ?",
              text: "¿Esta seguro, realmente desea realizar esta operación?",
              type: "success",
              showCancelButton: true,
              confirmButtonColor: "#00c292",
              confirmButtonText: "SI",
              cancelButtonText: "No",
              closeOnConfirm: true,
              closeOnCancel: true
          }, function(isConfirm){
              if (isConfirm) {
                location =  url;
              } else {

              }
          });

        });

        // Clock pickers
        $('#single-input').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            'default': 'now'

        });

        $('.clockpicker').clockpicker({
                donetext: 'Done',

            })
            .find('input').change(function() {
                console.log(this.value);
            });

        $('#check-minutes').click(function(e) {
            // Have to stop propagation here
            e.stopPropagation();
            input.clockpicker('show')
                .clockpicker('toggleView', 'minutes');
        });

        $(".complex-colorpicker").asColorPicker({
            mode: 'complex'
        });

        function ejecutaLink(url) {

          if(url != "") {

            swal({
                title: " ¿Esta seguro ?",
                text: "¿Realmente desea realizar esta operación?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                  location =  url;

                } else {

                }
            });

          }
        }

        <?php if(Session::has('message')) { ?>
          <?php if(Session::has('exito')) { ?>

            swal({ title: "EXITO", text: "<?php echo Session::get('message'); ?>", type: "success"});

          <?php } else if(Session::has('fracaso')) { ?>

            swal({ title: "ATENCION", text: "<?php echo Session::get('message'); ?>", type: "warning"});

          <?php } ?>

        <?php } ?>
    </script>
    <style>

    .dataTables_length { display: none; }

    .dataTables_filter { display: none; }

    .dataTables_info { display: none; }

    .dataTables_paginate { display: none; }

    .asColorPicker-trigger {
        position: absolute;
        top: 0;
        right: -35px;
        height: 38px;
        width: 37px;
        border: 0;
    }

    .dt-buttons {

      display: none;

    }

    .zoomContainer{
    z-index: 2000 !important;
    }
    </style>
    @yield('beforeBody')

    @yield('scripts')
</body>

</html>
