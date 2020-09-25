<?php
 ini_set('display_errors', 'On');

 require'../../controler/controlerTemplateAdmin.php';
 require'../../model/conexion.php';


 //print_r($respuesta);
 date_default_timezone_set('America/Guayaquil');
 $fecha_actual=date("Y-m-d");


	

 

// //Creacion del objeto
$plantilla= new controlerPlantillaAdmin();
$plantilla->usuario_autentificado();
 $plantilla->ctr_header();
$plantilla->ctr_navegador_Izquierda();

?>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-12">
              <!-- formulario -->
                  <div class="box box-primary">
                      <div class="box-header with-border">
                      <h3 class="box-title">Carrusel</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                      <form role="form"  method="post" id="idFormAddImgCarrusel" name="FormAddImgCarrusel" action="../controler/ctrCarrusel.php" enctype="multipart/form-data">
                          <div class="box-body">
                            <div class="col-lg-6 inputFile">
                                <label for="labelLogo"> Carrusel  </label>
                                <input type="file" id="files"  required=""  accept="image/*"  name="fileImgCarrusel" / >
                                <output id="list"  class="rounded mx-auto d-block"></output>
                            
                            </div>
                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <input type="hidden" name="Carrsuel" value="AgregarImg">
                            
                            <button type="submit" class="btn bg-olive margin">Guardar</button>
                          </div>
                      </form>
                  </div>
          </div>
        </div> 
        <!-- /.row -->
      </section>
      <!-- /.content -->
 </div> 
  <!-- /.content-wrapper -->

<?php 

$plantilla->ctr_footer();

?>

<style>

    .inputFile img{
        width: 80% !important;
    }
</style>