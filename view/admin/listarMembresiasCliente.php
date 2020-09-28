<?php

ini_set('display_errors', 'On');

require'../../model/conexion.php';
require'../../model/mdlClienteMembresia.php';

//inicio la session
require'../../controler/controlerTemplateAdmin.php';

//=============================creacion de objetos==========================

  // //Creacion del objeto
$plantilla= new controlerPlantillaAdmin();
$plantilla->usuario_autentificado();
$plantilla->ctr_header();
$plantilla->ctr_navegador_Izquierda();
$plantilla->tablaMembresiasCliente();
//require'modales/editarMembresia.php';
$plantilla->ctr_footer();
$plantilla->toTop();
