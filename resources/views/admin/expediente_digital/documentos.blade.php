  @extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Carga de expediente digital</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            </div>
        </div>

        <div class="container-fluid">
          <?php if($solicitud->exp_completo == 1) { ?>
            <div class="row">
              <div class="alert alert-success"> La solicitud se encuentra en expediente completo y a espera de validación</div>
            </div>
          <?php } ?>

          <div class="row">
            <div class="col-md-6">
                <div class="white-box">

                  <table class="table">
                    <tbody>
                      <tr>
                        <td><h4>Cliente</h4></td>
                        <td>
                          <h4 class="text-left">
                            {{{ $cliente->nombre }}} {{{ $cliente->paterno }}} {{{ $cliente->materno }}}
                          </h4>
                        </td>
                      </tr>
                      <tr>
                        <td><h4>Dirección</h4></td>
                        <td>
                          <h4 class="text-left">
                          {{{ $cliente->colonia }}} {{{ $cliente->ciudad }}}, {{{ $cliente->estado }}} Cp: {{{ $cliente->cp }}}
                          </h4>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="clear"></div>

                </div>
              </div>

              <div class="col-md-6">
                  <div class="white-box">

                    <table class="table">
                      <tbody>
                        <tr>
                          <td><h4 class="text-left">Número de crédito: </h4></td>
                          <td><h4 class="text-left">{{{ $solicitud->folio }}}</h4></td>
                          <td><h4 class="text-left">Monto solicitado:</h4></td>
                          <td><h4 class="text-left">$ {{{ number_format($solicitud->monto_solicitado,2,".",",") }}}</h4></td>
                        </tr>
                        <tr>
                          <td><h4 class="text-left">Plazo:</h4></td>
                          <td><h4 class="text-left">{{{ $solicitud->plazo_solicitado }}} semanas</h4></td>
                          <td><h4 class="text-left">Producto:</h4></td>
                          <td><h4 class="text-left">{{{ $producto->descripcion }}}</h4></td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="clear"></div>

                  </div>
                </div>

          </div>

          <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
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
                                $expediente = $documento->getExpediente($solicitud_id);
                                ?>
                                <tr>
                                    <td>
                                      <?= $documento->nombre ?>
                                      <?php if($documento->requerido == 1) { echo '<span class="text-danger"><i>Requerido</i></span>'; } else { echo '<span class="text-warning"><i>Opcional</i></span>'; }?>

                                    </td>
                                    <td>
                                        <?php if (empty($expediente)) { ?>
                                        <form name="frm_<?= $documento->id ?>" id="frm_<?= $documento->id ?>" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="solicitud_id" value="<?= $solicitud_id; ?>">
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
                        <div id="bar-progress" class="progress">
                            <div class="progress-bar progress-bar-success"></div>
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

@endsection

@section('beforeBody')

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
            $('#pdfModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $solicitud_id ); ?>'+ '/' + $(this).attr('data-archivo'));
            $('#pdfModalVistaDocumento').show();
        }else{
            $('#imgModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $solicitud_id ); ?>'+ '/' + $(this).attr('data-archivo'));
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
        $.post('<?php echo url('admin/expediente_digital/historial_documento'); ?>', { 'documento_id' : $(ctrl).attr('data-documento'), 'solicitud_id' : <?= $solicitud_id ?>, '_token' : $('meta[name="csrf-token"]').attr('content') }, function( data ) {
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
</script>
@endsection
