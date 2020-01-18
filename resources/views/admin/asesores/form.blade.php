<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">Informacion General </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
      <div class="panel-body">

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

        <!-- Correo Start -->
        <div class="col-md-4">
         <div class="form-group">
          <label for="correo" class="control-label"> Correo </label>
            <input type="text" class="form-control" id="email" name="email" <?php if($data->correo) { echo 'readonly'; } ?>
            value="{{{ isset($data->correo ) ? $data->correo  : old('email') }}}">
            <div class="label label-danger">{{ $errors->first("email") }}</div>
         </div>
        </div>
        <!-- Correo End -->

        <!-- Celular Start -->
        <div class="col-md-4">
         <div class="form-group">
          <label for="celular" class="control-label"> Celular </label>
            <input type="text" class="form-control" id="celular" name="celular"
            value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
            <div class="label label-danger">{{ $errors->first("celular") }}</div>
         </div>
        </div>
        <!-- Celular End -->

        <!-- Comision Start -->
        <div class="col-md-4">
         <div class="form-group">
          <label for="comision" class="control-label"> Comision </label>
            <input type="text" class="form-control" id="comision" name="comision"
            value="{{{ isset($data->comision ) ? $data->comision  : old('comision') }}}">
            <div class="label label-danger">{{ $errors->first("comision") }}</div>
         </div>
        </div>
        <!-- Comision End -->

        <input type="hidden" class="form-control" id="supervisor" name="supervisor" value="1">
        <input type="hidden" class="form-control" id="status" name="status" value="1">


      </div>

    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">Datos de Acceso </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
      <div class="panel-body">

        <div class="col-md-4">
         <div class="form-group">
          <label for="comision" class="control-label"> Rol </label>
        	<select class="form-control" id="rol_id" name="rol_id">
            <?php foreach($roles as $value) { ?>
              <option value="<?php echo $value->id; ?>" <?php if($user->rol_id == $value->id) { echo "selected"; }?>><?php echo $value->name; ?></option>
            <?php } ?>
        	</select>
         </div>
        </div>


        <div class="col-md-4">
         <div class="form-group">
          <label for="comision" class="control-label"> Contraseña </label>
        	<input  class="form-control" id="password" name="password">
        	<div class="label label-danger">{{ $errors->first("password") }}</div>
         </div>
        </div>


        <div class="col-md-4">
         <div class="form-group">
          <label for="comision" class="control-label"> Confirmar Contraseña </label>
        	<input  class="form-control" id="password_confirmation" name="password_confirmation">
         </div>
        </div>

      </div>

    </div>
  </div>
</div>
