<?php

namespace Model;

// require __DIR__ . "../../includes/funciones.php";

class ActiveRecord{
    //base de datos
    protected static $bd;
    protected static $columnasBD = [];
    protected static $tabla = "";
    protected static $id_name = "";
    //errores
    protected static $errores = [];

    //definir la conexion a la bd
    public static function setBD($dataBase){
        self::$bd = $dataBase;
    }

    public function guardar($url = "/"){
        if(!is_null($this->id)){
            //actualizar
            
            $this->actualizar($url);
            
        } else {
            //crear
            $this->crear($url);
        }
    }

    public function crear($url){

        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ');";
        $resultado = self::$bd->query($query);
        if ($resultado) {
            header("Location: ". $url ."?mensaje=1");
        }
    }

    public function actualizar($url){
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key} ='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE ". static::$id_name ." = '" . self::$bd->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ;";
        $resultado = self::$bd->query($query);

        if ($resultado) {
            header("Location: ". $url ."?mensaje=2");
        }
    }
    //eliminar un registro
    public function eliminar($url = "/"){
        $query = "DELETE FROM ". static::$tabla . " WHERE ". static::$id_name ." = " . self::$bd->escape_string($this->id) . " LIMIT 1 ;";
        $resultado = self::$bd->query($query);
        if($resultado){
            header("LOCATION: ". $url ."?mensaje=3");
        }
    }
    //identificar y unir los atributos de la bd
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasBD as $columna){
            if($columna === "id" || $columna === static::$id_name) continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$bd->escape_string($value);
        }

        return $sanitizado;
    }

    //funcion para obtener errores
    public static function getErorres(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    //traer todos los resultados
    public static function getAll(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //obtiene determinado numero de registros
    public static function getDesde($desde, $cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $desde . ", " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //buscar por id
    public static function findID($id){
        $query = "SELECT * FROM ". static::$tabla . " WHERE ". static::$id_name ." = " . self::$bd->escape_string($id) . " ;";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }


    //enviar el query a la bd
    public static function consultarSQL($query){
        //CONSULTAR
        $resultado = self::$bd->query($query);
        
        //ITERAR RESULTADOS
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            
            $array[] = static::crearObj($registro);
            
        }
        //LIBERAR MEMORIA
        $resultado->free();
        //RETOMAR LOS RESULTADOS
        return $array;
    }

    protected static function crearObj($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    //devolver nombre del id
    public static function nombreID(){
        $nombre = static::$id_name;
        return $nombre;
    }
    //sincroniza el objeto en memoria con los cambios realizados
    //sincronizamos datos de la pagina al objeto
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null(($value))){
                $this->$key = $value;
            }
        }
     }
}

?>