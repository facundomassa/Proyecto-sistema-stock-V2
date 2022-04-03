<?php

namespace Control;

use MVC\Router;
use Model\Remito;
use Model\Materiales;
use Model\CentrosStock;
use Model\MovimientoMateriales;
use Model\TipoMaterial;
use Model\Unidades;

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

        $id = validarID("/MovimientoMateriales");

        $MaterialesEnviados = [];

        $TodosLosMovimientos = MovimientoMateriales::findDatos($id, "remito_id");
        foreach($TodosLosMovimientos as $key => $value){
            $MaterialesEnviados[] = Materiales::findID($value->material_id);
            $MaterialesEnviados[$key]->unidad = Unidades::findID($MaterialesEnviados[$key]->unidad_id)->unidad;
            $MaterialesEnviados[$key]->tipo = TipoMaterial::findID($MaterialesEnviados[$key]->tipo_id)->tipo;
            $MaterialesEnviados[$key]->cantidad = $value->cantidad;
            $MaterialesEnviados[$key]->id_movimiento_materiales = $value->id_movimiento_materiales;
        }
        
        //arreglo con msj de errores
        $errores = MovimientoMateriales::getErorres();

        $Materiales = Materiales::getAll();
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

        $router->render("variables/movimiento_materiales/crear",[
            "MovimientoMateriales" => $MovimientoMateriales,
            "MaterialesEnviados" => $MaterialesEnviados,
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
            $args = $_POST["MovimientoMateriales"];
            if(isset($args["id_movimiento_materiales"])){
                $args[MovimientoMateriales::nombreID()] = $args["id_movimiento_materiales"];
                $args["id"] = $args["id_movimiento_materiales"];
                $MovimientoMateriales->sincronizar($args);
            } else {
                $MovimientoMateriales = new MovimientoMateriales($_POST["MovimientoMateriales"]);
            }
            //llamamos a los errores
            $errores = $MovimientoMateriales->validar();
            //validamos id sean enteros
            if(empty($errores)){
                //comprobamos que las id exitan
                //insertamos
                $MovimientoMateriales->guardarMultiples();
            } else{
                echo $errores;
            }
        }
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){
                $MovimientoMateriales = MovimientoMateriales::findID($id);
                $MovimientoMateriales->eliminarMultiple("/MovimientoMateriales");
            }
        }
    }
}

?>