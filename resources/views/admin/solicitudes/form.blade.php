@section('css')
<!-- Wizard CSS -->
    <link href="{{asset('themes/plugins/bower_components/jquery-wizard-master/css/wizard.css')}}" rel="stylesheet">
<style type="text/css">
      .map {
				width: 100%;
        height: 500px;
      }
</style>
@endsection

<!-- Etap_flujo Start -->
<input type="hidden" name="etapa_flujo" id="etap_flujo" value="2" />
<input type="hidden" name="prospecto_id" id="prospecto_id" value="{{{ $data->prospecto_id}}}" />
<input type="hidden" name="cliente_id" id="cliente_id" value="{{{ isset($data->cliente_id ) ? $data->cliente_id  : old('cliente_id') }}}" />
<input type="hidden" name="autorizado" id="autorizado" value="{{{ isset($data->autorizado ) ? $data->autorizado  : 1 }}}" />

<input type="hidden" name="maximo" id="minimo"/>
<input type="hidden" name="maximo" id="maximo"/>

<!-- Etap_flujo End -->

<input type="hidden" id="renovacion" name="renovacion" value="{{{ isset($data->renovacion ) ? $data->renovacion  : 0 }}}" class="form-control"/>
<input type="hidden" id="solicitud_renueva_id" name="solicitud_renueva_id" value="{{{ isset($data->solicitud_renueva_id ) ? $data->solicitud_renueva_id  : 0 }}}" class="form-control"/>

<div class="col-md-12" id="msgWarning" style="display:none;">
  <div class="alert alert-danger" id="msg"> </div>
</div>

