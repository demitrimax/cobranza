

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
												
												<!-- Producto_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="producto_id" class="control-label"> Producto_id </label>
												    <input type="text" class="form-control" id="producto_id" name="producto_id"
												    value="{{{ isset($data->producto_id ) ? $data->producto_id  : old('producto_id') }}}">
												    <div class="label label-danger">{{ $errors->first("producto_id") }}</div>
											   </div>
												</div>
												<!-- Producto_id End -->
												
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
												
