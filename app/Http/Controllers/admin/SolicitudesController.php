<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitudes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use Illuminate\Validation\Rule;

class SolicitudesController extends Controller
{
    public $v_fields=array('solicitudes.etap_flujo', 'clientes.nombre', 'solicitudes.prospecto_id', 'productos.descripcion', 'users.name', 'users.name', 'asesores.nombre', 'solicitudes.solicitud_renueva_id', 'solicitudes.renovacion', 'solicitudes.fecha_captura', 'solicitudes.fecha_aprobacion', 'solicitudes.fecha_firma', 'solicitudes.fecha__fondeo', 'solicitudes.folio', 'solicitudes.monto_solicitado', 'solicitudes.plazo_solicitado', 'solicitudes.pago_solicitado', 'solicitudes.interes_registro', 'solicitudes.monto_aprobado', 'solicitudes.plazo_aprobado', 'solicitudes.pago_aprobado', 'solicitudes.interes_aprobado', 'solicitudes.monto_fondeado', 'solicitudes.exp_aprobado', 'solicitudes.msg_aprobacion', 'solicitudes.msg_rechazo', 'solicitudes.fecha_extaprueba', 'users.name', 'solicitudes.autorizado', 'solicitudes.exp_completo', 'solicitudes.firmado', 'solicitudes.fondeado', 'solicitudes.ctto_firmado', 'solicitudes.contratos', 'solicitudes.contratos_firmados', 'solicitudes.pagares_firmados', 'solicitudes.aprivacidad_cliente', 'solicitudes.aprivacidad_aval', 'solicitudes.status');
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
          $links[$value.'_link'] =url('/').'/admin/solicitudes?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/solicitudes/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/solicitudes/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $solicitudes = new \App\admin\Solicitudes;

        $config = array();

        $config['titulo'] = "Solicitudes de Credito";

        $config['cancelar'] = url('/admin/solicitudes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de solicitudes",
            'href' => url('/admin/solicitudes'),
            'active' => false
        );

        $data = $solicitudes->getSolicitudesData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/solicitudes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $solicitudes = new \App\admin\Solicitudes;

      $clientes = new \App\admin\Clientes;

      $config = array();

      $config['titulo'] = "Solicitudes de Credito";

      $config['cancelar'] = url('/admin/solicitudes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes",
          'href' => url('/admin/solicitudes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Nueva Solicitud",
          'href' => url('/admin/solicitudes/add'),
          'active' => true
      );

      $data = new $solicitudes;

      $cliente = new $clientes;

      if($request->input('prospecto_id') != null) {

        $prospectos = new \App\admin\Prospectos;

        $info = $prospectos->getProspectos($request->input('prospecto_id'));

        //Datos de Cliente
        $data->cliente_id = -1;

        $data->prospecto_id       = $request->input('prospecto_id');


        $data->fondeador_id          = $info->fondeador_id;

        $data->supervisor_id         = $info->supervisor_id;

        $data->vendedor_id           = $info->vendedor_id;

        $cliente->nombre             = $info->nombre;

        $cliente->paterno            = $info->paterno;

        $cliente->materno            = $info->materno;

        $cliente->telefono           = $info->telefono;

        $cliente->celular            = $info->celular;

        $cliente->ingreso_mensual    = $info->ingresos_mensuales;

        $cliente->pagos_mensual      = $info->gastos_mensuales;

        $cliente->correo             = $info->email;

        //Datos de solicitud

        $data->monto_solicitado   = $info->monto;

        $data->plazo_solicitado   = $info->plazo_id;

        $data->producto_id        = $info->producto_id;

        $data->pago_solicitado    = $info->pago_semanal;

        $data->monto_id           = $info->monto_id;

        $data->pago_id            = $info->pago_id;

        $data->solicitud_renueva_id   = 0;

        $data->renovacion             = 0;

      } elseif($request->input('credito_id') != null) {


        $credito                      = \App\admin\Creditos::find($request->input('credito_id'));

        $cliente                      = \App\admin\Clientes::find($credito->cliente_id);

        $data->cliente_id             = $credito->cliente_id;

        $data->asesor_id              = $cliente->asesor_id;

        $data->agente_id              = $cliente->vendedor_id;

        $data->fondeador_id           = $credito->fondeador_id;

        $data->solicitud_renueva_id   = $credito->solicitud_id;

        $data->renovacion             = 1;

        $data->prospecto_id           = 0;

      } else {
        $data->prospecto_id = 0;
      }

    	return view('admin/solicitudes/add', ['config'=>$config,'data'=>$data,'cliente' =>$cliente, 'clientes'=>$solicitudes->getAll('clientes'),'productos'=>$solicitudes->getAll('productos'),'asesores'=>$solicitudes->getAll('asesores')]);
    }

