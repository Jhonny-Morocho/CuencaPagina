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
       
        require'../model/conexion.php';
        require'../model/mdlClienteProducto.php';
    
        print_r($_POST['idProductos']);
         for ($i=0; $i < count(($_POST['idProductos'])); $i++) { 
           
             ModeloClienteProducto::editarClienteProductoEstadoPagoProveedor($_POST['idProductos'][$i],1);
         }

        return die(json_encode(($_POST)));
        break;


        case 'CambiarEstadoNoPagado':
            
            require'../model/conexion.php';
            require'../model/mdlClienteProducto.php';
        
            print_r($_POST['idProductos']);
             for ($i=0; $i < count(($_POST['idProductos'])); $i++) { 
               
                 ModeloClienteProducto::editarClienteProductoEstadoPagoProveedor($_POST['idProductos'][$i],0);
             }
    
            return die(json_encode(($_POST)));
            break;
    
        case 'GenerarPdf':

             require_once'../generarReportePdf/vendor/autoload.php';
             require_once'../generarReportePdf/plantillaReporte/plantilla.php';
             $css=file_get_contents('../generarReportePdf/plantillaReporte/style.css');
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML(ClassPlantilla::funcionPlantilla($_POST['nombrePista'],$_POST['fechaCompra'],$_POST['precioCompra'],$_POST['metodoCompra'],$_POST['nombreDj'],$_POST['subTotal'],$_POST['comision']),\Mpdf\HTMLParserMode::HTML_BODY);
            $mpdf->Output();

            break;
    
    default:
        # code...
        break;
}

//  ?>

