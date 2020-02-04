<?php

namespace App\admin;
use DB;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class ctelefonos extends Model
{
    use LogsActivity;
    //
    protected $table = 'ctelefonos';
    protected $primaryKey = 'id';
    protected static $logAttributes = ['*'];


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
