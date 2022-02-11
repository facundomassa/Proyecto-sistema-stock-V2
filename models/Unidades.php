<?php

namespace Model;

class Unidades extends ActiveRecord{
    protected static $tabla = "unidades";
    protected static $columnasBD = ["id_unidades", "unidad"];
    protected static $id_name = "id_unidades";

    public $id_unidades;
    public $unidad;

    public function __construct($args = [])
    {
        $this->id_unidades = $args["id_unidades"] ?? null;
        $this->unidad = $args["unidad"] ?? "";
    }

    public function validar(){
        
        if (!$this->unidad) {
            self::$errores[] = "Debes añadir un tipo de unidad";
        }
        return self::$errores;
    }

}

?>