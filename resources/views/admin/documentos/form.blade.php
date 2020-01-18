<!-- Producto_id Start -->
<div class="col-md-12">
  <div class="form-group">
      <label for="producto_id" class="control-label"> Producto </label>
      <select id="producto_id" name="producto_id" class="form-control select2">
				<option value="0"> [ TODOS ] </option>
          <?php foreach ($productos as $value) { ?>
          	<option value="<?php echo $value->id; ?>" <?php if($value->id == $data->producto_id) { echo 'selected'; } ?>><?php echo $value->descripcion; ?></option>
          <?php } ?>
      </select>
      <div class="label label-danger">{{ $errors->first("producto_id") }}</div>
   </div>
</div>
<!-- Producto_id End -->

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

<!-- Requerido Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="requerido" class="control-label"> Requerido </label>
	<select class="form-control" id="requerido" name="requerido">
		<option value="1" <?php if($data->requerido == 1) { echo 'selected'; } ?>>SI</option>
		<option value="0" <?php if($data->requerido == 0) { echo 'selected'; } ?>>NO</option>
	</select>
  <div class="label label-danger">{{ $errors->first("requerido") }}</div>
 </div>
</div>
<!-- Requerido End -->

<input type="hidden" class="form-control" id="status" name="status" value="1">
