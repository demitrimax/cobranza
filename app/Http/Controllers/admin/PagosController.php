<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pagos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class PagosController extends Controller
{
    public $v_fields=array('creditos.cliente_id', 'pagos.fecha_pago', 'pagos.hora_pago', 'pagos.monto_pago', 'pagos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){
        $sortBy='';
        $order = '';
        $searchBy='';
        $searchValue='';

        // order
        if(isset($_GET['sortBy']) && in_array($_GET['sortBy'], $this->v_fields)){
            $sortBy=$_GET['sortBy'];
            $order = isset($_GET['order']) && $_GET['order']=='asc'?'asc':'desc';
            if(isset($_GET['order']) && $_GET['order']!=''){
                $_GET['order']=$_GET['order']=='asc'?'desc':'asc';
            } else{
                $_GET['order']='desc';
            }
        }

        // create links for field
        $get_q = $_GET;
        foreach ($this->v_fields as $key => $value) {
          $get_q['sortBy'] = $value;
          $get_q['page']=1;
          $query_result = http_build_query($get_q);
          $links[$value.'_link'] =url('/').'/admin/pagos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/pagos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/pagos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $pagos = new \App\admin\Pagos;

        $config = array();

        $config['titulo'] = "pagos";

        $config['cancelar'] = url('/admin/pagos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de pagos",
            'href' => url('/admin/pagos'),
            'active' => false
        );

        $data = $pagos->getPagosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/pagos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $pagos = new \App\admin\Pagos;

      $config = array();

      $config['titulo'] = "Aplicación de Pagos";

      $config['cancelar'] = url('/admin/pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pagos",
          'href' => url('/admin/pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Aplicar pagos",
          'href' => url('/admin/pagos/add'),
          'active' => true
      );

      $data = new $pagos;

      $creditos = $pagos->getActives();

    	return view('admin/pagos/add', ['config'=>$config,'data'=>$data, 'creditos'=>$creditos]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'credito_id'=> 'required'
        ]);

        $pagos    = new \App\admin\Pagos;
        $creditos = new \App\admin\Creditos;

        //Guardamos el registro de pago
        $pago_id = $pagos->addPagos($request);

        //Aplicamos el pago a las cuotas
        $data = array(

          'credito_id'  => $request->input('credito_id'),

          'monto_pago'  => $request->input('monto_pago'),

          'fecha_pago'  => $request->input('fecha_pago'),

        );

        $creditos->aplicaPago($data,$pago_id);

        $request->session()->flash('message', 'Pago aplicado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\PagosController@getAdd');
    }

    public function getAjax($id){

      $json = array();

      $data = \App\admin\Creditos_cuotas::select(array('clientes.nombre',
                                                       'clientes.paterno',
                                                       'clientes.materno',
                                                       'creditos_cuotas.*'
                                                      ))
                                        ->join('creditos','creditos.id','=','creditos_cuotas.credito_id')
                                        ->join('clientes','clientes.id','=','creditos.cliente_id')
                                        ->where('creditos_cuotas.id',$id)
                                        ->get();
      if(count($data)) {
        $json = array('error' => 0,'msg' => '','data' => $data[0]);
      } else {
        $json = array('error' => 1,'msg' => 'No se encontro la informacion solicitada,por favor contacte a su adminsitrador de sistemas');
      }

      return $json;
    }

    public function getGenerate() {

      $pagos = new \App\admin\Pagos;

      $config = array();

      $config['titulo'] = "Generar Layout de Pagos";

      $config['cancelar'] = url('/admin/pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pagos",
          'href' => url('/admin/pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Generar Layout",
          'href' => url('/admin/pagos/add'),
          'active' => true
      );

      $sinAsesor = DB::table('creditos')->select(DB::raw('count(*) as sin_asesor'))
                                        ->where('status',2)
                                        ->where('asesor_id',0)
                                        ->get();

      return view('admin/pagos/layout', ['config'=>$config,'asesores'=>$pagos->getAll('asesores'),'sinAsesor' => $sinAsesor]);

    }

    public function postGenerate(Request $request) {

      $pagos = new \App\admin\Pagos;

      $pagos->insertaLayout($request);

      $request->session()->flash('message', 'Archivo de cobros, creado exitosamente!');
      $request->session()->flash('exito', 'true');

      return redirect()->action('admin\PagosController@getGenerate');

    }

    public function getAplicar() {

      $pagos = new \App\admin\Pagos;

      $config = array();

      $config['titulo'] = "Generar Layout de Pagos";

      $config['cancelar'] = url('/admin/pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pagos",
          'href' => url('/admin/pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Generar Layout",
          'href' => url('/admin/pagos/add'),
          'active' => true
      );

      $sinAsesor = DB::table('creditos')->select(DB::raw('count(*) as sin_asesor'))
                                        ->where('status',2)
                                        ->where('asesor_id',0)
                                        ->get();

      return view('admin/pagos/apply', ['config'=>$config,'asesores'=>$pagos->getAll('asesores'),'sinAsesor' => $sinAsesor]);

    }

    public function getActiveLayouts($id) {

      $layouts = DB::table('layouts')->where('status',1)->get();

      if($layouts) {

        $html = '<option value=""> --- Seleccione un Archivo --- </option>';

        foreach ($layouts as $value) {
          $html .= '<option value="' . $value->id . '"> ' . $value->alias . ' ( ' . $value->fecha. ' )  </option>';
        }

        return array('error' => 0, 'msg' => '','html' => $html);

      } else {

        return array('error' => 1, 'msg' => 'No se encontaron archivos de cobranza para este asesor');

      }

    }

    public function getCreditosLayouts($id) {

      $layouts = DB::table('layouts_detalle')
                                             ->select(array('layouts_detalle.*',
                                                            'creditos.id AS folio' ,
                                                            'creditos.actual',
                                                            'creditos.pago',
                                                            'clientes.nombre',
                                                            'clientes.paterno',
                                                            'clientes.materno',
                                                            'clientes.calle',
                                                            'clientes.colonia',
                                                            'clientes.ciudad',
                                                            'clientes.estado',
                                                            'clientes.cp'
                                             ))
                                             ->join('creditos','creditos.id','layouts_detalle.credito_id')
                                             ->join('clientes','clientes.id','creditos.cliente_id')
                                             ->where('layouts_detalle.layout_id',$id)
                                             ->orderBy('layouts_detalle.credito_id','ASC')
                                             ->get();

      if($layouts) {

        $html = '';

        foreach ($layouts as $value) {
          $html .= '<tr>
                      <td> # ' . $value->folio . '</td>
                      <td>' . $value->nombre . ' ' . $value->paterno . ' ' . $value->materno . '</td>
                      <td>' . $value->calle . ' ' . $value->colonia . '</td>
                      <td> $ ' . number_format($value->actual,2,".",",") . '</td>
                      <td> $ ' . number_format($value->pago,2,".",",") . '</td>
                      <td>
                          <input type="hidden" class="form-control" name="creditos[' . $value->id. '][credito_id]" value="' . $value->folio . '" />
                          <input type="hidden" class="form-control" name="creditos[' . $value->id. '][pago]" value="' . $value->pago . '" />
                          <input type="text" class="form-control money" name="creditos[' . $value->id. '][monto]" value="" required="required" />
                      </td>
                    </tr>';
        }

        return array('error' => 0, 'msg' => '','html' => $html);

      } else {

        return array('error' => 1, 'msg' => 'No se encontaron archivos de cobranza para este asesor');

      }

    }

    public function applyLayout(Request $request) {

      $query = DB::table('layouts_detalle')
                                          ->select(DB::raw('count(*) as capturables'))
                                          ->where('layout_id',$request->input('layout_id'))
                                          ->get();

      $capturados = $query[0]->capturables;

      $existentes = 0;

      foreach($request->input('creditos') as $key => $creditos) {

        if($creditos['monto'] != "") {

          //Insertamos el pago
          $pago_id = DB::table('pagos')->insertGetId([

            'credito_id'    => $creditos['credito_id'],

            'layout_det_id' => $key,

            'fecha_pago'    => date('Y-m-d'),

            'hora_pago'     => date('H:i:s'),

            'monto_pago'    => $creditos['monto'],

            'status'      => 1,

          ]);

          //Comparamos si el monto pagado es igual o mayor al pago esperado
          if($creditos['monto'] >= $creditos['pago']) {

            //Cambiamos el statsus del detalle a pagado
            $pago_id = DB::table('layouts_detalle')
                                                   ->where('id',$key)
                                                   ->update([ 'pagado' => 1 ]);

          }

          $existentes++;

        }

      }

      //Cambiamos el status del layout a 2 para saldarlo
      $query = DB::table('layouts')
                                   ->where('id',$request->input('layout_id'))
                                   ->update([ 'status' => 2 ]);

     $request->session()->flash('message', 'Archivo de cobros, capturado exitosamente!');
     $request->session()->flash('exito', 'true');

     return redirect()->action('admin\PagosController@getAplicar');

    }

    public function getCancel(Request $request) {

      $pagos = new \App\admin\Pagos;

      $config = array();

      $config['titulo'] = "Cancelacion de Pagos";

      $config['cancelar'] = url('/admin/pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pagos",
          'href' => url('/admin/pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Cancelar pago",
          'href' => url('/admin/pagos/add'),
          'active' => true
      );

      $data = new $pagos;

      $creditos = $pagos->getActives();

    	return view('admin/pagos/cancel', ['config'=>$config,'data'=>$data, 'creditos'=>$creditos]);

    }

    public function postCancel(Request $request) {

      foreach($request->input('pagos') as $pago) {

        //Cancelamos el pago
        DB::table('pagos')
                          ->where('id',$pago)
                          ->update(['status' => 0]);

        //Reseteamos el pago en la tabla de cuotas
        DB::table('creditos_cuotas')
                                    ->where('pago_id',$pago)
                                    ->update([

                                      'pago_aplicado' => "0",

                                      'fecha_pago'    => null,

                                      'status'        => 1

                                    ]);
      }

      $request->session()->flash('message', 'Pago cancelado exitosamente!');
      $request->session()->flash('exito', 'true');

      return redirect()->action('admin\PagosController@getCancel');

    }

    public function getSearch(Request $request) {

      $multiple = 1;

      if($request->input('credito_id') != "") {

        //La busqueda es por numero de credito, solo regresaremos 1 registro
        $data = array();

        $multiple = 0;

        $html = '';

        $pagos = DB::table('pagos')
                                   ->select(array('pagos.*','clientes.nombre','clientes.paterno','clientes.materno'))
                                   ->join('creditos','creditos.id','pagos.credito_id')
                                   ->join('clientes','clientes.id','creditos.cliente_id')
                                   ->where('pagos.credito_id',$request->input('credito_id'))
                                   ->where('pagos.status',1)
                                   ->get();

         $html = '<table class="table display">
                   <thead>
                    <th></th>
                    <th>Cliente</th>
                    <th>F. Pago</th>
                    <th>Importe</th>
                   </thead>
                   <tbody>';

         foreach($pagos as $row) {
           $html .= ' <tr>';
            $html .= '<td><input class="form-control radios" style="height:20px !Important" type="checkbox" name="pagos[]" id="" value="' . $row->id . '" /></td>';
             $html .= '<td>' . $row->nombre . ' ' . $row->paterno . ' ' . $row->materno . '</td>';
             $html .= '<td>' . $row->fecha_pago . '</td>';
             $html .= '<td>$ ' . number_format($row->monto_pago,2,".",",") . '</td>';
           $html .= ' </tr>';
         }

         $html .= ' </tbody>
                  </table>';


      } else {

        //La busqueda es por nombre y apellidos, podems mandar mas de un registro a resultados

        $creditos = DB::table('creditos')->select(array('creditos.*' ,
                                                        'clientes.nombre',
                                                        'clientes.paterno',
                                                        'clientes.materno',
                                                        'clientes.calle',
                                                        'clientes.colonia',
                                                        'clientes.ciudad',
                                                        'clientes.estado',
                                                        'clientes.cp'))
                                         ->join('clientes','clientes.id','creditos.cliente_id')
                                         ->where('creditos.status',2);

        if($request->input('nombre')) {
          $creditos->where('clientes.nombre','LIKE','%' . $request->input('nombre'). '%');
        }

        if($request->input('paterno')) {
          $creditos->where('clientes.paterno','LIKE','%' . $request->input('paterno'). '%');
        }

        if($request->input('materno')) {
          $creditos->where('clientes.materno','LIKE','%' . $request->input('materno'). '%');
        }

        $rows = $creditos->get();

        if(count($rows) > 1) {

          $html = '<table class="table display">
                    <tbody>';

          foreach($rows as $row) {
            $html .= ' <tr>';
              $html .= '<td>Folio #: ' . $row->id. '</td>';
              $html .= '<td>' . $row->nombre . ' ' . $row->paterno . ' ' . $row->materno . '</td>';
              $html .= '<td> Saldo Actual: $' . number_format($row->actual,2,".",",") . '</td>';
              $html .= '<td><button class="btn btn-info" type="button" onclick="seleccionar(' . $row->id . ')"> Seleccionar </button></td>';
            $html .= ' </tr>';
          }

          $html .= ' </tbody>
                   </table>';

          $data = array();

          $multiple = 1;

        } else {

          $data = $rows[0];

          $multiple = 0;

        }


      }

      return array('multiple' => $multiple, 'html' => $html);
    }

    public function getCalendar() {


      $pagos = new \App\admin\Pagos;

      $config = array();

      $config['titulo'] = "Aplicación de Pagos";

      $config['cancelar'] = url('/admin/pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pagos",
          'href' => url('/admin/pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Aplicar pagos",
          'href' => url('/admin/pagos/add'),
          'active' => true
      );

      $data = \App\admin\Creditos_cuotas::select(array('clientes.nombre',
                                                       'clientes.paterno',
                                                       'clientes.materno',
                                                       'creditos_cuotas.amortizacion',
                                                       'creditos_cuotas.fecha_vence',
                                                       'creditos_cuotas.id'
                                                      ))
                                        ->join('creditos','creditos.id','=','creditos_cuotas.credito_id')
                                        ->join('clientes','clientes.id','=','creditos.cliente_id')
                                        ->get();



    	return view('admin/pagos/calendario', ['config'=>$config,'data'=>$data,]);

    }
}
