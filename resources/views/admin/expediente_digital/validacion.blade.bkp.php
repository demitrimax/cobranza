@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Validación de expediente digital</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="white-box">
                        <h4>Crédito solicitado</h4>
                        <table class="table">
                            <tr>
                                <td>Producto: </td>
                                <td>{{ $solicitud->producto->clave }} {{ $solicitud->producto->descripcion }}</td>
                            </tr>
                            <tr>
                                <td>Tasa:</td>
                                <td>{{ number_format($solicitud->producto->tasa_actual, 2) }} %</td>
                            </tr>
                            <tr>
                                <td>Plazo del Credito:</td>
                                <td>{{ $solicitud->plazo_solicitado }} Semaans</td>
                            </tr>
                            <tr>
                                <td>Pago seleccionado:</td>
                                <td>{{ number_format($solicitud->pago_solicitado,2,".",",") }} Semanas</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-box">
                        <h4>Información del cliente</h4>
                        <table class="table">
                            <tr>
                                <td>Nombre: </td>
                                <td>{{ $solicitud->cliente->nombre }} {{ $solicitud->cliente->paterno }} {{ $solicitud->cliente->materno }}</td>
                            </tr>
                            <tr>
                                <td>Dirección:</td>
                                <td>{{ $solicitud->cliente->calle }} {{ $solicitud->cliente->colonia }} {{ $solicitud->cliente->ciudad }} {{ $solicitud->cliente->estado }}</td>
                            </tr>
                            <tr>
                                <td>Ingresos:</td>
                                <td>$ {{ number_format($solicitud->cliente->ingreso_mensual,2) }}</td>
                            </tr>
                            <tr>
                                <td>Egresos:</td>
                                <td>$ {{ number_format($solicitud->cliente->gasto_mensual,2) }}</td>
                            </tr>
                        </table>
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
                                    <th>F. carga</th>
                                    <th>F. validación</th>
                                    <th>Validado</th>
                                    <th width="20%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($documentos as $key => $documento) { ?>
                                <?php
                                $expediente = $documento->getExpediente($solicitud_id);
                                ?>
                                <tr>
                                    <td><?= $documento->nombre ?></td>
                                    <td><?= (!empty($expediente) ) ? $expediente->fecha_carga : '--' ?></td>
                                    <td><?= (!empty($expediente) ) ? $expediente->fecha_validacion : '--' ?></td>
                                    <td><?= empty($documento->fecha_validacion) ? 'No' : 'Si' ?></td>
                                    <td>
                                        <?php if (empty($expediente)) { ?>
                                        <form name="frm_<?= $documento->id ?>" id="frm_<?= $documento->id ?>" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="solicitud_id" value="<?= $solicitud_id; ?>">
                                            <input type="hidden" name="documento_id" value="<?= $documento->id ?>">
                                            <span class="btn btn-primary fileinput-button">
                                                <i class="fa fa-upload"></i>
                                                <span>Carga</span>
                                                <input data-documento="<?= $documento->id ?>" name="documento" type="file" class="file"  data-url="{{{ url('admin/expediente_digital/upload_file') }}}">
                                            </span>
                                        </form>
                                        <?php }else{ ?>
                                        <button title="Eliminar Documento" class="btn btn-danger btn-circle btn-delete" data-expediente="<?= $expediente->id ?>" data-url="<?php echo url("/"); ?>/admin/expediente_digital/delete_file/<?php echo $expediente->id?>">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                                        </button>
                                        <button titl="Validar Documento" class="btn btn-primary btn-circle btn-modal-validation-file" data-toggle="modal" data-documento="<?= $documento->id ?>" data-expediente="<?= $expediente->id ?>" data-archivo="<?= $expediente->archivo ?>" data-target="#modalValidacionDocumento">
                                            <i class="fa fa-check-square-o fa-lg"></i>
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

<div class="modal fade bs-example-modal-lg" id="modalHistoricoDocumento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistoricoDocumentoLabel">Validación de documento</h5>
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
                            <th>F. Carga</th>
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

<div class="modal fade" id="modalValidacionDocumento" tabindex="-1" role="dialog" aria-labelledby="modalValidacionDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistoricoDocumentoLabel">Historico de documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="imgModalValidacionDocumento" src="" class="img-responsive img-thumbnail">
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Regla</th>
                                    <th>Validar</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-modal-reglas-documento">
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row comentario-rechazo" style="display: none;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="nombre" class="control-label">Motivo de rechazo:</label>
                            <textarea id="comentario" required="required" class="form-control"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-rounded" id="btn-cofirmar-rechazo">
                      <span class="btn-label"><i class="fa fa-times fa-lg"></i></span> Confirmar rechazo
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btn-rechazo">Rechazo</button>
                <button type="button" class="btn btn-success btn-validar-documento" data-expediente="">Validar</button>
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

    $('.btn-modal-validation-file').click(function(){
        var ctrl = this;
        $('#test').html($(ctrl).attr('data-archivo'));
        $('#imgModalValidacionDocumento').attr('src', '<?= asset("uploads/expediente/" . $solicitud_id ); ?>'+ '/' + $(this).attr('data-archivo'));
        $('.btn-validar-documento').attr('data-expediente', $(ctrl).attr('data-expediente'));
        $.post('<?php echo url('admin/expediente_digital/get_reglas'); ?>', { 'documento_id' : $(ctrl).attr('data-documento'), 'solicitud_id' : <?= $solicitud_id ?>, '_token' : $('meta[name="csrf-token"]').attr('content') }, function( data ) {
            if (data != null){
                var strHtml = '';
                $.each(data, function( index, value ) {
                    strHtml += '<tr> <td>'+value.regla+'</td> <td><input type="checkbox" name="chk-regla" value="1" class="chk_regla"></td> </tr> ';
                });
                $('#tbody-modal-reglas-documento').html(strHtml);
            }
        },
        'json');
    });

    $('.btn-validar-documento').click(function(){
        var ctrl = this;
        var chks = $('.chk_regla').length;
        var chksActivos = $('input[name=chk-regla]:checked').length;
        console.log(chks);
        console.log(chksActivos);
        if (chks == chksActivos){
            $.post('<?php echo url('admin/expediente_digital/validar_expediente'); ?>', { 'expediente_id' : $(ctrl).attr('data-expediente'), 'documento_id' : $(ctrl).attr('data-documento'), 'solicitud_id' : <?= $solicitud_id ?>, '_token' : $('meta[name="csrf-token"]').attr('content') }, function( data ) {
                if (data != null){
                    var strHtml = '';
                    $.each(data, function( index, value ) {
                        strHtml += '<tr> <td>'+value.regla+'</td> <td><input type="checkbox" name="chk-regla" value="1" class="chk_regla"></td> </tr> ';
                    });
                    $('#tbody-modal-reglas-documento').html(strHtml);
                }
            },
            'json');
            alert('Validado correctamente')
        }else{
            alert('Valida todas las reglas');
        }
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

    $('#btn-rechazo').click(function(){
        $('.comentario-rechazo').show();
    });

    $('#btn-cofirmar-rechazo').click(function(){
        if ($('#comentario').val() != ''){
            setRechazo();
        }else{
            alert('Agrega un comentario');
        }
    });

});

function setRechazo(){
    $.post('<?php echo url('admin/expediente-digital/rechazo'); ?>', { 'expediente_id' : $('.btn-validar-documento').attr('data-expediente'), 'comentario' : $('#comentario').val(), '_token' : $('meta[name="csrf-token"]').attr('content') }, function( data ) {
        if (data != null){
            alert('Rechazado correctamente');
            location.reload();
        }
    },
    'json');
}
</script>
@endsection