    public function postAdd(Request $request){

        $solicitudes  = new \App\admin\Solicitudes;

        $clientes     = new \App\admin\Clientes;

        $creditos     = new \App\admin\Creditos;

        //verificar que no exista el cliente en la base de datos
        $cnombre = $request->input('nombre');
        $cpaterno = $request->input('paterno');
        $cmaterno = $request->input('materno');

        $buscarcliente = \App\admin\Clientes::where('nombre','like', '%'.$cnombre.'%')
                                            ->where('paterno', 'like', '%'.$cpaterno.'%')
                                            ->where('materno','like','%'.$cmaterno.'%')
                                            ->get();

        $nomcompleto = $cnombre.' '.$cpaterno.' '.$cmaterno;
          $nomcompleto = trim($nomcompleto);

        foreach($buscarcliente as $cliente)
        {
          if($cliente->nombrecompleto == $nomcompleto){
            Session::flash('fracaso', 'true');
            Session::flash('message', 'El nombre del cliente ya existe!');
            return back();
          }
        }


        $rules = [
          'documento' => 'file|size:2500'
        ];
        $messages = [
          'documento.size'  => 'El documento no puede exdecer de más de: $size'
        ];
        $this->validate($request, $rules, $messages);

        $cliente_id = $clientes->addClientes($request);
        //dd($request);

        if($request->input('prospecto_id') != 0) {

          $prospectos = new \App\admin\Prospectos;

          $prospectos->bajaProspecto($request->input('prospecto_id'));

        }

        $solicitud_id = $solicitudes->addSolicitudes($request,$cliente_id);

        if($request->file('documentos')) {

          foreach($request->file('documentos') as $key => $docs) {

            $fotografia_name='';

            $fotografia_file = $docs['documento'];


            if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){

                $fotografia_name    = time().'_'.$fotografia_file->getClientOriginalName();

                $mime               = $fotografia_file->getClientMimeType();

                $fotografia_file->move('uploads',$fotografia_name);

                //Insertamos documento al expediente
                DB::table('solicitudes_expediente')->insert([

                  'archivo' => $fotografia_name,

                  'carga_id' => Auth::id(),

                  'documento_id' => $key,

                  'fecha_carga' => date('Y-m-d'),

                  'mime' => $mime,

                  'solicitud_id' => $solicitud_id,

                  'status' => 1,

                  'valida_id' => 0,

                  'aprobado' => 0,

                ]);

            }

          }

        }

        $informacion = $solicitudes->getSolicitudes($solicitud_id);

        $interes = ($informacion->monto_aprobado * ((float)$request->input('interes_registro')/100));

        //Creamos elcredito de la solicitud
        $data = array(

          'vendedor_id'      => (int)$informacion->asesor_id,

          'cliente_id'      => $informacion->cliente_id,

          'solicitud_id'    => $informacion->id,

          'folio'           => time(),

          'plazo'           => $informacion->plazo_aprobado,

          'monto'           => $informacion->monto_aprobado,

          'pago'            => $informacion->pago_aprobado,

          'porcentaje'      => $informacion->interes_registro,

          'interes'         => $interes,

          'insoluto'        => ($interes + $informacion->monto_aprobado),

          'status'          => 1,

          'recargos'        => $request->input('recargos')


        );

        $creditos->crearCredito($data);

