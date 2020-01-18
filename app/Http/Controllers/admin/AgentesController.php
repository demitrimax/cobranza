<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agentes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class AgentesController extends Controller
{
    public $v_fields=array('asesores.nombre', 'agentes.nombre', 'agentes.status');
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
          $links[$value.'_link'] =url('/').'/admin/agentes?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/agentes/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/agentes/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $agentes = new \App\admin\Agentes;

        $config = array();

        $config['titulo'] = "Catalgo de Agentes";

        $config['cancelar'] = url('/admin/agentes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de agentes",
            'href' => url('/admin/agentes'),
            'active' => false
        );

        $data = $agentes->getAgentesData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/agentes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $agentes = new \App\admin\Agentes;

      $config = array();

      $config['titulo'] = "Catalgo de Agentes";

      $config['cancelar'] = url('/admin/agentes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de agentes",
          'href' => url('/admin/agentes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar agente",
          'href' => url('/admin/agentes/add'),
          'active' => true
      );

      $data = new $agentes;

    	return view('admin/agentes/add', ['config'=>$config,'data'=>$data, 'asesores'=>$agentes->getAll('asesores')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'asesor_id'=> 'required' ,
          	 'nombre'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $agentes = new \App\admin\Agentes;
        $agentes->addAgentes($request);
        $request->session()->flash('message', 'agentes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\AgentesController@index');
    }

    public function getEdit($id=''){

        $agentes = new \App\admin\Agentes;

        $users = $agentes->getAll('agentes');

        $data = $agentes->getAgentes($id);

        $config = array();

        $config['titulo'] = "Catalgo de Agentes";

        $config['cancelar'] = url('/admin/agentes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de agentes",
            'href' => url('/admin/agentes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar agente",
            'href' => url('/admin/agentes/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/agentes/edit', ['data'=>$data, 'config'=>$config ,'asesores'=>$agentes->getAll('asesores')]);
        } else{
          return view('admin/agentes/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'asesor_id'=> 'required' ,
	 'nombre'=> 'required' ,
	 'status'=> 'required'
        ]);

        $agentes = new \App\admin\Agentes;
        if($agentes->updateAgentes($request)){
            $request->session()->flash('message', 'agentes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\AgentesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\AgentesController@index');
        }
    }

    public function view($id){

      $agentes = new \App\admin\Agentes;

      $data = $agentes->getAgentesView($id);

      $config = array();

      $config['titulo'] = "agentes";

      $config['cancelar'] = url('/admin/agentes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de agentes",
          'href' => url('/admin/agentes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de agentes",
          'href' => url('/admin/agentes/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/agentes/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/agentes/view');

      }

    }

    public function baja($id){

        $agentes = new \App\admin\Agentes;
        $flag = $agentes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$agentes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AgentesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AgentesController@index');
        }
    }

    public function alta($id){
        $agentes = new \App\admin\Agentes;
        $flag = $agentes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$agentes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AgentesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AgentesController@index');
        }
    }

    public function getAjax($id){

      $agentes = new \App\admin\Agentes;

      $data = $agentes->getAgentesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
