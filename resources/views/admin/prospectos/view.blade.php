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

            <?php if($data->status == 3) { ?>
              <div class="pull-left">
                <button class="btn btn-info btn-rounded" onclick="recuperar()" type="button">
                  <span class="btn-label"><i class="fa fa-trash-o fa-lg"></i></span>Recuperar Prospecto
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
                      <p>{{{ $data->nombre }}} {{{ $data->paterno }}} {{{ $data->materno }}}</p>
                  </div>
                    <div class="col-md-6"><strong>Telefono</strong>
                        <p>{{{ $data->telefono }}}</p>
                    </div>
                </div>
                <!-- /.row -->
                <hr>

                <!-- .row -->
                <div class="row text-center m-t-10">
                  <div class="col-md-6"><strong>Celular</strong>
                      <p>{{{ $data->celular }}}</p>
                  </div>
                    <div class="col-md-6"><strong>Correo Electronico</strong>
                        <p>{{{ $data->correo }}}</p>
                    </div>
                </div>
                <!-- /.row -->
                <hr>

                <!-- .row -->
                <div class="row text-center m-t-10">
                  <div class="col-md-6"><strong>Ingreso Mensual</strong>
                      <p>{{{ $data->ingreso_mensual }}}</p>
                  </div>
                    <div class="col-md-6"><strong>Gasto Mensual</strong>
                        <p>{{{ $data->gasto_mensual }}}</p>
                    </div>
                </div>
                <!-- /.row -->

                <hr/>

                <!-- .row -->
                <div class="row text-center m-t-10">
                  <div class="col-md-6"><strong>F. Ingreso</strong>
                      <p><?php if($data->fecha_alta) {  echo $data->fecha_alta; } else { echo 'Desconcida'; }?></p>
                  </div>
                    <div class="col-md-6"><strong>F. Rechazo</strong>
                        <p><?php if($data->fecha_rechazo) {  echo $data->fecha_rechazo; } else { echo 'Desconcida'; }?></p>
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
                      <p class="text-muted"><strong>{{{ number_format($data->monto,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Pago Semanal</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($data->pago,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Plazo</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ $data->plazo_id }}} Semanas</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6"> <strong>Producto</strong>
                      <br>
                      <p class="text-muted"><strong>Impulsa</strong></p>
                  </div>
                </div>

              <hr/>

              <div class="row">
                <?php if($data->status == 3) { ?>

                  <div class="alert alert-danger">
                    Prospecto rechazado, <br/> Comentarios: <?php echo strtoupper($data->msr_rechazo); ?>
                  </div>

                <?php } else if($data->status == 2) { ?>

                  <div class="alert alert-success">
                    Prospecto con solicitud, generada, en proceso de aprobacion de credito
                  </div>

                <?php }  ?>
              </div>  


            </div>

        </div>

      </div>



  </div>
</div>


<script>
function recuperar(){

  swal({
      title: "¿ Recuperar solicitud ?",
      text: "¿Esta seguro, realmente desea realizar esta operación, el prospecto sera reactivada para continuar con el proceso de credito?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#fb9678',
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: true,
      closeOnCancel: true
  }, function(isConfirm){
      if (isConfirm) {

      location = "{{{ url('admin/prospectos/recupera/' . $data->id ) }}}";

      }

  });

}
</script>

@endsection
