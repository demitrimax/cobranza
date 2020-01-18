@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">

  <div class="container-fluid">

      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
        </div>
      </div>


      <div class="row">
        <!-- Inicia botones de Accion -->
        <div class="col-sm-12">

          <div class="white-box">

            <div class="pull-right">
              <button class="btn btn-info" id="btnSave" type="button">
                <i class="fa fa-save fa-2x"></i><br/>Generar
              </button>
            </div>

            <div class="clear"></div>

          </div>

        </div>
        <!-- Terminan botones de Accion -->
      </div>

      <?php if($sinAsesor[0]->sin_asesor > 0) { ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger"> ¡ ATENCION ! Uno o mas creditos no cuentan con asesor asignado </div>
          </div>
        </div>
      <?php } ?>

      <form action="<?php echo url('/'); ?>/admin/pagos/layout" id="formValidation" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">

          <!-- Inicia listado de registros -->
          <div class="col-sm-12">

            <div class="panel panel-default">
              <div class="panel-heading">Seleccione de Asesores</div>
              <div class="panel-wrapper collapse in">
                  <div class="panel-body">
                    <!-- Monto_solicitado Start -->
            				<div class="col-md-12">
            				 <div class="form-group">
            					 <select class="form-control" id="asesor_id" name="asesor_id">
            						 <option value="">---Seleccione---</option>
            						 <?php foreach($asesores as $value) { ?>
            							 <option value="<?php echo $value->id; ?>">
            								 <?php echo $value->nombre; ?>
            							 </option>
            						 <?php } ?>
            					 </select>
            				 </div>
            				</div>
            				<!-- Monto_solicitado End -->

                    <div class="col-md-12">
                      <label for="credito_id" class="control-label"> Descripcion o Alias del Archivo </label>
                     <div class="form-group">
                       <input class="form-control" name="alias" id="alias" value=""/>
                     </div>
                    </div>


                  </div>
              </div>
            </div>

          </div>
          <!-- Termina listado de registros -->

        </div>

        <div class="row">

          <!-- Inicia listado de registros -->
          <div class="col-sm-12" id="credit_view" style="display:none">

            <div class="panel panel-default">
              <div class="panel-heading">Seleccione de Asesores</div>
              <div class="panel-wrapper collapse in">
                  <div class="panel-body">

                      <table class="table">
                        <thead>
                          <tr>
                            <th><input type="checkbox" onclick="$('.select_all').attr('checked',this.checked)" /></th>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Saldo Actual</th>
                            <th>Cuota x Periodo</th>
                          </tr>
                        </thead>
                        <tbody id="table-view">
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>

          </div>
          <!-- Termina listado de registros -->

        </div>
      </form>
  </div>

</div>

<script>

var contador = 0;

function checador(valor){

  if(valor) {
    contador++;
  } else {
    contador = contador -1;
  }

};

$('#btnSave').on('click',function(){

  if($('#asesor_id').val() == "") {
    swal({ title: "ERROR!!", text: 'Debe seleccionar al asesor para visualizar sus asignados', type: "error"});
  }

  if(contador > 0) {

    $('#formValidation').submit();

  } else {

    swal({ title: "ERROR!!", text: 'Debe seleccionar al menos un credito para generar el registro de pagos', type: "error"});

  }

});

$('#asesor_id').on('change',function(){

  if($(this).val() != "") {

    $.ajax({
      url: "<?php echo url('admin/creditos/byAsesor/'); ?>/" +  $(this).val(),
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      success: function(json) {

        if(json['error'] == 0) {

          $('#table-view').html(json['html']);
          $('#credit_view').fadeIn();

        } else {

          $('#credit_view').fadeOut();
          swal({ title: "ERROR!!", text: json['msg'], type: "error"});

        }

      }

    });

  } else {

    swal({ title: "ERROR!!", text: 'Debe seleccionar un asesor para visualizar sus creditos asignados', type: "error"});

  }

});

</script>


@endsection
