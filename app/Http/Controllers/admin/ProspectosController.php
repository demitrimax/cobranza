<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospectos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class ProspectosController extends Controller
{
    public $v_fields=array('productos.descripcion', 'plazos.plazo', 'asesores.nombre', 'prospectos.monto', 'prospectos.nombre', 'prospectos.paterno', 'prospectos.materno', 'prospectos.telefono', 'prospectos.celular', 'prospectos.email', 'prospectos.pago_semanal', 'prospectos.ingresos_mensuales', 'prospectos.gastos_mensuales', 'prospectos.msr_rechazo', 'prospectos.fecha_alta', 'prospectos.fecha_rechazo', 'prospectos.status');
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
          $links[$value.'_link'] =url('/').'/admin/prospectos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/prospectos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/prospectos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $prospectos = new \App\admin\Prospectos;

        $config = array();

        $config['titulo'] = "prospectos";

        $config['cancelar'] = url('/admin/prospectos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de prospectos",
            'href' => url('/admin/prospectos'),
            'active' => false
        );

        $data = $prospectos->getProspectosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/prospectos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $prospectos = new \App\admin\Prospectos;

      $config = array();

      $config['titulo'] = "prospectos";

      $config['cancelar'] = url('/admin/prospectos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de prospectos",
          'href' => url('/admin/prospectos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar prospectos",
          'href' => url('/admin/prospectos/add'),
          'active' => true
      );

      $data = new $prospectos;

    	return view('admin/prospectos/add', ['config'=>$config,'data'=>$data, 'productos'=>$prospectos->getAll('productos'),'plazos'=>$prospectos->getAll('plazos'),'asesores'=>$prospectos->getAll('asesores')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'producto_id'=> 'required' ,
          	 'plazo_id'=> 'required' ,
          	 'monto'=> 'required' ,
          	 'nombre'=> 'required' ,
          	 'paterno'=> 'required' ,
          	 'materno'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'email'=> 'required' ,
          	 'pago_semanal'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $prospectos = new \App\admin\Prospectos;
        $prospectos->addProspectos($request);
        $request->session()->flash('message', 'prospectos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ProspectosController@index');
    }

    public function getEdit($id=''){

        $prospectos = new \App\admin\Prospectos;

        $users = $prospectos->getAll('prospectos');

        $data = $prospectos->getProspectos($id);

        $config = array();

        $config['titulo'] = "prospectos";

        $config['cancelar'] = url('/admin/prospectos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de prospectos",
            'href' => url('/admin/prospectos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar prospectos",
            'href' => url('/admin/prospectos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/prospectos/edit', ['data'=>$data, 'config'=>$config ,'productos'=>$prospectos->getAll('productos'),'plazos'=>$prospectos->getAll('plazos'),'asesores'=>$prospectos->getAll('asesores')]);
        } else{
          return view('admin/prospectos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'producto_id'=> 'required' ,
          	 'plazo_id'=> 'required' ,
          	 'monto'=> 'required' ,
          	 'nombre'=> 'required' ,
          	 'paterno'=> 'required' ,
          	 'materno'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'email'=> 'required' ,
          	 'pago_semanal'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $prospectos = new \App\admin\Prospectos;
        if($prospectos->updateProspectos($request)){
            $request->session()->flash('message', 'prospectos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ProspectosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ProspectosController@index');
        }
    }

    public function view($id){

      $prospectos = new \App\admin\Prospectos;

      $data = $prospectos->getProspectosView($id);

      $config = array();

      $config['titulo'] = "prospectos";

      $config['cancelar'] = url('/admin/prospectos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de prospectos",
          'href' => url('/admin/prospectos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de prospectos",
          'href' => url('/admin/prospectos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/prospectos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/prospectos/view');

      }

    }

    public function baja($id){

        $prospectos = new \App\admin\Prospectos;
        $flag = $prospectos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$prospectos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProspectosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProspectosController@index');
        }
    }

    public function alta($id){
        $prospectos = new \App\admin\Prospectos;
        $flag = $prospectos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$prospectos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProspectosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProspectosController@index');
        }
    }

    public function getAjax($id){

      $prospectos = new \App\admin\Prospectos;

      $data = $prospectos->getProspectosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function postRechazo($id,Request $request){

        $prospectos = new \App\admin\Prospectos;
        $flag = $prospectos->rechazaProspectos($id,$request->input('msg'));
        if($flag){
            Session::flash('message', 'Prospecto rechazado exitosamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProspectosController@index');
        } else{
            Session::flash('message', 'Ocurrió un problema, intente mas tarde');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProspectosController@index');
        }
    }

    public function postRecupera($id){
        $prospectos = new \App\admin\Prospectos;
        $flag = $prospectos->updateStatus($id,1);
        if($flag){
            Session::flash('message', 'Prospecto reactivado exitosamente');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProspectosController@index');
        } else{
            Session::flash('message', 'Ocurrió un problema, intente mas tarde');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProspectosController@index');
        }
    }
}
