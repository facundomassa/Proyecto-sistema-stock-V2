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
            <th>TIPO</th>
            <th>NOMBRE</th>
            <th>TELEFONO</th>
            <th>PAIS</th>
            <th>PROVINCIA</th>
            <th>CIUDAD</th>
            <th>DIRECCION</th>
            <th>ACCIONES</th>
        </tr> 
    </thead>
    <tbody>
        <?PHP foreach($valores as $valor){ ?>
        <tr>
            <td><?php echo $valor->id_centros_stock ?></td>
            <td><?php echo $valor->tipo ?></td>
            <td><?php echo $valor->remitente_nombre . " " . $valor->remitente_apellido ?></td>
            <td><?php echo $valor->telefono ?></td>
            <td><?php echo $valor->nombre ?></td>
            <td><?php echo $valor->provincia ?></td>
            <td><?php echo $valor->ciudad ?></td>
            <td><?php echo $valor->direccion ?></td>
            <td>
                <form method="POST" action="/CentroStock/eliminar">
                    <input type="hidden" name="id" value="<?php echo $valor->id_centros_stock; ?>">
                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>    
                <a href="/CentroStock/actualizar?id=<?php echo $valor->id_centros_stock; ?>">Actualizar</a>
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>
<a href="/CentroStock/crear">CREAR</a>