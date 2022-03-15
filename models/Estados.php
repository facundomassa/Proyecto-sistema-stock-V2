<?php

namespace Model;

class Estados extends ActiveRecord{
    protected static $tabla = "estados";
    protected static $columnasBD = ["id_estados", "estado"];
    protected static $id_name = "id_estados";
    

    public $id_estados;
    public $estado;
    public $id;

    public function __construct($args = [])
    {
        $this->id_estados = $args["id_estados"] ?? null;
        $this->estado = $args["estado"] ?? "";
        $this->id = $args["id_estados"] ?? null;
    }

    public function validar(){
        
        if (!$this->estado) {
            self::$errores[] = "Debes añadir un nombre de estado";
        }
        return self::$errores;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_estados ;
        return $objeto;
    }
}

?>