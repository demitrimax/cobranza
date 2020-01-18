<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Dispersion extends Model
{
    protected $table = 'dispersion';
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

    public function getDispersion($id){
      $data =  Dispersion::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getDispersionView($id){
      $dispersion = Dispersion::select(array('dispersion.*'));
      $dispersion->where('dispersion.id', $id);
      
      return $dispersion->get()[0];

    }

    public function changeStatus($field, $id){
      $dispersion = $this->getDispersion($id);
      if(count($dispersion)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $dispersion = $this->getDispersion($id);
      if(count($dispersion)){
        $dispersion->status = $num;
        $dispersion->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $dispersion = $this->getDispersion($id);
      if(count($dispersion)){
        $img = public_path().'/uploads/'.$dispersion->featured_img;
            if($dispersion->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $dispersion->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getDispersionData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $dispersion = Dispersion::select(array('dispersion.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $dispersion->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $dispersion->orderBy($sortBy, $order);
        } else{
          $dispersion->orderBy('dispersion.id', 'desc');
        }

        return $dispersion->paginate($per_page);
    }

    public function getDispersionExport($searchBy, $searchValue, $sortBy, $order){
      $dispersion = Dispersion::select(array('dispersion.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $dispersion->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $dispersion->orderBy($sortBy, $order);
        } else{
          $dispersion->orderBy('dispersion.id', 'desc');
        }
        return $dispersion->get();
    }

    public function updateDispersion($request){
      $id = $request->input('id');
      $dispersion = Dispersion::getDispersion($id);
      if(count($dispersion)){

          $dispersion->id = $request->input('id')!="" ? $request->input('id') : "";
	$dispersion->solicitud_id = $request->input('solicitud_id')!="" ? $request->input('solicitud_id') : "";
	$dispersion->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
	$dispersion->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$dispersion->cuenta_origen = $request->input('cuenta_origen')!="" ? $request->input('cuenta_origen') : "";
	$dispersion->cuenta_destino = $request->input('cuenta_destino')!="" ? $request->input('cuenta_destino') : "";
	$dispersion->monto = $request->input('monto')!="" ? $request->input('monto') : "";
	$dispersion->observaciones = $request->input('observaciones')!="" ? $request->input('observaciones') : "";
	$dispersion->status = $request->input('status')!="" ? $request->input('status') : "";

          $dispersion->save();
          return true;
      } else{
        return false;
      }
    }

    public function addDispersion($request){
      $dispersion = new Dispersion;

        $dispersion->id = $request->input('id')!="" ? $request->input('id') : "";
	$dispersion->solicitud_id = $request->input('solicitud_id')!="" ? $request->input('solicitud_id') : "";
	$dispersion->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
	$dispersion->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$dispersion->cuenta_origen = $request->input('cuenta_origen')!="" ? $request->input('cuenta_origen') : "";
	$dispersion->cuenta_destino = $request->input('cuenta_destino')!="" ? $request->input('cuenta_destino') : "";
	$dispersion->monto = $request->input('monto')!="" ? $request->input('monto') : "";
	$dispersion->observaciones = $request->input('observaciones')!="" ? $request->input('observaciones') : "";
	$dispersion->status = $request->input('status')!="" ? $request->input('status') : "";

        $dispersion->save();
        return true;
    }
}
