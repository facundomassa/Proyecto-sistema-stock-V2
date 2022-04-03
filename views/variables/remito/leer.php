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
            <th>N° REMITO</th>
            <th>ORIGEN</th>
            <th>DESTINO</th>
            <th>FECHA CREACION</th>
            <th>FECHA FINALIZADO</th>
            <th>USUARIO</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
        </tr> 
    </thead>
   
    <tbody>
        <?PHP foreach($valores as $valor){ ?>
        <tr>
            <td><?php echo '<a href="/Remito/ver?id=' . $valor->id_remito . '">'. $valor->id_remito ?> <i class='bx bx-search'></i></td>
            <?PHP foreach($centrosStock as $centroStock){ ?>
            <?php if($centroStock->id_centros_stock == $valor->origen_id){echo "<td>" . '<a href="/CentroStock/actualizar?id=' . $centroStock->id_centros_stock . '">' . $centroStock->direccion . "</a></td>"; }?>
            <?PHP } ?>
            <td><?php echo '<a href="/CentroStock/actualizar?id=' . $valor->destino_id . '">'. $valor->direccion ?></a></td>
            <td><?php echo $valor->fecha_creacion ?></td>
            <td><?php echo $valor->fecha_finalizado ?></td>
            <td><?php echo $valor->nombre ?></td>
            <td><?php echo $valor->estado ?></td>
            <td> 
                <?php if($valor->estado != "FINALIZADO"){ ?>
                    <a href="/MovimientoMateriales/Crear?id=<?php echo $valor->id_remito; ?>">Agregar Materiales</a>
                <?php }?>
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>
<a class="btns crear" href="/Remito/crear">CREAR</a>