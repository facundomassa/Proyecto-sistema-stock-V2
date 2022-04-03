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
            <th class="width-1">ID</th>
            <th class="width-4">NOMBRE</th>
            <th class="width-3">OPERACION</th>
            <th class="width-2">ACCIONES</th>
        </tr> 
    </thead>
    <tbody>
        <?PHP foreach($valores as $valor){ ?>
        <tr>
            <td><?php echo $valor->id ?></td>
            <td><?php echo $valor->tipo ?></td>
            <td><?php echo $valor->operacion ?></td>
            <td>
                <form method="POST" action="/TipoCentroStock/eliminar">
                    <input type="hidden" name="id" value="<?php echo $valor->id; ?>">
                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>    
                <a href="/TipoCentroStock/actualizar?id=<?php echo $valor->id; ?>">Actualizar</a>
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>
<a class="btns crear" class="button" href="/TipoCentroStock/crear">CREAR</a>