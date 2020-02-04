<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Parametros extends Model
{
    //
    protected $table = 'parametros';
    protected $primaryKey = 'id';

    protected $casts = [
      'id'            => 'integer',
      'parametro'     => 'string',
      'valor'         => 'string',
      'tipo_input'    => 'string'
    ];
}
