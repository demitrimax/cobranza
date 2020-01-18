<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plazos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class PlazosController extends Controller
{
    public $v_fields=array('plazos.plazo', 'plazos.periodicidad', 'plazos.status');
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
          $links[$value.'_link'] =url('/').'/admin/plazos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/plazos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/plazos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $plazos = new \App\admin\Plazos;

        $config = array();

        $config['titulo'] = "plazos";

        $config['cancelar'] = url('/admin/plazos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de plazos",
            'href' => url('/admin/plazos'),
            'active' => false
        );

        $data = $plazos->getPlazosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/plazos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $plazos = new \App\admin\Plazos;

      $config = array();

      $config['titulo'] = "plazos";

      $config['cancelar'] = url('/admin/plazos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de plazos",
          'href' => url('/admin/plazos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar plazos",
          'href' => url('/admin/plazos/add'),
          'active' => true
      );

      $data = new $plazos;

    	return view('admin/plazos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'plazo'=> 'required' , 
	 'periodicidad'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $plazos = new \App\admin\Plazos;
        $plazos->addPlazos($request);
        $request->session()->flash('message', 'plazos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\PlazosController@index');
    }

    public function getEdit($id=''){

        $plazos = new \App\admin\Plazos;

        $users = $plazos->getAll('plazos');

        $data = $plazos->getPlazos($id);

        $config = array();

        $config['titulo'] = "plazos";

        $config['cancelar'] = url('/admin/plazos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de plazos",
            'href' => url('/admin/plazos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar plazos",
            'href' => url('/admin/plazos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/plazos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/plazos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'plazo'=> 'required' , 
	 'periodicidad'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $plazos = new \App\admin\Plazos;
        if($plazos->updatePlazos($request)){
            $request->session()->flash('message', 'plazos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\PlazosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\PlazosController@index');
        }
    }

    public function view($id){

      $plazos = new \App\admin\Plazos;

      $data = $plazos->getPlazosView($id);

      $config = array();

      $config['titulo'] = "plazos";

      $config['cancelar'] = url('/admin/plazos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de plazos",
          'href' => url('/admin/plazos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de plazos",
          'href' => url('/admin/plazos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/plazos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/plazos/view');

      }

    }

    public function baja($id){

        $plazos = new \App\admin\Plazos;
        $flag = $plazos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$plazos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PlazosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PlazosController@index');
        }
    }

    public function alta($id){
        $plazos = new \App\admin\Plazos;
        $flag = $plazos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$plazos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PlazosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PlazosController@index');
        }
    }

    public function getAjax($id){

      $plazos = new \App\admin\Plazos;

      $data = $plazos->getPlazosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
