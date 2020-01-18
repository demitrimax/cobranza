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
        <form action="<?php echo url('/'); ?>/admin/pagos/cancel" id="formValidation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="col-sm-12">

            <div class="white-box">


                <div class="pull-right">
                  <button type="button" onclick="onSubmit();" class="btn btn-danger">
                    <i class="fa fa-save fa-2x"></i><br/>Cancelar
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>

          <div class="col-md-12">

            <div class="col-md-12">
            	<div class="panel panel-default">
            		<div class="panel-heading">Buscar Credito</div>
            		<div class="panel-wrapper collapse in" aria-expanded="true">
            			<div class="panel-body">
            					<!-- Credito_id Start -->
            					<div class="col-md-4">
            				    <div class="form-group">
            				        <label for="credito_id" class="control-label"> Nro de Credito </label>
            								<input type="text" class="form-control" id="credito" value="">
            				     </div>
            				  </div>
            				  <!-- Credito_id End -->

            					<!-- Credito_id Start -->
            					<div class="col-md-8">
            				    <div class="form-group">
            				        <label for="credito_id" class="control-label"> Cliente </label>
            								<div class="input-group">
            									<span class="input-group-addon">A. Paterno</span>
                            	<input type="text" id="paterno" class="form-control">
            									<span class="input-group-addon">A. Materno</span>
                            	<input type="text" id="materno" class="form-control">
            									<span class="input-group-addon">Nombre (s)</span>
                            	<input type="text" id="nombre" class="form-control">
            								</div>
            				     </div>
            				  </div>
            				  <!-- Credito_id End -->
            			</div>
            			<div class="panel-footer">
            				<div class="row text-right">
            					<button type="button" class="btn btn-info" id="buscar">
            						<span class="btn-label"> <i class="fa fa-search fa-lg"></i> </span>
            						Buscar Credito </button>
            				</div>
            			</div>
            		</div>
            	</div>
            </div>

            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">Buscar Credito</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row" id="htmlPagos">
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>

        </form>
    </div>

  </div>
</div>

<div class="modal fade" id="searchResult" tabindex="10" role="dialog" aria-labelledby="modalFondeoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFondeoLabel">Rechazar Prospecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row" id="table_select">
              </div>

            </div>
        </div>
    </div>
</div>

<script>

$('#buscar').on('click',function(){

  var parametros = '?credito_id=' + $('#credito').val();

  parametros += '&nombre=' + $('#nombre').val();

  parametros += '&paterno=' + $('#paterno').val();

  parametros += '&materno=' + $('#materno').val();

  $.ajax({
    url: "<?php echo url('admin/pagos/buscar/'); ?>" +  parametros,
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {

      if(json['multiple'] == 1) {

        //Traemos mas de un resultado, presentamos la lista
        $('#table_select').html(json['html']);

        $('#searchResult').modal({

          backdrop: 'static',

          keyboard: false,

          focus: true
        });

        $('.display').DataTable();

      } else {

        //Hay un unico registro, lo presentamos
        $('#htmlPagos').html(json['html']);

      }

    }

  });

})

function seleccionar(id) {

  var parametros = '?credito_id=' + id;

  parametros += '&nombre=';

  parametros += '&paterno=';

  parametros += '&materno=';

  $.ajax({
    url: "<?php echo url('admin/pagos/buscar/'); ?>" +  parametros,
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {

      //Hay un unico registro, lo presentamos
      $('#htmlPagos').html(json['html']);
      $('#searchResult').modal("toggle");
    }

  });

}

function onSubmit() {

  var checkeados = 0;

  $('.radios').each(function(){

    if($(this).is(':checked')) {
      checkeados++;
      return;
    }

  });

  if(checkeados> 0) {
    $('#formValidation').submit();
  } else {
    swal({
        title: "¡ ATENCION !",
        text: "Debe de seleccionar al menos 1 registro de pago para continuar",
        type: "warning"});
  }

}
</script>

@endsection
