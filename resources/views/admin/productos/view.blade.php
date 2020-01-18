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
        <form action="<?php echo url('/'); ?>/admin/==table==/add" id="formValidation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

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

          <div class="col-md-12">
            <div class="panel panel-info">
              <div class="panel-heading">{{{ $config['titulo'] }}}</div>
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  {{ csrf_field() }}
                    <table class='table table-bordered' style='width:70%;' align='center'>
															<tr>
															 <td>
															   <label for="descripcion" class="col-sm-3 control-label"> Descripcion </label>
															 </td>
															 <td>
															   {{{ $data->descripcion }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="tasa_minima" class="col-sm-3 control-label"> Tasa_minima </label>
															 </td>
															 <td>
															   {{{ $data->tasa_minima }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="tasa_maxima" class="col-sm-3 control-label"> Tasa_maxima </label>
															 </td>
															 <td>
															   {{{ $data->tasa_maxima }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="tasa_actual" class="col-sm-3 control-label"> Tasa_actual </label>
															 </td>
															 <td>
															   {{{ $data->tasa_actual }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="credito_maximo" class="col-sm-3 control-label"> Credito_maximo </label>
															 </td>
															 <td>
															   {{{ $data->credito_maximo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="credito_minimo" class="col-sm-3 control-label"> Credito_minimo </label>
															 </td>
															 <td>
															   {{{ $data->credito_minimo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="plazo_maximo" class="col-sm-3 control-label"> Plazo_maximo </label>
															 </td>
															 <td>
															   {{{ $data->plazo_maximo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="plazo_minimo" class="col-sm-3 control-label"> Plazo_minimo </label>
															 </td>
															 <td>
															   {{{ $data->plazo_minimo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="status" class="col-sm-3 control-label"> Status </label>
															 </td>
															 <td>
															   {{{ $data->status }}}
															 </td>
															</tr></table>
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>


  </div>
</div>
@endsection
