<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    protected $casts = [
      'id'            => 'integer',
      'nacimiento'    => 'date',
      'nombre'        => 'string',
      'paterno'       => 'string',
      'materno'       => 'string',
      'curp'          => 'string',

    ];

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

    public function getNombrecompletoAttribute()
    {
      return $this->nombre.' '.$this->paterno.' '.$this->materno;
    }
    public function getPermissionsView($id){
      $permissions = Permissions::select(array('permissions.*'));
      $permissions->where('permissions.id', $id);

      return $permissions->get()[0];

    }

    public function getClientes($id){
      $data =  Clientes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getClientesView($id){
      $clientes = Clientes::select(array('clientes.*'));
      $clientes->where('clientes.id', $id);

      return $clientes->get()[0];

    }

    public function changeStatus($field, $id){
      $clientes = $this->getClientes($id);
      if(count($clientes)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $clientes = $this->getClientes($id);
      if(count($clientes)){
        $clientes->status = $num;
        $clientes->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $clientes = $this->getClientes($id);
      if(count($clientes)){
        $img = public_path().'/uploads/'.$clientes->featured_img;
            if($clientes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $clientes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getClientesData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $clientes = Clientes::select(array('clientes.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $clientes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $clientes->orderBy($sortBy, $order);
        } else{
          $clientes->orderBy('clientes.id', 'desc');
        }

        return $clientes->paginate($per_page);
    }

    public function getClientesExport($searchBy, $searchValue, $sortBy, $order){
      $clientes = Clientes::select(array('clientes.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $clientes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $clientes->orderBy($sortBy, $order);
        } else{
          $clientes->orderBy('clientes.id', 'desc');
        }
        return $clientes->get();
    }

    public function updateClientes($request){
      $id = $request->input('cliente_id');
      $clientes = Clientes::getClientes($id);
      if(count($clientes)){

        $clientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        $clientes->paterno = $request->input('paterno')!="" ? $request->input('paterno') : "";
        $clientes->materno = $request->input('materno')!="" ? $request->input('materno') : "";
        $clientes->nacimiento = null;
        $clientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        $clientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        $clientes->trabajo = $request->input('trabajo')!="" ? $request->input('trabajo') : "";
        $clientes->correo = $request->input('correo')!="" ? $request->input('correo') : "";
        $clientes->calle = $request->input('calle')!="" ? $request->input('calle') : "";
        $clientes->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
        $clientes->ciudad = $request->input('ciudad')!="" ? $request->input('ciudad') : "";
        $clientes->estado = $request->input('estado')!="" ? $request->input('estado') : "";
        $clientes->cp = $request->input('cp')!="" ? $request->input('cp') : "";
        $clientes->ocupacion = $request->input('ocupacion')!="" ? $request->input('ocupacion') : "";
        $clientes->trabaja = $request->input('trabaja')!="" ? $request->input('trabaja') : "";
        $clientes->ingreso_mensual = $request->input('ingreso_mensual')!="" ? $request->input('ingreso_mensual') : 0;
        $clientes->ingreso_extra = $request->input('ingreso_extra')!="" ? $request->input('ingreso_extra') : 0;
        $clientes->gasto_mensual = $request->input('gasto_mensual')!="" ? $request->input('gasto_mensual') : 0;
        $clientes->fiador_nombre = $request->input('fiador_nombre')!="" ? $request->input('fiador_nombre') : "";
        $clientes->fiador_telefono = $request->input('fiador_telefono')!="" ? $request->input('fiador_telefono') : "";
        $clientes->fiador_celular = $request->input('fiador_celular')!="" ? $request->input('fiador_celular') : "";
        $clientes->fiador_trabajo = $request->input('fiador_trabajo')!="" ? $request->input('fiador_trabajo') : "";
        $clientes->fiador_calle = $request->input('fiador_calle')!="" ? $request->input('fiador_calle') : "";
        $clientes->fiador_colonia = $request->input('fiador_colonia')!="" ? $request->input('fiador_colonia') : "";
        $clientes->fiador_ciudad = $request->input('fiador_ciudad')!="" ? $request->input('fiador_ciudad') : "";
        $clientes->fiador_estado = $request->input('fiador_estado')!="" ? $request->input('fiador_estado') : "";
        $clientes->fiador_cp = $request->input('fiador_cp')!="" ? $request->input('fiador_cp') : "";
        $clientes->fiador_latitud = $request->input('fiador_latitud')!="" ? $request->input('fiador_latitud') : "";
        $clientes->fiador_longitud = $request->input('fiador_longitud')!="" ? $request->input('fiador_longitud') : "";
        $clientes->referencia1_nombre = $request->input('referencia1_nombre')!="" ? $request->input('referencia1_nombre') : "";
        $clientes->referencia1_parentesco = $request->input('referencia1_parentesco')!="" ? $request->input('referencia1_parentesco') : "";
        $clientes->referencia1_celular = $request->input('referencia1_celular')!="" ? $request->input('referencia1_celular') : "";
        $clientes->referencia1_domicilio = $request->input('referencia1_domicilio')!="" ? $request->input('referencia1_domicilio') : "";
        $clientes->referencia1_latitud = $request->input('referencia1_latitud')!="" ? $request->input('referencia1_latitud') : "";
        $clientes->referencia1_longitud = $request->input('referencia1_longitud')!="" ? $request->input('referencia1_longitud') : "";
        $clientes->referencia2_nombre = $request->input('referencia2_nombre')!="" ? $request->input('referencia2_nombre') : "";
        $clientes->referencia2_parentesco = $request->input('referencia2_parentesco')!="" ? $request->input('referencia2_parentesco') : "";
        $clientes->referencia2_celular = $request->input('referencia2_celular')!="" ? $request->input('referencia2_celular') : "";
        $clientes->referencia2_domicilio = $request->input('referencia2_domicilio')!="" ? $request->input('referencia2_domicilio') : "";
        $clientes->referencia2_latitud = $request->input('referencia2_latitud')!="" ? $request->input('referencia2_latitud') : "";
        $clientes->referencia2_longitud = $request->input('referencia2_longitud')!="" ? $request->input('referencia2_longitud') : "";
        $clientes->referencia3_nombre = $request->input('referencia3_nombre')!="" ? $request->input('referencia3_nombre') : "";
        $clientes->referencia3_parentesco = $request->input('referencia3_parentesco')!="" ? $request->input('referencia3_parentesco') : "";
        $clientes->referencia3_celular = $request->input('referencia3_celular')!="" ? $request->input('referencia3_celular') : "";
        $clientes->referencia3_domicilio = $request->input('referencia3_domicilio')!="" ? $request->input('referencia3_domicilio') : "";
        $clientes->referencia3_latitud = $request->input('referencia3_latitud')!="" ? $request->input('referencia3_latitud') : "";
        $clientes->referencia3_longitud = $request->input('referencia3_longitud')!="" ? $request->input('referencia3_longitud') : "";
        $clientes->latitud = $request->input('latitud')!="" ? $request->input('latitud') : "";
        $clientes->longitud = $request->input('longitud')!="" ? $request->input('longitud') : "";
        $clientes->status = 1;

          $clientes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addClientes($request){
      $clientes = new Clientes;

        $clientes->curp = $request->input('curp')!="" ? $request->input('curp') : "";
        $clientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$clientes->paterno = $request->input('paterno')!="" ? $request->input('paterno') : "";
      	$clientes->materno = $request->input('materno')!="" ? $request->input('materno') : "";
      	$clientes->nacimiento = $request->input('nacimiento')!="" ? $request->input('nacimiento') : "";
        $clientes->curpdat = $request->input('curpdat')!="" ? $request->input('curpdat') : "";
      	$clientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
      	$clientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      	$clientes->trabajo = $request->input('trabajo')!="" ? $request->input('trabajo') : "";
      	$clientes->correo = $request->input('correo')!="" ? $request->input('correo') : "";
      	$clientes->calle = $request->input('calle')!="" ? $request->input('calle') : "";
      	$clientes->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
      	$clientes->ciudad = $request->input('ciudad')!="" ? $request->input('ciudad') : "";
      	$clientes->estado = $request->input('estado')!="" ? $request->input('estado') : "";
      	$clientes->cp = $request->input('cp')!="" ? $request->input('cp') : "";
      	$clientes->ocupacion = $request->input('ocupacion')!="" ? $request->input('ocupacion') : "";
      	$clientes->trabaja = $request->input('trabaja')!="" ? $request->input('trabaja') : "";
      	$clientes->ingreso_mensual = $request->input('ingreso_mensual')!="" ? $request->input('ingreso_mensual') : 0;
      	$clientes->ingreso_extra = $request->input('ingreso_extra')!="" ? $request->input('ingreso_extra') : 0;
      	$clientes->gasto_mensual = $request->input('gasto_mensual')!="" ? $request->input('gasto_mensual') : 0;
      	$clientes->fiador_nombre = $request->input('fiador_nombre')!="" ? $request->input('fiador_nombre') : "";
      	$clientes->fiador_telefono = $request->input('fiador_telefono')!="" ? $request->input('fiador_telefono') : "";
      	$clientes->fiador_celular = $request->input('fiador_celular')!="" ? $request->input('fiador_celular') : "";
      	$clientes->fiador_trabajo = $request->input('fiador_trabajo')!="" ? $request->input('fiador_trabajo') : "";
      	$clientes->fiador_calle = $request->input('fiador_calle')!="" ? $request->input('fiador_calle') : "";
      	$clientes->fiador_colonia = $request->input('fiador_colonia')!="" ? $request->input('fiador_colonia') : "";
      	$clientes->fiador_ciudad = $request->input('fiador_ciudad')!="" ? $request->input('fiador_ciudad') : "";
      	$clientes->fiador_estado = $request->input('fiador_estado')!="" ? $request->input('fiador_estado') : "";
      	$clientes->fiador_cp = $request->input('fiador_cp')!="" ? $request->input('fiador_cp') : "";
      	$clientes->fiador_latitud = $request->input('fiador_latitud')!="" ? $request->input('fiador_latitud') : "";
      	$clientes->fiador_longitud = $request->input('fiador_longitud')!="" ? $request->input('fiador_longitud') : "";
      	$clientes->referencia1_nombre = $request->input('referencia1_nombre')!="" ? $request->input('referencia1_nombre') : "";
      	$clientes->referencia1_parentesco = $request->input('referencia1_parentesco')!="" ? $request->input('referencia1_parentesco') : "";
      	$clientes->referencia1_celular = $request->input('referencia1_celular')!="" ? $request->input('referencia1_celular') : "";
      	$clientes->referencia1_domicilio = $request->input('referencia1_domicilio')!="" ? $request->input('referencia1_domicilio') : "";
      	$clientes->referencia1_latitud = $request->input('referencia1_latitud')!="" ? $request->input('referencia1_latitud') : "";
      	$clientes->referencia1_longitud = $request->input('referencia1_longitud')!="" ? $request->input('referencia1_longitud') : "";
      	$clientes->referencia2_nombre = $request->input('referencia2_nombre')!="" ? $request->input('referencia2_nombre') : "";
      	$clientes->referencia2_parentesco = $request->input('referencia2_parentesco')!="" ? $request->input('referencia2_parentesco') : "";
      	$clientes->referencia2_celular = $request->input('referencia2_celular')!="" ? $request->input('referencia2_celular') : "";
      	$clientes->referencia2_domicilio = $request->input('referencia2_domicilio')!="" ? $request->input('referencia2_domicilio') : "";
      	$clientes->referencia2_latitud = $request->input('referencia2_latitud')!="" ? $request->input('referencia2_latitud') : "";
      	$clientes->referencia2_longitud = $request->input('referencia2_longitud')!="" ? $request->input('referencia2_longitud') : "";
      	$clientes->referencia3_nombre = $request->input('referencia3_nombre')!="" ? $request->input('referencia3_nombre') : "";
      	$clientes->referencia3_parentesco = $request->input('referencia3_parentesco')!="" ? $request->input('referencia3_parentesco') : "";
      	$clientes->referencia3_celular = $request->input('referencia3_celular')!="" ? $request->input('referencia3_celular') : "";
      	$clientes->referencia3_domicilio = $request->input('referencia3_domicilio')!="" ? $request->input('referencia3_domicilio') : "";
      	$clientes->referencia3_latitud = $request->input('referencia3_latitud')!="" ? $request->input('referencia3_latitud') : "";
      	$clientes->referencia3_longitud = $request->input('referencia3_longitud')!="" ? $request->input('referencia3_longitud') : "";
      	$clientes->latitud = $request->input('latitud')!="" ? $request->input('latitud') : "";
      	$clientes->longitud = $request->input('longitud')!="" ? $request->input('longitud') : "";
      	$clientes->status = 1;

        $clientes->save();
        return $clientes->id;
    }
}
