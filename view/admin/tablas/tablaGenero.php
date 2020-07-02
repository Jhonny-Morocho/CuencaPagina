 
   
   
   <!-- Main content -->
    <section class="content">
  
      <div class="row">
        <div class="col-lg-12">
             <!-- DATA TABLE GENERO -->
             <div class="box">
            <div class="box-header">
              <h3 class="box-title">Genero Musical</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Genero</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>

                <?php
                    $genero=ModeloGenero::sql_lisartar_genero();

                   //print_r($genero);
                   foreach($genero as $key=>$value){
                       echo"<tr>";
                           echo'<td>'.$value['genero'].'</td>';
                            echo'<td>
                                    <button type="button" class="btn btn-primary editGenero" data-toggle="modal" data-target="#exampleModalCenter" data-id="'.$value['id'].'" data-genero="'.$value['genero'].'">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </td>';

                                echo'<td>
                                        <button type="button" class="btn btn-danger deleteGenero"  data-id="'.$value['id'].'" data-genero="'.$value['genero'].'">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                        </td>';

                            echo"</tr>";
                   }
                
                ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div> 
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->