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
															   <label for="nombre" class="col-sm-3 control-label"> Nombre </label>
															 </td>
															 <td>
															   {{{ $data->nombre }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="paterno" class="col-sm-3 control-label"> Paterno </label>
															 </td>
															 <td>
															   {{{ $data->paterno }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="materno" class="col-sm-3 control-label"> Materno </label>
															 </td>
															 <td>
															   {{{ $data->materno }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="nacimiento" class="col-sm-3 control-label"> Nacimiento </label>
															 </td>
															 <td>
															   {{{ $data->nacimiento }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="telefono" class="col-sm-3 control-label"> Telefono </label>
															 </td>
															 <td>
															   {{{ $data->telefono }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="celular" class="col-sm-3 control-label"> Celular </label>
															 </td>
															 <td>
															   {{{ $data->celular }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="trabajo" class="col-sm-3 control-label"> Trabajo </label>
															 </td>
															 <td>
															   {{{ $data->trabajo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="correo" class="col-sm-3 control-label"> Correo </label>
															 </td>
															 <td>
															   {{{ $data->correo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="calle" class="col-sm-3 control-label"> Calle </label>
															 </td>
															 <td>
															   {{{ $data->calle }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="colonia" class="col-sm-3 control-label"> Colonia </label>
															 </td>
															 <td>
															   {{{ $data->colonia }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="ciudad" class="col-sm-3 control-label"> Ciudad </label>
															 </td>
															 <td>
															   {{{ $data->ciudad }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="estado" class="col-sm-3 control-label"> Estado </label>
															 </td>
															 <td>
															   {{{ $data->estado }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="cp" class="col-sm-3 control-label"> Cp </label>
															 </td>
															 <td>
															   {{{ $data->cp }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="ocupacion" class="col-sm-3 control-label"> Ocupacion </label>
															 </td>
															 <td>
															   {{{ $data->ocupacion }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="trabaja" class="col-sm-3 control-label"> Trabaja </label>
															 </td>
															 <td>
															   {{{ $data->trabaja }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="ingreso_mensual" class="col-sm-3 control-label"> Ingreso_mensual </label>
															 </td>
															 <td>
															   {{{ $data->ingreso_mensual }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="ingreso_extra" class="col-sm-3 control-label"> Ingreso_extra </label>
															 </td>
															 <td>
															   {{{ $data->ingreso_extra }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="gasto_mensual" class="col-sm-3 control-label"> Gasto_mensual </label>
															 </td>
															 <td>
															   {{{ $data->gasto_mensual }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_nombre" class="col-sm-3 control-label"> Fiador_nombre </label>
															 </td>
															 <td>
															   {{{ $data->fiador_nombre }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_telefono" class="col-sm-3 control-label"> Fiador_telefono </label>
															 </td>
															 <td>
															   {{{ $data->fiador_telefono }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_celular" class="col-sm-3 control-label"> Fiador_celular </label>
															 </td>
															 <td>
															   {{{ $data->fiador_celular }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_trabajo" class="col-sm-3 control-label"> Fiador_trabajo </label>
															 </td>
															 <td>
															   {{{ $data->fiador_trabajo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_calle" class="col-sm-3 control-label"> Fiador_calle </label>
															 </td>
															 <td>
															   {{{ $data->fiador_calle }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_colonia" class="col-sm-3 control-label"> Fiador_colonia </label>
															 </td>
															 <td>
															   {{{ $data->fiador_colonia }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_ciudad" class="col-sm-3 control-label"> Fiador_ciudad </label>
															 </td>
															 <td>
															   {{{ $data->fiador_ciudad }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_estado" class="col-sm-3 control-label"> Fiador_estado </label>
															 </td>
															 <td>
															   {{{ $data->fiador_estado }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_cp" class="col-sm-3 control-label"> Fiador_cp </label>
															 </td>
															 <td>
															   {{{ $data->fiador_cp }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_latitud" class="col-sm-3 control-label"> Fiador_latitud </label>
															 </td>
															 <td>
															   {{{ $data->fiador_latitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fiador_longitud" class="col-sm-3 control-label"> Fiador_longitud </label>
															 </td>
															 <td>
															   {{{ $data->fiador_longitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia1_nombre" class="col-sm-3 control-label"> Referencia1_nombre </label>
															 </td>
															 <td>
															   {{{ $data->referencia1_nombre }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia1_celular" class="col-sm-3 control-label"> Referencia1_celular </label>
															 </td>
															 <td>
															   {{{ $data->referencia1_celular }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia1_domicilio" class="col-sm-3 control-label"> Referencia1_domicilio </label>
															 </td>
															 <td>
															   {{{ $data->referencia1_domicilio }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia1_latitud" class="col-sm-3 control-label"> Referencia1_latitud </label>
															 </td>
															 <td>
															   {{{ $data->referencia1_latitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia1_longitud" class="col-sm-3 control-label"> Referencia1_longitud </label>
															 </td>
															 <td>
															   {{{ $data->referencia1_longitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia2_nombre" class="col-sm-3 control-label"> Referencia2_nombre </label>
															 </td>
															 <td>
															   {{{ $data->referencia2_nombre }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia2_celular" class="col-sm-3 control-label"> Referencia2_celular </label>
															 </td>
															 <td>
															   {{{ $data->referencia2_celular }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia2_domicilio" class="col-sm-3 control-label"> Referencia2_domicilio </label>
															 </td>
															 <td>
															   {{{ $data->referencia2_domicilio }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia2_latitud" class="col-sm-3 control-label"> Referencia2_latitud </label>
															 </td>
															 <td>
															   {{{ $data->referencia2_latitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia2_longitud" class="col-sm-3 control-label"> Referencia2_longitud </label>
															 </td>
															 <td>
															   {{{ $data->referencia2_longitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia3_nombre" class="col-sm-3 control-label"> Referencia3_nombre </label>
															 </td>
															 <td>
															   {{{ $data->referencia3_nombre }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia3_celular" class="col-sm-3 control-label"> Referencia3_celular </label>
															 </td>
															 <td>
															   {{{ $data->referencia3_celular }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia3_domicilio" class="col-sm-3 control-label"> Referencia3_domicilio </label>
															 </td>
															 <td>
															   {{{ $data->referencia3_domicilio }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia3_latitud" class="col-sm-3 control-label"> Referencia3_latitud </label>
															 </td>
															 <td>
															   {{{ $data->referencia3_latitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="referencia3_longitud" class="col-sm-3 control-label"> Referencia3_longitud </label>
															 </td>
															 <td>
															   {{{ $data->referencia3_longitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="latitud" class="col-sm-3 control-label"> Latitud </label>
															 </td>
															 <td>
															   {{{ $data->latitud }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="longitud" class="col-sm-3 control-label"> Longitud </label>
															 </td>
															 <td>
															   {{{ $data->longitud }}}
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
