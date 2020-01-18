<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';
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

    public function getPagos($id){
      $data =  Pagos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPagosView($id){
      $pagos = Pagos::select(array('pagos.*' , 'creditos.cliente_id'));
      $pagos->where('pagos.id', $id);
      $pagos->leftJoin('creditos', 'pagos.credito_id', '=','creditos.id');
      return $pagos->get()[0];

    }

    public function changeStatus($field, $id){
      $pagos = $this->getPagos($id);
      if(count($pagos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $pagos = $this->getPagos($id);
      if(count($pagos)){
        $pagos->status = $num;
        $pagos->save();
        return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $pagos = $this->getPagos($id);
      if(count($pagos)){
        $img = public_path().'/uploads/'.$pagos->featured_img;
            if($pagos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $pagos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getPagosData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $pagos = Pagos::select(array('pagos.*' , 'creditos.cliente_id'));

      //join
        $pagos->leftJoin('creditos', 'pagos.credito_id', '=','creditos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $pagos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $pagos->orderBy($sortBy, $order);
        } else{
          $pagos->orderBy('pagos.id', 'desc');
        }

        return $pagos->paginate($per_page);
    }

    public function getPagosExport($searchBy, $searchValue, $sortBy, $order){
      $pagos = Pagos::select(array('pagos.*' , 'creditos.cliente_id'));

      //join
        $pagos->leftJoin('creditos', 'pagos.credito_id', '=','creditos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $pagos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $pagos->orderBy($sortBy, $order);
        } else{
          $pagos->orderBy('pagos.id', 'desc');
        }
        return $pagos->get();
    }

    public function updatePagos($request){
      $id = $request->input('id');
      $pagos = Pagos::getPagos($id);
      if(count($pagos)){

          $pagos->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
        	$pagos->fecha_pago = $request->input('fecha_pago')!="" ? $request->input('fecha_pago') : "";
        	$pagos->hora_pago = $request->input('hora_pago')!="" ? $request->input('hora_pago') : "";
        	$pagos->monto_pago = $request->input('monto_pago')!="" ? $request->input('monto_pago') : "";
        	$pagos->status = $request->input('status')!="" ? $request->input('status') : "";

          $pagos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPagos($request){
      $pagos = new Pagos;

        $pagos->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
      	$pagos->fecha_pago = $request->input('fecha_pago')!="" ? date('Y-m-d',strtotime($request->input('fecha_pago'))) : "";
      	$pagos->hora_pago  = date('H:i:s');
      	$pagos->monto_pago = $request->input('monto_pago')!="" ? $request->input('monto_pago') : "";
      	$pagos->status = $request->input('status')!="" ? $request->input('status') : "";

        $pagos->save();
        return $pagos->id;
    }

    public function insertaLayout($request) {

      $layout_id = DB::table('layouts')->insertGetId([
                                                      'asesor_id'   => $request->input('asesor_id') != "" ? $request->input('asesor_id') : "",
                                                      'alias'       => $request->input('alias') != "" ? $request->input('alias') : "",
                                                      'fecha'       => date('Y-m-d'),
                                                      'status'      => 1
                                                    ]);

      foreach($request->input('creditos') AS $credito) {

        DB::table('layouts_detalle')->insert([
                                                'layout_id'   => $layout_id,
                                                'credito_id'  => $credito,
                                                'monto'       => 0,
                                                'pagado'      => 0
                                              ]);

      }

    }

    public function getActives() {
      $data = DB::table('creditos')
                                   ->select(array('creditos.*' , 'clientes.nombre', 'clientes.paterno', 'clientes.materno'))
                                   ->join('clientes','clientes.id','=','creditos.cliente_id')
                                   ->where('creditos.status',2)
                                   ->get();

      if($data) {
        return $data;
      } else {
        return array();
      }
    }
}
