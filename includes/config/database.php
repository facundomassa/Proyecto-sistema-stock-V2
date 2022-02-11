<?php

    function conectarBD() : mysqli{
        $bd = new mysqli("localhost", "root", "megatutu", "sistema_stock");
        if(!$bd){
            echo "Error no se pudo conectar";
            exit;
        }
        return $bd;

    }
?>