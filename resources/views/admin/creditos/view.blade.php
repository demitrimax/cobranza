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

            <?php if($data->status == 2) { ?>
              <div class="pull-left">
                <button onclick="renovar()" class="btn btn-success">
                    <i class="fa fa-recycle fa-2x"></i><br/>Refinanciar
                </button>
              </div>
            <?php } ?>

              <div class="pull-right">
                <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger">
                  <i class="fa fa-times fa-2x"></i><br/>Cancelar</a>
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
                    <div class="col-md-12 col-xs-6">
                        <p><strong>Producto: <span class="text-muted">{{{ $producto->descripcion }}}</span></strong></p>
                    </div>
                </div>
                <hr/>
              <div class="row">
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Monto fondeado</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($data->monto_fondeado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Cuota semanal</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($solicitud->pago_solicitado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-2 col-xs-6 b-r"> <strong>Plazo a pagar</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ round($data->plazo,2) }}} Semanas</strong></p>
                  </div>
                  <div class="col-md-2 col-xs-6"> <strong>Recargos</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($data->recargos,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-2 col-xs-6"> <strong>Puntaje</strong>
                      <br>
                      <p class="text-muted"><a href="{{ url('/admin/documentos/puntaje/' . $data->solicitud_id) }}"  target="_blank"><strong class="">{{{ $data->puntaje }}}</strong></a></p>
                  </div>
                </div>

                <hr/>

                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Jefe Inmediato</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ $cliente->jefe_directo }}}</strong></p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Tel. Trabajo</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ $cliente->telefono_empresa }}}</strong></p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Fiador</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ $cliente->fiador_nombre }}} {{{ $cliente->fiador_paterno }}} {{{ $cliente->fiador_materno }}}</strong></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Telefonos Fiadro</strong>
                        <br>
                        <p class="text-muted"><strong>{{{ $cliente->fiador_telefono }}} {{{ $cliente->fiador_celular }}}</strong></p>
                    </div>

                  </div>

                  <hr/>

                  <div class="row">
                      <div class="col-md-6 col-xs-6 b-r"> <strong>1ra Referencia</strong>
                          <br>
                          <p class="text-muted"><strong>{{{ $cliente->referencia1_nombre }}} {{{ $cliente->referencia1_paterno }}} {{{ $cliente->referencia1_maternon }}}</strong></p>
                          <p class="text-muted"><strong>{{{ $cliente->referencia1_telefono }}} {{{ $cliente->referencia2_celular }}}</strong></p>
                      </div>
                      <div class="col-md-6 col-xs-6 b-r"> <strong>2da Referencia</strong>
                          <br>
                          <p class="text-muted"><strong>{{{ $cliente->referencia2_nombre }}} {{{ $cliente->referencia2_paterno }}} {{{ $cliente->referencia2_maternon }}}</strong></p>
                          <p class="text-muted"><strong>{{{ $cliente->referencia2_telefono }}} {{{ $cliente->referencia2_celular }}}</strong></p>
                      </div>
                    </div>

                    <hr/>

                    <div class="row text-right">
                      <a href="{{{ url ('admin/clientes/edit/' . $cliente->id )}}}" class="btn btn-primary" target="_blank">
                        <span class="btn-label"><i class="fa fa-edit fa-lg"></i></span>Editar Cliente</a>
                    </div>

                    <hr/>

              <div class="row">
                <ul class="nav nav-tabs tabs customtab">
                  <li class="tab active">
                      <a href="#home" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-table"></i></span> <span class="hidden-xs">Tabla de amortización</span> </a>
                  </li>
                  <li class="tab">
                      <a href="#biography" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-money"></i></span> <span class="hidden-xs">Transacciones</span> </a>
                  </li>
                  <li class="tab">
                      <a href="#solicitud" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-edit"></i></span> <span class="hidden-xs">Solicitud de crédito</span> </a>
                  </li>
                  <li class="tab">
                      <a href="#documents" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-file"></i></span> <span class="hidden-xs">Expediente</span> </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <!-- .tabs 1 -->
                  <div class="tab-pane active" id="home">

                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Saldo inicial</th>
                          <th class="text-center">Monto a pagar</th>
                          <th class="text-center">Pago aplicado</th>
                          <th class="text-center">Saldo final</th>
                          <th class="text-center">F. Pago</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($cuotas as $cuota) {  ?>
                          <tr class="<?php if($cuota->status == 1) { echo 'warning'; } else if($cuota->status == 2) { echo 'success'; } else if($cuota->status == 3) { echo 'danger'; }?>">
                            <td class="text-center"><a href="javascript:verDetalle({{{ $cuota->id }}})">{{{ $i }}}</a></td>
                            <td class="text-center">$ {{{ number_format($cuota->saldo_actual,2,".",",") }}}</td>
                            <td class="text-center">$ {{{ number_format($cuota->amortizacion,2,".",",") }}}</td>
                            <td class="text-center">$ {{{ number_format($cuota->pago_aplicado,2,".",",") }}}</td>
                            <td class="text-center">$ {{{ number_format($cuota->saldo_final,2,".",",") }}}</td>
                            <td class="text-center"> {{{ $cuota->fecha_pago }}}</td>
                          </tr>
                          <?php $i++; ?>
                        <?php } ?>

                      </tbody>
                    </table>

                  </div>
                  <!-- /.tabs1 -->
                  <!-- .tabs 2 -->
                  <div class="tab-pane" id="biography">

                    <div class="panel panel-default">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Fecha</th>
                            <th>Movimiento</th>
                            <th class="text-center">Saldo inicial</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Abono</th>
                            <th class="text-center">Saldo final</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($transacciones as $transaccion) { ?>
                            <tr>
                              <td>{{{ date('d/m/Y',strtotime($transaccion->fecha_transaccion)) }}}</td>
                              <td>{{{ $transaccion->transaccion }}}</td>
                              <td class="text-center">$ {{{ number_format($transaccion->saldo_anterior,2,".",",") }}}</td>
                              <td class="text-center text-danger">$ {{{ number_format($transaccion->cargo,2,".",",") }}}</td>
                              <td class="text-center text-success">$ {{{ number_format($transaccion->abono,2,".",",") }}}</td>
                              <td class="text-center">$ {{{ number_format($transaccion->saldo_final,2,".",",") }}}</td>
                            </tr>
                          <?php } ?>

                        </tbody>
                      </table>
                    </div>

                  </div>
                  <!-- /.tabs2 -->

                  <div class="tab-pane" id="solicitud">

                    <h3>Información general</h3>

                    <table class="table">
                      <tr>
                        <td>Folio de solicitud</td>
                        <td>{{{ $solicitud->id }}}</td>
                      </tr>
                      <tr>
                        <td>Monto solicitado</td>
                        <td>$ {{{ number_format($solicitud->monto_solicitado,2,".",",") }}}</td>
                      </tr>
                      <tr>
                        <td>Pago solicitado</td>
                        <td>$ {{{ number_format($solicitud->pago_solicitado,2,".",",") }}}</td>
                      </tr>
                      <tr>
                        <td>Interés inicial</td>
                        <td>$ {{{ round($solicitud->interes_registro,2) }}} %</td>
                      </tr>
                      <tr>
                        <td>Monto aprobado</td>
                        <td>$ {{{ number_format($solicitud->monto_aprobado,2,".",",") }}}</td>
                      </tr>
                      <tr>
                        <td>Pago aprobado</td>
                        <td>$ {{{ number_format($solicitud->pago_aprobado,2,".",",") }}}</td>
                      </tr>
                      <tr>
                        <td>Interés aprobado</td>
                        <td>$ {{{ round($solicitud->interes_registro,2) }}}</td>
                      </tr>
                    </table>

                    <h3>Informacion del Fiador</h3>
                    <table class="table">
                      <tr>
                        <td>Nombre</td>
                        <td><strong>{{{ $cliente->fiador_nombre }}} {{{ $cliente->fiador_paterno }}} {{{ $cliente->fiador_materno }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Dirección</td>
                        <td><strong>{{{ $cliente->fiador_calle }}} {{{ $cliente->fiador_colonia }}} {{{ $cliente->fiador_ciudad }}}, {{{ $cliente->fiador_estado }}} {{{ $cliente->fiador_cp }}}</strong></td>
                      </tr>
                      <tr>
                        <td>Telefonos</td>
                        <td><strong>{{{ $cliente->fiador_celular }}}</strong></td>
                      </tr>
                    </table>

                    <h3>Informacion Referencias</h3>
                    <table class="table">
                      <tr>
                        <td colspan="2"><strong>Primera Referencia</strong></td>
                      </tr>
                      <tr>
                        <td>Nombre</td>
                        <td><strong>{{{ $cliente->referencia1_nombre }}} <small> {{{ $cliente->referencia1_parentesco }}} </small> </strong></td>
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
                        <td><strong>{{{ $cliente->referencia2_nombre }}} <small> {{{ $cliente->referencia2_parentesco }}} </small> </strong></td>
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
                        <td><strong>{{{ $cliente->referencia3_nombre }}} <small> {{{ $cliente->referencia3_parentesco }}} </small> </strong></td>
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

                  </div>
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
                                $expediente = $documento->getExpediente($data->solicitud_id);
                                ?>
                                <tr>
                                    <td><?= $documento->nombre ?></td>
                                    <td>
                                      <?php if (empty($expediente)) { ?>
                                      <form name="frm_<?= $documento->id ?>" id="frm_<?= $documento->id ?>" method="post" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="solicitud_id" value="<?= $data->solicitud_id; ?>">
                                          <input type="hidden" name="documento_id" value="<?= $documento->id ?>">
                                          <span class="btn btn-primary btn-rounded fileinput-button">
                                                <span class="btn-label"><i class="fa fa-upload"></i></span>
                                              <span>Carga</span>
                                              <input data-documento="<?= $documento->id ?>" name="documento" type="file" class="file"  data-url="{{{ url('admin/expediente_digital/upload_file') }}}">
                                          </span>
                                      </form>
                                      <?php }else{ ?>
                                      <button class="btn btn-success btn-circle btn-modal-view-file" data-toggle="modal" data-mime="<?= $expediente->mime; ?>" data-expediente="<?= $expediente->id ?>" data-archivo="<?= $expediente->archivo ?>" data-target="#modalVistaDocumento">
                                          <i class="fa <?= $expediente->mime == 'application/pdf' ? 'fa-image' : 'fa-image'; ?> fa-lg" aria-hidden="true"></i>
                                      </button>
                                      <button class="btn btn-info btn-circle btn-modal-log-file"  data-toggle="modal" data-expediente="<?= $expediente->id ?>" data-documento="<?= $documento->id ?>" data-target="#modalHistoricoDocumento">
                                          <i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
                                      </button>
                                      <button class="btn btn-danger btn-circle btn-delete" data-expediente="<?= $expediente->id ?>" data-url="<?php echo url("/"); ?>/admin/expediente_digital/delete_file/<?php echo $expediente->id?>">
                                          <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
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

  </div>
</div>


<div class="modal fade bs-example-modal-lg" id="modalVistaDocumento" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 800px; margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel">Documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="imgModalVistaDocumento" src="" class="img-responsive img-thumbnail">
                <embed id="pdfModalVistaDocumento" src="" type="application/pdf" width="100%" height="600px" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
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


<link href="{{ asset('themes/plugins/jqueryfileupload/css/jquery.fileupload.css') }}" rel="stylesheet">

<script src="{{ asset('themes/plugins/jqueryfileupload/js/vendor/jquery.ui.widget.js') }}"></script>

<script src="{{ asset('themes/plugins/jqueryfileupload/js/jquery.iframe-transport.js') }}"></script>

<script src="{{ asset('themes/plugins/jqueryfileupload/js/jquery.fileupload.js') }}"></script>

<script type="text/javascript">
$(function () {

    $('.file').click(function(){
        $('.progress .progress-bar').css( 'width', '0%');
    });
    $('.file').fileupload({
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        done: function (e, data) {
            window.location.reload();
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.progress .progress-bar').css( 'width', progress + '%');
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('.btn-delete').on('click', function(){
        var ctrl = this;
        swal({
            title: "¿Estás seguro de eliminar este elemento?",
            text: "Ya no se podrá recuperar",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Eliminar",
            closeOnConfirm: false
        },
        function(isConfirm){
            if (isConfirm) {
                window.location.href = $(ctrl).attr('data-url');
            }
        });
    });

    $('.btn-modal-view-file').click(function(){
        $('#test').html($(this).attr('data-archivo'));
        $('#imgModalVistaDocumento, #pdfModalVistaDocumento').hide();
        if ($(this).attr('data-mime') == 'application/pdf'){
            $('#pdfModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $data->solicitud_id ); ?>'+ '/' + $(this).attr('data-archivo'));
            $('#pdfModalVistaDocumento').show();
        }else{
            $('#imgModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $data->solicitud_id ); ?>'+ '/' + $(this).attr('data-archivo'));
            $('#imgModalVistaDocumento').show();
              setTimeout(function(){
                $('#imgModalVistaDocumento').elevateZoom({
                  zoomType : "lens",
                  lensShape : "round",
                  lensSize : 200,
                  scrollZoom: true
                });
              },
              500);
        }
    });

$('#modalVistaDocumento').on('hidden.bs.modal', function(e){
  $('.zoomContainer').remove();
});

    $('.btn-modal-log-file').click(function(){
        var ctrl = this;
        $.post('<?php echo url('admin/expediente_digital/historial_documento'); ?>', { 'documento_id' : $(ctrl).attr('data-documento'), 'solicitud_id' : <?= $data->solicitud_id ?>, '_token' : $('meta[name="csrf-token"]').attr('content') }, function( data ) {
            if (data != null){
                var strHtml = '';
                $.each(data, function( index, value ) {
                    strHtml += '<tr> <td>'+value.mime+'</td> <td>'+((value.fecha_validacion == null) ? 'No' : 'Si' )+'</td> <td>'+value.fecha_carga+'</td> </tr> ';
                });
                $('#tbody-modal-historico-documento').html(strHtml);
            }
        },
        'json');
    });

});

function renovar() {
  swal({
      title: " ¿ Refinanciar Credito ?",
      text: "Este credito sera saldado y generado en una nueva solicitud para fondeo, ¿ Desea continuar ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#00c292",
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: true,
      closeOnCancel: true
  }, function(isConfirm){
      if (isConfirm) {

        location =  "{{ url('admin/solicitudes/add/?credito_id=' . $data->id) }}";

      } else {

      }
  });
}
</script>

@endsection
