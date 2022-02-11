<?php

namespace Control;

use MVC\Router;
use Model\TipoMaterial;

class TipoMaterialControl{

    public static function leer(Router $router){
        $Estados = TipoMaterial::getAll();

        $router->render("variables/tipo_material/leer",[
            "valores" => $Estados
        ]);
    }

    public static function actualizar(Router $router){
        $errores = TipoMaterial::getErorres();

        $id = validarID("/");

        $Estados = TipoMaterial::findID($id);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $args = $_POST["tipo"];

            //sincronizamos datos de la pagina al objeto
            $Estados->sincronizar($args);

            //validacion
            $errores = $Estados->validar();

            if(empty($errores)){
                $Estados->guardar("/TipoMaterial");
            }
        }

        $router->render("variables/tipo_material/actualizar",[
            "valores" => $Estados,
            "errores" => $errores
        ]);
    }

    public static function crear(Router $router){
        $Estados = new TipoMaterial();

        //arreglo con msj de errores
        $errores = TipoMaterial::getErorres();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $Estados = new TipoMaterial($_POST["tipo"]);
            //llamamos a los errores
            $errores = $Estados->validar();
            //insertamos
            if(empty($errores)){
                $Estados->guardar("/TipoMaterial");
            }
        }

        $router->render("variables/tipo_material/crear",[
            "valores" => $Estados,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $Estados = TipoMaterial::findID($id);
                $Estados->eliminar("/TipoMaterial");
            }
        }
    }
}

?>