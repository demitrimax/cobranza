<?php

namespace App\admin;
use DB;

use Illuminate\Database\Eloquent\Model;

class ctelefonos extends Model
{
    //
    protected $table = 'ctelefonos';
    protected $primaryKey = 'id';


    protected $casts = [
      'id'            => 'integer',
      'tipo'          => 'string',
      'numero'        => 'integer',
      'pertenece_a'   => 'string',

    ];

    public function clientes()
    {
      return $this->belongsToMany('App\admin\ctelefonos', 'cliente_id', 'ctelefonos');
    }

}
