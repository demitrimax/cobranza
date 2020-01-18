@extends('layouts.app')

@section('content')

<div id="page-wrapper">
  <div class="container-fluid">

      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
           @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
        </div>
        <!-- /.col-lg-12 -->
      </div>

      <form action="{{{ url('admin/solicitudes/aprobacion') }}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" name="id" id="id" value="{{{ $data->id }}}" />

        <div class="row">
          <div class="col-sm-12">

            <div class="white-box">

                <div class="pull-left">
                  <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger btn-rounded">
                    <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cancelar
                  </a>
                </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-success btn-rounded">
                    <span class="btn-label"><i class="fa fa-check fa-lg"></i></span>Aprobar solicitud
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>
        </div>

        <div class="row">

          <div class="col-md-4 col-xs-12">
            <div class="white-box">
              <div class="user-btm-box">
                  <hr>
                  <!-- .row -->
                  <div class="row text-center m-t-10">
                    <div class="col-md-6"><strong>Cliente</strong>
                        <p>{{{ $cliente->nombre }}} {{{ $cliente->paterno }}} {{{ $cliente->materno }}}</p>
                    </div>
                      <div class="col-md-6"><strong>Teléfono</strong>
                          <p>{{{ $cliente->telefono }}}</p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

                  <!-- .row -->
                  <div class="row text-center m-t-10">
                    <div class="col-md-6"><strong>Celular</strong>
                        <p>{{{ $cliente->celular }}}</p>
                    </div>
                      <div class="col-md-6"><strong>Correo Electronico</strong>
                          <p>{{{ $cliente->correo }}}</p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

                  <!-- .row -->
                  <div class="row text-center m-t-10">
                    <div class="col-md-6"><strong>Banco:</strong>
                        <p>{{{ $cliente->banco }}}</p>
                    </div>
                      <div class="col-md-6"><strong>Clabe interbancaria</strong>
                          <p>{{{ $cliente->banco_clabe }}}</p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

                  <!-- .row -->
                  <div class="row text-center m-t-10">
                      <div class="col-md-12 b-r"><strong>Dirección</strong>
                          <p>
                            {{{ $cliente->calle }}} {{{ $cliente->colonia }}} <br/>
                            {{{ $cliente->ciudad }}} {{{ $cliente->estado }}}, {{{ $cliente->cp }}}
                          </p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

              </div>
            </div>
          </div>

          <div class="col-md-8 col-xs-12">
              <div class="white-box">

                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Monto solicitado</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ number_format($data->monto_solicitado,2,".",",") }}}</strong></p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Pago seleccionado</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ number_format($data->pago_solicitado,2,".",",") }}}</strong></p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Producto</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ $producto->descripcion }}}</strong></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Plazo a pagar</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ round($data->plazo_solicitado,2) }}} Semanas</strong></p>
                    </div>
                  </div>

                <hr/>

                <div class="row">
                  <ul class="nav nav-tabs tabs customtab">
                    <li class="tab active">
                        <a href="#home" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Aprobación</span> </a>
                    </li>
                    <li class="tab">
                        <a href="#biography" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Informacion de solicitud</span> </a>
                    </li>
                    <li class="tab">
                        <a href="#documents" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Documentos</span> </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <!-- .tabs 1 -->
                    <div class="tab-pane active" id="home">

                        <div class="row">
                          <h4>Aprobación del crédito</h4>
                        </div>

                        <div class="row">

                          <!-- Monto_solicitado Start -->
                  				<div class="col-md-12">
                  				 <div class="form-group">
                  				  <label for="monto_solicitado" class="control-label"> Monto a aprobar para el crédito </label>
                              <input type="text" class="form-control" id="monto_solicitado" name="monto_aprobado" value="{{{ isset($data->monto_solicitado ) ? round($data->monto_solicitado,2)  : old('monto_solicitado') }}}">
                  				 </div>
                  				</div>
                  				<!-- Monto_solicitado End -->

                  				<!-- Plazo_solicitado Start -->
                  				<div class="col-md-12">
                  				 <div class="form-group">
                  				  <label for="plazo_solicitado" class="control-label"> Cuanto pagará el cliente por el crédito </label>
                              <input type="text" class="form-control" id="pago_solicitado" name="pago_aprobado" value="{{{ isset($data->pago_solicitado ) ? round($data->pago_solicitado,2)  : old('pago_solicitado') }}}">
                              <input type="hidden" readonly class="form-control" id="interes_registro" name="interes_aprobado" value="{{{ isset($data->interes_registro ) ? round($data->interes_registro,2)  : 0 }}}">
                  				 </div>
                  				</div>
                                <div class="col-md-12">
                  				 <div class="form-group">
                  				  <label for="plazo_solicitado" class="control-label"> Monto de castigo o mora por atraso de cuota </label>
                                  <input type="text" class="form-control" id="recargos" name="recargos" value="{{{ isset($data->credito->recargos ) ? round($data->credito->recargos, 2) : old('recargos') }}}">
                  				 </div>
                  				</div>
                  				<!-- Plazo_solicitado End -->


                        </div>

                        <div class="row">

                  				<!-- Producto_id Start -->
                  				<div class="col-md-12">
                  				  <div class="form-group">
                  				    <h2 class="col-md-6"> Monto solicitado </h2>
                  						<h2 class="col-md-6" id="montoSolicitado" class="text-right text-info">
                  							 $ {{{ isset($data->monto_solicitado) ? number_format($data->monto_solicitado,2,".",",") : "000.00"}}}
                  						 </h2>
                  				   </div>
                  				</div>
                  				<!-- Producto_id End -->

                  				<!-- Monto_solicitado Start -->
                  				<div class="col-md-12">
                  				 <div class="form-group">
                  					 <h2 class="col-md-6"> Intereses </h2>
                   					<h2 class="col-md-6" id="interesesSolicitado" class="text-right text-warning">
                  						$	<?php

                  								$monto = 0;
                  								if($data->interes_registro) {
                  									$monto = ($data->monto_solicitado * ($data->interes_registro / 100) );
                  									echo number_format($monto,2,".",",");
                  								} else {
                  									echo $monto;
                  								}

                  							?>
                  					</h2>
                  				 </div>
                  				</div>
                  				<!-- Monto_solicitado End -->

                  				<!-- Plazo_solicitado Start -->
                  				<div class="col-md-12">
                  				 <div class="form-group">
                  					 <h2 class="col-md-6"> Total a pagar </h2>
                   					<h2 class="col-md-6" id="totalPagar" class="text-center text-success"> $ <?php echo number_format($monto + $data->monto_solicitado,2,".",","); ?> </h2>
                  				 </div>
                  				</div>
                  				<!-- Plazo_solicitado End -->

                  				<!-- Plazo_solicitado Start -->
                  				<div class="col-md-12">
                  				 <div class="form-group">
                  					 <h2 class="col-md-6"> Plazo del crédito </h2>
                   					<h2 class="col-md-6" id="pagoRealizar" class="text-center text-success"> <?php echo round($data->plazo_solicitado,2); ?> Semanas</h2>
                  					<input type="hidden" id="plazo_solicitado" name="plazo_aprobado" value="{{{ isset($data->plazo_solicitado ) ? $data->plazo_solicitado  : old('plazo_solicitado') }}}">
                  				 </div>
                  				</div>
                  				<!-- Plazo_solicitado End -->

                        </div>

                    </div>
                    <!-- /.tabs1 -->
                    <!-- .tabs 2 -->
                    <div class="tab-pane" id="biography">

                      <h3>Información laboral</h3>

                      <table class="table">
                        <tr>
                          <td>Empresa</td>
                          <td><strong>{{{ $cliente->empresa }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Jefe directo</td>
                          <td><strong>{{{ $cliente->jefe_directo }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Dirección</td>
                          <td><strong>{{{ $cliente->calle_empresa }}} {{{ $cliente->colonia_empresa }}} {{{ $cliente->ciudad_empresa }}}, {{{ $cliente->estado_empresa }}} CP: {{{ $cliente->cp_empresa }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Teléfono</td>
                          <td><strong>{{{ $cliente->telefono_empresa }}}, Ext. {{{ $cliente->extencion_empresa }}}</strong></td>
                        </tr>
                      </table>

                      <h3>Información económica</h3>
                      <table class="table">
                        <tr>
                          <td>Ingreso mensual</td>
                          <td><strong>$ {{{ number_format($cliente->ingreso_mensual,2,".",",") }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Ingreso extra <i>(Adicional)<i></td>
                          <td><strong>$ {{{ number_format($cliente->ingreso_extra,2,".",",") }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Pagos mensuales</td>
                          <td><strong>$ {{{ number_format($cliente->gastos_mensuales,2,".",",") }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Otros gastos mensuales</td>
                          <td><strong>$ {{{ number_format($cliente->pagos_mensuales,2,".",",") }}}</strong></td>
                        </tr>
                      </table>

                    </div>
                    <!-- /.tabs2 -->

                    <!-- .tabs 2 -->
                    <div class="tab-pane" id="documents">
                        <div class="row">
                          <h4>Expediente de la solicitud</h4>
                        </div>
                        <hr>
                        <div class="row">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>Documento</th>
                                      <th width="20%">Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($documentos as $key => $documento) { ?>
                                  <?php
                                  $expediente = $documento->getExpediente($data->id);
                                  ?>
                                  <tr>
                                      <td><?= $documento->nombre ?></td>
                                      <td>
                                          <?php if (empty($expediente)) { ?>
                                          <form name="frm_<?= $documento->id ?>" id="frm_<?= $documento->id ?>" method="post" enctype="multipart/form-data">
                                              {{ csrf_field() }}
                                              <input type="hidden" name="solicitud_id" value="<?= $data->id; ?>">
                                              <input type="hidden" name="documento_id" value="<?= $data->id ?>">
                                              <span class="btn btn-primary fileinput-button">
                                                  <i class="fa fa-upload"></i>
                                                  <span>Carga</span>
                                                  <input data-documento="<?= $documento->id ?>" name="documento" type="file" class="file"  data-url="{{{ url('admin/expediente_digital/upload_file') }}}">
                                              </span>
                                          </form>
                                          <?php }else{ ?>
                                          <button type="button" class="btn btn-success btn-circle btn-modal-view-file" data-toggle="modal" data-expediente="<?= $expediente->id ?>" data-archivo="<?= $expediente->archivo ?>" data-target="#modalVistaDocumento">
                                              <i class="fa fa-image fa-lg" aria-hidden="true"></i>
                                          </button>
                                          <?php } ?>
                                      </td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                          </table>
                        </div>

                    </div>
                    <!-- /.tabs2 -->
                  </div>
                </div>

                <hr/>

                <div class="row">
                  <div class="col-md-6 text-left">
                    <p>Solicitud registrada por: <strong>{{{ $user->name }}}</strong></p>
                  </div>

                  <div class="col-md-6 text-right">
                    <p>Fecha de registro: <strong>{{{ $data->fecha_captura}}}</strong></p>
                  </div>
                </div>

              </div>

          </div>

        </div>

      </form>

  </div>
</div>

<div class="modal fade" id="modalVistaDocumento" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel">Documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="imgModalVistaDocumento" src="" class="img-responsive img-thumbnail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>

$('.btn-modal-view-file').click(function(){
    $('#test').html($(this).attr('data-archivo'));
    $('#imgModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $data->id ); ?>'+ '/' + $(this).attr('data-archivo'));
});

$('#interes_registro').on('change',function(){

	if($(this).val() != "") {

    $('#monto_solicitado').trigger('change');
	}

});

function traeInfoProducto() {

	$.ajax({
		url: "<?php echo url('admin/productos/ajax/' . $data->producto_id); ?>",
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

        var interes = parseFloat(json['data'].tasa_actual);

				$('#interes_registro').val(interes.toFixed(2));

			} else {

				//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
				swal({ title: "ERROR!!", text: json['msg'], type: "error"});

			}


		}

	});

	$.ajax({
		url: "<?php echo url('admin/productos/info/' . $data->producto_id); ?>",
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

				$('#monto_id').html(json['htmlMontos']);
				$('#pago_id').html(json['htmlPagos']);

				<?php if($data->monto_id) { echo "$('#monto_id').val(" . $data->monto_id . "); $('#monto_id').trigger('change');"; } ?>
				<?php if($data->pago_id) { echo "$('#pago_id').val(" . $data->pago_id . "); $('#pago_id').trigger('change');"; } ?>

			} else {

				//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
				swal({ title: "ERROR!!", text: json['msg'], type: "error"});

			}


		}

	});

}

$('#monto_solicitado').on('change',function(){

	if($(this).val() != "") {

		var intereses = parseFloat($('#interes_registro').val());

		var monto = parseFloat($(this).val());

		if(isNaN(intereses)) { intereses = 0; }

		if(isNaN(monto)) { monto = 0; }

		var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

		var total = parseFloat(monto) + parseFloat(interesCalculo);

		$('#interesesSolicitado').html('$ ' + interesCalculo.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		$('#montoSolicitado').html('$ ' + monto.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		$('#totalPagar').html('$ ' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		$('#pago_id').trigger('change');

	}

});

$('#monto_id').on('change',function(){

	if(!$(this).val() == 0) {

		var monto = parseFloat($('#monto_id option:selected').text().replace(",", ""));

		$('#monto_solicitado').val(monto);
		$('#monto_solicitado').trigger('change');

	}

});

$('#pago_id').on('change',function(){

	if(!$(this).val() == 0) {

		var monto = parseFloat($('#pago_id option:selected').text().replace(",", ""));

		$('#pagosSelects').fadeIn();
		$('#pagosInputs').fadeOut();

		$('#pago_solicitado').val(monto);
		$('#pago_solicitado').trigger('change');

		calculaPlazo();

	}

});

$('#pago_solicitado').on('change',function(){
	calculaPlazo();
});

function ocultame(tipo) {

	if(tipo == 1){

		$('#montoSelects').fadeIn();
		$('#montoInputs').fadeOut();

	} else {

		$('#pagosSelects').fadeIn();
		$('#pagosInputs').fadeOut();

	}
}

function resetea() {

	$('#customList').fadeIn();
	$('#newCustomer').fadeOut();
	$('#cliente_id').val("");
	$('#cliente_id').selectpicker('refresh');

}

function calculaPlazo() {

	var monto = parseFloat($('#monto_solicitado').val());

  var intereses = parseFloat($('#interes_registro').val());

	var pago = parseFloat($('#pago_solicitado').val());

  var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

  var total = parseFloat(monto) + parseFloat(interesCalculo);

	var plazo = total / pago;

	$('#plazo_solicitado').val(plazo.toFixed(0));

	$('#pagoRealizar').html(plazo.toFixed(0) + ' Semanas');

}

traeInfoProducto();

</script>
@endsection
