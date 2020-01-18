<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Creditos_pagos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Creditos_pagosController extends Controller
{
    public $v_fields=array('creditos_pagos.id', 'creditos_pagos.credito_id', 'creditos_pagos.captura_id', 'creditos_pagos.fecha_pago', 'creditos_pagos.fecha_captura', 'creditos_pagos.monto', 'creditos_pagos.capital', 'creditos_pagos.interes', 'creditos_pagos.voucher', 'creditos_pagos.recargos', 'creditos_pagos.status');
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
          $links[$value.'_link'] =url('/').'/admin/creditos_pagos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/creditos_pagos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/creditos_pagos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $creditos_pagos = new \App\admin\Creditos_pagos;

        $config = array();

        $config['titulo'] = "creditos_pagos";

        $config['cancelar'] = url('/admin/creditos_pagos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de creditos_pagos",
            'href' => url('/admin/creditos_pagos'),
            'active' => false
        );

        $data = $creditos_pagos->getCreditos_pagosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/creditos_pagos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $creditos_pagos = new \App\admin\Creditos_pagos;

      $config = array();

      $config['titulo'] = "creditos_pagos";

      $config['cancelar'] = url('/admin/creditos_pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de creditos_pagos",
          'href' => url('/admin/creditos_pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar creditos_pagos",
          'href' => url('/admin/creditos_pagos/add'),
          'active' => true
      );

      $data = new $creditos_pagos;

    	return view('admin/creditos_pagos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $creditos_pagos = new \App\admin\Creditos_pagos;
        $creditos_pagos->addCreditos_pagos($request);
        $request->session()->flash('message', 'creditos_pagos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Creditos_pagosController@index');
    }

    public function getEdit($id=''){

        $creditos_pagos = new \App\admin\Creditos_pagos;

        $users = $creditos_pagos->getAll('creditos_pagos');

        $data = $creditos_pagos->getCreditos_pagos($id);

        $config = array();

        $config['titulo'] = "creditos_pagos";

        $config['cancelar'] = url('/admin/creditos_pagos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de creditos_pagos",
            'href' => url('/admin/creditos_pagos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar creditos_pagos",
            'href' => url('/admin/creditos_pagos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/creditos_pagos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/creditos_pagos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $creditos_pagos = new \App\admin\Creditos_pagos;
        if($creditos_pagos->updateCreditos_pagos($request)){
            $request->session()->flash('message', 'creditos_pagos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Creditos_pagosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_pagosController@index');
        }
    }

    public function view($id){

      $creditos_pagos = new \App\admin\Creditos_pagos;

      $data = $creditos_pagos->getCreditos_pagosView($id);

      $config = array();

      $config['titulo'] = "creditos_pagos";

      $config['cancelar'] = url('/admin/creditos_pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de creditos_pagos",
          'href' => url('/admin/creditos_pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de creditos_pagos",
          'href' => url('/admin/creditos_pagos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/creditos_pagos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/creditos_pagos/view');

      }

    }

    public function baja($id){

        $creditos_pagos = new \App\admin\Creditos_pagos;
        $flag = $creditos_pagos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$creditos_pagos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Creditos_pagosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_pagosController@index');
        }
    }

    public function alta($id){
        $creditos_pagos = new \App\admin\Creditos_pagos;
        $flag = $creditos_pagos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$creditos_pagos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Creditos_pagosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Creditos_pagosController@index');
        }
    }

    public function getAjax($id){

      $creditos_pagos = new \App\admin\Creditos_pagos;

      $data = $creditos_pagos->getCreditos_pagosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
