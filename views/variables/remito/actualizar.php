<h1>Actualizar</h1>
<?php foreach ($errores as $error) : ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
<?php endforeach; ?>
<form method="post">
    <?php include __DIR__ . "/formulario.php" ?>
    <input class="btns" type="submit" value="Modificar">
    <a class="btns descartar" href="/Remito/ver?id=<?php echo $_GET["id"]?>">Descartar cambios</a>
</form>