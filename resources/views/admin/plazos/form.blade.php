

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
												
												<!-- Periodicidad Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="periodicidad" class="control-label"> Periodicidad </label>
												    <input type="text" class="form-control" id="periodicidad" name="periodicidad"
												    value="{{{ isset($data->periodicidad ) ? $data->periodicidad  : old('periodicidad') }}}">
												    <div class="label label-danger">{{ $errors->first("periodicidad") }}</div>
											   </div>
												</div>
												<!-- Periodicidad End -->
												
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
												
