<h1>Crear</h1>
<?php foreach ($errores as $error) : ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
<?php endforeach; ?>
<form method="post">
    <div class="contenido-remito">
        <div class="content">
            <p>Numero de remito: <span><?php echo $NumeroRemitoFinal ?></span></p>
        </div>
        <div class="content" >
            <label for="origen_id">Origen: </label>
            <select name="Remito[origen_id]" id="origen_id">
            <option selected disabled value="">-- Seleccione origen --</option>
                <?php foreach($centrosStock as $centroStock) : ?>
                <option value="<?php echo s($centroStock->id_centros_stock);?>"
                <?php if(s($centroStock->id_centros_stock) == $remito->origen_id)echo "selected"?>>
                <?php echo s($centroStock->nombre_cs); ?></option>
                <?php endforeach; ?>
            </select>
            <p>Tipo de Stock: <span id="origen_ti"></span></p>
            <p>Nombre Remitente: <span id="origen_no"></span></p>
            <p>Telefono: <span id="origen_te"></span></p>
            <p>Provincia: <span id="origen_pr"></span></p>
            <p>Ciudad: <span id="origen_ci"></span></p>
            <p>Direccion: <span id="origen_di"></span></p>
        </div>
        <div class="content">
            <label for="destino_id">Destino: </label>
            <select name="Remito[destino_id]" id="destino_id">
            <option selected disabled value="">-- Seleccione destino --</option>
                <?php foreach($centrosStock as $centroStock) : ?>
                <option value="<?php echo s($centroStock->id_centros_stock);?>"
                <?php if(s($centroStock->id_centros_stock) == $remito->destino_id)echo "selected"?>>
                <?php echo s($centroStock->nombre_cs); ?></option>
                <?php endforeach; ?>
            </select>
            <p>Tipo de Stock: <span id="destino_ti"></span></p>
            <p>Nombre Remitente: <span id="destino_no"></span></p>
            <p>Telefono: <span id="destino_te"></span></p>
            <p>Provincia: <span id="destino_pr"></span></p>
            <p>Ciudad: <span id="destino_ci"></span></p>
            <p>Direccion: <span id="destino_di"></span></p>
        </div>
        <div class="content">
            <label for="fecha_creacion">Fecha de creaccion: </label>
            <input type="date" name="Remito[fecha_creacion]" id="fecha_creacion" value="<?php echo $remito->fecha_finalizado ?  $remito->fecha_finalizado : date('Y-m-d');?>">
            <label for="fecha_finalizado">Fecha de finalizacion: </label>
            <input type="date" name="Remito[fecha_finalizado]" id="fecha_finalizado" value="<?php echo $remito->fecha_finalizado;?>">
        </div>
        <div class="content">
            <label for="estado_id">Estado: </label>
            <select name="Remito[estado_id]" id="estado_id">
            <option selected disabled value="">-- Seleccione tipo --</option>
                <?php foreach($estados as $estado) : ?>
                <option value="<?php echo s($estado->id_estados);?>"
                <?php if(s($estado->estado) == " INGRESADO ")echo "selected"?>>
                <?php echo s($estado->estado); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="Remito[creado_por_id]" value="<?php echo 1?>">
    <input type="submit" value="Crear Remito">
</form>