
<?php

ini_set('display_errors', 'On');

require'model/conexion.php';
require'model/mdlProveedor.php';
require'model/mdlCliente.php';
require'model/mdlClienteProducto.php';
require'model/mdlFactura.php';
require'model/mdlGenero.php';

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->usuario_autentificado();;
$plantilla->cerrar_session(@$_GET['cerrar_session']);//aqui cierro la session
$plantilla->ctr_header();
$plantilla->formLoginCliente();
$plantilla->ctr_slider();
$plantilla->panelCliente();
$plantilla->ctr_footer();

?>


