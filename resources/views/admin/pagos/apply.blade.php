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
                <i class="fa fa-save fa-2x"></i><br/>Aplicar
              </button>
            </div>

            <div class="clear"></div>

          </div>

        </div>
        <!-- Terminan botones de Accion -->
      </div>


      <form action="<?php echo url('/'); ?>/admin/pagos/apply" id="formValidation" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">

          <!-- Inicia listado de registros -->
          <div class="col-sm-12">

            <div class="panel panel-default">
              <div class="panel-heading">Seleccione de Asesores y layouts</div>
              <div class="panel-wrapper collapse in">
                  <div class="panel-body">
                    <!-- Monto_solicitado Start -->
            				<div class="col-md-12">
            				 <div class="form-group">
            					 <select class="form-control" id="asesor_id" name="asesor_id">
            						 <option value="">---Seleccione el asesor---</option>
            						 <?php foreach($asesores as $value) { ?>
            							 <option value="<?php echo $value->id; ?>">
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
            					 <select class="form-control" id="layout_id" name="layout_id">
            						 <option value="">---Seleccione el layout---</option>
            					 </select>
            				 </div>
            				</div>
            				<!-- Monto_solicitado End -->
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
                            <th>Folio</th>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Saldo Actual</th>
                            <th>Pago x Periodo</th>
                            <th>Monto Pagado</th>
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

  var pasa = true;
  //Validamos si uno o mas campos estan vacios o en ceros
  $('.money').each(function(){
    var monto = parseFloat($(this).val());

    if(isNaN(monto)) {

      pasa=false;
      return;
    }

    if(monto <= 0) {

      pasa=false;
      return;
    }

  });

  if(!pasa) {
    swal({ title: "ATENCION!!", text: 'Uno o mas montos no han sido definidos o cuentan con valor cero, corrija eso y continue con el proceso', type: "warning"});
    return false;
  }


  $('#formValidation').submit();

});

$('#asesor_id').on('change',function(){

  if($(this).val() != "") {

    $.ajax({
      url: "<?php echo url('admin/pagos/traeLayouts/'); ?>/" +  $(this).val(),
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      success: function(json) {

        if(json['error'] == 0) {

          $('#layout_id').html(json['html']);

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

$('#layout_id').on('change',function(){

  if($(this).val() != "") {

    $.ajax({
      url: "<?php echo url('admin/pagos/traeCreditos/'); ?>/" +  $(this).val(),
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
