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

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Información del Credito</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">


				<!-- Fecha_pago Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="fecha_pago" class="col-md-3 control-label"> Cliente </label>
					<div class="col-md-9 text-left" id="cliente"></div>
				 </div>
				</div>
				<!-- Fecha_pago End -->

				<p><br/><br/></p>

				<!-- Fecha_pago Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="fecha_pago" class="col-md-6 control-label"> Fecha Dispisición </label>
					<div class="col-md-6" id="dispisicion"></div>
				 </div>
				</div>
				<!-- Fecha_pago End -->

				<!-- Monto_pago Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="monto_pago" class="col-md-6 control-label"> Monto Otorgado </label>
					<div class="col-md-6" id="monto"></div>
				 </div>
				</div>
				<!-- Monto_pago End -->

				<p><br/><br/></p>

				<!-- Monto_pago Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="monto_pago" class="col-md-6 control-label"> Saldo Actual </label>
					<div class="col-md-6" id="saldo"></div>
				 </div>
				</div>
				<!-- Monto_pago End -->

				<p><br/><br/></p>

				<!-- Monto_pago Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="monto_pago" class="control-label"> Cuotas </label>
					<div class="input-group">
						<span class="input-group-addon">Pagadas</span>
						<input type="text"  id="pagadas" class="form-control" readonly style="background:#FFF">
						<span class="input-group-addon">Pendientes</span>
						<input type="text"  id="pendientes" class="form-control" readonly style="background:#FFF">
						<span class="input-group-addon">Vencidas</span>
						<input type="text"  id="vencidas" class="form-control" readonly style="background:#FFF">
					</div>
				 </div>
				</div>
				<!-- Monto_pago End -->

			</div>

		</div>
	</div>
</div>

<div class="col-md-6">
	<form action="<?php echo url('/'); ?>/admin/pagos/add" id="formValidation" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="panel panel-default">
			<div class="panel-heading">Aplicar Pago</div>
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">

					<input type="hidden" class="form-control" value="" id="credito_id" name="credito_id" value=""/>
					<!-- Fecha_pago Start -->
					<div class="col-md-12">
					 <div class="form-group">
						<label for="fecha_pago" class="control-label"> Fecha del Pago </label>
							<input type="text" class="form-control dates" id="fecha_pago" name="fecha_pago"
							value="{{{ isset($data->fecha_pago ) ? $data->fecha_pago  : old('fecha_pago') }}}">
							<div class="label label-danger">{{ $errors->first("fecha_pago") }}</div>
					 </div>
					</div>
					<!-- Fecha_pago End -->

					<!-- Monto_pago Start -->
					<div class="col-md-12">
					 <div class="form-group">
						<label for="monto_pago" class="control-label"> Monto a Aplicar </label>
							<input type="text" class="form-control" id="monto_pago" name="monto_pago"
							value="{{{ isset($data->monto_pago ) ? $data->monto_pago  : old('monto_pago') }}}">
							<div class="label label-danger">{{ $errors->first("monto_pago") }}</div>
					 </div>
					</div>
					<!-- Monto_pago End -->

				</div>
				<div class="panel-footer">
					<div class="row text-right">
						<button type="submit" class="btn btn-info">
							<span class="btn-label"> <i class="fa fa-save fa-lg"></i> </span>
							Aplicar </button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="searchResult" tabindex="10" role="dialog" aria-labelledby="modalFondeoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFondeoLabel">Seleccionar Credito</h5>
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

<input type="hidden" class="form-control" id="status" name="status" value="1">

<script>

$('#buscar').on('click',function(){

	var parametros = '?credito_id=' + $('#credito').val();

	parametros += '&nombre=' + $('#nombre').val();

	parametros += '&paterno=' + $('#paterno').val();

	parametros += '&materno=' + $('#materno').val();

	$.ajax({
		url: "<?php echo url('admin/creditos/buscar/'); ?>" +  parametros,
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
				$('#cliente').html( json['data'].nombre + ' ' + json['data'].paterno + ' ' + json['data'].materno );

				$('#dispisicion').html( json['data'].inicio);

				$('#monto').html( json['data'].monto_fondeado );

				$('#saldo').html( json['data'].actual);

				$('#credito_id').val( json['data'].id);

			}

		}

	});

})

function seleccionar(id) {

	$.ajax({
		url: "<?php echo url('admin/creditos/seleccion'); ?>/" +  id,
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

				//Hay un unico registro, lo presentamos
				$('#cliente').html( json['data'].nombre + ' ' + json['data'].paterno + ' ' + json['data'].materno );

				$('#dispisicion').html( json['data'].inicio);

				$('#monto').html( json['data'].monto_fondeado );

				$('#saldo').html( json['data'].actual);

				$('#credito_id').val( json['data'].id);

				$('#searchResult').modal('hide');

			} else {
				swal({ title: "ERROR!!", text: json['msg'], type: "error"});
			}

		}

	});

}
</script>
