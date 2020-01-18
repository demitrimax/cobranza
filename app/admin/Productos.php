<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
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

    public function getProductos($id){
      $data =  Productos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getProductosView($id){
      $productos = Productos::select(array('productos.*'));
      $productos->where('productos.id', $id);

      return $productos->get()[0];

    }

    public function changeStatus($field, $id){
      $productos = $this->getProductos($id);
      if(count($productos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $productos = $this->getProductos($id);
      if(count($productos)){
        $productos->status = $num;
        $productos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $productos = $this->getProductos($id);
      if(count($productos)){
        $img = public_path().'/uploads/'.$productos->featured_img;
            if($productos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $productos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getProductosData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $productos = Productos::select(array('productos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $productos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $productos->orderBy($sortBy, $order);
        } else{
          $productos->orderBy('productos.id', 'desc');
        }

        return $productos->paginate($per_page);
    }

    public function getProductosExport($searchBy, $searchValue, $sortBy, $order){
      $productos = Productos::select(array('productos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $productos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $productos->orderBy($sortBy, $order);
        } else{
          $productos->orderBy('productos.id', 'desc');
        }
        return $productos->get();
    }

    public function updateProductos($request){
      $id = $request->input('id');
      $productos = Productos::getProductos($id);
      if(count($productos)){

          $productos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
        	$productos->tasa_minima = $request->input('tasa_minima')!="" ? $request->input('tasa_minima') : "";
        	$productos->tasa_maxima = $request->input('tasa_maxima')!="" ? $request->input('tasa_maxima') : "";
        	$productos->tasa_actual = $request->input('tasa_actual')!="" ? $request->input('tasa_actual') : "";
        	$productos->credito_maximo = $request->input('credito_maximo')!="" ? $request->input('credito_maximo') : "";
        	$productos->credito_minimo = $request->input('credito_minimo')!="" ? $request->input('credito_minimo') : "";
        	$productos->plazo_maximo = $request->input('plazo_maximo')!="" ? $request->input('plazo_maximo') : "";
        	$productos->plazo_minimo = $request->input('plazo_minimo')!="" ? $request->input('plazo_minimo') : "";
          $productos->tipo_cobro = $request->input('tipo_cobro')!="" ? $request->input('tipo_cobro') : "";
          $productos->valor_cobro = $request->input('valor_cobro')!="" ? $request->input('valor_cobro') : "";
        	$productos->status = $request->input('status')!="" ? $request->input('status') : 1;

          $productos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addProductos($request){
      $productos = new Productos;

        $productos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
      	$productos->tasa_minima = $request->input('tasa_minima')!="" ? $request->input('tasa_minima') : "";
      	$productos->tasa_maxima = $request->input('tasa_maxima')!="" ? $request->input('tasa_maxima') : "";
      	$productos->tasa_actual = $request->input('tasa_actual')!="" ? $request->input('tasa_actual') : "";
      	$productos->credito_maximo = $request->input('credito_maximo')!="" ? $request->input('credito_maximo') : "";
      	$productos->credito_minimo = $request->input('credito_minimo')!="" ? $request->input('credito_minimo') : "";
      	$productos->plazo_maximo = $request->input('plazo_maximo')!="" ? $request->input('plazo_maximo') : "";
      	$productos->plazo_minimo = $request->input('plazo_minimo')!="" ? $request->input('plazo_minimo') : "";
        $productos->tipo_cobro = $request->input('tipo_cobro')!="" ? $request->input('tipo_cobro') : "";
        $productos->valor_cobro = $request->input('valor_cobro')!="" ? $request->input('valor_cobro') : "";
      	$productos->status = $request->input('status')!="" ? $request->input('status') : 1;

        $productos->save();
        return true;
    }
}
