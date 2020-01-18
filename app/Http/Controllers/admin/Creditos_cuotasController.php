<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Creditos_cuotas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Creditos_cuotasController extends Controller
{
    public $v_fields=array('creditos_cuotas.id', 'creditos_cuotas.credito_id', 'creditos_cuotas.pago_id', 'creditos_cuotas.saldo_actual', 'creditos_cuotas.amortizacion', 'creditos_cuotas.moratorios', 'creditos_cuotas.pago_aplicado', 'creditos_cuotas.saldo_final', 'creditos_cuotas.fecha_inicio', 'creditos_cuotas.fecha_vence', 'creditos_cuotas.fecha_pago', 'creditos_cuotas.puntaje', 'creditos_cuotas.status');
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
          $links[$value.'_link'] =url('/').'/admin/creditos_cuotas?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/creditos_cuotas/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/creditos_cuotas/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $creditos_cuotas = new \App\admin\Creditos_cuotas;

        $config = array();

        $config['titulo'] = "creditos_cuotas";

        $config['cancelar'] = url('/admin/creditos_cuotas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de creditos_cuotas",
            'href' => url('/admin/creditos_cuotas'),
            'active' => false
        );

        $data = $creditos_cuotas->getCreditos_cuotasData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/creditos_cuotas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $creditos_cuotas = new \App\admin\Creditos_cuotas;

      $config = array();

      $config['titulo'] = "creditos_cuotas";

      $config['cancelar'] = url('/admin/creditos_cuotas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de creditos_cuotas",
          'href' => url('/admin/creditos_cuotas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar creditos_cuotas",
          'href' => url('/admin/creditos_cuotas/add'),
          'active' => true
      );

      $data = new $creditos_cuotas;

    	return view('admin/creditos_cuotas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $creditos_cuotas = new \App\admin\Creditos_cuotas;
        $creditos_cuotas->addCreditos_cuotas($request);
        $request->session()->flash('message', 'creditos_cuotas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Creditos_cuotasController@index');
    }

    public function getEdit($id=''){

        $creditos_cuotas = new \App\admin\Creditos_cuotas;

        $users = $creditos_cuotas->getAll('creditos_cuotas');

        $data = $creditos_cuotas->getCreditos_cuotas($id);

        $config = array();

        $config['titulo'] = "creditos_cuotas";

        $config['cancelar'] = url('/admin/creditos_cuotas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de creditos_cuotas",
            'href' => url('/admin/creditos_cuotas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar creditos_cuotas",
            'href' => url('/admin/creditos_cuotas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/creditos_cuotas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/creditos_cuotas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $creditos_cuotas = new \App\admin\Creditos_cuotas;
        if($creditos_cuotas->updateCreditos_cuotas($request)){
            $request->session()->flash('message', 'creditos_cuotas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Creditos_cuotasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_cuotasController@index');
        }
    }

    public function view($id){

      $creditos_cuotas = new \App\admin\Creditos_cuotas;

      $data = $creditos_cuotas->getCreditos_cuotasView($id);

      $config = array();

      $config['titulo'] = "creditos_cuotas";

      $config['cancelar'] = url('/admin/creditos_cuotas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de creditos_cuotas",
          'href' => url('/admin/creditos_cuotas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de creditos_cuotas",
          'href' => url('/admin/creditos_cuotas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/creditos_cuotas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/creditos_cuotas/view');

      }

    }

    public function baja($id){

        $creditos_cuotas = new \App\admin\Creditos_cuotas;
        $flag = $creditos_cuotas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$creditos_cuotas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Creditos_cuotasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_cuotasController@index');
        }
    }

    public function alta($id){
        $creditos_cuotas = new \App\admin\Creditos_cuotas;
        $flag = $creditos_cuotas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$creditos_cuotas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Creditos_cuotasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_cuotasController@index');
        }
    }

    public function getAjax($id){

      $creditos_cuotas = new \App\admin\Creditos_cuotas;

      $data = $creditos_cuotas->getCreditos_cuotasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
