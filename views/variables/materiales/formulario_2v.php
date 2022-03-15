<label for="codigo">Codigo</label>
<input type="text" id="codigo" name="Materiales[codigo]" placeholder="Codigo" value="<?php echo s($materiales->codigo); ?>">
<label for="descripcion">Descripcion</label>
<input type="text" id="descripcion" name="Materiales[descripcion]" placeholder="Descripcion" value="<?php echo s($materiales->descripcion); ?>">
<label for="unidad">Unidades</label>
<select name="Materiales[unidad_id]" id="unidad">
<option selected disabled value="">-- Seleccionar Unidad --</option>
    <?php foreach($unidades as $unidade) : ?>
    <option value="
    <?php echo s($unidade->id_unidades);?>"
    <?php if(s($unidade->id_unidades) == $materiales->unidad_id)echo "selected"?>>
    <?php echo s($unidade->unidad); ?></option>
    <?php endforeach; ?>
</select>
<label for="tipo">Tipo Material</label>
<select name="Materiales[tipo_id]" id="tipo">
    <option selected disabled value="">-- Seleccione tipo --</option>
    <?php foreach($tipoMaterial as $tipoM) : ?>
    <option value="
    <?php echo s($tipoM->id_tipo_material);?>"
    <?php if(s($tipoM->id_tipo_material) == $materiales->tipo_id)echo "selected"?>>
    <?php echo s($tipoM->tipo); ?></option>
    <?php endforeach; ?>
</select>