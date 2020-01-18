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
        <!-- Inicia botones de Accion -->
        <div class="col-sm-12">

          <div class="white-box">

            <div class="pull-right">
              <button class="btn btn-default btn-rounded" id="btnFilter">
                <span class="btn-label"><i class="fa fa-search fa-lg"></i></span>Buscar registro
              </button>
            </div>

            <div class="clear"></div>

          </div>

        </div>
        <!-- Terminan botones de Accion -->
      </div>

      <div class="row">

        <!-- Inicia listado de registros -->
        <div class="col-sm-12" id="frmListado">

          <div class="panel panel-default">
            <div class="panel-heading">Listado de {{{ $config['titulo'] }}}
                <div class="panel-action">
                    <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Opciones <span class="caret"></span></a>
                      <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu">
                        <li role="presentation"><a href="{{ url('/admin/expediente_digital/add') }}" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Nuevo Registro</a></li>
                        <li class="divider" role="presentation"></li>

                        <li role="presentation"><a onclick="$('.buttons-copy').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Copiar lista</a></li>
                        <li role="presentation"><a onclick="$('.buttons-print').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Imprimir lista</a></li>
                        <li class="divider" role="presentation"></li>

                        <li role="presentation"><a onclick="$('.buttons-excel').trigger('click');" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i> Exportar Excel</a></li>
                        <li role="presentation"><a onclick="$('.buttons-pdf').trigger('click');" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i> Exportar PDF</a></li>
                        <li class="divider" role="presentation"></li>
                      </ul>
                    </div>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="table-responsive" id="table-content">

                    <table class="table" >
                      <thead>
                        <tr>
                          <th># Solicitud</th>
              						<th>Cliente</th>
              						<th>Producto</th>
              						<th>Fecha registro</th>
              						<th>Monto</th>
              						<th>Plazo</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >
                          <td>{{{ $value->folio }}}</td>
                          <th>{{{ $value->cteNombre }}} {{{ $value->ctePaterno }}} {{{ $value->cteMaterno }}}</th>
                          <th>{{{ $value->producto }}}</th>
                          <td>{{{ $value->fecha_captura }}}</td>
                          <td>$ {{{ number_format($value->monto_solicitado,2,".",",") }}}</td>
                          <td>{{{ $value->plazo_solicitado }}} Semanas</td>
		                      <td>
                            
                            <?php if($value->exp_aprobado == 1) { ?>

                              <a href="javascript:ejecutaLink('<?php echo url("/"); ?>/admin/solicitudes/avanzar/<?php echo $value->id; ?>') " title="Envar a Aprobacion" data-toggle="tooltip">
                                <i class="fa fa-check-circle fa-lg text-success m-r-10"></i>
                              </a>

                            <?php } else { ?>

                              <a href="<?php echo url("/"); ?>/admin/expediente_digital/validacion/<?php echo $value->id; ?>" title="Validar Expediente" data-toggle="tooltip">
                                <i class="fa fa-archive fa-lg text-primary m-r-10"></i>
                              </a>
                            <?php }  ?>
                           </td>
                        </tr>
                      <?php }  ?>
                      </tbody>
                    </table>

                  </div>
                </div>
                <div class="panel-footer"> {{ $data->links('vendor.pagination.default') }} </div>
            </div>
          </div>

        </div>
        <!-- Termina listado de registros -->

      </div>

  </div>

</div>

<div class="modal fade bs-example-modal-lg" id="modalPsico" tabindex="10" role="dialog" aria-labelledby="modalFondeoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalFondeoLabel">Advice Robo Examen Psicometrico</h3>
            </div>
            <div class="modal-body">
              <p>Puede copiar esta url para envio al cliente con motivo de re evaluacion de Test</p>
              <input type="text" name="url" id="urlQuiz" value="" class="form-control" readonly />
              <div class="row" id="quizContent">
                <h5>Cargando examen psicometrico . . . </h5>
              </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="" id="prospecto_id_encry">

                <!---<button type="button" class="btn btn-primary btn-rounded" onclick="showUrl()">
                  <span class="btn-label"><i class="fa fa-exchange fa-lg"></i></span>Enviar URL
                </button>-->

                <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar
                </button>

                <button type="button" class="btn btn-success btn-rounded" style="display:none" id="btnRechaza" onclick="enviar()">
                  <span class="btn-label"><i class="fa fa-check fa-lg"></i></span>Confirmar Rechazo
                </button>

            </div>
        </div>
    </div>
</div>

<script>

var token_quiz = "";

function getQuiz(prospecto_id,solicitud_id) {

  $('#quizContent').html('<h3>Cargando examen psicometrico . . . </h3>');

  $('#modalPsico').modal({

    backdrop: 'static',

    keyboard: false,

    focus: true
  });

  $.ajax({
		url: "<?php echo url('admin/prospectos/quiztest/'); ?>/"  + solicitud_id,
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			$('#quizContent').html(json['html']);

      token_quiz = json['token'];

      $('#urlQuiz').val("{{{ url('quiz') }}}/" + solicitud_id);
		}

	});



}

function insertScore(prospecto_id) {

  $.ajax({
		url: "<?php echo url('admin/prospectos/score/'); ?>/"  + prospecto_id +'?token=' + token_quiz,
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

      $('#modalPsico').modal('toggle');

      $('#loading').fadeOut();

      if(json['error'] == 0) {

        swal({ title: 'EXITO!!', text: 'Evaluacion generada exitosamente', type: 'success'});

      } else {

        swal({ title: 'ERROR!!', text: json['msg'], type: 'error'});

      }

		}

	});
}


$('.table-responsive').on('show.bs.dropdown', function () {


   $('#table-content').css( "overflow-y", "visible" );
   $('#table-content').css( "height", $('#table-content').height() + 130 );

});

$('.table-responsive').on('hide.bs.dropdown', function () {
   $('#table-content').css( "overflow", "auto" );
   $('#table-content').css( "height", $('#table-content').height() - 130 );
})

$('#btnFilter').on('click',function(){

  $('#frmFiltro').fadeIn();

  $('#frmListado').fadeOut();

});

$('#clearFilter').on('click',function(){

  $('#frmFiltro').fadeOut();

  $('#frmListado').fadeIn();

});
</script>


@endsection
