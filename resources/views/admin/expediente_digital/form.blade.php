

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

<!-- User_id Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="user_id" class="control-label"> Usuario </label>
    <input type="text" class="form-control" id="user_id" name="user_id"
    value="{{{ isset($data->user_id ) ? $data->user_id  : old('user_id') }}}">
    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
</div>
</div>
<!-- User_id End -->

<!-- Solicitud_id Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="solicitud_id" class="control-label"> Solicitud</label>
    <input type="text" class="form-control" id="solicitud_id" name="solicitud_id"
    value="{{{ isset($data->solicitud_id ) ? $data->solicitud_id  : old('solicitud_id') }}}">
    <div class="label label-danger">{{ $errors->first("solicitud_id") }}</div>
</div>
</div>
<!-- Solicitud_id End -->

<!-- Documento_id Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="documento_id" class="control-label"> Documento </label>
    <input type="text" class="form-control" id="documento_id" name="documento_id"
    value="{{{ isset($data->documento_id ) ? $data->documento_id  : old('documento_id') }}}">
    <div class="label label-danger">{{ $errors->first("documento_id") }}</div>
</div>
</div>
<!-- Documento_id End -->

<!-- Status Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="status" class="control-label"> Estatus </label>
    <input type="text" class="form-control" id="status" name="status"
    value="{{{ isset($data->status ) ? $data->status  : old('status') }}}">
    <div class="label label-danger">{{ $errors->first("status") }}</div>
</div>
</div>
<!-- Status End -->

