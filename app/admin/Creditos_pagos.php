<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Creditos_pagos extends Model
{
    protected $table = 'creditos_pagos';
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

    public function getCreditos_pagos($id){
      $data =  Creditos_pagos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCreditos_pagosView($id){
      $creditos_pagos = Creditos_pagos::select(array('creditos_pagos.*'));
      $creditos_pagos->where('creditos_pagos.id', $id);
      
      return $creditos_pagos->get()[0];

    }

    public function changeStatus($field, $id){
      $creditos_pagos = $this->getCreditos_pagos($id);
      if(count($creditos_pagos)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $creditos_pagos = $this->getCreditos_pagos($id);
      if(count($creditos_pagos)){
        $creditos_pagos->status = $num;
        $creditos_pagos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $creditos_pagos = $this->getCreditos_pagos($id);
      if(count($creditos_pagos)){
        $img = public_path().'/uploads/'.$creditos_pagos->featured_img;
            if($creditos_pagos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $creditos_pagos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCreditos_pagosData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $creditos_pagos = Creditos_pagos::select(array('creditos_pagos.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos_pagos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos_pagos->orderBy($sortBy, $order);
        } else{
          $creditos_pagos->orderBy('creditos_pagos.id', 'desc');
        }

        return $creditos_pagos->paginate($per_page);
    }

    public function getCreditos_pagosExport($searchBy, $searchValue, $sortBy, $order){
      $creditos_pagos = Creditos_pagos::select(array('creditos_pagos.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos_pagos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos_pagos->orderBy($sortBy, $order);
        } else{
          $creditos_pagos->orderBy('creditos_pagos.id', 'desc');
        }
        return $creditos_pagos->get();
    }

    public function updateCreditos_pagos($request){
      $id = $request->input('id');
      $creditos_pagos = Creditos_pagos::getCreditos_pagos($id);
      if(count($creditos_pagos)){

          $creditos_pagos->id = $request->input('id')!="" ? $request->input('id') : "";
	$creditos_pagos->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
	$creditos_pagos->captura_id = $request->input('captura_id')!="" ? $request->input('captura_id') : "";
	$creditos_pagos->fecha_pago = $request->input('fecha_pago')!="" ? $request->input('fecha_pago') : "";
	$creditos_pagos->fecha_captura = $request->input('fecha_captura')!="" ? $request->input('fecha_captura') : "";
	$creditos_pagos->monto = $request->input('monto')!="" ? $request->input('monto') : "";
	$creditos_pagos->capital = $request->input('capital')!="" ? $request->input('capital') : "";
	$creditos_pagos->interes = $request->input('interes')!="" ? $request->input('interes') : "";
	$creditos_pagos->voucher = $request->input('voucher')!="" ? $request->input('voucher') : "";
	$creditos_pagos->recargos = $request->input('recargos')!="" ? $request->input('recargos') : "";
	$creditos_pagos->status = $request->input('status')!="" ? $request->input('status') : "";

          $creditos_pagos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCreditos_pagos($request){
      $creditos_pagos = new Creditos_pagos;

        $creditos_pagos->id = $request->input('id')!="" ? $request->input('id') : "";
	$creditos_pagos->credito_id = $request->input('credito_id')!="" ? $request->input('credito_id') : "";
	$creditos_pagos->captura_id = $request->input('captura_id')!="" ? $request->input('captura_id') : "";
	$creditos_pagos->fecha_pago = $request->input('fecha_pago')!="" ? $request->input('fecha_pago') : "";
	$creditos_pagos->fecha_captura = $request->input('fecha_captura')!="" ? $request->input('fecha_captura') : "";
	$creditos_pagos->monto = $request->input('monto')!="" ? $request->input('monto') : "";
	$creditos_pagos->capital = $request->input('capital')!="" ? $request->input('capital') : "";
	$creditos_pagos->interes = $request->input('interes')!="" ? $request->input('interes') : "";
	$creditos_pagos->voucher = $request->input('voucher')!="" ? $request->input('voucher') : "";
	$creditos_pagos->recargos = $request->input('recargos')!="" ? $request->input('recargos') : "";
	$creditos_pagos->status = $request->input('status')!="" ? $request->input('status') : "";

        $creditos_pagos->save();
        return true;
    }
}