<!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Nueva Solicitud</h3>
                            <p class="text-muted m-b-30 font-13"> Complete la siguiente información para la solicitud de un nuevo crédito.</p>
                            <div id="exampleBasic2" class="wizard">
                                <ul class="wizard-steps" role="tablist">
                                    <li class="active" role="tab">
                                        <h4><span><i class="ti-user"></i></span>Datos del Crédito</h4>
                                    </li>
                                    <li role="tab">
                                        <h4><span><i class="ti-credit-card"></i></span>Datos del Cliente</h4>
                                    </li>
                                    <li role="tab">
                                        <h4><span><i class="ti-check"></i></span>Referencias del Cliente</h4>
                                    </li>
                                    <li role="tab">
                                        <h4><span><i class="ti-check"></i></span>Expediente de Solicitud</h4>
                                    </li>
                                </ul>
                                <div class="wizard-content">
                                    <div class="wizard-pane active" role="tabpanel">
                                      <div class="panel panel-default">
                                    		<div class="panel-heading">
                                    			Pertenencia de Registro
                                    		</div>
                                    		<div class="panel-wrapper collapse in" aria-expanded="true">
                                    			<div class="panel-body">

                                    				<div class="clear">
                                    					<p></p>
                                    				</div>


                                            <!-- Monto_solicitado Start -->
                                            <div class="col-md-10"></div>
                                    				<div class="col-md-2">
                                    				 <div class="form-group">
                                    					 <label for="vendedor_id" class="control-label"> Estatus </label>
                                    					 <select class="form-control" id="status" name="status">
                                    						 <option value="1" <?php if($data->status == 1) { echo 'selected'; } ?>> HABILITADA </option>
                                                 <option value="2" <?php if($data->status == 2) { echo 'selected'; } ?>> DESHABILITADA </option>
                                    					 </select>
                                    				 </div>
                                    				</div>
                                    				<!-- Monto_solicitado End -->

                                    				<!-- Monto_solicitado Start -->
                                    				<div class="col-md-12" <?php if(Auth::user()->vendedor_id != 0) { echo 'style="display:none"'; }?>>
                                    				 <div class="form-group">
                                    					 <label for="vendedor_id" class="control-label"> Supervisor </label>
                                    					 <select class="form-control" id="asesor_id" name="asesor_id">
                                    						 <option value="">---Seleccione---</option>
                                    						 <?php foreach($asesores as $value) { ?>
                                    							 <option value="<?php echo $value->id; ?>" <?php if($value->id == $data->asesor_id) { echo 'selected'; }?>>
                                    								 <?php echo $value->nombre; ?>
                                    							 </option>
                                    						 <?php } ?>
                                    					 </select>
                                    				 </div>
                                    				</div>
                                    				<!-- Monto_solicitado End -->


                                            <!-- Monto_solicitado Start -->
                                    				<div class="col-md-12">
                                    				 <div class="form-group">
                                    					 <label for="vendedor_id" class="control-label"> Agente </label>
                                    					 <select class="form-control" id="agente_id" name="agente_id">
                                    						 <option value="">---Seleccione---</option>
                                    					 </select>
                                    				 </div>
                                    				</div>
                                    				<!-- Monto_solicitado End -->

                                    				<div class="clear">
                                    					<p><br/></p>
                                    				</div>

                                    			</div>

                                    		</div>
                                    	</div>

                                      <div class="row">
                                        <div class="col-sm-6">

                                      	<div class="panel panel-default">
                                      		<div class="panel-heading">
                                      			Credito a Solicitar
                                      		</div>
                                      		<div class="panel-wrapper collapse in" aria-expanded="true">
                                      			<div class="panel-body">


                                      				<!-- Producto_id Start -->
                                      				<div class="col-md-12">
                                      				  <div class="form-group">
                                      				      <label for="producto_id" class="control-label"> Producto a Adquirir </label>
                                      				      <select id="producto_id" name="producto_id" class="form-control selectpicker" required>
                                      				      	<option value="">--- Seleccione ---</option>
                                      								<?php foreach ($productos as $value) { ?>
                                      					        <option value="<?php echo $value->id; ?>" <?php if($data->producto_id == $value->id) { echo 'selected'; } ?>><?php echo $value->descripcion; ?></option>
                                      				        <?php } ?>
                                      				      </select>
                                      				      <div class="label label-danger">{{ $errors->first("producto_id") }}</div>
                                      				   </div>
                                      				</div>
                                      				<!-- Producto_id End -->

                                      				<!-- Monto_solicitado Start -->
                                      				<div class="col-md-12">
                                      				 <div class="form-group">
                                      				  <label for="monto_solicitado" class="control-label"> Monto a Solicitar </label>
                                      					<input type="text" class="form-control" id="monto_solicitado" name="monto_solicitado" value="{{{ isset($data->monto_solicitado ) ? round($data->monto_solicitado,2)  : old('monto_solicitado') }}}" required>
                                      				 </div>
                                      				</div>
                                      				<!-- Monto_solicitado End -->

                                      				<!-- Plazo_solicitado Start -->
                                      				<div class="col-md-12">
                                      				 <div class="form-group">
                                      				  <label for="plazo_solicitado" class="control-label"> Cuanto desea Pagar </label>
                                      					<input type="text" class="form-control" id="pago_solicitado" min="0" max="99999" name="pago_solicitado" value="{{{ isset($data->pago_solicitado ) ? round($data->pago_solicitado,2)  : old('pago_solicitado') }}}" required>
                                      				 </div>
                                      				</div>
                                      				<!-- Plazo_solicitado End -->



                                      			</div>

                                      		</div>
                                      	</div>

                                      </div>

                                        <div class="col-sm-6">

                                      	<div class="panel panel-default">
                                      		<div class="panel-heading">
                                      			Detalles del Credito Adquirido
                                      		</div>
                                      		<div class="panel-wrapper collapse in" aria-expanded="true">
                                      			<div class="panel-body">

                                      				<div class="clear">
                                      					<p></p>
                                      				</div>

                                      				<!-- Producto_id Start -->
                                      				<div class="col-md-12">
                                      				  <div class="form-group">
                                      				    <h2 class="col-md-6"> Monto Solicitado </h2>
                                      						<h2 class="col-md-6" id="montoSolicitado" class="text-right text-info">
                                      							 $ {{{ isset($data->monto_solicitado) ? number_format($data->monto_solicitado,2,".",",") : "000.00"}}}
                                      						 </h2>
                                      				   </div>
                                      				</div>
                                      				<!-- Producto_id End -->

                                      				<!-- Monto_solicitado Start -->
                                      				<div class="col-md-12">
                                      				 <div class="form-group">
                                      					 <h2 class="col-md-6"> Intereses </h2>
                                       					<h2 class="col-md-6" id="interesesSolicitado" class="text-right text-warning">
                                      						$	<?php

                                      								$monto = 0;
                                      								if($data->interes_registro) {
                                      									$monto = ($data->monto_solicitado * ($data->interes_registro / 100) );
                                      									echo number_format($monto,2,".",",");
                                      								} else {
                                      									echo $monto;
                                      								}

                                      							?>
                                      					</h2>
                                      					<input type="hidden" class="form-control" id="interes_registro" name="interes_registro" required
                                      					value="{{{ isset($data->interes_registro ) ? round($data->interes_registro,2)  : old('interes_registro') }}}">
                                      				 </div>
                                      				</div>
                                      				<!-- Monto_solicitado End -->

                                      				<!-- Plazo_solicitado Start -->
                                      				<div class="col-md-12">
                                      				 <div class="form-group">
                                      					 <h2 class="col-md-6"> Total a Pagar </h2>
                                       					<h2 class="col-md-6" id="totalPagar" class="text-center text-success"> $ <?php echo number_format($monto + $data->monto_solicitado,2,".",","); ?> </h2>
                                      				 </div>
                                      				</div>
                                      				<!-- Plazo_solicitado End -->

                                      				<!-- Plazo_solicitado Start -->
                                      				<div class="col-md-12">
                                      				 <div class="form-group">
                                      					 <h2 class="col-md-6"> Plazo del Credito </h2>
                                       					<h2 class="col-md-6" id="pagoRealizar" class="text-center text-success"> <?php echo round($data->plazo_solicitado,2); ?> Semanas</h2>
                                      					<input type="hidden" id="plazo_solicitado" name="plazo_solicitado" value="{{{ isset($data->plazo_solicitado ) ? $data->plazo_solicitado  : old('plazo_solicitado') }}}">
                                      				 </div>
                                      				</div>
                                      				<!-- Plazo_solicitado End -->

                                      				<div class="clear">
                                      					<p><br/></p>
                                      				</div>

                                      			</div>

                                      		</div>
                                      	</div>

                                      </div>
                                      </div>

                                    </div>
                                    <div class="wizard-pane" role="tabpanel">
                                      <div class="col-sm-12">
                                      	<div class="panel panel-default">
                                      		<div class="panel-heading">
                                      			Datos Generales del Cliente
                                      		</div>
                                      		<div class="panel-wrapper collapse in" aria-expanded="true">
                                      			<div class="panel-body">

                                      				<div class="row">

                                                <!-- CURP Start -->
                                      					<div class="col-md-3">
                                      					<div class="form-group curpfield">
                                      					     <label for="curp" class="control-label"> CURP </label> <span class="text-danger">*</span>
                                      					      <input type="text" class="form-control" id="curp" name="curp"
                                      					      value="{{{ isset($cliente->curp ) ? $cliente->nombre  : old('curp') }}}" maxlength="18" onchange="validarInput(this)">
                                                      <div class="form-control-feedback" id="resultado"></div>
                                                <div class="label label-danger">{{ $errors->first("curp") }}</div>
                                                          <input type="hidden" class="form-control" id="curpdat" name="curpdat" value="">
                                      					</div>
                                      					</div>
                                      					<!-- Nombre End -->

                                      					<!-- Nombre Start -->
                                      					<div class="col-md-3">
                                      					<div class="form-group">
                                      					<label for="nombre" class="control-label"> Nombre </label>
                                      					<input type="text" class="form-control" id="nombre" name="nombre"
                                      					value="{{{ isset($cliente->nombre ) ? $cliente->nombre  : old('nombre') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("nombre") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Nombre End -->

                                      					<!-- Paterno Start -->
                                      					<div class="col-md-3">
                                      					<div class="form-group">
                                      					<label for="paterno" class="control-label"> Apellido paterno </label>
                                      					<input type="text" class="form-control" id="paterno" name="paterno"
                                      					value="{{{ isset($cliente->paterno ) ? $cliente->paterno  : old('paterno') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("paterno") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Paterno End -->

                                      					<!-- Materno Start -->
                                      					<div class="col-md-3">
                                      					<div class="form-group">
                                      					<label for="materno" class="control-label">Apellido materno </label>
                                      					<input type="text" class="form-control" id="materno" name="materno"
                                      					value="{{{ isset($cliente->materno ) ? $cliente->materno  : old('materno') }}}" maxlength="150"
                                                onchange="validarNombrecompleto()">
                                      					<div class="label label-danger">{{ $errors->first("materno") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Materno End -->

                                      					<!-- Nacimiento Start -->
                                      					<div class="col-md-3" style="display:none" id="col_nacimiento">
                                      					<div class="form-group">
                                      					<label for="nacimiento" class="control-label">F. Nacimiento </label>
                                      					<input type="text" class="form-control dates" id="nacimiento" name="nacimiento" style="background:#FFF;" readonly
                                      					value="<?php echo date('d-m-Y',strtotime(date('Y-m-d')  . ' - 18 years' ))?>" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("nacimiento") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Nacimiento End -->

                                      					<!-- Telefono Start -->
                                      					<div class="col-md-3">
                                      					<div class="form-group">
                                      					<label for="telefono" class="control-label">Teléfono </label>
                                      					<input type="text" class="form-control" id="telefono" name="telefono"
                                      					value="{{{ isset($cliente->telefono ) ? $cliente->telefono  : old('telefono') }}}" maxlength="10" onchange="buscarTelefonoDuplicado(this)">
                                      					<div class="label label-danger">{{ $errors->first("telefono") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Telefono End -->

                                      					<!-- Celular Start -->
                                      					<div class="col-md-3">
                                      					<div class="form-group">
                                      					<label for="celular" class="control-label">Celular </label>
                                      					<input type="text" class="form-control" id="celular" name="celular"
                                      					value="{{{ isset($cliente->celular ) ? $cliente->celular  : old('celular') }}}"  maxlength="10" onchange="buscarTelefonoDuplicado(this)">
                                      					<div class="label label-danger">{{ $errors->first("celular") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Celular End -->


                                      					<!-- Celular Start -->
                                      					<div class="col-md-3">
                                      					<div class="form-group">
                                      					<label for="celular" class="control-label">Tel. Trabajo </label>
                                      					<input type="text" class="form-control" id="trabajo" name="trabajo"
                                      					value="{{{ isset($cliente->trabajo ) ? $cliente->trabajo  : old('trabajo') }}}"  maxlength="10" onchange="buscarTelefonoDuplicado(this)">
                                      					<div class="label label-danger">{{ $errors->first("trabajo") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Celular End -->

                                                <!-- Folio INE Start -->
                                      					<div class="col-md-3">
                                        					<div class="form-group">
                                          					<label for="celular" class="control-label">Folio I.N.E. </label>
                                          					<input type="text" class="form-control" id="folio_ine" name="folio_ine"
                                          					value="{{{ isset($data->folio_ine ) ? $data->folio_ine  : old('folio_ine') }}}"  maxlength="10">
                                          					<div class="label label-danger">{{ $errors->first("folio_ine") }}</div>
                                        					</div>
                                      					</div>
                                      					<!-- Folio INE End -->

                                      					<!-- Correo Start -->
                                      					<div class="col-md-4">
                                      					<div class="form-group">
                                      					<label for="correo" class="control-label">Correo </label>
                                      					<input type="email" class="form-control" id="correo" name="correo"
                                      					value="{{{ isset($cliente->correo ) ? $cliente->correo  : old('correo') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("correo") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Correo End -->

                                      					<!-- Correo Start -->
                                      					<div class="col-md-4">
                                      					<div class="form-group">
                                      					<label for="correo" class="control-label">Donde Trabaja </label>
                                      					<input type="text" class="form-control" id="trabaja" name="trabaja"
                                      					value="{{{ isset($cliente->trabaja ) ? $cliente->trabaja  : old('trabaja') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("trabaja") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Correo End -->

                                      					<!-- Correo Start -->
                                      					<div class="col-md-4">
                                      					<div class="form-group">
                                      					<label for="correo" class="control-label">Ocupacion </label>
                                      					<input type="text" class="form-control" id="ocupacion" name="ocupacion"
                                      					value="{{{ isset($cliente->ocupacion ) ? $cliente->ocupacion  : old('ocupacion') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("correo") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Correo End -->
                                      				</div>

                                      				<div class="row">
                                      					<!-- Calle Start -->
                                      					<div class="col-sm-12">
                                      					<div class="form-group">
                                      					<label for="calle" class="control-label"> Domicilio </label>
                                      					<input type="text" class="form-control" id="calle" name="calle"
                                      					value="{{{ isset($cliente->calle ) ? $cliente->calle  : old('calle') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("calle") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Calle End -->

                                      					<input type="hidden" class="form-control" id="latitud" name="latitud" value="{{{ isset($cliente->latitud ) ? $cliente->latitud  : old('latitud') }}}" maxlength="150">
                                      					<input type="hidden" class="form-control" id="longitud" name="longitud" value="{{{ isset($cliente->longitud ) ? $cliente->longitud  : old('longitud') }}}" maxlength="150">
                                      				</div>

                                      				<div class="row">

                                      					<div id="cteMap" class="map"></div>

                                      				</div>

                                      			</div>
                                      		</div>
                                      	</div>
                                      </div>
                                    </div>
                                    <div class="wizard-pane" role="tabpanel">
                                      <div class="row">
                                        <div class="col-sm-6">
                                      	<div class="panel panel-default">
                                      		<div class="panel-heading">
                                      			Primera Referencia del Cliente
                                      		</div>
                                      		<div class="panel-wrapper collapse in" aria-expanded="true">
                                      			<div class="panel-body">

                                      				<div class="row">

                                      					<!-- Nombre Start -->
                                      					<div class="col-md-12">
                                      						<div class="form-group">
                                      						<label for="nombre" class="control-label"> Nombre </label>
                                      						<input type="text" class="form-control" id="referencia1_nombre" name="referencia1_nombre"
                                      						value="{{{ isset($cliente->referencia1_nombre ) ? $cliente->referencia1_nombre  : old('referencia1_nombre') }}}" maxlength="150">
                                      						<div class="label label-danger">{{ $errors->first("referencia1_nombre") }}</div>
                                      						</div>
                                      					</div>
                                      					<!-- Nombre End -->

                                      					<!-- Paterno Start -->
                                      					<div class="col-md-6">
                                      						<div class="form-group">
                                      						<label for="paterno" class="control-label"> Parentesco </label>
                                      						<input type="text" class="form-control" id="referencia1_parentesco" name="referencia1_parentesco"
                                      						value="{{{ isset($cliente->referencia1_parentesco ) ? $cliente->referencia1_parentesco  : old('referencia1_parentesco') }}}" maxlength="150">
                                      						<div class="label label-danger">{{ $errors->first("referencia1_parentesco") }}</div>
                                      						</div>
                                      					</div>
                                      					<!-- Paterno End -->

                                      					<!-- Materno Start -->
                                      					<div class="col-md-6">
                                      					<div class="form-group">
                                      					<label for="materno" class="control-label">Celular </label>
                                      					<input type="text" class="form-control" id="referencia1_celular" name="referencia1_celular"
                                      					value="{{{ isset($cliente->referencia1_celular ) ? $cliente->referencia1_celular  : old('referencia1_celular') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("referencia1_celular") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Materno End -->

                                      					<!-- Materno Start -->
                                      					<div class="col-md-12">
                                      					<div class="form-group">
                                      					<label for="materno" class="control-label">Domicilio </label>
                                      					<input type="text" class="form-control" id="referencia1_domicilio" name="referencia1_domicilio"
                                      					value="{{{ isset($cliente->referencia1_domicilio ) ? $cliente->referencia1_domicilio  : old('referencia1_domicilio') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("referencia1_domicilio") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Materno End -->

                                      					<input type="hidden" class="form-control" id="referencia1_latitud" name="referencia1_latitud" value="{{{ isset($cliente->latitud ) ? $cliente->latitud  : old('latitud') }}}" maxlength="150">
                                      					<input type="hidden" class="form-control" id="referencia1_longitud" name="referencia1_longitud" value="{{{ isset($cliente->longitud ) ? $cliente->longitud  : old('longitud') }}}" maxlength="150">

                                      				</div>

                                      				<div class="row">

                                      					<div id="ref1Map" class="map"></div>

                                      				</div>

                                      			</div>
                                      		</div>
                                      	</div>
                                      </div>
                                        <div class="col-sm-6">
                                        <div class="panel panel-default">
                                          <div class="panel-heading">
                                            Segunda Referencia del Cliente
                                          </div>
                                          <div class="panel-wrapper collapse in" aria-expanded="true">
                                            <div class="panel-body">

                                              <div class="row">

                                                <!-- Nombre Start -->
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="nombre" class="control-label"> Nombre </label>
                                                <input type="text" class="form-control" id="referencia2_nombre" name="referencia2_nombre"
                                                value="{{{ isset($cliente->referencia2_nombre ) ? $cliente->referencia2_nombre  : old('referencia2_nombre') }}}" maxlength="150">
                                                <div class="label label-danger">{{ $errors->first("referencia2_nombre") }}</div>
                                                </div>
                                                </div>
                                                <!-- Nombre End -->

                                                <!-- Paterno Start -->
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="paterno" class="control-label"> Parentesco </label>
                                                <input type="text" class="form-control" id="referencia2_parentesco" name="referencia2_parentesco"
                                                value="{{{ isset($cliente->referencia2_parentesco ) ? $cliente->referencia2_parentesco  : old('referencia2_parentesco') }}}" maxlength="150">
                                                <div class="label label-danger">{{ $errors->first("referencia2_parentesco") }}</div>
                                                </div>
                                                </div>
                                                <!-- Paterno End -->


                                                <!-- Materno Start -->
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="materno" class="control-label">Celular </label>
                                                <input type="text" class="form-control" id="referencia2_celular" name="referencia2_celular"
                                                value="{{{ isset($cliente->referencia2_celular ) ? $cliente->referencia2_celular  : old('referencia2_celular') }}}" maxlength="150">
                                                <div class="label label-danger">{{ $errors->first("referencia2_celular") }}</div>
                                                </div>
                                                </div>
                                                <!-- Materno End -->

                                                <!-- Materno Start -->
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="materno" class="control-label">Domicilio </label>
                                                <input type="text" class="form-control" id="referencia2_domicilio" name="referencia2_domicilio"
                                                value="{{{ isset($cliente->referencia2_domicilio ) ? $cliente->referencia2_domicilio  : old('referencia2_domicilio') }}}" maxlength="150">
                                                <div class="label label-danger">{{ $errors->first("referencia2_domicilio") }}</div>
                                                </div>
                                                </div>
                                                <!-- Materno End -->

                                                <input type="hidden" class="form-control" id="referencia2_latitud" name="referencia2_latitud" value="{{{ isset($cliente->referencia2_latitud ) ? $cliente->referencia2_latitud  : old('referencia2_latitud') }}}" maxlength="150">
                                                <input type="hidden" class="form-control" id="referencia2_longitud" name="referencia2_longitud" value="{{{ isset($cliente->referencia2_longitud ) ? $cliente->referencia2_longitud  : old('referencia2_longitud') }}}" maxlength="150">

                                              </div>

                                              <div class="row">

                                                <div id="ref2Map" class="map"></div>

                                              </div>

                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                      </div>


                                      <div class="row">
                                        <div class="col-sm-6">
                                      	<div class="panel panel-default">
                                      		<div class="panel-heading">
                                      			Tercera Referencia del Cliente
                                      		</div>
                                      		<div class="panel-wrapper collapse in" aria-expanded="true">
                                      			<div class="panel-body">

                                      				<div class="row">
                                      					<!-- Nombre Start -->
                                      					<div class="col-md-12">
                                      					<div class="form-group">
                                      					<label for="nombre" class="control-label"> Nombre </label>
                                      					<input type="text" class="form-control" id="referencia3_nombre" name="referencia3_nombre"
                                      					value="{{{ isset($cliente->referencia3_nombre ) ? $cliente->referencia3_nombre  : old('referencia3_nombre') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("referencia2_nombre") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Nombre End -->

                                      					<!-- Paterno Start -->
                                      					<div class="col-md-6">
                                      					<div class="form-group">
                                      					<label for="paterno" class="control-label"> Parentesco </label>
                                      					<input type="text" class="form-control" id="referencia3_parentesco" name="referencia3_parentesco"
                                      					value="{{{ isset($cliente->referencia3_parentesco ) ? $cliente->referencia3_parentesco  : old('referencia3_parentesco') }}}" maxlength="150">
                                      					</div>
                                      					</div>
                                      					<!-- Paterno End -->

                                      					<!-- Materno Start -->
                                      					<div class="col-md-6">
                                      					<div class="form-group">
                                      					<label for="materno" class="control-label">Celular </label>
                                      					<input type="text" class="form-control" id="referencia3_celular" name="referencia3_celular"
                                      					value="{{{ isset($cliente->referencia3_celular ) ? $cliente->referencia3_celular  : old('referencia3_celular') }}}" maxlength="10">
                                      					</div>
                                      					</div>
                                      					<!-- Materno End -->

                                      					<!-- Materno Start -->
                                      					<div class="col-md-12">
                                      					<div class="form-group">
                                      					<label for="materno" class="control-label">Domicilio </label>
                                      					<input type="text" class="form-control" id="referencia3_domicilio" name="referencia3_domicilio"
                                      					value="{{{ isset($cliente->referencia3_domicilio ) ? $cliente->referencia3_domicilio  : old('referencia3_domicilio') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("referencia2_domicilio") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Materno End -->

                                      					<input type="hidden" class="form-control" id="referencia3_latitud" name="referencia3_latitud" value="{{{ isset($cliente->referencia3_latitud ) ? $cliente->referencia3_latitud  : old('referencia3_latitud') }}}" maxlength="150">
                                      					<input type="hidden" class="form-control" id="referencia3_longitud" name="referencia3_longitud" value="{{{ isset($cliente->referencia3_longitud ) ? $cliente->referencia3_longitud  : old('referencia3_longitud') }}}" maxlength="150">

                                      				</div>

                                      				<div class="row">

                                      					<div id="ref3Map" class="map"></div>

                                      				</div>

                                      			</div>
                                      		</div>
                                      	</div>
                                      </div>

                                        <div class="col-sm-6">
                                      	<div class="panel panel-default">
                                      		<div class="panel-heading">
                                      			Aval del Cliente
                                      		</div>
                                      		<div class="panel-wrapper collapse in" aria-expanded="true">
                                      			<div class="panel-body">

                                      				<div class="row">

                                      					<!-- Nombre Start -->
                                      					<div class="col-md-12">
                                      					<div class="form-group">
                                      					<label for="nombre" class="control-label"> Nombre </label>
                                      					<input type="text" class="form-control" id="fiador_nombre" name="fiador_nombre"
                                      					value="{{{ isset($cliente->nombre ) ? $cliente->fiador_nombre  : old('fiador_nombre') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("fiador_nombre") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Nombre End -->

                                      					<!-- Materno Start -->
                                      					<div class="col-md-6">
                                      						<div class="form-group">
                                      						<label for="materno" class="control-label">Telefono </label>
                                      						<input type="text" class="form-control" id="fiador_telefono" name="fiador_telefono"
                                      						value="{{{ isset($cliente->fiador_telefono ) ? $cliente->fiador_telefono  : old('fiador_telefono') }}}" maxlength="10">
                                      						<div class="label label-danger">{{ $errors->first("fiador_telefono") }}</div>
                                      						</div>
                                      					</div>
                                      					<!-- Materno End -->

                                      					<!-- Materno Start -->
                                      					<div class="col-md-6">
                                      					<div class="form-group">
                                      					<label for="materno" class="control-label">Celular </label>
                                      					<input type="text" class="form-control" id="fiador_celular" name="fiador_celular"
                                      					value="{{{ isset($cliente->fiador_celular ) ? $cliente->fiador_celular  : old('fiador_celular') }}}" maxlength="10">
                                      					<div class="label label-danger">{{ $errors->first("fiador_celular") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Materno End -->

                                      				</div>

                                      				<div class="row">

                                      					<!-- Calle Start -->
                                      					<div class="col-md-12">
                                      					<div class="form-group">
                                      					<label for="calle" class="control-label"> Domicilio </label>
                                      					<input type="text" class="form-control" id="fiador_calle" name="fiador_calle"
                                      					value="{{{ isset($cliente->fiador_calle ) ? $cliente->fiador_calle  : old('fiador_calle') }}}" maxlength="150">
                                      					<div class="label label-danger">{{ $errors->first("calle") }}</div>
                                      					</div>
                                      					</div>
                                      					<!-- Calle End -->

                                      					<input type="hidden" class="form-control" id="fiador_latitud" name="fiador_latitud" value="{{{ isset($cliente->fiador_latitud ) ? $cliente->fiador_latitud  : old('fiador_latitud') }}}" maxlength="150">
                                      					<input type="hidden" class="form-control" id="fiador_longitud" name="fiador_longitud" value="{{{ isset($cliente->fiador_longitud ) ? $cliente->fiador_longitud  : old('fiador_longitud') }}}" maxlength="150">

                                      				</div>

                                      				<div class="row">

                                      					<div id="avalMap" class="map"></div>

                                      				</div>

                                      			</div>

                                      		</div>
                                      	</div>
                                      </div>

                                      </div>
                                    </div>
                                    <div class="wizard-pane" role="tabpanel">
                                      <div class="col-sm-12">
                                      	<div class="panel panel-default">
                                      		<div class="panel-heading">
                                      			Expediente de Solicitud
                                      		</div>
                                      		<div class="panel-wrapper collapse in" aria-expanded="true">
                                      			<div class="panel-body">

                                      			   <div class="row" id="documentacion">

                                               </div>

                                      			</div>

                                      		</div>
                                      	</div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

<div class="col-sm-12">



</div>





@section('scripts')
<script>

  var valor_cobro = 0;
  var tipo_cobro  = 0;

  function valida () {

    if($('#asesor_id').val() == "") {

      swal({ title: "ERROR!!", text: 'Debe de seleccionar al supervisor asignado a esta solicitud', type: "error"});
      return false
    }

    if($('#agente_id').val() == "") {

      swal({ title: "ERROR!!", text: 'Debe de seleccionar al agente responsable de esta solicitud', type: "error"});
      return false
    }

    if($('#producto_id').val() == "") {

      swal({ title: "ERROR!!", text: 'Debe especificar el producto de credito a adquirir', type: "error"});
      return false
    }

    if($('#monto_solicitado').val()== "") {

      swal({ title: "ERROR!!", text: 'Debe especificar el monto de credito a otorgar', type: "error"});
      return false
    }

    if($('#pago_solicitado').val() == "") {

      swal({ title: "ERROR!!", text: 'Debe especificar el pago por periodo de credito', type: "error"});
      return false
    }


    if($('#nombre').val() == 0) {

      swal({ title: "ERROR!!", text: 'Debe de especificar el nombre o nombres del cliente', type: "error"});
      return false
    }

    if($('#pagerno').val() == 0) {

      swal({ title: "ERROR!!", text: 'Debe de especificar el apellido paterno del cliente', type: "error"});
      return false
    }

    if($('#materno').val() == 0) {

      swal({ title: "ERROR!!", text: 'Debe de especificar el apellido materno del cliente', type: "error"});
      return false
    }


    if($('#folio_ine').val() == 0) {

      swal({ title: "ERROR!!", text: 'Debe de especificar el folio INE del Cliente', type: "error"});
      return false
    }

    if($('#pago_solicitado').val() == 0) {

      swal({ title: "ERROR!!", text: 'El monto de pago por periodo no puede ser menor o igual a cero', type: "error"});
      return false
    }

    $('#formValidation').submit();

  }

  $('#asesor_id').on('change',function(){

    if($(this).val() != "") {

      //Traemos la informacion del producto
			$.ajax({
				url: "<?php echo url('admin/asesores/agentes/'); ?>/" +  $(this).val(),
				dataType: 'json',
				contentType: "application/json; charset=utf-8",
				success: function(json) {

					if(json['error'] == 0) {

            $('#agente_id').html(json['html']);

            <?php if($data->agente_id) { echo "$('#agente_id').val(" . $data->agente_id. ")"; }?>

					} else {

						//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
						swal({ title: "ERROR!!", text: json['msg'], type: "error"});

					}

				}

			});

		}

	});

	$('#cliente_id').on('change',function(){

		if($(this).val() ==  -1) {

			$('#newCustomer').fadeIn();
			$('#customList').fadeOut();

		} else {

			$('#customList').fadeIn();
			$('#newCustomer').fadeOut();
			$('#cliente_id').selectpicker('refresh');

		}

	});

	$('#producto_id').on('change',function(){

		if($(this).val() != "") {

      //Traemos la informacion del producto
			$.ajax({
				url: "<?php echo url('admin/productos/ajax/'); ?>/" +  $(this).val(),
				dataType: 'json',
				contentType: "application/json; charset=utf-8",
				success: function(json) {

					if(json['error'] == 0) {

						$('#interes_registro').val(json['data'].tasa_actual);

            if(json['data'].tipo_cobro == 1) {

              $('#pago_solicitado').val(json['data'].valor_cobro);
              $('.btn-save').fadeIn();

            } else if(json['data'].tipo_cobro == 2) {

              calculaPago();
              $('.btn-save').fadeIn();

            } else {

              swal({ title: "ERROR!!", text: 'El producto seleccionado no cuenta con metodo de pago definido,por favor corrija esta accion para continuar', type: "error"});
              $('.btn-save').fadeOut();
            }

            tipo_cobro  = json['data'].tipo_cobro;

            valor_cobro = json['data'].valor_cobro;

            $('#minimo').val(json['data'].credito_minimo);
            $('#maximo').val(json['data'].credito_maximo);

					} else {

						//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
						swal({ title: "ERROR!!", text: json['msg'], type: "error"});

					}

				}

			});

      <?php if($data->id) { ?>
        var url = "<?php echo url('admin/solicitudes/documentacion/'); ?>/" +  $(this).val() + "?solicitud_id=<?php echo $data->id; ?>";
      <?php } else { ?>
        var url = "<?php echo url('admin/solicitudes/documentacion/'); ?>/" +  $(this).val();
      <?php } ?>

      //Traemos los documentos propios del producto y para expediente general
      $.ajax({
				url: url,
				dataType: 'json',
				contentType: "application/json; charset=utf-8",
				success: function(json) {

					if(json['error'] == 0) {

					       $('#documentacion').html(json['html']);

                 $('.dropify').dropify();

					} else {

						//No se encontraron fontos, mandamos mensaje de error y apagamos el boton de guardar
						swal({ title: "ERROR!!", text: json['msg'], type: "error"});

					}

				}

			});
		}

	});

	$('#monto_solicitado').on('change',function(){

		if($(this).val() != "") {

      var minimo = parseFloat($('#minimo').val());
      var maximo = parseFloat($('#maximo').val());

			var intereses = parseFloat($('#interes_registro').val());

			var monto = parseFloat($(this).val());

			if(isNaN(intereses)) { intereses = 0; }

			if(isNaN(monto)) { monto = 0; }

			var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

			var total = parseFloat(monto) + parseFloat(interesCalculo);

			$('#interesesSolicitado').html('$ ' + interesCalculo.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

			$('#montoSolicitado').html('$ ' + monto.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

			$('#totalPagar').html('$ ' + total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

			$('#pago_id').trigger('change');

      //Validamos si el monto solicitado es menor al monto maximo
      if(monto > maximo) {

        $('#autorizado').val(0);
        $('#msgWarning').fadeIn();
        $('#msg').html('<p>ATENCION, La solicitud requiere autorizacion para ser dispersada, MOTIVO: Monto solicitado superior al monto maximo del producto</p>');

      } else {

        $('#autorizado').val(1);
        $('#msgWarning').fadeOut();
        $('#msg').html('');

      }

      calculaPago();

		}

	});

  function calculaPago() {

    var monto_solicitado = parseFloat($('#monto_solicitado').val());

    if(isNaN(monto_solicitado)) { monto_solicitado = 0; }

    if(monto_solicitado != 0) {

      if (tipo_cobro == 1) {

        $('#pago_solicitado').val(valor_cobro);

      } else {

        var caculado = monto_solicitado * (valor_cobro / 100);

        $('#pago_solicitado').val(caculado.toFixed(2));
      }
      calculaPlazo();
    }
  }

	$('#pago_solicitado').on('change',function(){
		calculaPlazo();
	});

	function resetea() {

		$('#customList').fadeIn();
		$('#newCustomer').fadeOut();
		$('#cliente_id').val("");
		$('#cliente_id').selectpicker('refresh');

	}

	function calculaPlazo() {

    var pago 				= parseFloat($('#pago_solicitado').val());

		var monto 			= parseFloat($('#monto_solicitado').val());

		var intereses 	= parseFloat($('#interes_registro').val());

		if(isNaN(intereses)) { intereses = 0; }

		if(isNaN(monto)) { monto = 0; }

		if(tipo_cobro) {

    } else {

    }
		var interesCalculo = parseFloat(monto) * (parseFloat(intereses) / 100);

		var total = parseFloat(monto) + parseFloat(interesCalculo);

		var plazo = total / pago;

		$('#interesesSolicitado').html('$ ' + interesCalculo.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		$('#plazo_solicitado').val(plazo.toFixed(0));

		$('#pagoRealizar').html(plazo.toFixed(0) + ' Semanas');

	}

	<?php if($data->cliente_id == -1)  { echo "$('#cliente_id').trigger('change');"; }?>

	<?php if($data->producto_id)  { echo "$('#producto_id').trigger('change');"; }?>

  <?php if($data->asesor_id)  { echo "$('#asesor_id').trigger('change');"; }?>

</script>

<script>

  var autocomplete;

	function initMap() {

		var geocoder = new google.maps.Geocoder();
		var myLatLng = {lat: <?= (isset($data->latitud) ? $data->latitud : '21.884445885085846')?>, lng: <?= (isset($data->longitud) ? $data->longitud : '-102.29212165869137')?>};

		/* INICIAN FUNCIONES, MAPA DEL CLIENTE */
			var cteMap = new google.maps.Map(document.getElementById('cteMap'), {
					zoom: 13,
					center: myLatLng
				});

			var markerCte = new google.maps.Marker({
					position: myLatLng,
					map: cteMap,
					draggable: true,
					title: '!'
			});


			cteMap.addListener('click',function(event) {
				updateMarker(event.latLng);
				geocodeLatLngCte(event.latLng,cteMap)
			});

			google.maps.event.addListener(markerCte, "dragend", function(event) {
				updateMarkerCte(event.latLng);
				geocodeLatLngCte(event.latLng,cteMap)
			});

			$('#calle').change(codeAddressCte);

			function updateMarkerCte(pos) {

				$("#latitud").val(pos.lat);
				$("#longitud").val(pos.lng);
				markerCte.setPosition(pos);

			}

			function codeAddressCte() {
				var address = document.getElementById('calle').value + " Aguascalientes Mexico";
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						cteMap.setCenter(results[0].geometry.location);

						updateMarkerCte(cteMap.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			//geocoder
			function geocodeLatLngCte(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#calle').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}

      // Create the autocomplete object, restricting the search predictions to
      // geographical location types.
      autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('calle'), {types: ['geocode']});

      // Avoid paying for data that you don't need by restricting the set of
      // place fields that are returned to just the address components.
      autocomplete.setFields(['address_component']);

      // When the user selects an address from the drop-down, populate the
      // address fields in the form.
      autocomplete.addListener('place_changed', codeAddressCte);

		/* TERMINAN FUNCIONES, MAPA DEL CLIENTE */


		/* INICIA FUNCIONES, MAPA DE LA PRIMERA REFERENCIA DEL CLIENTE */
			var ref1Map = new google.maps.Map(document.getElementById('ref1Map'), {
					zoom: 11,
					center: myLatLng
				});

			var markerRef1 = new google.maps.Marker({
					position: myLatLng,
					map: ref1Map,
					draggable: true,
					title: 'Direccion de Referencia'
			});

			ref1Map.addListener('click',function(event) {
				updateMarkerRef1(event.latLng);
				codeAddressRef1(event.latLng,ref1Map)
			});

			google.maps.event.addListener(markerRef1, "dragend", function(event) {
				updateMarkerRef1(event.latLng);
				geocodeLatLngRef1(event.latLng,ref1Map)
			});


			$('#referencia1_domicilio').change(codeAddressRef1);

			function updateMarkerRef1(pos) {

				$("#referencia1_latitud").val(pos.lat);
				$("#referencia1_longitud").val(pos.lng);
				markerRef1.setPosition(pos);

			}

			function codeAddressRef1() {
				var address = document.getElementById('referencia1_domicilio').value + " Aguascalientes Mexico";
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						ref1Map.setCenter(results[0].geometry.location);

						updateMarkerRef1(ref1Map.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngRef1(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#referencia1_domicilio').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}

      // Create the autocomplete object, restricting the search predictions to
      // geographical location types.
      autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('referencia1_domicilio'), {types: ['geocode']});

      // Avoid paying for data that you don't need by restricting the set of
      // place fields that are returned to just the address components.
      autocomplete.setFields(['address_component']);

      // When the user selects an address from the drop-down, populate the
      // address fields in the form.
      autocomplete.addListener('place_changed', codeAddressCte);
		/* TERMINAN FUNCIONES, MAPA DE LA PRIMERA REFERENCIA DEL CLIENTE */



		/* INICIA FUNCIONES, MAPA DE LA SEGUNDA REFERENCIA DEL CLIENTE */
			var ref2Map = new google.maps.Map(document.getElementById('ref2Map'), {
					zoom: 11,
					center: myLatLng
				});

			var markerRef2 = new google.maps.Marker({
					position: myLatLng,
					map: ref2Map,
					draggable: true,
					title: 'Direccion de Referencia'
			});

			ref2Map.addListener('click',function(event) {
				updateMarkerRef2(event.latLng);
				codeAddressRef2(event.latLng,ref2Map)
			});

			google.maps.event.addListener(markerRef2, "dragend", function(event) {
				updateMarkerRef2(event.latLng);
				geocodeLatLngRef2(event.latLng,ref2Map)
			});


			$('#referencia2_domicilio').change(codeAddressRef2);

			function updateMarkerRef2(pos) {

				$("#referencia2_latitud").val(pos.lat);
				$("#referencia2_longitud").val(pos.lng);
				markerRef2.setPosition(pos);

			}

			function codeAddressRef2() {
				var address = document.getElementById('referencia2_domicilio').value + " Aguascalientes Mexico";
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						ref2Map.setCenter(results[0].geometry.location);

						updateMarkerRef2(ref2Map.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngRef2(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#referencia2_domicilio').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}

      // Create the autocomplete object, restricting the search predictions to
      // geographical location types.
      autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('referencia2_domicilio'), {types: ['geocode']});

      // Avoid paying for data that you don't need by restricting the set of
      // place fields that are returned to just the address components.
      autocomplete.setFields(['address_component']);

      // When the user selects an address from the drop-down, populate the
      // address fields in the form.
      autocomplete.addListener('place_changed', codeAddressCte);
    /* TERMINAN FUNCIONES, MAPA DE LA SEGUNDA REFERENCIA DEL CLIENTE */


		/* INICIA FUNCIONES, MAPA DE LA TERCERA REFERENCIA DEL CLIENTE */
			var ref3Map = new google.maps.Map(document.getElementById('ref3Map'), {
					zoom: 11,
					center: myLatLng
				});

			var markerRef3 = new google.maps.Marker({
					position: myLatLng,
					map: ref3Map,
					draggable: true,
					title: 'Direccion de Referencia'
			});

			ref3Map.addListener('click',function(event) {
				updateMarkerRef3(event.latLng);
				codeAddressRef3(event.latLng,ref2Map)
			});

			google.maps.event.addListener(markerRef3, "dragend", function(event) {
				updateMarkerRef3(event.latLng);
				geocodeLatLngRef3(event.latLng,ref3Map)
			});


			$('#referencia3_domicilio').change(codeAddressRef3);

			function updateMarkerRef3(pos) {

				$("#referencia3_latitud").val(pos.lat);
				$("#referencia3_longitud").val(pos.lng);
				markerRef3.setPosition(pos);

			}

			function codeAddressRef3() {
				var address = document.getElementById('referencia3_domicilio').value + " Aguascalientes Mexico";
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						ref3Map.setCenter(results[0].geometry.location);

						updateMarkerRef3(ref3Map.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngRef3(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#referencia3_domicilio').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}

      // Create the autocomplete object, restricting the search predictions to
      // geographical location types.
      autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('referencia3_domicilio'), {types: ['geocode']});

      // Avoid paying for data that you don't need by restricting the set of
      // place fields that are returned to just the address components.
      autocomplete.setFields(['address_component']);

      // When the user selects an address from the drop-down, populate the
      // address fields in the form.
      autocomplete.addListener('place_changed', codeAddressCte);
    /* TERMINAN FUNCIONES, MAPA DE LA TERCERA REFERENCIA DEL CLIENTE */



		/* INICIA FUNCIONES, MAPA AVAL DEL CLIENTE */
			var avalMap = new google.maps.Map(document.getElementById('avalMap'), {
					zoom: 11,
					center: myLatLng
				});

			var markerAval = new google.maps.Marker({
					position: myLatLng,
					map: avalMap,
					draggable: true,
					title: 'Direccion del Aval'
			});

			avalMap.addListener('click',function(event) {
				updateMarkerAval(event.latLng);
				codeAddressAval(event.latLng,avalMap)
			});

			google.maps.event.addListener(markerAval, "dragend", function(event) {
				updateMarkerAval(event.latLng);
				geocodeLatLngAval(event.latLng,avalMap)
			});


			$('#fiador_calle').change(codeAddressAval);

			function updateMarkerAval(pos) {

				$("#fiador_latitud").val(pos.lat);
				$("#fiador_longitud").val(pos.lng);
				markerAval.setPosition(pos);

			}

			function codeAddressAval() {
				var address = document.getElementById('fiador_calle').value + " Aguascalientes Mexico";
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == 'OK') {

						avalMap.setCenter(results[0].geometry.location);

						updateMarkerAval(avalMap.getCenter());

					} else {
						//alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}

			function geocodeLatLngAval(pos, map) {

					geocoder.geocode({'location': pos}, function(results, status) {
						if (status === 'OK') {
							//console.log(results[0]);
							if (results[0]) {
								$('#fiador_calle').val(results[0].formatted_address);
							} else {
								window.alert('No results found');
							}
						} else {
							window.alert('Geocoder failed due to: ' + status);
						}
					});
			}

      // Create the autocomplete object, restricting the search predictions to
      // geographical location types.
      autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('fiador_calle'), {types: ['geocode']});

      // Avoid paying for data that you don't need by restricting the set of
      // place fields that are returned to just the address components.
      autocomplete.setFields(['address_component']);

      // When the user selects an address from the drop-down, populate the
      // address fields in the form.
      autocomplete.addListener('place_changed', codeAddressCte);
    /* TERMINAN FUNCIONES, MAPA AVAL DEL CLIENTE  */
}
    //Función para validar una CURP
    function curpValida(curp) {
        var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
            validado = curp.match(re);

        if (!validado)  //Coincide con el formato general?
          return false;

        //Validar que coincida el dígito verificador
        function digitoVerificador(curp17) {
            //Fuente https://consultas.curp.gob.mx/CurpSP/
            var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
                lngSuma      = 0.0,
                lngDigito    = 0.0;
            for(var i=0; i<17; i++)
                lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
            lngDigito = 10 - lngSuma % 10;
            if (lngDigito == 10) return 0;
            return lngDigito;
        }

        if (validado[2] != digitoVerificador(validado[1]))
          return false;

        return true; //Validado
    }


    //Handler para el evento cuando cambia el input
    //Lleva la CURP a mayúsculas para validarlo
    function validarInput(input) {
        var curp = input.value.toUpperCase(),
            resultado = $("#resultado"),
            valido = "No válido";
            //resultado.classList.add("callout-info");

        if (curpValida(curp)) { // ⬅️ Acá se comprueba
          valido = "Válido";
            resultado.addClass("callout-success");
            resultado.removeClass('form-control-danger');
            resultado.addClass('form-control-success');
            $('.curpfield').addClass('has-success');
            $('.curpfield').removeClass('has-danger');
            console.log(formatDate(curp2date(curp)));
            console.log(curpGenero(curp));
            getCURPInfo(curp);

        } else {
          //resultado.classList.remove("ok");
          resultado.addClass("form-control-danger");
          $('.curpfield').addClass('has-danger');
          $('.curpfield').removeClass('has-success');
          resultado.append('Formato no válido');
        }

        resultado.innerText = "Formato: " + valido;

    }

    function curp2date(curp) {
      var m = curp.match( /^\w{4}(\w{2})(\w{2})(\w{2})/ );
      //miFecha = new Date(año,mes,dia)
      var anyo = parseInt(m[1],10)+1900;
      if( anyo < 1950 ) anyo += 100;
      var mes = parseInt(m[2], 10)-1;
      var dia = parseInt(m[3], 10);
      return (new Date( anyo, mes, dia ));
    }

    function formatDate(date) {
      var d = new Date(date),
          month = '' + (d.getMonth() + 1),
          day = '' + d.getDate(),
          year = d.getFullYear();

      if (month.length < 2) month = '0' + month;
      if (day.length < 2) day = '0' + day;

      return [year, month, day].join('-');
  }

  function curpGenero(curp) {
    var m = curp;
    //miFecha = new Date(año,mes,dia)
    var genero = m.substr(10,1);
    return genero;
  }

function getCURPInfo(CURP) {
  var settings = {
	"async": true,
	"crossDomain": true,
	"url": "https://curp-renapo.p.rapidapi.com/v1/curp/"+CURP+"?options%5Brfc%5D=true",
	"method": "GET",
	"headers": {
		"x-rapidapi-host": "curp-renapo.p.rapidapi.com",
		"x-rapidapi-key": "fae0b7e29dmshc2c848e76ff2bf0p1d842djsn85e69edbe154"
	   }
  }

  $.ajax(settings).done(function (response) {
  	console.log(response);
    var birthdate = response.brithdate;
    var nombre = response.names;
    var apellido_p = response.paternal_surname;
    var apellido_m = response.mothers_maiden_name;
    var nacimiento = response.birthdate;
    var curp = response.curp;

    $("#curpdat").val(response);

    $("#nombre").val(nombre);
    $("#paterno").val(apellido_p);
    $("#materno").val(apellido_m);
    $("#col_nacimiento").show();
    $("#nacimiento").val(formatDate(curp2date(curp)));
    validarNombrecompleto();
  });

}

function validarNombrecompleto(){
  var nombre =  $("#nombre").val();
  var paterno = $("#paterno").val();
  var materno = $("#materno").val();

		if(!materno == '' && !paterno == '' && !nombre =='') {

      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      //Traemos la informacion del producto
			$.ajax({
				url: " {{url('/admin/solicitudes/verificarnombre')}}",
				dataType: 'json',
        type: "POST",
        data: {'nombre':nombre, 'paterno':paterno, 'materno':materno},
				success: function(json) {
          console.log(json);
					if(json['tipo']) {

            	swal({ title: "ERROR!!", text: json['mensaje'], type: "error"});

              $('.btn-save').fadeOut();
            } else {
                $('.btn-save').show();
            }

					}

				}); //AJAX END
      }//FIN DE LA VALIDACION DE NOMBRES

    }

    function buscarTelefonoDuplicado(campo) {
      var mitelefono = $(campo).val();

      if($(campo).val().length < 10) {
        alert("El teléfono debe tener 10 digitos. Ej. 666112233");
        return false;
    }

      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      //Buscar los telefonos duplicados
      $.ajax({
        url: " {{url('/admin/clientes/telefonos/duplicados')}}",
        dataType: 'json',
        type: "POST",
        data: {'telefono': mitelefono },
        success: function(json) {
          console.log(json);

          if(json['error'] ) {

              swal({ title: "ERROR!!", text: json['msg'], type: "error"});

              $('.btn-save').fadeOut();
            } else {
                $('.btn-save').show();
            }

          }

        }); //AJAX END

    }


</script>

<!-- src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key=AIzaSyBpZATF1F7TFEPCMxIx8nOPD0Ryi3V0BsE&callback=initMap" -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCv4GHAnI4evPz2WDIBoJ8YnEYU7DAyIPU&libraries=places&callback=initMap">
</script>

<!-- Form Wizard JavaScript -->
<script src="{{asset('themes/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js')}}"></script>
<!-- FormValidation -->
<link rel="stylesheet" href="{{asset('themes/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css')}}">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="{{asset('themes/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js')}}"></script>
<script src="{{asset('themes/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js')}}"></script>

<script type="text/javascript">

$('#exampleBasic2').wizard({

    /*
    onInit: function() {
        $('#validation').formValidation({
            framework: 'bootstrap',
            fields: {
              asesor_id: {
                validators: {
                  notEmpty: {
                    message: 'Es necesario seleccione el Asesor'
                  }
                }
              },
              agente_id: {
                validators: {
                  notEmpty: {
                    message: 'Es necesario seleccione un Agente'
                  }
                }
              },
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The username can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                },
                correo: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },

            }
        });
    },
    validator: function() {
        var fv = $('#validation').data('formValidation');

        var $this = $(this);

        // Validate the container
        fv.validateContainer($this);

        var isValidStep = fv.isValidContainer($this);
        if (isValidStep === false || isValidStep === null) {
            return false;
        }

        return true;
    },
    */
    onFinish: function() {
        $('#validation').submit();
        swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
    },
    templates: {
                buttons: function() {
                    var options = this.options;
                    return '<div class="panel-footer"><ul class="pager">' +
                        '<li class="previous">' +
                        '<a href="#' + this.id + '" data-wizard="back" role="button">Atras</a>' +
                        '</li>' +
                        '<li class="next">' +
                        '<a href="#' + this.id + '" data-wizard="next" role="button">Siguiente</a>' +
                        '<a href="#' + this.id + '" data-wizard="finish" role="button">Terminar</a>' +
                        '</li>' +
                        '</ul></div>';
                }
            },
});

</script>
@endsection
