@extends('layouts.app')

@section('content')
<style type="text/css">
    .error{
        color: #a94442;
    }
    input.error{
        border-color: #a94442;
    }
</style>


<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dispersión</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            </div>
        </div>

        <div class="row">
          <?php if($solicitud->autorizado == 0) { ?>

            <div class="col-md-12">
              <div class="alert alert-danger"> ATENCION: Este credito solo puede ser fondeado una vez que sea autorizado por el supervisor </div>
            </div>

          <?php } ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="white-box">
                    <h4>Crédito solicitado</h4>
                    <table class="table">
                        <tr>
                            <td>Producto: </td>
                            <td>{{ isset($solicitud->producto) ? $solicitud->producto->descripcion : '' }}</td>
                        </tr>
                        <tr>
                            <td>Tasa:</td>
                            <td>{{ isset($solicitud->producto) ? number_format($solicitud->producto->tasa_actual, 2) : '' }} %</td>
                        </tr>
                        <tr>
                            <td>Plazo:</td>
                            <td>{{ isset($solicitud->producto) ?  round($solicitud->plazo_aprobado,2) : '' }} Semanas</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="white-box">
                    <h4>Información del cliente</h4>
                    <table class="table">
                        <tr>
                            <td colspan="2">Nombre: </td>
                            <td colspan="2">{{ isset($solicitud->cliente) ? $solicitud->cliente->nombre : '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Dirección:</td>
                            <td colspan="2">{{ isset($solicitud->cliente) ? $solicitud->cliente->calle . ' ' . $solicitud->cliente->colonia . ' ' . $solicitud->cliente->ciudad . ' ' . $solicitud->cliente->estado  : '' }}</td>
                        </tr>
                        <tr>
                            <td>Pago Semanal:</td>
                            <td>$ {{ isset($solicitud->cliente) ? number_format($solicitud->pago_aprobado,2) : '' }}</td>
                            <td class="text-right">Monto Aprobada:</td>
                            <td>$ {{ isset($solicitud->monto_aprobado) ? number_format($solicitud->monto_aprobado,2) : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Movimientos
                        <div class="panel-action">

                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table display">
                                    <thead>
                                        <tr>
                                            <th>Cuenta origen</th>
                                            <th>Cuenta destino</th>
                                            <th>Monto</th>
                                            <th>Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tboy_dispersion_movimientos">
                                        <?php $montoMovimientos = 0; ?>
                                        <?php foreach ($solicitud->dispersionMovimientos as $key => $movimiento) { ?>
                                        <?php $montoMovimientos = $montoMovimientos + $movimiento->monto; ?>
                                        <tr>
                                            <td><?= $movimiento->cuenta_origen ?></td>
                                            <td><?= $movimiento->cuenta_destino ?></td>
                                            <td><?= $movimiento->monto ?></td>
                                            <td><?= $movimiento->observaciones ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <input type="hidden" id="montoMovimientos" name="montoMovimientos" value="<?= $montoMovimientos ?>">
                            </div>
                            <?php if (($solicitud->monto_aprobado - $montoMovimientos) > 0) {?>
                            <button class="btn btn-info pull-right" id="btn-modal-agregar-movimiento" data-toggle="modal" data-target="#modalFondeo">Agregar</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalFondeo" tabindex="10" role="dialog" aria-labelledby="modalFondeoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFondeoLabel">Registrar movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_movimiento_dispersion" method="post" action="{{{ url('admin/solicitudes/guardarMovimientoDispersion') }}}">
                    {{ csrf_field() }}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cuenta_origen" class="control-label"> Cuenta origen </label>
                            <input type="text" id="cuenta_origen" maxlength="18" name="cuenta_origen" class="form-control texto_numero" required="required">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cuenta_destino" class="control-label"> Cuenta destino </label>
                            <input type="text" id="cuenta_destino" maxlength="18" name="cuenta_destino" class="form-control texto_numero" required="required">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="monto" class="control-label"> Monto a aplicar</label>
                            <input type="text" id="monto" name="monto" maxlength="18" class="form-control texto_decimal" required="required" max="<?php echo  $solicitud->monto_aprobado - $montoMovimientos ?>" value="<?php echo  $solicitud->monto_aprobado - $montoMovimientos ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="observaciones" class="control-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" maxlength="254" name="observaciones texto_alfanumerico_espacio"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="solicitud_id" value="<?= $solicitud->id ?>">
                    <input type="hidden" id="monto_restante" name="monto_restante" value="<?= $solicitud->monto_aprobado - $montoMovimientos ?>">
                    <div class="clear"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-guardar-movimiento" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="modalSearch" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Autorizacion de Credito </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row">

                <div class="col-md-12">
                  <p> Debe de especificar la clave de Adminsitrador, esto permitira que el credito este disponible para dispercion de recursos</p>
                </div>

        				<div class="col-md-12">
        				  <div class="form-group">
        				      <label for="producto_id" class="control-label"> Contraseña del Administrador </label>

        				      <input type="password" class="form-control" id="password" name="password" value="">
        				   </div>
        				</div>

                <div class="col-md-12 text-right">
                  <button onclick="sendAprobacion();" class="btn btn-success"> <li class="fa fa-check"></li> Aprobar</button>
                </div>

              </div>




            </div>
        </div>
    </div>
</div>


@section('beforeBody')
<script type="text/javascript">


<?php if($solicitud->autorizado == 0) { ?>

  $('#modalSearch').modal({

    backdrop: 'static',

    keyboard: false,

    focus: true

  });

<?php } ?>
   function sendAprobacion() {

     $.ajax({
       url: "<?php echo url('admin/solicitudes/aprobar/' . $solicitud->id ); ?>/?p=" +  $('#password').val(),
       dataType: 'json',
       contentType: "application/json; charset=utf-8",
       success: function(json) {

         if(json['error'] == 0) {

           //swal({ title: "CREDITO APROBADO!!", text: json['msg'], type: "success"});
            location.reload(); 

         } else {

           //No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
           swal({ title: "ERROR!!", text: json['msg'], type: "error"});

         }

       }

     });

   }

    $(function () {
        $('#btn-guardar-movimiento').click(function(){
            var frmValid = $('#frm_movimiento_dispersion').valid();
            if (frmValid){

                $('#frm_movimiento_dispersion').submit();
                /*$.post('<?php echo url('admin/solicitudes/guardarMovimientoDispersion'); ?>', $('#frm_movimiento_dispersion').serialize(), function( data ) {
                    if (data != null && data.ok == 1){
                        actualizarMontos();
                        $('#tboy_dispersion_movimientos').append('<tr> <td>'+$('#cuenta_origen').val()+'</td> <td>'+$('#cuenta_destino').val()+'</td> <td>'+$('#monto').val()+'</td> <td>'+$('#observaciones').val()+'</td>  </tr>');
                        $('#modalFondeo').modal('hide');
                        $('#frm_movimiento_dispersion')[0].reset();
                        if (data.montoRestante <= 0){
                            $('#btn-modal-agregar-movimiento').remove();
                            swal({ title: "Solicitud Dispersada", text: "", type: "success"});
                        }
                    }else{
                        alert('Hubo un error, intentalo más tarde');
                    }
                },
                'json');*/
            }
        });

        function actualizarMontos(){
            $('#montoMovimientos').val(parseFloat($('#montoMovimientos').val()) + parseFloat($('#monto').val()));
            $('#monto').attr('max', $('#monto').attr('max') - $('#monto').val() );
            $('#monto_restante').val($('#monto').attr('max'));
        }
    });
</script>
@endsection
