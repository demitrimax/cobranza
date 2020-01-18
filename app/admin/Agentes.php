<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Agentes extends Model
{
    protected $table = 'agentes';
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

    public function getAgentes($id){
      $data =  Agentes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAgentesView($id){
      $agentes = Agentes::select(array('agentes.*' , 'asesores.nombre'));
      $agentes->where('agentes.id', $id);
      $agentes->leftJoin('asesores', 'agentes.asesor_id', '=','asesores.id');
      return $agentes->get()[0];

    }

    public function changeStatus($field, $id){
      $agentes = $this->getAgentes($id);
      if(count($agentes)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $agentes = $this->getAgentes($id);
      if(count($agentes)){
        $agentes->status = $num;
        $agentes->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $agentes = $this->getAgentes($id);
      if(count($agentes)){
        $img = public_path().'/uploads/'.$agentes->featured_img;
            if($agentes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $agentes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAgentesData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $agentes = Agentes::select(array('agentes.*' , 'asesores.nombre AS supervisor'));

      //join
        $agentes->leftJoin('asesores', 'agentes.asesor_id', '=','asesores.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $agentes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $agentes->where('agentes.status', 1);

        // sort option
        if($sortBy!='' && $order!=''){
          $agentes->orderBy($sortBy, $order);
        } else{
          $agentes->orderBy('agentes.id', 'desc');
        }

        return $agentes->paginate($per_page);
    }

    public function getAgentesExport($searchBy, $searchValue, $sortBy, $order){
      $agentes = Agentes::select(array('agentes.*' , 'asesores.nombre'));

      //join
        $agentes->leftJoin('asesores', 'agentes.asesor_id', '=','asesores.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $agentes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $agentes->orderBy($sortBy, $order);
        } else{
          $agentes->orderBy('agentes.id', 'desc');
        }
        return $agentes->get();
    }

    public function updateAgentes($request){
      $id = $request->input('id');
      $agentes = Agentes::getAgentes($id);
      if(count($agentes)){

          $agentes->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : "";
	$agentes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$agentes->status = $request->input('status')!="" ? $request->input('status') : "";

          $agentes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAgentes($request){
      $agentes = new Agentes;

        $agentes->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : "";
	$agentes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$agentes->status = $request->input('status')!="" ? $request->input('status') : "";

        $agentes->save();
        return true;
    }
}
