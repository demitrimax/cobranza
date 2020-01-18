<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Asesores extends Model
{
    protected $table = 'asesores';
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

    public function getAsesores($id){
      $data =  Asesores::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAsesoresView($id){
      $asesores = Asesores::select(array('asesores.*'));
      $asesores->where('asesores.id', $id);

      return $asesores->get()[0];

    }

    public function changeStatus($field, $id){
      $asesores = $this->getAsesores($id);
      if(count($asesores)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $asesores = $this->getAsesores($id);
      if(count($asesores)){
        $asesores->status = $num;
        $asesores->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $asesores = $this->getAsesores($id);
      if(count($asesores)){
        $img = public_path().'/uploads/'.$asesores->featured_img;
            if($asesores->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $asesores->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAsesoresData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $asesores = Asesores::select(array('asesores.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $asesores->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $asesores->where('status',1);

        // sort option
        if($sortBy!='' && $order!=''){
          $asesores->orderBy($sortBy, $order);
        } else{
          $asesores->orderBy('asesores.id', 'desc');
        }

        return $asesores->paginate($per_page);
    }

    public function getAsesoresExport($searchBy, $searchValue, $sortBy, $order){
      $asesores = Asesores::select(array('asesores.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $asesores->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $asesores->orderBy($sortBy, $order);
        } else{
          $asesores->orderBy('asesores.id', 'desc');
        }
        return $asesores->get();
    }

    public function updateAsesores($request){
      $id = $request->input('id');
      $asesores = Asesores::getAsesores($id);
      if(count($asesores)){

          $asesores->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$asesores->correo = $request->input('email')!="" ? $request->input('email') : "";
        	$asesores->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$asesores->comision = $request->input('comision')!="" ? $request->input('comision') : "";
        	$asesores->status = $request->input('status')!="" ? $request->input('status') : "";

          $asesores->supervisor = $request->input('supervisor')!="" ? $request->input('supervisor') : "";
          $asesores->password = $request->input('password')!="" ? $request->input('password') : "";

          $asesores->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAsesores($request){
      $asesores = new Asesores;

        $asesores->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$asesores->correo = $request->input('email')!="" ? $request->input('email') : "";
      	$asesores->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      	$asesores->comision = $request->input('comision')!="" ? $request->input('comision') : "";

        $asesores->supervisor = $request->input('supervisor')!="" ? $request->input('supervisor') : "";
        $asesores->password = $request->input('password')!="" ? $request->input('password') : "";

      	$asesores->status = $request->input('status')!="" ? $request->input('status') : "";

        $asesores->save();
        return $asesores->id;
    }
}
