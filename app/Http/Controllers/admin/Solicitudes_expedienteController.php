<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitudes_expediente;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Solicitudes_expedienteController extends Controller
{
    public $v_fields=array('solicitudes_expediente.solicitud_id', 'solicitudes_expediente.documento_id', 'solicitudes_expediente.carga_id', 'solicitudes_expediente.valida_id', 'solicitudes_expediente.aprobado', 'solicitudes_expediente.fecha_carga', 'solicitudes_expediente.fecha_validacion', 'solicitudes_expediente.fecha_emision', 'solicitudes_expediente.fecha_vencimiento', 'solicitudes_expediente.mime', 'solicitudes_expediente.archivo', 'solicitudes_expediente.comentario', 'solicitudes_expediente.status');
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
          $links[$value.'_link'] =url('/').'/admin/solicitudes_expediente?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/solicitudes_expediente/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/solicitudes_expediente/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $solicitudes_expediente = new \App\admin\Solicitudes_expediente;

        $config = array();

        $config['titulo'] = "solicitudes_expediente";

        $config['cancelar'] = url('/admin/solicitudes_expediente');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de solicitudes_expediente",
            'href' => url('/admin/solicitudes_expediente'),
            'active' => false
        );

        $data = $solicitudes_expediente->getSolicitudes_expedienteData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/solicitudes_expediente/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $solicitudes_expediente = new \App\admin\Solicitudes_expediente;

      $config = array();

      $config['titulo'] = "solicitudes_expediente";

      $config['cancelar'] = url('/admin/solicitudes_expediente');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes_expediente",
          'href' => url('/admin/solicitudes_expediente'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar solicitudes_expediente",
          'href' => url('/admin/solicitudes_expediente/add'),
          'active' => true
      );

      $data = new $solicitudes_expediente;

    	return view('admin/solicitudes_expediente/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $solicitudes_expediente = new \App\admin\Solicitudes_expediente;
        $solicitudes_expediente->addSolicitudes_expediente($request);
        $request->session()->flash('message', 'solicitudes_expediente Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Solicitudes_expedienteController@index');
    }

    public function getEdit($id=''){

        $solicitudes_expediente = new \App\admin\Solicitudes_expediente;

        $users = $solicitudes_expediente->getAll('solicitudes_expediente');

        $data = $solicitudes_expediente->getSolicitudes_expediente($id);

        $config = array();

        $config['titulo'] = "solicitudes_expediente";

        $config['cancelar'] = url('/admin/solicitudes_expediente');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de solicitudes_expediente",
            'href' => url('/admin/solicitudes_expediente'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar solicitudes_expediente",
            'href' => url('/admin/solicitudes_expediente/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/solicitudes_expediente/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/solicitudes_expediente/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $solicitudes_expediente = new \App\admin\Solicitudes_expediente;
        if($solicitudes_expediente->updateSolicitudes_expediente($request)){
            $request->session()->flash('message', 'solicitudes_expediente Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Solicitudes_expedienteController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Solicitudes_expedienteController@index');
        }
    }

    public function view($id){

      $solicitudes_expediente = new \App\admin\Solicitudes_expediente;

      $data = $solicitudes_expediente->getSolicitudes_expedienteView($id);

      $config = array();

      $config['titulo'] = "solicitudes_expediente";

      $config['cancelar'] = url('/admin/solicitudes_expediente');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes_expediente",
          'href' => url('/admin/solicitudes_expediente'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de solicitudes_expediente",
          'href' => url('/admin/solicitudes_expediente/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/solicitudes_expediente/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/solicitudes_expediente/view');

      }

    }

    public function baja($id){

        $solicitudes_expediente = new \App\admin\Solicitudes_expediente;
        $flag = $solicitudes_expediente->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$solicitudes_expediente deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Solicitudes_expedienteController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Solicitudes_expedienteController@index');
        }
    }

    public function alta($id){
        $solicitudes_expediente = new \App\admin\Solicitudes_expediente;
        $flag = $solicitudes_expediente->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$solicitudes_expediente habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Solicitudes_expedienteController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Solicitudes_expedienteController@index');
        }
    }

    public function getAjax($id){

      $solicitudes_expediente = new \App\admin\Solicitudes_expediente;

      $data = $solicitudes_expediente->getSolicitudes_expedienteView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
