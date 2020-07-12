
<?php

ini_set('display_errors', 'On');

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
//$biblioetca= new CtrBiblioteca();

//$plantilla->usuario_autentificado();
//$plantilla->cerrar_session(@$_GET['cerrar_session']);//aqui cierro la session
$plantilla->ctr_header();
$plantilla->ctr_slider();
// $plantilla->ctr_categorias();
// $plantilla->ctr_lista_update();
$plantilla->panelCliente();
$plantilla->ctr_footer();
// $plantilla->wassap();
// $plantilla->contadorOferta();

?>


