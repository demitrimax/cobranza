@extends('layouts.app2')

@section('content')


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
        <form action="<?php echo url('/'); ?>/admin/solicitudes/refinanciar" id="formValidation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="col-sm-12">

            <div class="white-box">

                <div class="pull-left">
                  <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger">
                    <i class="fa fa-times fa-2x"></i><br/>Cancelar
                  </a>
                </div>
                <div class="pull-right">
                  <button type="button" class="btn btn-success btn-save" onclick="valida()">
                    <i class="fa fa-save fa-2x"></i><br/>Guardar
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>


          <div class="col-sm-12">
            {{ csrf_field() }}


            @include('admin.solicitudes.reform')
          </div>

          <div class="col-sm-12">

            <div class="white-box">

                <div class="pull-left">
                  <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger">
                    <i class="fa fa-times fa-2x"></i><br/>Cancelar
                  </a>
                </div>
                <div class="pull-right">
                  <button type="button" class="btn btn-success btn-save" onclick="valida()">
                    <i class="fa fa-save fa-2x"></i><br/>Guardar
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>


        </form>
    </div>


  </div>

@endsection

@section('css')
<!-- Wizard CSS -->
    <link href="{{asset('themes/plugins/bower_components/jquery-wizard-master/css/wizard.css')}}" rel="stylesheet">
<style type="text/css">
      .map {
        width: 100%;
        height: 500px;
      }
</style>
@endsection
