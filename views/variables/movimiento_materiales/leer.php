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
            <th class="width-1">Nº REMITO</th>
            <th class="width-1">DESDE</th>
            <th class="width-1">HASTA</th>
            <th class="width-2">COD. MATERIAL</th>
            <th class="width-2">MATERIAL</th>
            <th class="width-1">CANTIDAD</th>
            <th class="width-1">ACCIONES</th>
        </tr> 
    </thead>
   
    <tbody>
        <?PHP foreach($valores as $valor){ ?>
        <tr>
            <td><?php echo $valor->id_movimiento_materiales ?></td>
            <?PHP foreach($Remito as $Remit): 
            if($Remit->id_remito == $valor->remito_id){echo '<td><a href=' . '"/Remito/ver?id=' . $Remit->id_remito . '">' . $Remit->id_remito . '</a></td>'; 
                foreach($CentrosStock as $CentroStock): 
                    if($CentroStock->id_centros_stock == $Remit->origen_id){echo "<td>{$CentroStock->nombre_cs}</td>";}
                endforeach;
                foreach($CentrosStock as $CentroStock):
                    if($CentroStock->id_centros_stock == $Remit->destino_id){echo "<td>{$CentroStock->nombre_cs}</td>"; }
                endforeach;
                } endforeach;
            foreach($Materiales as $Material){
            if($Material->id_materiales == $valor->material_id){echo "<td>{$Material->codigo}</td><td>{$Material->descripcion}</td>"; }
            } ?>
            <td><?php echo $valor->cantidad ?></td>
            <td>
                <form method="POST" action="/Remito/eliminar">
                    <input type="hidden" name="id" value="<?php echo $valor->id_remito; ?>">
                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>    
                <a href="/Remito/actualizar?id=<?php echo $valor->id_remito; ?>">Actualizar</a>
            </td>
        </tr>
        <?PHP } ?>
    </tbody>
    
</table>