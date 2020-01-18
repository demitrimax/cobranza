@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Comisiones por vendedor</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form method="GET" action="" class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">Buscar</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fondeador_id" class="control-label"> Vendedor </label>
                                        <select id="fondeador_id" class="form-control" name="vendedor">
                                            <?php foreach ($vendedores as $key => $vendedor) { 
                                                $sel = (isset($_GET['vendedor']) && $_GET['vendedor'] == $vendedor->id) ? 'selected="selected"' : '';
                                                ?>
                                            <option <?= $sel ?> value="<?= $vendedor->id ?>"><?= $vendedor->nombre ?> <?= $vendedor->paterno ?> <?= $vendedor->materno ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_inicio" class="control-label"> Fecha inicio </label>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required="required" value="<?= isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_fin" class="control-label"> Fecha fin </label>
                                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required="required" value="<?= isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';?>">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row text-right">
                                    <button class="btn btn-primary btn-rounded" id="btn_get_reporte">
                                        <span class="btn-label"><i class="fa fa-search fa-lg"></i></span>Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
        <?php
        if(isset($res) && count($res) > 0){
             
            ?>

            <form method="POST" action="" class="">
                {{ csrf_field() }}
                <input type="hidden" name="vendedor_id" value="<?= $vendedorId ?>">
                <div class="row" id="results">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Comisiones por vendedor</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                   <table class="table">
                                        <tr>
                                            <th>Crédito</th>
                                            <th>Cuota</th>
                                            <th>Monto</th>
                                            <th>Comisión %</th>
                                            <th>Comisión por cuota</th>
                                            <th>Estatus</th>
                                            <th>¿Pagar?</th>
                                        </tr>
                                        <?php
                                        
                                        foreach ($res as $r) {
                                            echo '<tr>';
                                            echo '<td>'.$r->credito->id.'</td>';
                                            echo '<td>'.$r->id.'</td>';
                                            echo '<td>$'.$r->pago_aplicado.'</td>';
                                            echo '<td>'.$r->credito->vendedor->comision.'%</td>';
                                            echo '<td>$'.(($r->pago_aplicado * $r->credito->vendedor->comision)/100).'</td>';
                                            echo '<td>'.$r->getStatus().'</td>';
                                            if(isset($r->comisiones->id)){
                                                echo '<td> -- </td>';
                                            }else{
                                                switch ($r->status) {
                                                    case 1:
                                                    case 3:
                                                       echo '<td><input type="checkbox" disabled="true"/></td>';
                                                        break;
                                                    
                                                    case 2:
                                                       echo '<td>
                                                       <input type="checkbox" name="comisiones['.$r->id.'][id]" value="'.$r->id.'"/>
                                                       <input type="hidden" name="comisiones['.$r->id.'][comision]" value="'.$r->credito->vendedor->comision.'"/>
                                                       <input type="hidden" name="comisiones['.$r->id.'][monto]" value="'.(($r->pago_aplicado * $r->credito->vendedor->comision)/100).'"/></td>
                                                       <input type="hidden" name="comisiones['.$r->id.'][fecha_inicio]" value="'.$r->fecha_inicio.'"/></td>
                                                       <input type="hidden" name="comisiones['.$r->id.'][fecha_fin]" value="'.$r->fecha_vence.'"/></td>';
                                                       
                                                        break;
                                                }
                                            }
                                            

                                            
                                            
                                            # code...
                                        }
                                        //echo print_r($res);
                                        ?>
                                    </table> 
                                </div>
                                <div class="panel-footer">
                                    <div class="row text-right">
                                        <button class="btn btn-success btn-rounded" id="btn_get_reporte">
                                            <span class="btn-label"><i class="fa fa-check fa-lg"></i></span>Aplicar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        <?php
        }
        ?>
       
    </div>
</div>
@endsection
