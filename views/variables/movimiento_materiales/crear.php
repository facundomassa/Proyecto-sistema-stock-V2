<?php
    $resultado = $_GET["mensaje"] ?? null;
    $valC = $_GET["valC"] ?? null;
    $valT = $_GET["valT"] ?? null;
    
    if(isset($resultado)) { 
        $mensaje = mostrarNotificacion(intval($resultado));
        ?> <p class="alerta exito"><?php echo s($mensaje) ?> </p> <?php
    } 
    if(isset($valC) && isset($valT)) { 
        ?> <p class="alerta exito">Se realizaron <?php echo s($valC) ?> de <?php echo s($valT) ?> movimiento(s) correctos</p> <?php
    } 
?>
<form method="post">
<div class="contenido-remito">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>CODIGO</th>
                <th>DESCRIPCION</th>
                <th>UNIDAD</th>
                <th>TIPO</th>
                <th>CANTIDAD</th>
                <th>OPERACIONES</th>
            </tr> 
        </thead>
        <tbody id="tablaMateriales">
            <?PHP foreach($MaterialesEnviados as $MaterialesEnviado){ ?>
            <tr>
                <td class="valor"><?php echo $MaterialesEnviado->id_materiales ?></td>
                <td><?php echo $MaterialesEnviado->codigo ?></td>
                <td><?php echo $MaterialesEnviado->descripcion ?></td>
                <td><?php echo $MaterialesEnviado->unidad ?> </td>
                <td><?php echo $MaterialesEnviado->tipo ?></td>
                <td><input type="number" name="MovimientoMateriales[cantidad]" min="0" id="cantidad" value="<?php echo $MaterialesEnviado->cantidad ?>"></td>
                <td>
                    <input type="button" value="Eliminar" class="eliminarMaterial" onclick="EliminarMaterial(this);">
                    <input type="hidden" name="MovimientoMateriales[id_movimiento_materiales]" id="MovimientoMateriales" value="<?php echo $MaterialesEnviado->id_movimiento_materiales ?>">
                    <input type="checkbox" name="MovimientoMateriales[eliminar]" id="eliminarChek" value="<?php echo $MaterialesEnviado->id_movimiento_materiales ?>">
                </td>
            </tr>
            <?PHP } ?>
        </tbody>
    </table>
    <button id="agregarMat">Agregar mas materiales</button>
    </div>
    <input class="btns guardar" type="submit" value="Guardar cambios" id="enviarMateriales">
    <a class="btns descartar" href="/Remito/ver?id=<?php echo $_GET["id"]?>">Descartar cambios</a>
</form>

<div id="ayuda" class="hidden">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>CODIGO</th>
                <th>DESCRIPCION</th>
                <th>UNIDAD</th>
                <th>TIPO</th>
            </tr> 
        </thead>
        <tbody id="todosMateriales">
            <?PHP foreach($Materiales as $Material){ ?>
            <tr>
                <td><input type="checkbox" name="MovimientoMateriales[material_id]" id="material_id" value="<?php echo $Material->id_materiales ?>"><?php echo $Material->id_materiales ?></td>
                <td><?php echo $Material->codigo ?></td>
                <td><?php echo $Material->descripcion ?></td>
                <td><?php echo $Material->unidad ?></td>
                <td><?php echo $Material->tipo ?></td>
            </tr>
            <?PHP } ?>
        </tbody>
    </table>
    <button id="agregarlosMat">Agregar</button>
</div>
