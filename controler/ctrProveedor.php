<?php 
ini_set('display_errors', 'On');


require'../model/conexion.php';
require'../model/mdlProveedor.php';


switch (@$_POST['Proveedor']) {


    case 'addProveedor':

        //1.Verificar si el archivo del logo existe, 
            //si existe no deja guardar el registro
            //si no existe entonces si deja guardar
        $nombre_fichero = "../img/proveedores/".$_FILES['fileLogoDj']['name'];

        if (file_exists($nombre_fichero)) {
            //si existe debe cambiarle el nombre del archivo
            $respuesta=array('respuesta'=>'existeArchivo');
            
        } else {
            
            //$respuesta= array('archivo'=>'noExiste');
            //si no existe entonces si puede guardar
            $respuesta=ModeloProveedor::sql__agrgar_proveedor(@$_POST);
        }

     
        die(json_encode($respuesta));
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