<?php

namespace Model;

class Materiales extends ActiveRecord{
    protected static $tabla = "materiales";
    protected static $tablaSeg = "unidades";
    protected static $tablaTer = "tipo_material";
    protected static $columnasBD = ["id_materiales", "codigo", "descripcion", "unidad_id", "tipo_id"];
    protected static $id_name = "id_materiales";

    public $id_materiales;
    public $codigo;
    public $descripcion;
    public $unidad_id;
    public $tipo_id;
    public $unidad;
    public $tipo;
    public $id;

    public function __construct($args = [])
    {
        $this->id_materiales = $args["id_materiales"] ?? null;
        $this->codigo = $args["codigo"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->unidad_id = $args["unidad_id"] ?? "";
        $this->tipo_id = $args["tipo_id"] ?? "";
        $this->unidad = $args["unidad"] ?? "";
        $this->tipo = $args["tipo"] ?? "";
        $this->id = $args["id_centros_stock"] ?? null;
    }

    public function validar(){
        
        if (!$this->codigo) {
            self::$errores[] = "Agregale un codigo de material";
        }
        if (!$this->unidad_id) {
            self::$errores[] = "Falta la unidad";
        }
        if (!$this->tipo_id) {
            self::$errores[] = "Debes agregarle un tipo de material";
        }
        return self::$errores;
    }
    
    //traer todos los resultados sumando un innerjoin
    public static function getAll(){
        $query = "SELECT * FROM " . static::$tabla . " AS tp INNER JOIN " . static::$tablaSeg . " AS ts ON tp.unidad_id = ts.id_unidades INNER JOIN " . static::$tablaTer . " AS tr ON tp.tipo_id = tr.id_tipo_material";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_materiales ;
        return $objeto;
    }
}

?>