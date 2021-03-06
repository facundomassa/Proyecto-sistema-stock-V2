<?php

namespace Model;

class TipoMaterial extends ActiveRecord{
    protected static $tabla = "tipo_material";
    protected static $columnasBD = ["id_tipo_material", "tipo"];
    protected static $id_name = "id_tipo_material";

    public $id_tipo_material;
    public $tipo;
    public $id;

    public function __construct($args = [])
    {
        $this->id_tipo_material = $args["id_tipo_material"] ?? null;
        $this->tipo = $args["tipo"] ?? "";
        $this->id = $args["id_centros_stock"] ?? null;
    }

    public function validar(){
        
        if (!$this->tipo) {
            self::$errores[] = "Debes añadir un tipo de material";
        }
        return self::$errores;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_tipo_material ;
        return $objeto;
    }
}

?>