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
                      <h3 class="box-title">Logos Djs</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                      <form role="form"  method="post" id="idFormAddImgLogosDjs" name="FormAddImgCarrusel" action="../controler/ctrLogosDjs.php" enctype="multipart/form-data">
                          <div class="box-body">
                            <div class="col-lg-6 inputFile">
                                <label for="labelLogo"> Logo  </label>
                                <input type="file" id="files"  required=""  accept="image/*"  name="fileImgCarrusel" / >
                                <output id="list"  class="rounded mx-auto d-block"></output>
                            
                            </div>
                          </div>
                          <div class="col-lg-12">
                              <div class="smsEspera">

                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group">
                                  <div class="col-lg-12 ">
                                      <!-- //==================================BARRA DE PROGRESO=============================== -->
                                      <div class="progress">
                                          <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                          
                                          </div>
                                      </div>
                                      <h4 class="porcentaje_h4">0% Complete (success)</h4>
                                  </div>
                              </div>
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <input type="hidden" name="LogosDjs" value="AgregarImg">
                            
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