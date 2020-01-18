  @extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Estatus de solicitud</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="white-box">
                    <h4>Crédito solicitado</h4>
                    <table class="table">
                        <tr>
                            <td>Producto: </td>
                            <td>{{ isset($solicitud->producto) ? $solicitud->producto->clave : '' }}</td>
                        </tr>
                        <tr>
                            <td>Tasa:</td>
                            <td>{{ isset($solicitud->producto) ? number_format($solicitud->producto->tasa_minima, 2) : '' }} %</td>
                        </tr>
                        <tr>
                            <td>Plazo:</td>
                            <td>{{ isset($solicitud->producto) ?  $solicitud->producto->plazo_minimo : '' }}</td>
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
                            <td>{{ isset($solicitud->cliente) ? $solicitud->cliente->nombre : '' }}</td>
                        </tr>
                        <tr>
                            <td>Dirección:</td>
                            <td>{{ isset($solicitud->cliente) ? $solicitud->cliente->calle . ' ' . $solicitud->cliente->colonia . ' ' . $solicitud->cliente->ciudad . ' ' . $solicitud->cliente->estado  : '' }}</td>
                        </tr>
                        <tr>
                            <td>Ingresos:</td>
                            <td>$ {{ isset($solicitud->cliente) ? number_format($solicitud->cliente->ingreso_mensual,2) : '' }}</td>
                        </tr>
                        <tr>
                            <td>Egresos:</td>
                            <td>$ {{ isset($solicitud->cliente) ? number_format($solicitud->cliente->gasto_mensual,2) : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3>Progreso: </h3>
                    <div class="progress progress-lg">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{{$avance}}}" aria-valuemin="0" aria-valuemax="100" style="width: {{{$avance}}}%;">
                            {{{ $avance }}}%
                        </div>
                    </div>
                    <h4>Etapas avanzadas: </h4>
                    <?php $etapasAvance = $solicitud->getEtapasAvance(); ?>
                    <?php foreach ($etapasAvance as $key => $etapa): ?>
                        <div class="col-md-4">
                            <span class="label label-success"><?= $etapa->nombre; ?></span>
                        </div>
                    <?php endforeach ?>
                    <br />
                </div>
            </div>
        </div>
        <?php if (isset($solicitud->prospecto)) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3>Preregistro: </h3>
                    <table class="table">
                        <tr>
                            <td width="33%"><strong>Nombre:</strong> <?= $solicitud->prospecto->nombre; ?></td>
                            <td width="33%"><strong>Apellido paterno:</strong> <?= $solicitud->prospecto->paterno; ?></td>
                            <td><strong>Apellido materno:</strong> <?= $solicitud->prospecto->materno; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono:</strong> <?= $solicitud->prospecto->telefono; ?></td>
                            <td><strong>Celular:</strong> <?= $solicitud->prospecto->celular; ?></td>
                            <td><strong>Email:</strong> <?= $solicitud->prospecto->email; ?></td>
                        </tr>
                    </table>
                </div>                
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Fecha de carga</th>
                                <th>Fecha de validación</th>
                                <th>Validado</th>
                                <th width="20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($documentos as $key => $documento) { ?>
                            <?php 
                            $expediente = $documento->getExpediente($solicitud_id);
                            if (!empty($expediente)) {
                            ?>
                            <tr>
                                <td><?= $documento->nombre ?></td>
                                <td><?= $expediente->fecha_carga ?></td>
                                <td><?= $expediente->fecha_validacion ?></td>
                                <td><?= empty($documento->fecha_validacion) ? 'No' : 'Si' ?></td>
                                <td>
                                    <button class="btn btn-success btn-circle btn-modal-view-file" data-toggle="modal" data-expediente="<?= $expediente->id ?>" data-archivo="<?= $expediente->archivo ?>" data-target="#modalVistaDocumento">
                                        <i class="fa fa-image fa-lg" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                                    <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
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
@endsection

@section('beforeBody')
<script type="text/javascript">
$(function () {
    $('.btn-modal-view-file').click(function(){
        $('#test').html($(this).attr('data-archivo'));
        $('#imgModalVistaDocumento').attr('src', '<?= asset("uploads/expediente/" . $solicitud_id ); ?>'+ '/' + $(this).attr('data-archivo'));
    });
});
</script>
@endsection

