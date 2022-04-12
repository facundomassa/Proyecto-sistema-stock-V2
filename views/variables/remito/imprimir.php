<?php 
// use Dompdf\Dompdf;
//     $dompdf = new Dompdf();
//     $dompdf->set_paper("A4");
    ob_start(); ?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <style>
                /* body {
                    height:297mm; 
                    width:210mm; 
                    margin-left:auto; 
                    margin-right:auto; 
                    border: 1px black solid;
                    padding: 3rem;
                    position: relative;
                } */
.head-imp{
    font-family: 'Oswald', sans-serif;
    display: inline-block;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}
.titulo{
    width: 33%;
}
.logo{
    height: 150px;
    width: 150px;
}
.datos{
    background-color: aliceblue;
    border: 1px black solid;
    text-align: center;
    padding: 1rem;
    width: 33%;
}
.datos p{
    margin: 1rem 0;
}
.separador{
    width: 100%;
}
.separador::after{
    content: " ";
    background-color: rgba(128, 128, 128, 0.5);
    height: 3px;
    border-radius: .5rem;
    display: block;
    margin: 1rem;
}
.imp-destinos{
    display: flex;
    line-height: 1;
}
.imp-centros{
    font-family: 'Oswald', sans-serif;
    margin: 0 1rem;
}
.imp-centros h2{
    font-size: 20px;
    text-align: left;
    margin: 0;
}
    
.imp-centros p{
    font-size: 1.6rem;
    margin: 0;
    font-weight: bold;
}
.imp-centros span{
    font-weight: lighter;
    font-size: 1.8rem;
}
.footer-imp{
    display: flex;
    justify-content: space-around;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    margin-bottom: 5rem;
}
.firma{
    width: 20%;
    text-align: center;
    }
p{
    font-size: 1.8rem;
    line-height: 1.5;
    margin: 0;
}
.firma::before{
    content: " ";
    height: 1px;
    width: 100%;
    background-color: gray;
    display: block;
}
.tabla-cont{
    height: 59rem;
    border: 1px solid black;
}
.table{
    border-radius: 0;
    background-color: transparent;
    border: 0;
}
tr{
    line-height: 1;
}
thead{
    background-color: lightgray;
    line-height: 1;
}
.detalle-imp{
    font-family: 'Oswald', sans-serif;
    display: flex;
    margin: 0;
    justify-content: space-between;
}
.detalle-imp p{
    color: gray;
    font-size: 1.6rem;
    margin: 1rem 2rem;
}
            </style>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="http://<?php echo $_SERVER["HTTP_HOST"]?>/Proyecto-sistema-stock-V2/build/css/app.css">
            <!-- boxicons -->
            <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
            <!-- google fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">
            <title>IMPRIMIR</title>
        </head>
        <body style="margin: auto;">
            <headind class="head-imp">
                <img class="logo" src="http://<?php echo $_SERVER["HTTP_HOST"]?>/build/img/logo-cripto.webp" alt="">
                <h1 class="titulo">REMITO DE MATERIALES</h1>
                <div class="datos">
                    <p>N° REMITO: 000016</p>
                    <p>Fecha: 9/4/2022</p>
                </div>
            </headind>
            <div class="separador"></div>
            <div class="imp-destinos">
                <div class="imp-centros">
                    <h2>Origen</h2>
                    <p>Direccion: <span><?php echo $Origen->direccion;?></span></p>
                </div>
                <div class="imp-centros">
                    <h2>Destinatario</h2>
                    <p>Destinatario: <span><?php echo $Destino->remitente_nombre . " " . $Destino->remitente_apellido;?></span></p>
                    <p>Telefono: <span><?php echo $Destino->telefono;?></span></p>
                    <p>Direccion: <span><?php echo $Destino->direccion . ", " . $Destino->ciudad . ", " . $Destino->provincia . ", CP(" . $Destino->codigo_postal . ")";?></span></p>
                </div>
            </div>
            <div class="separador"></div>
            <div class="tabla-cont">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="textL">COD. MATERIAL</th>
                            <th class="textL">MATERIAL</th>
                            <th class="textL">UNIDADES</th>
                            <th>CANTIDAD</th>
                        </tr> 
                    </thead>
                    <tbody class="tabla-cuerpo">
                        <?php foreach($MovimientoMateriales as $Movimiento){ ?>
                            <tr>
                                <td class="width-3"><?php echo $Movimiento->Materiales->codigo ?></td>
                                <td class="width-4"><?php echo $Movimiento->Materiales->descripcion ?></td>
                                <td class="width-1"><?php echo $Movimiento->Unidades->unidad ?></td>
                                <td class="width-2 textC"><?php echo $Movimiento->cantidad ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
            </div>
            <div class="detalle-imp">
                <p>Cantidad materiales: ____________________</p>
                <p>Valor aprox: ____________________</p>
            </div>
            <footer class="footer-imp">
                <div class="firma">
                    <p>Despacho</p>
                </div>
                <div class="firma">
                    <p>Tranportista</p>
                </div>
                <div class="firma">
                    <p>Destinatario</p>
                </div>
            </footer>
            
        </body>
    </html>


    <?php
    $html = ob_get_clean();

    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    

    $options = $dompdf->getOptions();
    $options->set(array("isRemoteEnabled" => true));
    $options->set(array("isPhpEnabled" => true));
    $options->set(array("isHtml5ParserEnabled" => true));
    $options->set(array("isFontSubsettingEnabled" => true));
    $options->set(array("debugPng" => true));
    // debuguear($options);
    $dompdf->setOptions($options);
    
    $dompdf->loadHtml($html);

    $dompdf->set_paper("A4", "landscape");

    $dompdf->render();
    // header("Content-type: application/pdf");
    // header("Content-Disposition: inline; filename=documento.pdf");
    // echo $dompdf->output();
    $dompdf->stream("archivo.pdf", array("Attachment" => false));
?>
