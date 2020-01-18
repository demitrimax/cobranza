

												<!-- Id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="id" class="control-label"> Id </label>
												    <input type="text" class="form-control" id="id" name="id"
												    value="{{{ isset($data->id ) ? $data->id  : old('id') }}}">
												    <div class="label label-danger">{{ $errors->first("id") }}</div>
											   </div>
												</div>
												<!-- Id End -->
												
												<!-- Solicitud_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="solicitud_id" class="control-label"> Solicitud_id </label>
												    <input type="text" class="form-control" id="solicitud_id" name="solicitud_id"
												    value="{{{ isset($data->solicitud_id ) ? $data->solicitud_id  : old('solicitud_id') }}}">
												    <div class="label label-danger">{{ $errors->first("solicitud_id") }}</div>
											   </div>
												</div>
												<!-- Solicitud_id End -->
												
												<!-- User_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="user_id" class="control-label"> User_id </label>
												    <input type="text" class="form-control" id="user_id" name="user_id"
												    value="{{{ isset($data->user_id ) ? $data->user_id  : old('user_id') }}}">
												    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
											   </div>
												</div>
												<!-- User_id End -->
												
												<!-- Fecha Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha" class="control-label"> Fecha </label>
												    <input type="text" class="form-control" id="fecha" name="fecha"
												    value="{{{ isset($data->fecha ) ? $data->fecha  : old('fecha') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha") }}</div>
											   </div>
												</div>
												<!-- Fecha End -->
												
												<!-- Cuenta_origen Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="cuenta_origen" class="control-label"> Cuenta_origen </label>
												    <input type="text" class="form-control" id="cuenta_origen" name="cuenta_origen"
												    value="{{{ isset($data->cuenta_origen ) ? $data->cuenta_origen  : old('cuenta_origen') }}}">
												    <div class="label label-danger">{{ $errors->first("cuenta_origen") }}</div>
											   </div>
												</div>
												<!-- Cuenta_origen End -->
												
												<!-- Cuenta_destino Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="cuenta_destino" class="control-label"> Cuenta_destino </label>
												    <input type="text" class="form-control" id="cuenta_destino" name="cuenta_destino"
												    value="{{{ isset($data->cuenta_destino ) ? $data->cuenta_destino  : old('cuenta_destino') }}}">
												    <div class="label label-danger">{{ $errors->first("cuenta_destino") }}</div>
											   </div>
												</div>
												<!-- Cuenta_destino End -->
												
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
												
												<!-- Observaciones Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="observaciones" class="control-label"> Observaciones </label>
												    <input type="text" class="form-control" id="observaciones" name="observaciones"
												    value="{{{ isset($data->observaciones ) ? $data->observaciones  : old('observaciones') }}}">
												    <div class="label label-danger">{{ $errors->first("observaciones") }}</div>
											   </div>
												</div>
												<!-- Observaciones End -->
												
												<!-- Status Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="status" class="control-label"> Status </label>
												    <input type="text" class="form-control" id="status" name="status"
												    value="{{{ isset($data->status ) ? $data->status  : old('status') }}}">
												    <div class="label label-danger">{{ $errors->first("status") }}</div>
											   </div>
												</div>
												<!-- Status End -->
												
