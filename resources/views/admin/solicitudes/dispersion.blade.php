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
              <a href="{{ url('/admin/solicitudes/add') }}" class="btn btn-info ">
                <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>

                <button class="btn btn-default" data-toggle="modal" title="Imprimir Listado" data-target="#modalSearch">
                  <i class="fa fa-search fa-2x"></i><br/>Buscar
                </button>
            </div>

            <div class="pull-right">
              <button onclick="$('.buttons-copy').trigger('click');" class="btn btn-warning" title="Copiar resultados de lista">
                <i class="fa fa-copy fa-2x"></i><br/>Copiar
              </button>

              <button onclick="$('.buttons-print').trigger('click');" class="btn btn-primary" title="Imprimir Listado">
                <i class="fa fa-copy fa-2x"></i><br/>Imprimir
              </button>

              <button onclick="$('.buttons-excel').trigger('click');" class="btn btn-success" title="Exportar listado a Excel">
                <i class="fa fa-copy fa-2x"></i><br/>E. Excel
              </button>

              <button onclick="$('.buttons-pdf').trigger('click');" class="btn btn-danger" title="Exportar listado a PDF">
                <i class="fa fa-copy fa-2x"></i><br/>E. PDF
              </button>
            </div>

            <div class="clear"></div>

          </div>

        </div>
        <!-- Terminan botones de Accion -->

        <!-- Inicia listado de registros -->
        <div class="col-sm-12" id="frmListado">

          <div class="panel panel-default">
            <div class="panel-heading">Listado de Registros</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="table-responsive">

                    <table class="table display" id="table-content">
                      <thead>
                        <tr>
                          <th># Solicitud</th>
              						<th>Cliente</th>
              						<th>Producto</th>
              						<th>Fecha de registro</th>
              						<th>Monto</th>
									        <th>Plazo</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <?php if($value->status == 1) { ?>
                          <tr>
                            <td>
                              <?php if($value->renovacion == 1) { ?>  <span title="Renovacion de Credito"> <li class="fa fa-recycle fa-lg text-success"></li></span> <?php } ?> # {{{ $value->id }}}
                            </td>
                            <th> {{{ $value->cteNombre }}} {{{ $value->ctePaterno }}} {{{ $value->cteMaterno }}}</th>
                            <th>{{{ $value->producto }}}</th>
                            <td>{{{ $value->fecha_captura }}}</td>
                            <td>$ {{{ number_format($value->monto_solicitado,2,".",",") }}}</td>
  						              <td>{{{ $value->plazo_solicitado }}} Semanas</td>
                            <td>

                             <a href="<?php echo url("/"); ?>/admin/solicitudes/dispersion/<?php echo $value->id; ?>" title="Dispersar Recursos" data-toggle="tooltip">
                              <i class="fa fa-credit-card fa-lg text-info m-r-10"></i>
                             </a>

                            </td>
                          </tr>
                        <?php } ?>
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

