<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Creditos_transacciones extends Model
{
    protected $table = 'creditos_transacciones';
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

    public function getCreditos_transacciones($id){
      $data =  Creditos_transacciones::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCreditos_transaccionesView($id){
      $creditos_transacciones = Creditos_transacciones::select(array('creditos_transacciones.*'));
      $creditos_transacciones->where('creditos_transacciones.id', $id);
      
      return $creditos_transacciones->get()[0];

    }

    public function changeStatus($field, $id){
      $creditos_transacciones = $this->getCreditos_transacciones($id);
      if(count($creditos_transacciones)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $creditos_transacciones = $this->getCreditos_transacciones($id);
      if(count($creditos_transacciones)){
        $creditos_transacciones->status = $num;
        $creditos_transacciones->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $creditos_transacciones = $this->getCreditos_transacciones($id);
      if(count($creditos_transacciones)){
        $img = public_path().'/uploads/'.$creditos_transacciones->featured_img;
            if($creditos_transacciones->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $creditos_transacciones->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCreditos_transaccionesData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $creditos_transacciones = Creditos_transacciones::select(array('creditos_transacciones.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos_transacciones->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos_transacciones->orderBy($sortBy, $order);
        } else{
          $creditos_transacciones->orderBy('creditos_transacciones.id', 'desc');
        }

        return $creditos_transacciones->paginate($per_page);
    }

    public function getCreditos_transaccionesExport($searchBy, $searchValue, $sortBy, $order){
      $creditos_transacciones = Creditos_transacciones::select(array('creditos_transacciones.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos_transacciones->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos_transacciones->orderBy($sortBy, $order);
        } else{
          $creditos_transacciones->orderBy('creditos_transacciones.id', 'desc');
        }
        return $creditos_transacciones->get();
    }

    public function updateCreditos_transacciones($request){
      $id = $request->input('id');
      $creditos_transacciones = Creditos_transacciones::getCreditos_transacciones($id);
      if(count($creditos_transacciones)){

          $creditos_transacciones->id = $request->input('id')!="" ? $request->input('id') : "";
	$creditos_transacciones->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
	$creditos_transacciones->cuota_id = $request->input('cuota_id')!="" ? $request->input('cuota_id') : "";
	$creditos_transacciones->transaccion = $request->input('transaccion')!="" ? $request->input('transaccion') : "";
	$creditos_transacciones->saldo_anterior = $request->input('saldo_anterior')!="" ? $request->input('saldo_anterior') : "";
	$creditos_transacciones->cargo = $request->input('cargo')!="" ? $request->input('cargo') : "";
	$creditos_transacciones->abono = $request->input('abono')!="" ? $request->input('abono') : "";
	$creditos_transacciones->saldo_final = $request->input('saldo_final')!="" ? $request->input('saldo_final') : "";
	$creditos_transacciones->fecha_transaccion = $request->input('fecha_transaccion')!="" ? $request->input('fecha_transaccion') : "";
	$creditos_transacciones->status = $request->input('status')!="" ? $request->input('status') : "";

          $creditos_transacciones->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCreditos_transacciones($request){
      $creditos_transacciones = new Creditos_transacciones;

        $creditos_transacciones->id = $request->input('id')!="" ? $request->input('id') : "";
	$creditos_transacciones->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
	$creditos_transacciones->cuota_id = $request->input('cuota_id')!="" ? $request->input('cuota_id') : "";
	$creditos_transacciones->transaccion = $request->input('transaccion')!="" ? $request->input('transaccion') : "";
	$creditos_transacciones->saldo_anterior = $request->input('saldo_anterior')!="" ? $request->input('saldo_anterior') : "";
	$creditos_transacciones->cargo = $request->input('cargo')!="" ? $request->input('cargo') : "";
	$creditos_transacciones->abono = $request->input('abono')!="" ? $request->input('abono') : "";
	$creditos_transacciones->saldo_final = $request->input('saldo_final')!="" ? $request->input('saldo_final') : "";
	$creditos_transacciones->fecha_transaccion = $request->input('fecha_transaccion')!="" ? $request->input('fecha_transaccion') : "";
	$creditos_transacciones->status = $request->input('status')!="" ? $request->input('status') : "";

        $creditos_transacciones->save();
        return true;
    }
}
