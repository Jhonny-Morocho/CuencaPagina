<?php
//codigo del establecimiento
session_start();

//template de la pagina 
require'model/conexion.php';
require'model/mdlCarrusel.php';
require'model/mdlProveedor.php';
require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
?>

<div class="container d-flex justify-content-center" style="margin-top: 100px;">
      <div class="row">
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
                  <a href="../../adminCliente.php" class="d-flex justify-content-center mb-3" >
                    <span><i class="fas fa-cloud-download-alt mr-2"></i></span> <span>Ir a Descargar mis productos</span>
                  </a>
                <?php endif; ?>
            </div>    
          </div>
        </div>
    </div>



<?php
     $plantilla->ctr_footer();
 
?>

<script>
  localStorage.clear();
</script>