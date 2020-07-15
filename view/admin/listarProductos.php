<?php
 ini_set('display_errors', 'On');

 require'../../controler/controlerTemplateAdmin.php';
 require'../../model/conexion.php';
 require'../../model/mdlProducto.php';
 require'../../model/mdlProveedor.php';

 //===========================Paginacion ================================
 require'../../controler/ctrValidarCampos.php';
 
 require'../../model/mdlPaginacion.php';

 require'../../controler/ctrPaginacion.php';
 
 require'modales/editarProducto.php';

//  require'../../controler/crtGenero.php';



// //Creacion del objeto
$plantilla= new controlerPlantillaAdmin();
$plantilla->usuario_autentificado();
$plantilla->ctr_header();
$plantilla->ctr_navegador_Izquierda();
$plantilla->ctr_tabla_productos();
$plantilla->ctr_footer();
?>


