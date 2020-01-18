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

      <div class="row">
        <div class="col-sm-12">
          <div class="white-box">

            <div class="pull-left">
              <button type="button" onclick="aplica(1)" class="btn btn-success btn-rounded" id="btnApruebaSolicitud">
                <span class="btn-label"><i class="fa fa-check fa-lg"></i></span>Aprobar expediente
              </button>
            </div>

            <div class="pull-left">
              <button type="button" onclick="aplica(0)" class="btn btn-warning btn-rounded" id="btnrechazaSolicitud">
                <span class="btn-label"><i class="fa fa-warning fa-lg"></i></span>Rechazar expediente
              </button>
            </div>


              <div class="pull-right">
                <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger btn-rounded">
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cancelar
                </a>
              </div>
              <div class="clear"></div>
          </div>
        </div>
      </div>

      <div class="row">

        <input type="hidden" name="exp_aprobado" id="exp_aprobado" class="form-control" />

        <div class="col-md-4 col-xs-12">
          <div class="white-box">
            <div class="user-btm-box">
                <hr>
                <!-- .row -->
                <div class="row text-center m-t-10">
                  <div class="col-md-6"><strong>Cliente</strong>
                      <p>{{{ $cliente->nombre }}} {{{ $cliente->paterno }}} {{{ $cliente->materno }}}</p>
                  </div>
                    <div class="col-md-6"><strong>Telefono</strong>
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
                    <div class="col-md-6"><strong>Correo electrónico</strong>
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
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Monto Solicitado</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($solicitud->monto_solicitado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Pago seleccionado</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($solicitud->pago_solicitado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Producto</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ $producto->descripcion }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6"> <strong>Plazo a pagar</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ round($solicitud->plazo_solicitado,2) }}} Semanas</strong></p>
                  </div>
                </div>

              <hr/>

              <div class="row">
                <ul class="nav nav-tabs tabs customtab">

                  <li class="tab active">
                      <a href="#documents" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Documentos</span> </a>
                  </li>
                  <li class="tab">
                      <a href="#biography" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Información de solicitud</span> </a>
                  </li>

                </ul>
                <div class="tab-content">

                  <div class="tab-pane" id="biography">

                    <h3>Informacion del Fiador</h3>

                    <table class="table">
                      <tr>
                        <td>Nombre</td>
                        <td><strong>{{{ $cliente->fiador_nombre }}} {{{ $cliente->fiador_paterno }}} {{{ $cliente->fiador_materno }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Telefono</td>
                        <td><strong>{{{ $cliente->fiador_telefono }}} / {{{ $cliente->fiador_celular }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Dirección</td>
                        <td><strong>{{{ $cliente->fiador_calle }}} {{{ $cliente->fiador_colonia }}} {{{ $cliente->fiador_ciudad }}}, {{{ $cliente->fiador_estado }}} {{{ $cliente->fiador_cp }}}</strong></td>
                      </tr>
                    </table>


                    <h3>Informacion de Referencias</h3>

                    <table class="table">
                      <tr>
                        <td colspan="2"><strong>Primera Referencia</strong></td>
                      </tr>
                      <tr>
                        <td>Nombre</td>
                        <td><strong>{{{ $cliente->referencia1_nombre }}} {{{ $cliente->referencia1_paterno }}} {{{ $cliente->referencia1_materno }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Celular</td>
                        <td><strong>{{{ $cliente->referencia1_celular }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Dirección</td>
                        <td><strong>{{{ $cliente->referencia1_direccion }}}</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>Segunda Referencia</strong></td>
                      </tr>
                      <tr>
                        <td>Nombre</td>
                        <td><strong>{{{ $cliente->referencia2_nombre }}} {{{ $cliente->referencia2_paterno }}} {{{ $cliente->referencia2_materno }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Celular</td>
                        <td><strong>{{{ $cliente->referencia2_celular }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Dirección</td>
                        <td><strong>{{{ $cliente->referencia2_direccion }}}</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>Tercera Referencia</strong></td>
                      </tr>
                      <tr>
                        <td>Nombre</td>
                        <td><strong>{{{ $cliente->referencia23_nombre }}} {{{ $cliente->referencia3_paterno }}} {{{ $cliente->referencia3_materno }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Celular</td>
                        <td><strong>{{{ $cliente->referencia3_celular }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Dirección</td>
                        <td><strong>{{{ $cliente->referencia3_direccion }}}</strong></td>
                      </tr>
                    </table>

                    <hr/>

                  </div>
                  <!-- /.tabs2 -->

                  <!-- .tabs 2 -->
                  <div class="tab-pane active" id="documents">
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
                              <?php $rechazados = 0; $pendiente = 0; ?>
                                <?php foreach ($documentos as $key => $documento) { ?>
                                <?php
                                $expediente = $documento->getExpediente($solicitud->id);
                                ?>
                                <tr>
                                    <td>
                                      <?= $documento->nombre ?>
                                      <?php
                                      if(isset($expediente->aprobado)) {

                                        if($expediente->aprobado == 1) {

                                          echo '<span class="text-success"> <i>DOCUMENTO APROBADO</i> </span>';

                                        } else if($expediente->aprobado == 2) {

                                          echo '<span class="text-danger"> <i>DOCUMENTO RECHAZADO</i> </span>';
                                          $rechazados++;
                                        } else{

                                          echo '<span class="text-warning"> <i>PENDIENTE DE APROBACIÓN</i> </span>';
                                          $pendiente++;
                                        }

                                      } else {
                                        echo '<span class="text-warning"> <i>IMPOSIBLE VALIDAR</i> </span>';
                                      }

                                      ?>
                                    </td>
                                    <td>

                                      <?php if (empty($expediente)) { ?>

                                      <div class="row text-danger"> DOCUMENTO NO CARGADO </div>

                                      <?php }else{ ?>

                                        <?php if($expediente->aprobado != 2) { ?>
                                          <button type="button" class="btn btn-success btn-circle btn-modal-view-file" data-toggle="modal" data-mime="<?= $expediente->mime; ?>" data-expediente="<?= $expediente->id ?>" data-archivo="<?= $expediente->archivo ?>" data-target="#modalVistaDocumento">
                                              <i class="fa fa-image fa-lg" aria-hidden="true"></i>
                                          </button>
                                        <?php } else { ?>

                                          <button class="btn btn-info btn-circle btn-modal-log-file"  data-toggle="modal" data-expediente="<?= $expediente->id ?>" data-documento="<?= $documento->id ?>" data-target="#modalHistoricoDocumento">
                                              <i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
                                          </button>

                                        <?php } ?>

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

            </div>

        </div>

      </div>

  </div>
</div>



<div class="modal fade" id="modalMsg" tabindex="10" role="dialog" aria-labelledby="modalFondeoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFondeoLabel">Resultado del Examen Psicometrico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row" id="contenAprobacion">
                <div class="form-group">
      				      <label for="msg_aprobacion" class="control-label"> ¿ Desea anexar un comentario por aprobacion ? </label>
      							<textarea class="form-control" name="msg_aprobacion" id="msg_aprobacion" rows="5"></textarea>
      				   </div>

              </div>

              <div class="row" id="contentRechazo">
                <div class="form-group">
      				      <label for="msg_rechazo" class="control-label"> ¿ Desea anexar un comentario por rechazo ? </label>
      							<textarea class="form-control" name="msg_rechazo" id="msg_rechazo" rows="5"></textarea>
      				   </div>

              </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar
                </button>

                <button type="button" class="btn btn-success btn-rounded" id="btnRechaza" onclick="enviar()">
                  <span class="btn-label"><i class="fa fa-check fa-lg"></i></span>Confirmar Rechazo
                </button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalVistaDocumento" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel">Documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row">
                <img id="imgModalVistaDocumento" src="" class="img-responsive img-thumbnail">
                <embed id="pdfModalVistaDocumento" src="" type="application/pdf" width="100%" height="600px" />
              </div>

              <div class="row" id="txtComentarios" style="display:none">

                <hr/>

                <div class="col-md-12">
        				  <div class="form-group">
        				      <label for="fondeador_id" class="control-label" id="lblComentario"> Ingrese la razon por la cual se rechaza el documento </label>
                      <textarea class="form-control" name="txtMsgConfirmacion" id="txtMsgConfirmacion" rows="5"></textarea>
                      <input type="hidden" id="txtDocId" name="documento_id" class="form-control" />
        				   </div>
        				</div>

              </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar
                </button>

                <!-- Botones de confirmacion de operacion-->
                <button type="button" class="btn btn-warning btn-rounded"  id="btnDeclina" style="display:none" onclick="cancelaProceso();">
                  <span class="btn-label"><i class="fa fa-chech fa-lg"></i></span>Cancelar Operación
                </button>

                <button type="button" class="btn btn-success btn-rounded"  id="btnConfirma" style="display:none" onclick="sendDocs();">
                  <span class="btn-label"><i class="fa fa-chech fa-lg"></i></span>Confirmar Operación
                </button>


                <!-- Botones de ejecucion de operacion -->
                <button type="button" class="btn btn-info btn-rounded"  onclick="activaComentarios(1)" id="btnRechazaDoc">
                  <span class="btn-label"><i class="fa fa-chech fa-lg"></i></span>Aprobar Documento
                </button>

                <button type="button" class="btn btn-warning btn-rounded" onclick="activaComentarios(2)" id="btnApruebaDoc">
                  <span class="btn-label"><i class="fa fa-warning fa-lg"></i></span>Rechazar Documento
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHistoricoDocumento" tabindex="-1" role="dialog" aria-labelledby="modalHistoricoDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistoricoDocumentoLabel">Histórico de documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Validado</th>
                            <th>Fecha de carga</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-modal-historico-documento">
                        <tr>
                            <td>
                            </td>
                            <td>

                            </td>
                            <td>
                                <button class="btn btn-success btn-circle" data-toggle="modal" data-target="#modalVistaDocumento">
                                    <i class="fa fa-image fa-lg" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>

var aprobacion = 0;

var sin_aprobar = <?php echo ((int)$rechazados + (int)$pendiente); ?>

function aplica(parametro) {

  $('#exp_aprobado').val(parametro);

  var titulo = '';
  var color = '';

  if(parametro == 1) {

    titulo = 'APROBAR EXPEDIENTE';
    color  = '#00c292';
    $('#contenAprobacion').fadeIn();
    $('#contentRechazo').fadeOut();
    $('#modalFondeoLabel').html('Aprobación de Expediente');

  } else {

    titulo = 'RECHAZAR EXPEDIENTE';
    color  = '#fb9678';
    $('#contentRechazo').fadeIn();
    $('#contenAprobacion').fadeOut();
    $('#modalFondeoLabel').html('Rechazo de Expediente');

  }
  swal({
      title: "¿ "  + titulo + " ?",
      text: "¿Esta seguro, realmente desea realizar esta operación?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: color,
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: true,
      closeOnCancel: true
  }, function(isConfirm){
      if (isConfirm) {


        $('#modalMsg').modal({

          backdrop: 'static',

          keyboard: false,

          focus: true
        });


      }

  });

}

function cancelaProceso() {

  $('#txtComentarios').fadeOut();

  //Ocultamos los botones de de aprobacion y rechazo
  $('#btnRechazaDoc').fadeIn();
  $('#btnApruebaDoc').fadeIn();

  //Visualizamos el boton de confirmar y cancelar operacion
  $('#btnConfirma').fadeOut();
  $('#btnDeclina').fadeOut();


}

function enviar() {

  var url ="{{{ url('admin/expediente_digital/aprobado/' . $solicitud->id . '?bandera=') }}}" + $('#exp_aprobado').val();
      url += "&msgR=" + $('#msg_rechazo').val() + "&msgA=" + $('#msg_aprobacion').val();

  location =  url;

}

function activaComentarios(tipo) {

  aprobacion = tipo;

  if(tipo == 1) {

    $('#lblComentario').html('¿ Desea agregar algun comentario ?');

  } else {

    $('#lblComentario').html('Ingrese el motivo de rechazo del documento');

  }


  //Ocultamos los botones de de aprobacion y rechazo
  $('#btnRechazaDoc').fadeOut();
  $('#btnApruebaDoc').fadeOut();

  //Visualizamos el boton de confirmar y cancelar operacion
  $('#btnConfirma').fadeIn();
  $('#btnDeclina').fadeIn();


  $('#txtComentarios').fadeIn();

}

function validaAprobacion() {

  if(sin_aprobar <= 0) {

    $('#btnApruebaSolicitud').fadeIn();
    $('#btnrechazaSolicitud').fadeOut();

  } else {

    $('#btnApruebaSolicitud').fadeOut();
    $('#btnrechazaSolicitud').fadeIn();

  }

}

//Envia condicion o rechazo del documentol
function sendDocs() {


  if(aprobacion == 0) {

    swal({
        title: " ¡ ERROR !", text: "Se ha producido un error, tipo de operacion no encontrada", type: "error",
    });
    return false;

  }

  if($('#txtDocId').val() == "") {

    swal({
        title: " ¡ ERROR !", text: "Folio de expediente no encontrado", type: "error",
    });
    return false;

  }

  var parametros = 'expediente_id=' + $('#txtDocId').val();

  parametros += '&aprobado=' + aprobacion;

  parametros += '&comentarios=' + $('#txtMsgConfirmacion').val();




  location = "{{{ url('admin/expediente_digital/valida_doc/' . $solicitud->id ) }}}?" + parametros;
}


$('.btn-modal-view-file').click(function(){
    $('#imgModalVistaDocumento, #pdfModalVistaDocumento').hide();
    $('#test').html($(this).attr('data-archivo'));
    $('#txtDocId').val($(this).attr('data-expediente'));
    if ($(this).attr('data-mime') == 'application/pdf'){
      $('#pdfModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $solicitud->id ); ?>'+ '/' + $(this).attr('data-archivo'));
      $('#pdfModalVistaDocumento').show();
    }else{
      $('#imgModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $solicitud->id ); ?>'+ '/' + $(this).attr('data-archivo')).attr('data-zoom-image', '<?= asset("uploads/expediente/" . $solicitud->id ); ?>'+ '/' + $(this).attr('data-archivo'));
      $('#imgModalVistaDocumento').show();
      setTimeout(function(){
        $('#imgModalVistaDocumento').elevateZoom({
          zoomType : "lens",
          lensShape : "round",
          lensSize : 200
        });
      },
      500);
    }
});
$('#modalVistaDocumento').on('hidden.bs.modal', function(e){
  $('.zoomContainer').remove();
});

validaAprobacion();
</script>
@endsection
