@extends('layouts.app')

@section('content')

<?php
$searchValue = isset($_GET['searchValue'])?$_GET['searchValue']:'';
$searchBy = isset($_GET['searchBy'])?$_GET['searchBy']:'';
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'';
$order = isset($_GET['order'])?$_GET['order']:'';
$redirect = url('/').'/admin/documentos?'.urlencode($_SERVER["QUERY_STRING"]);
?>


<!-- Page Content -->
<div id="page-wrapper">

  <div class="container-fluid">

      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
        </div>
      </div>


      <div class="row">

        <!-- Inicia botones de Accion -->
        <div class="col-sm-12">

          <div class="white-box">

            <div class="pull-left">
              <a href="{{ url('/admin/creditos_cuotas/add') }}" class="btn btn-info btn-rounded">
                <span class="btn-label"><i class="fa fa-plus fa-lg"></i></span>Agregar Nuevo</a>
            </div>

            <div class="pull-right">
              <button class="btn btn-default btn-rounded" id="btnFilter">
                <span class="btn-label"><i class="fa fa-search fa-lg"></i></span>Buscar Registro
              </button>
            </div>

            <div class="clear"></div>

          </div>

        </div>
        <!-- Terminan botones de Accion -->

        <!-- Aqui Inicia la  busquea -->
        <div class="col-sm-12" style="display:none" id="frmFiltro">

          <form method="GET" action="" class="">

            <div class="panel">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-heading">
                    Buscar un Registro
                  </div>
                  <div class="panel-body">
                    <div class="col-md-2">
                      <div class="form-group">
                          <label for="participante_id" class="control-label"> Buscar por: </label>
                          <select name="searchBy" class="form-control selectpicker">
                           <option value="creditos_cuotas.id" <?php echo $searchBy=="creditos_cuotas.id"?'selected="selected"':""; ?>>Id</option><option value="creditos_cuotas.credito_id" <?php echo $searchBy=="creditos_cuotas.credito_id"?'selected="selected"':""; ?>>Credito_id</option><option value="creditos_cuotas.pago_id" <?php echo $searchBy=="creditos_cuotas.pago_id"?'selected="selected"':""; ?>>Pago_id</option><option value="creditos_cuotas.saldo_actual" <?php echo $searchBy=="creditos_cuotas.saldo_actual"?'selected="selected"':""; ?>>Saldo_actual</option><option value="creditos_cuotas.amortizacion" <?php echo $searchBy=="creditos_cuotas.amortizacion"?'selected="selected"':""; ?>>Amortizacion</option><option value="creditos_cuotas.moratorios" <?php echo $searchBy=="creditos_cuotas.moratorios"?'selected="selected"':""; ?>>Moratorios</option><option value="creditos_cuotas.pago_aplicado" <?php echo $searchBy=="creditos_cuotas.pago_aplicado"?'selected="selected"':""; ?>>Pago_aplicado</option><option value="creditos_cuotas.saldo_final" <?php echo $searchBy=="creditos_cuotas.saldo_final"?'selected="selected"':""; ?>>Saldo_final</option><option value="creditos_cuotas.fecha_inicio" <?php echo $searchBy=="creditos_cuotas.fecha_inicio"?'selected="selected"':""; ?>>Fecha_inicio</option><option value="creditos_cuotas.fecha_vence" <?php echo $searchBy=="creditos_cuotas.fecha_vence"?'selected="selected"':""; ?>>Fecha_vence</option><option value="creditos_cuotas.fecha_pago" <?php echo $searchBy=="creditos_cuotas.fecha_pago"?'selected="selected"':""; ?>>Fecha_pago</option><option value="creditos_cuotas.status" <?php echo $searchBy=="creditos_cuotas.status"?'selected="selected"':""; ?>>Status</option>
                          </select>
                       </div>
                    </div>

                    <div class="col-md-9">
                      <div class="form-group">
                          <label for="participante_id" class="control-label"> Informacion a Buscar: </label>
                          <input type="text" name="searchValue" id="searchValue" class="form-control" value="<?php echo $searchValue; ?>">
                       </div>
                    </div>

                    <div class="col-md-1">
                      <div class="form-group">
                          <label for="participante_id" class="control-label"> Ver: </label>
                          <select name="per_page" class="form-control selectpicker" onchange="this.form.submit()">
                            <option value="20" <?php echo $per_page=="25"?'selected="selected"':""; ?>>25 Registros</option>
                            <option value="50" <?php echo $per_page=="50"?'selected="selected"':""; ?>>50 Registros</option>
                            <option value="100" <?php echo $per_page=="100"?'selected="selected"':""; ?>>100 Registros</option>
                          </select>
                       </div>

                    </div>
                  </div>
                  <div class="panel-footer">

                    <div class="row">

                      <div class="pull-left">
                        <button class="btn btn-primary btn-rounded">
                          <span class="btn-label"><i class="fa fa-search fa-lg"></i></span> Filtrar Listado
                        </button>
                      </div>

                      <div class="pull-right">
                        <a class="btn btn-danger btn-rounded" href="{{{ url('/admin/creditos_cuotas') }}}">
                          <span class="btn-label"><i class="fa fa-times fa-lg"></i></span> Cancelar
                        </a>
                      </div>


                    </div>

                  </div>

                </div>
              </div>

          </form>

        </div>
        <!-- Aqui termina la  busquea -->

        <!-- Inicia listado de registros -->
        <div class="col-sm-12" id="frmListado">

          <div class="panel panel-default">
            <div class="panel-heading">Listado de {{{ $config['titulo'] }}}
                <div class="panel-action">
                    <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Opciones <span class="caret"></span></a>
                      <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu">
                        <li role="presentation"><a href="{{ url('/admin/creditos_cuotas/add') }}" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Nuevo Registro</a></li>
                        <li class="divider" role="presentation"></li>

                        <li role="presentation"><a onclick="$('.buttons-copy').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Copiar Lista</a></li>
                        <li role="presentation"><a onclick="$('.buttons-print').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Imprimir Lista</a></li>
                        <li class="divider" role="presentation"></li>

                        <li role="presentation"><a onclick="$('.buttons-excel').trigger('click');" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i> Exportar Excel</a></li>
                        <li role="presentation"><a onclick="$('.buttons-pdf').trigger('click');" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i> Exportar PDF</a></li>
                        <li class="divider" role="presentation"></li>
                      </ul>
                    </div>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="table-responsive">

                    <table class="table display" >
                      <thead>
                        <tr>
                          
						<th>Id</th>
						
						<th>Credito_id</th>
						
						<th>Pago_id</th>
						
						<th>Saldo_actual</th>
						
						<th>Amortizacion</th>
						
						<th>Moratorios</th>
						
						<th>Pago_aplicado</th>
						
						<th>Saldo_final</th>
						
						<th>Fecha_inicio</th>
						
						<th>Fecha_vence</th>
						
						<th>Fecha_pago</th>
						
						<th>Status</th>
						
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >
                          
            <td>
            {{{ $value->id }}}
            </td>
                
            <td>
            {{{ $value->credito_id }}}
            </td>
                
            <td>
            {{{ $value->pago_id }}}
            </td>
                
            <td>
            {{{ $value->saldo_actual }}}
            </td>
                
            <td>
            {{{ $value->amortizacion }}}
            </td>
                
            <td>
            {{{ $value->moratorios }}}
            </td>
                
            <td>
            {{{ $value->pago_aplicado }}}
            </td>
                
            <td>
            {{{ $value->saldo_final }}}
            </td>
                
            <td>
            {{{ $value->fecha_inicio }}}
            </td>
                
            <td>
            {{{ $value->fecha_vence }}}
            </td>
                
            <td>
            {{{ $value->fecha_pago }}}
            </td>
                
            <td>
            {{{ $value->status }}}
            </td>
                
		   <th>
           <a href="<?php echo url("/"); ?>/admin/creditos_cuotas/view/<?php echo $value->id?>" title="View" data-toggle="tooltip">
            <i class="fa fa-search fa-lg text-primary m-r-10"></i>
           </a>
           <a href="<?php echo url("/"); ?>/admin/creditos_cuotas/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
           </a>
           <button type="button" data-toggle="tooltip" class="delete" style="border:0px" data-url="<?php echo url("/"); ?>/admin/creditos_cuotas/baja/<?php echo $value->id?>" >
           <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
           </a>

            </th>
                        </tr>
                      <?php }  ?>
                      </tbody>
                    </table>

                  </div>
                </div>
                <div class="panel-footer"> {{ $data->links('vendor.pagination.default') }} </div>
            </div>
          </div>

        </div>
        <!-- Termina listado de registros -->

      </div>

  </div>

</div>
<script>
$('#btnFilter').on('click',function(){

  $('#frmFiltro').fadeIn();

  $('#frmListado').fadeOut();

});

$('#clearFilter').on('click',function(){

  $('#frmFiltro').fadeOut();

  $('#frmListado').fadeIn();

});
</script>


@endsection
