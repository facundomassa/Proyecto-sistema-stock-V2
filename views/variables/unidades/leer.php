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
            <th class="width-2">ID</th>
            <th class="width-6">UNIDAD</th>
            <th class="width-2">ACCIONES</th>
        </tr> 
    </thead>
    <tbody>
        <?PHP foreach($valores as $valor){ ?>
        <tr>
            <td><?php echo $valor->id ?></td>
            <td><?php echo $valor->unidad ?></td>
            <td>
                <form method="POST" action="/Unidades/eliminar">
                    <input type="hidden" name="id" value="<?php echo $valor->id; ?>">
                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>    
                <a href="/Unidades/actualizar?id=<?php echo $valor->id; ?>">Actualizar</a>
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>
<a class="btns crear" href="/Unidades/crear">CREAR</a>