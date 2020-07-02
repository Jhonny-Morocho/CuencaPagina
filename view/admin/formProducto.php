<?php
 ini_set('display_errors', 'On');

 require'../../controler/controlerTemplateAdmin.php';
 require'../../model/conexion.php';
 require'../../model/mdlGenero.php';

 

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
                    <h3 class="box-title">Formulario  Producto</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"  method="post" id="idAgregarProducto" name="FormAddProducto" action="../controler/ctrProducto.php" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="labelPseudo Nombre">Titulo</label>
                                <input type="text" class="form-control" id="idInputTitulo"  required="" name="inputTitulo" >
                            </div>

                            <div class="form-group">
                                <label for="labelApellido">Artista</label>
                                <input type="text" class="form-control" id="idInputArtista"  required="" name="inputArtista" >
                            </div>
                               
                            <div class="form-group">
                                <label for="labelNombre">Genero</label>
                                <select  required=""  class="form-control show-tick ms select2" data-placeholder="Select"  name="id_genero">
                                        <option value="">Seleciona un genero musical</option>
                                    <?php 
                                        $genero=ModeloGenero::sql_lisartar_genero();
                                        foreach($genero as $key=>$value){ ?>
                                            <option value=" <?php echo$value['id'] ?> " > <?php echo$value['genero'] ?> </option>
                                    <?php }?>

                                    </select>
                            </div>
                                
                            <div class="form-group">
                                <label for="labelCorreo">Bpm</label>
                                <input type="number" class="form-control" id="idInputBm"  required="" name="inputBpm" >
                            </div>

                            <div  class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="labelCorreo">Dolares</label>
                                        <input type="number" class="form-control"  min="0" id="idInputDolares" size="2" placeholder="0" required="" name="inputDolares" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="labelPseudo Nombre">Centavos</label>
                                        <input type="number"   min="0"  size="2" class="form-control" id="idInputCentavos"  placeholder="0"  required="" name="inputCentavos" >
                                    </div>
                                </div>
                            </div>


                            <div  class="row">
                                <div class="col-lg-6 fileColumna">
                              
                                        <label for="labelDemoEdit" id="labelFileFormularioProducto"><i class="fa fa-file-audio-o" aria-hidden="true"></i> Preview (Calidad de 128 Kbs)</label>
                                        <input type="file" required=""  id="idInputDemo" type="audio/mp3" name="filesEditDemo" / >
                                
                                </div>
                                <div class="col-lg-6 fileColumna">
                              
                                    <label for="labelDemoEdit" id="labelFileFormularioProducto"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Archivo (La mejor calidad)</label>
                                    <input type="file" required=""  type="audio/mp3" id="idInputRemixCompleto"  name="filesEditCompleto" / >
                      
                                </div>

                                
                            </div>

                            <div class="row fileColumna">
                                <div class="col-lg-12">
                                    <div id="content" class="col-lg-12">
                                            <!-- Contenido inicial... -->
                                        </div>
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
                            <input type="hidden" name="Producto" value="addProducto">
                            <input type="hidden" name="id_proveedor" value="<?php echo $_SESSION['id_proveedor'] ?>">

                            
                            <div class="form-group">
                                <div class="smsEspera"></div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn bg-olive margin">Subir</button>
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