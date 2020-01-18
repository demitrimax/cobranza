<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Plazos extends Model
{
    protected $table = 'plazos';
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

    public function getPlazos($id){
      $data =  Plazos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPlazosView($id){
      $plazos = Plazos::select(array('plazos.*'));
      $plazos->where('plazos.id', $id);
      
      return $plazos->get()[0];

    }

    public function changeStatus($field, $id){
      $plazos = $this->getPlazos($id);
      if(count($plazos)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $plazos = $this->getPlazos($id);
      if(count($plazos)){
        $plazos->status = $num;
        $plazos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $plazos = $this->getPlazos($id);
      if(count($plazos)){
        $img = public_path().'/uploads/'.$plazos->featured_img;
            if($plazos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $plazos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getPlazosData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $plazos = Plazos::select(array('plazos.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $plazos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $plazos->orderBy($sortBy, $order);
        } else{
          $plazos->orderBy('plazos.id', 'desc');
        }

        return $plazos->paginate($per_page);
    }

    public function getPlazosExport($searchBy, $searchValue, $sortBy, $order){
      $plazos = Plazos::select(array('plazos.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $plazos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $plazos->orderBy($sortBy, $order);
        } else{
          $plazos->orderBy('plazos.id', 'desc');
        }
        return $plazos->get();
    }

    public function updatePlazos($request){
      $id = $request->input('id');
      $plazos = Plazos::getPlazos($id);
      if(count($plazos)){

          $plazos->plazo = $request->input('plazo')!="" ? $request->input('plazo') : "";
	$plazos->periodicidad = $request->input('periodicidad')!="" ? $request->input('periodicidad') : "";
	$plazos->status = $request->input('status')!="" ? $request->input('status') : "";

          $plazos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPlazos($request){
      $plazos = new Plazos;

        $plazos->plazo = $request->input('plazo')!="" ? $request->input('plazo') : "";
	$plazos->periodicidad = $request->input('periodicidad')!="" ? $request->input('periodicidad') : "";
	$plazos->status = $request->input('status')!="" ? $request->input('status') : "";

        $plazos->save();
        return true;
    }
}
