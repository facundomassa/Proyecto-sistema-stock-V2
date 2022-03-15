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
            </tr> 
        </thead>
        <tbody id="tablaMateriales">
        </tbody>
    </table>
    <button id="agregarMat">Agregar mas materiales</button>
    </div>
    <input type="submit" value="Crear" id="enviarMateriales">
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
        <tbody>
            <?PHP foreach($Materiales as $Material){ ?>
            <tr id="todosMateriales">
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
