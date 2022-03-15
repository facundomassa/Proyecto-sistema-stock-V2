<?php

namespace Model;

class TipoCentroStock extends ActiveRecord{
    protected static $tabla = "tipo_centro_stock";
    protected static $columnasBD = ["id_tipo_centro_stock", "tipo", "operacion"];
    protected static $id_name = "id_tipo_centro_stock";

    public $id_tipo_centro_stock;
    public $tipo;
    public $operacion;
    public $id;

    public function __construct($args = [])
    {
        $this->id_tipo_centro_stock = $args["id_tipo_centro_stock"] ?? null;
        $this->tipo = $args["tipo"] ?? "";
        $this->operacion = $args["operacion"] ?? "";
        $this->id = $args["id_tipo_centro_stock"] ?? null;
    }

    public function validar(){
        
        if (!$this->tipo) {
            self::$errores[] = "Debes añadir un nombre";
        }
        if (!$this->operacion) {
            self::$errores[] = "Falta la operacion";
        }
        return self::$errores;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_tipo_centro_stock ;
        return $objeto;
    }
}

?>