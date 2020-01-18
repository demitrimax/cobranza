<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expediente_digital;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Expediente_digitalController extends Controller
{
    public $v_fields=array('expediente_digital.id', 'expediente_digital.user_id', 'expediente_digital.solicitud_id', 'expediente_digital.documento_id', 'expediente_digital.status');
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

      $config['titulo'] = "Solicitudes";

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

      $data = $solicitudes->getSolicitudesData($per_page, $searchBy, $searchValue, $sortBy, $order,3,'exp_completo',0);

      return view('admin/expediente_digital/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

        $expediente_digital = new \App\admin\Expediente_digital;

        $config = array();

        $config['titulo'] = "expediente_digital";

        $config['cancelar'] = url('/admin/expediente_digital');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de expedientes digitales",
            'href' => url('/admin/expediente_digital'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Agregar expediente digital",
            'href' => url('/admin/expediente_digital/add'),
            'active' => true
        );

        $data = new $expediente_digital;

        return view('admin/expediente_digital/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $expediente_digital = new \App\admin\Expediente_digital;
        $expediente_digital->addExpediente_digital($request);
        $request->session()->flash('message', 'Registro agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Expediente_digitalController@index');
    }

    public function getEdit($id=''){

        $expediente_digital = new \App\admin\Expediente_digital;

        $users = $expediente_digital->getAll('expediente_digital');

        $data = $expediente_digital->getExpediente_digital($id);

        $config = array();

        $config['titulo'] = "Expediente digital";

        $config['cancelar'] = url('/admin/expediente_digital');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de expediente_digital",
            'href' => url('/admin/expediente_digital'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar expediente_digital",
            'href' => url('/admin/expediente_digital/edit'),
            'active' => true
        );

        if(count($data)){
            return view('admin/expediente_digital/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
            return view('admin/expediente_digital/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $expediente_digital = new \App\admin\Expediente_digital;
        if($expediente_digital->updateExpediente_digital($request)){
            $request->session()->flash('message', 'Registro editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Expediente_digitalController@index');
        } else{
            $request->session()->flash('message', 'Ocurrió un problema, intente mas tarde');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Expediente_digitalController@index');
        }
    }

    public function view($id){

        $expediente_digital = new \App\admin\Expediente_digital;

        $data = $expediente_digital->getExpediente_digitalView($id);

        $config = array();

        $config['titulo'] = "Expediente digital";

        $config['cancelar'] = url('/admin/expediente_digital');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de expedientes digitales",
            'href' => url('/admin/expediente_digital'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Detalle",
            'href' => url('/admin/expediente_digital/view'),
            'active' => true
        );

        if(count($data)){

            return view('admin/expediente_digital/view', ['data'=>$data, 'config'=>$config]);

        } else{

            return view('admin/expediente_digital/view');

        }

    }

    public function baja($id){

        $expediente_digital = new \App\admin\Expediente_digital;
        $flag = $expediente_digital->updateStatus($id,0);
        if($flag){
            Session::flash('message', 'Registro deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Expediente_digitalController@index');
        } else{
            Session::flash('message', 'Ocurrió un problema, intente mas tarde');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Expediente_digitalController@index');
        }
    }

    public function alta($id){
        $expediente_digital = new \App\admin\Expediente_digital;
        $flag = $expediente_digital->updateStatus($id,1);
        if($flag){
            Session::flash('message', 'Registro habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Expediente_digitalController@index');
        } else{
            Session::flash('message', 'Ocurrió un problema, intente mas tarde');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Expediente_digitalController@index');
        }
    }

    public function documentos($id){

        $solicitud = \App\admin\Solicitudes::find($id);

        if (empty($solicitud)){
            return abort(404);
        }

        if($solicitud->renovacion == 1) {



          //la solicitud es una renovacio, validamos si hay o no documentos ya cargados

          $cargados = \App\admin\Solicitudes_expediente::where('solicitud_id', $solicitud->id)->get();

          if(count($cargados) > 0) {

          } else {

            $cargados = \App\admin\Solicitudes_expediente::where('solicitud_id', $solicitud->solicitud_renueva_id)->get();

            foreach($cargados as $news) {

              \App\admin\Solicitudes_expediente::create(

                  array(

                    'archivo'       => $news->archivo,

                    'carga_id'      => Auth::id(),

                    'documento_id'  => $news->documento_id,

                    'fecha_carga'   => date('Y-m-d'),

                    'mime'          => $news->mime,

                    'solicitud_id' => $solicitud->id,

                    'status'       => 1,

                    'valida_id'    => 0,

                    'aprobado'     => 0,

                  )

              );

            }


          }

        }

        $cliente = \App\admin\Clientes::find($solicitud->cliente_id);

        $producto = \App\admin\Productos::find($solicitud->producto_id);

        return view('admin/expediente_digital/documentos',[

            'solicitud' => $solicitud,

            'cliente' => $cliente,

            'producto' => $producto,

            'solicitud_id' => $id,

            'documentos' => \App\admin\Documentos::where('status', 1)->get(),
          ]);
    }

    public function upload_file(Request $request){

        $res = ['ok' => 0];

        $time = time();

        $archivo = $request->file('documento');

        $solicitud = \App\admin\Solicitudes::where('id', $request->input('solicitud_id'))->where('status', 1)->first();

        if ($archivo->isValid()) {

            $dir = 'uploads/expediente/';

            $res['dir'] = realpath($dir);

            if (!is_dir($dir . $request->input('solicitud_id') )){

                mkdir($dir . $request->input('solicitud_id'), 0700, true);

            }

            $extension = $archivo->extension();

            $mime = $archivo->getClientMimeType();

            $nombre = $time. '.' . $extension;

            $path = $archivo->move($dir . $request->input('solicitud_id'), $nombre);

            DB::table('solicitudes_expediente')->where('solicitud_id', $request->input('solicitud_id'))
                                               ->where('documento_id', $request->input('documento_id'))
                                               ->update(['status' => 0]);

            DB::table('solicitudes_expediente')->insert([

              'archivo' => $nombre,

              'carga_id' => Auth::id(),

              'documento_id' => $request->input('documento_id'),

              'fecha_carga' => date('Y-m-d'),

              'mime' => $mime,

              'solicitud_id' => $request->input('solicitud_id'),

              'status' => 1,

              'valida_id' => 0,

              'aprobado' => 0,

            ]);

            //Validamos el total de documentos a cargar contra el total de documentos cargado
            $requeridos = DB::table('documentos')->where('requerido',1)->where('status',1)->get();

            $cargados = DB::table('solicitudes_expediente')->where('solicitud_id', $request->input('solicitud_id'))->get();

            if($cargados >= $requeridos) {

              $solicitud = \App\admin\Solicitudes::where('id', $request->input('solicitud_id'))
                                                 ->update(['exp_completo' => 1]);

            }

            $res['ok'] = 1;

        }

        echo json_encode($res);
    }

    public function delete_file($id){
        $flag = \App\admin\Solicitudes_expediente::where('id', $id)->update(['status' => 0]);
        if($flag){

          $exp = \App\admin\Solicitudes_expediente::find($id);

          $solicitud = \App\admin\Solicitudes::where('id', $exp->solicitud_id)
                                             ->update(['exp_completo' => 0]);

            Session::flash('message', 'Registro deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return back()->withInput();
        } else{
            Session::flash('message', 'Ocurrió un problema, intente mas tarde');
            Session::flash('fracaso', 'true');
            return back()->withInput();
        }
    }

    public function historial_documento(Request $request){
        $res = array();
        $solicitudId = $request->input('solicitud_id');
        $documentoId = $request->input('documento_id');
        $expedientes = \App\admin\Solicitudes_expediente::where('solicitud_id', $solicitudId)
                ->where('documento_id', $documentoId)->orderBy('id', 'desc')->get();
        echo json_encode($expedientes);
    }

    public function validacion($id) {

        $solicitud = \App\admin\Solicitudes::find($id);

        $config = array();

        $config['titulo'] = "Solicitudes";

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
            'text' => "Detalle",
            'href' => url('/admin/solicitudes/view'),
            'active' => true
        );

        if (empty($solicitud)){
            return abort(404);
        }

        $cliente = \App\admin\Clientes::find($solicitud->cliente_id);

        $producto = \App\admin\Productos::find($solicitud->producto_id);

        $user = \App\admin\Users::find($solicitud->captura_id);

        return view(
            'admin/expediente_digital/validacion',
            [
                'solicitud' => $solicitud,
                'config' => $config,
                'cliente' => $cliente,
                'producto' => $producto,
                'user' => $user,
                'solicitud_id' => $id,
                'documentos' => \App\admin\Documentos::where('status', 1)->get(),
            ]
        );
    }

    public function setRechazo(Request $request){
        $res = \App\admin\Solicitudes_expediente::where('id', $request->input('expediente_id'))->update([
            'comentario' => strip_tags(trim($request->input('comentario'))),
            'status' => 2
            ]);
        return response()->json($res);
    }

    public function get_reglas(Request $request){
        $documentoId = $request->input('documento_id');
        $reglas = \App\admin\Documentos_reglas::where('documento_id', $documentoId)->where('status', 1)->get();
        echo json_encode($reglas);
    }

    public function validar_expediente(Request $request){

        $statusValidacion = $request->input('status_validacion');
        $solicitudId = $request->input('solicitud_id');
        $documentoId = $request->input('documento_id');
        $expedienteId =  $request->input('expediente_id');

        $res = \App\admin\Solicitudes_expediente::where('id', $expedienteId)->update([
                    'valida_id' =>  Auth::id(),
                    'fecha_validacion' => date('Y-m-d'),
                ]);
    }

    public function getValidar(Request $request){
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

      $config['titulo'] = "Solicitudes";

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

      $data = $solicitudes->getSolicitudesData($per_page, $searchBy, $searchValue, $sortBy, $order,3,'exp_completo',1);

      return view('admin/expediente_digital/valida', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function postValidar($id,Request $request) {

      $solicitudes = new \App\admin\Solicitudes;
      $solicitudes->apruebaExpediente($id,$request);
      $request->session()->flash('message', 'Expediente procesado exitosamente!');
      $request->session()->flash('exito', 'true');
      return redirect()->action('admin\Expediente_digitalController@getValidar');

    }

    public function validaDocumento($id,Request $request) {

      //Actualizamos el documento
      $res = \App\admin\Solicitudes_expediente::where('id', $request->input('expediente_id'))->update([

                  'valida_id'           =>  Auth::id(),

                  'fecha_validacion'    => date('Y-m-d'),

                  'aprobado'            => $request->input('aprobado'),

                  'comentario'          => $request->input('comentarios'),

              ]);

      return redirect('admin/expediente_digital/validacion/' . $id);
    }

    public function verArchivo($id){
      $expediente = \App\admin\Solicitudes_expediente::findOrFail($id);
      return view('admin/expediente_digital/ver_archivo',
      [
        'expediente' => $expediente
      ]);
    }

    public function api_upload_file(Request $request){

        $res = ['ok' => 0];

        $time = time();

        $archivo = $request->file('documento');

        $solicitud = \App\admin\Solicitudes::where('id', $request->input('solicitud_id'))->where('status', 1)->first();
        return response()->json($solicitud);
        if ($archivo->isValid()) {

            $dir = 'uploads/expediente/';

            $res['dir'] = realpath($dir);

            if (!is_dir($dir . $request->input('solicitud_id') )){

                mkdir($dir . $request->input('solicitud_id'), 0700, true);

            }

            $extension = $archivo->extension();

            $mime = $archivo->getClientMimeType();

            $nombre = $time. '.' . $extension;

            $path = $archivo->move($dir . $request->input('solicitud_id'), $nombre);

            \App\admin\Solicitudes_expediente::where('solicitud_id', $request->input('solicitud_id'))

                ->where('documento_id', $request->input('documento_id'))

                ->update(['status' => 0]);

            \App\admin\Solicitudes_expediente::create(

                array(

                  'archivo' => $nombre,

                  'carga_id' => Auth::id(),

                  'documento_id' => $request->input('documento_id'),

                  'fecha_carga' => date('Y-m-d'),

                  'mime' => $mime,

                  'solicitud_id' => $request->input('solicitud_id'),

                  'status' => 1,

                  'valida_id' => 0,

                  'aprobado' => 0,

                )

            );

            //Validamos el total de documentos a cargar contra el total de documentos cargado
            $requeridos = \App\admin\Documentos::where('requerido',1)->where('status',1)->get();

            $cargados = \App\admin\Solicitudes_expediente::where('solicitud_id', $request->input('solicitud_id'))->get();

            if($cargados >= $requeridos) {

              $solicitud = \App\admin\Solicitudes::where('id', $request->input('solicitud_id'))
                                                 ->update(['exp_completo' => 1]);

            }

            $res['ok'] = 1;

        }

        echo json_encode($res);
    }

}
