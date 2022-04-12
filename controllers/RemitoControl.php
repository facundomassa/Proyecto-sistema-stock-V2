<?php

namespace Control;

use MVC\Router;
use Model\Remito;
use Model\CentrosStock;
use Model\Usuarios;
use Model\Estados;
use Model\MovimientoMateriales;
use Model\Materiales;
use Model\Unidades;

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

        if(isset($_GET["R"])){
            $r = $_GET["R"];
        }
        $r = isset($r) ? $r : "REM";
        $Remito = Remito::findID($id);
        $Estados = Estados::findID($Remito->estado_id);

        if($r == "MAT"){
            $Materiales = Materiales::getAll();
            $MovimientoMateriales = MovimientoMateriales::findDatos($id, "remito_id");
            foreach($MovimientoMateriales as $key => $value){
                $MovimientoMateriales[$key]->Materiales = Materiales::findID($value->material_id);
            }
            $router->render("variables/remito/verMateriales",[
                "Remito" => $Remito,
                "Estado" => $Estados,
                "MovimientoMateriales" => $MovimientoMateriales,
                "Materiales" => $Materiales,
                "errores" => $errores
            ]);
        } else{
            $Origen = CentrosStock::findID($Remito->origen_id);
            $Destino = CentrosStock::findID($Remito->destino_id);
            $Usuarios = Usuarios::findID($Remito->creado_por_id);
            $UsuariosN = $Usuarios->nombre;
            $router->render("variables/remito/verRemito",[
                "Remito" => $Remito,
                "Origen" => $Origen,
                "Destino" => $Destino,
                "Usuarios" => $UsuariosN,
                "Estado" => $Estados,
                "errores" => $errores
            ]);
        }
    }

    public static function imprimir(Router $router){

        $errores = Remito::getErorres();

        $id = validarID("/Remito");

        $Remito = Remito::findID($id);
        $Estados = Estados::findID($Remito->estado_id);
        $Materiales = Materiales::getAll();
        $MovimientoMateriales = MovimientoMateriales::findDatos($id, "remito_id");
        foreach($MovimientoMateriales as $key => $value){
            $MovimientoMateriales[$key]->Materiales = Materiales::findID($value->material_id);
            $MovimientoMateriales[$key]->Unidades = Unidades::findID($MovimientoMateriales[$key]->Materiales->unidad_id);
        }
        $Origen = CentrosStock::findID($Remito->origen_id);
        $Destino = CentrosStock::findID($Remito->destino_id);
        $Usuarios = Usuarios::findID($Remito->creado_por_id);
        $UsuariosN = $Usuarios->nombre;

        $router->render("variables/remito/imprimir",[
            "MovimientoMateriales" => $MovimientoMateriales,
            "Materiales" => $Materiales,
            "Remito" => $Remito,
            "Origen" => $Origen,
            "Destino" => $Destino,
            "Usuarios" => $UsuariosN,
            "Estado" => $Estados,
            "errores" => $errores
        ], true);
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
                    $Remito->guardar("/Remito/ver?id=" . $NumeroRemito);
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

    public static function actualizar(Router $router){

        $id = validarID("/Remito");

        $Remito = Remito::findID($id);
        //arreglo con msj de errores
        $errores = Remito::getErorres();

        $CentrosStock = CentrosStock::getAll();
        $NumeroRemito = $id;
        $Estados = Estados::getAll();
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //crea una nueva instancia y se pasa los arg
            $args = $_POST["Remito"];
            $args[Remito::nombreID()] = $id;
            $args["id"] = $id;
            //sincronizamos datos de la pagina al objeto
            $Remito->sincronizar($args);
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
                    $Remito->guardar("/Remito/ver?id=" . $id, true);
                }
                
            }
        }

        $router->render("variables/remito/actualizar",[
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