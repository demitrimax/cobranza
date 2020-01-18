<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Documentos_reglas extends Model
{
    protected $table = 'documentos_reglas';
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

    public function getDocumentos_reglas($id){
      $data =  Documentos_reglas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getDocumentos_reglasView($id){
      $documentos_reglas = Documentos_reglas::select(array('documentos_reglas.*'));
      $documentos_reglas->where('documentos_reglas.id', $id);
      
      return $documentos_reglas->get()[0];

    }

    public function changeStatus($field, $id){
      $documentos_reglas = $this->getDocumentos_reglas($id);
      if(count($documentos_reglas)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $documentos_reglas = $this->getDocumentos_reglas($id);
      if(count($documentos_reglas)){
        $documentos_reglas->status = $num;
        $documentos_reglas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $documentos_reglas = $this->getDocumentos_reglas($id);
      if(count($documentos_reglas)){
        $img = public_path().'/uploads/'.$documentos_reglas->featured_img;
            if($documentos_reglas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $documentos_reglas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getDocumentos_reglasData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $documentos_reglas = Documentos_reglas::select(array('documentos_reglas.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $documentos_reglas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $documentos_reglas->orderBy($sortBy, $order);
        } else{
          $documentos_reglas->orderBy('documentos_reglas.id', 'desc');
        }

        return $documentos_reglas->paginate($per_page);
    }

    public function getDocumentos_reglasExport($searchBy, $searchValue, $sortBy, $order){
      $documentos_reglas = Documentos_reglas::select(array('documentos_reglas.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $documentos_reglas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $documentos_reglas->orderBy($sortBy, $order);
        } else{
          $documentos_reglas->orderBy('documentos_reglas.id', 'desc');
        }
        return $documentos_reglas->get();
    }

    public function updateDocumentos_reglas($request){
      $id = $request->input('id');
      $documentos_reglas = Documentos_reglas::getDocumentos_reglas($id);
      if(count($documentos_reglas)){

          $documentos_reglas->documento_id = $request->input('documento_id')!="" ? $request->input('documento_id') : "";
	$documentos_reglas->regla = $request->input('regla')!="" ? $request->input('regla') : "";
	$documentos_reglas->status = $request->input('status')!="" ? $request->input('status') : "";

          $documentos_reglas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addDocumentos_reglas($request){
      $documentos_reglas = new Documentos_reglas;

        $documentos_reglas->documento_id = $request->input('documento_id')!="" ? $request->input('documento_id') : "";
	$documentos_reglas->regla = $request->input('regla')!="" ? $request->input('regla') : "";
	$documentos_reglas->status = $request->input('status')!="" ? $request->input('status') : "";

        $documentos_reglas->save();
        return true;
    }
}
