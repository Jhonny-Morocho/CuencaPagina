
<!-- Modal -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <form role="form"  method="post" id="idEditarPrducto" name="FormAddProducto" action="../controler/ctrProducto.php" enctype="multipart/form-data">
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
                                    <?
                                        require'../../model/mdlGenero.php';
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
                                <label for="labelDemoEdit" id="labelFileFormularioProducto"><i class="fa fa-file-audio-o" aria-hidden="true"></i>Preview (Calidad de 128 Kbs)</label>
                                <input type="file"  id="idInputDemo" type="audio/mp3" name="filesEditDemo" / >
                
                                <label for="labelDemoEdit" id="labelFileFormularioProducto"><i class="fa fa-cloud-upload" aria-hidden="true"></i>Archivo (La mejor calidad)</label>
                                <input type="file"  type="audio/mp3" id="idInputRemixCompleto"  name="filesEditCompleto" / >
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
                            <input type="hidden" name="Producto" value="editarProducto">
                            <!-- <input type="hidden" name="id_proveedor" id="idProveedor"> -->
                            <input type="hidden" name="id_producto" id="idProducto">

                            
                            <div class="form-group">
                                <div class="smsEspera"></div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn bg-olive margin">Subir</button>
                        </div>
                    </form>
    </div>
      <div class="modal-footer">  
        <button type="button" class="btn bg-maroon margin" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>