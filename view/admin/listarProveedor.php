<?php
 ini_set('display_errors', 'On');

 require'../../controler/controlerTemplateAdmin.php';
 require'../../model/conexion.php';
 require'../../model/mdlProveedor.php';

 require'modales/editarProveedor.php';
 require'modales/editarProveedorImg.php';




// //Creacion del objeto
$plantilla= new controlerPlantillaAdmin();
$plantilla->usuario_autentificado();
$plantilla->ctr_header();
$plantilla->ctr_navegador_Izquierda();
$plantilla->ctr_tabla_proveedor();
$plantilla->ctr_footer();
?>


