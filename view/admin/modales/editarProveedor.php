
<!-- Modal -->
<div class="modal fade" id="modalEditarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form"  method="post" id="idEditarProveedor" name="FormAddProveedor" action="../controler/ctrProveedor.php" enctype="multipart/form-data" target="_blank">
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
                                        <label for="labelPassword">Password  (Maximo 20 Digitos)</label>
                                        <input type="text" class="form-control" id="idInputPassword"  maxlength="20"  name="inputPassword">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="Proveedor" value="addProveedor">
                        </div>


                        <input type="hidden" name="Proveedor" value="editProveedor">
                        <input type="hidden" name="idProveedor" class="idProveedor" value="">
                       
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