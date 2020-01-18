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

        <?php if($data->exp_aprobado == 1) { ?>
          <div class="row">
            <div class="alert alert-success"> El expediente de credito ha sido validado exitosamente</div>
          </div>
        <?php } else if($data->exp_aprobado == 2) { ?>

          <div class="row">
            <div class="alert alert-danger">El expediente ha sido rechazado con el siguiente comentario <br/> <strong><?php echo $data->msg_rechazo;?></strong></div>
          </div>

        <?php }  ?>

      <div class="row">
        <div class="col-sm-12">
          <div class="white-box">

            <?php if($data->status == 4) { ?>
              <div class="pull-left">
                <button class="btn btn-info btn-rounded" onclick="recuperar()" type="button">
                  <span class="btn-label"><i class="fa fa-trash-o fa-lg"></i></span>Recuperar Solicitud
                </button>
              </div>
            <?php } ?>
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
                    <div class="col-md-6"><strong>Correo Electronico</strong>
                        <p>{{{ $cliente->correo }}}</p>
                    </div>
                </div>
                <!-- /.row -->
                <hr>
                <!-- .row -->
                <div class="row text-center m-t-10">
                    <div class="col-md-12 b-r"><strong>Direccion</strong>
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
                      <p class="text-muted"><strong>$ {{{ number_format($data->monto_solicitado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Pago seleccionado</strong>
                      <br>
                      <p class="text-muted"><strong>$ {{{ number_format($data->pago_solicitado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Producto</strong>
                      <br>
                      <p class="text-muted"><strong>$ {{{ $producto->descripcion }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6"> <strong>Plazo a pagar</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ round($data->plazo_solicitado,2) }}} Semanas</strong></p>
                  </div>
                </div>

              <hr/>

              <h3>Informacion del Fiador</h3>

              <table class="table">
                <tr>
                  <td>Nombre</td>
                  <td><strong>{{{ $cliente->fiador_nombre }}}</strong></td>
                </tr>
                <tr>
                  <td>Dirección</td>
                  <td><strong>{{{ $cliente->fiador_calle }}}</strong></td>
                </tr>
              </table>


              <h3>Informacion Referencias</h3>

              <table class="table">
                <tr>
                  <td colspan="2"><strong>Primera Referencia</strong></td>
                </tr>
                <tr>
                  <td>Nombre</td>
                  <td><strong>{{{ $cliente->referencia1_nombre }}} <small> ({{{ $cliente->referencia1_parentesco }}}) </small> </strong></td>
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
                  <td><strong>{{{ $cliente->referencia2_nombre }}} <small> ({{{ $cliente->referencia2_parentesco }}}) </small></strong></td>
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
                  <td><strong>{{{ $cliente->referencia3_nombre }}} <small> ({{{ $cliente->referencia3_parentesco }}}) </small></strong></td>
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


@endsection

<script>
function recuperar(){

  swal({
      title: "¿ Recuperar solicitud ?",
      text: "¿Esta seguro, realmente desea realizar esta operación, la solicitud sera reactivada para continuar con el proceso de credito?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#fb9678',
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: true,
      closeOnCancel: true
  }, function(isConfirm){
      if (isConfirm) {

      location = "{{{ url('admin/solicitudes/recupera/' . $data->id ) }}}";

      }

  });

}
</script>
