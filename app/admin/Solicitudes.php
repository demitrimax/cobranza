<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Solicitudes extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getPermissions($id){
      $data =  Permissions::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPermissionsView($id){
      $permissions = Permissions::select(array('permissions.*'));
      $permissions->where('permissions.id', $id);

      return $permissions->get()[0];

    }

    public function getSolicitudes($id){
      $data =  Solicitudes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getSolicitudesView($id){
      $solicitudes = Solicitudes::select(array('solicitudes.*' , 'clientes.nombre AS cteNombre' , 'clientes.paterno AS ctePaterno' , 'clientes.materno AS cteMaterno' , 'productos.descripcion' , 'u1.name' , 'u2.name' , 'asesores.nombre' , 'u3.name'));
      $solicitudes->where('solicitudes.id', $id);
      $solicitudes->leftJoin('clientes', 'solicitudes.cliente_id', '=','clientes.id');
      $solicitudes->leftJoin('productos', 'solicitudes.producto_id', '=','productos.id');
      $solicitudes->leftJoin('users AS u1', 'solicitudes.captura_id', '=','u1.id');
      $solicitudes->leftJoin('users AS u2', 'solicitudes.aprueba_id', '=','u2.id');
      $solicitudes->leftJoin('asesores', 'solicitudes.asesor_id', '=','asesores.id');
      $solicitudes->leftJoin('users AS u3', 'solicitudes.user_aprueba', '=','u3.id');
      return $solicitudes->get()[0];

    }

    public function changeStatus($field, $id){
      $solicitudes = $this->getSolicitudes($id);
      if(count($solicitudes)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $solicitudes = $this->getSolicitudes($id);
      if(count($solicitudes)){
        $solicitudes->status = $num;
        $solicitudes->save();
        return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $solicitudes = $this->getSolicitudes($id);
      if(count($solicitudes)){
        $img = public_path().'/uploads/'.$solicitudes->featured_img;
            if($solicitudes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $solicitudes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getSolicitudesData($per_page, $searchBy, $searchValue, $sortBy, $order,$etapa = 2,$bandera = "",$parametro = 0){
      $solicitudes = Solicitudes::select(array('solicitudes.*' , 'clientes.nombre AS cteNombre' , 'clientes.paterno AS ctePaterno' , 'clientes.materno AS cteMaterno' , 'productos.descripcion AS producto' , 'u1.name' , 'u2.name' , 'asesores.nombre' , 'u3.name'));
      //join
        $solicitudes->leftJoin('clientes', 'solicitudes.cliente_id', '=','clientes.id');
        $solicitudes->leftJoin('productos', 'solicitudes.producto_id', '=','productos.id');
        $solicitudes->leftJoin('users AS u1', 'solicitudes.captura_id', '=','u1.id');
        $solicitudes->leftJoin('users AS u2', 'solicitudes.aprueba_id', '=','u2.id');
        $solicitudes->leftJoin('asesores', 'solicitudes.asesor_id', '=','asesores.id');
        $solicitudes->leftJoin('users AS u3', 'solicitudes.user_aprueba', '=','u3.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $solicitudes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        if(!empty($bandera)) {

          if($bandera == 'exp_completo' && $parametro == 0) {

            $solicitudes->whereIn($bandera, array(0,2));

          } else {

            $solicitudes->where($bandera, $parametro);

          }

        }

        $solicitudes->where('solicitudes.etap_flujo', '=', $etapa);

        $solicitudes->whereIn('solicitudes.status',array(1,2));

        // sort option
        if($sortBy!='' && $order!=''){
          $solicitudes->orderBy($sortBy, $order);
        } else{
          $solicitudes->orderBy('solicitudes.id', 'desc');
        }

        return $solicitudes->paginate($per_page);
    }

    public function getSolicitudesExport($searchBy, $searchValue, $sortBy, $order){
      $solicitudes = Solicitudes::select(array('solicitudes.*' , 'clientes.nombre' , 'productos.descripcion' , 'users.name' , 'users.name' , 'asesores.nombre' , 'users.name'));

      //join
        $solicitudes->leftJoin('clientes', 'solicitudes.cliente_id', '=','clientes.id');$solicitudes->leftJoin('productos', 'solicitudes.producto_id', '=','productos.id');$solicitudes->leftJoin('users', 'solicitudes.captura_id', '=','users.id');$solicitudes->leftJoin('users', 'solicitudes.aprueba_id', '=','users.id');$solicitudes->leftJoin('asesores', 'solicitudes.asesor_id', '=','asesores.id');$solicitudes->leftJoin('users', 'solicitudes.user_aprueba', '=','users.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $solicitudes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $solicitudes->orderBy($sortBy, $order);
        } else{
          $solicitudes->orderBy('solicitudes.id', 'desc');
        }
        return $solicitudes->get();
    }

    public function updateSolicitudes($request){
      $id = $request->input('id');
      $solicitudes = Solicitudes::getSolicitudes($id);
      if(count($solicitudes)){

        $solicitudes->etap_flujo = 2;
        $solicitudes->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";;
        $solicitudes->prospecto_id = $request->input('prospecto_id')!="" ? $request->input('prospecto_id') : "";
        $solicitudes->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
        $solicitudes->captura_id = Auth::user()->id;
        $solicitudes->aprueba_id = 0;
        $solicitudes->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : 0;
        $solicitudes->agente_id = $request->input('agente_id')!="" ? $request->input('agente_id') : 0;
        $solicitudes->solicitud_renueva_id = 0;
        $solicitudes->renovacion = 0;
        $solicitudes->fecha_captura = date('Y-m-d');
        $solicitudes->fecha_aprobacion = null;
        $solicitudes->fecha_firma = null;
        $solicitudes->fecha__fondeo = null;
        $solicitudes->folio = $request->input('folio')!="" ? $request->input('folio') : "";
        $solicitudes->folio_ine = $request->input('folio_ine')!="" ? $request->input('folio_ine') : 0;

        $solicitudes->monto_solicitado = $request->input('monto_solicitado')!="" ? $request->input('monto_solicitado') : "";
        $solicitudes->plazo_solicitado = $request->input('plazo_solicitado')!="" ? $request->input('plazo_solicitado') : "";
        $solicitudes->pago_solicitado = $request->input('pago_solicitado')!="" ? $request->input('pago_solicitado') : "";
        $solicitudes->interes_registro = $request->input('interes_registro')!="" ? $request->input('interes_registro') : "";

        $solicitudes->monto_aprobado = $request->input('monto_solicitado')!="" ? $request->input('monto_solicitado') : "";
      	$solicitudes->plazo_aprobado = $request->input('plazo_solicitado')!="" ? $request->input('plazo_solicitado') : "";
      	$solicitudes->pago_aprobado = $request->input('pago_solicitado')!="" ? $request->input('pago_solicitado') : "";
      	$solicitudes->interes_aprobado = $request->input('interes_registro')!="" ? $request->input('interes_registro') : "";

        $solicitudes->monto_fondeado = 0;
        $solicitudes->exp_aprobado = 0;
        $solicitudes->msg_aprobacion = 0;
        $solicitudes->msg_rechazo = null;
        $solicitudes->fecha_extaprueba = null;
        $solicitudes->user_aprueba = null;
        $solicitudes->autorizado = 0;
        $solicitudes->exp_completo = 0;
        $solicitudes->firmado = 0;
        $solicitudes->fondeado = 0;
        $solicitudes->ctto_firmado = 0;
        $solicitudes->contratos = null;
        $solicitudes->contratos_firmados = null;
        $solicitudes->pagares_firmados = null;
        $solicitudes->aprivacidad_cliente = null;
        $solicitudes->aprivacidad_aval = null;
        $solicitudes->status = $request->input('status')!="" ? $request->input('status') : 1;

          $solicitudes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addSolicitudes($request,$cliente_id){
      $solicitudes = new Solicitudes;

        $solicitudes->etap_flujo = 2;
      	$solicitudes->cliente_id = $cliente_id;
      	$solicitudes->prospecto_id = $request->input('prospecto_id')!="" ? $request->input('prospecto_id') : 0;
      	$solicitudes->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
      	$solicitudes->captura_id = Auth::user()->id;
      	$solicitudes->aprueba_id = 0;
      	$solicitudes->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : 0;
        $solicitudes->agente_id = $request->input('agente_id')!="" ? $request->input('agente_id') : 0;
      	$solicitudes->solicitud_renueva_id = $request->input('solicitud_renueva_id')!="" ? $request->input('solicitud_renueva_id') : 0;
      	$solicitudes->renovacion = $request->input('renovacion')!="" ? $request->input('renovacion') : 0;
      	$solicitudes->fecha_captura = date('Y-m-d');
      	$solicitudes->fecha_aprobacion = null;
      	$solicitudes->fecha_firma = null;
      	$solicitudes->fecha__fondeo = null;
      	$solicitudes->folio = $request->input('folio')!="" ? $request->input('folio') : "";
        $solicitudes->folio_ine = $request->input('folio_ine')!="" ? $request->input('folio_ine') : 0;
      	$solicitudes->monto_solicitado = $request->input('monto_solicitado')!="" ? $request->input('monto_solicitado') : "";
      	$solicitudes->plazo_solicitado = $request->input('plazo_solicitado')!="" ? $request->input('plazo_solicitado') : "";
      	$solicitudes->pago_solicitado = $request->input('pago_solicitado')!="" ? $request->input('pago_solicitado') : "";
      	$solicitudes->interes_registro = $request->input('interes_registro')!="" ? $request->input('interes_registro') : "";

      	$solicitudes->monto_aprobado = $request->input('monto_solicitado')!="" ? $request->input('monto_solicitado') : "";
      	$solicitudes->plazo_aprobado = $request->input('plazo_solicitado')!="" ? $request->input('plazo_solicitado') : "";
      	$solicitudes->pago_aprobado = $request->input('pago_solicitado')!="" ? $request->input('pago_solicitado') : "";
      	$solicitudes->interes_aprobado = $request->input('interes_registro')!="" ? $request->input('interes_registro') : "";


      	$solicitudes->autorizado = $request->input('autorizado');

        if($request->input('autorizado') != 0) {

          $solicitudes->user_aprueba = Auth::user()->id;

        } else {

          $solicitudes->user_aprueba = 0;

        }

      	$solicitudes->monto_fondeado = 0;
      	$solicitudes->exp_aprobado = 0;
      	$solicitudes->msg_aprobacion = 0;
      	$solicitudes->msg_rechazo = null;
      	$solicitudes->fecha_extaprueba = date('Y-m-d');

      	$solicitudes->exp_completo = 1;

      	$solicitudes->firmado = 0;
      	$solicitudes->fondeado = 0;
      	$solicitudes->ctto_firmado = 0;
      	$solicitudes->contratos = null;
      	$solicitudes->contratos_firmados = null;
      	$solicitudes->pagares_firmados = null;
      	$solicitudes->aprivacidad_cliente = null;
      	$solicitudes->aprivacidad_aval = null;
      	$solicitudes->status = $request->input('status')!="" ? $request->input('status') : 1;

        $solicitudes->save();

        return $solicitudes->id;
    }

    public function cuentaSolicitudes() {

        $solicitudes = Solicitudes::select(DB::raw('count(*) as total, etap_flujo'))->where('status',2)->groupBy('etap_flujo');

        if(Auth::user()->fondeador_id != 0) {

          $solicitudes->where('fondeador_id',Auth::user()->fondeador_id);

        }

        if(Auth::user()->supervisor_id != 0) {

          $solicitudes->where('supervisor_id',Auth::user()->supervisor_id);

        }

        if(Auth::user()->vendedor_id != 0) {

          $solicitudes->where('vendedor_id',Auth::user()->vendedor_id);

        }

        $data = $solicitudes->get();

        return $data;

    }

    public function cuentaRechazados() {

      $solicitudes = Solicitudes::select(DB::raw('count(*) as total, etap_flujo'))->groupBy('etap_flujo');

      return $solicitudes->get();

    }

    public function avanzaSolicitud($id) {

      $solicitudes = Solicitudes::getSolicitudes($id);

      if(count($solicitudes)){

          $solicitudes->etap_flujo = $solicitudes->etap_flujo + 1;

          $solicitudes->save();
          return true;
      } else{
          return false;
      }

    }

    public function getSolicitudesRechazos($per_page, $searchBy, $searchValue, $sortBy, $order,$etapa,$bandera = "",$parametro = 0){
        $solicitudes = Solicitudes::select(array('solicitudes.*' ,
            'etapas.nombre AS etapa' ,
            'clientes.nombre AS cteNombre' ,
            'clientes.paterno AS ctePaterno' ,
            'clientes.materno AS cteMaterno' ,
            'productos.descripcion AS producto',
            'etapas.nombre AS etapa'
        ));

        //join
        $solicitudes->leftJoin('etapas', 'solicitudes.etap_flujo', '=','etapas.id');
        $solicitudes->leftJoin('clientes', 'solicitudes.cliente_id', '=','clientes.id');
        $solicitudes->leftJoin('productos', 'solicitudes.producto_id', '=','productos.id');

        if(Auth::user()->fondeador_id != 0){

          $solicitudes->where('solicitudes.fondeador_id', Auth::user()->fondeador_id);

        }

        // where condition
        if(Auth::user()->vendedor_id != 0){

          $solicitudes->where('solicitudes.vendedor_id', Auth::user()->vendedor_id);

        }

        if(Auth::user()->supervisor_id != 0){

          $solicitudes->where('solicitudes.supervisor_id', Auth::user()->supervisor_id);

        }

          // where condition
        if($searchBy!='' && $searchValue!=''){

            $solicitudes->where($searchBy, 'like', '%'.$searchValue.'%');

        }

        if(!empty($bandera)) {

            $solicitudes->where($bandera, $parametro);

        }

        $solicitudes->where('solicitudes.status',4);


        // sort option
        if($sortBy!='' && $order!=''){
            $solicitudes->orderBy($sortBy, $order);
        } else{
            $solicitudes->orderBy('solicitudes.id', 'desc');
        }

        return $solicitudes->paginate($per_page);
    }

    public function apruebaExpediente($id,$request) {

      $solicitudes = Solicitudes::getSolicitudes($id);
      if(count($solicitudes)){

          $solicitudes->exp_aprobado      = $request->input('bandera');
          $solicitudes->exp_completo      = $request->input('bandera');
          $solicitudes->fecha_extaprueba  = date('Y-m-d');
          $solicitudes->user_aprueba      = Auth::user()->id;
          $solicitudes->save();
          return true;
      } else{

          return false;
      }

    }

    public function apruebaSolicitud($request){

        $id = $request->input('id');
        $solicitudes = Solicitudes::getSolicitudes($id);

        if(count($solicitudes)){

            $solicitudes->monto_aprobado = $request->input('monto_aprobado')!="" ? $request->input('monto_aprobado') : 0;
            $solicitudes->plazo_aprobado = $request->input('plazo_aprobado')!="" ? $request->input('plazo_aprobado') : 0;
            $solicitudes->pago_aprobado = $request->input('pago_aprobado')!="" ? $request->input('pago_aprobado') : 0;
            $solicitudes->autorizado = 1;
            $solicitudes->status = 2;

            $solicitudes->save();
            return true;
        } else{
            return false;
        }
    }

    public function firmaSolicitud($request){

        $id = $request->input('id');
        $solicitudes = Solicitudes::getSolicitudes($id);
        if(count($solicitudes)){

            $solicitudes->fecha_firma = $request->input('fecha_firma')!="" ? date('Y-m-d',strtotime($request->input('fecha_firma'))) : date('Y-m-d');
            $solicitudes->firmado = 1;

            $imagen_name='';
            $imagen_file = $request->file('contratos');

            if(!is_null($imagen_file) ){

                $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
                $imagen_file->move('uploads',$imagen_name);
                $solicitudes->contratos = $imagen_name;

            } else {
                $solicitudes->contratos = $request->input('contratos_old')!="" ? $request->input('contratos_old') : null;
            }

            $imagen_name='';
            $imagen_file = $request->file('contratos_firmados');

            if(!is_null($imagen_file) ){

                $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
                $imagen_file->move('uploads',$imagen_name);
                $solicitudes->contratos_firmados = $imagen_name;
                $solicitudes->ctto_firmado = 1;
                $solicitudes->fecha_firma = date('Y-m-d');

            } else {
                $solicitudes->contratos_firmados = $request->input('contratos_firmados')!="" ? $request->input('contratos_firmados') : null;;
            }

            $imagen_name='';
            $imagen_file = $request->file('pagares_firmados');

            if(!is_null($imagen_file) ){

                $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
                $imagen_file->move('uploads',$imagen_name);
                $solicitudes->pagares_firmados = $imagen_name;

            } else {
                $solicitudes->pagares_firmados = $request->input('pagares_firmados_old')!="" ? $request->input('pagares_firmados_old') : null;;
            }

            $imagen_name='';
            $imagen_file = $request->file('aprivacidadcliente_firmados');

            if(!is_null($imagen_file) ){

                $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
                $imagen_file->move('uploads',$imagen_name);
                $solicitudes->aprivacidad_cliente = $imagen_name;

            } else {
                $solicitudes->aprivacidad_cliente = $request->input('aprivacidadcliente_firmados_old')!="" ? $request->input('aprivacidadcliente_firmados_old') : null;;
            }

            $imagen_name='';
            $imagen_file = $request->file('aprivacidadaval_firmados');

            if(!is_null($imagen_file) ){

                $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
                $imagen_file->move('uploads',$imagen_name);
                $solicitudes->aprivacidad_aval = $imagen_name;

            } else {
                $solicitudes->aprivacidad_aval = $request->input('aprivacidadaval_firmados_old')!="" ? $request->input('aprivacidadaval_firmados_old') : null;;
            }
            $solicitudes->save();
            return true;
        } else{
            return false;
        }
    }

    public function getPorcentajeAvance(){
        $etapaId = $this->etap_flujo;
        $avance = 0;
        $etapas = \App\admin\Etapas::where('status', 1)->orderBy('orden', 'ASC')->get();
        $posicion = 0;
        foreach ($etapas as $key => $value) {
            $posicion += 1;
            if ($value->id == $etapaId){
                break;
            }
        }
        if (count($etapas) > 0){
            $avance = (100 / count($etapas)) * $posicion;
        }
        return $avance;

    }

    public function dispersionMovimientos(){
        return $this->hasMany('\App\admin\Dispersion', 'solicitud_id', 'id');
    }

    public function cliente(){
        return $this->hasOne('\App\admin\Clientes', 'id', 'cliente_id');
    }

    public function fondeador(){
        return $this->hasOne('\App\admin\Fondeadores', 'id', 'fondeador_id');
    }

    public function producto(){
        return $this->hasOne('\App\admin\Productos', 'id', 'producto_id');
    }

    public function captura(){
        return $this->hasOne('\App\admin\Users', 'id', 'captura_id');
    }

    public function aprueba(){
        return $this->hasOne('\App\admin\Users', 'id', 'aprueba_id');
    }

    public function etapa(){
        return $this->hasOne('\App\admin\Etapas', 'id', 'etap_flujo');
    }
    public function telefonos()
    {
      return $this->belongsToMany('App\Models\ctelefonos', 'cliente_id', '');
    }
}
