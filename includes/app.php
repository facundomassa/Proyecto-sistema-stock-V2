<?php
use Dompdf\Dompdf;

require "funciones.php";
require "config/database.php";
require __DIR__ . "../../vendor/autoload.php";
require_once  __DIR__ . '../../vendor/dompdf/autoload.inc.php';

$bd = conectarBD();

use Model\ActiveRecord;

ActiveRecord::setBD($bd);

?>