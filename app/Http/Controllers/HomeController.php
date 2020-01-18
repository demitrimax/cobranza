<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $url_movs = '/homeInfo';
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      $prospectos = new \App\admin\Prospectos;

      $conteo = $prospectos->cuentaProspectos();

      $prospectaciones = array(

        'total'         => 0,

        'pendientes'    => 0,

        'eliminados'    => 0,

        'rechazados'    => 0,

        'clientes'      => 0,

      );

      foreach($conteo as $contar) {

        $prospectaciones['total'] = $prospectaciones['total'] + $contar->total;

        if($contar->status == 1) {
          $prospectaciones['pendientes'] = $contar->total;
        }

        if($contar->status == 0) {
          $prospectaciones['eliminados'] = $contar->total;
        }

        if($contar->status == 3) {
          $prospectaciones['rechazados'] = $contar->total;
        }

        if($contar->status == 2) {
          $prospectaciones['clientes'] = $contar->total;
        }

      }

      $solicitudes = new \App\admin\Solicitudes;

      $contador = $solicitudes->cuentaSolicitudes();

      $solicitar = array(

        'total'       => 0,

        'proceso'     => 0,

        'pendientes'  => 0,

        'no_fondeo'   => 0,

        'credito'     => 0,

      );

      foreach($contador as $cuenta) {

        $solicitar['total'] = $solicitar['total'] + $cuenta->total;

        if($cuenta->etap_flujo == 1) {
          $solicitar['pendientes'] = $cuenta->total;
        }

        if($cuenta->etap_flujo > 1 && $cuenta->etap_flujo <= 5) {
          $solicitar['proceso'] = $cuenta->total;
        }

        if($cuenta->etap_flujo == 6) {
          $solicitar['no_fondeo'] = $cuenta->total;
        }

        if($cuenta->etap_flujo == 7) {
          $solicitar['credito'] = $cuenta->total;
        }

      }

      //Pendientes de autorizacion
      $query1 = \App\admin\Solicitudes::select(array('solicitudes.*' , 'clientes.nombre AS cteNombre' , 'clientes.paterno AS ctePaterno' , 'clientes.materno AS cteMaterno'))
                                         ->leftJoin('clientes', 'solicitudes.cliente_id', '=','clientes.id')
                                         ->where('solicitudes.status',1)
                                         ->where('solicitudes.etap_flujo','<','5');

      if(Auth::user()->fondeador_id != 0) {

        $query1->where('solicitudes.fondeador_id',Auth::user()->fondeador_id);

      }

      if(Auth::user()->vendedor_id != 0) {

        $query1->where('solicitudes.vendedor_id',Auth::user()->vendedor_id);

      }

      if(Auth::user()->supervisor_id != 0) {

        $query1->where('solicitudes.supervisor_id',Auth::user()->supervisor_id);

      }

      $sol_pend = $query1->get();

      $pendientes = array();

      foreach($sol_pend as $pend) {

        $pendientes[] = array(

          'folio'       => $pend->folio,

          'cliente'     => $pend->cteNombre . ' ' . $pend->ctePaterno . ' ' . $pend->cteMaterno,

          'registro'    => $pend->fecha_captura,

          'dias'        => $pend->fecha_captura,

        );

      }

      //Pendientes de fonde
      $query2 = \App\admin\Solicitudes::select(array('solicitudes.*' , 'clientes.nombre AS cteNombre' , 'clientes.paterno AS ctePaterno' , 'clientes.materno AS cteMaterno'))
                                         ->leftJoin('clientes', 'solicitudes.cliente_id', '=','clientes.id')
                                         ->whereIn('solicitudes.status', array(1,2))
                                         ->where('solicitudes.etap_flujo','=','6');

      if(Auth::user()->fondeador_id != 0) {

       $query2->where('solicitudes.fondeador_id',Auth::user()->fondeador_id);

      }

      if(Auth::user()->vendedor_id != 0) {

       $query2->where('solicitudes.vendedor_id',Auth::user()->vendedor_id);

      }

      if(Auth::user()->supervisor_id != 0) {

       $query2->where('solicitudes.supervisor_id',Auth::user()->supervisor_id);

      }

      $sol_fond = $query2->get();

      $fondeadobles = array();

      foreach($sol_fond as $fond) {

        $fondeadobles[] = array(

          'folio'       => $fond->folio,

          'cliente'     => $fond->cteNombre . ' ' . $fond->ctePaterno . ' ' . $fond->cteMaterno,

          'registro'    => $fond->fecha_captura,

          'aprobacion'  => $fond->fecha_firma,

          'dias'        => $fond->fecha_captura,

        );

      }

      //Cuotas por vender
       $query3= \App\admin\Creditos_cuotas::select(array('creditos_cuotas.*' ))
                                                       ->leftJoin('creditos', 'creditos.id', '=','creditos_cuotas.credito_id')
                                                       ->leftJoin('clientes', 'clientes.id', '=','creditos.cliente_id')
                                                       ->where('creditos_cuotas.status', 1);

      if(Auth::user()->fondeador_id != 0) {

        $query3->where('creditos.fondeador_id',Auth::user()->fondeador_id);

      }

      if(Auth::user()->vendedor_id != 0) {

        $query3->where('creditos.vendedor_id',Auth::user()->vendedor_id);

      }

      if(Auth::user()->supervisor_id != 0) {

        $query3->where('creditos.supervisor_id',Auth::user()->supervisor_id);

      }

      $cuotas_pend = $query3->get();


      return view('home', ['prospectaciones' => $prospectaciones, 'solicitar' => $solicitar,'pendientes' => $pendientes, 'fondeadobles' => $fondeadobles]);



    }

}
