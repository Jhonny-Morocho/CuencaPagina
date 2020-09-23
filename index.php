
<?php

ini_set('display_errors', 'On');
session_start();
require'model/conexion.php';
require'model/mdlProveedor.php';
require'model/mdlGenero.php';
require'model/mdlClienteProducto.php';
//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================
//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
$plantilla->ctr_slider();
$plantilla->ctr_tabla_productos();
$plantilla->sliderLogosDj();
$plantilla->reproductorAudio();
$plantilla->ctr_footer();
$plantilla->toTop();

?>
