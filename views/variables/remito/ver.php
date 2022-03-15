<button type="button" id="remito" data-id="<?php echo $_GET['id'] ?>" class="btn btn-remito selected">REMITO</button>
<button type="button" id="materiales" data-id="<?php echo $_GET['id'] ?>" class="btn btn-remito">MATERIALES</button>
<section class="contenido-remito">
    <div class="content">
        <p>Numero de remito: <span><?php echo $Remito->id_remito ?></span></p>
    </div>
    <div class="content">
        <p>Origen: <span><?php echo $Origen->nombre_cs;?></span></p>
        <p>Direccion: </span><?php echo $Origen->direccion;?></span></p>
    </div>
    <div class="content">
        <p>Destino: <span><?php echo $Destino->nombre_cs;?></span></span></p>
        <p>Direccion: </span><?php echo $Destino->direccion;?></span></p>
    </div>
    <div class="content">
        <p>Fecha de creaccion: <span><?php echo $Remito->fecha_creacion ?></span></p>
        <p>Fecha de finalizado: <span><?php echo $Remito->fecha_finalizado ?></span></p>
        <p>Creado por: <span><?php echo $Usuarios;?></span></p>
    </div>
    <div class="content">
        <p>Estado del remito: <span><?php echo $Estado->estado;?></span></p>
    </div>
    
</section>
