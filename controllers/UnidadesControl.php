<?php

namespace Control;

use MVC\Router;
use Model\Unidades;

class UnidadesControl{

    public static function leer(Router $router){
        $Unidades = Unidades::getAll();

        $router->render("variables/unidades/leer",[
            "valores" => $Unidades
        ]);
    }

    public static function actualizar(Router $router){
        $errores = Unidades::getErorres();

        $id = validarID("/");

        $Unidades = Unidades::findID($id);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $args = $_POST["unidad"];

            //sincronizamos datos de la pagina al objeto
            $Unidades->sincronizar($args);

            //validacion
            $errores = $Unidades->validar();

            if(empty($errores)){
                $Unidades->guardar("/Unidades");
            }
        }

        $router->render("variables/unidades/actualizar",[
            "valores" => $Unidades,
            "errores" => $errores
        ]);
    }

    public static function crear(Router $router){
        $Unidades = new Unidades();

        //arreglo con msj de errores
        $errores = Unidades::getErorres();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $Unidades = new Unidades($_POST["unidad"]);
            //llamamos a los errores
            $errores = $Unidades->validar();
            //insertamos
            if(empty($errores)){
                $Unidades->guardar("/Unidades");
            }
        }

        $router->render("variables/unidades/crear",[
            "valores" => $Unidades,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $Unidades = Unidades::findID($id);
                $Unidades->eliminar("/unidades");
            }
        }
    }
}

?>