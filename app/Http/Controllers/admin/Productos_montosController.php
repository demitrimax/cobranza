<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos_montos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Productos_montosController extends Controller
{
    public $v_fields=array('productos_montos.id', 'productos_montos.producto_id', 'productos_montos.monto', 'productos_montos.status');
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
          $links[$value.'_link'] =url('/').'/admin/productos_montos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/productos_montos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/productos_montos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $productos_montos = new \App\admin\Productos_montos;

        $config = array();

        $config['titulo'] = "productos_montos";

        $config['cancelar'] = url('/admin/productos_montos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_montos",
            'href' => url('/admin/productos_montos'),
            'active' => false
        );

        $data = $productos_montos->getProductos_montosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/productos_montos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $productos_montos = new \App\admin\Productos_montos;

      $config = array();

      $config['titulo'] = "productos_montos";

      $config['cancelar'] = url('/admin/productos_montos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_montos",
          'href' => url('/admin/productos_montos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar productos_montos",
          'href' => url('/admin/productos_montos/add'),
          'active' => true
      );

      $data = new $productos_montos;

    	return view('admin/productos_montos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_montos = new \App\admin\Productos_montos;
        $productos_montos->addProductos_montos($request);
        $request->session()->flash('message', 'productos_montos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Productos_montosController@index');
    }

    public function getEdit($id=''){

        $productos_montos = new \App\admin\Productos_montos;

        $users = $productos_montos->getAll('productos_montos');

        $data = $productos_montos->getProductos_montos($id);

        $config = array();

        $config['titulo'] = "productos_montos";

        $config['cancelar'] = url('/admin/productos_montos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_montos",
            'href' => url('/admin/productos_montos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar productos_montos",
            'href' => url('/admin/productos_montos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/productos_montos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/productos_montos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_montos = new \App\admin\Productos_montos;
        if($productos_montos->updateProductos_montos($request)){
            $request->session()->flash('message', 'productos_montos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Productos_montosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Productos_montosController@index');
        }
    }

    public function view($id){

      $productos_montos = new \App\admin\Productos_montos;

      $data = $productos_montos->getProductos_montosView($id);

      $config = array();

      $config['titulo'] = "productos_montos";

      $config['cancelar'] = url('/admin/productos_montos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_montos",
          'href' => url('/admin/productos_montos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de productos_montos",
          'href' => url('/admin/productos_montos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/productos_montos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/productos_montos/view');

      }

    }

    public function baja($id){

        $productos_montos = new \App\admin\Productos_montos;
        $flag = $productos_montos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$productos_montos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_montosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_montosController@index');
        }
    }

    public function alta($id){
        $productos_montos = new \App\admin\Productos_montos;
        $flag = $productos_montos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$productos_montos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_montosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_montosController@index');
        }
    }

    public function getAjax($id){

      $productos_montos = new \App\admin\Productos_montos;

      $data = $productos_montos->getProductos_montosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
