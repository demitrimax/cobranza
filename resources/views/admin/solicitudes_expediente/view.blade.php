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
															   <label for="solicitud_id" class="col-sm-3 control-label"> Solicitud_id </label>
															 </td>
															 <td>
															   {{{ $data->solicitud_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="documento_id" class="col-sm-3 control-label"> Documento_id </label>
															 </td>
															 <td>
															   {{{ $data->documento_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="carga_id" class="col-sm-3 control-label"> Carga_id </label>
															 </td>
															 <td>
															   {{{ $data->carga_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="valida_id" class="col-sm-3 control-label"> Valida_id </label>
															 </td>
															 <td>
															   {{{ $data->valida_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="aprobado" class="col-sm-3 control-label"> Aprobado </label>
															 </td>
															 <td>
															   {{{ $data->aprobado }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha_carga" class="col-sm-3 control-label"> Fecha_carga </label>
															 </td>
															 <td>
															   {{{ $data->fecha_carga }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha_validacion" class="col-sm-3 control-label"> Fecha_validacion </label>
															 </td>
															 <td>
															   {{{ $data->fecha_validacion }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha_emision" class="col-sm-3 control-label"> Fecha_emision </label>
															 </td>
															 <td>
															   {{{ $data->fecha_emision }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha_vencimiento" class="col-sm-3 control-label"> Fecha_vencimiento </label>
															 </td>
															 <td>
															   {{{ $data->fecha_vencimiento }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="mime" class="col-sm-3 control-label"> Mime </label>
															 </td>
															 <td>
															   {{{ $data->mime }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="archivo" class="col-sm-3 control-label"> Archivo </label>
															 </td>
															 <td>
															   {{{ $data->archivo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="comentario" class="col-sm-3 control-label"> Comentario </label>
															 </td>
															 <td>
															   {{{ $data->comentario }}}
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
