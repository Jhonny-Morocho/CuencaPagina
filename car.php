
<?php

ini_set('display_errors', 'On');


session_start();
require'model/conexion.php';
require'view/cliente/formularioCliente.php';
//require'Modelo/class_mdl_cliente_producto.php';
//require'Modelo/class_mdl_producto.php';




//include'Controlador/class_ctr_update.php';
//include'Controlador/class_ctr_proveedor.php';
//include'Controlador/class_ctr_producto.php';
//include'Controlador/class_ctr_cliente_producto.php';
//include'Controlador/class_ctr_biblioteca.php';



//=============================creacion de objetos==========================
//=============================creacion de objetos==========================

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
//$biblioetca= new CtrBiblioteca();

//$plantilla->usuario_autentificado();
//$plantilla->cerrar_session(@$_GET['cerrar_session']);//aqui cierro la session
$plantilla->ctr_header();
$plantilla->ctr_slider();
// $plantilla->ctr_categorias();
// $plantilla->ctr_lista_update();
$plantilla->ctr_tabla_carritoCompras();
$plantilla->ctr_footer();
// $plantilla->wassap();
// $plantilla->contadorOferta();




?>