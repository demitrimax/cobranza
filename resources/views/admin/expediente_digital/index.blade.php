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
              <a href="{{ url('/admin/solicitudes/add') }}" class="btn btn-info btn-rounded">
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
      </div>

      <div class="row" style="display:none" id="frmFiltro">

        <!-- Aqui Inicia la  busquea -->
        <div class="col-sm-12">

          <form method="GET" action="" class="">

            <div class="panel">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-heading">
                    Buscar un registro
                  </div>
                  <div class="panel-body">
                    <div class="col-md-2">
                      <div class="form-group">
                          <label for="participante_id" class="control-label"> Buscar por: </label>
                          <select name="searchBy" class="form-control selectpicker">
                           <option value="etapas.nombre" <?php echo $searchBy=="etapas.nombre"?'selected="selected"':""; ?>>Etap_flujo</option><option value="clientes.nombre" <?php echo $searchBy=="clientes.nombre"?'selected="selected"':""; ?>>Cliente</option><option value="fondeadores.nombre" <?php echo $searchBy=="fondeadores.nombre"?'selected="selected"':""; ?>>Fondeador</option><option value="productos.descripcion" <?php echo $searchBy=="productos.descripcion"?'selected="selected"':""; ?>>Producto</option><option value="users.name" <?php echo $searchBy=="users.name"?'selected="selected"':""; ?>>Captura</option><option value="users.name" <?php echo $searchBy=="users.name"?'selected="selected"':""; ?>>Aprueba</option><option value="solicitudes.fecha_captura" <?php echo $searchBy=="solicitudes.fecha_captura"?'selected="selected"':""; ?>>Fecha de captura</option><option value="solicitudes.fecha_aprobacion" <?php echo $searchBy=="solicitudes.fecha_aprobacion"?'selected="selected"':""; ?>>Fecha_aprobacion</option><option value="solicitudes.fecha_firma" <?php echo $searchBy=="solicitudes.fecha_firma"?'selected="selected"':""; ?>>Fecha de firma</option><option value="solicitudes.fecha__fondeo" <?php echo $searchBy=="solicitudes.fecha__fondeo"?'selected="selected"':""; ?>>Fecha de fondeo</option><option value="solicitudes.folio" <?php echo $searchBy=="solicitudes.folio"?'selected="selected"':""; ?>>Folio</option><option value="solicitudes.monto_solicitado" <?php echo $searchBy=="solicitudes.monto_solicitado"?'selected="selected"':""; ?>>Monto solicitado</option><option value="solicitudes.plazo_solicitado" <?php echo $searchBy=="solicitudes.plazo_solicitado"?'selected="selected"':""; ?>>Plazo solicitado</option><option value="solicitudes.interes_registro" <?php echo $searchBy=="solicitudes.interes_registro"?'selected="selected"':""; ?>>Interes_registro</option><option value="solicitudes.monto_aprobado" <?php echo $searchBy=="solicitudes.monto_aprobado"?'selected="selected"':""; ?>>Monto aprobado</option><option value="solicitudes.plazo_aprobado" <?php echo $searchBy=="solicitudes.plazo_aprobado"?'selected="selected"':""; ?>>Plazo_aprobado</option><option value="solicitudes.interes_aprobado" <?php echo $searchBy=="solicitudes.interes_aprobado"?'selected="selected"':""; ?>>Interés aprobado</option><option value="solicitudes.monto_fondeado" <?php echo $searchBy=="solicitudes.monto_fondeado"?'selected="selected"':""; ?>>Monto fondeado</option><option value="solicitudes.status" <?php echo $searchBy=="solicitudes.status"?'selected="selected"':""; ?>>Status</option>
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
                        <a class="btn btn-danger btn-rounded" href="{{{ url('/admin/solicitudes') }}}">
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

      </div>

      <div class="row">

        <!-- Inicia listado de registros -->
        <div class="col-sm-12" id="frmListado">

          <div class="panel panel-default">
            <div class="panel-heading">Listado de {{{ $config['titulo'] }}}
                <div class="panel-action">
                    <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Opciones <span class="caret"></span></a>
                      <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu">
                        <li role="presentation"><a href="{{ url('/admin/solicitudes/add') }}" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Nuevo registro</a></li>
                        <li class="divider" role="presentation"></li>

                        <li role="presentation"><a onclick="$('.buttons-copy').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Copiar lista</a></li>
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
                  <div class="table-responsive" id="table-content">

                    <table class="table display" >
                      <thead>
                        <tr>
                          <th># Solicitud</th>
              						<th>Cliente</th>
              						<th>Producto</th>
              						<th>Fecha de registro</th>
              						<th>Monto</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >
                          <td>
                            <?php if($value->renovacion == 1) { ?>  <span title="Renovacion de Credito"> <li class="fa fa-recycle fa-lg text-success"></li></span> <?php } ?>
                            {{{ $value->folio }}}
                          </td>
                          <th>{{{ $value->cteNombre }}} {{{ $value->ctePaterno }}} {{{ $value->cteMaterno }}}</th>
                          <th>{{{ $value->producto }}}</th>
                          <td>{{{ $value->fecha_captura }}}</td>
                          <td>$ {{{ number_format($value->monto_solicitado,2,".",",") }}}</td>
		                      <td>
                            <?php if($value->exp_aprobado == 1) { ?>
                              <a href="<?php echo url("/"); ?>/admin/expediente_digital/documentos/<?php echo $value->id; ?>" title="Envar a Aprobacion" data-toggle="tooltip">
                                <i class="fa fa-check-circle fa-lg text-success m-r-10"></i>
                              </a>
                            <?php } else { ?>
                              <a href="<?php echo url("/"); ?>/admin/solicitudes/edit/<?php echo $value->id; ?>" title="Editar Solicitud" data-toggle="tooltip">
                                <i class="fa fa-edit fa-lg text-primary m-r-10"></i>
                              </a>

                              <a href="<?php echo url("/"); ?>/admin/expediente_digital/documentos/<?php echo $value->id; ?>" title="Cargar Expediente" data-toggle="tooltip">
                                <i class="fa fa-archive fa-lg text-primary m-r-10"></i>
                              </a>
                            <?php }  ?>
                           </td>
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


$('.table-responsive').on('show.bs.dropdown', function () {


   $('#table-content').css( "overflow-y", "visible" );
   $('#table-content').css( "height", $('#table-content').height() + 130 );

});

$('.table-responsive').on('hide.bs.dropdown', function () {
   $('#table-content').css( "overflow", "auto" );
   $('#table-content').css( "height", $('#table-content').height() - 130 );
})

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
