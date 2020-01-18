<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Creditos_cuotas extends Model
{
    protected $table = 'creditos_cuotas';
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

    public function getCreditos_cuotas($id){
      $data =  Creditos_cuotas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCreditos_cuotasView($id){
      $creditos_cuotas = Creditos_cuotas::select(array('creditos_cuotas.*'));
      $creditos_cuotas->where('creditos_cuotas.id', $id);
      
      return $creditos_cuotas->get()[0];

    }

    public function changeStatus($field, $id){
      $creditos_cuotas = $this->getCreditos_cuotas($id);
      if(count($creditos_cuotas)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $creditos_cuotas = $this->getCreditos_cuotas($id);
      if(count($creditos_cuotas)){
        $creditos_cuotas->status = $num;
        $creditos_cuotas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $creditos_cuotas = $this->getCreditos_cuotas($id);
      if(count($creditos_cuotas)){
        $img = public_path().'/uploads/'.$creditos_cuotas->featured_img;
            if($creditos_cuotas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $creditos_cuotas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCreditos_cuotasData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $creditos_cuotas = Creditos_cuotas::select(array('creditos_cuotas.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos_cuotas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos_cuotas->orderBy($sortBy, $order);
        } else{
          $creditos_cuotas->orderBy('creditos_cuotas.id', 'desc');
        }

        return $creditos_cuotas->paginate($per_page);
    }

    public function getCreditos_cuotasExport($searchBy, $searchValue, $sortBy, $order){
      $creditos_cuotas = Creditos_cuotas::select(array('creditos_cuotas.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos_cuotas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos_cuotas->orderBy($sortBy, $order);
        } else{
          $creditos_cuotas->orderBy('creditos_cuotas.id', 'desc');
        }
        return $creditos_cuotas->get();
    }

    public function updateCreditos_cuotas($request){
      $id = $request->input('id');
      $creditos_cuotas = Creditos_cuotas::getCreditos_cuotas($id);
      if(count($creditos_cuotas)){

          $creditos_cuotas->id = $request->input('id')!="" ? $request->input('id') : "";
	$creditos_cuotas->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
	$creditos_cuotas->pago_id = $request->input('pago_id')!="" ? $request->input('pago_id') : "";
	$creditos_cuotas->saldo_actual = $request->input('saldo_actual')!="" ? $request->input('saldo_actual') : "";
	$creditos_cuotas->amortizacion = $request->input('amortizacion')!="" ? $request->input('amortizacion') : "";
	$creditos_cuotas->moratorios = $request->input('moratorios')!="" ? $request->input('moratorios') : "";
	$creditos_cuotas->pago_aplicado = $request->input('pago_aplicado')!="" ? $request->input('pago_aplicado') : "";
	$creditos_cuotas->saldo_final = $request->input('saldo_final')!="" ? $request->input('saldo_final') : "";
	$creditos_cuotas->fecha_inicio = $request->input('fecha_inicio')!="" ? $request->input('fecha_inicio') : "";
	$creditos_cuotas->fecha_vence = $request->input('fecha_vence')!="" ? $request->input('fecha_vence') : "";
	$creditos_cuotas->fecha_pago = $request->input('fecha_pago')!="" ? $request->input('fecha_pago') : "";
	$creditos_cuotas->puntaje = $request->input('puntaje')!="" ? $request->input('puntaje') : "";
	$creditos_cuotas->status = $request->input('status')!="" ? $request->input('status') : "";

          $creditos_cuotas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCreditos_cuotas($request){
      $creditos_cuotas = new Creditos_cuotas;

        $creditos_cuotas->id = $request->input('id')!="" ? $request->input('id') : "";
	$creditos_cuotas->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
	$creditos_cuotas->pago_id = $request->input('pago_id')!="" ? $request->input('pago_id') : "";
	$creditos_cuotas->saldo_actual = $request->input('saldo_actual')!="" ? $request->input('saldo_actual') : "";
	$creditos_cuotas->amortizacion = $request->input('amortizacion')!="" ? $request->input('amortizacion') : "";
	$creditos_cuotas->moratorios = $request->input('moratorios')!="" ? $request->input('moratorios') : "";
	$creditos_cuotas->pago_aplicado = $request->input('pago_aplicado')!="" ? $request->input('pago_aplicado') : "";
	$creditos_cuotas->saldo_final = $request->input('saldo_final')!="" ? $request->input('saldo_final') : "";
	$creditos_cuotas->fecha_inicio = $request->input('fecha_inicio')!="" ? $request->input('fecha_inicio') : "";
	$creditos_cuotas->fecha_vence = $request->input('fecha_vence')!="" ? $request->input('fecha_vence') : "";
	$creditos_cuotas->fecha_pago = $request->input('fecha_pago')!="" ? $request->input('fecha_pago') : "";
	$creditos_cuotas->puntaje = $request->input('puntaje')!="" ? $request->input('puntaje') : "";
	$creditos_cuotas->status = $request->input('status')!="" ? $request->input('status') : "";

        $creditos_cuotas->save();
        return true;
    }
}
