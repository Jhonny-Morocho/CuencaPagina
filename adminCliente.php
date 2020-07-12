
<?php

ini_set('display_errors', 'On');

require'model/conexion.php';
require'view/cliente/formularioCliente.php';
require'model/mdlCliente.php';
require'model/mdlClienteProducto.php';
require'model/mdlFactura.php';


require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
//$biblioetca= new CtrBiblioteca();

$plantilla->usuario_autentificado();
//print_r($_SESSION);
$plantilla->cerrar_session(@$_GET['cerrar_session']);//aqui cierro la session
$plantilla->ctr_header();
$plantilla->ctr_slider();
// $plantilla->ctr_categorias();
// $plantilla->ctr_lista_update();
$plantilla->panelCliente();
$plantilla->ctr_footer();
// $plantilla->wassap();
// $plantilla->contadorOferta();

?>


