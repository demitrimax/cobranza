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
															   <label for="id" class="col-sm-3 control-label"> Id </label>
															 </td>
															 <td>
															   {{{ $data->id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="solicitud_id" class="col-sm-3 control-label"> Solicitud_id </label>
															 </td>
															 <td>
															   {{{ $data->solicitud_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="user_id" class="col-sm-3 control-label"> User_id </label>
															 </td>
															 <td>
															   {{{ $data->user_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha" class="col-sm-3 control-label"> Fecha </label>
															 </td>
															 <td>
															   {{{ $data->fecha }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="cuenta_origen" class="col-sm-3 control-label"> Cuenta_origen </label>
															 </td>
															 <td>
															   {{{ $data->cuenta_origen }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="cuenta_destino" class="col-sm-3 control-label"> Cuenta_destino </label>
															 </td>
															 <td>
															   {{{ $data->cuenta_destino }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="monto" class="col-sm-3 control-label"> Monto </label>
															 </td>
															 <td>
															   {{{ $data->monto }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="observaciones" class="col-sm-3 control-label"> Observaciones </label>
															 </td>
															 <td>
															   {{{ $data->observaciones }}}
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
