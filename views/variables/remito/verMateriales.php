<!-- <button type="button" id="remito" data-id="<?php echo $_GET['id'] ?>" class="btn btn-remito selected">REMITO</button>
<button type="button" id="materiales" data-id="<?php echo $_GET['id'] ?>" class="btn btn-remito">MATERIALES</button> -->
<a class="btn btn-remito" href="/Remito/ver?id=<?php echo $Remito->id_remito ?>&R=REM">REMITO</a>
<a class="btn btn-remito selected" href="/Remito/ver?id=<?php echo $Remito->id_remito ?>&R=MAT">MATERIALES</a>
<section class="contenido-remito">
    <table class="table">
        <thead>
            <tr>
                <th>COD. MATERIAL</th>
                <th>MATERIAL</th>
                <th>CANTIDAD</th>
                <th>ACCIONES</th>
            </tr> 
        </thead>
        <tbody class="tabla-cuerpo">
            <?php foreach($MovimientoMateriales as $Movimiento){ ?>
                <tr>
                    <td><?php echo $Movimiento->Materiales->codigo ?></td>
                    <td><?php echo $Movimiento->Materiales->descripcion ?></td>
                    <td><?php echo $Movimiento->cantidad ?></td>
                    <td>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>   
</section>
<div class="linea-butons">
<?php 
    if($Estado->estado != "FINALIZADO"){ ?>

        <a class="btns btn-verde" href="/MovimientoMateriales/Crear?id=<?php echo $Remito->id_remito ?>">Modificar Materiales</a>
        <form action="/Stock/FinalizarOrden" method="post">
            <input type="hidden" name="id" value="<?php echo $Remito->id_remito ?>">
            <input class="btns btn-verde" type="submit" value="Finalizar Orden">
        </form>
    
    <?php }
?>
<button class="btns btn-verde"><i class='bx bx-printer'></i></button>
</div>

<div class="cont-mayor">
    <div class="conta-imp">
        <iframe class="contenido-imprimir" src="http://www.localhost:3000/Imprimir?id=<?php echo $Remito->id_remito ?>" frameborder="0"></iframe>
    </div>
</div>