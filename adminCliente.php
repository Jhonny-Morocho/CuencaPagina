
<?php

ini_set('display_errors', 'On');

require'model/conexion.php';
require'model/mdlProveedor.php';
require'model/mdlCliente.php';
require'model/mdlClienteProducto.php';
require'model/mdlFactura.php';
require'model/mdlGenero.php';
//membresias
require'model/mdlClienteMembresia.php';

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
$plantilla->panelCliente();
$plantilla->ctr_footer();
$plantilla->toTop();
?>

