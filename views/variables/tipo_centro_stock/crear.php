<h1>Crear</h1>
<?php foreach ($errores as $error) : ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
<?php endforeach; ?>
<form method="post">
    <?php include __DIR__ . "/formulario_2v.php" ?>
    <input type="submit" value="Crear Tipo de Centro Stock">
</form>