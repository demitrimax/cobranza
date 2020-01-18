<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class ClientesController extends Controller
{
    public $v_fields=array('clientes.curp', 'clientes.nombre', 'clientes.paterno', 'clientes.materno', 'clientes.nacimiento', 'clientes.telefono', 'clientes.celular', 'clientes.trabajo', 'clientes.correo', 'clientes.calle', 'clientes.colonia', 'clientes.ciudad', 'clientes.estado', 'clientes.cp', 'clientes.ocupacion', 'clientes.trabaja', 'clientes.ingreso_mensual', 'clientes.ingreso_extra', 'clientes.gasto_mensual', 'clientes.fiador_nombre', 'clientes.fiador_telefono', 'clientes.fiador_celular', 'clientes.fiador_trabajo', 'clientes.fiador_calle', 'clientes.fiador_colonia', 'clientes.fiador_ciudad', 'clientes.fiador_estado', 'clientes.fiador_cp', 'clientes.fiador_latitud', 'clientes.fiador_longitud', 'clientes.referencia1_nombre', 'clientes.referencia1_parentesco', 'clientes.referencia1_celular', 'clientes.referencia1_domicilio', 'clientes.referencia1_latitud', 'clientes.referencia1_longitud', 'clientes.referencia2_nombre', 'clientes.referencia2_parentesco', 'clientes.referencia2_celular', 'clientes.referencia2_domicilio', 'clientes.referencia2_latitud', 'clientes.referencia2_longitud', 'clientes.referencia3_nombre', 'clientes.referencia3_parentesco', 'clientes.referencia3_celular', 'clientes.referencia3_domicilio', 'clientes.referencia3_latitud', 'clientes.referencia3_longitud', 'clientes.latitud', 'clientes.longitud', 'clientes.status');
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
          $links[$value.'_link'] =url('/').'/admin/clientes?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/clientes/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/clientes/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }


        // get by modal
        $clientes = new \App\admin\Clientes;

        $config = array();

        $config['titulo'] = "Catalogo de Clientes";

        $config['cancelar'] = url('/admin/clientes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de clientes",
            'href' => url('/admin/clientes'),
            'active' => false
        );

        $data = $clientes->getClientesData($per_page, $searchBy, $searchValue, $sortBy, $order);
        //dd($data);

        return view('admin/clientes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $clientes = new \App\admin\Clientes;

      $config = array();

      $config['titulo'] = "Catalogo de Clientes";

      $config['cancelar'] = url('/admin/clientes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de clientes",
          'href' => url('/admin/clientes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar cliente",
          'href' => url('/admin/clientes/add'),
          'active' => true
      );

      $data = new $clientes;

    	return view('admin/clientes/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
          	 'paterno'=> 'required' ,
          	 'materno'=> 'required' ,
             'curp'   => 'required' ,
        ]);

        $clientes = new \App\admin\Clientes;
        $clientes->addClientes($request);
        $request->session()->flash('message', 'clientes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ClientesController@index');
    }

    public function getEdit($id=''){

        $clientes = new \App\admin\Clientes;

        $users = $clientes->getAll('clientes');

        $data = $clientes->getClientes($id);

        $config = array();

        $config['titulo'] = "Catalogo de Clientes";

        $config['cancelar'] = url('/admin/clientes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de clientes",
            'href' => url('/admin/clientes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar cliente",
            'href' => url('/admin/clientes/edit'),
            'active' => true
        );

        if(count($data)){
          //dd($data);
          return view('admin/clientes/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/clientes/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'curp'   => 'required',
             'nombre'=> 'required' ,
          	 'paterno'=> 'required' ,
          	 'materno'=> 'required'
        ]);

        $clientes = new \App\admin\Clientes;
        if($clientes->updateClientes($request)){
            $request->session()->flash('message', 'clientes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ClientesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ClientesController@index');
        }
    }

    public function view($id){

      $clientes = new \App\admin\Clientes;

      $data = $clientes->getClientesView($id);

      $config = array();

      $config['titulo'] = "clientes";

      $config['cancelar'] = url('/admin/clientes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de clientes",
          'href' => url('/admin/clientes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de clientes",
          'href' => url('/admin/clientes/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/clientes/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/clientes/view');

      }

    }

    public function baja($id){

        $clientes = new \App\admin\Clientes;
        $flag = $clientes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$clientes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ClientesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ClientesController@index');
        }
    }

    public function alta($id){
        $clientes = new \App\admin\Clientes;
        $flag = $clientes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$clientes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ClientesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ClientesController@index');
        }
    }

    public function getAjax($id){

      $clientes = new \App\admin\Clientes;

      $data = $clientes->getClientesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function BuscarTelefonosDuplicadosAjax(Request $request)
    {
      $input = $request->all();

      $respuesta = [];
      $telefonos = \App\admin\Clientes::where('telefono', $input['telefono'])
                                      ->orWhere('celular', $input['telefono'])
                                      ->first();
      if( empty($telefonos) ){
        $respuesta = ['error' => 0, 'msg' => 'No está duplicado' ];
      } else {
        $respuesta = ['error' => 1, 'msg' => 'Se encontró un teléfono duplicado', 'cliente' => $telefonos->id ];
      }
      return $respuesta;
    }

}
