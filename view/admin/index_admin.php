<?php
ini_set('display_errors', 'On');

require'../../controler/controlerTemplateAdmin.php';

require'../../model/conexion.php';
require'../../model/mdlGenero.php';
//require'modales/editarGenero.php';



//Creacion del objeto
$plantilla= new controlerPlantillaAdmin();
$plantilla->usuario_autentificado();
$plantilla->cerrar_session(@$_GET['cerrar_session']);//aqui cieero la session
$plantilla->ctr_header();
$plantilla->ctr_navegador_Izquierda();
$plantilla->ctr_footer();
?>
