<?php

namespace Control;

use MVC\Router;
use Model\Remito;
use Model\Materiales;
use Model\CentrosStock;
use Model\MovimientoMateriales;

class MovimientoMaterialesControl{

    public static function leer(Router $router){
        $MovimientoMateriales = MovimientoMateriales::getAll();
        $Remito = Remito::getAll();
        $Materiales = Materiales::getAll();
        $CentrosStock = CentrosStock::getAll();

        $router->render("variables/movimiento_materiales/leer",[
            "valores" => $MovimientoMateriales,
            "Remito" => $Remito,
            "Materiales" => $Materiales,
            "CentrosStock" => $CentrosStock,
        ]);
    }

    public static function actualizar(Router $router){

        $errores = MovimientoMateriales::getErorres();

        $id = validarID("/MovimientoMateriales");

        $MovimientoMateriales = MovimientoMateriales::findID($id);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $args = $_POST["MovimientoMateriales"];
            $args[MovimientoMateriales::nombreID()] = $id;
            $args["id"] = $id;
            //sincronizamos datos de la pagina al objeto
            $MovimientoMateriales->sincronizar($args);
            //validacion
            $errores = $MovimientoMateriales->validar();
            if(empty($errores)){
                $MovimientoMateriales->guardar("/MovimientoMateriales");
            }
        }

        $router->render("variables/movimiento_materiales/actualizar",[
            "movimientoMateriales" => $MovimientoMateriales,
            "errores" => $errores
        ]);
    }

    public static function crear(Router $router){
        $MovimientoMateriales = new MovimientoMateriales();

        //arreglo con msj de errores
        $errores = MovimientoMateriales::getErorres();

        $Materiales = Materiales::findDatos();
        // if($_SERVER["REQUEST_METHOD"] === "POST"){
        //     //crea una nueva instancia y se pasa los arg
        //     $MovimientoMateriales = new MovimientoMateriales($_POST["MovimientoMateriales"]);
        //     //llamamos a los errores
        //     $errores = $MovimientoMateriales->validar();
        //     //validamos id sean enteros
            
        //     if(empty($errores)){
        //         //comprobamos que las id exitan
        //         //insertamos
        //         $MovimientoMateriales->guardarMultiples();
        //     }
        // }

        $router->render("variables/movimiento_materiales/crear",[
            "MovimientoMateriales" => $MovimientoMateriales,
            "Materiales" => $Materiales,
            "errores" => $errores
        ]);
    }

    public static function crearMultiples(){
        $MovimientoMateriales = new MovimientoMateriales();

        //arreglo con msj de errores
        $errores = MovimientoMateriales::getErorres();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $MovimientoMateriales = new MovimientoMateriales($_POST["MovimientoMateriales"]);
            //llamamos a los errores
            $errores = $MovimientoMateriales->validar();
            //validamos id sean enteros
            if(empty($errores)){
                //comprobamos que las id exitan
                //insertamos
                $MovimientoMateriales->guardarMultiples();
            }
        }
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){
                $MovimientoMateriales = MovimientoMateriales::findID($id);
                $MovimientoMateriales->eliminar("/MovimientoMateriales");
            }
        }
    }
}

?>