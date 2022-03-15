<?php

namespace Model;

class CentrosStock extends ActiveRecord{
    protected static $tabla = "centros_stock";
    protected static $tablaSeg = "tipo_centro_stock";
    protected static $tablaTer = "paises";
    protected static $columnasBD = ["id_centros_stock", "tipo_stock_id", "remitente_nombre", "remitente_apellido", "telefono", "pais", "provincia", "ciudad", "codigo_postal", "direccion", "nombre_cs"];
    protected static $id_name = "id_centros_stock";

    public $id_centros_stock;
    public $tipo_stock_id;
    public $remitente_nombre;
    public $remitente_apellido;
    public $telefono;
    public $pais;
    public $provincia;
    public $ciudad;
    public $codigo_postal;
    public $direccion;
    public $nombre_cs;
    public $tipo;
    public $operacion;
    public $nombre;
    public $id;

    public function __construct($args = [])
    {
        $this->id_centros_stock = $args["id_centros_stock"] ?? null;
        $this->tipo_stock_id = $args["tipo_stock_id"] ?? "";
        $this->remitente_nombre = $args["remitente_nombre"] ?? "";
        $this->remitente_apellido = $args["remitente_apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->pais = $args["pais"] ?? "";
        $this->provincia = $args["provincia"] ?? "";
        $this->ciudad = $args["ciudad"] ?? "";
        $this->codigo_postal = $args["codigo_postal"] ?? "";
        $this->direccion = $args["direccion"] ?? "";
        $this->nombre_cs = $args["nombre_cs"] ?? "";
        $this->tipo = $args["tipo"] ?? "";
        $this->operacion = $args["operacion"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->id = $args["id_centros_stock"] ?? null;
    }

    public function validar(){
        
        if (!$this->tipo_stock_id) {
            self::$errores[] = "Debes añadir el tipo de centro de stock";
        }
        if (!$this->remitente_nombre) {
            self::$errores[] = "Falta un nombre de remitente";
        }
        if (!$this->pais) {
            self::$errores[] = "Elige un pais";
        }
        if (!$this->provincia) {
            self::$errores[] = "Falta estado/provincia";
        }
        if (!$this->ciudad) {
            self::$errores[] = "Falta ciudad";
        }
        if (!$this->codigo_postal) {
            self::$errores[] = "Agrega un codigo postal";
        }
        if (!$this->direccion) {
            self::$errores[] = "Falta la direccion";
        }
        if (!$this->nombre_cs) {
            self::$errores[] = "Agregale un nombre al Centro de Stock";
        }
        return self::$errores;
    }
    
    //traer todos los resultados sumando un innerjoin
    public static function getAll(){
        $query = "SELECT * FROM " . static::$tabla . " AS tp INNER JOIN " . static::$tablaSeg . " AS ts ON tp.tipo_stock_id = ts.id_tipo_centro_stock INNER JOIN " . static::$tablaTer . " AS tr ON tp.pais = tr.id_paises";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_centros_stock ;
        return $objeto;
    }
}

?>