<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION["login"] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN CSS Datatable -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/build/css/app.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Stock</title>
</head>
<body>
    <header class="header">
        <a href="/">
            <img src="/build/img/logo-cripto.png" alt="">
        </a>
        <h1>Administrador de materiales</h1>
        <img id="boton_menu" src="/build/img/bx-menu.svg" alt="">
    </header>
    <nav class="navegador">
        <ul class="nav_list">
            <li>
                <a href="/Stock">Stock</a>
            </li>
            <li>
                <a href="/Remito">Remitos</a>
            </li>
            <li>
                <a href="/MovimientoMateriales">Movimientos de materiales</a>
            </li>
            <li>
                <a href="/Materiales">Materiales</a>
            </li>
            <li>
                <a href="/CentroStock">Centros de Stock</a>
            </li>
            <li>
                <a href="/Unidades">Unidades</a>
            </li>
            <li>
                <a href="/Estados">Estados</a>
            </li>
            <li>
                <a href="/TipoCentroStock">Tipo de Centros de Stock</a>
            </li>
            <li>
                <a href="/TipoMaterial">Tipo de Materiales</a>
            </li>
        </ul>
        <div class="logout">
            <a class="btns btn-cerrarS" href="/logout"><i class='bx bx-log-out'></i>Cerrar Seccion</a>
        </div>
    </nav>
    
    <main class="main">
        <img class="volver" onClick="history.go(-1);" src="/build/img/flecha-return.png" alt="volver atras">
        <div class="contenedor">
        <?php 
        $resultado = $_GET["mensaje"] ?? null;
        if(isset($resultado)) { 
            $mensaje = mostrarNotificacion(intval($resultado));
            ?> <p class="alerta exito"><?php echo s($mensaje) ?> </p> <?php
        } 
        if(isset($errores)){
            foreach ($errores as $error) { ?>
            <div class="alerta error">
            <i class='bx bxs-error'></i>
                <?php echo $error; ?>
            </div>
        <?php }}?>
            <?php echo $contenido; ?>
        </div>
    </main>
    <footer class="footer">
        <p>Todos los derechos reservados</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/build/js/bundle.min.js"></script>
</body>
</html>