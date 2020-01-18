

												<!-- Cliente_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="cliente_id" class="control-label"> Cliente </label>
												    <input type="text" class="form-control" id="cliente_id" name="cliente_id"
												    value="{{{ isset($data->cliente_id ) ? $data->cliente_id  : old('cliente_id') }}}">
												    <div class="label label-danger">{{ $errors->first("cliente_id") }}</div>
											   </div>
												</div>
												<!-- Cliente_id End -->

												<!-- Solicitud_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="solicitud_id" class="control-label"> Solicitud </label>
												    <input type="text" class="form-control" id="solicitud_id" name="solicitud_id"
												    value="{{{ isset($data->solicitud_id ) ? $data->solicitud_id  : old('solicitud_id') }}}">
												    <div class="label label-danger">{{ $errors->first("solicitud_id") }}</div>
											   </div>
												</div>
												<!-- Solicitud_id End -->

												<!-- Folio Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="folio" class="control-label"> Folio </label>
												    <input type="text" class="form-control" id="folio" name="folio"
												    value="{{{ isset($data->folio ) ? $data->folio  : old('folio') }}}">
												    <div class="label label-danger">{{ $errors->first("folio") }}</div>
											   </div>
												</div>
												<!-- Folio End -->

												<!-- Plazo Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="plazo" class="control-label"> Plazo </label>
												    <input type="text" class="form-control" id="plazo" name="plazo"
												    value="{{{ isset($data->plazo ) ? $data->plazo  : old('plazo') }}}">
												    <div class="label label-danger">{{ $errors->first("plazo") }}</div>
											   </div>
												</div>
												<!-- Plazo End -->

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

												<!-- Inicio Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="inicio" class="control-label"> Inicio </label>
												    <input type="text" class="form-control" id="inicio" name="inicio"
												    value="{{{ isset($data->inicio ) ? $data->inicio  : old('inicio') }}}">
												    <div class="label label-danger">{{ $errors->first("inicio") }}</div>
											   </div>
												</div>
												<!-- Inicio End -->

												<!-- Termino Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="termino" class="control-label"> Término </label>
												    <input type="text" class="form-control" id="termino" name="termino"
												    value="{{{ isset($data->termino ) ? $data->termino  : old('termino') }}}">
												    <div class="label label-danger">{{ $errors->first("termino") }}</div>
											   </div>
												</div>
												<!-- Termino End -->

												<!-- Vencida Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="vencida" class="control-label"> Vencida </label>
												    <input type="text" class="form-control" id="vencida" name="vencida"
												    value="{{{ isset($data->vencida ) ? $data->vencida  : old('vencida') }}}">
												    <div class="label label-danger">{{ $errors->first("vencida") }}</div>
											   </div>
												</div>
												<!-- Vencida End -->

												<!-- Dias_vencida Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="dias_vencida" class="control-label"> Días vencida </label>
												    <input type="text" class="form-control" id="dias_vencida" name="dias_vencida"
												    value="{{{ isset($data->dias_vencida ) ? $data->dias_vencida  : old('dias_vencida') }}}">
												    <div class="label label-danger">{{ $errors->first("dias_vencida") }}</div>
											   </div>
												</div>
												<!-- Dias_vencida End -->

												<!-- Fech_ecv Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fech_ecv" class="control-label"> Fech ecv </label>
												    <input type="text" class="form-control" id="fech_ecv" name="fech_ecv"
												    value="{{{ isset($data->fech_ecv ) ? $data->fech_ecv  : old('fech_ecv') }}}">
												    <div class="label label-danger">{{ $errors->first("fech_ecv") }}</div>
											   </div>
												</div>
												<!-- Fech_ecv End -->

												<!-- Status Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="status" class="control-label"> Estatus </label>
												    <input type="text" class="form-control" id="status" name="status"
												    value="{{{ isset($data->status ) ? $data->status  : old('status') }}}">
												    <div class="label label-danger">{{ $errors->first("status") }}</div>
											   </div>
												</div>
												<!-- Status End -->
