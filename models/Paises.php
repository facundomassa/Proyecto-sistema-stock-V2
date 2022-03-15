<?php

namespace Model;

class Paises extends ActiveRecord{
    protected static $tabla = "paises";
    protected static $columnasBD = ["id_paises", "iso", "nombre"];
    protected static $id_name = "id_paises";

    public $id_paises;
    public $iso;
    public $nombre;
    public $id;

    public function __construct($args = [])
    {
        $this->id_paises = $args["id_paises"] ?? null;
        $this->iso = $args["iso"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->id = $args["id_paises"] ?? null;
    }
}

?>