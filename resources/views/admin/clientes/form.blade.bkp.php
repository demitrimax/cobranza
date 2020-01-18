<style type="text/css">
      .map {
				width: 100%;
        height: 500px;
      }
</style>

<input type="hidden" id="renovacion" name="renovacion" value="{{{ $data->renovacion }}}" class="form-control"/>
<input type="hidden" id="solicitud_renueva_id" name="solicitud_renueva_id" value="{{{ $data->solicitud_renueva_id }}}" class="form-control"/>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Datos Generales del Cliente
		</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="row">
					<!-- Nombre Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="nombre" class="control-label"> Nombre </label>
					<input type="text" class="form-control" id="nombre" name="nombre"
					value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("nombre") }}</div>
					</div>
					</div>
					<!-- Nombre End -->

					<!-- Paterno Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="paterno" class="control-label"> Apellido paterno </label>
					<input type="text" class="form-control" id="paterno" name="paterno"
					value="{{{ isset($data->paterno ) ? $data->paterno  : old('paterno') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("paterno") }}</div>
					</div>
					</div>
					<!-- Paterno End -->

					<!-- Materno Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="materno" class="control-label">Apellido materno </label>
					<input type="text" class="form-control" id="materno" name="materno"
					value="{{{ isset($data->materno ) ? $data->materno  : old('materno') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("materno") }}</div>
					</div>
					</div>
					<!-- Materno End -->

					<!-- Nacimiento Start -->
					<div class="col-md-2" style="display:none">
					<div class="form-group">
					<label for="nacimiento" class="control-label">F. Nacimiento </label>
					<input type="text" class="form-control dates" id="nacimiento" name="nacimiento" style="background:#FFF;" readonly
					value="<?php echo date('d-m-Y',strtotime(date('Y-m-d')  . ' - 18 years' ))?>" maxlength="150">
					<div class="label label-danger">{{ $errors->first("nacimiento") }}</div>
					</div>
					</div>
					<!-- Nacimiento End -->

					<!-- Telefono Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="telefono" class="control-label">Teléfono </label>
					<input type="text" class="form-control" id="telefono" name="telefono"
					value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}" maxlength="10">
					<div class="label label-danger">{{ $errors->first("telefono") }}</div>
					</div>
					</div>
					<!-- Telefono End -->

					<!-- Celular Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="celular" class="control-label">Celular </label>
					<input type="text" class="form-control" id="celular" name="celular"
					value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}"  maxlength="10">
					<div class="label label-danger">{{ $errors->first("celular") }}</div>
					</div>
					</div>
					<!-- Celular End -->


					<!-- Celular Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="celular" class="control-label">T. Trabajo </label>
					<input type="text" class="form-control" id="trabajo" name="trabajo"
					value="{{{ isset($data->trabajo ) ? $data->trabajo  : old('trabajo') }}}"  maxlength="10">
					<div class="label label-danger">{{ $errors->first("trabajo") }}</div>
					</div>
					</div>
					<!-- Celular End -->

					<!-- Correo Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="correo" class="control-label">Correo </label>
					<input type="email" class="form-control" id="correo" name="correo"
					value="{{{ isset($data->correo ) ? $data->correo  : old('correo') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("correo") }}</div>
					</div>
					</div>
					<!-- Correo End -->

					<!-- Correo Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="correo" class="control-label">Donde Trabaja </label>
					<input type="email" class="form-control" id="trabaja" name="trabaja"
					value="{{{ isset($data->trabaja ) ? $data->trabaja  : old('trabaja') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("trabaja") }}</div>
					</div>
					</div>
					<!-- Correo End -->

					<!-- Correo Start -->
					<div class="col-md-4">
					<div class="form-group">
					<label for="correo" class="control-label">Ocupacion </label>
					<input type="email" class="form-control" id="ocupacion" name="ocupacion"
					value="{{{ isset($data->ocupacion ) ? $data->ocupacion  : old('ocupacion') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("correo") }}</div>
					</div>
					</div>
					<!-- Correo End -->
				</div>

				<div class="row">
					<!-- Calle Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="calle" class="control-label"> Domicilio </label>
					<input type="text" class="form-control" id="calle" name="calle"
					value="{{{ isset($data->calle ) ? $data->calle  : old('calle') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("calle") }}</div>
					</div>
					</div>
					<!-- Calle End -->

					<input type="hidden" class="form-control" id="latitud" name="latitud" value="{{{ isset($data->latitud ) ? $data->latitud  : old('latitud') }}}" maxlength="150">
					<input type="hidden" class="form-control" id="longitud" name="longitud" value="{{{ isset($data->longitud ) ? $data->longitud  : old('longitud') }}}" maxlength="150">
				</div>

				<div class="row">

					<div id="cteMap" class="map"></div>

				</div>

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Primera Referencia del Cliente
		</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="row">

					<!-- Nombre Start -->
					<div class="col-md-12">
						<div class="form-group">
						<label for="nombre" class="control-label"> Nombre </label>
						<input type="text" class="form-control" id="referencia1_nombre" name="referencia1_nombre"
						value="{{{ isset($data->referencia1_nombre ) ? $data->referencia1_nombre  : old('referencia1_nombre') }}}" maxlength="150">
						<div class="label label-danger">{{ $errors->first("referencia1_nombre") }}</div>
						</div>
					</div>
					<!-- Nombre End -->

					<!-- Paterno Start -->
					<div class="col-md-6">
						<div class="form-group">
						<label for="paterno" class="control-label"> Parentesco </label>
						<input type="text" class="form-control" id="referencia1_parentesco" name="referencia1_parentesco"
						value="{{{ isset($data->referencia1_parentesco ) ? $data->referencia1_parentesco  : old('referencia1_parentesco') }}}" maxlength="150">
						<div class="label label-danger">{{ $errors->first("referencia1_parentesco") }}</div>
						</div>
					</div>
					<!-- Paterno End -->

					<!-- Materno Start -->
					<div class="col-md-6">
					<div class="form-group">
					<label for="materno" class="control-label">Celular </label>
					<input type="text" class="form-control" id="referencia1_celular" name="referencia1_celular"
					value="{{{ isset($data->referencia1_celular ) ? $data->referencia1_celular  : old('referencia1_celular') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia1_celular") }}</div>
					</div>
					</div>
					<!-- Materno End -->

					<!-- Materno Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="materno" class="control-label">Domicilio </label>
					<input type="text" class="form-control" id="referencia1_domicilio" name="referencia1_domicilio"
					value="{{{ isset($data->referencia1_domicilio ) ? $data->referencia1_domicilio  : old('referencia1_domicilio') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia1_domicilio") }}</div>
					</div>
					</div>
					<!-- Materno End -->

					<input type="hidden" class="form-control" id="referencia1_latitud" name="referencia1_latitud" value="{{{ isset($data->latitud ) ? $data->latitud  : old('latitud') }}}" maxlength="150">
					<input type="hidden" class="form-control" id="referencia1_longitud" name="referencia1_longitud" value="{{{ isset($data->longitud ) ? $data->longitud  : old('longitud') }}}" maxlength="150">

				</div>

				<div class="row">

					<div id="ref1Map" class="map"></div>

				</div>

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Segunda Referencia del Cliente
		</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="row">

					<h3>Segunda Referencia</h3>
					<!-- Nombre Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="nombre" class="control-label"> Nombre </label>
					<input type="text" class="form-control" id="referencia2_nombre" name="referencia2_nombre"
					value="{{{ isset($data->referencia2_nombre ) ? $data->referencia2_nombre  : old('referencia2_nombre') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia2_nombre") }}</div>
					</div>
					</div>
					<!-- Nombre End -->

					<!-- Paterno Start -->
					<div class="col-md-6">
					<div class="form-group">
					<label for="paterno" class="control-label"> Parentesco </label>
					<input type="text" class="form-control" id="referencia2_parentesco" name="referencia2_parentesco"
					value="{{{ isset($data->referencia2_parentesco ) ? $data->referencia2_parentesco  : old('referencia2_parentesco') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia2_parentesco") }}</div>
					</div>
					</div>
					<!-- Paterno End -->


					<!-- Materno Start -->
					<div class="col-md-6">
					<div class="form-group">
					<label for="materno" class="control-label">Celular </label>
					<input type="text" class="form-control" id="referencia2_celular" name="referencia2_celular"
					value="{{{ isset($data->referencia2_celular ) ? $data->referencia2_celular  : old('referencia2_celular') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia2_celular") }}</div>
					</div>
					</div>
					<!-- Materno End -->

					<!-- Materno Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="materno" class="control-label">Domicilio </label>
					<input type="text" class="form-control" id="referencia2_domicilio" name="referencia2_domicilio"
					value="{{{ isset($data->referencia2_domicilio ) ? $data->referencia2_domicilio  : old('referencia2_domicilio') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia2_domicilio") }}</div>
					</div>
					</div>
					<!-- Materno End -->

					<input type="hidden" class="form-control" id="referencia2_latitud" name="referencia2_latitud" value="{{{ isset($data->referencia2_latitud ) ? $data->referencia2_latitud  : old('referencia2_latitud') }}}" maxlength="150">
					<input type="hidden" class="form-control" id="referencia2_longitud" name="referencia2_longitud" value="{{{ isset($data->referencia2_longitud ) ? $data->referencia2_longitud  : old('referencia2_longitud') }}}" maxlength="150">

				</div>

				<div class="row">

					<div id="ref2Map" class="map"></div>

				</div>

			</div>

		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Tercera Referencia del Cliente
		</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="row">

					<h3>Segunda Referencia</h3>
					<!-- Nombre Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="nombre" class="control-label"> Nombre </label>
					<input type="text" class="form-control" id="referencia3_nombre" name="referencia3_nombre"
					value="{{{ isset($data->referencia3_nombre ) ? $data->referencia3_nombre  : old('referencia3_nombre') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia2_nombre") }}</div>
					</div>
					</div>
					<!-- Nombre End -->

					<!-- Paterno Start -->
					<div class="col-md-6">
					<div class="form-group">
					<label for="paterno" class="control-label"> Parentesco </label>
					<input type="text" class="form-control" id="referencia3_parentesco" name="referencia3_parentesco"
					value="{{{ isset($data->referencia3_parentesco ) ? $data->referencia3_parentesco  : old('referencia3_parentesco') }}}" maxlength="150">
					</div>
					</div>
					<!-- Paterno End -->

					<!-- Materno Start -->
					<div class="col-md-6">
					<div class="form-group">
					<label for="materno" class="control-label">Celular </label>
					<input type="text" class="form-control" id="referencia3_celular" name="referencia3_celular"
					value="{{{ isset($data->referencia3_celular ) ? $data->referencia3_celular  : old('referencia3_celular') }}}" maxlength="150">
					</div>
					</div>
					<!-- Materno End -->

					<!-- Materno Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="materno" class="control-label">Domicilio </label>
					<input type="text" class="form-control" id="referencia3_domicilio" name="referencia3_domicilio"
					value="{{{ isset($data->referencia3_domicilio ) ? $data->referencia3_domicilio  : old('referencia3_domicilio') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("referencia2_domicilio") }}</div>
					</div>
					</div>
					<!-- Materno End -->

					<input type="hidden" class="form-control" id="referencia3_latitud" name="referencia3_latitud" value="{{{ isset($data->referencia3_latitud ) ? $data->referencia3_latitud  : old('referencia3_latitud') }}}" maxlength="150">
					<input type="hidden" class="form-control" id="referencia3_longitud" name="referencia3_longitud" value="{{{ isset($data->referencia3_longitud ) ? $data->referencia3_longitud  : old('referencia3_longitud') }}}" maxlength="150">

				</div>

				<div class="row">

					<div id="ref3Map" class="map"></div>

				</div>

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Aval del Cliente
		</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="row">

					<!-- Nombre Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="nombre" class="control-label"> Nombre </label>
					<input type="text" class="form-control" id="fiador_nombre" name="fiador_nombre"
					value="{{{ isset($data->nombre ) ? $data->fiador_nombre  : old('fiador_nombre') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("fiador_nombre") }}</div>
					</div>
					</div>
					<!-- Nombre End -->

					<!-- Materno Start -->
					<div class="col-md-6">
						<div class="form-group">
						<label for="materno" class="control-label">Telefono </label>
						<input type="text" class="form-control" id="fiador_telefono" name="fiador_telefono"
						value="{{{ isset($data->fiador_telefono ) ? $data->fiador_telefono  : old('fiador_telefono') }}}" maxlength="10">
						<div class="label label-danger">{{ $errors->first("fiador_telefono") }}</div>
						</div>
					</div>
					<!-- Materno End -->

					<!-- Materno Start -->
					<div class="col-md-6">
					<div class="form-group">
					<label for="materno" class="control-label">Celular </label>
					<input type="text" class="form-control" id="fiador_celular" name="fiador_celular"
					value="{{{ isset($data->fiador_celular ) ? $data->fiador_celular  : old('fiador_celular') }}}" maxlength="10">
					<div class="label label-danger">{{ $errors->first("fiador_celular") }}</div>
					</div>
					</div>
					<!-- Materno End -->

				</div>

				<div class="row">

					<!-- Calle Start -->
					<div class="col-md-12">
					<div class="form-group">
					<label for="calle" class="control-label"> Domicilio </label>
					<input type="text" class="form-control" id="fiador_calle" name="fiador_calle"
					value="{{{ isset($data->fiador_calle ) ? $data->fiador_calle  : old('fiador_calle') }}}" maxlength="150">
					<div class="label label-danger">{{ $errors->first("calle") }}</div>
					</div>
					</div>
					<!-- Calle End -->

					<input type="hidden" class="form-control" id="fiador_latitud" name="fiador_latitud" value="{{{ isset($data->fiador_latitud ) ? $data->fiador_latitud  : old('fiador_latitud') }}}" maxlength="150">
					<input type="hidden" class="form-control" id="fiador_longitud" name="fiador_longitud" value="{{{ isset($data->fiador_longitud ) ? $data->fiador_longitud  : old('fiador_longitud') }}}" maxlength="150">

				</div>

				<div class="row">

					<div id="avalMap" class="map"></div>

				</div>

			</div>

		</div>
	</div>
