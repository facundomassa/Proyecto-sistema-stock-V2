<?php

namespace Control;

use MVC\Router;
use Model\TipoCentroStock;

class TipoCentroStockControl{
    public static function leer(Router $router){
        $argumentos = TipoCentroStock::getAll();

        $router->render("variables/tipo_centro_stock/leer",[
            "valores" => $argumentos
        ]);
    }

    public static function actualizar(Router $router){
        $errores = TipoCentroStock::getErorres();

        $id = validarID("/");

        $TipoCentroStock = TipoCentroStock::findID($id);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $args = $_POST["tipoCentroStock"];

            //sincronizamos datos de la pagina al objeto
            $TipoCentroStock->sincronizar($args);

            //validacion
            $errores = $TipoCentroStock->validar();

            if(empty($errores)){
                $TipoCentroStock->guardar("/TipoCentroStock");
            }
        }

        $router->render("variables/tipo_centro_stock/actualizar",[
            "tipoCentroStock" => $TipoCentroStock,
            "errores" => $errores
        ]);
    }

    public static function crear(Router $router){
        $TipoCentroStock = new TipoCentroStock();

        //arreglo con msj de errores
        $errores = TipoCentroStock::getErorres();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $TipoCentroStock = new TipoCentroStock($_POST["tipoCentroStock"]);
            //llamamos a los errores
            $errores = $TipoCentroStock->validar();
            //insertamos
            if(empty($errores)){
                $TipoCentroStock->guardar("/TipoCentroStock");
            }
        }

        $router->render("variables/tipo_centro_stock/crear",[
            "tipoCentroStock" => $TipoCentroStock,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $TipoCentroStock = TipoCentroStock::findID($id);
                $TipoCentroStock->eliminar("/TipoCentroStock");
            }
        }
    }
}

?>