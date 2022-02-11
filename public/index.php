<?php

require_once __DIR__ . "/../includes/app.php";

use Control\TipoCentroStockControl;
use Control\UnidadesControl;
use Control\TipoMaterialControl;
use Control\EstadosControl;
use Control\CentroStockControl;
use MVC\Router;


$router = new Router();

$router->get("/TipoCentroStock", [TipoCentroStockControl::class, "leer"]);
$router->get("/TipoCentroStock/crear", [TipoCentroStockControl::class, "crear"]);
$router->post("/TipoCentroStock/crear", [TipoCentroStockControl::class, "crear"]);
$router->get("/TipoCentroStock/actualizar", [TipoCentroStockControl::class, "actualizar"]);
$router->post("/TipoCentroStock/actualizar", [TipoCentroStockControl::class, "actualizar"]);
$router->post("/TipoCentroStock/eliminar", [TipoCentroStockControl::class, "eliminar"]);

$router->get("/Estados", [EstadosControl::class, "leer"]);
$router->get("/Estados/crear", [EstadosControl::class, "crear"]);
$router->post("/Estados/crear", [EstadosControl::class, "crear"]);
$router->get("/Estados/actualizar", [EstadosControl::class, "actualizar"]);
$router->post("/Estados/actualizar", [EstadosControl::class, "actualizar"]);
$router->post("/Estados/eliminar", [EstadosControl::class, "eliminar"]);

$router->get("/Unidades", [UnidadesControl::class, "leer"]);
$router->get("/Unidades/crear", [UnidadesControl::class, "crear"]);
$router->post("/Unidades/crear", [UnidadesControl::class, "crear"]);
$router->get("/Unidades/actualizar", [UnidadesControl::class, "actualizar"]);
$router->post("/Unidades/actualizar", [UnidadesControl::class, "actualizar"]);
$router->post("/Unidades/eliminar", [UnidadesControl::class, "eliminar"]);

$router->get("/TipoMaterial", [TipoMaterialControl::class, "leer"]);
$router->get("/TipoMaterial/crear", [TipoMaterialControl::class, "crear"]);
$router->post("/TipoMaterial/crear", [TipoMaterialControl::class, "crear"]);
$router->get("/TipoMaterial/actualizar", [TipoMaterialControl::class, "actualizar"]);
$router->post("/TipoMaterial/actualizar", [TipoMaterialControl::class, "actualizar"]);
$router->post("/TipoMaterial/eliminar", [TipoMaterialControl::class, "eliminar"]);

$router->get("/CentroStock", [CentroStockControl::class, "leer"]);
$router->get("/CentroStock/crear", [CentroStockControl::class, "crear"]);
$router->post("/CentroStock/crear", [CentroStockControl::class, "crear"]);
$router->get("/CentroStock/actualizar", [CentroStockControl::class, "actualizar"]);
$router->post("/CentroStock/actualizar", [CentroStockControl::class, "actualizar"]);
$router->post("/CentroStock/eliminar", [CentroStockControl::class, "eliminar"]);

$router->comprobarRutas();

?>