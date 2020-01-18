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
            <div class="user-bg text-center" style="height:auto;">
              <?php if(!empty($data->voucher)) { ?>
                <img alt="user" src="<?php echo str_replace('index.php','',url('/')) . '/uploads/' . $data->voucher; ?>" width="100%">
              <?php } else { ?>
                <li class="fa fa-image fa-5x" style="font-size:400px;"></li>
              <?php } ?>
            </div>
            <div class="user-btm-box">
                <hr>
                <!-- .row -->
                <div class="row text-center m-t-10">
                  <div class="col-md-6"><strong>Número de pago</strong>
                      <p>{{{ $data->id }}}</p>
                  </div>
                    <div class="col-md-6"><strong>Fecha de aplicación</strong>
                        <p>{{{ $data->fecha_pago }}}</p>
                    </div>
                </div>
                <!-- /.row -->

                <hr>

                <!-- .row -->
                <div class="row text-center m-t-10">
                    <div class="col-md-12 b-r"><strong>Monto aplicado</strong>
                        <p>
                          $ {{{ number_format($data->monto,2,".",",") }}}
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
                <h3>Coutas afectadas por el pago</h3>
              </div>

              <hr/>

              <div class="row">
                <div class="col-md-6 text-left">
                  <p>Pago registrado por: <strong>{{{ $data->name }}}</strong></p>
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
