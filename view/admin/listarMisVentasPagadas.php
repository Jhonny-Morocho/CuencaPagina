<?php
 ini_set('display_errors', 'On');

 require'../../controler/controlerTemplateAdmin.php';
 require'../../model/conexion.php';
 require'../../model/mdlCliente.php';
 require'../../model/mdlClienteProducto.php';
 require'../../model/mdlFactura.php';



// //Creacion del objeto
$plantilla= new controlerPlantillaAdmin();
$plantilla->usuario_autentificado();
$plantilla->ctr_header();
$plantilla->ctr_navegador_Izquierda();
$plantilla->ctrTablaMisVentasPagadas();
$plantilla->ctr_footer();
?>

