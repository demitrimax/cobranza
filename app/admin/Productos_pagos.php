<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Productos_pagos extends Model
{
    protected $table = 'productos_pagos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->get();
    }

    public function clear($producto_id) {

      DB::table('productos_pagos')->where('producto_id',$producto_id)->delete();

    }

    public function getByProducto($producto_id){

      $data =  Productos_pagos::where('producto_id', $producto_id)->get();

      return $data;

    }

    public function addPagos($request){
      $productos_pagos = new Productos_pagos;

      $productos_pagos->producto_id = $request['producto_id'];
      $productos_pagos->monto = $request['pago'];
      $productos_pagos->status = $request['status'];

      $productos_pagos->save();
      return true;
    }
}
