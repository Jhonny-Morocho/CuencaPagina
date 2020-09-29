
<!-- Modal -->
<div class="modal fade" id="modalEditarMonederoCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Genero Musical</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form role="form"  method="post" id="idFormMonederoCliente" name="FormEditgenero" action="../controler/ctrCliente.php">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre </label>
                            <input type="text" class="form-control" id="idInputNombreCliente"  required="" name="inputNombreCliente" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellido</label>
                            <input type="text" class="form-control" id="idInputApellidoCliente"  required="" name="inputApellidoCliente" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo</label>
                            <input type="text" class="form-control" id="idInputCorreoCliente"  required="" name="inputCorreoCliente" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Monto Actual Monedero</label>
                            <input type="number" class="form-control" id="idInputSaldoAntiguoCliente"  required="" step="0.01" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Agregar nuevo monto</label>
                            <input type="number" class="form-control" id="idInputSaldoCliente"  required="" name="inputNuevoSaldoCliente"  step="0.01" >
                        </div>
                        <div class="form-group">
                            <div class="smsConfirmacion">

                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
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