<?php

namespace Model;

class Usuarios extends ActiveRecord{
    protected static $tabla = "usuarios";
    protected static $columnasBD = ["id_usuarios", "nombre", "email", "contraseña"];
    protected static $id_name = "id_usuarios";

    public $id_usuarios;
    public $nombre;
    public $email;
    public $contraseña;
    public $id;

    public function __construct($args = [])
    {
        $this->id_usuarios = $args["id_usuarios"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->contraseña = $args["contraseña"] ?? "";
        $this->id = $args["id_usuarios"] ?? null;
    }

    public function validar(){
        
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir tu nombre";
        }
        if (!$this->email) {
            self::$errores[] = "Falta correo electronico";
        }
        if (!$this->contraseña) {
            self::$errores[] = "Falta contraseña";
        }
        return self::$errores;
    }
    
    public static function actualizarID($objeto){
        $objeto->id = $objeto->id_usuarios;
        return $objeto;
    }
}

?>