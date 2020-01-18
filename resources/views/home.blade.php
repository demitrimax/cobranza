@extends('layouts.app')

@section('content')

  <div id="page-wrapper">
  <div class="container-fluid">

    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Escritorio</h4>
      </div>
    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="panel">
          <div class="panel-heading">Prospectaciones</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">

              <div class="row">

                <div id="bar-chart-prospectos"></div>
                <script>

                  // Morris bar chart
                  Morris.Bar({
                     element: 'bar-chart-prospectos',
                     data: [
                       {y: 'Total', a: <?php echo  (int)$prospectaciones['total']; ?>, b: null, c:null,d:null,e : null},
                       {y: 'Pendientes', a: null, b: <?php echo  (int)$prospectaciones['pendientes']; ?>, c:null,d:null,e : null},
                       {y: 'Rechazados', a: null, b: null, c: <?php echo  (int)$prospectaciones['rechazados']; ?>, d:null,e : null},
                       {y: 'Eliminados', a: null, b: null, c: null, d: <?php echo (int)$prospectaciones['eliminados']; ?>,e : null},
                       {y: 'Aprobados', a: null, b: null, c: null, d: null, e: <?php echo (int)$prospectaciones['clientes']; ?>},

                     ],
                     xkey: 'y',
                     ykeys: ['a','b','c','d','e'],
                     labels: ['Total', 'Pendientes', 'Rechazados','Eliminados','Aprobados'],
                     barColors:['#ab8ce4', '#03a9f3', '#fec107','#fb9678','#00c292'],
                     stacked: true,
                     hoverCallback: function (index, options, content, row) {
                       var finalContent = $(content);
                       var cpt = 0;

                       $.each(row, function (n, v) {
                         if (v == null) {
                           $(finalContent).eq(cpt).empty();
                         }
                         cpt++;
                       });

                       return finalContent;
                     }
                  });

                </script>

              </div>


            </div>

          </div>
        </div>

      </div>


      <div class="col-md-6">
        <div class="panel">
          <div class="panel-heading">Solicitudes</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">

              <div class="row">

                <div id="bar-chart-solicitudes"></div>
                <script>

                  // Morris bar chart
                  Morris.Bar({
                     element: 'bar-chart-solicitudes',
                     data: [
                       {y: 'Total', a: <?php echo  (int)$solicitar['total']; ?>, b: null, c:null,d:null,e : null},
                       {y: 'Pendientes', a: null, b: <?php echo  (int)$solicitar['pendientes']; ?>, c:null,d:null,e : null},
                       {y: 'En Proceso', a: null, b: null, c: <?php echo  (int)$solicitar['proceso']; ?>, d:null,e : null},
                       {y: 'P. Fondeo', a: null, b: null, c: null, d: <?php echo (int)$solicitar['no_fondeo']; ?>,e : null},
                       {y: 'Creditos', a: null, b: null, c: null, d: null,e : <?php echo (int)$solicitar['credito']; ?>},

                     ],
                     xkey: 'y',
                     ykeys: ['a','b','c','d','e'],
                     labels: ['Total', 'Pendientes','En Proceso','Pendiente de Fondeo','Creditos Activos'],
                     barColors:['#ab8ce4', '#fec107', '#03a9f3','#56c9d1','#00c292'],
                     stacked: true,
                     hoverCallback: function (index, options, content, row) {
                       var finalContent = $(content);
                       var cpt = 0;

                       $.each(row, function (n, v) {
                         if (v == null) {
                           $(finalContent).eq(cpt).empty();
                         }
                         cpt++;
                       });

                       return finalContent;
                     }
                  });

                </script>

              </div>


            </div>

          </div>
        </div>

      </div>

    </div>

    <div class="row">

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">Pendientes de Autorizacion</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">

              <table class="table display" >
                <thead>
                  <tr>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">F. Registro</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($pendientes as $autorizables) { ?>
                    <tr>
                      <th class="text-center"><?php echo $autorizables['folio']; ?></th>
                      <th class="text-center"><?php echo $autorizables['cliente']; ?></th>
                      <th class="text-center"><?php echo $autorizables['registro']; ?></th>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>

            </div>

          </div>
        </div>

      </div>

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">Pendientes de Fondeo</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">

              <table class="table display">
                <thead>
                  <tr>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">F. Registro</th>
                    <th class="text-center">F. Aprobación</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($fondeadobles as $fondeadoble) { ?>
                    <tr>
                      <th class="text-center"><?php echo $fondeadoble['folio']; ?></th>
                      <th class="text-center"><?php echo $fondeadoble['cliente']; ?></th>
                      <th class="text-center"><?php echo $fondeadoble['registro']; ?></th>
                      <th class="text-center"><?php echo $fondeadoble['aprobacion']; ?></th>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>

            </div>

          </div>
        </div>

      </div>

    </div>

    <div class="row">
      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">Cuotas por vencer</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="">

              <table class="table display">
                <thead>
                  <tr>
                    <td>Credito</td>
                    <td>Cuota</td>
                    <td>F. Vencimiento</td>
                    <td>T. Pagar</td>
                  </tr>
                </thead>
              </table>

            </div>

          </div>
        </div>

      </div>

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">Creditos en Mora</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="">

              <table class="table display">
                <thead>
                  <tr>
                    <td>Credito</td>
                    <td>Cuota</td>
                    <td>F. Vencimiento</td>
                    <td>Monto</td>
                    <td>Mora</td>
                    <td>T. Pagar</td>
                  </tr>
                </thead>
              </table>

            </div>

          </div>
        </div>

      </div>

    </div>

    <div class="row">
      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">Cartera Vencida</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="">

              <table class="table" id="creditosVencidosTable">
                <thead>
                  <tr>
                    <td>Credito</td>
                    <td>Cliente</td>
                    <td>D. Vencidas</td>
                  </tr>
                </thead>
              </table>

            </div>

          </div>
        </div>

      </div>

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">Cobranza Juridica</div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="">
              <table class="table " id="creditosCobranzaJuridicaTable">
                <thead>
                  <tr>
                    <td>Credito</td>
                    <td>Cliente</td>
                    <td>Juridico</td>
                    <td>D. Vencidas</td>
                  </tr>
                </thead>
              </table>

            </div>

          </div>
        </div>

      </div>

    </div>


  </div>

</div>





@endsection
