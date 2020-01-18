<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">Voucher o comprobante</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Voucher Start -->
				<div class="col-md-12">
					<div class="form-group">
						<input type="file" name="voucher" class="dropify" />
						<input type="hidden" name="old_voucher" value="<?php if (isset($voucher) && $voucher!=""){echo $voucher; } ?>" />
							<?php if(isset($voucher_err) && !empty($voucher_err))
							{ foreach($voucher_err as $key => $error)
							{ echo "<div class=\"error-msg\"></div>"; } }?>
						<div class="label label-danger">{{ $errors->first("voucher") }}</div>
					</div>
				</div>
				<!-- Voucher End -->


			</div>

		</div>
	</div>
</div>

<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">Información del pago</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Credito_id Start -->
				<div class="col-md-6">
					<div class="form-group">
							<label for="credito_id" class="control-label"> Fondeadores </label>
							<select id="fondeador_id" name="fondeador_id" class="form-control select2">
								<option value="">--- Seleccione ---</option>
								<?php foreach ($fondeadores as $value) { ?>
									<option value="<?php echo $value->id; ?>"><?php echo $value->nombre . ' ' . $value->paterno . ' ' . $value->materno ; ?></option>
								<?php } ?>
							</select>
					 </div>
				</div>
				<!-- Credito_id End -->

				<!-- Credito_id Start -->
				<div class="col-md-6">
					<div class="form-group">
							<label for="credito_id" class="control-label"> Cliente </label>
							<select id="cliente_id" name="cliente_id" class="form-control select2">
								<option value="">--- Seleccione ---</option>
							</select>
					 </div>
				</div>
				<!-- Credito_id End -->

				<!-- Credito_id Start -->
				<div class="col-md-6">
					<div class="form-group">
							<label for="credito_id" class="control-label"> Creditos Activos </label>
							<select id="credito_id" name="credito_id" class="form-control select2">
							</select>
							<div class="label label-danger">{{ $errors->first("credito_id") }}</div>
					 </div>
				</div>
				<!-- Credito_id End -->


				<!-- Fecha_pago Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="fecha_pago" class="control-label"> Fecha de pago </label>
						<input type="text" class="form-control dates" id="fecha_pago" name="fecha_pago"
						value="{{{ isset($data->fecha_pago ) ? $data->fecha_pago  : old('fecha_pago') }}}">
				 </div>
				</div>
				<!-- Fecha_pago End -->

				<!-- Monto Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="monto" class="control-label"> Monto </label>
						<input type="text" class="form-control" id="monto" name="monto"
						value="{{{ isset($data->monto ) ? $data->monto  : old('monto') }}}">
						<div class="label label-danger">{{ $errors->first("monto") }}</div>
				 </div>
				</div>
				<!-- Monto End -->
				<!-- Recargos Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="monto" class="control-label"> Recargos </label>
						<input type="text" class="form-control" id="recargos" name="recargos"
						value="{{{ isset($data->recargos ) ? $data->recargos  : old('recargos') }}}">
						<div class="label label-danger">{{ $errors->first("recargos") }}</div>
				 </div>
				</div>
				<!-- Monto End -->
				<div class="col-md-12 alert alert-warning" id="message-error"></div>

			</div>

		</div>
	</div>
</div>
<script>
$('#message-error').empty().hide();
$('#fondeador_id').on('change',function(){
	$('#message-error').empty().hide();
	$.ajax({
		url: "<?php echo url('admin/creditos/byFondeador/'); ?>/" +  $(this).val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

				$('#cliente_id').html(json['html']);

					<?php if($data->producto_id) { echo "$('#producto_id').val(" . $data->producto_id . "); $('#producto_id').trigger('change');"; }?>

			} else {

				//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
				swal({ title: "ERROR!!", text: json['msg'], type: "error"});

			}


		}

	});

});

$('#cliente_id').on('change',function(){
	$('#message-error').empty().hide();
	$.ajax({
		url: "<?php echo url('admin/creditos/byCliente/'); ?>/" +  $(this).val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

				$('#credito_id').html(json['html']);

					<?php if($data->producto_id) { echo "$('#producto_id').val(" . $data->producto_id . "); $('#producto_id').trigger('change');"; }?>

			} else {

				//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
				swal({ title: "ERROR!!", text: json['msg'], type: "error"});

			}


		}

	});

});

$('#credito_id').on('change',function(){
	$('#message-error').empty().hide();
	$.ajax({
		url: "<?php echo url('admin/creditos/atrasados/'); ?>/" +  $(this).val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {
			console.log(json);
			if(json.error == 0) {
				$('#recargos').val(json.recargos);
				if(json.vencidas.length > 0){
					//$('#message-error').append('<p>Tiene ' + json.vencidas.length +' pagos vencidos</p>').show();
				}
				if(json.recargos == null){
					$('#message-error').append('<p>Este crédito no tiene configurado ningún recargo</p>').show();
				}
			} else {

				//No se encontraron datos, mandamos mensaje de error y apagamos el boton de guardar
				swal({ title: "ERROR!!", text: 'Ocurrió un error, no fue encontrado el crédito', type: "error"});

			}


		}

	});
});
</script>
