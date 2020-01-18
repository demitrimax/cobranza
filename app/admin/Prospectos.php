<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Prospectos extends Model
{
    protected $table = 'prospectos';
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

    public function getProspectos($id){
      $data =  Prospectos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getProspectosView($id){
      $prospectos = Prospectos::select(array('prospectos.*' , 'productos.descripcion' , 'plazos.plazo' , 'asesores.nombre'));
      $prospectos->where('prospectos.id', $id);
      $prospectos->leftJoin('productos', 'prospectos.producto_id', '=','productos.id');$prospectos->leftJoin('plazos', 'prospectos.plazo_id', '=','plazos.id');$prospectos->leftJoin('asesores', 'prospectos.asesor_id', '=','asesores.id');
      return $prospectos->get()[0];

    }

    public function changeStatus($field, $id){
      $prospectos = $this->getProspectos($id);
      if(count($prospectos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $prospectos = $this->getProspectos($id);
      if(count($prospectos)){
        $prospectos->status = $num;
        $prospectos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $prospectos = $this->getProspectos($id);
      if(count($prospectos)){
        $img = public_path().'/uploads/'.$prospectos->featured_img;
            if($prospectos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $prospectos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getProspectosData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $prospectos = Prospectos::select(array('prospectos.*' , 'productos.descripcion AS producto' , 'plazos.plazo AS plazo' , 'asesores.nombre as asNombre'));

      //join
        $prospectos->leftJoin('productos', 'prospectos.producto_id', '=','productos.id');$prospectos->leftJoin('plazos', 'prospectos.plazo_id', '=','plazos.id');$prospectos->leftJoin('asesores', 'prospectos.asesor_id', '=','asesores.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $prospectos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $prospectos->orderBy($sortBy, $order);
        } else{
          $prospectos->orderBy('prospectos.id', 'desc');
        }

        return $prospectos->paginate($per_page);
    }

    public function getProspectosExport($searchBy, $searchValue, $sortBy, $order){
      $prospectos = Prospectos::select(array('prospectos.*' , 'productos.descripcion' , 'plazos.plazo' , 'asesores.nombre'));

      //join
        $prospectos->leftJoin('productos', 'prospectos.producto_id', '=','productos.id');$prospectos->leftJoin('plazos', 'prospectos.plazo_id', '=','plazos.id');$prospectos->leftJoin('asesores', 'prospectos.asesor_id', '=','asesores.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $prospectos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $prospectos->orderBy($sortBy, $order);
        } else{
          $prospectos->orderBy('prospectos.id', 'desc');
        }
        return $prospectos->get();
    }

    public function updateProspectos($request){
      $id = $request->input('id');
      $prospectos = Prospectos::getProspectos($id);
      if(count($prospectos)){

          $prospectos->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
        	$prospectos->plazo_id = $request->input('plazo_id')!="" ? $request->input('plazo_id') : "";
        	$prospectos->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : "";
        	$prospectos->monto = $request->input('monto')!="" ? $request->input('monto') : "";
        	$prospectos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$prospectos->paterno = $request->input('paterno')!="" ? $request->input('paterno') : "";
        	$prospectos->materno = $request->input('materno')!="" ? $request->input('materno') : "";
        	$prospectos->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        	$prospectos->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$prospectos->email = $request->input('email')!="" ? $request->input('email') : "";
        	$prospectos->pago_semanal = $request->input('pago_semanal')!="" ? $request->input('pago_semanal') : "";
        	$prospectos->ingresos_mensuales = $request->input('ingresos_mensuales')!="" ? $request->input('ingresos_mensuales') : "";
        	$prospectos->gastos_mensuales = $request->input('gastos_mensuales')!="" ? $request->input('gastos_mensuales') : "";
        	$prospectos->status = $request->input('status')!="" ? $request->input('status') : "";

          $prospectos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addProspectos($request){
      $prospectos = new Prospectos;

        $prospectos->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
      	$prospectos->plazo_id = $request->input('plazo_id')!="" ? $request->input('plazo_id') : "";
      	$prospectos->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : "";
      	$prospectos->monto = $request->input('monto')!="" ? $request->input('monto') : "";
      	$prospectos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$prospectos->paterno = $request->input('paterno')!="" ? $request->input('paterno') : "";
      	$prospectos->materno = $request->input('materno')!="" ? $request->input('materno') : "";
      	$prospectos->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
      	$prospectos->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      	$prospectos->email = $request->input('email')!="" ? $request->input('email') : "";
      	$prospectos->pago_semanal = $request->input('pago_semanal')!="" ? $request->input('pago_semanal') : "";
      	$prospectos->ingresos_mensuales = $request->input('ingresos_mensuales')!="" ? $request->input('ingresos_mensuales') : "";
      	$prospectos->gastos_mensuales = $request->input('gastos_mensuales')!="" ? $request->input('gastos_mensuales') : "";
      	$prospectos->msr_rechazo = null;
      	$prospectos->fecha_alta = date('Y-m-d');
      	$prospectos->fecha_rechazo = null;
      	$prospectos->status = $request->input('status')!="" ? $request->input('status') : "";

        $prospectos->save();
        return true;
    }

    public function cuentaProspectos() {

      $prospectos = Prospectos::select(DB::raw('count(*) as total, status'))->groupBy('status');

      if(Auth::user()->fondeador_id != 0) {

        $prospectos->where('fondeador_id',Auth::user()->fondeador_id);

      }

      if(Auth::user()->supervisor_id != 0) {

        $prospectos->where('supervisor_id',Auth::user()->supervisor_id);

      }

      if(Auth::user()->vendedor_id != 0) {

        $prospectos->where('vendedor_id',Auth::user()->vendedor_id);

      }

      $data = $prospectos->get();

      return $data;

    }

    public function rechazaProspectos($id,$mensaje){

        $prospectos = Prospectos::getProspectos($id);
        if(count($prospectos)){

          $prospectos->msr_rechazo  = $mensaje;
          $prospectos->status       = 3;
          $prospectos->fecha_rechazo = date('Y-m-d H:i:s');

          $prospectos->save();
          return true;

        } else{

          return false;

        }
    }

    public function bajaProspecto($id){
        $prospectos = Prospectos::getProspectos($id);
        if(count($prospectos)){

          $prospectos->status = 2;
          $prospectos->save();
          return true;
        } else{
            return false;
        }
    }
}
