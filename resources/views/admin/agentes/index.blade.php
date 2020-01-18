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
              <a href="{{ url('/admin/agentes/add') }}" class="btn btn-info ">
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
                          <th>Supervisor</th>
                          <th>Agente</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr>
                          <td>
                          {{{ $value->supervisor }}}
                          </td>
                          <td>
                          {{{ $value->nombre }}}
                          </td>
                          <td>
                             <a href="<?php echo url("/"); ?>/admin/agentes/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
                              <i class="fa fa-edit fa-lg text-info m-r-10"></i>
                             </a>
                             <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/agentes/baja/<?php echo $value->id; ?>" data-title="Eliminar agentes" style="border:0px; background:none">
                             <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
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
                         <option value="asesores.nombre" <?php echo $searchBy=="asesores.nombre"?'selected="selected"':""; ?>>Asesor_id</option><option value="agentes.nombre" <?php echo $searchBy=="agentes.nombre"?'selected="selected"':""; ?>>Nombre</option><option value="agentes.status" <?php echo $searchBy=="agentes.status"?'selected="selected"':""; ?>>Status</option>
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
