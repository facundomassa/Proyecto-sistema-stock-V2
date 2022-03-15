<?php

namespace Model;

class MovimientoMateriales extends ActiveRecord{
    protected static $tabla = "movimiento_materiales";
    protected static $tablaSeg = "remito";
    protected static $tablaTer = "materiales";
    protected static $columnasBD = ["id_movimiento_materiales", "remito_id", "material_id", "cantidad"];
    protected static $id_name = "id_movimiento_materiales";

    public $id_movimiento_materiales;
    public $remito_id;
    public $material_id;
    public $cantidad;
    public $id;

    public function __construct($args = [])
    {
        $this->id_movimiento_materiales = $args["id_movimiento_materiales"] ?? null;
        $this->remito_id = $args["remito_id"] ?? "";
        $this->material_id = $args["material_id"] ?? "";
        $this->cantidad = $args["cantidad"] ?? "";
        $this->id = $args["id_centros_stock"] ?? null;
    }

    public function validar(){
        
        if (!$this->remito_id) {
            self::$errores[] = "Debes añadirlo a un remito";
        }
        if (!$this->material_id) {
            self::$errores[] = "Falta el material";
        }
        if (!$this->cantidad) {
            self::$errores[] = "Coloca un cantidad a retirar";
        }
        return self::$errores;
    }
    
    //traer todos los resultados sumando un innerjoin
    public static function getAll(){
        $query = "SELECT * FROM " . static::$tabla . " AS tp INNER JOIN " . static::$tablaSeg . " AS ts ON tp.remito_id = ts.id_remito INNER JOIN " . static::$tablaTer . " AS tr ON tp.material_id = tr.id_materiales";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_movimiento_materiales ;
        return $objeto;
    }
}

?>