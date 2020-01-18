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
        <form action="<?php echo url('/'); ?>/admin/==table==/edit" id="formValidation" method="post" enctype="multipart/form-data">

          <div class="col-sm-12">

            <div class="white-box">

                <div class="pull-left">
                  <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger">
                    <i class="fa fa-times fa-2x"></i><br/>Cancelar
                  </a>
                </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-check fa-2x"></i><br/>Guardar
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>

          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Editar Informacion </div>
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">

                  {{ csrf_field() }}

                  <input type="hidden" name="id" value="<?php echo @@@data->id; ?>">

                  @include('admin.==table==.form')

                </div>

              </div>
            </div>
          </div>
        </form>
    </div>


  </div>
</div>

@endsection
