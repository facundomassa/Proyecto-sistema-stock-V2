<label for="Centro de Stock"></label>
<select id="">
    <option value="todos">Todos</option>
    <?php
        foreach($centrosStock as $centroStock){ ?>
        <option value="<?php echo $centroStock->id_centros_stock ?>"><?php echo $centroStock->nombre_cs ?></option>
        <?php }
    ?>
</select>
<table class="table">
    <thead>
        <tr>
            <th>CENTRO DE STOCK</th>
            <th>CODIGO</th>
            <th>DESCRIPCION</th>
            <th>TIPO DE MATERIAL</th>
            <th>UNIDAD</th>
            <th>CANTIDAD</th>
        </tr> 
    </thead>
   
    <tbody>
        <?PHP foreach($stockTotal as $stock){ ?>
        <tr>
            <td><?php echo $stock->centro_stock_id ?></td>
            <td><?php echo $stock->codigo ?></td>
            <td><?php echo $stock->descripcion ?></td>
            <td><?php echo $stock->tipo ?></td>
            <td><?php echo $stock->unidad ?></td>
            <td><?php echo $stock->cantidad ?></td>
        </tr>
        <?PHP } ?>
    </tbody>
</table>