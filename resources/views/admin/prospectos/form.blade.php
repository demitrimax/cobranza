<input type="hidden" class="form-control" id="status" name="status" maxlength="10" value="1">

<div class="col-md-12">

	<div class="panel panel-default">
		<div class="panel-heading">
			Pertenencia de REgistro
		</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="clear">
					<p></p>
				</div>

				<!-- Monto_solicitado Start -->
				<div class="col-md-12" <?php if(Auth::user()->asesor_id != 0) { echo 'style="display:none"'; }?>>
				 <div class="form-group">
					 <label for="vendedor_id" class="control-label"> Asesor </label>
					 <select class="form-control" id="asesor_id" name="asesor_id">
						 <option value="">---Seleccione---</option>
						 <?php foreach($asesores as $value) { ?>
							 <option value="<?php echo $value->id; ?>" <?php if($data->asesor_id == $value->id) { echo 'selected'; } ?>> <?php echo $value->nombre . ' ' . $value->paterno . ' ' . $value->materno; ?> </option>
						 <?php } ?>
					 	</select>
				 </div>
				</div>
				<!-- Monto_solicitado End -->


				<div class="clear">
					<p><br/></p>
				</div>

			</div>

		</div>
	</div>

</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Credito a Adquirir</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Producto_id Start -->
				<div class="col-md-12">
				  <div class="form-group">
				      <label for="producto_id" class="control-label"> Producto </label>
				      <select id="producto_id" name="producto_id" class="form-control">
								<option value="">---Seleccione---</option>
								<?php foreach($productos as $value) { ?>
	 							 <option value="<?php echo $value->id; ?>" <?php if($data->producto_id == $value->id) { echo 'selected'; } ?>> <?php echo $value->descripcion; ?> </option>
	 						 <?php } ?>
				      </select>
							<input type="hidden" class="form-control" id="origen" name="origen" value="2">
				      <div class="label label-danger">{{ $errors->first("producto_id") }}</div>
				   </div>
				</div>
				<!-- Producto_id End -->

				<!-- Producto_id Start -->
				<div class="col-md-12">
				  <div class="form-group">
				      <label for="monto_id" class="control-label"> Monto de préstamo </label>
							<input type="text" class="form-control monedaOnly" id="monto" name="monto" maxlength="10" value="{{{ isset($data->monto ) ? $data->monto  : old('monto') }}}">
				   </div>

				</div>
				<!-- Producto_id End -->

				<!-- Plazo_id Start -->
				<div class="col-md-12">
				  <div class="form-group">
				      <label for="pago_id" class="control-label"> Pago semanal </label>
							<input type="text" class="form-control monedaOnly" id="pago_semanal" name="pago_semanal" maxlength="10" value="{{{ isset($data->pago_semanal ) ? $data->pago_semanal  : old('pago_semanal') }}}">
				   </div>

				</div>
				<!-- Plazo_id End -->


			</div>

		</div>
	</div>
</div>

<div class="col-md-6">

	<div class="panel panel-default">
		<div class="panel-heading">
			Detalles del crédito adquirido
		</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="clear">
					<p></p>
				</div>

				<!-- Producto_id Start -->
				<div class="col-md-12">
				  <div class="form-group">
				    <h2 class="col-md-6"> Monto solicitado </h2>
						<h2 class="col-md-6" id="montoSolicitado" class="text-right text-info">
							 $ {{{ isset($data->monto_solicitado) ? number_format($data->monto_solicitado,2,".",",") : "000.00"}}}
						 </h2>
				   </div>
				</div>
				<!-- Producto_id End -->

				<!-- Monto_solicitado Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <h2 class="col-md-6"> Intereses </h2>
 					<h2 class="col-md-6" id="interesesSolicitado" class="text-right text-warning">
						$	000.00
					</h2>
					<input type="hidden" class="form-control" id="interes_registro" name="interes_registro"
					value="{{{ isset($data->interes_registro ) ? round($data->interes_registro,2)  : old('interes_registro') }}}">
				 </div>
				</div>
				<!-- Monto_solicitado End -->

				<!-- Plazo_solicitado Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <h2 class="col-md-6"> Total a pagar </h2>
 					<h2 class="col-md-6" id="totalPagar" class="text-center text-success"> $ 000.00 </h2>
				 </div>
				</div>
				<!-- Plazo_solicitado End -->

				<!-- Plazo_solicitado Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <h2 class="col-md-6"> Plazo del crédito </h2>
 					<h2 class="col-md-6" id="pagoRealizar" class="text-center text-success"> <?php echo round($data->plazo_id,2); ?> Semanas</h2>
					<input type="hidden" id="plazo_id" name="plazo_id" value="{{{ isset($data->plazo_id) ? $data->plazo_id  : old('plazo_id') }}}">
				 </div>
				</div>
				<!-- Plazo_solicitado End -->

				<div class="clear">
					<p><br/></p>
				</div>

			</div>

		</div>
	</div>

