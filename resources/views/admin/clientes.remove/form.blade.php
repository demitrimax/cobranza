

												<!-- Nombre Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="nombre" class="control-label"> Nombre </label>
												    <input type="text" class="form-control" id="nombre" name="nombre"
												    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
												    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
											   </div>
												</div>
												<!-- Nombre End -->
												
												<!-- Paterno Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="paterno" class="control-label"> Paterno </label>
												    <input type="text" class="form-control" id="paterno" name="paterno"
												    value="{{{ isset($data->paterno ) ? $data->paterno  : old('paterno') }}}">
												    <div class="label label-danger">{{ $errors->first("paterno") }}</div>
											   </div>
												</div>
												<!-- Paterno End -->
												
												<!-- Materno Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="materno" class="control-label"> Materno </label>
												    <input type="text" class="form-control" id="materno" name="materno"
												    value="{{{ isset($data->materno ) ? $data->materno  : old('materno') }}}">
												    <div class="label label-danger">{{ $errors->first("materno") }}</div>
											   </div>
												</div>
												<!-- Materno End -->
												
												<!-- Nacimiento Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="nacimiento" class="control-label"> Nacimiento </label>
												    <input type="text" class="form-control" id="nacimiento" name="nacimiento"
												    value="{{{ isset($data->nacimiento ) ? $data->nacimiento  : old('nacimiento') }}}">
												    <div class="label label-danger">{{ $errors->first("nacimiento") }}</div>
											   </div>
												</div>
												<!-- Nacimiento End -->
												
												<!-- Telefono Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="telefono" class="control-label"> Telefono </label>
												    <input type="text" class="form-control" id="telefono" name="telefono"
												    value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}">
												    <div class="label label-danger">{{ $errors->first("telefono") }}</div>
											   </div>
												</div>
												<!-- Telefono End -->
												
												<!-- Celular Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="celular" class="control-label"> Celular </label>
												    <input type="text" class="form-control" id="celular" name="celular"
												    value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
												    <div class="label label-danger">{{ $errors->first("celular") }}</div>
											   </div>
												</div>
												<!-- Celular End -->
												
												<!-- Trabajo Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="trabajo" class="control-label"> Trabajo </label>
												    <input type="text" class="form-control" id="trabajo" name="trabajo"
												    value="{{{ isset($data->trabajo ) ? $data->trabajo  : old('trabajo') }}}">
												    <div class="label label-danger">{{ $errors->first("trabajo") }}</div>
											   </div>
												</div>
												<!-- Trabajo End -->
												
												<!-- Correo Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="correo" class="control-label"> Correo </label>
												    <input type="text" class="form-control" id="correo" name="correo"
												    value="{{{ isset($data->correo ) ? $data->correo  : old('correo') }}}">
												    <div class="label label-danger">{{ $errors->first("correo") }}</div>
											   </div>
												</div>
												<!-- Correo End -->
												
												<!-- Calle Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="calle" class="control-label"> Calle </label>
												    <input type="text" class="form-control" id="calle" name="calle"
												    value="{{{ isset($data->calle ) ? $data->calle  : old('calle') }}}">
												    <div class="label label-danger">{{ $errors->first("calle") }}</div>
											   </div>
												</div>
												<!-- Calle End -->
												
												<!-- Colonia Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="colonia" class="control-label"> Colonia </label>
												    <input type="text" class="form-control" id="colonia" name="colonia"
												    value="{{{ isset($data->colonia ) ? $data->colonia  : old('colonia') }}}">
												    <div class="label label-danger">{{ $errors->first("colonia") }}</div>
											   </div>
												</div>
												<!-- Colonia End -->
												
												<!-- Ciudad Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="ciudad" class="control-label"> Ciudad </label>
												    <input type="text" class="form-control" id="ciudad" name="ciudad"
												    value="{{{ isset($data->ciudad ) ? $data->ciudad  : old('ciudad') }}}">
												    <div class="label label-danger">{{ $errors->first("ciudad") }}</div>
											   </div>
												</div>
												<!-- Ciudad End -->
												
												<!-- Estado Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="estado" class="control-label"> Estado </label>
												    <input type="text" class="form-control" id="estado" name="estado"
												    value="{{{ isset($data->estado ) ? $data->estado  : old('estado') }}}">
												    <div class="label label-danger">{{ $errors->first("estado") }}</div>
											   </div>
												</div>
												<!-- Estado End -->
												
												<!-- Cp Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="cp" class="control-label"> Cp </label>
												    <input type="text" class="form-control" id="cp" name="cp"
												    value="{{{ isset($data->cp ) ? $data->cp  : old('cp') }}}">
												    <div class="label label-danger">{{ $errors->first("cp") }}</div>
											   </div>
												</div>
												<!-- Cp End -->
												
												<!-- Ocupacion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="ocupacion" class="control-label"> Ocupacion </label>
												    <input type="text" class="form-control" id="ocupacion" name="ocupacion"
												    value="{{{ isset($data->ocupacion ) ? $data->ocupacion  : old('ocupacion') }}}">
												    <div class="label label-danger">{{ $errors->first("ocupacion") }}</div>
											   </div>
												</div>
												<!-- Ocupacion End -->
												
												<!-- Trabaja Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="trabaja" class="control-label"> Trabaja </label>
												    <input type="text" class="form-control" id="trabaja" name="trabaja"
												    value="{{{ isset($data->trabaja ) ? $data->trabaja  : old('trabaja') }}}">
												    <div class="label label-danger">{{ $errors->first("trabaja") }}</div>
											   </div>
												</div>
												<!-- Trabaja End -->
												
												<!-- Ingreso_mensual Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="ingreso_mensual" class="control-label"> Ingreso_mensual </label>
												    <input type="text" class="form-control" id="ingreso_mensual" name="ingreso_mensual"
												    value="{{{ isset($data->ingreso_mensual ) ? $data->ingreso_mensual  : old('ingreso_mensual') }}}">
												    <div class="label label-danger">{{ $errors->first("ingreso_mensual") }}</div>
											   </div>
												</div>
												<!-- Ingreso_mensual End -->
												
												<!-- Ingreso_extra Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="ingreso_extra" class="control-label"> Ingreso_extra </label>
												    <input type="text" class="form-control" id="ingreso_extra" name="ingreso_extra"
												    value="{{{ isset($data->ingreso_extra ) ? $data->ingreso_extra  : old('ingreso_extra') }}}">
												    <div class="label label-danger">{{ $errors->first("ingreso_extra") }}</div>
											   </div>
												</div>
												<!-- Ingreso_extra End -->
												
												<!-- Gasto_mensual Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="gasto_mensual" class="control-label"> Gasto_mensual </label>
												    <input type="text" class="form-control" id="gasto_mensual" name="gasto_mensual"
												    value="{{{ isset($data->gasto_mensual ) ? $data->gasto_mensual  : old('gasto_mensual') }}}">
												    <div class="label label-danger">{{ $errors->first("gasto_mensual") }}</div>
											   </div>
												</div>
												<!-- Gasto_mensual End -->
												
												<!-- Fiador_nombre Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_nombre" class="control-label"> Fiador_nombre </label>
												    <input type="text" class="form-control" id="fiador_nombre" name="fiador_nombre"
												    value="{{{ isset($data->fiador_nombre ) ? $data->fiador_nombre  : old('fiador_nombre') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_nombre") }}</div>
											   </div>
												</div>
												<!-- Fiador_nombre End -->
												
												<!-- Fiador_telefono Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_telefono" class="control-label"> Fiador_telefono </label>
												    <input type="text" class="form-control" id="fiador_telefono" name="fiador_telefono"
												    value="{{{ isset($data->fiador_telefono ) ? $data->fiador_telefono  : old('fiador_telefono') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_telefono") }}</div>
											   </div>
												</div>
												<!-- Fiador_telefono End -->
												
												<!-- Fiador_celular Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_celular" class="control-label"> Fiador_celular </label>
												    <input type="text" class="form-control" id="fiador_celular" name="fiador_celular"
												    value="{{{ isset($data->fiador_celular ) ? $data->fiador_celular  : old('fiador_celular') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_celular") }}</div>
											   </div>
												</div>
												<!-- Fiador_celular End -->
												
												<!-- Fiador_trabajo Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_trabajo" class="control-label"> Fiador_trabajo </label>
												    <input type="text" class="form-control" id="fiador_trabajo" name="fiador_trabajo"
												    value="{{{ isset($data->fiador_trabajo ) ? $data->fiador_trabajo  : old('fiador_trabajo') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_trabajo") }}</div>
											   </div>
												</div>
												<!-- Fiador_trabajo End -->
												
												<!-- Fiador_calle Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_calle" class="control-label"> Fiador_calle </label>
												    <input type="text" class="form-control" id="fiador_calle" name="fiador_calle"
												    value="{{{ isset($data->fiador_calle ) ? $data->fiador_calle  : old('fiador_calle') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_calle") }}</div>
											   </div>
												</div>
												<!-- Fiador_calle End -->
												
												<!-- Fiador_colonia Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_colonia" class="control-label"> Fiador_colonia </label>
												    <input type="text" class="form-control" id="fiador_colonia" name="fiador_colonia"
												    value="{{{ isset($data->fiador_colonia ) ? $data->fiador_colonia  : old('fiador_colonia') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_colonia") }}</div>
											   </div>
												</div>
												<!-- Fiador_colonia End -->
												
												<!-- Fiador_ciudad Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_ciudad" class="control-label"> Fiador_ciudad </label>
												    <input type="text" class="form-control" id="fiador_ciudad" name="fiador_ciudad"
												    value="{{{ isset($data->fiador_ciudad ) ? $data->fiador_ciudad  : old('fiador_ciudad') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_ciudad") }}</div>
											   </div>
												</div>
												<!-- Fiador_ciudad End -->
												
												<!-- Fiador_estado Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_estado" class="control-label"> Fiador_estado </label>
												    <input type="text" class="form-control" id="fiador_estado" name="fiador_estado"
												    value="{{{ isset($data->fiador_estado ) ? $data->fiador_estado  : old('fiador_estado') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_estado") }}</div>
											   </div>
												</div>
												<!-- Fiador_estado End -->
												
												<!-- Fiador_cp Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_cp" class="control-label"> Fiador_cp </label>
												    <input type="text" class="form-control" id="fiador_cp" name="fiador_cp"
												    value="{{{ isset($data->fiador_cp ) ? $data->fiador_cp  : old('fiador_cp') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_cp") }}</div>
											   </div>
												</div>
												<!-- Fiador_cp End -->
												
												<!-- Fiador_latitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_latitud" class="control-label"> Fiador_latitud </label>
												    <input type="text" class="form-control" id="fiador_latitud" name="fiador_latitud"
												    value="{{{ isset($data->fiador_latitud ) ? $data->fiador_latitud  : old('fiador_latitud') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_latitud") }}</div>
											   </div>
												</div>
												<!-- Fiador_latitud End -->
												
												<!-- Fiador_longitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fiador_longitud" class="control-label"> Fiador_longitud </label>
												    <input type="text" class="form-control" id="fiador_longitud" name="fiador_longitud"
												    value="{{{ isset($data->fiador_longitud ) ? $data->fiador_longitud  : old('fiador_longitud') }}}">
												    <div class="label label-danger">{{ $errors->first("fiador_longitud") }}</div>
											   </div>
												</div>
												<!-- Fiador_longitud End -->
												
												<!-- Referencia1_nombre Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia1_nombre" class="control-label"> Referencia1_nombre </label>
												    <input type="text" class="form-control" id="referencia1_nombre" name="referencia1_nombre"
												    value="{{{ isset($data->referencia1_nombre ) ? $data->referencia1_nombre  : old('referencia1_nombre') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia1_nombre") }}</div>
											   </div>
												</div>
												<!-- Referencia1_nombre End -->
												
												<!-- Referencia1_parentesco Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia1_parentesco" class="control-label"> Referencia1_parentesco </label>
												    <input type="text" class="form-control" id="referencia1_parentesco" name="referencia1_parentesco"
												    value="{{{ isset($data->referencia1_parentesco ) ? $data->referencia1_parentesco  : old('referencia1_parentesco') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia1_parentesco") }}</div>
											   </div>
												</div>
												<!-- Referencia1_parentesco End -->
												
												<!-- Referencia1_celular Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia1_celular" class="control-label"> Referencia1_celular </label>
												    <input type="text" class="form-control" id="referencia1_celular" name="referencia1_celular"
												    value="{{{ isset($data->referencia1_celular ) ? $data->referencia1_celular  : old('referencia1_celular') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia1_celular") }}</div>
											   </div>
												</div>
												<!-- Referencia1_celular End -->
												
												<!-- Referencia1_domicilio Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia1_domicilio" class="control-label"> Referencia1_domicilio </label>
												    <input type="text" class="form-control" id="referencia1_domicilio" name="referencia1_domicilio"
												    value="{{{ isset($data->referencia1_domicilio ) ? $data->referencia1_domicilio  : old('referencia1_domicilio') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia1_domicilio") }}</div>
											   </div>
												</div>
												<!-- Referencia1_domicilio End -->
												
												<!-- Referencia1_latitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia1_latitud" class="control-label"> Referencia1_latitud </label>
												    <input type="text" class="form-control" id="referencia1_latitud" name="referencia1_latitud"
												    value="{{{ isset($data->referencia1_latitud ) ? $data->referencia1_latitud  : old('referencia1_latitud') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia1_latitud") }}</div>
											   </div>
												</div>
												<!-- Referencia1_latitud End -->
												
												<!-- Referencia1_longitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia1_longitud" class="control-label"> Referencia1_longitud </label>
												    <input type="text" class="form-control" id="referencia1_longitud" name="referencia1_longitud"
												    value="{{{ isset($data->referencia1_longitud ) ? $data->referencia1_longitud  : old('referencia1_longitud') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia1_longitud") }}</div>
											   </div>
												</div>
												<!-- Referencia1_longitud End -->
												
												<!-- Referencia2_nombre Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia2_nombre" class="control-label"> Referencia2_nombre </label>
												    <input type="text" class="form-control" id="referencia2_nombre" name="referencia2_nombre"
												    value="{{{ isset($data->referencia2_nombre ) ? $data->referencia2_nombre  : old('referencia2_nombre') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia2_nombre") }}</div>
											   </div>
												</div>
												<!-- Referencia2_nombre End -->
												
												<!-- Referencia2_parentesco Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia2_parentesco" class="control-label"> Referencia2_parentesco </label>
												    <input type="text" class="form-control" id="referencia2_parentesco" name="referencia2_parentesco"
												    value="{{{ isset($data->referencia2_parentesco ) ? $data->referencia2_parentesco  : old('referencia2_parentesco') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia2_parentesco") }}</div>
											   </div>
												</div>
												<!-- Referencia2_parentesco End -->
												
												<!-- Referencia2_celular Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia2_celular" class="control-label"> Referencia2_celular </label>
												    <input type="text" class="form-control" id="referencia2_celular" name="referencia2_celular"
												    value="{{{ isset($data->referencia2_celular ) ? $data->referencia2_celular  : old('referencia2_celular') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia2_celular") }}</div>
											   </div>
												</div>
												<!-- Referencia2_celular End -->
												
												<!-- Referencia2_domicilio Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia2_domicilio" class="control-label"> Referencia2_domicilio </label>
												    <input type="text" class="form-control" id="referencia2_domicilio" name="referencia2_domicilio"
												    value="{{{ isset($data->referencia2_domicilio ) ? $data->referencia2_domicilio  : old('referencia2_domicilio') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia2_domicilio") }}</div>
											   </div>
												</div>
												<!-- Referencia2_domicilio End -->
												
												<!-- Referencia2_latitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia2_latitud" class="control-label"> Referencia2_latitud </label>
												    <input type="text" class="form-control" id="referencia2_latitud" name="referencia2_latitud"
												    value="{{{ isset($data->referencia2_latitud ) ? $data->referencia2_latitud  : old('referencia2_latitud') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia2_latitud") }}</div>
											   </div>
												</div>
												<!-- Referencia2_latitud End -->
												
												<!-- Referencia2_longitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia2_longitud" class="control-label"> Referencia2_longitud </label>
												    <input type="text" class="form-control" id="referencia2_longitud" name="referencia2_longitud"
												    value="{{{ isset($data->referencia2_longitud ) ? $data->referencia2_longitud  : old('referencia2_longitud') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia2_longitud") }}</div>
											   </div>
												</div>
												<!-- Referencia2_longitud End -->
												
												<!-- Referencia3_nombre Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia3_nombre" class="control-label"> Referencia3_nombre </label>
												    <input type="text" class="form-control" id="referencia3_nombre" name="referencia3_nombre"
												    value="{{{ isset($data->referencia3_nombre ) ? $data->referencia3_nombre  : old('referencia3_nombre') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia3_nombre") }}</div>
											   </div>
												</div>
												<!-- Referencia3_nombre End -->
												
												<!-- Referencia3_parentesco Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia3_parentesco" class="control-label"> Referencia3_parentesco </label>
												    <input type="text" class="form-control" id="referencia3_parentesco" name="referencia3_parentesco"
												    value="{{{ isset($data->referencia3_parentesco ) ? $data->referencia3_parentesco  : old('referencia3_parentesco') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia3_parentesco") }}</div>
											   </div>
												</div>
												<!-- Referencia3_parentesco End -->
												
												<!-- Referencia3_celular Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia3_celular" class="control-label"> Referencia3_celular </label>
												    <input type="text" class="form-control" id="referencia3_celular" name="referencia3_celular"
												    value="{{{ isset($data->referencia3_celular ) ? $data->referencia3_celular  : old('referencia3_celular') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia3_celular") }}</div>
											   </div>
												</div>
												<!-- Referencia3_celular End -->
												
												<!-- Referencia3_domicilio Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia3_domicilio" class="control-label"> Referencia3_domicilio </label>
												    <input type="text" class="form-control" id="referencia3_domicilio" name="referencia3_domicilio"
												    value="{{{ isset($data->referencia3_domicilio ) ? $data->referencia3_domicilio  : old('referencia3_domicilio') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia3_domicilio") }}</div>
											   </div>
												</div>
												<!-- Referencia3_domicilio End -->
												
												<!-- Referencia3_latitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia3_latitud" class="control-label"> Referencia3_latitud </label>
												    <input type="text" class="form-control" id="referencia3_latitud" name="referencia3_latitud"
												    value="{{{ isset($data->referencia3_latitud ) ? $data->referencia3_latitud  : old('referencia3_latitud') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia3_latitud") }}</div>
											   </div>
												</div>
												<!-- Referencia3_latitud End -->
												
												<!-- Referencia3_longitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="referencia3_longitud" class="control-label"> Referencia3_longitud </label>
												    <input type="text" class="form-control" id="referencia3_longitud" name="referencia3_longitud"
												    value="{{{ isset($data->referencia3_longitud ) ? $data->referencia3_longitud  : old('referencia3_longitud') }}}">
												    <div class="label label-danger">{{ $errors->first("referencia3_longitud") }}</div>
											   </div>
												</div>
												<!-- Referencia3_longitud End -->
												
												<!-- Latitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="latitud" class="control-label"> Latitud </label>
												    <input type="text" class="form-control" id="latitud" name="latitud"
												    value="{{{ isset($data->latitud ) ? $data->latitud  : old('latitud') }}}">
												    <div class="label label-danger">{{ $errors->first("latitud") }}</div>
											   </div>
												</div>
												<!-- Latitud End -->
												
												<!-- Longitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="longitud" class="control-label"> Longitud </label>
												    <input type="text" class="form-control" id="longitud" name="longitud"
												    value="{{{ isset($data->longitud ) ? $data->longitud  : old('longitud') }}}">
												    <div class="label label-danger">{{ $errors->first("longitud") }}</div>
											   </div>
												</div>
												<!-- Longitud End -->
												
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
												
