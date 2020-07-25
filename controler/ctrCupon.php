<?php 
ini_set('display_errors', 'On');


require'../model/conexion.php';
require'../model/mdlCupon.php';

//die(json_encode($_POST));
//die(json_encode($_POST));
switch (@$_POST['Cupon']) {


    case 'editarCupon':
        $respuesta=ModeloCupon::sqlEditarCupon(@$_POST);
        die(json_encode($respuesta));
        break;
            break;

    case 'listar':
        $respuesta=ModeloCupon::sqlListarCupon();
        die(json_encode($respuesta));
        break;
            break;
    
    default:
        # code...
        break;
}

//================================Buscador y paginacion =========================================//


?>