<?php 

ini_set('display_errors', 'On');

switch (@$_POST['FiltroPagoProveedor']) {

    case 'FiltrarFechas':
        require'../model/conexion.php';
        require'../model/mdlClienteProducto.php';
        $filtroFechaProductos=ModeloClienteProducto::sqlListarProductosVendidosProveedorFiltroFecha($_POST['idProveedor'],$_POST['fechaInicio'],$_POST['fechaFin']);
        return die(json_encode($filtroFechaProductos));
        break;
    case 'CambiarEstadoPagado':
        echo "xxxx";
        require'../model/conexion.php';
        require'../model/mdlClienteProducto.php';
    
        print_r($_POST['idProductos']);
         for ($i=0; $i < count(($_POST['idProductos'])); $i++) { 
           
             ModeloClienteProducto::editarClienteProductoEstadoPagoProveedor($_POST['idProductos'][$i]);
         }

        return die(json_encode(($_POST)));
        break;
    
    default:
        # code...
        break;
}

//  ?>

   