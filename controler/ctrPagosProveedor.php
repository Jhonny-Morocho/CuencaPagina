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
           
             ModeloClienteProducto::editarClienteProductoEstadoPagoProveedor($_POST['idProductos'][$i],1);
         }

        return die(json_encode(($_POST)));
        break;

        case 'GenerarPdf':

             require_once'../generarReportePdf/vendor/autoload.php';
             require_once'../generarReportePdf/plantillaReporte/plantilla.php';
             $css=file_get_contents('../generarReportePdf/plantillaReporte/style.css');
            
             $mpdf = new \Mpdf\Mpdf();
             $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
             $mpdf->WriteHTML(ClassPlantilla::funcionPlantilla($nombreProducto,$fechaCompra,$precioVenta,$metodoPago),\Mpdf\HTMLParserMode::HTML_BODY);
             $mpdf->Output();
            die(json_encode($_POST));

            //return die(json_encode($_POST));
            break;
    
    default:
        # code...
        break;
}

//  ?>

   