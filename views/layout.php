<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css">
    <!-- CDN CSS Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
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
    </nav>
    <main class="main">
        <div class="contenedor">
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