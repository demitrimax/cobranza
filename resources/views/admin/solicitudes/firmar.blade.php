@extends('layouts.app')

@section('content')

<div id="page-wrapper">
  <div class="container-fluid">

      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
           @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
        </div>
        <!-- /.col-lg-12 -->
      </div>

      <form action="<?php echo url('/'); ?>/admin/solicitudes/firmar" id="formValidation" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="id" name="id" value="{{{ $data->id }}}" />

        <div class="row">

          <div class="col-sm-12">

            <div class="white-box">

                <div class="pull-left">
                  <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger btn-rounded">
                    <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cancelar
                  </a>
                </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-success btn-rounded">
                    <span class="btn-label"><i class="fa fa-check fa-lg"></i></span>Confirmar firma
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>

        </div>

        <div class="row">
          <div class="col-md-4 col-xs-12">
            <div class="white-box">
              <div class="user-btm-box">
                  <hr>
                  <!-- .row -->
                  <div class="row text-center m-t-10">
                    <div class="col-md-6"><strong>Cliente</strong>
                        <p>{{{ $cliente->nombre }}} {{{ $cliente->paterno }}} {{{ $cliente->materno }}}</p>
                    </div>
                      <div class="col-md-6"><strong>Teléfono</strong>
                          <p>{{{ $cliente->telefono }}}</p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

                  <!-- .row -->
                  <div class="row text-center m-t-10">
                    <div class="col-md-6"><strong>Celular</strong>
                        <p>{{{ $cliente->celular }}}</p>
                    </div>
                      <div class="col-md-6"><strong>Correo electrónico</strong>
                          <p>{{{ $cliente->correo }}}</p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

                  <!-- .row -->
                  <div class="row text-center m-t-10">
                    <div class="col-md-6"><strong>Banco:</strong>
                        <p>{{{ $cliente->banco }}}</p>
                    </div>
                      <div class="col-md-6"><strong>Clabe interbancaria</strong>
                          <p>{{{ $cliente->banco_clabe }}}</p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

                  <!-- .row -->
                  <div class="row text-center m-t-10">
                      <div class="col-md-12 b-r"><strong>Dirección</strong>
                          <p>
                            {{{ $cliente->calle }}} {{{ $cliente->colonia }}} <br/>
                            {{{ $cliente->ciudad }}} {{{ $cliente->estado }}}, {{{ $cliente->cp }}}
                          </p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>

              </div>
            </div>
          </div>

          <div class="col-md-8 col-xs-12">
              <div class="white-box">

                <div class="row">
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Monto aprobado</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($data->monto_aprobado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Pago aprobado</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ number_format($data->pago_aprobado,2,".",",") }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6 b-r"> <strong>Producto</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ $producto->descripcion }}}</strong></p>
                  </div>
                  <div class="col-md-3 col-xs-6"> <strong>Plazo a pagar</strong>
                      <br>
                      <p class="text-muted"><strong>{{{ round($data->plazo_aprobado,2) }}} Semanas</strong></p>
                  </div>
                </div>

                <hr>

                <div class="row">

                  <ul class="nav nav-tabs tabs customtab">
                    <li class="tab active">
                        <a href="#home" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Firma de contratos firmados</span> </a>
                    </li>
                    <li class="tab">
                        <a href="#biography" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Información de solicitud</span> </a>
                    </li>
                    <li class="tab">
                        <a href="#documents" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Documentos</span> </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <!-- .tabs 1 -->
                    <div class="tab-pane active" id="home">

                      <div class="row">

                        <div class="col-md-12">

                          <!-- Contratos_firmados Start -->
                  				<div class="col-md-12">
                  				 <div class="form-group">
                             <label for="monto_solicitado" class="control-label"> Contratos, <strong> firmados</strong> por el cliente</label>
                             <div class="input-group">
             									<?php if (isset($data->contratos_firmados) && $data->contratos_firmados!=""){ ?>
             										<span class="input-group-btn">
             											<a href="<?php echo str_replace('index.php','',url('/')) . '/uploads/' . $data->contratos_firmados; ?>" class="btn btn-info" target="_blank">
             												<li class="fa fa-download fa-lg"></li> Ver Archivo
             											</a>
             										</span>
             									<?php } else { ?>
             										<span class="input-group-addon" id="basic-addon1">No cargado</span>
             									<?php } ?>
             									<input type="file" class="form-control" id="contratos_firmados" name="contratos_firmados">
                              <input type="hidden" class="form-control" id="contratos_firmados_old" name="contratos_firmados_old" value="<?php echo $data->contratos_firmados; ?>">
             	              </div>
                            <span class="help-block">Cargue los contrtos <strong>YA FIRMADOS</strong> por el cliente</span>
                  				 </div>
                  				</div>
                  				<!-- Contratos_firmados End -->

                          <!-- Pagares_firmados Start -->
                  				<div class="col-md-12">
                  				 <div class="form-group">
                             <label for="monto_solicitado" class="control-label"> Pagaré, <strong> firmado</strong> por el cliente</label>
                             <div class="input-group">
             									<?php if (isset($data->pagares_firmados) && $data->pagares_firmados!=""){ ?>
             										<span class="input-group-btn">
             											<a href="<?php echo str_replace('index.php','',url('/')) . '/uploads/' . $data->pagares_firmados; ?>" class="btn btn-info" target="_blank">
             												<li class="fa fa-download fa-lg"></li> Ver Archivo
             											</a>
             										</span>
             									<?php } else { ?>
             										<span class="input-group-addon" id="basic-addon1">No cargado</span>
             									<?php } ?>
             									<input type="file" class="form-control" id="pagares_firmados" name="pagares_firmados">
                              <input type="hidden" class="form-control" id="pagares_firmados_old" name="pagares_firmados_old" value="<?php echo $data->pagares_firmados; ?>">
             	              </div>
                            <span class="help-block">Cargue los contratos <strong>YA FIRMADOS</strong> por el cliente</span>
                  				 </div>
                  				</div>
                  				<!-- Pagares_firmados End -->

                          <!-- Privacidad Start -->
                          <div class="col-md-12">
                           <div class="form-group">
                             <label for="monto_solicitado" class="control-label"> Aviso de privacidad, <strong> firmado</strong> por el cliente</label>
                             <div class="input-group">
                              <?php if (isset($data->aprivacidad_cliente) && $data->aprivacidad_cliente !=""){ ?>
                                <span class="input-group-btn">
                                  <a href="<?php echo str_replace('index.php','',url('/')) . '/uploads/' . $data->aprivacidad_cliente; ?>" class="btn btn-info" target="_blank">
                                    <li class="fa fa-download fa-lg"></li> Ver Archivo
                                  </a>
                                </span>
                              <?php } else { ?>
                                <span class="input-group-addon" id="basic-addon1">No cargado</span>
                              <?php } ?>
                              <input type="file" class="form-control" id="aprivacidadcliente_firmados" name="aprivacidadcliente_firmados">
                              <input type="hidden" class="form-control" id="aprivacidadcliente_firmados_old" name="aprivacidadcliente_firmados_old" value="<?php echo $data->pagares_firmados; ?>">
                            </div>
                            <span class="help-block">Cargue el aviso de privacidad <strong>YA FIRMADOS</strong> por el cliente</span>
                           </div>
                          </div>
                          <!-- Pagares_firmados End -->

                        <!-- Privacidad Start -->
                          <div class="col-md-12">
                           <div class="form-group">
                             <label for="monto_solicitado" class="control-label"> Aviso de privacidad, <strong> firmado</strong> por el aval</label>
                             <div class="input-group">
                              <?php if (isset($data->aprivacidad_aval) && $data->aprivacidad_aval !=""){ ?>
                                <span class="input-group-btn">
                                  <a href="<?php echo str_replace('index.php','',url('/')) . '/uploads/' . $data->aprivacidad_aval; ?>" class="btn btn-info" target="_blank">
                                    <li class="fa fa-download fa-lg"></li> Ver Archivo
                                  </a>
                                </span>
                              <?php } else { ?>
                                <span class="input-group-addon" id="basic-addon1">No cargado</span>
                              <?php } ?>
                              <input type="file" class="form-control" id="aprivacidadaval_firmados" name="aprivacidadaval_firmados">
                              <input type="hidden" class="form-control" id="aprivacidadaval_firmados_old" name="aprivacidadaval_firmados_old" value="<?php echo $data->pagares_firmados; ?>">
                            </div>
                            <span class="help-block">Cargue el aviso de privacidad <strong>YA FIRMADOS</strong> por el aval</span>
                           </div>
                          </div>
                          <!-- Pagares_firmados End -->

                        </div>

                      </div>

                    </div>
                    <!-- /.tabs1 -->
                    <!-- .tabs 2 -->
                    <div class="tab-pane" id="biography">

                      <h3>Informacion del Fiador</h3>

                      <table class="table">
                        <tr>
                          <td>Nombre</td>
                          <td><strong>{{{ $cliente->fiador_nombre }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Dirección</td>
                          <td><strong>{{{ $cliente->fiador_calle }}}</strong></td>
                        </tr>
                      </table>


                      <h3>Informacion Referencias</h3>

                      <table class="table">
                        <tr>
                          <td colspan="2"><strong>Primera Referencia</strong></td>
                        </tr>
                        <tr>
                          <td>Nombre</td>
                          <td><strong>{{{ $cliente->referencia1_nombre }}} <small> ({{{ $cliente->referencia1_parentesco }}}) </small> </strong></td>
                        </tr>
                        <tr>
                          <td>Celular</td>
                          <td><strong>{{{ $cliente->referencia1_celular }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Dirección</td>
                          <td><strong>{{{ $cliente->referencia1_direccion }}}</strong></td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>Segunda Referencia</strong></td>
                        </tr>
                        <tr>
                          <td>Nombre</td>
                          <td><strong>{{{ $cliente->referencia2_nombre }}} <small> ({{{ $cliente->referencia2_parentesco }}}) </small></strong></td>
                        </tr>
                        <tr>
                          <td>Celular</td>
                          <td><strong>{{{ $cliente->referencia2_celular }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Dirección</td>
                          <td><strong>{{{ $cliente->referencia2_direccion }}}</strong></td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>Tercera Referencia</strong></td>
                        </tr>
                        <tr>
                          <td>Nombre</td>
                          <td><strong>{{{ $cliente->referencia3_nombre }}} <small> ({{{ $cliente->referencia3_parentesco }}}) </small></strong></td>
                        </tr>
                        <tr>
                          <td>Celular</td>
                          <td><strong>{{{ $cliente->referencia3_celular }}}</strong></td>
                        </tr>
                        <tr>
                          <td>Dirección</td>
                          <td><strong>{{{ $cliente->referencia3_direccion }}}</strong></td>
                        </tr>

                      </table>


                    </div>
                    <!-- /.tabs2 -->

                    <!-- .tabs 2 -->
                    <div class="tab-pane" id="documents">
                        <div class="row">
                          <h4>Expediente de la solicitud</h4>
                        </div>
                        <hr>
                        <div class="row">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>Documento</th>
                                      <th width="20%">Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($documentos as $key => $documento) { ?>
                                  <?php
                                  $expediente = $documento->getExpediente($data->id);
                                  ?>
                                  <tr>
                                      <td><?= $documento->nombre ?></td>
                                      <td>
                                          <?php if (empty($expediente)) { ?>
                                          <div class="text-danger text-center"> DOCUMENTO NO CARGADO </div>
                                          <?php }else{ ?>
                                          <button type="button" class="btn btn-success btn-circle btn-modal-view-file" data-toggle="modal" data-expediente="<?= $expediente->id ?>" data-archivo="<?= $expediente->archivo ?>" data-target="#modalVistaDocumento">
                                              <i class="fa fa-image fa-lg" aria-hidden="true"></i>
                                          </button>
                                          <?php } ?>
                                      </td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                          </table>
                        </div>

                    </div>
                    <!-- /.tabs2 -->
                  </div>

                  <div class="col-md-12">
                    <br/>
                  </div>

                </div>

              </div>
          </div>

          <div class="col-md-12 col-xs-12">
              <div class="white-box">

                  <div class="row">
                    <div class="col-md-12">
                      <h3>Expediente digital <small> <i> Documentos cargados </i> </small></h3>
                    </div>
                  </div>
              </div>
          </div>

        </div>

      </div>
    </div>


  </div>
</div>
@endsection
