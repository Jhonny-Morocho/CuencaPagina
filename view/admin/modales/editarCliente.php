
<!-- Modal -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Datos Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form"  method="post" id="idEditarCliente" name="FormAddProveedor" action="../controler/ctrCliente.php" enctype="multipart/form-data" target="_blank">
            <div class="box-body">
                <div class="form-group">
                    <label for="labelNombre">Nombre</label>
                    <input type="text" class="form-control" id="idRegistroName"  required="" name="inpuNameCliente">
                </div>
        
                <div class="form-group">
                    <label for="labelApellido">Apellido</label>
                    <input type="text" class="form-control" id="idRegistroLastName"  name="inputApellidoCliente">
                </div>

                <div class="form-group">
                    <label for="labelPassword">Password  (Maximo 20 Digitos)</label>
                    <input type="text" class="form-control" id="idInputPasswordCliente"  maxlength="20"  name="inputPasswordCliente">
                </div>

                <div class="form-group">
                  <div class="smsConfirmacion"></div>
                </div>                  
            </div>
            <input type="hidden" name="Cliente" value="editCliente">
            <input type="hidden" name="idCliente" class="idCliente" value="">
            
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