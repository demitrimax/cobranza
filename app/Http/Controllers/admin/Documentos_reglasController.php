<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Documentos_reglas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Documentos_reglasController extends Controller
{
    public $v_fields=array('documentos_reglas.documento_id', 'documentos_reglas.regla', 'documentos_reglas.status');
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
          $links[$value.'_link'] =url('/').'/admin/documentos_reglas?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/documentos_reglas/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/documentos_reglas/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $documentos_reglas = new \App\admin\Documentos_reglas;

        $config = array();

        $config['titulo'] = "documentos_reglas";

        $config['cancelar'] = url('/admin/documentos_reglas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de documentos_reglas",
            'href' => url('/admin/documentos_reglas'),
            'active' => false
        );

        $data = $documentos_reglas->getDocumentos_reglasData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/documentos_reglas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $documentos_reglas = new \App\admin\Documentos_reglas;

      $config = array();

      $config['titulo'] = "documentos_reglas";

      $config['cancelar'] = url('/admin/documentos_reglas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de documentos_reglas",
          'href' => url('/admin/documentos_reglas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar documentos_reglas",
          'href' => url('/admin/documentos_reglas/add'),
          'active' => true
      );

      $data = new $documentos_reglas;

    	return view('admin/documentos_reglas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'documento_id'=> 'required' , 
	 'regla'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $documentos_reglas = new \App\admin\Documentos_reglas;
        $documentos_reglas->addDocumentos_reglas($request);
        $request->session()->flash('message', 'documentos_reglas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Documentos_reglasController@index');
    }

    public function getEdit($id=''){

        $documentos_reglas = new \App\admin\Documentos_reglas;

        $users = $documentos_reglas->getAll('documentos_reglas');

        $data = $documentos_reglas->getDocumentos_reglas($id);

        $config = array();

        $config['titulo'] = "documentos_reglas";

        $config['cancelar'] = url('/admin/documentos_reglas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de documentos_reglas",
            'href' => url('/admin/documentos_reglas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar documentos_reglas",
            'href' => url('/admin/documentos_reglas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/documentos_reglas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/documentos_reglas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'documento_id'=> 'required' , 
	 'regla'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $documentos_reglas = new \App\admin\Documentos_reglas;
        if($documentos_reglas->updateDocumentos_reglas($request)){
            $request->session()->flash('message', 'documentos_reglas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Documentos_reglasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Documentos_reglasController@index');
        }
    }

    public function view($id){

      $documentos_reglas = new \App\admin\Documentos_reglas;

      $data = $documentos_reglas->getDocumentos_reglasView($id);

      $config = array();

      $config['titulo'] = "documentos_reglas";

      $config['cancelar'] = url('/admin/documentos_reglas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de documentos_reglas",
          'href' => url('/admin/documentos_reglas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de documentos_reglas",
          'href' => url('/admin/documentos_reglas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/documentos_reglas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/documentos_reglas/view');

      }

    }

    public function baja($id){

        $documentos_reglas = new \App\admin\Documentos_reglas;
        $flag = $documentos_reglas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$documentos_reglas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Documentos_reglasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Documentos_reglasController@index');
        }
    }

    public function alta($id){
        $documentos_reglas = new \App\admin\Documentos_reglas;
        $flag = $documentos_reglas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$documentos_reglas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Documentos_reglasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Documentos_reglasController@index');
        }
    }

    public function getAjax($id){

      $documentos_reglas = new \App\admin\Documentos_reglas;

      $data = $documentos_reglas->getDocumentos_reglasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
