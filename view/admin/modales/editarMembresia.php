
<!-- Modal -->
<div class="modal fade" id="modalEditarMembresia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Membresia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form role="form"  method="post" id="idFormEditMembresia" name="FormEditgenero" action="../controler/ctrMembresia.php">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="Membresia"> Membresia </label>
                            <input type="text" class="form-control" id="idInputNombreMembresia"  required="" name="inputNomMembresia">
                        </div>
                        <div class="form-group">
                            <label for="Numero Descargas"> Numero de Descargas </label>
                            <input type="number" class="form-control" id="idInputNumeroDescargas"  required="" name="inputNumeroDescargas" min="0" >
                        </div>
                        <div class="form-group">
                            <label for="Numero Descargas">$ Precio </label>
                            <input type="number" class="form-control" id="idInputPrecio"  required="" name="inputPrecio" min="0" step="0.01">
                        </div>

                        <input type="hidden" name="Membresia" value="edit">
                        <input type="hidden" name="idMembresia" id="idMembresia" value="">
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