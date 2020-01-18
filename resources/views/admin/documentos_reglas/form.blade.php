

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
												
												<!-- Regla Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="regla" class="control-label"> Regla </label>
												    <input type="text" class="form-control" id="regla" name="regla"
												    value="{{{ isset($data->regla ) ? $data->regla  : old('regla') }}}">
												    <div class="label label-danger">{{ $errors->first("regla") }}</div>
											   </div>
												</div>
												<!-- Regla End -->
												
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
												
