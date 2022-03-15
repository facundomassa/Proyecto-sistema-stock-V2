<?php

namespace Control;

use MVC\Router;
use Model\Remito;
use Model\CentrosStock;
use Model\Usuarios;
use Model\Estados;
use Model\MovimientoMateriales;
use Model\Materiales;

class RemitoControl{

    public static function leer(Router $router){
        $Remito = Remito::getAll();
        $CentrosStock = CentrosStock::getAll();
        
        $router->render("variables/remito/leer",[
            "valores" => $Remito,
            "centrosStock" => $CentrosStock
        ]);
    }

    public static function ver(Router $router){

        $errores = Remito::getErorres();

        $id = validarID("/Remito");

        $Remito = Remito::findID($id);

        $Origen = CentrosStock::findID($Remito->origen_id);
        $Destino = CentrosStock::findID($Remito->destino_id);
        $Usuarios = Usuarios::findID($Remito->creado_por_id);
        $UsuariosN = $Usuarios->nombre;
        $Estados = Estados::findID($Remito->estado_id);
        $Materiales = Materiales::getAll();
        $MovimientoMateriales = MovimientoMateriales::findDatos($id, "remito_id");
        
        $router->render("variables/remito/ver",[
            "Remito" => $Remito,
            "Origen" => $Origen,
            "Destino" => $Destino,
            "Usuarios" => $UsuariosN,
            "Estado" => $Estados,
            "MovimientoMateriales" => $MovimientoMateriales,
            "Materiales" => $Materiales,
            "errores" => $errores
        ]);
    }

    public static function verAjax(){

        $errores = Remito::getErorres();
        
        $id = validarID("/Remito");
        
        $Remito = Remito::findID($id);

        $Origen = CentrosStock::findID($Remito->origen_id);
        $Destino = CentrosStock::findID($Remito->destino_id);
        $Usuarios = Usuarios::findID($Remito->creado_por_id);
        $UsuariosN = $Usuarios->nombre;
        $Estados = Estados::findID($Remito->estado_id);
        $Materiales = Materiales::getAll();
        $MovimientoMateriales = MovimientoMateriales::findDatos($id, "remito_id");
        
        $datos = ["Remito" => $Remito,
            "Origen" => $Origen,
            "Destino" => $Destino,
            "Usuarios" => $UsuariosN,
            "Estado" => $Estados,
            "MovimientoMateriales" => $MovimientoMateriales,
            "Materiales" => $Materiales,
            "errores" => $errores];
        foreach($datos as $key => $value){
            $$key = $value;
        }
        $datos = json_encode($datos);
        // debuguear($datos);
        echo $datos;
    }

    public static function verMateriales(){
        $errores = Remito::getErorres();

        $id = validarID("/Remito");

        $Materiales = Materiales::getAll();
        $MovimientoMateriales = MovimientoMateriales::findDatos($id, "remito_id");

        $datos = ["Materiales" => $Materiales,
            "MovimientoMateriales" => $MovimientoMateriales,
            "errores" => $errores];

        foreach($datos as $key => $value){
            $$key = $value;
        }
        $datos = json_encode($datos);
        // debuguear($datos);
        echo $datos;
    }

    public static function crear(Router $router){
        $Remito = new Remito();

        //arreglo con msj de errores
        $errores = Remito::getErorres();

        $CentrosStock = CentrosStock::getAll();
        $NumeroRemito = Remito::finalID();
        $NumeroRemito ++;
        $Estados = Estados::getAll();
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $Remito = new Remito($_POST["Remito"]);
            //llamamos a los errores
            $errores = $Remito->validar();
            if(empty($errores)){
                //comprobamos que las id exitan
                if(!CentrosStock::findID($Remito->origen_id) || !CentrosStock::findID($Remito->destino_id)){
                    $errores[] = "Algun Centro Stock Inescitente";
                } else if(!Estados::findID($Remito->estado_id)){
                    $errores[] = "Estado incorrecto";
                } else if(!Usuarios::findID($Remito->creado_por_id)){
                    $errores[] = "Usuario incorrecto";
                } else{
                    //insertamos
                    $Remito->guardar("/MovimientoMateriales/Crear?id=" . $NumeroRemito);
                }
                
            }
        }

        $router->render("variables/remito/crear",[
            "remito" => $Remito,
            "estados" => $Estados,
            "NumeroRemitoFinal" => $NumeroRemito,
            "centrosStock" => $CentrosStock,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){
                $Remito = Remito::findID($id);
                $Remito->eliminar("/Remito");
            }
        }
    }
}

?>