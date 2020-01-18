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
															   <label for="credito_id" class="col-sm-3 control-label"> Credito_id </label>
															 </td>
															 <td>
															   {{{ $data->credito_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="pago_id" class="col-sm-3 control-label"> Pago_id </label>
															 </td>
															 <td>
															   {{{ $data->pago_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="saldo_actual" class="col-sm-3 control-label"> Saldo_actual </label>
															 </td>
															 <td>
															   {{{ $data->saldo_actual }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="amortizacion" class="col-sm-3 control-label"> Amortizacion </label>
															 </td>
															 <td>
															   {{{ $data->amortizacion }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="moratorios" class="col-sm-3 control-label"> Moratorios </label>
															 </td>
															 <td>
															   {{{ $data->moratorios }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="pago_aplicado" class="col-sm-3 control-label"> Pago_aplicado </label>
															 </td>
															 <td>
															   {{{ $data->pago_aplicado }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="saldo_final" class="col-sm-3 control-label"> Saldo_final </label>
															 </td>
															 <td>
															   {{{ $data->saldo_final }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha_inicio" class="col-sm-3 control-label"> Fecha_inicio </label>
															 </td>
															 <td>
															   {{{ $data->fecha_inicio }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha_vence" class="col-sm-3 control-label"> Fecha_vence </label>
															 </td>
															 <td>
															   {{{ $data->fecha_vence }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="fecha_pago" class="col-sm-3 control-label"> Fecha_pago </label>
															 </td>
															 <td>
															   {{{ $data->fecha_pago }}}
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
