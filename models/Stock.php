<?php

namespace Model;

class Stock extends ActiveRecord{
    protected static $tabla = "stock";
    protected static $columnasBD = ["id_stock", "centro_stock_id", "material_id", "cantidad"];
    protected static $id_name = "id_stock";

    public $id_stock;
    public $centro_stock_id;
    public $material_id;
    public $cantidad;
    public $id;

    public function __construct($args = [])
    {
        $this->id_stock = $args["id_stock"] ?? null;
        $this->centro_stock_id = $args["centro_stock_id"] ?? "";
        $this->material_id = $args["material_id"] ?? "";
        $this->cantidad = $args["cantidad"] ?? "";
        $this->id = $args["id_stock"] ?? null;
    }

    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_stock ;
        return $objeto;
    }

}

?>