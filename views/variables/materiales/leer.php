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
            <th>CODIGO</th>
            <th>DESCRIPCION</th>
            <th>UNIDAD</th>
            <th>TIPO</th>
            <th>ACCIONES</th>
        </tr> 
    </thead>
    <tbody>
        <?PHP foreach($valores as $valor){ ?>
        <tr>
            <td><?php echo $valor->id_materiales ?></td>
            <td><?php echo $valor->codigo ?></td>
            <td><?php echo $valor->descripcion ?></td>
            <td><?php echo $valor->unidad ?></td>
            <td><?php echo $valor->tipo ?></td>
            <td>
                <form method="POST" action="/Materiales/eliminar">
                    <input type="hidden" name="id" value="<?php echo $valor->id_materiales; ?>">
                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>    
                <a href="/Materiales/actualizar?id=<?php echo $valor->id_materiales; ?>">Actualizar</a>
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>
<a href="/Materiales/crear">CREAR</a>