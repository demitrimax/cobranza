<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos_pagos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Productos_pagosController extends Controller
{
    public $v_fields=array('productos_pagos.id', 'productos_pagos.producto_id', 'productos_pagos.monto', 'productos_pagos.status');
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
          $links[$value.'_link'] =url('/').'/admin/productos_pagos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/productos_pagos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/productos_pagos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $productos_pagos = new \App\admin\Productos_pagos;

        $config = array();

        $config['titulo'] = "productos_pagos";

        $config['cancelar'] = url('/admin/productos_pagos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_pagos",
            'href' => url('/admin/productos_pagos'),
            'active' => false
        );

        $data = $productos_pagos->getProductos_pagosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/productos_pagos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $productos_pagos = new \App\admin\Productos_pagos;

      $config = array();

      $config['titulo'] = "productos_pagos";

      $config['cancelar'] = url('/admin/productos_pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_pagos",
          'href' => url('/admin/productos_pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar productos_pagos",
          'href' => url('/admin/productos_pagos/add'),
          'active' => true
      );

      $data = new $productos_pagos;

    	return view('admin/productos_pagos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_pagos = new \App\admin\Productos_pagos;
        $productos_pagos->addProductos_pagos($request);
        $request->session()->flash('message', 'productos_pagos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Productos_pagosController@index');
    }

    public function getEdit($id=''){

        $productos_pagos = new \App\admin\Productos_pagos;

        $users = $productos_pagos->getAll('productos_pagos');

        $data = $productos_pagos->getProductos_pagos($id);

        $config = array();

        $config['titulo'] = "productos_pagos";

        $config['cancelar'] = url('/admin/productos_pagos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_pagos",
            'href' => url('/admin/productos_pagos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar productos_pagos",
            'href' => url('/admin/productos_pagos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/productos_pagos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/productos_pagos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_pagos = new \App\admin\Productos_pagos;
        if($productos_pagos->updateProductos_pagos($request)){
            $request->session()->flash('message', 'productos_pagos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Productos_pagosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Productos_pagosController@index');
        }
    }

    public function view($id){

      $productos_pagos = new \App\admin\Productos_pagos;

      $data = $productos_pagos->getProductos_pagosView($id);

      $config = array();

      $config['titulo'] = "productos_pagos";

      $config['cancelar'] = url('/admin/productos_pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_pagos",
          'href' => url('/admin/productos_pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de productos_pagos",
          'href' => url('/admin/productos_pagos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/productos_pagos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/productos_pagos/view');

      }

    }

    public function baja($id){

        $productos_pagos = new \App\admin\Productos_pagos;
        $flag = $productos_pagos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$productos_pagos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_pagosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_pagosController@index');
        }
    }

    public function alta($id){
        $productos_pagos = new \App\admin\Productos_pagos;
        $flag = $productos_pagos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$productos_pagos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_pagosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_pagosController@index');
        }
    }

    public function getAjax($id){

      $productos_pagos = new \App\admin\Productos_pagos;

      $data = $productos_pagos->getProductos_pagosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
