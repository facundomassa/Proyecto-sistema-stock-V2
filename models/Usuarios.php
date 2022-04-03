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

    public function comprobarCoorePass(){
        //revisar si el usuario existe
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1;";

        $resultado = self::$bd->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return;
        }

        $usuario = $resultado->fetch_object();
        
        $autenticado = password_verify($this->contraseña, $usuario->contraseña);

        if(!$autenticado){
            self::$errores[] = "El Password es Incorrecto";
        }
    }

    public function autenticar(){
        session_start();
        //lenar el arreglo de seccion
        $_SESSION["usuario"] = $this->nombre;
        $_SESSION["login"] = true;

        header("location: /Remito");
    }
}

?>