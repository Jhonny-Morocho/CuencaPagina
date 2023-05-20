<?php 

ini_set('display_errors', 'On');

switch (@$_POST['FiltroPagoProveedor']) {

    case 'FiltrarFechas':
        require'../model/conexion.php';
        require'../model/mdlClienteProducto.php';
        $idProveedor=$_POST['idProveedor'];
        $fechaIncio=$_POST['fechaInicio'];
        $fechaFin=$_POST['fechaFin'];
        $filtroFechaProductos=ModeloClienteProducto::sqlListarProductosVendidosProveedorFiltroFecha($idProveedor,$fechaIncio,$fechaFin);
        
        return die(json_encode($filtroFechaProductos));
    case 'CambiarEstadoPagado':
       
        require'../model/conexion.php';
        require'../model/mdlClienteProducto.php';
    

         for ($i=0; $i < count(($_POST['idProductos'])); $i++) { 
           
             ModeloClienteProducto::editarClienteProductoEstadoPagoProveedor($_POST['idProductos'][$i],1);
         }

        return die(json_encode(($_POST)));


        case 'CambiarEstadoNoPagado':
            
            require'../model/conexion.php';
            require'../model/mdlClienteProducto.php';
        
     
             for ($i=0; $i < count(($_POST['idProductos'])); $i++) { 
               
                 ModeloClienteProducto::editarClienteProductoEstadoPagoProveedor($_POST['idProductos'][$i],0);
             }
    
            return die(json_encode(($_POST)));
    
        // case 'GenerarPdf':
        //     echo "soy el filtrro";
        //     die(json_encode($_POST));
        //      require_once'../generarReportePdf/vendor/autoload.php';
        //      require_once'../generarReportePdf/plantillaReporte/plantilla.php';
        //      $css=file_get_contents('../generarReportePdf/plantillaReporte/style.css');
        //     $mpdf = new \Mpdf\Mpdf();
        //     $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
        //     $mpdf->WriteHTML(ClassPlantilla::funcionPlantilla($_POST['nombrePista'],$_POST['fechaCompra'],$_POST['precioCompra'],$_POST['metodoCompra'],$_POST['nombreDj'],$_POST['subTotal'],$_POST['comision']),\Mpdf\HTMLParserMode::HTML_BODY);
        //     $mpdf->Output();

        //     break;
    
    default:
        # code...
        return;
}

// ================== GENERAR REPORTE MEDIANTE USO DE MTODO GET ==================

switch (@$_GET['FiltroPagoProveedor']) {
    case 'GenerarPdf':
      
        require'../model/conexion.php';
        require'../model/mdlClienteProducto.php';
        require_once'../generarReportePdf/vendor/autoload.php';
        require_once'../generarReportePdf/plantillaReporte/plantilla.php';
        $css=file_get_contents('../generarReportePdf/plantillaReporte/style.css');
       // print_r($_GET);
        $filtroFechaProductos=ModeloClienteProducto::sqlListarProductosVendidosProveedorFiltroFecha($_GET['idProveedor'],$_GET['fechaInicio'],$_GET['FechaFin']);
       // die(json_encode($filtroFechaProductos));
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML(ClassPlantilla::funcionPlantilla($filtroFechaProductos,$_GET['nombreProveedor'],$_GET['comision']),\Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output();


        return;
    }

//  ?>

