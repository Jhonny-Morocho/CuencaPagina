<?php 

ini_set('display_errors', 'On');

switch (@$_POST['FiltrarVentas']) {

    case 'ListarVentas':
        require'../model/conexion.php';
        require'../model/mdlFactura.php';
        $filtroFechaProductos=ModeloFacura::sqlFiltrarFacturas($_POST['fechaInicio'],$_POST['fechaFin']);
        return die(json_encode($filtroFechaProductos));
        break;

        default:
        # code...
        break;
    }


//  ?>

