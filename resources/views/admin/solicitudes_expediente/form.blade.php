

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
												
												<!-- Documento_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="documento_id" class="control-label"> Documento_id </label>
												    <input type="text" class="form-control" id="documento_id" name="documento_id"
												    value="{{{ isset($data->documento_id ) ? $data->documento_id  : old('documento_id') }}}">
												    <div class="label label-danger">{{ $errors->first("documento_id") }}</div>
											   </div>
												</div>
												<!-- Documento_id End -->
												
												<!-- Carga_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="carga_id" class="control-label"> Carga_id </label>
												    <input type="text" class="form-control" id="carga_id" name="carga_id"
												    value="{{{ isset($data->carga_id ) ? $data->carga_id  : old('carga_id') }}}">
												    <div class="label label-danger">{{ $errors->first("carga_id") }}</div>
											   </div>
												</div>
												<!-- Carga_id End -->
												
												<!-- Valida_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="valida_id" class="control-label"> Valida_id </label>
												    <input type="text" class="form-control" id="valida_id" name="valida_id"
												    value="{{{ isset($data->valida_id ) ? $data->valida_id  : old('valida_id') }}}">
												    <div class="label label-danger">{{ $errors->first("valida_id") }}</div>
											   </div>
												</div>
												<!-- Valida_id End -->
												
												<!-- Aprobado Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="aprobado" class="control-label"> Aprobado </label>
												    <input type="text" class="form-control" id="aprobado" name="aprobado"
												    value="{{{ isset($data->aprobado ) ? $data->aprobado  : old('aprobado') }}}">
												    <div class="label label-danger">{{ $errors->first("aprobado") }}</div>
											   </div>
												</div>
												<!-- Aprobado End -->
												
												<!-- Fecha_carga Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_carga" class="control-label"> Fecha_carga </label>
												    <input type="text" class="form-control" id="fecha_carga" name="fecha_carga"
												    value="{{{ isset($data->fecha_carga ) ? $data->fecha_carga  : old('fecha_carga') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_carga") }}</div>
											   </div>
												</div>
												<!-- Fecha_carga End -->
												
												<!-- Fecha_validacion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_validacion" class="control-label"> Fecha_validacion </label>
												    <input type="text" class="form-control" id="fecha_validacion" name="fecha_validacion"
												    value="{{{ isset($data->fecha_validacion ) ? $data->fecha_validacion  : old('fecha_validacion') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_validacion") }}</div>
											   </div>
												</div>
												<!-- Fecha_validacion End -->
												
												<!-- Fecha_emision Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_emision" class="control-label"> Fecha_emision </label>
												    <input type="text" class="form-control" id="fecha_emision" name="fecha_emision"
												    value="{{{ isset($data->fecha_emision ) ? $data->fecha_emision  : old('fecha_emision') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_emision") }}</div>
											   </div>
												</div>
												<!-- Fecha_emision End -->
												
												<!-- Fecha_vencimiento Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_vencimiento" class="control-label"> Fecha_vencimiento </label>
												    <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"
												    value="{{{ isset($data->fecha_vencimiento ) ? $data->fecha_vencimiento  : old('fecha_vencimiento') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_vencimiento") }}</div>
											   </div>
												</div>
												<!-- Fecha_vencimiento End -->
												
												<!-- Mime Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="mime" class="control-label"> Mime </label>
												    <input type="text" class="form-control" id="mime" name="mime"
												    value="{{{ isset($data->mime ) ? $data->mime  : old('mime') }}}">
												    <div class="label label-danger">{{ $errors->first("mime") }}</div>
											   </div>
												</div>
												<!-- Mime End -->
												
												<!-- Archivo Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="archivo" class="control-label"> Archivo </label>
												    <input type="text" class="form-control" id="archivo" name="archivo"
												    value="{{{ isset($data->archivo ) ? $data->archivo  : old('archivo') }}}">
												    <div class="label label-danger">{{ $errors->first("archivo") }}</div>
											   </div>
												</div>
												<!-- Archivo End -->
												
												<!-- Comentario Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="comentario" class="control-label"> Comentario </label>
												    <input type="text" class="form-control" id="comentario" name="comentario"
												    value="{{{ isset($data->comentario ) ? $data->comentario  : old('comentario') }}}">
												    <div class="label label-danger">{{ $errors->first("comentario") }}</div>
											   </div>
												</div>
												<!-- Comentario End -->
												
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
												
