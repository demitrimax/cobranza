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
              <a href="{{ url('/admin/prospectos/add') }}" class="btn btn-info ">
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
                          <th>R. Registro</th>
                          <th>Producto</th>
                          <th>Plazo</th>
                          <th>Monto</th>
              						<th>Prospecto</th>
              						<th>Celular</th>
              						<th>P. Semanal</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr id="hide<?php $value->id; ?>" >

                          <td>
                          {{{ $value->fecha_alta }}}
                          </td>
                          <td>
                          {{{ $value->producto }}}
                          </td>

                          <td>
                          {{{ $value->plazo_id }}} Semanas
                          </td>

                          <td>
                          {{{ number_format($value->monto,2,".",",") }}}
                          </td>

                          <td>
                          {{{ $value->nombre }}} {{{ $value->paterno }}} {{{ $value->materno }}}
                          </td>

                          <td>
                          {{{ $value->celular }}}
                          </td>

                          <td>
                          {{{ number_format($value->pago_semanal,2,".",",") }}}
                          </td>

                           <td>
                             <?php if($value->status == 1 ) { ?>
                               <a href="<?php echo url("/"); ?>/admin/prospectos/edit/<?php echo $value->id; ?>" title="Editar Prospecto" data-toggle="tooltip">
                                <i class="fa fa-edit fa-lg text-info m-r-10"></i>
                               </a>

                               <a href="<?php echo url("/"); ?>/admin/solicitudes/add/?prospecto_id=<?php echo $value->id; ?>" title="Crear Solicitud" data-toggle="tooltip">
                                <i class="fa fa-file-pdf-o fa-lg text-success m-r-10"></i>
                               </a>
                               <a href="javascript:cancelar(<?php echo $value->id;?>);" title="Rechazar Prospecto" data-toggle="tooltip">
                                <i class="fa fa-times fa-lg text-danger m-r-10"></i>
                               </a>
                             <?php } else { ?>
                               <a href="<?php echo url("/"); ?>/admin/prospectos/view/<?php echo $value->id; ?>" title="Ver Prospecto" data-toggle="tooltip">
                                <i class="fa fa-search fa-lg text-info m-r-10"></i>
                               </a>
                             <?php } ?>

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
                         <option value="productos.descripcion" <?php echo $searchBy=="productos.descripcion"?'selected="selected"':""; ?>>Producto_id</option><option value="plazos.plazo" <?php echo $searchBy=="plazos.plazo"?'selected="selected"':""; ?>>Plazo_id</option><option value="asesores.nombre" <?php echo $searchBy=="asesores.nombre"?'selected="selected"':""; ?>>Asesor_id</option><option value="prospectos.monto" <?php echo $searchBy=="prospectos.monto"?'selected="selected"':""; ?>>Monto</option><option value="prospectos.nombre" <?php echo $searchBy=="prospectos.nombre"?'selected="selected"':""; ?>>Nombre</option><option value="prospectos.paterno" <?php echo $searchBy=="prospectos.paterno"?'selected="selected"':""; ?>>Paterno</option><option value="prospectos.materno" <?php echo $searchBy=="prospectos.materno"?'selected="selected"':""; ?>>Materno</option><option value="prospectos.telefono" <?php echo $searchBy=="prospectos.telefono"?'selected="selected"':""; ?>>Telefono</option><option value="prospectos.celular" <?php echo $searchBy=="prospectos.celular"?'selected="selected"':""; ?>>Celular</option><option value="prospectos.email" <?php echo $searchBy=="prospectos.email"?'selected="selected"':""; ?>>Email</option><option value="prospectos.pago_semanal" <?php echo $searchBy=="prospectos.pago_semanal"?'selected="selected"':""; ?>>Pago_semanal</option><option value="prospectos.ingresos_mensuales" <?php echo $searchBy=="prospectos.ingresos_mensuales"?'selected="selected"':""; ?>>Ingresos_mensuales</option><option value="prospectos.gastos_mensuales" <?php echo $searchBy=="prospectos.gastos_mensuales"?'selected="selected"':""; ?>>Gastos_mensuales</option><option value="prospectos.msr_rechazo" <?php echo $searchBy=="prospectos.msr_rechazo"?'selected="selected"':""; ?>>Msr_rechazo</option><option value="prospectos.fecha_alta" <?php echo $searchBy=="prospectos.fecha_alta"?'selected="selected"':""; ?>>Fecha_alta</option><option value="prospectos.fecha_rechazo" <?php echo $searchBy=="prospectos.fecha_rechazo"?'selected="selected"':""; ?>>Fecha_rechazo</option><option value="prospectos.status" <?php echo $searchBy=="prospectos.status"?'selected="selected"':""; ?>>Status</option>
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

<div class="modal fade" id="modalRechaza" tabindex="10" role="dialog" aria-labelledby="modalFondeoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFondeoLabel">Rechazar Prospecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <input type="hidden" id="rechazaId" class="form-control" value=""/>
              <div class="row" id="contentRechazo">
                <div class="form-group">
      				      <label for="msg_rechazo" class="control-label"> ¿ Desea anexar un comentario por rechazo ? </label>
      							<textarea class="form-control" name="msg_rechazo" id="msg_rechazo" rows="5"></textarea>
      				   </div>

              </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar
                </button>

                <button type="button" class="btn btn-success btn-rounded" id="btnRechaza" onclick="enviar()">
                  <span class="btn-label"><i class="fa fa-check fa-lg"></i></span>Confirmar Rechazo
                </button>

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

function cancelar(id){

  swal({
      title: "¿ Rechazar Prospecto ?",
      text: "¿Esta seguro, realmente desea realizar esta operación?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#fb9678',
      confirmButtonText: "SI",
      cancelButtonText: "No",
      closeOnConfirm: true,
      closeOnCancel: true
  }, function(isConfirm){
      if (isConfirm) {

        $('#rechazaId').val(id);

        $('#status').val(3);
        $('#btnRechaza').fadeIn();
        $('#contentRechazo').fadeIn();
        $('#contenPsico').fadeOut();

        $('#modalRechaza').modal({

          backdrop: 'static',

          keyboard: false,

          focus: true
        });

      }

  });

}

function enviar() {

  if($('#rechazaId').val() != "") {

    location = "{{{ url('admin/prospectos/rechaza') }}}/" + $('#rechazaId').val() + '?msg=' + $('#msg_rechazo').val();

  } else {

      swal({ title: 'ERROR!!', text: 'Se ha producido un error inesperado, por favor consulte a su administrador de sistemas', type: 'error'});

  }

}


</script>


@endsection
