<?php

namespace Control;

use MVC\Router;
use Model\Remito;
use Model\CentrosStock;
use Model\Usuarios;
use Model\Estados;
use Model\MovimientoMateriales;
use Model\Materiales;
use Model\Stock;
use Model\TipoCentroStock;
use Model\TipoMaterial;
use Model\Unidades;

class StockControl{

    public static function leer(Router $router){
        $Stock = Stock::getAll();
        $Material = Materiales::getAll();
        $CentrosStock = CentrosStock::getAll();
        
        $StockTotal = [];
        foreach($Stock as $key => $value){
            // debuguear($value);
            $StockTotal[] = Materiales::findID($value->material_id);
            $StockTotal[$key]->centro_stock_id = CentrosStock::findID($value->centro_stock_id)->nombre_cs;
            $StockTotal[$key]->codigo = Materiales::findID($value->material_id)->codigo;
            $StockTotal[$key]->descripcion = Materiales::findID($value->material_id)->descripcion;
            $StockTotal[$key]->tipo = TipoMaterial::findID($StockTotal[$key]->tipo_id)->tipo;
            $StockTotal[$key]->unidad = Unidades::findID($StockTotal[$key]->unidad_id)->unidad;
            $StockTotal[$key]->cantidad = $value->cantidad;
        }
        $router->render("stock/leer",[
            "stockTotal" => $StockTotal,
            "centrosStock" => $CentrosStock
        ]);
    }

    public static function finalizado(){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $movimientoStock = MovimientoMateriales::findID($id);

        $Remito = Remito::findID($movimientoStock->remito_id);

        $centrosStock = CentrosStock::findID($Remito->destino_id);

        $Stock = Stock::findVariosDatos($centrosStock->id, "centro_stock_id", $movimientoStock->material_id, "material_id");

        if($Stock->id){
            $Stock->cantidad = $Stock->cantidad + $movimientoStock->cantidad;
            $Stock->guardarMultiples();
        } else {
            $Stock->centro_stock_id = $centrosStock->id;
            $Stock->material_id = $movimientoStock->material_id;
            $Stock->cantidad = $movimientoStock->cantidad;
            
        }
        
        if(empty($errores)){
            $Stock->guardarMultiples();
        } else {
            echo $errores;
        }
    }

    public static function finalizarOrden(){
        
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        $totalCantidad = 0;
        $cantidadCorrecta = 0;
        $Remito = Remito::findID($id);
        
        if($Remito->fecha_finalizado == ""){
            debuguear("falta fecha");
        } else if($Remito->estado_id != 3 || $Remito->estado_id != 5){
            
            $Remito->estado_id = 3;
            if($Remito->actualizarMultiples() == "CORRECTO"){
                
                $movimientos = MovimientoMateriales::findDatos($Remito->id_remito, "remito_id");
                foreach ($movimientos as $movimiento){
                    $totalCantidad += 1;
                    $Stock = Stock::findVariosDatos($Remito->destino_id, "centro_stock_id", $movimiento->material_id, "material_id");
                    
                    if($Stock == null){
                        $Stock = new Stock();
                        $Stock->centro_stock_id = $Remito->destino_id;
                        $Stock->material_id = $movimiento->material_id;
                    } else {
                        $Stock->actualizarID($Stock);
                    }
                    $Stock->cantidad = intval($Stock->cantidad) + intval($movimiento->cantidad);
                    
                    if($Stock->guardarMultiples() == "CORRECTO"){
                        $cantidadCorrecta += 1;
                    }
                }
                debuguear($cantidadCorrecta);
            } else {
                debuguear("salio mal");
            }
        }
    }
}
?>