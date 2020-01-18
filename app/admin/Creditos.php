<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\admin\Creditos_cuotas;
use App\admin\Creditos_transacciones;
use App\admin\Pagos;
use Auth;

class Creditos extends Model
{
    protected $table = 'creditos';
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

    public function getCreditos($id){
      $data =  Creditos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCreditosView($id){
      $creditos = Creditos::select(array('creditos.*'));
      $creditos->where('creditos.id', $id);

      return $creditos->get()[0];

    }

    public function changeStatus($field, $id){
      $creditos = $this->getCreditos($id);
      if(count($creditos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $creditos = $this->getCreditos($id);
      if(count($creditos)){
        $creditos->status = $num;
        $creditos->save();
        return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $creditos = $this->getCreditos($id);
      if(count($creditos)){
        $img = public_path().'/uploads/'.$creditos->featured_img;
            if($creditos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $creditos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCreditosData($per_page, $searchBy, $searchValue, $sortBy, $order,$status = 0){
      $creditos = Creditos::select(array('creditos.*','clientes.nombre','clientes.paterno','clientes.materno'));

      //join
      $creditos->join('clientes','clientes.id','=','creditos.cliente_id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        if($status != 0 ) {

          $creditos->where('creditos.status', $status);

        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos->orderBy($sortBy, $order);
        } else{
          $creditos->orderBy('creditos.id', 'desc');
        }

        return $creditos->paginate($per_page);
    }

    public function getCreditosExport($searchBy, $searchValue, $sortBy, $order){
      $creditos = Creditos::select(array('creditos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $creditos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $creditos->orderBy($sortBy, $order);
        } else{
          $creditos->orderBy('creditos.id', 'desc');
        }
        return $creditos->get();
    }

    public function updateCreditos($request){
      $id = $request->input('id');
      $creditos = Creditos::getCreditos($id);
      if(count($creditos)){

          $creditos->fondeador_id = $request->input('fondeador_id')!="" ? $request->input('fondeador_id') : "";
        	$creditos->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
        	$creditos->solicitud_id = $request->input('solicitud_id')!="" ? $request->input('solicitud_id') : "";
        	$creditos->supervisor_id = $request->input('supervisor_id')!="" ? $request->input('supervisor_id') : "";
        	$creditos->vendedor_id = $request->input('vendedor_id')!="" ? $request->input('vendedor_id') : "";
        	$creditos->folio = $request->input('folio')!="" ? $request->input('folio') : "";
        	$creditos->plazo = $request->input('plazo')!="" ? $request->input('plazo') : "";
        	$creditos->monto_fondeado = $request->input('monto_fondeado')!="" ? $request->input('monto_fondeado') : "";
        	$creditos->pago = $request->input('pago')!="" ? $request->input('pago') : "";
        	$creditos->interes = $request->input('interes')!="" ? $request->input('interes') : "";
        	$creditos->porcentaje = $request->input('porcentaje')!="" ? $request->input('porcentaje') : "";
        	$creditos->insoluto = $request->input('insoluto')!="" ? $request->input('insoluto') : "";
        	$creditos->actual = $request->input('actual')!="" ? $request->input('actual') : "";
        	$creditos->inicio = $request->input('inicio')!="" ? $request->input('inicio') : "";
        	$creditos->termino = $request->input('termino')!="" ? $request->input('termino') : "";
        	$creditos->vencida = $request->input('vencida')!="" ? $request->input('vencida') : "";
        	$creditos->dias_vencida = $request->input('dias_vencida')!="" ? $request->input('dias_vencida') : "";
        	$creditos->fech_ecv = $request->input('fech_ecv')!="" ? $request->input('fech_ecv') : "";
        	$creditos->recargos = $request->input('recargos')!="" ? $request->input('recargos') : "";
        	$creditos->puntaje = $request->input('puntaje')!="" ? $request->input('puntaje') : "";
        	$creditos->status = $request->input('status')!="" ? $request->input('status') : "";

          $creditos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCreditos($request){
      $creditos = new Creditos;

        $creditos->fondeador_id = $request->input('fondeador_id')!="" ? $request->input('fondeador_id') : "";
      	$creditos->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
      	$creditos->solicitud_id = $request->input('solicitud_id')!="" ? $request->input('solicitud_id') : "";
      	$creditos->supervisor_id = $request->input('supervisor_id')!="" ? $request->input('supervisor_id') : "";
      	$creditos->vendedor_id = $request->input('vendedor_id')!="" ? $request->input('vendedor_id') : "";
      	$creditos->folio = $request->input('folio')!="" ? $request->input('folio') : "";
      	$creditos->plazo = $request->input('plazo')!="" ? $request->input('plazo') : "";
      	$creditos->monto_fondeado = $request->input('monto_fondeado')!="" ? $request->input('monto_fondeado') : "";
      	$creditos->pago = $request->input('pago')!="" ? $request->input('pago') : "";
      	$creditos->interes = $request->input('interes')!="" ? $request->input('interes') : "";
      	$creditos->porcentaje = $request->input('porcentaje')!="" ? $request->input('porcentaje') : "";
      	$creditos->insoluto = $request->input('insoluto')!="" ? $request->input('insoluto') : "";
      	$creditos->actual = $request->input('actual')!="" ? $request->input('actual') : "";
      	$creditos->inicio = $request->input('inicio')!="" ? $request->input('inicio') : "";
      	$creditos->termino = $request->input('termino')!="" ? $request->input('termino') : "";
      	$creditos->vencida = $request->input('vencida')!="" ? $request->input('vencida') : "";
      	$creditos->dias_vencida = $request->input('dias_vencida')!="" ? $request->input('dias_vencida') : "";
      	$creditos->fech_ecv = $request->input('fech_ecv')!="" ? $request->input('fech_ecv') : "";
      	$creditos->recargos = $request->input('recargos')!="" ? $request->input('recargos') : "";
      	$creditos->puntaje = $request->input('puntaje')!="" ? $request->input('puntaje') : "";
      	$creditos->status = $request->input('status')!="" ? $request->input('status') : "";

        $creditos->save();
        return true;
    }

    public function crearCredito($request){
        $creditos = new Creditos;

        $creditos->asesor_id      = $request['vendedor_id'];
        $creditos->cliente_id     = $request['cliente_id'];
        $creditos->solicitud_id   = $request['solicitud_id'];
        $creditos->folio          = $request['folio'];
        $creditos->plazo          = $request['plazo'];
        $creditos->monto_fondeado = $request['monto'];
        $creditos->pago           = $request['pago'];
        $creditos->porcentaje     = $request['porcentaje'];
        $creditos->interes        = $request['interes'];
        $creditos->insoluto       = $request['insoluto'];
        $creditos->actual         = $request['insoluto'];
        $creditos->status         = $request['status'];
        $creditos->recargos       = $request['recargos'];

        $creditos->save();
        return true;
    }

    public function iniciaCredito($solicitud_id) {

        $data =  Creditos::where('solicitud_id', $solicitud_id)->get();

        if(count($data)){

            $informacion =  $data[0];

            $informacion->inicio    = date('Y-m-d');
            $informacion->termino   = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $informacion->plazo . ' weeks'));
            $informacion->status    = 2;

            $informacion->save();

            //Creamos la primera operacion de transaccion
            $transaccion = new Creditos_transacciones;

            //Creamos las cuotas de la cuotas a pagar
            $transaccion->credito_id =$informacion->id;
            $transaccion->cuota_id =0;
            $transaccion->transaccion = 'Deposito de credito solicitado';
            $transaccion->saldo_anterior =0;
            $transaccion->cargo = $informacion->monto_fondeado;
            $transaccion->abono = 0;
            $transaccion->saldo_final = $informacion->monto_fondeado;
            $transaccion->fecha_transaccion =date('Y-m-d');
            $transaccion->status  =1;
            $transaccion->save();

            $cuotas = array(

                'credito_id'    => $informacion->id,

                'inicio'        => date('Y-m-d'),

                'termino'       => date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $informacion->plazo . ' weeks')),

                'inicial'       => $informacion->insoluto,

                'pago'          => $informacion->pago,

                'interes'       => $informacion->porcentaje,

            );


            $this->generaCuotas($cuotas);

        } else {

            return false;

        }

    }

    public function generaCuotas($data) {

        //Se calcula la primera fecha de pago
        $fecha_inicio = $data['inicio'];

        $saldo_inicial = $data['inicial'];

        $pago = $data['pago'];

        while($fecha_inicio < $data['termino']) {

            $saldo_final = ($saldo_inicial - $pago);

            $cuotas = new Creditos_cuotas;

            $cuotas->credito_id     = $data['credito_id'];
            $cuotas->pago_id        = 0;
            $cuotas->saldo_actual   = $saldo_inicial;
            $cuotas->amortizacion   = $pago;
            $cuotas->moratorios     = 0;
            $cuotas->pago_aplicado  = 0;
            $cuotas->saldo_final    = $saldo_final;
            $cuotas->fecha_vence    = date('Y-m-d', strtotime($fecha_inicio . ' + 7 days'));;
            $cuotas->fecha_inicio   = $fecha_inicio;
            $cuotas->fecha_pago     = null;
            $cuotas->status         = 1;

            $cuotas->save();

            $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio . ' + 7 days'));

            $saldo_inicial = $saldo_final;

            if($saldo_final < $data['pago']) {

                $pago = $saldo_final;

            }

        }

    }

    public function getTransacciones($credito_id) {

        $data = Creditos_transacciones::where('credito_id',$credito_id)->get();

        if(count($data)){

            return $data;

        } else{

            return array();

        }

    }

    public function getCuotas($credito_id) {

        $data = Creditos_cuotas::where('credito_id',$credito_id)->get();

        if(count($data)){

            return $data;

        } else{

            return array();

        }

    }

    public function aplicaPago($request, $pago_id) {

        $puntaje = 0;

        $credito = $this->getCreditos($request['credito_id']);

        $saldo_final = $credito->actual;

        //Traemos las cuotas vencidas
        $vencidas = Creditos_cuotas::select(array('creditos_cuotas.*'));

        $vencidas->where('credito_id',$request['credito_id']);

        $vencidas->where('status',3);

        $data = $vencidas->get();

        $pendiente = $request['monto_pago'];

        if(count($data)) {

          foreach($data as $pagar) {

            //Detectamos cuando queda pendiente por pagar
            $monto_pendiente = ($pagar->amortizacion + $pagar->moratorios) - $pagar->pago_aplicado;

            //Validamos si pendiente no es menor o igual a cero
            if($monto_pendiente > 0) {

                //validamos si el pago cubre toda la cuota
                if($pendiente >= $monto_pendiente) {

                    //El pago cubre el monto de la cuota, cambiamos el status a 2: Pagada
                    $pagar->pago_aplicado   = $monto_pendiente + $pagar->pago_aplicado;

                    $pagar->pago_id         =  $pago_id;

                    $pagar->status          =  2;

                    //Generamos la transaccion por el pago de los interes moratorio

                    if($pagar->moratorios > 0) {

                        $transaccion = new Creditos_transacciones;

                        //Creamos las cuotas de la cuotas a pagar
                        $transaccion->credito_id        = $request['credito_id'];
                        $transaccion->cuota_id          = $pagar->id;
                        $transaccion->transaccion       = 'Pago de Interes Moratorio';
                        $transaccion->saldo_anterior    = ($saldo_final + $pagar->moratorios);
                        $transaccion->cargo             = 0;
                        $transaccion->abono             = $pagar->moratorios;
                        $transaccion->saldo_final       = $saldo_final - $pagar->moratorios;
                        $transaccion->fecha_transaccion = date('Y-m-d');
                        $transaccion->status  =1;
                        $transaccion->save();

                    }

                    //Generamos la transaccion por el saldo aplicado a la cuota
                    $transaccion = new Creditos_transacciones;

                    //Creamos las cuotas de la cuotas a pagar
                    $transaccion->credito_id =$request['credito_id'];
                    $transaccion->cuota_id =$pagar->id;
                    $transaccion->transaccion = 'Pago de capital vencido';
                    $transaccion->saldo_anterior =$saldo_final;
                    $transaccion->cargo = 0;
                    $transaccion->abono = ($monto_pendiente - $pagar->moratorios);
                    $transaccion->saldo_final = ($saldo_final - $monto_pendiente);
                    $transaccion->fecha_transaccion =date('Y-m-d');
                    $transaccion->status  =1;
                    $transaccion->save();

                    $saldo_final = $saldo_final - $monto_pendiente;

                } else {

                    $pagar->pago_aplicado   = $pendiente;
                    $pagar->pago_id         =  $pago_id;
                    $pagar->status          = 3;


                    if($pagar->moratorios > 0) {

                        $transaccion = new Creditos_transacciones;

                        //Creamos las cuotas de la cuotas a pagar
                        $transaccion->credito_id        = $credito->id;
                        $transaccion->cuota_id          = $pagar->id;
                        $transaccion->transaccion       = 'Pago de Interes Moratorio';
                        $transaccion->saldo_anterior    = ($saldo_final + $pagar->moratorios);
                        $transaccion->cargo             = 0;
                        $transaccion->abono             = $pagar->moratorios;
                        $transaccion->saldo_final       = ($saldo_final + $pagar->moratorios) - $pagar->moratorios;
                        $transaccion->fecha_transaccion = date('Y-m-d');
                        $transaccion->status  =1;
                        $transaccion->save();

                    }

                    //Generamos la transaccion por el saldo aplicado a la cuota
                    $transaccion = new Creditos_transacciones;

                    //Creamos las cuotas de la cuotas a pagar
                    $transaccion->credito_id =$request['credito_id'];
                    $transaccion->cuota_id =$pagar->id;
                    $transaccion->transaccion = 'Pago de capital vencido';
                    $transaccion->saldo_anterior =$saldo_final;
                    $transaccion->cargo = 0;
                    $transaccion->abono = ($pendiente - $pagar->moratorios);
                    $transaccion->saldo_final = ($saldo_final - ($pendiente - $pagar->moratorios));
                    $transaccion->fecha_transaccion =date('Y-m-d');
                    $transaccion->status  =1;
                    $transaccion->save();

                    $saldo_final = $saldo_final - ($pendiente - $pagar->moratorios);

                }

                //Calculamos los puntos generados
                //$pagar->puntaje = $this->getPuntajeByDate($pagar->fecha_vence,$pagar->fecha_pago);
                //$puntaje += $pagar->puntaje;

                //actualizamos la cuota
                $pagar->pago_id         = $pago_id;
                //$pagar->fecha_pago      = date('Y-m-d');
                $pagar->fecha_pago      = $pagar->fecha_vence;
                $pagar->save();

                //Actualizamos el saldo que tenemos para pagar, descontando el monto aplicado en este momento
                $pendiente = $pendiente - $monto_pendiente;

                //Validamos si aun hay lana
                if($pendiente <= 0) {

                    break;
                }

            }

          }

        }

        //Validamos si aun hay monto para aplicar pagos
        if($pendiente > 0) {

            //Hay dinero para repartir aun buscamos cuotas vigentes
            $vigentes = Creditos_cuotas::select(array('creditos_cuotas.*'));

            $vigentes->where('credito_id',$request['credito_id']);

            $vigentes->where('status',1);

            $data = $vigentes->get();

            if(count($data)) {

                foreach($data as $pagar) {

                  //Detectamos cuando queda pendiente por pagar
                  $monto_pendiente = ($pagar->amortizacion + $pagar->moratorios) - $pagar->pago_aplicado;

                  //Validamos si pendiente no es menor o igual a cero
                  if($monto_pendiente > 0) {

                      //validamos si el pago cubre toda la cuota
                      if($pendiente >= $monto_pendiente) {

                          //El pago cubre el monto de la cuota, cambiamos el status a 2: Pagada
                          $pagar->pago_aplicado   = $monto_pendiente + $pagar->pago_aplicado;
                          $pagar->pago_id         =  $pago_id;
                          $pagar->status          =  2;

                          //Generamos la transaccion por el saldo aplicado a la cuota
                          $transaccion = new Creditos_transacciones;

                          //Creamos las cuotas de la cuotas a pagar
                          $transaccion->credito_id =$request['credito_id'];
                          $transaccion->cuota_id =$pagar->id;
                          $transaccion->transaccion = 'Pago de capital vigente';
                          $transaccion->saldo_anterior =$saldo_final;
                          $transaccion->cargo = 0;
                          $transaccion->abono = $monto_pendiente;
                          $transaccion->saldo_final = ($saldo_final - $monto_pendiente);
                          $transaccion->fecha_transaccion =date('Y-m-d');
                          $transaccion->status  =1;
                          $transaccion->save();

                          $saldo_final = $saldo_final - $monto_pendiente;

                      } else {

                          $pagar->pago_aplicado   = $pendiente;
                          $pagar->pago_id         =  $pago_id;
                          $pagar->status          = 1;

                          //Generamos la transaccion por el saldo aplicado a la cuota
                          $transaccion = new Creditos_transacciones;

                          //Creamos las cuotas de la cuotas a pagar
                          $transaccion->credito_id =$request['credito_id'];
                          $transaccion->cuota_id =$pagar->id;
                          $transaccion->transaccion = 'Pago de capital vigente';
                          $transaccion->saldo_anterior =$saldo_final;
                          $transaccion->cargo = 0;
                          $transaccion->abono = $pendiente;
                          $transaccion->saldo_final = ($saldo_final - $pendiente);
                          $transaccion->fecha_transaccion =date('Y-m-d');
                          $transaccion->status  =1;
                          $transaccion->save();

                          $saldo_final = $saldo_final - $pendiente;

                      }

                      //Calculamos los puntos generados
                      //$pagar->puntaje = $this->getPuntajeByDate($pagar->fecha_vence,$pagar->fecha_pago);
                      //$puntaje += $pagar->puntaje;

                      //actualizamos la cuota
                      $pagar->pago_id         = $pago_id;
                      //$pagar->fecha_pago      = date('Y-m-d');
                      $pagar->fecha_pago      = $pagar->fecha_vence;
                      $pagar->save();

                      //Actualizamos el saldo que tenemos para pagar, descontando el monto aplicado en este momento
                      $pendiente = $pendiente - $monto_pendiente;

                      //Validamos si aun hay lana
                      if($pendiente <= 0) {

                          break;

                      }

                  }

                }

            }

        }

        $credito->actual = $saldo_final;

        if($saldo_final <= 0) {

            $credito->status = 4;

        }

        $credito->puntaje += $puntaje;

        $credito->save();

    }

    public function getVencidas($credito_id){
        $vencidas = Creditos_cuotas::select(array('creditos_cuotas.*'));

        $vencidas->where('credito_id',$credito_id);

        $vencidas->where('status',3);

        $vencidas->whereNull('fecha_pago');

        $vencidas->where('fecha_vence','<', date('Y-m-d'));

        $data = $vencidas->get();
        return $data;
    }

    public function liquidaCredito($credito_id) {

      //Traemos el credito
      $credito =  Creditos::where('id', $credito_id)->get();

      if(count($credito)) {

        $saldo_final = $credito[0]->actual;

        $credito[0]->status = 4;

        $credito[0]->save();

        //Traemos las cuotas pendientes del credito para liquidarlas
        $cuotas = Creditos_cuotas::where('credito_id',$credito_id)->whereIn('status',array(1,3))->get();

        $pendiente = Creditos_cuotas::select(DB::raw('SUM(amortizacion) AS pendiente'))->where('credito_id',$credito_id)->whereIn('status',array(1,3))->get();

        //Aplicamos el pago
        $pagos = new Pagos;

        $pagos->credito_id = $credito_id;
        $pagos->fecha_pago = date('Y-m-d');
        $pagos->hora_pago  = date('H:i:s');
        $pagos->monto_pago = $pendiente[0]->pendiente;
        $pagos->status = 1;

        $pagos->save();
        $pago_id = $pagos->id;

        //Creamos la transaccion
        $transaccion = new Creditos_transacciones;

        //Creamos las cuotas de la cuotas a pagar
        $transaccion->credito_id =$credito_id;
        $transaccion->cuota_id =0;
        $transaccion->transaccion = 'Pago de capital por refinanciamiento';
        $transaccion->saldo_anterior =$saldo_final;
        $transaccion->cargo = 0;
        $transaccion->abono = $pendiente[0]->pendiente;
        $transaccion->saldo_final = ($saldo_final - $pendiente[0]->pendiente);
        $transaccion->fecha_transaccion = date('Y-m-d');
        $transaccion->status  =1;
        $transaccion->save();

        foreach ($cuotas as $value) {

          $value->pago_aplicado   = $value->amortizacion;
          $value->fecha_pago      = $value->fecha_vence;
          $value->pago_id         = $pago_id;
          $value->status          = 2;
          $value->save();

        }

      }

    }
}
