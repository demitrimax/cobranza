<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dispersion;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class DispersionController extends Controller
{
    public $v_fields=array('dispersion.id', 'dispersion.solicitud_id', 'dispersion.user_id', 'dispersion.fecha', 'dispersion.cuenta_origen', 'dispersion.cuenta_destino', 'dispersion.monto', 'dispersion.observaciones', 'dispersion.status');
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
          $links[$value.'_link'] =url('/').'/admin/dispersion?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/dispersion/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/dispersion/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $dispersion = new \App\admin\Dispersion;

        $config = array();

        $config['titulo'] = "dispersion";

        $config['cancelar'] = url('/admin/dispersion');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de dispersion",
            'href' => url('/admin/dispersion'),
            'active' => false
        );

        $data = $dispersion->getDispersionData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/dispersion/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $dispersion = new \App\admin\Dispersion;

      $config = array();

      $config['titulo'] = "dispersion";

      $config['cancelar'] = url('/admin/dispersion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de dispersion",
          'href' => url('/admin/dispersion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar dispersion",
          'href' => url('/admin/dispersion/add'),
          'active' => true
      );

      $data = new $dispersion;

    	return view('admin/dispersion/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $dispersion = new \App\admin\Dispersion;
        $dispersion->addDispersion($request);
        $request->session()->flash('message', 'dispersion Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\DispersionController@index');
    }

    public function getEdit($id=''){

        $dispersion = new \App\admin\Dispersion;

        $users = $dispersion->getAll('dispersion');

        $data = $dispersion->getDispersion($id);

        $config = array();

        $config['titulo'] = "dispersion";

        $config['cancelar'] = url('/admin/dispersion');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de dispersion",
            'href' => url('/admin/dispersion'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar dispersion",
            'href' => url('/admin/dispersion/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/dispersion/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/dispersion/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $dispersion = new \App\admin\Dispersion;
        if($dispersion->updateDispersion($request)){
            $request->session()->flash('message', 'dispersion Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\DispersionController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\DispersionController@index');
        }
    }

    public function view($id){

      $dispersion = new \App\admin\Dispersion;

      $data = $dispersion->getDispersionView($id);

      $config = array();

      $config['titulo'] = "dispersion";

      $config['cancelar'] = url('/admin/dispersion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de dispersion",
          'href' => url('/admin/dispersion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de dispersion",
          'href' => url('/admin/dispersion/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/dispersion/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/dispersion/view');

      }

    }

    public function baja($id){

        $dispersion = new \App\admin\Dispersion;
        $flag = $dispersion->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$dispersion deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\DispersionController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\DispersionController@index');
        }
    }

    public function alta($id){
        $dispersion = new \App\admin\Dispersion;
        $flag = $dispersion->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$dispersion habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\DispersionController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\DispersionController@index');
        }
    }

    public function getAjax($id){

      $dispersion = new \App\admin\Dispersion;

      $data = $dispersion->getDispersionView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
