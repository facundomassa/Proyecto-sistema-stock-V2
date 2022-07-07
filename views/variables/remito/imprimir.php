<?php 
// use Dompdf\Dompdf;
//     $dompdf = new Dompdf();
    // $dompdf->set_paper("A4");
    
    ob_start(); 
    ?>
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
html {
    font-size: 62.5%;
    box-sizing: border-box;
}
*, *:before, *:after {
    box-sizing: inherit;
}
body {
    font-family: 'Lato', sans-serif;
    font-size: 16px;
    line-height: 1.8;
    size: A4 portrait;
    margin: 2cm;
}
.titulo{
    font-size: 24px;
}
.head-imp{
    font-family: 'Oswald', sans-serif;
    width: 100%;
    vertical-align: middle;
}
.col-md-4{
    display: inline-block;
    vertical-align: middle;
    width: 33.3%;
}
.col-md-6{
    display: inline-block;
    vertical-align: top;
    width: 50%;
}
.col-md-6-m{
    display: inline-block;
    vertical-align: top;
    max-width: 50%;
}
.logo{
    height: 150px;
    width: 150px;
    margin: auto;
}
.datos{
    background-color: aliceblue;
    border: 1px black solid;
    text-align: center;
    padding: 10px;
    width: 150px;
    margin: auto;
}
.datos p{
    margin: 10px 0;
}
.separador{
    margin: auto;
    width: 90%;
}
.separador::after{
    content: " ";
    background-color: rgba(128, 128, 128, 0.5);
    height: 3px;
    border-radius: 5px;
    display: block;
    margin: 10px;
}
.imp-destinos{
    width: 100%;
    line-height: 1;
}
.imp-centros{
    font-family: 'Oswald', sans-serif;
    padding: 0 10px;
    line-height: 1;
}
.imp-centros h2{
    font-size: 20px;
    text-align: left;
    margin: 0;
    line-height: 1;
}
    
.imp-centros p{
    font-size: 16px;
    margin: 0;
    font-weight: bold;
    line-height: 1;
}
.imp-centros span{
    font-weight: lighter;
    font-size: 18px;
    line-height: 1;
}
.footer-imp{
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    margin-bottom: 20px;
}
.firma{
    margin: auto;
    width: 80%;
    text-align: center;
    }
p{
    font-size: 18px;
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
    height: 424px;
    border: 1px solid black;
}
.table{
    border-radius: 0;
    background-color: transparent;
    border: 0;
    width: 100%;
    border-collapse: collapse;
}
.textL{
    text-align: left;
}
.textC{
    text-align: center;
}
.text-derecha{
    text-align: right;
}
tr{
    font-size: 18px;
    height: 20px;
    line-height: 1;
}
thead{
    background-color: lightgray;
    line-height: 1;
    width: 100%;
}
.detalle-imp{
    width: 100%;
    font-family: 'Oswald', sans-serif;
    margin: 0;
}
.detalle-imp p{
    color: gray;
    font-size: 14px;
    margin: 0;
}
            </style>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="http://<?php echo $_SERVER["HTTP_HOST"]?>/build/css/app.css">
            <!-- CSS only -->
            <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
            <!-- boxicons -->
            <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
            <!-- google fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">
            <title>IMPRIMIR</title>
        </head>
        <body style="margin: auto;">
            <headind class="row head-imp">
                <div class="col-md-4">
                    <img class="logo" height="150px" width="150px" src="http://<?php echo $_SERVER["HTTP_HOST"] ?>/build/img/logo-cripto.jpg" alt="">
                </div><div class="col-md-4">
                    <h1 class="titulo">REMITO DE MATERIALES</h1>
                </div><div class="col-md-4">
                    <div class="datos">
                        <p>N° REMITO: 000016</p>
                        <p>Fecha: 9/4/2022</p>
                    </div>
                </div>
                
            </headind>
            <div class="separador"></div>
            <div class="imp-destinos">
                <div class="imp-centros col-md-6-m">
                    <h2>Origen</h2>
                    <p>Direccion: <span><?php echo $Origen->direccion;?></span></p>
                </div><div class="imp-centros col-md-6-m">
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
            <div class="detalle-imp ">
                <div class="col-md-6">
                    <p>Cantidad materiales: ____________________</p>
                </div><div class="col-md-6 text-derecha">
                    <p style="text-align: end;">Valor aprox: ____________________</p>
                </div>
            </div>
            <footer class="footer-imp">
                <div class="col-md-4">
                    <div class="firma">
                        <p>Despacho</p>
                    </div>
                </div><div class="col-md-4">
                    <div class="firma">
                        <p>Tranportista</p>
                    </div>
                </div><div class="col-md-4">
                    <div class="firma">
                        <p>Destinatario</p>
                    </div>
                </div>
            </footer>
            
        </body>
    </html>


    <?php
    $html = ob_get_clean();

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $options = new Options();
    // $options->setIsRemoteEnabled(true);
    $options->set(array("isPhpEnabled" => true));
    // $options->set(array("isHtml5ParserEnabled" => true));
    // $options->set(array("isFontSubsettingEnabled" => true));
    // $options->set(array("debugPng" => true));
    // debuguear($options);
    // debuguear($options);

    $dompdf = new Dompdf($options);
    
    $dompdf->set_paper("A4");
    
    $dompdf->loadHtml($html);

    
    // $dompdf->set_paper("A4", "landscape");

    $dompdf->render();
    // header("Content-type: application/pdf");
    // header("Content-Disposition: inline; filename=documento.pdf");
    // echo $dompdf->output();
    $dompdf->stream("archivo.pdf", array("Attachment" => false));

    
?>
