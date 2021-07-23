<?php

//template de la pagina 
require'model/conexion.php';
require'model/mdlCarrusel.php';
require'model/mdlProveedor.php';
require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
?>

<div class="container  d-flex justify-content-center " style="margin-top: 100px;">
      <div class="row contenedorInicial">
            <div class="col-md-12 order-md-1">
                <?php if($_GET ["estado"]!='true'): ?>
                <div class="container d-flex justify-content-center">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 100px;"></i>
                </div>
                <div class="alert alert-warning mt-5" role="alert">
                  Error en el pago: <?= $_GET ["estado"] ?>
                </div>
                <?php else: ?>
                <div class="container d-flex justify-content-center">
                    <i class="fas fa-check-circle" style="font-size: 100px; color: #00c851;"></i>
                </div>
                <div class="alert alert-success mt-5" role="alert">
                  Pago completado con éxito. Su factura de compra fue enviada a su correo.
                </div>
                
                  <a  href="../../adminCliente.php" class="d-flex justify-content-center mb-3 enlaceDescarga" >
                    <span><i class="fas fa-cloud-download-alt mr-2"></i></span> <span>Ir a Descargar mis productos</span>
                  </a>
                <?php endif; ?>
            </div>    
          </div>
        </div>
      </div>

    <!--Big blue-->
    <div class="preloader-wrapper big  crazy container d-flex justify-content-center ">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div>
        <div class="gap-patch">
          <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>

<?php
     $plantilla->ctr_footer();
?>

<?php 
if($_GET["estado"]=='true') {
  echo '<script src="../../controler/js/enviarDataFactura.js?v=1.0.0"></script>';
}
?>

