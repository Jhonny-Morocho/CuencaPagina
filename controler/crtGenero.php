<?php 
ini_set('display_errors', 'On');


require'../model/conexion.php';
require'../model/mdlGenero.php';


switch (@$_POST['Genero']) {
    case 'addgenero':
        $genero=ModeloGenero::sql_agregar_genero(@$_POST['inputNombreGenero']);
        die(json_encode($genero));
        break;

        case 'edit':
            $genero=ModeloGenero::sql_editar_genero(@$_POST['idGenero'],@$_POST['inputNombreGenero']);
            die(json_encode($genero));
            break;
        case 'delet':
            $genero=ModeloGenero::sql_eliminar_genero(@$_POST['idGenero']);
            die(json_encode($genero));
            break;
    
    default:
        # code...
        break;
}

?>