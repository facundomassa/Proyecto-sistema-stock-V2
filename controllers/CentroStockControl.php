<?php

namespace Control;

use MVC\Router;
use Model\CentrosStock;
use Model\TipoCentroStock;
use Model\Paises;

class CentroStockControl{

    public static function leer(Router $router){
        $CentrosStock = CentrosStock::getAll();

        $router->render("variables/centro_stock/leer",[
            "valores" => $CentrosStock
        ]);
    }

    public static function actualizar(Router $router){
        $TipoCentroStock = TipoCentroStock::getAll();
        $Paises = Paises::getAll();

        $errores = CentrosStock::getErorres();

        $id = validarID("/CentroStock");

        $CentrosStock = CentrosStock::findID($id);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $args = $_POST["CentrosStock"];
            $args[CentrosStock::nombreID()] = $id;
            $args["id"] = $id;
            //sincronizamos datos de la pagina al objeto
            $CentrosStock->sincronizar($args);
            //validacion
            $errores = $CentrosStock->validar();

            $CentrosStock->pais = filter_var($CentrosStock->pais, FILTER_VALIDATE_INT);
            $CentrosStock->tipo_stock_id = filter_var($CentrosStock->tipo_stock_id, FILTER_VALIDATE_INT);
            if(empty($errores)){
                //comprobamos que las id exitan
                if(!TipoCentroStock::findID($CentrosStock->tipo_stock_id)){
                    $errores[] = "Tipo de Centro Stock Inescitente";
                } else if(!Paises::findID($CentrosStock->pais)){
                    $errores[] = "Pais incorrecto";
                } else{
                    $CentrosStock->guardar("/CentroStock");
                }
            }
        }

        $router->render("variables/centro_stock/actualizar",[
            "centrosStock" => $CentrosStock,
            "tipoCentroStock" => $TipoCentroStock,
            "paises" => $Paises,
            "errores" => $errores
        ]);
    }

    public static function crear(Router $router){
        $CentrosStock = new CentrosStock();
        $TipoCentroStock = TipoCentroStock::getAll();
        $Paises = Paises::getAll();

        //arreglo con msj de errores
        $errores = CentrosStock::getErorres();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $CentrosStock = new CentrosStock($_POST["CentrosStock"]);
            //llamamos a los errores
            $errores = $CentrosStock->validar();
            //validamos id sean enteros
            $CentrosStock->pais = filter_var($CentrosStock->pais, FILTER_VALIDATE_INT);
            $CentrosStock->tipo_stock_id = filter_var($CentrosStock->tipo_stock_id, FILTER_VALIDATE_INT);
            
            if(empty($errores)){
                //comprobamos que las id exitan
                if(!TipoCentroStock::findID($CentrosStock->tipo_stock_id)){
                    $errores[] = "Tipo de Centro Stock Inescitente";
                } else if(!Paises::findID($CentrosStock->pais)){
                    $errores[] = "Pais incorrecto";
                } else{
                    //insertamos
                    $CentrosStock->guardar("/CentroStock");
                }
                
            }
        }

        $router->render("variables/centro_stock/crear",[
            "centrosStock" => $CentrosStock,
            "tipoCentroStock" => $TipoCentroStock,
            "paises" => $Paises,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){
                $CentrosStock = CentrosStock::findID($id);
                $CentrosStock->eliminar("/CentroStock");
            }
        }
    }

    public static function buscarID(){

        $errores = CentrosStock::getErorres();
        
        $id = validarID("/CentrosSTock");

        $CentrosStock = CentrosStock::findID($id);
        $TipoCentroStock = TipoCentroStock::findID($CentrosStock->tipo_stock_id);
        
        $datos = [
            "CentrosStock" => $CentrosStock,
            "TipoCentroStock" => $TipoCentroStock,
            "errores" => $errores];
        
        foreach($datos as $key => $value){
            $$key = $value;
        }
        $datos = json_encode($datos);
        echo $datos;
    }
}

?>