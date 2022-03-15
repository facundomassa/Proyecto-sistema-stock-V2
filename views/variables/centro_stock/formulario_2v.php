<label for="nombre_cs">Nombre del centro de sotck: *</label>
<input type="text" id="nombre_cs" name="CentrosStock[nombre_cs]" placeholder="Nombre del centro de stock" value="<?php echo s($centrosStock->nombre_cs); ?>">
<label for="remitente_nombre">Nombre del remitente: *</label>
<input type="text" id="remitente_nombre" name="CentrosStock[remitente_nombre]" placeholder="Nombre" value="<?php echo s($centrosStock->remitente_nombre); ?>">
<label for="remitente_apellido">Apellido</label>
<input type="text" id="remitente_apellido" name="CentrosStock[remitente_apellido]" placeholder="Apellido" value="<?php echo s($centrosStock->remitente_apellido); ?>">
<label for="telefono">Telefono</label>
<input type="tel" id="telefono" name="CentrosStock[telefono]" placeholder="Telefono" value="<?php echo s($centrosStock->telefono); ?>">
<label for="pais">Pais</label>
<select name="CentrosStock[pais]" id="pais">
    <?php foreach($paises as $paise) : ?>
    <option value="
        <?php echo s($paise->id_paises); ?>"
        <?php if(s($paise->id_paises) == 13)echo "selected"?>>
        <?php echo s($paise->nombre); ?>
    </option>
    <?php endforeach; ?>
</select>
<label for="provincia">Provincia</label>
<input type="text" id="provincia" name="CentrosStock[provincia]" placeholder="Provincia" value="<?php echo s($centrosStock->provincia); ?>">
<label for="ciudad">Ciudad</label>
<input type="text" id="ciudad" name="CentrosStock[ciudad]" placeholder="Ciudad" value="<?php echo s($centrosStock->ciudad); ?>">
<label for="codigo_postal">Codigo Postal</label>
<input type="text" id="codigo_postal" name="CentrosStock[codigo_postal]" placeholder="Codigo Postal" value="<?php echo s($centrosStock->codigo_postal); ?>">
<label for="direccion">Direccion</label>
<input type="text" id="direccion" name="CentrosStock[direccion]" placeholder="Direccion" value="<?php echo s($centrosStock->direccion); ?>">
<label for="tipo">Tipo</label>
<select name="CentrosStock[tipo_stock_id]" id="tipo">
    <option selected disabled value="">-- Seleccione tipo --</option>
    <?php foreach($tipoCentroStock as $tipoC) : ?>
    <option value="
    <?php echo s($tipoC->id_tipo_centro_stock);?>"
    <?php if(s($tipoC->id_tipo_centro_stock) == $centrosStock->tipo_stock_id)echo "selected"?>>
    <?php echo s($tipoC->tipo); ?></option>
    <?php endforeach; ?>
</select>