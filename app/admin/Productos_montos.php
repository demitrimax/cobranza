<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Productos_montos extends Model
{
    protected $table = 'productos_montos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->get();
    }

    public function clear($producto_id) {

      DB::table('productos_montos')->where('producto_id',$producto_id)->delete();

    }

    public function getByProducto($producto_id){

      $data =  Productos_montos::where('producto_id', $producto_id)->get();

      return $data;

    }

    public function addMontos($request){
      $productos_montos = new Productos_montos;

        $productos_montos->producto_id = $request['producto_id'];
	      $productos_montos->monto = $request['monto'];
	      $productos_montos->status = $request['status'];

        $productos_montos->save();
        return true;
    }
}
