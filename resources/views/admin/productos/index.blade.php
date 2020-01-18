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
              <a href="{{ url('/admin/productos/add') }}" class="btn btn-info ">
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

                    <table class="table" id="table-content">
                      <thead>
                        <tr>
                          <th>Descripcion</th>
              						<th>Tasa de Interes</th>
              						<th>Tasa_actual</th>
              						<th>Monto a Otorgar</th>
              						<th>Plazo</td>
                          <th>Pago</td>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >
                          <td> {{{ $value->descripcion }}} </td>
                          <td> {{{ round($value->tasa_minima,2) }}} -> {{{ $value->tasa_maxima }}} </td>
                          <td> $ {{{ number_format($value->credito_maximo,2,".",",") }}} -> $ {{{ number_format($value->credito_minimo,2,".",",") }}} </td>
                          <td>  {{{ $value->plazo_maximo }}} Semanas ->  {{{ $value->plazo_minimo }}} </td>
                          <td>
                            <?php
                              if($value->tipo_cobro == 1) {
                                echo 'Monto Fijo de $ ' . number_format($value->valor_cobro,2,".",",");
                              } elseif($value->tipo_cobro == 2) {
                                echo round($value->valor_cobro,2) . '% del credito';
                              } else {
                                echo '<span class="text-danger"> NO ASIGNADO </span>';
                              }
                            ?>
                          </td>

                          <td>
                             <a href="<?php echo url("/"); ?>/admin/productos/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
                              <i class="fa fa-edit fa-lg text-info m-r-10"></i>
                             </a>
                             <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/productos/edit/<?php echo $value->id; ?>" data-title="Eliminar productos" style="border:0px; background:none">
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
                         <option value="productos.descripcion" <?php echo $searchBy=="productos.descripcion"?'selected="selected"':""; ?>>Descripcion</option><option value="productos.tasa_minima" <?php echo $searchBy=="productos.tasa_minima"?'selected="selected"':""; ?>>Tasa_minima</option><option value="productos.tasa_maxima" <?php echo $searchBy=="productos.tasa_maxima"?'selected="selected"':""; ?>>Tasa_maxima</option><option value="productos.tasa_actual" <?php echo $searchBy=="productos.tasa_actual"?'selected="selected"':""; ?>>Tasa_actual</option><option value="productos.credito_maximo" <?php echo $searchBy=="productos.credito_maximo"?'selected="selected"':""; ?>>Credito_maximo</option><option value="productos.credito_minimo" <?php echo $searchBy=="productos.credito_minimo"?'selected="selected"':""; ?>>Credito_minimo</option><option value="productos.plazo_maximo" <?php echo $searchBy=="productos.plazo_maximo"?'selected="selected"':""; ?>>Plazo_maximo</option><option value="productos.plazo_minimo" <?php echo $searchBy=="productos.plazo_minimo"?'selected="selected"':""; ?>>Plazo_minimo</option><option value="productos.status" <?php echo $searchBy=="productos.status"?'selected="selected"':""; ?>>Status</option>
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
