

<!-- Asesor_id Start -->
<div class="col-md-12">
  <div class="form-group">
      <label for="asesor_id" class="control-label"> Asesor </label>
      <select id="asesor_id" name="asesor_id" class="form-control select2">
					<option value=""> [ Seleccione un Asesor ] </option>
          <?php foreach ($asesores as $value) { ?>
            <option value="<?php echo $value->id; ?>" <?php if($data->asesor_id == $value->id) { echo 'selected'; } ?>><?php echo $value->nombre; ?></option>
          <?php } ?>
      </select>
      <div class="label label-danger">{{ $errors->first("asesor_id") }}</div>
   </div>
</div>
<!-- Asesor_id End -->


<!-- Nombre Start -->
<div class="col-md-12">
 <div class="form-group">
  <label for="nombre" class="control-label"> Nombre </label>
    <input type="text" class="form-control" id="nombre" name="nombre"
    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
 </div>
</div>
<!-- Nombre End -->

<input type="hidden" class="form-control" id="status" name="status" value="1">
