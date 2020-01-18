

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
												
												<!-- Credito_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="credito_id" class="control-label"> Credito_id </label>
												    <input type="text" class="form-control" id="credito_id" name="credito_id"
												    value="{{{ isset($data->credito_id ) ? $data->credito_id  : old('credito_id') }}}">
												    <div class="label label-danger">{{ $errors->first("credito_id") }}</div>
											   </div>
												</div>
												<!-- Credito_id End -->
												
												<!-- Pago_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="pago_id" class="control-label"> Pago_id </label>
												    <input type="text" class="form-control" id="pago_id" name="pago_id"
												    value="{{{ isset($data->pago_id ) ? $data->pago_id  : old('pago_id') }}}">
												    <div class="label label-danger">{{ $errors->first("pago_id") }}</div>
											   </div>
												</div>
												<!-- Pago_id End -->
												
												<!-- Saldo_actual Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="saldo_actual" class="control-label"> Saldo_actual </label>
												    <input type="text" class="form-control" id="saldo_actual" name="saldo_actual"
												    value="{{{ isset($data->saldo_actual ) ? $data->saldo_actual  : old('saldo_actual') }}}">
												    <div class="label label-danger">{{ $errors->first("saldo_actual") }}</div>
											   </div>
												</div>
												<!-- Saldo_actual End -->
												
												<!-- Amortizacion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="amortizacion" class="control-label"> Amortizacion </label>
												    <input type="text" class="form-control" id="amortizacion" name="amortizacion"
												    value="{{{ isset($data->amortizacion ) ? $data->amortizacion  : old('amortizacion') }}}">
												    <div class="label label-danger">{{ $errors->first("amortizacion") }}</div>
											   </div>
												</div>
												<!-- Amortizacion End -->
												
												<!-- Moratorios Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="moratorios" class="control-label"> Moratorios </label>
												    <input type="text" class="form-control" id="moratorios" name="moratorios"
												    value="{{{ isset($data->moratorios ) ? $data->moratorios  : old('moratorios') }}}">
												    <div class="label label-danger">{{ $errors->first("moratorios") }}</div>
											   </div>
												</div>
												<!-- Moratorios End -->
												
												<!-- Pago_aplicado Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="pago_aplicado" class="control-label"> Pago_aplicado </label>
												    <input type="text" class="form-control" id="pago_aplicado" name="pago_aplicado"
												    value="{{{ isset($data->pago_aplicado ) ? $data->pago_aplicado  : old('pago_aplicado') }}}">
												    <div class="label label-danger">{{ $errors->first("pago_aplicado") }}</div>
											   </div>
												</div>
												<!-- Pago_aplicado End -->
												
												<!-- Saldo_final Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="saldo_final" class="control-label"> Saldo_final </label>
												    <input type="text" class="form-control" id="saldo_final" name="saldo_final"
												    value="{{{ isset($data->saldo_final ) ? $data->saldo_final  : old('saldo_final') }}}">
												    <div class="label label-danger">{{ $errors->first("saldo_final") }}</div>
											   </div>
												</div>
												<!-- Saldo_final End -->
												
												<!-- Fecha_inicio Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_inicio" class="control-label"> Fecha_inicio </label>
												    <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio"
												    value="{{{ isset($data->fecha_inicio ) ? $data->fecha_inicio  : old('fecha_inicio') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_inicio") }}</div>
											   </div>
												</div>
												<!-- Fecha_inicio End -->
												
												<!-- Fecha_vence Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_vence" class="control-label"> Fecha_vence </label>
												    <input type="text" class="form-control" id="fecha_vence" name="fecha_vence"
												    value="{{{ isset($data->fecha_vence ) ? $data->fecha_vence  : old('fecha_vence') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_vence") }}</div>
											   </div>
												</div>
												<!-- Fecha_vence End -->
												
												<!-- Fecha_pago Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_pago" class="control-label"> Fecha_pago </label>
												    <input type="text" class="form-control" id="fecha_pago" name="fecha_pago"
												    value="{{{ isset($data->fecha_pago ) ? $data->fecha_pago  : old('fecha_pago') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_pago") }}</div>
											   </div>
												</div>
												<!-- Fecha_pago End -->
												
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
												
