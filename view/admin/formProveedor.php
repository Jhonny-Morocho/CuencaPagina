<?php
 ini_set('display_errors', 'On');

 require'../../controler/controlerTemplateAdmin.php';




// //Creacion del objeto
$plantilla= new controlerPlantillaAdmin();
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
                    <h3 class="box-title">Formulario  DJ-Remixer</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"  method="post" id="idAgregarProveedor" name="FormAddProveedor" action="../controler/ctrProveedor.php" enctype="multipart/form-data" target="_blank">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="labelNombre">Nombre</label>
                                        <input type="text" class="form-control" id="idInputNomProveedor"  required="" name="inputNombre">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="labelApellido">Apellido</label>
                                        <input type="text" class="form-control" id="idInputApeliidoProveedor"  required="" name="inputApeliidor">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="labelPseudo Nombre">Pseudo Nombre</label>
                                        <input type="text" class="form-control" id="idInputPseudoNombreProve"  required="" name="inputPseudoNombre">
                                    </div>
                                </div>
                            </div>


                            <div  class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="labelCorreo">Correo</label>
                                        <input type="email" class="form-control" id="idInputCorreo"  required="" name="inputCorreo">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="labelPassword">Password</label>
                                        <input type="text" class="form-control" id="idInputPassword"  required="" name="inputPassword">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="Proveedor" value="addProveedor">
                        </div>

                        <div class="row">
                            <div class="col-lg-6 inputFile">
                                <label for="labelLogo"> Logo </label>
                                <input type="file" id="files"  required=""  accept="image/*"  name="fileLogoDj" / >
                                <output id="list"></output>
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 ">
                                <!-- //==================================BARRA DE PROGRESO=============================== -->
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                    
                                    </div>
                                </div>
                                <h4 class="porcentaje_h4">0% Complete (success)</h4>
                            </div>
                        </div>
                       
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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