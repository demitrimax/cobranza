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

        <!-- Aqui Inicia la  busquea -->
        <div class="col-sm-12" style="display:none" id="frmFiltro">

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
                           <option value="creditos.cliente_id" <?php echo $searchBy=="creditos.cliente_id"?'selected="selected"':""; ?>>Cliente</option><option value="creditos.solicitud_id" <?php echo $searchBy=="creditos.solicitud_id"?'selected="selected"':""; ?>>Solicitud</option><option value="creditos.folio" <?php echo $searchBy=="creditos.folio"?'selected="selected"':""; ?>>Folio</option><option value="creditos.plazo" <?php echo $searchBy=="creditos.plazo"?'selected="selected"':""; ?>>Plazo</option><option value="creditos.monto" <?php echo $searchBy=="creditos.monto"?'selected="selected"':""; ?>>Monto</option><option value="creditos.inicio" <?php echo $searchBy=="creditos.inicio"?'selected="selected"':""; ?>>Inicio</option><option value="creditos.termino" <?php echo $searchBy=="creditos.termino"?'selected="selected"':""; ?>>Término</option><option value="creditos.vencida" <?php echo $searchBy=="creditos.vencida"?'selected="selected"':""; ?>>Vencida</option><option value="creditos.dias_vencida" <?php echo $searchBy=="creditos.dias_vencida"?'selected="selected"':""; ?>>Dias vencida</option><option value="creditos.fech_ecv" <?php echo $searchBy=="creditos.fech_ecv"?'selected="selected"':""; ?>>Fech ecv</option><option value="creditos.status" <?php echo $searchBy=="creditos.status"?'selected="selected"':""; ?>>Status</option>
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
                        <a class="btn btn-danger btn-rounded" href="{{{ url('/admin/creditos') }}}">
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
                        <li role="presentation"><a href="{{ url('/admin/creditos/add') }}" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Nuevo registro</a></li>
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

                          <th>Folio</th>

              						<th>Cliente</th>

              						<th>Plazo</th>

              						<th>Monto</th>

              						<th>Inicio</th>

              						<th>Término</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >

                          <td>
                          # {{{ $value->id }}}
                          </td>
                          <td>
                          {{{ $value->nombre }}} {{{ $value->paterno }}} {{{ $value->materno }}}
                          </td>

                          <td>
                          {{{ $value->plazo }}} Semanas
                          </td>

                          <td>
                          $ {{{ number_format($value->monto_fondeado,2,".",",") }}}
                          </td>

                          <td>
                          <?php if($value->inicio) { echo $value->inicio; } else { echo 'Pendiente de Fondeo'; } ?>
                          </td>

                          <td>
                          <?php if($value->termino) { echo $value->termino; } else { echo 'Pendiente de Fondeo'; } ?>
                          </td>
		                      <th>
                            <a href="<?php echo url("/"); ?>/admin/creditos/view/<?php echo $value->id; ?>" title="Ver Informacion" data-toggle="tooltip">
                             <i class="fa fa-search fa-lg text-info m-r-10"></i>
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
