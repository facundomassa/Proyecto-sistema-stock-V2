<?php

namespace Control;

use MVC\Router;
use Model\Materiales;
use Model\Unidades;
use Model\TipoMaterial;

class MaterialesControl{

    public static function leer(Router $router){
        $Materiales = Materiales::getAll();

        $router->render("variables/materiales/leer",[
            "valores" => $Materiales
        ]);
    }

    public static function actualizar(Router $router){
        $Unidades = Unidades::getAll();
        $TipoMaterial = TipoMaterial::getAll();

        $errores = Materiales::getErorres();

        $id = validarID("/CentroStock");

        $Materiales = Materiales::findID($id);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $args = $_POST["Materiales"];
            $args[Materiales::nombreID()] = $id;
            $args["id"] = $id;
            //sincronizamos datos de la pagina al objeto
            $Materiales->sincronizar($args);
            //validacion
            $errores = $Materiales->validar();

            $Materiales->tipo_id = filter_var($Materiales->tipo_id, FILTER_VALIDATE_INT);
            $Materiales->unidad_id = filter_var($Materiales->unidad_id, FILTER_VALIDATE_INT);
            if(empty($errores)){
                //comprobamos que las id exitan
                if(!Unidades::findID($Materiales->unidad_id)){
                    $errores[] = "Tipo de Unidad inexistente";
                } else if(!TipoMaterial::findID($Materiales->tipo_id)){
                    $errores[] = "Tipo de material incorrecto";
                } else{
                    $Materiales->guardar("/Materiales");
                }
            }
        }

        $router->render("variables/materiales/actualizar",[
            "materiales" => $Materiales,
            "unidades" => $Unidades,
            "tipoMaterial" => $TipoMaterial,
            "errores" => $errores
        ]);
    }

    public static function crear(Router $router){
        $Materiales = new Materiales();
        $Unidades = Unidades::getAll();
        $TipoMaterial = TipoMaterial::getAll();

        //arreglo con msj de errores
        $errores = Materiales::getErorres();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $Materiales = new Materiales($_POST["Materiales"]);
            //llamamos a los errores
            $errores = $Materiales->validar();
            //validamos id sean enteros
            $Materiales->tipo_id = filter_var($Materiales->tipo_id, FILTER_VALIDATE_INT);
            $Materiales->unidad_id = filter_var($Materiales->unidad_id, FILTER_VALIDATE_INT);
            
            if(empty($errores)){
                //comprobamos que las id exitan
                if(!Unidades::findID($Materiales->unidad_id)){
                    $errores[] = "Tipo de Unidades Inescitente";
                } else if(!TipoMaterial::findID($Materiales->tipo_id)){
                    $errores[] = "Tipo de material Incorrecto";
                } else{
                    //insertamos
                    $Materiales->guardar("/Materiales");
                }
                
            }
        }

        $router->render("variables/materiales/crear",[
            "materiales" => $Materiales,
            "unidades" => $Unidades,
            "tipoMaterial" => $TipoMaterial,
            "errores" => $errores
        ]);
    }

    public static function buscarMateriales(){
        $errores = Materiales::getErorres();

        $id = validarID("/");

        $Materiales = Materiales::findID($id);
        $Unidades = Unidades::findID($Materiales->unidad_id);
        $TipoMaterial = TipoMaterial::findID($Materiales->tipo_id);

        $datos = ["Materiales" => $Materiales,
            "Unidades" => $Unidades,
            "TipoMaterial" => $TipoMaterial,
            "errores" => $errores];
        foreach($datos as $key => $value){
            $$key = $value;
        }
        $datos = json_encode($datos);
        // debuguear($datos);
        echo $datos;
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){
                $Materiales = Materiales::findID($id);
                $Materiales->eliminar("/Materiales");
            }
        }
    }
}

?>