</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Información del solicitante</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Nombre Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="nombre" class="control-label"> Nombre </label>
				    <input type="text" class="form-control" id="nombre" name="nombre"
				    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
				    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
				 </div>
				</div>
				<!-- Nombre End -->

				<!-- Paterno Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="paterno" class="control-label"> Apellido paterno </label>
				    <input type="text" class="form-control" id="paterno" name="paterno"
				    value="{{{ isset($data->paterno ) ? $data->paterno  : old('paterno') }}}">
				    <div class="label label-danger">{{ $errors->first("paterno") }}</div>
				 </div>
				</div>
				<!-- Paterno End -->

				<!-- Materno Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="materno" class="control-label"> Apellido materno </label>
				    <input type="text" class="form-control" id="materno" name="materno"
				    value="{{{ isset($data->materno ) ? $data->materno  : old('materno') }}}">
				    <div class="label label-danger">{{ $errors->first("materno") }}</div>
				 </div>
				</div>
				<!-- Materno End -->

				<!-- Telefono Start -->
				<div class="col-md-3">
				 <div class="form-group">
				  <label for="telefono" class="control-label"> Teléfono </label>
				    <input type="text" class="form-control" id="telefono" name="telefono"
				    value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}">
				    <div class="label label-danger">{{ $errors->first("telefono") }}</div>
				 </div>
				</div>
				<!-- Telefono End -->

				<!-- Celular Start -->
				<div class="col-md-3">
				 <div class="form-group">
				  <label for="celular" class="control-label"> Celular </label>
				    <input type="text" class="form-control" id="celular" name="celular"
				    value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
				    <div class="label label-danger">{{ $errors->first("celular") }}</div>
				 </div>
				</div>
				<!-- Celular End -->

				<!-- Email Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="email" class="control-label"> Correo elctrónico </label>
				    <input type="text" class="form-control" id="email" name="email"
				    value="{{{ isset($data->email ) ? $data->email  : old('email') }}}">
				    <div class="label label-danger">{{ $errors->first("email") }}</div>
				 </div>
				</div>
				<!-- Email End -->

				<!-- Ingreo_mensual Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="email" class="control-label"> Ingreso mensual bruto </label>
				    <input type="text" class="form-control" id="ingresos_mensuales" name="ingresos_mensuales"
				    value="{{{ isset($data->ingresos_mensuales ) ? $data->ingresos_mensuales  : old('ingresos_mensuales') }}}">
				    <div class="label label-danger">{{ $errors->first("ingreo_mensual") }}</div>
				 </div>
				</div>
				<!-- Ingreo_mensual End -->

				<!-- Gasto_mensual Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="email" class="control-label"> Gasto mensual bruto </label>
				    <input type="text" class="form-control" id="gastos_mensuales" name="gastos_mensuales"
				    value="{{{ isset($data->gastos_mensuales ) ? $data->gastos_mensuales  : old('gastos_mensuales') }}}">
				    <div class="label label-danger">{{ $errors->first("gasto_mensual") }}</div>
				 </div>
				</div>
				<!-- Gasto_mensual End -->

			</div>
		</div>
	</div>
</div>

<script>

$('#producto_id').on('change',function(){

	if($(this).val() != "") {

		$.ajax({
			url: "<?php echo url('admin/productos/ajax/'); ?>/" +  $(this).val(),
			dataType: 'json',
			contentType: "application/json; charset=utf-8",
			success: function(json) {

				if(json['error'] == 0) {

					$('#interes_registro').val(json['data'].tasa_actual);

					<?php if($data->monto) { echo "$('#monto').trigger('change');"; }?>

					<?php if($data->pago_semanal) { echo "$('#pago_semanal').trigger('change');"; }?>

				} else {

					//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
					swal({ title: "ERROR!!", text: json['msg'], type: "error"});

				}


			}

		});

	}

});

$('#monto').on('change',function(){

	if($(this).val() != "") {

		var intereses = parseFloat($('#interes_registro').val());

		var monto = parseFloat($(this).val());

		if(isNaN(intereses)) { intereses = 0; }

		if(isNaN(monto)) { monto = 0; }

		var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

		var total = parseFloat(monto) + parseFloat(interesCalculo);

		$('#interesesSolicitado').html('$ ' + interesCalculo.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		$('#montoSolicitado').html('$ ' + monto.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		$('#totalPagar').html('$ ' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		if($('#pago_id').val() != "") {

			$('#pago_id').trigger('change');

		}

	}

});

$('#pago_semanal').on('change',function(){
	calculaPlazo();
});

function ocultame(tipo) {

	if(tipo == 1){

		$('#montoSelects').fadeIn();
		$('#montoInputs').fadeOut();

	} else {

		$('#pagosSelects').fadeIn();
		$('#pagosInputs').fadeOut();

	}
}

function calculaPlazo() {


	var monto = parseFloat($('#monto').val());

	var pago = parseFloat($('#pago_semanal').val());

	var intereses = parseFloat($('#interes_registro').val());

	if(isNaN(pago)) {

		return false;
	}

	if(isNaN(monto)) {

		return false;
	}

	if(isNaN(intereses)) {

		return false;
	}

	var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

	var total = parseFloat(monto) + parseFloat(interesCalculo);

	var plazo = total / pago;

	$('#plazo_id').val(plazo.toFixed(0));

	$('#pagoRealizar').html(plazo.toFixed(0) + ' Semanas');

}

<?php if($data->producto_id) { echo "$('#producto_id').trigger('change');"; }?>

</script>
