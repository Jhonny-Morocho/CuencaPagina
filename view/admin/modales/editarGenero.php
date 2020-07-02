
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Genero Musical</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form role="form"  method="post" id="idFormEditgenero" name="FormEditgenero" action="../controler/crtGenero.php">
                    <div class="box-body">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Nombre Genero</label>
                        <input type="text" class="form-control" id="idInputNombreGenero"  required="" name="inputNombreGenero">
                        </div>

                        <input type="hidden" name="Genero" value="edit">
                        <input type="hidden" name="idGenero" class="idGenero" value="">
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