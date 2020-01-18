<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Documentos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class DocumentosController extends Controller
{
    public $v_fields=array('productos.descripcion', 'documentos.nombre', 'documentos.requerido', 'documentos.status');
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
          $links[$value.'_link'] =url('/').'/admin/documentos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/documentos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/documentos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $documentos = new \App\admin\Documentos;

        $config = array();

        $config['titulo'] = "Catalogo de Documentos";

        $config['cancelar'] = url('/admin/documentos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de documentos",
            'href' => url('/admin/documentos'),
            'active' => false
        );

        $data = $documentos->getDocumentosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/documentos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $documentos = new \App\admin\Documentos;

      $config = array();

      $config['titulo'] = "Catalogo de Documentos";

      $config['cancelar'] = url('/admin/documentos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de documentos",
          'href' => url('/admin/documentos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar documento",
          'href' => url('/admin/documentos/add'),
          'active' => true
      );

      $data = new $documentos;

    	return view('admin/documentos/add', ['config'=>$config,'data'=>$data, 'productos'=>$documentos->getAll('productos')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'producto_id'=> 'required' ,
          	 'nombre'=> 'required' ,
          	 'requerido'=> 'required'
        ]);

        $documentos = new \App\admin\Documentos;
        $documentos->addDocumentos($request);
        $request->session()->flash('message', 'documentos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\DocumentosController@index');
    }

    public function getEdit($id=''){

        $documentos = new \App\admin\Documentos;

        $users = $documentos->getAll('documentos');

        $data = $documentos->getDocumentos($id);

        $config = array();

        $config['titulo'] = "Catalogo de Documentos";

        $config['cancelar'] = url('/admin/documentos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de documentos",
            'href' => url('/admin/documentos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar documento",
            'href' => url('/admin/documentos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/documentos/edit', ['data'=>$data, 'config'=>$config ,'productos'=>$documentos->getAll('productos')]);
        } else{
          return view('admin/documentos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'producto_id'=> 'required' ,
	 'nombre'=> 'required' ,
	 'requerido'=> 'required'
        ]);

        $documentos = new \App\admin\Documentos;
        if($documentos->updateDocumentos($request)){
            $request->session()->flash('message', 'documentos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\DocumentosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\DocumentosController@index');
        }
    }

    public function view($id){

      $documentos = new \App\admin\Documentos;

      $data = $documentos->getDocumentosView($id);

      $config = array();

      $config['titulo'] = "documentos";

      $config['cancelar'] = url('/admin/documentos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de documentos",
          'href' => url('/admin/documentos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de documentos",
          'href' => url('/admin/documentos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/documentos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/documentos/view');

      }

    }

    public function baja($id){

        $documentos = new \App\admin\Documentos;
        $flag = $documentos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$documentos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\DocumentosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\DocumentosController@index');
        }
    }

    public function alta($id){
        $documentos = new \App\admin\Documentos;
        $flag = $documentos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$documentos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\DocumentosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\DocumentosController@index');
        }
    }

    public function getAjax($id){

      $documentos = new \App\admin\Documentos;

      $data = $documentos->getDocumentosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
