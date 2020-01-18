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
              <a href="{{ url('/admin/clientes/add') }}" class="btn btn-info ">
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
                          <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?><td>Nombre</td>
						<td>Paterno</td>
						<td>Materno</td>
						<td>Nacimiento</td>
						<td>Telefono</td>
						<td>Celular</td>
						<td>Trabajo</td>
						<td>Correo</td>
						<td>Calle</td>
						<td>Colonia</td>
						<td>Ciudad</td>
						<td>Estado</td>
						<td>Cp</td>
						<td>Ocupacion</td>
						<td>Trabaja</td>
						<td>Ingreso_mensual</td>
						<td>Ingreso_extra</td>
						<td>Gasto_mensual</td>
						<td>Fiador_nombre</td>
						<td>Fiador_telefono</td>
						<td>Fiador_celular</td>
						<td>Fiador_trabajo</td>
						<td>Fiador_calle</td>
						<td>Fiador_colonia</td>
						<td>Fiador_ciudad</td>
						<td>Fiador_estado</td>
						<td>Fiador_cp</td>
						<td>Fiador_latitud</td>
						<td>Fiador_longitud</td>
						<td>Referencia1_nombre</td>
						<td>Referencia1_parentesco</td>
						<td>Referencia1_celular</td>
						<td>Referencia1_domicilio</td>
						<td>Referencia1_latitud</td>
						<td>Referencia1_longitud</td>
						<td>Referencia2_nombre</td>
						<td>Referencia2_parentesco</td>
						<td>Referencia2_celular</td>
						<td>Referencia2_domicilio</td>
						<td>Referencia2_latitud</td>
						<td>Referencia2_longitud</td>
						<td>Referencia3_nombre</td>
						<td>Referencia3_parentesco</td>
						<td>Referencia3_celular</td>
						<td>Referencia3_domicilio</td>
						<td>Referencia3_latitud</td>
						<td>Referencia3_longitud</td>
						<td>Latitud</td>
						<td>Longitud</td>
						<td>Status</td>
						
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >
                          
            <th>
            {{{ $value->nombre }}}
            </th>
                
            <th>
            {{{ $value->paterno }}}
            </th>
                
            <th>
            {{{ $value->materno }}}
            </th>
                
            <th>
            {{{ $value->nacimiento }}}
            </th>
                
            <th>
            {{{ $value->telefono }}}
            </th>
                
            <th>
            {{{ $value->celular }}}
            </th>
                
            <th>
            {{{ $value->trabajo }}}
            </th>
                
            <th>
            {{{ $value->correo }}}
            </th>
                
            <th>
            {{{ $value->calle }}}
            </th>
                
            <th>
            {{{ $value->colonia }}}
            </th>
                
            <th>
            {{{ $value->ciudad }}}
            </th>
                
            <th>
            {{{ $value->estado }}}
            </th>
                
            <th>
            {{{ $value->cp }}}
            </th>
                
            <th>
            {{{ $value->ocupacion }}}
            </th>
                
            <th>
            {{{ $value->trabaja }}}
            </th>
                
            <th>
            {{{ $value->ingreso_mensual }}}
            </th>
                
            <th>
            {{{ $value->ingreso_extra }}}
            </th>
                
            <th>
            {{{ $value->gasto_mensual }}}
            </th>
                
            <th>
            {{{ $value->fiador_nombre }}}
            </th>
                
            <th>
            {{{ $value->fiador_telefono }}}
            </th>
                
            <th>
            {{{ $value->fiador_celular }}}
            </th>
                
            <th>
            {{{ $value->fiador_trabajo }}}
            </th>
                
            <th>
            {{{ $value->fiador_calle }}}
            </th>
                
            <th>
            {{{ $value->fiador_colonia }}}
            </th>
                
            <th>
            {{{ $value->fiador_ciudad }}}
            </th>
                
            <th>
            {{{ $value->fiador_estado }}}
            </th>
                
            <th>
            {{{ $value->fiador_cp }}}
            </th>
                
            <th>
            {{{ $value->fiador_latitud }}}
            </th>
                
            <th>
            {{{ $value->fiador_longitud }}}
            </th>
                
            <th>
            {{{ $value->referencia1_nombre }}}
            </th>
                
            <th>
            {{{ $value->referencia1_parentesco }}}
            </th>
                
            <th>
            {{{ $value->referencia1_celular }}}
            </th>
                
            <th>
            {{{ $value->referencia1_domicilio }}}
            </th>
                
            <th>
            {{{ $value->referencia1_latitud }}}
            </th>
                
            <th>
            {{{ $value->referencia1_longitud }}}
            </th>
                
            <th>
            {{{ $value->referencia2_nombre }}}
            </th>
                
            <th>
            {{{ $value->referencia2_parentesco }}}
            </th>
                
            <th>
            {{{ $value->referencia2_celular }}}
            </th>
                
            <th>
            {{{ $value->referencia2_domicilio }}}
            </th>
                
            <th>
            {{{ $value->referencia2_latitud }}}
            </th>
                
            <th>
            {{{ $value->referencia2_longitud }}}
            </th>
                
            <th>
            {{{ $value->referencia3_nombre }}}
            </th>
                
            <th>
            {{{ $value->referencia3_parentesco }}}
            </th>
                
            <th>
            {{{ $value->referencia3_celular }}}
            </th>
                
            <th>
            {{{ $value->referencia3_domicilio }}}
            </th>
                
            <th>
            {{{ $value->referencia3_latitud }}}
            </th>
                
            <th>
            {{{ $value->referencia3_longitud }}}
            </th>
                
            <th>
            {{{ $value->latitud }}}
            </th>
                
            <th>
            {{{ $value->longitud }}}
            </th>
                
            <th>
            {{{ $value->status }}}
            </th>
                 <td>
           <a href="<?php echo url("/"); ?>/admin/clientes/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
           </a>
           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/clientes/edit/<?php echo $value->id; ?>" data-title="Eliminar clientes" style="border:0px; background:none">
           <i class="fa fa-trash-alt fa-lg text-danger m-r-10"></i>
           </button>

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
                         <option value="clientes.nombre" <?php echo $searchBy=="clientes.nombre"?'selected="selected"':""; ?>>Nombre</option><option value="clientes.paterno" <?php echo $searchBy=="clientes.paterno"?'selected="selected"':""; ?>>Paterno</option><option value="clientes.materno" <?php echo $searchBy=="clientes.materno"?'selected="selected"':""; ?>>Materno</option><option value="clientes.nacimiento" <?php echo $searchBy=="clientes.nacimiento"?'selected="selected"':""; ?>>Nacimiento</option><option value="clientes.telefono" <?php echo $searchBy=="clientes.telefono"?'selected="selected"':""; ?>>Telefono</option><option value="clientes.celular" <?php echo $searchBy=="clientes.celular"?'selected="selected"':""; ?>>Celular</option><option value="clientes.trabajo" <?php echo $searchBy=="clientes.trabajo"?'selected="selected"':""; ?>>Trabajo</option><option value="clientes.correo" <?php echo $searchBy=="clientes.correo"?'selected="selected"':""; ?>>Correo</option><option value="clientes.calle" <?php echo $searchBy=="clientes.calle"?'selected="selected"':""; ?>>Calle</option><option value="clientes.colonia" <?php echo $searchBy=="clientes.colonia"?'selected="selected"':""; ?>>Colonia</option><option value="clientes.ciudad" <?php echo $searchBy=="clientes.ciudad"?'selected="selected"':""; ?>>Ciudad</option><option value="clientes.estado" <?php echo $searchBy=="clientes.estado"?'selected="selected"':""; ?>>Estado</option><option value="clientes.cp" <?php echo $searchBy=="clientes.cp"?'selected="selected"':""; ?>>Cp</option><option value="clientes.ocupacion" <?php echo $searchBy=="clientes.ocupacion"?'selected="selected"':""; ?>>Ocupacion</option><option value="clientes.trabaja" <?php echo $searchBy=="clientes.trabaja"?'selected="selected"':""; ?>>Trabaja</option><option value="clientes.ingreso_mensual" <?php echo $searchBy=="clientes.ingreso_mensual"?'selected="selected"':""; ?>>Ingreso_mensual</option><option value="clientes.ingreso_extra" <?php echo $searchBy=="clientes.ingreso_extra"?'selected="selected"':""; ?>>Ingreso_extra</option><option value="clientes.gasto_mensual" <?php echo $searchBy=="clientes.gasto_mensual"?'selected="selected"':""; ?>>Gasto_mensual</option><option value="clientes.fiador_nombre" <?php echo $searchBy=="clientes.fiador_nombre"?'selected="selected"':""; ?>>Fiador_nombre</option><option value="clientes.fiador_telefono" <?php echo $searchBy=="clientes.fiador_telefono"?'selected="selected"':""; ?>>Fiador_telefono</option><option value="clientes.fiador_celular" <?php echo $searchBy=="clientes.fiador_celular"?'selected="selected"':""; ?>>Fiador_celular</option><option value="clientes.fiador_trabajo" <?php echo $searchBy=="clientes.fiador_trabajo"?'selected="selected"':""; ?>>Fiador_trabajo</option><option value="clientes.fiador_calle" <?php echo $searchBy=="clientes.fiador_calle"?'selected="selected"':""; ?>>Fiador_calle</option><option value="clientes.fiador_colonia" <?php echo $searchBy=="clientes.fiador_colonia"?'selected="selected"':""; ?>>Fiador_colonia</option><option value="clientes.fiador_ciudad" <?php echo $searchBy=="clientes.fiador_ciudad"?'selected="selected"':""; ?>>Fiador_ciudad</option><option value="clientes.fiador_estado" <?php echo $searchBy=="clientes.fiador_estado"?'selected="selected"':""; ?>>Fiador_estado</option><option value="clientes.fiador_cp" <?php echo $searchBy=="clientes.fiador_cp"?'selected="selected"':""; ?>>Fiador_cp</option><option value="clientes.fiador_latitud" <?php echo $searchBy=="clientes.fiador_latitud"?'selected="selected"':""; ?>>Fiador_latitud</option><option value="clientes.fiador_longitud" <?php echo $searchBy=="clientes.fiador_longitud"?'selected="selected"':""; ?>>Fiador_longitud</option><option value="clientes.referencia1_nombre" <?php echo $searchBy=="clientes.referencia1_nombre"?'selected="selected"':""; ?>>Referencia1_nombre</option><option value="clientes.referencia1_parentesco" <?php echo $searchBy=="clientes.referencia1_parentesco"?'selected="selected"':""; ?>>Referencia1_parentesco</option><option value="clientes.referencia1_celular" <?php echo $searchBy=="clientes.referencia1_celular"?'selected="selected"':""; ?>>Referencia1_celular</option><option value="clientes.referencia1_domicilio" <?php echo $searchBy=="clientes.referencia1_domicilio"?'selected="selected"':""; ?>>Referencia1_domicilio</option><option value="clientes.referencia1_latitud" <?php echo $searchBy=="clientes.referencia1_latitud"?'selected="selected"':""; ?>>Referencia1_latitud</option><option value="clientes.referencia1_longitud" <?php echo $searchBy=="clientes.referencia1_longitud"?'selected="selected"':""; ?>>Referencia1_longitud</option><option value="clientes.referencia2_nombre" <?php echo $searchBy=="clientes.referencia2_nombre"?'selected="selected"':""; ?>>Referencia2_nombre</option><option value="clientes.referencia2_parentesco" <?php echo $searchBy=="clientes.referencia2_parentesco"?'selected="selected"':""; ?>>Referencia2_parentesco</option><option value="clientes.referencia2_celular" <?php echo $searchBy=="clientes.referencia2_celular"?'selected="selected"':""; ?>>Referencia2_celular</option><option value="clientes.referencia2_domicilio" <?php echo $searchBy=="clientes.referencia2_domicilio"?'selected="selected"':""; ?>>Referencia2_domicilio</option><option value="clientes.referencia2_latitud" <?php echo $searchBy=="clientes.referencia2_latitud"?'selected="selected"':""; ?>>Referencia2_latitud</option><option value="clientes.referencia2_longitud" <?php echo $searchBy=="clientes.referencia2_longitud"?'selected="selected"':""; ?>>Referencia2_longitud</option><option value="clientes.referencia3_nombre" <?php echo $searchBy=="clientes.referencia3_nombre"?'selected="selected"':""; ?>>Referencia3_nombre</option><option value="clientes.referencia3_parentesco" <?php echo $searchBy=="clientes.referencia3_parentesco"?'selected="selected"':""; ?>>Referencia3_parentesco</option><option value="clientes.referencia3_celular" <?php echo $searchBy=="clientes.referencia3_celular"?'selected="selected"':""; ?>>Referencia3_celular</option><option value="clientes.referencia3_domicilio" <?php echo $searchBy=="clientes.referencia3_domicilio"?'selected="selected"':""; ?>>Referencia3_domicilio</option><option value="clientes.referencia3_latitud" <?php echo $searchBy=="clientes.referencia3_latitud"?'selected="selected"':""; ?>>Referencia3_latitud</option><option value="clientes.referencia3_longitud" <?php echo $searchBy=="clientes.referencia3_longitud"?'selected="selected"':""; ?>>Referencia3_longitud</option><option value="clientes.latitud" <?php echo $searchBy=="clientes.latitud"?'selected="selected"':""; ?>>Latitud</option><option value="clientes.longitud" <?php echo $searchBy=="clientes.longitud"?'selected="selected"':""; ?>>Longitud</option><option value="clientes.status" <?php echo $searchBy=="clientes.status"?'selected="selected"':""; ?>>Status</option>
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
