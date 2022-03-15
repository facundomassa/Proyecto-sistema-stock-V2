<?php

namespace Model;

class Remito extends ActiveRecord{
    protected static $tabla = "remito";
    protected static $tablaSeg = "centros_stock";
    protected static $tablaTer = "usuarios";
    protected static $tablaCua = "estados";
    protected static $columnasBD = ["id_remito", "origen_id", "destino_id", "fecha_creacion", "fecha_finalizado", "creado_por_id", "estado_id"];
    protected static $id_name = "id_remito";

    public $id_remito;
    public $origen_id;
    public $destino_id;
    public $fecha_creacion;
    public $fecha_finalizado;
    public $creado_por_id;
    public $estado_id;
    public $direccion;
    public $nombre;
    public $estado;
    public $id;

    public function __construct($args = [])
    {
        $this->id_remito = $args["id_remito"] ?? null;
        $this->origen_id = $args["origen_id"] ?? "";
        $this->destino_id = $args["destino_id"] ?? "";
        $this->fecha_creacion = $args["fecha_creacion"] ?? "";
        $this->fecha_finalizado = $args["fecha_finalizado"] ?? "";
        $this->creado_por_id = $args["creado_por_id"] ?? "";
        $this->estado_id = $args["estado_id"] ?? "";
        $this->direccion = $args["direccion"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->estado = $args["estado"] ?? "";
        $this->id = $args["id_remito"] ?? null;
    }

    public function validar(){
        
        if (!$this->origen_id) {
            self::$errores[] = "Debes añadir el origen de los materiales";
        }
        if (!$this->destino_id) {
            self::$errores[] = "Falta destino";
        }
        if (!$this->creado_por_id) {
            self::$errores[] = "Usuario no existe";
        }
        return self::$errores;
    }
    
    //traer todos los resultados sumando un innerjoin
    public static function getAll(){
        $query = "SELECT * FROM " . static::$tabla . " AS tp INNER JOIN " . static::$tablaSeg . " AS ts ON tp.origen_id = ts.id_centros_stock INNER JOIN " . static::$tablaSeg . " AS tss ON tp.destino_id = tss.id_centros_stock INNER JOIN " . static::$tablaTer . " AS tr ON tp.creado_por_id = tr.id_usuarios INNER JOIN " . static::$tablaCua . " AS tc ON tp.estado_id = tc.id_estados";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_remito ;
        return $objeto;
    }
}

?>