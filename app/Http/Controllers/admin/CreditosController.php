<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Creditos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class CreditosController extends Controller
{
    public $v_fields=array('creditos.fondeador_id', 'creditos.cliente_id', 'creditos.solicitud_id', 'creditos.supervisor_id', 'creditos.vendedor_id', 'creditos.folio', 'creditos.plazo', 'creditos.monto_fondeado', 'creditos.pago', 'creditos.interes', 'creditos.porcentaje', 'creditos.insoluto', 'creditos.actual', 'creditos.inicio', 'creditos.termino', 'creditos.vencida', 'creditos.dias_vencida', 'creditos.fech_ecv', 'creditos.recargos', 'creditos.puntaje', 'creditos.status',
                            'clientes.nombre', 'clientes.paterno', 'clientes.materno');
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
            $links[$value.'_link'] =url('/').'/admin/creditos?'.$query_result;
          }
          $links['csvlink'] = url('/').'/admin/creditos/export/csv?'.$_SERVER['QUERY_STRING'];
          $links['pdflink'] = url('/').'/admin/creditos/export/pdf?'.$_SERVER['QUERY_STRING'];

          // pagination per page
          $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

          // search value
          if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
              $searchBy=$_GET['searchBy'];
              $searchValue = $_GET['searchValue'];
          }

          // get by modal
          $creditos = new \App\admin\Creditos;

          $config = array();

          $config['titulo'] = "creditos";

          $config['cancelar'] = url('/admin/creditos');

          $config['breadcrumbs'][] = array(
              'text' => "Escritorio",
              'href' => url('/'),
              'active' => false
          );

          $config['breadcrumbs'][] = array(
              'text' => "Listado de créditos",
              'href' => url('/admin/creditos'),
              'active' => false
          );
          $searchFields = ['creditos.folio'=>'Folio', 'clientes.nombre' => 'Nombre Cliente', 'clientes.paterno'=>'a paterno Cliente', 'clientes.materno'=>'a materno Cliente' ];
          //dd($searchValue);
          $data = $creditos->getCreditosData($per_page, $searchBy, $searchValue, $sortBy, $order,2);

          return view('admin/creditos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config, 'sfields'=>$searchFields]);
    }

    public function pagados(Request $request){
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
          $links[$value.'_link'] =url('/').'/admin/creditos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/creditos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/creditos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $creditos = new \App\admin\Creditos;

        $config = array();

        $config['titulo'] = "creditos";

        $config['cancelar'] = url('/admin/creditos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de créditos",
            'href' => url('/admin/creditos'),
            'active' => false
        );

        $data = $creditos->getCreditosData($per_page, $searchBy, $searchValue, $sortBy, $order,4);

        return view('admin/creditos/pagados', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function vencidos(Request $request){
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
          $links[$value.'_link'] =url('/').'/admin/creditos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/creditos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/creditos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $creditos = new \App\admin\Creditos;

        $config = array();

        $config['titulo'] = "creditos";

        $config['cancelar'] = url('/admin/creditos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de créditos",
            'href' => url('/admin/creditos'),
            'active' => false
        );

        $data = $creditos->getCreditosData($per_page, $searchBy, $searchValue, $sortBy, $order,3);

        return view('admin/creditos/pagados', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }


    public function getAdd(Request $request){

      $creditos = new \App\admin\Creditos;

      $config = array();

      $config['titulo'] = "creditos";

      $config['cancelar'] = url('/admin/creditos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de creditos",
          'href' => url('/admin/creditos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar creditos",
          'href' => url('/admin/creditos/add'),
          'active' => true
      );

      $data = new $creditos;

    	return view('admin/creditos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $creditos = new \App\admin\Creditos;
        $creditos->addCreditos($request);
        $request->session()->flash('message', 'creditos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\CreditosController@index');
    }

    public function getEdit($id=''){

        $creditos = new \App\admin\Creditos;

        $users = $creditos->getAll('creditos');

        $data = $creditos->getCreditos($id);

        $config = array();

        $config['titulo'] = "creditos";

        $config['cancelar'] = url('/admin/creditos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de creditos",
            'href' => url('/admin/creditos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar creditos",
            'href' => url('/admin/creditos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/creditos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/creditos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $creditos = new \App\admin\Creditos;
        if($creditos->updateCreditos($request)){
            $request->session()->flash('message', 'creditos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\CreditosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\CreditosController@index');
        }
    }

    public function view($id){

      $creditos = new \App\admin\Creditos;

      $data = $creditos->getCreditosView($id);

      $config = array();

      $config['titulo'] = "creditos";

      $config['cancelar'] = url('/admin/creditos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado",
          'href' => url('/admin/creditos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalle",
          'href' => url('/admin/creditos/view'),
          'active' => true
      );

      if(count($data)){

        $cliente = \App\admin\Clientes::find($data->cliente_id);

        $solicitud = \App\admin\Solicitudes::find($data->solicitud_id);

        $producto = \App\admin\Productos::find($solicitud->producto_id);

        $user = \App\admin\Users::find($solicitud->captura_id);

        return view('admin/creditos/view', [
          'data'=>$data,

          'config'=>$config,

          'cliente' => $cliente,

          'producto' => $producto,

          'user' => $user,

          'solicitud' =>$solicitud,

          'transacciones' => $creditos->getTransacciones($id),

          'cuotas' => $creditos->getCuotas($id),

          'documentos' => \App\admin\Documentos::where('status', 1)->whereIn('producto_id',array(0,$solicitud->producto_id))->get()

         ]);

      } else{

        return view('admin/creditos/view');

      }

    }

    public function baja($id){

        $creditos = new \App\admin\Creditos;
        $flag = $creditos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$creditos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CreditosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CreditosController@index');
        }
    }

    public function alta($id){
        $creditos = new \App\admin\Creditos;
        $flag = $creditos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$creditos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CreditosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CreditosController@index');
        }
    }

    public function getAjax($id){

      $creditos = new \App\admin\Creditos;

      $data = $creditos->getCreditosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getSearch(Request $request) {

      $multiple = 1;

      if($request->input('credito_id') != "") {

        //La busqueda es por numero de credito, solo regresaremos 1 registro
        $data = array();

        $multiple = 0;

        $html = '';

        $creditos = new \App\admin\Creditos;

        $data = $creditos->getCreditos($request->input('credito_id'));

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

      return array('multiple' => $multiple, 'data' => $data, 'html' => $html);
    }

    public function getSeleccion($id) {

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
                                       ->where('creditos.status',2)
                                       ->where('creditos.id',$id)
                                       ->get();

      if($creditos) {
        return array('error' => 0, 'msg' => '','data' => $creditos[0]);
      } else {
        return array('error' => 1, 'msg' => 'Se ha producido un error, credito no encontrado en el sistema por favor consulte a su administrador de sistemas','data' => array());
      }

    }

    public function getByAsesor($id) {

      $creditos = DB::table('creditos')
                                       ->select(array('creditos.*' ,
                                                      'clientes.nombre',
                                                      'clientes.paterno',
                                                      'clientes.materno',
                                                      'clientes.calle',
                                                      'clientes.colonia',
                                                      'clientes.ciudad',
                                                      'clientes.estado',
                                                      'clientes.cp'))
                                       ->join('clientes','clientes.id','creditos.cliente_id')
                                       ->where('creditos.status',2)
                                       ->where('creditos.asesor_id',$id)
                                       ->get();

      $html = '';

      if($creditos) {

        foreach($creditos as $credito) {

          //Obtenemos las cuotas pendientes de pagar apartir de la fecha de hoy
          $html .= '<tr>
                      <td><input class="select_all" type="checkbox" value="' . $credito->id . '" name="creditos[]" onclick="checador(this.checked)" /></td>
                      <td>' . $credito->nombre . ' ' . $credito->paterno . ' ' . $credito->materno . '</td>
                      <td>' . $credito->calle . ' ' . $credito->colonia . ' ' . $credito->ciudad . ' ' . $credito->estado . ' Cp: ' . $credito->cp . '</td>
                      <td> $ ' . number_format($credito->actual,2,".",",") . '</td>
                      <td> $ ' . number_format($credito->pago,2,".",",") . '</td>
                    <tr>';
        }

        return array('error' => 0, 'msg' => '', 'html' => $html);

      } else {

        return array('error' => 1, 'msg' => 'No se encontraron creditos asignados para este asesor', 'html' => '');

      }

    }

}
