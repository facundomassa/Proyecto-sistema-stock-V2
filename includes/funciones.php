<?php
//muestra los msj
function mostrarNotificacion($codigo){
    $mensaje = "";
    switch($codigo) {
        case 1:
            $mensaje = "Creado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

//escapar / sanitizar el html
function s($html){
    $s = htmlspecialchars($html);
    return $s;
}

//validar si es una id valida
function validarID( string $url = "/", string $n_id = "id"){
    $id = $_GET[$n_id];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if(!$id){
        header("Location: ${url}");
    }
    return $id;
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}


function imprimir($direccion){
    $direccionImprimir = $_SERVER["DOCUMENT_ROOT"] . $direccion;
    $dompdf = new Dompdf();
    ob_start();
    echo file_get_contents($direccionImprimir);
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=documento.pdf");
    echo $dompdf->output();
}


?>