</div>

<script>

	$('#cliente_id').on('change',function(){

		if($(this).val() ==  -1) {

			$('#newCustomer').fadeIn();
			$('#customList').fadeOut();

		} else {

			$('#customList').fadeIn();
			$('#newCustomer').fadeOut();
			$('#cliente_id').selectpicker('refresh');

		}

	});

	$('#producto_id').on('change',function(){

		if($(this).val() != "") {

			$.ajax({
				url: "<?php echo url('admin/productos/ajax/'); ?>/" +  $(this).val(),
				dataType: 'json',
				contentType: "application/json; charset=utf-8",
				success: function(json) {

					if(json['error'] == 0) {

						$('#interes_registro').val(json['data'].tasa_actual);

					} else {

						//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
						swal({ title: "ERROR!!", text: json['msg'], type: "error"});

					}


				}

			});

		}

	});

	$('#monto_solicitado').on('change',function(){

		if($(this).val() != "") {

			var intereses = parseFloat($('#interes_registro').val());

			var monto = parseFloat($(this).val());

			if(isNaN(intereses)) { intereses = 0; }

			if(isNaN(monto)) { monto = 0; }

			var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

			var total = parseFloat(monto) + parseFloat(interesCalculo);

			$('#interesesSolicitado').html('$ ' + interesCalculo.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

			$('#montoSolicitado').html('$ ' + monto.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

			$('#totalPagar').html('$ ' + total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

			$('#pago_id').trigger('change');

		}

	});

	$('#pago_solicitado').on('change',function(){
		calculaPlazo();
	});

	function resetea() {

		$('#customList').fadeIn();
		$('#newCustomer').fadeOut();
		$('#cliente_id').val("");
		$('#cliente_id').selectpicker('refresh');

	}

	function calculaPlazo() {

		var monto 			= parseFloat($('#monto_solicitado').val());

		var pago 				= parseFloat($('#pago_solicitado').val());

		var intereses 	= parseFloat($('#interes_registro').val());

		if(isNaN(intereses)) { intereses = 0; }

		if(isNaN(monto)) { monto = 0; }

		if(isNaN(pago)) { pago = 0; }

		var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

		var total = parseFloat(monto) + parseFloat(interesCalculo);

		var plazo = total / pago;

		$('#interesesSolicitado').html('$ ' + interesCalculo.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		$('#plazo_solicitado').val(plazo.toFixed(0));

		$('#pagoRealizar').html(plazo.toFixed(0) + ' Semanas');

	}

	<?php if($data->cliente_id == -1)  { echo "$('#cliente_id').trigger('change');"; }?>

	<?php if($data->producto_id)  { echo "$('#producto_id').trigger('change');"; }?>

</script>

<script>

	function initMap() {

		var geocoder = new google.maps.Geocoder();
		var myLatLng = {lat: <?= (isset($data->latitud) ? $data->latitud : '19.432608')?>, lng: <?= (isset($data->longitud) ? $data->longitud : '-99.133209')?>};

		/* INICIAN FUNCIONES, MAPA DEL CLIENTE */
			var cteMap = new google.maps.Map(document.getElementById('cteMap'), {
					zoom: 11,
					center: myLatLng
				});


			var markerCte = new google.maps.Marker({
					position: myLatLng,
					map: cteMap,
					draggable: true,
					title: '!'
			});


			cteMap.addListener('click',function(event) {
				updateMarker(event.latLng);
				geocodeLatLngCte(event.latLng,cteMap)
			});

			google.maps.event.addListener(markerCte, "dragend", function(event) {
				updateMarkerCte(event.latLng);
				geocodeLatLngCte(event.latLng,cteMap)
			});

			$('#calle').change(codeAddressCte);

			function updateMarkerCte(pos) {

				$("#latitud").val(pos.lat);
				$("#longitud").val(pos.lng);
				markerCte.setPosition(pos);

			}

			function codeAddressCte() {
				var address = document.getElementById('calle').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						cteMap.setCenter(results[0].geometry.location);

						updateMarkerCte(cteMap.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			//geocoder
			function geocodeLatLngCte(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#calle').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}

		/* TERMINAN FUNCIONES, MAPA DEL CLIENTE */


		/* INICIA FUNCIONES, MAPA DE LA PRIMERA REFERENCIA DEL CLIENTE */
			var ref1Map = new google.maps.Map(document.getElementById('ref1Map'), {
					zoom: 11,
					center: myLatLng
				});

			var markerRef1 = new google.maps.Marker({
					position: myLatLng,
					map: ref1Map,
					draggable: true,
					title: 'Direccion de Referencia'
			});

			ref1Map.addListener('click',function(event) {
				updateMarkerRef1(event.latLng);
				codeAddressRef1(event.latLng,ref1Map)
			});

			google.maps.event.addListener(markerRef1, "dragend", function(event) {
				updateMarkerRef1(event.latLng);
				geocodeLatLngRef1(event.latLng,ref1Map)
			});


			$('#referencia1_domicilio').change(codeAddressRef1);

			function updateMarkerRef1(pos) {

				$("#referencia1_latitud").val(pos.lat);
				$("#referencia1_longitud").val(pos.lng);
				markerRef1.setPosition(pos);

			}

			function codeAddressRef1() {
				var address = document.getElementById('referencia1_domicilio').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						ref1Map.setCenter(results[0].geometry.location);

						updateMarkerRef1(ref1Map.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngRef1(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#referencia1_domicilio').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}
		/* TERMINAN FUNCIONES, MAPA DE LA PRIMERA REFERENCIA DEL CLIENTE */



		/* INICIA FUNCIONES, MAPA DE LA SEGUNDA REFERENCIA DEL CLIENTE */
			var ref2Map = new google.maps.Map(document.getElementById('ref2Map'), {
					zoom: 11,
					center: myLatLng
				});

			var markerRef2 = new google.maps.Marker({
					position: myLatLng,
					map: ref2Map,
					draggable: true,
					title: 'Direccion de Referencia'
			});

			ref2Map.addListener('click',function(event) {
				updateMarkerRef2(event.latLng);
				codeAddressRef2(event.latLng,ref2Map)
			});

			google.maps.event.addListener(markerRef2, "dragend", function(event) {
				updateMarkerRef2(event.latLng);
				geocodeLatLngRef2(event.latLng,ref2Map)
			});


			$('#referencia2_domicilio').change(codeAddressRef2);

			function updateMarkerRef2(pos) {

				$("#referencia2_latitud").val(pos.lat);
				$("#referencia2_longitud").val(pos.lng);
				markerRef2.setPosition(pos);

			}

			function codeAddressRef2() {
				var address = document.getElementById('referencia2_domicilio').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						ref2Map.setCenter(results[0].geometry.location);

						updateMarkerRef2(ref2Map.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngRef2(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#referencia2_domicilio').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}
		/* TERMINAN FUNCIONES, MAPA DE LA SEGUNDA REFERENCIA DEL CLIENTE */


		/* INICIA FUNCIONES, MAPA DE LA TERCERA REFERENCIA DEL CLIENTE */
			var ref3Map = new google.maps.Map(document.getElementById('ref3Map'), {
					zoom: 11,
					center: myLatLng
				});

			var markerRef3 = new google.maps.Marker({
					position: myLatLng,
					map: ref3Map,
					draggable: true,
					title: 'Direccion de Referencia'
			});

			ref3Map.addListener('click',function(event) {
				updateMarkerRef3(event.latLng);
				codeAddressRef3(event.latLng,ref2Map)
			});

			google.maps.event.addListener(markerRef3, "dragend", function(event) {
				updateMarkerRef3(event.latLng);
				geocodeLatLngRef3(event.latLng,ref3Map)
			});


			$('#referencia3_domicilio').change(codeAddressRef3);

			function updateMarkerRef3(pos) {

				$("#referencia3_latitud").val(pos.lat);
				$("#referencia3_longitud").val(pos.lng);
				markerRef3.setPosition(pos);

			}

			function codeAddressRef3() {
				var address = document.getElementById('referencia3_domicilio').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						ref3Map.setCenter(results[0].geometry.location);

						updateMarkerRef3(ref3Map.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngRef3(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#referencia3_domicilio').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}
		/* TERMINAN FUNCIONES, MAPA DE LA TERCERA REFERENCIA DEL CLIENTE */



		/* INICIA FUNCIONES, MAPA AVAL DEL CLIENTE */
			var avalMap = new google.maps.Map(document.getElementById('avalMap'), {
					zoom: 11,
					center: myLatLng
				});

			var markerAval = new google.maps.Marker({
					position: myLatLng,
					map: avalMap,
					draggable: true,
					title: 'Direccion del Aval'
			});

			avalMap.addListener('click',function(event) {
				updateMarkerAval(event.latLng);
				codeAddressAval(event.latLng,aval)
			});

			google.maps.event.addListener(markerAval, "dragend", function(event) {
				updateMarkerAval(event.latLng);
				geocodeLatLngAval(event.latLng,aval)
			});


			$('#fiador_calle').change(codeAddressAval);

			function updateMarkerAval(pos) {

				$("#fiador_latitud").val(pos.lat);
				$("#fiador_longitud").val(pos.lng);
				markerAval.setPosition(pos);

			}

			function codeAddressAval() {
				var address = document.getElementById('fiador_calle').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						avalMap.setCenter(results[0].geometry.location);

						updateMarkerAval(avalMap.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngAval(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#fiador_domicilio').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}
		/* TERMINAN FUNCIONES, MAPA AVAL DEL CLIENTE  */


	}

</script>

<script async defer

src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCv4GHAnI4evPz2WDIBoJ8YnEYU7DAyIPU&callback=initMap">
>
//src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh-DyIKaeKNKao-NPWwCtWWoKibYfrBSI&callback=initMap"
</script>
