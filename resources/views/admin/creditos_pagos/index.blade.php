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
              <a href="{{ url('/admin/creditos_pagos/add') }}" class="btn btn-info btn-rounded">
                <span class="btn-label"><i class="fa fa-plus fa-lg"></i></span>Agregar nuevo</a>
            </div>

            <div class="pull-right">
              <button class="btn btn-default btn-rounded" id="btnFilter">
                <span class="btn-label"><i class="fa fa-search fa-lg"></i></span>Buscar registro
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
                           <option value="creditos.folio" <?php echo $searchBy=="creditos.folio"?'selected="selected"':""; ?>>Credito_id</option><option value="creditos_pagos.fecha_pago" <?php echo $searchBy=="creditos_pagos.fecha_pago"?'selected="selected"':""; ?>>Fecha de pago</option><option value="creditos_pagos.fecha_captura" <?php echo $searchBy=="creditos_pagos.fecha_captura"?'selected="selected"':""; ?>>Fecha de captura</option><option value="creditos_pagos.monto_capturado" <?php echo $searchBy=="creditos_pagos.monto_capturado"?'selected="selected"':""; ?>>Monto capturado</option><option value="creditos_pagos.capital" <?php echo $searchBy=="creditos_pagos.capital"?'selected="selected"':""; ?>>Capital</option><option value="creditos_pagos.interes" <?php echo $searchBy=="creditos_pagos.interes"?'selected="selected"':""; ?>>Interés</option><option value="creditos_pagos.status" <?php echo $searchBy=="creditos_pagos.status"?'selected="selected"':""; ?>>Status</option>
                          </select>
                       </div>
                    </div>

                    <div class="col-md-9">
                      <div class="form-group">
                          <label for="participante_id" class="control-label"> Información a buscar: </label>
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
                          <span class="btn-label"><i class="fa fa-search fa-lg"></i></span> Filtrar listado
                        </button>
                      </div>

                      <div class="pull-right">
                        <a class="btn btn-danger btn-rounded" href="{{{ url('/admin/creditos_pagos') }}}">
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
                        <li role="presentation"><a href="{{ url('/admin/creditos_pagos/add') }}" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Nuevo Registro</a></li>
                        <li class="divider" role="presentation"></li>

                        <li role="presentation"><a onclick="$('.buttons-copy').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Copiar Lista</a></li>
                        <li role="presentation"><a onclick="$('.buttons-print').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Imprimir lista</a></li>
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
                          <th>Cliente</th>
                          <th>Crédito</th>
                          <th>Capturo</th>
                          <th>Fecha de pago</th>
                          <th>Monto aplicado</th>
                          <th>Estatus</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >

                          <td>{{{ $value->cteNombre }}} {{{ $value->ctePaterno }}} {{{ $value->cteMaterno }}} </td>
                          <td> {{{ $value->folio }}} </td>
                          <td> {{{ $value->aplicador }}} </td>
                          <td> {{{ $value->fecha_pago }}} </td>
                          <td>$ {{{ number_format($value->monto + $value->recargos,2,".",",") }}} </td>
                          <td>
                            <?php if($value->status == 1) { echo 'Aplicado'; } else if($value->status == 2) { echo 'Pendiente de Aplicar'; } else { echo 'Cancelado'; }?>
                          </td>
		                      <th>
                           <a href="<?php echo url("/"); ?>/admin/pagos/view/<?php echo $value->id?>" title="Ver Aplicacion" data-toggle="tooltip">
                            <i class="fa fa-search fa-lg text-primary m-r-10"></i>
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
