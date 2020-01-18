<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Solicitudes_expediente extends Model
{
    protected $table = 'solicitudes_expediente';
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

    public function getSolicitudes_expediente($id){
      $data =  Solicitudes_expediente::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getSolicitudes_expedienteView($id){
      $solicitudes_expediente = Solicitudes_expediente::select(array('solicitudes_expediente.*'));
      $solicitudes_expediente->where('solicitudes_expediente.id', $id);
      
      return $solicitudes_expediente->get()[0];

    }

    public function changeStatus($field, $id){
      $solicitudes_expediente = $this->getSolicitudes_expediente($id);
      if(count($solicitudes_expediente)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $solicitudes_expediente = $this->getSolicitudes_expediente($id);
      if(count($solicitudes_expediente)){
        $solicitudes_expediente->status = $num;
        $solicitudes_expediente->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $solicitudes_expediente = $this->getSolicitudes_expediente($id);
      if(count($solicitudes_expediente)){
        $img = public_path().'/uploads/'.$solicitudes_expediente->featured_img;
            if($solicitudes_expediente->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $solicitudes_expediente->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getSolicitudes_expedienteData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $solicitudes_expediente = Solicitudes_expediente::select(array('solicitudes_expediente.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $solicitudes_expediente->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $solicitudes_expediente->orderBy($sortBy, $order);
        } else{
          $solicitudes_expediente->orderBy('solicitudes_expediente.id', 'desc');
        }

        return $solicitudes_expediente->paginate($per_page);
    }

    public function getSolicitudes_expedienteExport($searchBy, $searchValue, $sortBy, $order){
      $solicitudes_expediente = Solicitudes_expediente::select(array('solicitudes_expediente.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $solicitudes_expediente->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $solicitudes_expediente->orderBy($sortBy, $order);
        } else{
          $solicitudes_expediente->orderBy('solicitudes_expediente.id', 'desc');
        }
        return $solicitudes_expediente->get();
    }

    public function updateSolicitudes_expediente($request){
      $id = $request->input('id');
      $solicitudes_expediente = Solicitudes_expediente::getSolicitudes_expediente($id);
      if(count($solicitudes_expediente)){

          $solicitudes_expediente->solicitud_id = $request->input('solicitud_id')!="" ? $request->input('solicitud_id') : "";
	$solicitudes_expediente->documento_id = $request->input('documento_id')!="" ? $request->input('documento_id') : "";
	$solicitudes_expediente->carga_id = $request->input('carga_id')!="" ? $request->input('carga_id') : "";
	$solicitudes_expediente->valida_id = $request->input('valida_id')!="" ? $request->input('valida_id') : "";
	$solicitudes_expediente->aprobado = $request->input('aprobado')!="" ? $request->input('aprobado') : "";
	$solicitudes_expediente->fecha_carga = $request->input('fecha_carga')!="" ? $request->input('fecha_carga') : "";
	$solicitudes_expediente->fecha_validacion = $request->input('fecha_validacion')!="" ? $request->input('fecha_validacion') : "";
	$solicitudes_expediente->fecha_emision = $request->input('fecha_emision')!="" ? $request->input('fecha_emision') : "";
	$solicitudes_expediente->fecha_vencimiento = $request->input('fecha_vencimiento')!="" ? $request->input('fecha_vencimiento') : "";
	$solicitudes_expediente->mime = $request->input('mime')!="" ? $request->input('mime') : "";
	$solicitudes_expediente->archivo = $request->input('archivo')!="" ? $request->input('archivo') : "";
	$solicitudes_expediente->comentario = $request->input('comentario')!="" ? $request->input('comentario') : "";
	$solicitudes_expediente->status = $request->input('status')!="" ? $request->input('status') : "";

          $solicitudes_expediente->save();
          return true;
      } else{
        return false;
      }
    }

    public function addSolicitudes_expediente($request){
      $solicitudes_expediente = new Solicitudes_expediente;

        $solicitudes_expediente->solicitud_id = $request->input('solicitud_id')!="" ? $request->input('solicitud_id') : "";
	$solicitudes_expediente->documento_id = $request->input('documento_id')!="" ? $request->input('documento_id') : "";
	$solicitudes_expediente->carga_id = $request->input('carga_id')!="" ? $request->input('carga_id') : "";
	$solicitudes_expediente->valida_id = $request->input('valida_id')!="" ? $request->input('valida_id') : "";
	$solicitudes_expediente->aprobado = $request->input('aprobado')!="" ? $request->input('aprobado') : "";
	$solicitudes_expediente->fecha_carga = $request->input('fecha_carga')!="" ? $request->input('fecha_carga') : "";
	$solicitudes_expediente->fecha_validacion = $request->input('fecha_validacion')!="" ? $request->input('fecha_validacion') : "";
	$solicitudes_expediente->fecha_emision = $request->input('fecha_emision')!="" ? $request->input('fecha_emision') : "";
	$solicitudes_expediente->fecha_vencimiento = $request->input('fecha_vencimiento')!="" ? $request->input('fecha_vencimiento') : "";
	$solicitudes_expediente->mime = $request->input('mime')!="" ? $request->input('mime') : "";
	$solicitudes_expediente->archivo = $request->input('archivo')!="" ? $request->input('archivo') : "";
	$solicitudes_expediente->comentario = $request->input('comentario')!="" ? $request->input('comentario') : "";
	$solicitudes_expediente->status = $request->input('status')!="" ? $request->input('status') : "";

        $solicitudes_expediente->save();
        return true;
    }
}
