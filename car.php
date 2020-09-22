
<?php

ini_set('display_errors', 'On');


session_start();
require'model/conexion.php';

require'model/mdlProveedor.php';

//=============================creacion de objetos==========================
//=============================creacion de objetos==========================

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
$plantilla->ctr_slider();
$plantilla->ctr_tabla_carritoCompras();
$plantilla->ctr_footer();

?>