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
              <div class="pull-right">
                <a href="{{{ $config['cancelar'] }}}" class="btn btn-default ">
                  <li class="fa fa-times fa-2x"></li>&nbsp;<br>Cancelar
                </a>
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
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Monto fondeado</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($data->monto_fondeado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Cuota semanal</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($solicitud->pago_solicitado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Producto</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ $producto->descripcion }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6"> <strong>Plazo a pagar</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ round($data->plazo,2) }}} Semanas</strong></p>
                  </div>
                </div>

              <hr/>


              <div class="row">

                <p>PLAN DE PAGOS SEMANALES</p>
                <p>Acuda a cualquier sucural BBVA Bancomer para hacer su pago sin costos adicionales</p>
                <p>En OXXO y 7ELEVEN Comision de $ 8.00</p>
                <br/>
                <hr/>

                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">CEI</th>
                      <th class="text-center">Referencia</th>
                      <th class="text-center">Importe</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($cuotas as $cuota) {  ?>
                      <tr class="<?php if($cuota->status == 1) { echo 'warning'; } else if($cuota->status == 2) { echo 'success'; } else if($cuota->status == 3) { echo 'danger'; }?>">
                        <td class="text-center"><a href="javascript:verDetalle({{{ $cuota->id }}})">{{{ $i }}}</a></td>
                        <td class="text-center">{{{ date('d/m/Y',strtotime($cuota->fecha_inicio)) }}}</td>
                        <td class="text-center"> </td>
                        <td class="text-center"> </td>
                        <td class="text-center">$ {{{ number_format($cuota->amortizacion,2,".",",") }}}</td>
                      </tr>
                      <?php $i++; ?>
                    <?php } ?>

                  </tbody>
                </table>

                <hr/>

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
</script>

@endsection
