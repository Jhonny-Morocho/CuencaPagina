
<?php

ini_set('display_errors', 'On');


session_start();
require'model/conexion.php';

require'model/mdlProveedor.php';
//require'Modelo/class_mdl_producto.php';

require'model/mdlGenero.php';



//include'Controlador/class_ctr_update.php';
//include'Controlador/class_ctr_proveedor.php';
//include'Controlador/class_ctr_producto.php';
//include'Controlador/class_ctr_cliente_producto.php';
//include'Controlador/class_ctr_biblioteca.php';



//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================
//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
//$biblioetca= new CtrBiblioteca();

//$plantilla->usuario_autentificado();
//$plantilla->cerrar_session(@$_GET['cerrar_session']);//aqui cierro la session
$plantilla->ctr_header();

$plantilla->formLoginCliente();


$plantilla->ctr_slider();
$plantilla->reproductorAudio();
// $plantilla->ctr_lista_update();
$plantilla->ctr_tabla_productos();
$plantilla->ctr_footer();
// $plantilla->wassap();
// $plantilla->contadorOferta();




?>

