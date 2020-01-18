<input type="hidden" class="form-control" id="status" name="status" value="1">

	<!-- Descripcion Start -->
	<div class="col-md-12">
	 <div class="form-group">
	  <label for="descripcion" class="control-label"> Descripcion </label>
	    <input type="text" class="form-control" id="descripcion" name="descripcion"
	    value="{{{ isset($data->descripcion ) ? $data->descripcion  : old('descripcion') }}}">
	    <div class="label label-danger">{{ $errors->first("descripcion") }}</div>
   </div>
	</div>
	<!-- Descripcion End -->

	<!-- Tasa_minima Start -->
	<div class="col-md-4">
	 <div class="form-group">
	  <label for="tasa_minima" class="control-label">Tasa de Interes </label>
		<div class="input-group">
      <span class="input-group-addon">Minima: </span>
      <input type="text" class="form-control" id="tasa_minima" name="tasa_minima" value="{{{ isset($data->tasa_minima ) ? $data->tasa_minima  : old('tasa_minima') }}}">
      <span class="input-group-addon">Maxima: </span>
      <input type="text" class="form-control" id="tasa_maxima" name="tasa_maxima" value="{{{ isset($data->tasa_maxima ) ? $data->tasa_maxima  : old('tasa_maxima') }}}">
    </div>
	  <div class="label label-danger">{{ $errors->first("tasa_minima") }}</div>
   </div>
	</div>
	<!-- Tasa_minima End -->

	<!-- Tasa_actual Start -->
	<div class="col-md-4">
	 <div class="form-group">
	  <label for="tasa_actual" class="control-label"> Tasa actual vigente </label>
	    <input type="text" class="form-control" id="tasa_actual" name="tasa_actual" value="{{{ isset($data->tasa_actual ) ? $data->tasa_actual  : old('tasa_actual') }}}">
	    <div class="label label-danger">{{ $errors->first("tasa_actual") }}</div>
   </div>
	</div>
	<!-- Tasa_actual End -->

	<!-- Credito_maximo Start -->
	<div class="col-md-4">
	 <div class="form-group">
	  <label for="credito_maximo" class="control-label"> Monto de Credito a Otorgar </label>
		<div class="input-group">
      <span class="input-group-addon">Minimo: </span>
			<input type="text" class="form-control" id="credito_minimo" name="credito_minimo" value="{{{ isset($data->credito_minimo ) ? $data->credito_minimo  : old('credito_minimo') }}}">
      <span class="input-group-addon">Maximo: </span>
			<input type="text" class="form-control" id="credito_maximo" name="credito_maximo" value="{{{ isset($data->credito_maximo ) ? $data->credito_maximo  : old('credito_maximo') }}}">
    </div>
	  <div class="label label-danger">{{ $errors->first("credito_maximo") }}</div>
   </div>
	</div>
	<!-- Credito_maximo End -->

	<!-- Plazo_maximo Start -->
	<div class="col-md-6">
	 <div class="form-group">
	  <label for="plazo_maximo" class="control-label"> Plazo o periodo del credito </label>
		<div class="input-group">
      <span class="input-group-addon">Minimo: </span>
			<input type="text" class="form-control" id="plazo_minimo" name="plazo_minimo" value="{{{ isset($data->plazo_minimo ) ? $data->plazo_minimo  : old('plazo_minimo') }}}">
      <span class="input-group-addon">Maximo: </span>
			<input type="text" class="form-control" id="plazo_maximo" name="plazo_maximo" value="{{{ isset($data->plazo_maximo ) ? $data->plazo_maximo  : old('plazo_maximo') }}}">
    </div>
	  <div class="label label-danger">{{ $errors->first("plazo_maximo") }}</div>
   </div>
	</div>
	<!-- Plazo_maximo End -->


	<!-- Plazo_maximo Start -->
	<div class="col-md-6">
	 <div class="form-group">
		<label for="plazo_maximo" class="control-label"> Cobro de Credito </label>
		<div class="input-group">
			<span class="input-group-addon">Minimo: </span>
			<select class="form-control" id="tipo_cobro" name="tipo_cobro">
				<option value="1" <?php if($data->tipo_cobro == 1) { echo 'selected'; } ?>>Monto Fijo</option>
				<option value="2" <?php if($data->tipo_cobro == 2) { echo 'selected'; } ?>>Porcentaje</option>
			</select>
			<span class="input-group-addon">Maximo: </span>
			<input type="text" class="form-control" id="valor_cobro" name="valor_cobro" value="{{{ isset($data->valor_cobro ) ? $data->valor_cobro  : old('valor_cobro') }}}">
		</div>
		<div class="label label-danger">{{ $errors->first("plazo_maximo") }}</div>
	 </div>
	</div>
	<!-- Plazo_maximo End -->
