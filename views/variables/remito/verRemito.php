<!-- <button type="button" id="remito" data-id="<?php echo $_GET['id'] ?>" class="btn btn-remito selected">REMITO</button>
<button type="button" id="materiales" data-id="<?php echo $_GET['id'] ?>" class="btn btn-remito">MATERIALES</button> -->
<a class="btn btn-remito selected" href="/Remito/ver?id=<?php echo $Remito->id_remito ?>&R=REM">REMITO</a>
<a class="btn btn-remito" href="/Remito/ver?id=<?php echo $Remito->id_remito ?>&R=MAT">MATERIALES</a>
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
<div class="linea-butons">
<?php 

    if($Estado->estado != "FINALIZADO"){ ?>
    
        <a class="btns btn-verde" href="/Remito/actualizar?id=<?php echo $Remito->id_remito ?>">Modificar Orden</a>
        <form action="/Stock/FinalizarOrden" method="post">
            <input type="hidden" name="id" value="<?php echo $Remito->id_remito ?>">
            <input class="btns btn-verde" type="submit" value="Finalizar Orden">
        </form>
    
    <?php }
?>
<button class="btns btn-verde"><i class='bx bx-printer'></i></button>
</div>
<iframe src="http://www.localhost:3000/Imprimir?id=<?php echo $Remito->id_remito ?>" frameborder="0"></iframe>