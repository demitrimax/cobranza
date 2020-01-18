<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Creditos_transacciones;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Creditos_transaccionesController extends Controller
{
    public $v_fields=array('creditos_transacciones.id', 'creditos_transacciones.credito_id', 'creditos_transacciones.cuota_id', 'creditos_transacciones.transaccion', 'creditos_transacciones.saldo_anterior', 'creditos_transacciones.cargo', 'creditos_transacciones.abono', 'creditos_transacciones.saldo_final', 'creditos_transacciones.fecha_transaccion', 'creditos_transacciones.status');
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
          $links[$value.'_link'] =url('/').'/admin/creditos_transacciones?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/creditos_transacciones/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/creditos_transacciones/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $creditos_transacciones = new \App\admin\Creditos_transacciones;

        $config = array();

        $config['titulo'] = "creditos_transacciones";

        $config['cancelar'] = url('/admin/creditos_transacciones');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de creditos_transacciones",
            'href' => url('/admin/creditos_transacciones'),
            'active' => false
        );

        $data = $creditos_transacciones->getCreditos_transaccionesData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/creditos_transacciones/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $creditos_transacciones = new \App\admin\Creditos_transacciones;

      $config = array();

      $config['titulo'] = "creditos_transacciones";

      $config['cancelar'] = url('/admin/creditos_transacciones');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de creditos_transacciones",
          'href' => url('/admin/creditos_transacciones'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar creditos_transacciones",
          'href' => url('/admin/creditos_transacciones/add'),
          'active' => true
      );

      $data = new $creditos_transacciones;

    	return view('admin/creditos_transacciones/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $creditos_transacciones = new \App\admin\Creditos_transacciones;
        $creditos_transacciones->addCreditos_transacciones($request);
        $request->session()->flash('message', 'creditos_transacciones Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Creditos_transaccionesController@index');
    }

    public function getEdit($id=''){

        $creditos_transacciones = new \App\admin\Creditos_transacciones;

        $users = $creditos_transacciones->getAll('creditos_transacciones');

        $data = $creditos_transacciones->getCreditos_transacciones($id);

        $config = array();

        $config['titulo'] = "creditos_transacciones";

        $config['cancelar'] = url('/admin/creditos_transacciones');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de creditos_transacciones",
            'href' => url('/admin/creditos_transacciones'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar creditos_transacciones",
            'href' => url('/admin/creditos_transacciones/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/creditos_transacciones/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/creditos_transacciones/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $creditos_transacciones = new \App\admin\Creditos_transacciones;
        if($creditos_transacciones->updateCreditos_transacciones($request)){
            $request->session()->flash('message', 'creditos_transacciones Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Creditos_transaccionesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_transaccionesController@index');
        }
    }

    public function view($id){

      $creditos_transacciones = new \App\admin\Creditos_transacciones;

      $data = $creditos_transacciones->getCreditos_transaccionesView($id);

      $config = array();

      $config['titulo'] = "creditos_transacciones";

      $config['cancelar'] = url('/admin/creditos_transacciones');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de creditos_transacciones",
          'href' => url('/admin/creditos_transacciones'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de creditos_transacciones",
          'href' => url('/admin/creditos_transacciones/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/creditos_transacciones/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/creditos_transacciones/view');

      }

    }

    public function baja($id){

        $creditos_transacciones = new \App\admin\Creditos_transacciones;
        $flag = $creditos_transacciones->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$creditos_transacciones deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Creditos_transaccionesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_transaccionesController@index');
        }
    }

    public function alta($id){
        $creditos_transacciones = new \App\admin\Creditos_transacciones;
        $flag = $creditos_transacciones->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$creditos_transacciones habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Creditos_transaccionesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_transaccionesController@index');
        }
    }

    public function getAjax($id){

      $creditos_transacciones = new \App\admin\Creditos_transacciones;

      $data = $creditos_transacciones->getCreditos_transaccionesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
