<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asesores;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class AsesoresController extends Controller
{
    public $v_fields=array('asesores.nombre', 'asesores.paterno', 'asesores.materno', 'asesores.correo', 'asesores.celular', 'asesores.comision', 'asesores.status');
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
          $links[$value.'_link'] =url('/').'/admin/asesores?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/asesores/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/asesores/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $asesores = new \App\admin\Asesores;

        $config = array();

        $config['titulo'] = "Catalogo de Supervisores";

        $config['cancelar'] = url('/admin/asesores');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de Supervisores",
            'href' => url('/admin/asesores'),
            'active' => false
        );

        $data = $asesores->getAsesoresData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/asesores/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $asesores = new \App\admin\Asesores;
      $users = new \App\admin\Users;

      $config = array();

      $config['titulo'] = "Catalogo de Supervisores";

      $config['cancelar'] = url('/admin/asesores');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de Supervisores",
          'href' => url('/admin/asesores'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar Supervisor",
          'href' => url('/admin/asesores/add'),
          'active' => true
      );

      $data = new $asesores;
      $user = new $users;
    	return view('admin/asesores/add', ['config'=>$config,'data'=>$data, 'roles' => $asesores->getAll('roles'),'user' => $user ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'nombre'    => 'required' ,
          	 'email'     => 'email|required|unique:users' ,
          	 'celular'   => 'required' ,
          	 'comision'  => 'required' ,
             'password' => 'required|min:6|max:10|confirmed',
        ]);

        $asesores = new \App\admin\Asesores;

        $asesor_id = $asesores->addAsesores($request);

        if($request->input('password') != "") {

          $users = new \App\admin\Users;

          $data = array(
            'name'        =>  $request->input('nombre') . ' ' . $request->input('paterno') . ' ' . $request->input('materno'),

            'email'       => $request->input('email'),

            'password'    => $request->input('password'),

            'rol_id'      => $request->input('rol_id'),

            'asesor_id'   => $asesor_id,

          );

          $users->createUser($data);
        }

        $request->session()->flash('message', 'asesores Agregado exitosamente!');

        $request->session()->flash('exito', 'true');

        return redirect()->action('admin\AsesoresController@index');
    }

    public function getEdit($id=''){

        $asesores = new \App\admin\Asesores;

        $users = $asesores->getAll('asesores');

        $data = $asesores->getAsesores($id);

        $config = array();

        $config['titulo'] = "Catalogo de Supervisores";

        $config['cancelar'] = url('/admin/asesores');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de Supervisores",
            'href' => url('/admin/asesores'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar Supervisor",
            'href' => url('/admin/asesores/edit'),
            'active' => true
        );

        if(count($data)){

          $user = \App\admin\Users::where('asesor_id',$id)->get();

          return view('admin/asesores/edit', ['data'=>$data, 'config'=>$config ,'roles' => $asesores->getAll('roles'),'user' => $user[0]]);
        } else{
          return view('admin/asesores/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
          	 'email'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'comision'=> 'required' ,
        ]);

        $asesores = new \App\admin\Asesores;
        if($asesores->updateAsesores($request)){



            $users = new \App\admin\Users;

            $data = array(
              'name'        =>  $request->input('nombre') . ' ' . $request->input('paterno') . ' ' . $request->input('materno'),

              'email'       => $request->input('email'),

              'password'    => $request->input('password'),

              'rol_id'      => $request->input('rol_id'),

              'asesor_id'   => $request->input('id'),

              'id'          => $request->input('user_id'),

            );

            $users->upgradeUsers($data);

            $request->session()->flash('message', 'asesores Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\AsesoresController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\AsesoresController@index');
        }
    }

    public function view($id){

      $asesores = new \App\admin\Asesores;

      $data = $asesores->getAsesoresView($id);

      $config = array();

      $config['titulo'] = "asesores";

      $config['cancelar'] = url('/admin/asesores');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de asesores",
          'href' => url('/admin/asesores'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de asesores",
          'href' => url('/admin/asesores/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/asesores/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/asesores/view');

      }

    }

    public function baja($id){

        $asesores = new \App\admin\Asesores;
        $flag = $asesores->updateStatus($id,0);
        if($flag){

            //Damos de baja al asesor
            \App\admin\Users::where('asesor_id',$id)->update(['status' => 0]);

            Session::flash('message', '$asesores deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AsesoresController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AsesoresController@index');
        }
    }

    public function alta($id){
        $asesores = new \App\admin\Asesores;
        $flag = $asesores->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$asesores habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AsesoresController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AsesoresController@index');
        }
    }

    public function getAjax($id){

      $asesores = new \App\admin\Asesores;

      $data = $asesores->getAsesoresView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getAgentes($id){



      $data = \App\admin\Agentes::where('asesor_id',$id)->get();

      if(count($data)){

        $html = '<option value=""> [ Seleccione una opción ]</option>';

        foreach($data as $value) {
          $html .= '<option value="' . $value->id . '"> ' . $value->nombre . '</option>';
        }

        return array('error' =>0, 'msg' => '','html' => $html);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','html' => array());

      }

    }


}
