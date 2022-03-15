<?php

namespace Model;

class Unidades extends ActiveRecord{
    protected static $tabla = "unidades";
    protected static $columnasBD = ["id_unidades", "unidad"];
    protected static $id_name = "id_unidades";

    public $id_unidades;
    public $unidad;
    public $id;

    public function __construct($args = [])
    {
        $this->id_unidades = $args["id_unidades"] ?? null;
        $this->unidad = $args["unidad"] ?? "";
        $this->id = $args["id_unidades"] ?? null;
    }

    public function validar(){
        
        if (!$this->unidad) {
            self::$errores[] = "Debes añadir un tipo de unidad";
        }
        return self::$errores;
    }
    
    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_unidades ;
        return $objeto;
    }
}

?>