

<input type="hidden" class="form-control" id="asesor_id" name="asesor_id" value="0">
<input type="hidden" class="form-control" id="status" name="status"  value="1">
<!-- Rol_id Start -->
<div class="col-md-6">
  <div class="form-group">
      <label for="rol_id" class="control-label"> Rol y Permisos </label>
      <select id="rol_id" name="rol_id" class="form-control select2">
          <?php
            foreach ($roles as $value) {
              echo '<option value="'.$value->id.'"> '.$value->name.'</option>';
            }
          ?>
      </select>
      <div class="label label-danger">{{ $errors->first("rol_id") }}</div>
   </div>
</div>
<!-- Rol_id End -->


<!-- Name Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="name" class="control-label"> Nombre Completo </label>
    <input type="text" class="form-control" id="name" name="name"
    value="{{{ isset($data->name ) ? $data->name  : old('name') }}}">
    <div class="label label-danger">{{ $errors->first("name") }}</div>
 </div>
</div>
<!-- Name End -->

<!-- Email Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="email" class="control-label"> Email  <small>Sera su nombre de usuario</small> </label>
    <input type="text" <?php if($data->email) { echo 'readonly'; }?> class="form-control email" id="email" name="email" value="{{{ isset($data->email ) ? $data->email  : old('email') }}}">
    <div class="label label-danger">{{ $errors->first("email") }}</div>
 </div>
</div>
<!-- Email End -->

<!-- Password Start -->
<div class="col-md-3">
 <div class="form-group">
  <label for="password" class="control-label"> Contraseña </label>
    <input type="password" class="form-control" id="password" name="password" maxlength="10">
    <div class="label label-danger">{{ $errors->first("password") }}</div>
 </div>
</div>
<!-- Password End -->


<!-- Password Start -->
<div class="col-md-3">
 <div class="form-group">
  <label for="password" class="control-label"> Confirmar Contraseña </label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repita contraseña" maxlength="10">
    <div class="label label-danger">{{ $errors->first("password") }}</div>
 </div>
</div>
<!-- Password End -->
