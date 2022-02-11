<?php
    $resultado = $_GET["mensaje"] ?? null;
    
    if(isset($resultado)) { 
        $mensaje = mostrarNotificacion(intval($resultado));
        ?> <p class="alerta exito"><?php echo s($mensaje) ?> </p> <?php
    } 
?>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>ESTADOS</th>
            <th>ACCIONES</th>
        </tr> 
    </thead>
    <tbody>
        <?PHP foreach($valores as $valor){ ?>
        <tr>
            <td><?php echo $valor->id ?></td>
            <td><?php echo $valor->estado ?></td>
            <td>
                <form method="POST" action="/Estados/eliminar">
                    <input type="hidden" name="id" value="<?php echo $valor->id; ?>">
                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>    
                <a href="/Estados/actualizar?id=<?php echo $valor->id; ?>">Actualizar</a>
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>
<a href="/Estados/crear">CREAR</a>