<div class="modal fade" id="modalSearch" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Filtrar Resultados </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <form method="GET" action="" class="" id="frmSearch">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="participante_id" class="control-label"> Buscar por: </label>
                        <select name="searchBy" class="form-control selectpicker">
                         <option value="solicitudes.etap_flujo" <?php echo $searchBy=="solicitudes.etap_flujo"?'selected="selected"':""; ?>>Etap_flujo</option><option value="clientes.nombre" <?php echo $searchBy=="clientes.nombre"?'selected="selected"':""; ?>>Cliente_id</option><option value="solicitudes.prospecto_id" <?php echo $searchBy=="solicitudes.prospecto_id"?'selected="selected"':""; ?>>Prospecto_id</option><option value="productos.descripcion" <?php echo $searchBy=="productos.descripcion"?'selected="selected"':""; ?>>Producto_id</option><option value="users.name" <?php echo $searchBy=="users.name"?'selected="selected"':""; ?>>Captura_id</option><option value="users.name" <?php echo $searchBy=="users.name"?'selected="selected"':""; ?>>Aprueba_id</option><option value="asesores.nombre" <?php echo $searchBy=="asesores.nombre"?'selected="selected"':""; ?>>Asesor_id</option><option value="solicitudes.solicitud_renueva_id" <?php echo $searchBy=="solicitudes.solicitud_renueva_id"?'selected="selected"':""; ?>>Solicitud_renueva_id</option><option value="solicitudes.renovacion" <?php echo $searchBy=="solicitudes.renovacion"?'selected="selected"':""; ?>>Renovacion</option><option value="solicitudes.fecha_captura" <?php echo $searchBy=="solicitudes.fecha_captura"?'selected="selected"':""; ?>>Fecha_captura</option><option value="solicitudes.fecha_aprobacion" <?php echo $searchBy=="solicitudes.fecha_aprobacion"?'selected="selected"':""; ?>>Fecha_aprobacion</option><option value="solicitudes.fecha_firma" <?php echo $searchBy=="solicitudes.fecha_firma"?'selected="selected"':""; ?>>Fecha_firma</option><option value="solicitudes.fecha__fondeo" <?php echo $searchBy=="solicitudes.fecha__fondeo"?'selected="selected"':""; ?>>Fecha__fondeo</option><option value="solicitudes.folio" <?php echo $searchBy=="solicitudes.folio"?'selected="selected"':""; ?>>Folio</option><option value="solicitudes.monto_solicitado" <?php echo $searchBy=="solicitudes.monto_solicitado"?'selected="selected"':""; ?>>Monto_solicitado</option><option value="solicitudes.plazo_solicitado" <?php echo $searchBy=="solicitudes.plazo_solicitado"?'selected="selected"':""; ?>>Plazo_solicitado</option><option value="solicitudes.pago_solicitado" <?php echo $searchBy=="solicitudes.pago_solicitado"?'selected="selected"':""; ?>>Pago_solicitado</option><option value="solicitudes.interes_registro" <?php echo $searchBy=="solicitudes.interes_registro"?'selected="selected"':""; ?>>Interes_registro</option><option value="solicitudes.monto_aprobado" <?php echo $searchBy=="solicitudes.monto_aprobado"?'selected="selected"':""; ?>>Monto_aprobado</option><option value="solicitudes.plazo_aprobado" <?php echo $searchBy=="solicitudes.plazo_aprobado"?'selected="selected"':""; ?>>Plazo_aprobado</option><option value="solicitudes.pago_aprobado" <?php echo $searchBy=="solicitudes.pago_aprobado"?'selected="selected"':""; ?>>Pago_aprobado</option><option value="solicitudes.interes_aprobado" <?php echo $searchBy=="solicitudes.interes_aprobado"?'selected="selected"':""; ?>>Interes_aprobado</option><option value="solicitudes.monto_fondeado" <?php echo $searchBy=="solicitudes.monto_fondeado"?'selected="selected"':""; ?>>Monto_fondeado</option><option value="solicitudes.exp_aprobado" <?php echo $searchBy=="solicitudes.exp_aprobado"?'selected="selected"':""; ?>>Exp_aprobado</option><option value="solicitudes.msg_aprobacion" <?php echo $searchBy=="solicitudes.msg_aprobacion"?'selected="selected"':""; ?>>Msg_aprobacion</option><option value="solicitudes.msg_rechazo" <?php echo $searchBy=="solicitudes.msg_rechazo"?'selected="selected"':""; ?>>Msg_rechazo</option><option value="solicitudes.fecha_extaprueba" <?php echo $searchBy=="solicitudes.fecha_extaprueba"?'selected="selected"':""; ?>>Fecha_extaprueba</option><option value="users.name" <?php echo $searchBy=="users.name"?'selected="selected"':""; ?>>User_aprueba</option><option value="solicitudes.autorizado" <?php echo $searchBy=="solicitudes.autorizado"?'selected="selected"':""; ?>>Autorizado</option><option value="solicitudes.exp_completo" <?php echo $searchBy=="solicitudes.exp_completo"?'selected="selected"':""; ?>>Exp_completo</option><option value="solicitudes.firmado" <?php echo $searchBy=="solicitudes.firmado"?'selected="selected"':""; ?>>Firmado</option><option value="solicitudes.fondeado" <?php echo $searchBy=="solicitudes.fondeado"?'selected="selected"':""; ?>>Fondeado</option><option value="solicitudes.ctto_firmado" <?php echo $searchBy=="solicitudes.ctto_firmado"?'selected="selected"':""; ?>>Ctto_firmado</option><option value="solicitudes.contratos" <?php echo $searchBy=="solicitudes.contratos"?'selected="selected"':""; ?>>Contratos</option><option value="solicitudes.contratos_firmados" <?php echo $searchBy=="solicitudes.contratos_firmados"?'selected="selected"':""; ?>>Contratos_firmados</option><option value="solicitudes.pagares_firmados" <?php echo $searchBy=="solicitudes.pagares_firmados"?'selected="selected"':""; ?>>Pagares_firmados</option><option value="solicitudes.aprivacidad_cliente" <?php echo $searchBy=="solicitudes.aprivacidad_cliente"?'selected="selected"':""; ?>>Aprivacidad_cliente</option><option value="solicitudes.aprivacidad_aval" <?php echo $searchBy=="solicitudes.aprivacidad_aval"?'selected="selected"':""; ?>>Aprivacidad_aval</option><option value="solicitudes.status" <?php echo $searchBy=="solicitudes.status"?'selected="selected"':""; ?>>Status</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="participante_id" class="control-label"> Informacion a Buscar: </label>
                        <input type="text" name="searchValue" id="searchValue" class="form-control" value="<?php echo $searchValue; ?>">
                     </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="participante_id" class="control-label"> Ver: </label>
                        <select name="per_page" class="form-control selectpicker" onchange="this.form.submit()">
                          <option value="20" <?php echo $per_page=="25"?'selected="selected"':""; ?>>25 Registros</option>
                          <option value="50" <?php echo $per_page=="50"?'selected="selected"':""; ?>>50 Registros</option>
                          <option value="100" <?php echo $per_page=="100"?'selected="selected"':""; ?>>100 Registros</option>
                        </select>
                     </div>

                  </div>

                  <div class="col-md-12 text-right">
                    <button  class="btn btn-default" title="Imprimir Listado" onclick="$('#frmSearch').submit();">
                      <i class="fa fa-search fa-2x"></i><br/>Aplicar
                    </button>
                  </div>

                </div>

              </form>


            </div>
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
