<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table = 'documentos';
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

    public function getDocumentos($id){
      $data =  Documentos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getDocumentosView($id){
      $documentos = Documentos::select(array('documentos.*' , 'productos.descripcion'));
      $documentos->where('documentos.id', $id);
      $documentos->leftJoin('productos', 'documentos.producto_id', '=','productos.id');
      return $documentos->get()[0];

    }

    public function changeStatus($field, $id){
      $documentos = $this->getDocumentos($id);
      if(count($documentos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $documentos = $this->getDocumentos($id);
      if(count($documentos)){
        $documentos->status = $num;
        $documentos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $documentos = $this->getDocumentos($id);
      if(count($documentos)){
        $img = public_path().'/uploads/'.$documentos->featured_img;
            if($documentos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $documentos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getDocumentosData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $documentos = Documentos::select(array('documentos.*' , 'productos.descripcion AS producto'));

      //join
        $documentos->leftJoin('productos', 'documentos.producto_id', '=','productos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $documentos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $documentos->where('documentos.status', 1);

        // sort option
        if($sortBy!='' && $order!=''){
          $documentos->orderBy($sortBy, $order);
        } else{
          $documentos->orderBy('documentos.id', 'desc');
        }

        return $documentos->paginate($per_page);
    }

    public function getDocumentosExport($searchBy, $searchValue, $sortBy, $order){
      $documentos = Documentos::select(array('documentos.*' , 'productos.descripcion'));

      //join
        $documentos->leftJoin('productos', 'documentos.producto_id', '=','productos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $documentos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $documentos->orderBy($sortBy, $order);
        } else{
          $documentos->orderBy('documentos.id', 'desc');
        }
        return $documentos->get();
    }

    public function updateDocumentos($request){
      $id = $request->input('id');
      $documentos = Documentos::getDocumentos($id);
      if(count($documentos)){

          $documentos->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$documentos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$documentos->requerido = $request->input('requerido')!="" ? $request->input('requerido') : "";
	$documentos->status = $request->input('status')!="" ? $request->input('status') : "";

          $documentos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addDocumentos($request){
      $documentos = new Documentos;

        $documentos->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$documentos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$documentos->requerido = $request->input('requerido')!="" ? $request->input('requerido') : "";
	$documentos->status = $request->input('status')!="" ? $request->input('status') : "";

        $documentos->save();
        return true;
    }

    public function producto(){
       return $this->hasOne('\App\admin\Productos', 'id', 'producto_id');
   }

   public function tipoVigencia(){
       $tiposVigencia = array(0 => 'Ninguno', 1 => 'Fecha', 2 => 'Días');
       return isset($tiposVigencia[$this->tipo_vigencia]) ? $tiposVigencia[$this->tipo_vigencia] : '--';
   }

   public function getExpediente($solicitudId){
       return \App\admin\Solicitudes_expediente::where('solicitudes_expediente.documento_id', $this->id)
           ->where('solicitudes_expediente.solicitud_id', $solicitudId)
           ->join('documentos','documentos.id','solicitudes_expediente.documento_id')
           ->where('solicitudes_expediente.status', 1)->first();
   }

   public static function documentosSolicitud($idSolicitud){
       $query = "SELECT documentos.*, solicitudes_expediente.id as solicitudes_expediente_id, solicitudes_expediente.aprobado, "
       ."solicitudes_expediente.aprobado, solicitudes_expediente.fecha_carga as solicitudes_expediente_fecha_carga, solicitudes_expediente.status as solicitudes_expediente_status "
       ."FROM documentos LEFT JOIN solicitudes_expediente on (documentos.id = solicitudes_expediente.documento_id "
       ."and solicitudes_expediente.solicitud_id={$idSolicitud} and solicitudes_expediente.status = 1 ) where documentos.status=1";
       return DB::select($query);
   }
}
