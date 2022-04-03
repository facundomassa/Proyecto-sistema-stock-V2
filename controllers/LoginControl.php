<?php

namespace Control;

use MVC\Router;
use Model\Usuarios;

class LoginControl{

    public static function login(Router $router){
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuarios($_POST);
            $errores = $auth->validar();

            if(empty($errores)){
                //verificar el password
                //autenticar al usuario
                
                $resultado = $auth->comprobarCoorePass();
                
                if(!$resultado){
                    $auth->autenticar();
                } else {
                    $errores = Usuarios::getErorres();
                }
            }
        }
        
        $router->render("auth/login", [
            "errores" => $errores
        ]);
    }

    public static function logout(){
        session_start();
        
        $_SESSION = [];

        header("location: /");
    }
}