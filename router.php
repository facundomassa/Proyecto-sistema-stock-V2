<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPost = [];
    
    public function get($url, $fn){
         $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPost[$url] = $fn;
   }
    
    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION["login"] ?? null;
        //areglo de rutas protegidas
        $rutas_protegidas = ["/admin", "/propiedades/crear", "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/crear", "/vendedores/actualizar", "/vendedores/eliminar"];

        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];
        
        if($metodo === "GET"){
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPost[$urlActual] ?? null;
        }

        //proteger las rutas
        if($urlActual != "/" && !$auth){
            header("location: /");
        }
        
        if($fn){
            //la url existe y hay una funcion asociada
            //debuguear($fn);
            call_user_func($fn, $this);
            
        } else {
            echo "Pagina no encontrada";
        }
    }

    //muestra una vista
    public function render($view, $datos = [],$imprimir = false){
        foreach($datos as $key => $value){
            $$key = $value;
        }
        ob_start(); //almacenar en memoria durante un tiiempo
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // limpiar el buffer
        if(!$imprimir){
            include __DIR__ . "/views/layout.php";
        } else {
            echo $contenido;
        }
    }
}