        $request->session()->flash('message', 'solicitudes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\SolicitudesController@index');
    }

    public function getEdit($id=''){

        $solicitudes = new \App\admin\Solicitudes;

        $users = $solicitudes->getAll('solicitudes');

        $data = $solicitudes->getSolicitudes($id);

        $config = array();

        $config['titulo'] = "Solicitudes de Credito";

        $config['cancelar'] = url('/admin/solicitudes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de solicitudes",
            'href' => url('/admin/solicitudes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar solicitud",
            'href' => url('/admin/solicitudes/edit'),
            'active' => true
        );

        if(count($data)){

          $cliente = \App\admin\Clientes::find($data->cliente_id);


          return view('admin/solicitudes/edit', ['data'=>$data, 'config'=>$config,'cliente' =>$cliente ,'clientes'=>$solicitudes->getAll('clientes'),'productos'=>$solicitudes->getAll('productos'),'users'=>$solicitudes->getAll('users'),'users'=>$solicitudes->getAll('users'),'asesores'=>$solicitudes->getAll('asesores'),'users'=>$solicitudes->getAll('users')]);
        } else{
          return abort(404);
        }
    }

    public function postEdit(Request $request){

        $solicitudes = new \App\admin\Solicitudes;
        if($solicitudes->updateSolicitudes($request)){

          $clientes = new \App\admin\Clientes;

          $clientes->updateClientes($request);

          if($request->file('documentos')) {

            foreach($request->file('documentos') as $key => $docs) {

              //Damos de baja el documentosi es que existia
              DB::table('solicitudes_expediente')
                                                 ->where('solicitud_id',$request->input('id'))
                                                 ->where('documento_id',$key)
                                                 ->update(['status' => 0]);

              $fotografia_name='';

              $fotografia_file = $docs['documento'];


              if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){

                  $fotografia_name    = time().'_'.$fotografia_file->getClientOriginalName();

                  $mime               = $fotografia_file->getClientMimeType();

                  $fotografia_file->move('uploads',$fotografia_name);

                  //Insertamos documento al expediente
                  DB::table('solicitudes_expediente')->insert([

                    'archivo' => $fotografia_name,

                    'carga_id' => Auth::id(),

                    'documento_id' => $key,

                    'fecha_carga' => date('Y-m-d'),

                    'mime' => $mime,

                    'solicitud_id' => $request->input('id'),

                    'status' => 1,

                    'valida_id' => 0,

                    'aprobado' => 0,

                  ]);

              }

            }


          }

          $request->session()->flash('message', 'solicitudes Editado exitosamente!');
          $request->session()->flash('exito', 'true');
          return redirect()->action('admin\SolicitudesController@index');

        } else{

          $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
          $request->session()->flash('fracaso', 'true');
          return redirect()->action('admin\SolicitudesController@index');

        }
    }

    public function view($id){

      $solicitudes = new \App\admin\Solicitudes;

      $data = $solicitudes->getSolicitudesView($id);

      $config = array();

      $config['titulo'] = "solicitudes";

      $config['cancelar'] = url('/admin/solicitudes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes",
          'href' => url('/admin/solicitudes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de solicitudes",
          'href' => url('/admin/solicitudes/view'),
          'active' => true
      );

      if(count($data)){

        $cliente = \App\admin\Clientes::find($data->cliente_id);

        $producto = \App\admin\Productos::find($data->producto_id);

        $user = \App\admin\Users::find($data->captura_id);

        return view('admin/solicitudes/view', ['data'=>$data, 'config'=>$config,'cliente' => $cliente,'producto' => $producto, 'user' => $user]);

      } else{

        return view('admin/solicitudes/view');

      }

    }

    public function baja($id){

        $solicitudes = new \App\admin\Solicitudes;
        $flag = $solicitudes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$solicitudes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\SolicitudesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\SolicitudesController@index');
        }
    }

    public function alta($id){
        $solicitudes = new \App\admin\Solicitudes;
        $flag = $solicitudes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$solicitudes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\SolicitudesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\SolicitudesController@index');
        }
    }

    public function getAjax($id){

      $solicitudes = new \App\admin\Solicitudes;

      $data = $solicitudes->getSolicitudesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function postAvanza($id) {

      $solicitudes = new \App\admin\Solicitudes;

      if($solicitudes->avanzaSolicitud($id)) {

        Session::flash('message', 'La solicitud ha avanzado exitosamente!');
        Session::flash('exito', 'true');

      } else {

        Session::flash('message', 'Ocurrió un problema, no se puede realizar la operacion de avance, intente mas tarde');
        Session::flash('exito', 'true');

      }

      return redirect()->action('admin\SolicitudesController@index');

    }

    public function rechazos(Request $request){
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
          $links[$value.'_link'] =url('/').'/admin/solicitudes?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/solicitudes/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/solicitudes/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $solicitudes = new \App\admin\Solicitudes;

        $config = array();

        $config['titulo'] = "solicitudes";

        $config['cancelar'] = url('/admin/solicitudes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de solicitudes",
            'href' => url('/admin/solicitudes'),
            'active' => false
        );

        $data = $solicitudes->getSolicitudesRechazos($per_page, $searchBy, $searchValue, $sortBy, $order,2);

        return view('admin/solicitudes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getPendAprobacion(Request $request){
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
        $links[$value.'_link'] =url('/').'/admin/solicitudes?'.$query_result;
      }
      $links['csvlink'] = url('/').'/admin/solicitudes/export/csv?'.$_SERVER['QUERY_STRING'];
      $links['pdflink'] = url('/').'/admin/solicitudes/export/pdf?'.$_SERVER['QUERY_STRING'];

      // pagination per page
      $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

      // search value
      if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
          $searchBy=$_GET['searchBy'];
          $searchValue = $_GET['searchValue'];
      }

      // get by modal
      $solicitudes = new \App\admin\Solicitudes;

      $config = array();

      $config['titulo'] = "solicitudes";

      $config['cancelar'] = url('/admin/solicitudes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes",
          'href' => url('/admin/solicitudes'),
          'active' => false
      );

      $data = $solicitudes->getSolicitudesData($per_page, $searchBy, $searchValue, $sortBy, $order,4);

      return view('admin/solicitudes/aprobaciones', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAprobacion($id) {

      $solicitudes = new \App\admin\Solicitudes;

      $data = $solicitudes->getSolicitudesView($id);

      $config = array();

      $config['titulo'] = "Solicitudes";

      $config['cancelar'] = url('/admin/solicitudes/aprobacion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes",
          'href' => url('/admin/solicitudes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalle",
          'href' => url('/admin/solicitudes/view'),
          'active' => true
      );

      if(count($data)){

        $cliente = \App\admin\Clientes::find($data->cliente_id);

        $producto = \App\admin\Productos::find($data->producto_id);

        $user = \App\admin\Users::find($data->captura_id);

        return view('admin/solicitudes/aprueba', ['data'=>$data,

                                                  'config'=>$config,

                                                  'plazos' => $solicitudes->getAll('plazos'),

                                                  'cliente' => $cliente,

                                                  'producto' => $producto,

                                                  'productos' => $data->getAll('productos'),

                                                  'user' => $user,

                                                  'documentos' => \App\admin\Documentos::where('status', 1)->get()

                                                 ]);

      } else{

        return view('admin/solicitudes/view');

      }

    }

    public function postAprobacion(Request $request){

      $solicitudes = new \App\admin\Solicitudes;

      $solicitudes->apruebaSolicitud($request);
      $request->session()->flash('message', 'solicitudes # ' . $request->input('id') . ',  aprobada exitosamente!');
      $request->session()->flash('exito', 'true');

      //Creamos el credito pendiente para fondear
      $creditos = new \App\admin\Creditos;


      $informacion = $solicitudes->getSolicitudes($request->input('id'));

      $interes = ($informacion->monto_aprobado * ((float)$request->input('interes_aprobado')/100));

      $data = array(

        'vendedor_id'      => (int)$informacion->asesor_id,

        'cliente_id'      => $informacion->cliente_id,

        'solicitud_id'    => $informacion->id,

        'folio'           => time(),

        'plazo'           => $informacion->plazo_aprobado,

        'monto'           => $informacion->monto_aprobado,

        'pago'            => $informacion->pago_aprobado,

        'porcentaje'      => $request->input('interes_aprobado'),

        'interes'         => $interes,

        'insoluto'        => ($interes + $informacion->monto_aprobado),

        'status'          => 1,

        'recargos'        => $request->input('recargos')


      );

      $creditos->crearCredito($data);

      return redirect()->action('admin\SolicitudesController@getPendAprobacion');

    }

    public function getPendFirma(Request $request){
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
          $links[$value.'_link'] =url('/').'/admin/solicitudes?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/solicitudes/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/solicitudes/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $solicitudes = new \App\admin\Solicitudes;

        $config = array();

        $config['titulo'] = "solicitudes";

        $config['cancelar'] = url('/admin/solicitudes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de solicitudes",
            'href' => url('/admin/solicitudes'),
            'active' => false
        );

        $data = $solicitudes->getSolicitudesData($per_page, $searchBy, $searchValue, $sortBy, $order,5);

        return view('admin/solicitudes/firmas', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getFirmar($id){

      $solicitudes = new \App\admin\Solicitudes;

      $data = $solicitudes->getSolicitudesView($id);

      $config = array();

      $config['titulo'] = "Solicitudes";

      $config['cancelar'] = url('/admin/solicitudes/aprobacion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes",
          'href' => url('/admin/solicitudes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalle",
          'href' => url('/admin/solicitudes/view'),
          'active' => true
      );

      if(count($data)){

        $cliente = \App\admin\Clientes::find($data->cliente_id);

        $producto = \App\admin\Productos::find($data->producto_id);

        $user = \App\admin\Users::find($data->captura_id);

        return view('admin/solicitudes/firmar', ['data'=>$data,

                                                 'config'=>$config,

                                                 'plazos' => $solicitudes->getAll('plazos'),

                                                 'cliente' => $cliente,

                                                 'producto' => $producto,

                                                 'user' => $user,

                                                 'documentos' => \App\admin\Documentos::where('status', 1)->get()
                                               ]);

      } else{

        return view('admin/solicitudes/view');

      }

    }

    public function postFirmar(Request $request){

      $solicitudes = new \App\admin\Solicitudes;

      $solicitudes->firmaSolicitud($request);
      //$request->session()->flash('message', 'solicitudes # ' . $request->input('id') . ',  aprobada exitosamente!');
      $request->session()->flash('message', 'solicitudes # ' . $request->input('id') . ',  firmada exitosamente!');
      $request->session()->flash('exito', 'true');
      return redirect()->action('admin\SolicitudesController@getPendFirma');
    }

    public function dispersion(){

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
        $links[$value.'_link'] =url('/').'/admin/solicitudes?'.$query_result;
      }
      $links['csvlink'] = url('/').'/admin/solicitudes/export/csv?'.$_SERVER['QUERY_STRING'];
      $links['pdflink'] = url('/').'/admin/solicitudes/export/pdf?'.$_SERVER['QUERY_STRING'];

      // pagination per page
      $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

      // search value
      if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
          $searchBy=$_GET['searchBy'];
          $searchValue = $_GET['searchValue'];
      }

      // get by modal
      $solicitudes = new \App\admin\Solicitudes;

      $config = array();

      $config['titulo'] = "solicitudes";

      $config['cancelar'] = url('/admin/solicitudes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de solicitudes",
          'href' => url('/admin/solicitudes'),
          'active' => false
      );

      $data = $solicitudes->getSolicitudesData($per_page, $searchBy, $searchValue, $sortBy, $order,2);

      return view('admin/solicitudes/dispersion', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);

    }

    public function dispersionview($id){
        $solicitud = \App\admin\Solicitudes::find($id);
        $cliente = \App\admin\Clientes::find($solicitud->cliente_id);
        if (empty($solicitud)){
            return abort(404);
        }
        return view(
            'admin/solicitudes/dispersionview',
            [
                'solicitud' => $solicitud,
                'cliente'   => $cliente,
                'solicitud_id' => $id,
            ]
        );
    }

    public function guardarMovimientoDispersion(Request $request) {

        $datos = $_POST;
        $solicitudId = $request->input('solicitud_id');
        $solicitud = \App\admin\Solicitudes::find($solicitudId);

        if ($solicitudId > 0 && !empty($solicitud)){

          DB::table('dispersion')->insert([
            'solicitud_id'    => $request->input('solicitud_id'),
            'user_id'         => Auth::user()->id,
            'fecha'           => date('Y-m-d'),
            'cuenta_origen'   => $request->input('cuenta_origen'),
            'cuenta_destino'  => $request->input('cuenta_destino'),
            'monto'           => $request->input('monto'),
            'observaciones'   => $request->input('observaciones') != "" ? $request->input('observaciones') : " ",
            'status'          => 1
          ]);

          $pendiente = $solicitud->monto_aprobado - $solicitud->dispersionMovimientos->sum->monto;

          if ($pendiente <= 0){

              $solicitud->etap_flujo  = 7;

              $solicitud->save();

              //El credito ya fue fondeado correctaamente iniciamos el proceso de cobranza y
              $creditos = new \App\admin\Creditos;

              $creditos->iniciaCredito($solicitud->id);

              if($solicitud->renovacion == 1) {

                $creditos->liquidaCredito($solicitud->solicitud_renueva_id);

              }

          }

        }

        return redirect('admin/solicitudes/dispersion/' . $solicitudId);

    }

    public function getExpediente($producto_id,Request $request) {

      $documentos = DB::table('documentos')->whereIn('producto_id',array(0,$producto_id))->where('status',1)->get();

      $html = '';

      foreach($documentos as $docs) {

        $cargado = "";
        $requerido = "";

        if($request->input('solicitud_id')) {

          $exp = DB::table('solicitudes_expediente')
                                                    ->where('status',1)
                                                    ->where('documento_id', $docs->id)
                                                    ->where('solicitud_id',$request->input('solicitud_id'))
                                                    ->get();

          if(count($exp)) {

            $cargado = 'data-default-file="' . str_replace('index.php','',url('/')) . 'uploads/' . $exp[0]->archivo . '"';
            $cotejado = $exp[0]->cotejado;
          } else {
            $cotejado = 0;
          }

        }

        if($docs->requerido == 1) { $requerido = 'required'; }
        $html .= '<div class="col-md-3">
                   <label for="vendedor_id" class="control-label"> ' . $docs->nombre . ' </label>
					         <div class="form-group">
                    <input name="documentos[' . $docs->id . '][documento]" class="dropify" ' . $cargado . ' data-allowed-file-extensions="png jpg jpeg" type="file" ' . $requerido . '>
                    <div class="col-md-12 text-center">
                      <label class="col-md-12">
                       <input ' . $requerido . ' class="form-control col-md-6" name="" id="" type="checkbox" value="' . $cotejado . '" style="width:20px"> <span class="col-md-6" style="padding-top:12px">Cotejado contra Fisico</span>
                      </label>
                    </div>
					         </div>
				          </div>';

      }
      return array('error' => 0, 'msg' => '', 'html' => $html);

    }

    public function potAprueba($id,Request $request) {

      $usuario = \App\admin\Asesores::where('supervisor',1)->where('password',$request->input('p') )->get();

      if($usuario) {

        //Actualizamos la informcion de la solicitud
        \App\admin\Solicitudes::where('id',$id)->update([ 'autorizado' => 1, 'User_aprueba' => Auth::user()->id]);

        return array('error' => 0, 'msg' => 'Exito Credito autorizado para dispercion');

      } else {
        return array('error' => 1, 'msg' => 'Clave de supervisor no encontrada, por favor intente de nuevo o contacte con el supervisor a cargo');
      }
    }

    public function validarNombrecompleto(Request $request)
    {
      $input = $request->all();

      $nombre = $request->input('nombre');
      $paterno = $request->input('paterno');
      $materno = $request->input('materno');

      //$nombre, $paterno, $materno
      $resultado = ['tipo'=>false, 'mensaje'=>'No se ha procesado', 'nomcliente'=> 'vacio', 'request'=>$input];
      //función que valida el nombre completo del usuario
      $buscarcliente = \App\admin\Clientes::where('nombre','like', '%'.$nombre.'%')
                                          ->where('paterno', 'like', '%'.$paterno.'%')
                                          ->where('materno','like','%'.$materno.'%')
                                          ->get();
      $ccompleto = trim($nombre).' '.trim($paterno).' '.trim($materno);
      $ccompleto = trim($ccompleto);

      $buscarcliente2 = \App\admin\Clientes::where('nombre','like', '%'.$ccompleto.'%')
                                          ->get();

      if($buscarcliente->count() > 0)
      {
         $resultado = ['tipo'=>true, 'mensaje'=>'Cliente ya existe en la base de datos', 'nomcliente'=>$ccompleto, 'request'=>$input];
      }
      else
      {
        $resultado = ['tipo'=>false, 'mensaje'=>'No se ha encontrado en la base de datos', 'nomcliente'=>$ccompleto, 'request'=>$input];
        if($buscarcliente2->count() > 0)
        {
           $resultado = ['tipo'=>true, 'mensaje'=>'Se encontró el cliente ya existe en la base de datos', 'nomcliente'=>$ccompleto, 'request'=>$input];
        }
      }


        return $resultado;
    }


}
