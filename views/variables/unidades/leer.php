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
            <td class="linea-butons-center">  
                <a class="btns btn-actualizar" href="/Unidades/actualizar?id=<?php echo $valor->id; ?>">Actualizar</a>
                <form method="POST" action="/Unidades/eliminar">
                    <input type="hidden" name="id" value="<?php echo $valor->id; ?>">
                    <button type="submit" class="btns btn-eliminar"><i class='bx bx-trash'></i></button>
                </form>  
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>
<a class="btns crear" href="/Unidades/crear">CREAR</a>