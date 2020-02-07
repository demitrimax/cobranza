<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Parametros extends Model
{
    //
    use LogsActivity;
    protected $table = 'parametros';
    protected $primaryKey = 'id';
    protected static $logAttributes = ['*'];

    protected $casts = [
      'id'            => 'integer',
      'parametro'     => 'string',
      'valor'         => 'string',
      'tipo_input'    => 'string'
    ];
}
