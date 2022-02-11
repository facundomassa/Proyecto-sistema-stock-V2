<?php

namespace Control;

use MVC\Router;
use Model\Estados;

class EstadosControl{

    public static function leer(Router $router){
        $Estados = Estados::getAll();

        $router->render("variables/estados/leer",[
            "valores" => $Estados
        ]);
    }

    public static function actualizar(Router $router){
        $errores = Estados::getErorres();

        $id = validarID("/");

        $Estados = Estados::findID($id);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $args = $_POST["estados"];

            //sincronizamos datos de la pagina al objeto
            $Estados->sincronizar($args);

            //validacion
            $errores = $Estados->validar();

            if(empty($errores)){
                $Estados->guardar("/Estados");
            }
        }

        $router->render("variables/estados/actualizar",[
            "valores" => $Estados,
            "errores" => $errores
        ]);
    }

    public static function crear(Router $router){
        $Estados = new Estados();

        //arreglo con msj de errores
        $errores = Estados::getErorres();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $Estados = new Estados($_POST["estados"]);
            //llamamos a los errores
            $errores = $Estados->validar();
            //insertamos
            if(empty($errores)){
                $Estados->guardar("/Estados");
            }
        }

        $router->render("variables/estados/crear",[
            "valores" => $Estados,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $Estados = Estados::findID($id);
                $Estados->eliminar("/Estados");
            }
        }
    }
}

?>