
<!-- Modal -->
<div class="modal fade" id="idEditarImgCarrusel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Remplazar img </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form"  method="post" id="idFormEditarImgCarrusel" name="FormAddProveedor" action="../controler/ctrCarrusel.php" enctype="multipart/form-data" target="_blank">
            <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6 inputFile">
                            <label for="labelLogo"> Logo </label>
                            <input type="file" id="files"  required=""  accept="image/*"  name="fileImgCarrusel" / >
                            <output id="list" class="rounded mx-auto d-block imgCarrusel"></output>
                        
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
                    <input type="hidden" name="Carrsuel" value="editarImgCarrusel">
                    <input type="hidden" name="nombreArchivoViejo" id="nombreArchivoViejo">
            </div>
            <input type="hidden" name="idImgCarrusel" value="editProveedorImg" id="idImgCarrsuel">
            <div class="col-lg-12">
                <div class="smsEspera">

                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn bg-olive btn-flat margin">Submit</button>
            </div>
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-maroon margin" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style>

    .inputFile img{
        width: 80% !important;
        margin-bottom: 30px !important;
        margin-top: 30px !important;
    }
</style>