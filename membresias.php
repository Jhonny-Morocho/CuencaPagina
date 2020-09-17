<!-- Button trigger modal-->

<?php

ini_set('display_errors', 'On');
session_start();
require'model/conexion.php';
require'model/mdlProveedor.php';
require'model/mdlGenero.php';
require'model/mdlMembresias.php';

//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================
//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
// $plantilla->listaMembresia();
// $plantilla->redesSociales();
$plantilla->ctr_footer();
$plantilla->toTop();


?>

<style>


.tabla:hover {
    background: #35619e;
    color: #f1f1f2;
    transition: .5s all;
    transform: scale(1.1);
    cursor: pointer;
}
</style>
