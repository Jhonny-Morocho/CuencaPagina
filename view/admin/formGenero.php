<?php
 ini_set('display_errors', 'On');

 require'../../controler/controlerTemplateAdmin.php';




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
                      <h3 class="box-title">Formulario agregar genero</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                      <form role="form"  method="post" id="idFormAddgenero" name="FormAddgenero" action="../controler/crtGenero.php">
                          <div class="box-body">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Nombre Genero</label>
                              <input type="text" class="form-control" id="idInputNombreGenero"  required="" name="inputNombreGenero">
                              </div>

                              <input type="hidden" name="Genero" value="addgenero">
                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
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