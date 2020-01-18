@extends('layouts.app')

@section('content')

<?php
$searchValue = isset($_GET['searchValue'])?$_GET['searchValue']:'';
$searchBy = isset($_GET['searchBy'])?$_GET['searchBy']:'';
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'';
$order = isset($_GET['order'])?$_GET['order']:'';
$redirect = url('/').'/admin/documentos?'.urlencode($_SERVER["QUERY_STRING"]);
?>


<!-- Page Content -->
<div id="page-wrapper">

  <div class="container-fluid">

      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
        </div>
      </div>


      <div class="row">

        <!-- Inicia listado de registros -->
        <div class="col-sm-12" id="frmListado">

          <div class="panel panel-default">
            <div class="panel-heading">Listado de Registros</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="table-responsive">


                    <div id="calendar"></div>
                  </div>
                </div>
                <div class="panel-footer"> </div>
            </div>
          </div>

        </div>
        <!-- Termina listado de registros -->

      </div>

  </div>

</div>

<div class="modal fade bs-example-modal-lg" id="eventInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">Información de Cuota</h4>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-12">
                <div class="col-md-3 text-center"> <b>Cliente</b></div>
                <div class="col-md-9 text-left" id="cliente"></div>
              </div>

              <div class="col-md-12"> <p> <br/> </p> </div>

              <div class="col-md-6">
                <div class="col-md-4 text-right"><b>F. Apertura</b></div>
                <div class="col-md-8 text-left" id="inicia"></div>
              </div>

              <div class="col-md-6">
                <div class="col-md-4 text-right"><b>F. Vencimiento</b></div>
                <div class="col-md-8 text-left" id="vence"></div>
              </div>

              <div class="col-md-12"> <p> <br/> </p> </div>

              <div class="col-md-6">
                <div class="col-md-4 text-right"><b>Monto a Pagar</b></div>
                <div class="col-md-8 text-left" id="pagar"></div>
              </div>

              <div class="col-md-6">
                <div class="col-md-4 text-right"><b>Monto Pagado</b></div>
                <div class="col-md-8 text-left" id="pagado"></div>
              </div>

              <div class="col-md-12"> <p> <br/> </p> </div>

            </div>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">
              <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar Ventana
            </button>

          </div>
        </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
$('#calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
  },
  buttonText: {
    today:    'Hoy',
    month:    'Mes',
    week:     'Semanas',
    day:      'Dia',
    list:     'Listado'
  },
  //Eventos
  eventClick: function(eventObj) {

    $.ajax({
  		url: "<?php echo url('admin/pagos/ajax/'); ?>/" +  eventObj.id,
  		dataType: 'json',
  		contentType: "application/json; charset=utf-8",
  		success: function(json) {

        $('#cliente').html(json['data'].nombre + ' ' + json['data'].paterno + ' ' + json['data'].materno);

        $('#inicia').html(json['data'].fecha_inicio);

        $('#vence').html(json['data'].fecha_vence);

        $('#pagar').html(json['data'].amortizacion);

        $('#pagado').html(json['data'].pago_aplicado);

  			if(json['error'] == 0) {

          $('#eventInfo').modal({

            backdrop: 'static',

            keyboard: false,

            focus: true
          });

  			} else {

  				//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
  				swal({ title: "ERROR!!", text: json['msg'], type: "error"});

  			}

  		}

  	});

  },
  defaultDate: '<?php echo date('Y-m-d'); ?>',
      navLinks: false, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        <?php foreach ($data as $value) {
            echo "{
                    id: '" . $value->id  . " ',";
                    echo "title: '" . $value->nombre . " " . $value->paterno . " " . $value->materno . " $" . number_format($value->amortizacion,2,".",","). " ',";
              echo "start: '" . $value->fecha_vence. "T08:01:20',";
              if($value->tipo == 3) { echo "color  : '#ab8ce4',"; }  else { echo "color  : '#03a9f3'"; }
            echo  "},";
          }
        ?>
      ]
});

</script>


@endsection
