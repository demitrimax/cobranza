<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class ProductosController extends Controller
{
    public $v_fields=array('productos.descripcion', 'productos.tasa_minima', 'productos.tasa_maxima', 'productos.tasa_actual', 'productos.credito_maximo', 'productos.credito_minimo', 'productos.plazo_maximo', 'productos.plazo_minimo', 'productos.status');
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
          $links[$value.'_link'] =url('/').'/admin/productos?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/productos/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/productos/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $productos = new \App\admin\Productos;

        $config = array();

        $config['titulo'] = "productos";

        $config['cancelar'] = url('/admin/productos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos",
            'href' => url('/admin/productos'),
            'active' => false
        );

        $data = $productos->getProductosData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/productos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $productos = new \App\admin\Productos;

      $config = array();

      $config['titulo'] = "productos";

      $config['cancelar'] = url('/admin/productos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos",
          'href' => url('/admin/productos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar productos",
          'href' => url('/admin/productos/add'),
          'active' => true
      );

      $data = new $productos;

    	return view('admin/productos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'descripcion'=> 'required' ,
          	 'tasa_minima'=> 'required' ,
          	 'tasa_maxima'=> 'required' ,
          	 'tasa_actual'=> 'required' ,
          	 'credito_maximo'=> 'required' ,
          	 'credito_minimo'=> 'required' ,
          	 'plazo_maximo'=> 'required' ,
          	 'plazo_minimo'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $productos = new \App\admin\Productos;
        $productos->addProductos($request);
        $request->session()->flash('message', 'productos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ProductosController@index');
    }

    public function getEdit($id=''){

        $productos = new \App\admin\Productos;

        $users = $productos->getAll('productos');

        $data = $productos->getProductos($id);

        $config = array();

        $config['titulo'] = "productos";

        $config['cancelar'] = url('/admin/productos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos",
            'href' => url('/admin/productos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar productos",
            'href' => url('/admin/productos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/productos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/productos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'descripcion'=> 'required' ,
          	 'tasa_minima'=> 'required' ,
          	 'tasa_maxima'=> 'required' ,
          	 'tasa_actual'=> 'required' ,
          	 'credito_maximo'=> 'required' ,
          	 'credito_minimo'=> 'required' ,
          	 'plazo_maximo'=> 'required' ,
          	 'plazo_minimo'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $productos = new \App\admin\Productos;
        if($productos->updateProductos($request)){
            $request->session()->flash('message', 'productos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ProductosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ProductosController@index');
        }
    }

    public function view($id){

      $productos = new \App\admin\Productos;

      $data = $productos->getProductosView($id);

      $config = array();

      $config['titulo'] = "productos";

      $config['cancelar'] = url('/admin/productos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos",
          'href' => url('/admin/productos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de productos",
          'href' => url('/admin/productos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/productos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/productos/view');

      }

    }

    public function baja($id){

        $productos = new \App\admin\Productos;
        $flag = $productos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$productos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProductosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProductosController@index');
        }
    }

    public function alta($id){
        $productos = new \App\admin\Productos;
        $flag = $productos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$productos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProductosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProductosController@index');
        }
    }

    public function getAjax($id){

      $productos = new \App\admin\Productos;

      $data = $productos->getProductosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getByFondeador($id){

        $productos = new \App\admin\Productos;

        $data = $productos->getByFondeador($id);


        if(count($data)){
          $html = '<option value="">---- Seleccione ----</option>';
          foreach($data as $value) {

            $html .= '<option value="' . $value->id . '">' . $value->descripcion . '</option>';
          }


            $json = array(
                            'error'     => 0,

                            'msg'       => '',

                            'html'      => $html,

                          );

        } else{

          $json = array('error' => 1, 'msg' => 'Producto no encontrado, por favor consulte al administrador de sistema','html' => '');

        }

        return $json;
    }

    public function getDetail($id) {

      $pagos      = new \App\admin\Productos_pagos;

      $montos     = new \App\admin\Productos_montos;

      $lstPagos  = $pagos->getByProducto($id);

      $lstMontos = $montos->getByProducto($id);

      $htmlPagos = '<option value=""> ---- Seleccione ---- </option>';

      $htmlMontos = '<option value=""> ---- Seleccione ---- </option>';

      $error = 0;

      $msg = "";
      if(count($lstPagos)) {

        $error = 0;

        foreach($lstPagos as $value) {

          $htmlPagos .= '<option value="' . round($value->monto,2) . '"> ' . number_format($value->monto,2,".",","). '</option>';

        }

      } else {

        $error = 1;
        $msg .= "No se encontraron pagos configurados para este producto";

      }

      if(count($lstMontos)) {

        $error = 0;

        foreach($lstMontos as $value) {

          $htmlMontos .= '<option value="' . round($value->monto,2) . '"> ' . number_format($value->monto,2,".",","). '</option>';

        }

      } else {

        $error = 1;
        $msg = "No se encontraron montos configurados para este producto";

      }


      $json = array('error' => $error, 'msg' =>$msg, 'htmlPagos' =>$htmlPagos, 'htmlMontos' => $htmlMontos);

      return $json;

    }

    public function contrato_pdf($idSolicitud){
        $solicitud = \App\admin\Solicitudes::find($idSolicitud);
        if (empty($solicitud)){
            return abort(404);
        }
        if ($solicitud->producto_id == 1){
            return $this->contrato_clasico($idSolicitud);
        }
        if ($solicitud->producto_id == 3){
            return $this->contrato_plata($idSolicitud);
        }
        return $this->contrato_clasico($idSolicitud);
    }

    public function contrato_plata($idSolicitud){
        $solicitud = \App\admin\Solicitudes::find($idSolicitud);
        $campos = array(
            'untitled1' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled2' => utf8_decode($solicitud->cliente->fiador_nombre . ' ' . $solicitud->cliente->fiador_paterno . ' ' . $solicitud->cliente->fiador_materno),
            'untitled3' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled4' => utf8_decode($solicitud->cliente->calle . ', ' . $solicitud->cliente->colonia . ', ' . $solicitud->cliente->ciudad  . ', ' . $solicitud->cliente->estado . ', ' . $solicitud->cliente->cp),
            'untitled5' => 'INE', //Validar
            'untitled6' => utf8_decode($solicitud->cliente->fiador_nombre . ' ' . $solicitud->cliente->fiador_paterno . ' ' . $solicitud->cliente->fiador_materno),
            'untitled7' => utf8_decode($solicitud->cliente->fiador_calle . ', ' .  $solicitud->cliente->fiador_colonia . ',  ' . $solicitud->cliente->fiador_ciudad . ', ' . $solicitud->cliente->fiador_estado . ' ' . $solicitud->cliente->fiador_cp),
            'untitled8' => 'INE',//Validar
            'untitled9' => utf8_decode($solicitud->cliente->banco_cuenta),
            'untitled10' => utf8_encode($solicitud->cliente->banco_clabe),
            'untitled11' => utf8_encode($solicitud->cliente->banco),
            'untitled12' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled13' => utf8_decode($solicitud->cliente->fiador_nombre . ' ' . $solicitud->cliente->fiador_paterno . ' ' . $solicitud->cliente->fiador_materno),
            'untitled14' => date('d'),
            'untitled15' => \JorgePrz\General\Commons::nombreMes(date('m')-1),
            'untitled16' => date('Y'),
            'untitled17' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled18' =>''// utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),

        );
        $pdf = new \JorgePrz\PhpPdfForm\PdfForm(base_path() . '/downloads/templates/contrato-mutuo-plata_v2.pdf', $campos);
        $pdf->flatten()->save(base_path() . "/downloads/documentos/{$idSolicitud}_contrato.pdf")->download('contrato');
    }

    public function contrato_clasico($id){
        $solicitud = \App\admin\Solicitudes::find($id);
        $campos = array(
            'untitled1' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled2' => utf8_decode($solicitud->cliente->fiador_nombre . ' ' . $solicitud->cliente->fiador_paterno . ' ' . $solicitud->cliente->fiador_materno),
            'untitled3' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled4' => utf8_decode($solicitud->cliente->calle . ', ' . $solicitud->cliente->colonia . ', ' . $solicitud->cliente->ciudad  . ', ' . $solicitud->cliente->estado . ', ' . $solicitud->cliente->cp),
            'untitled5' => 'INE', //Validar
            'untitled6' => utf8_decode($solicitud->cliente->fiador_nombre . ' ' . $solicitud->cliente->fiador_paterno . ' ' . $solicitud->cliente->fiador_materno),
            'untitled7' => utf8_decode($solicitud->cliente->fiador_calle . ', ' .  $solicitud->cliente->fiador_colonia . ',  ' . $solicitud->cliente->fiador_ciudad . ', ' . $solicitud->cliente->fiador_estado . ' ' . $solicitud->cliente->fiador_cp),
            'untitled8' => 'INE',//Validar
            'untitled9' => utf8_decode($solicitud->cliente->banco_cuenta),
            'untitled10' => utf8_encode($solicitud->cliente->banco_clabe),
            'untitled11' => utf8_encode($solicitud->cliente->banco),
            'untitled12' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled13' => utf8_decode($solicitud->cliente->fiador_nombre . ' ' . $solicitud->cliente->fiador_paterno . ' ' . $solicitud->cliente->fiador_materno),
            'untitled14' => date('d'),
            'untitled15' => \JorgePrz\General\Commons::nombreMes(date('m')-1),
            'untitled16' => date('Y'),
            'untitled17' => utf8_decode($solicitud->cliente->nombre . ' ' . $solicitud->cliente->paterno . ' ' . $solicitud->cliente->materno),
            'untitled18' => '',

        );
        $pdf = new \JorgePrz\PhpPdfForm\PdfForm(base_path() . '/downloads/templates/contrato-clasico-v4.pdf', $campos);
        $pdf->flatten()->save(base_path() . "/downloads/documentos/{$id}_contrato.pdf")->download('contrato');
    }


}
