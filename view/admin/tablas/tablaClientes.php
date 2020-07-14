 
   
   
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
              <th>Date</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Compras</th>
              <th>Membresias</th>
              <th>Editar</th>
            </tr>
            </thead>
            <tbody>

            <?php
                $clientes=ModeloCliente::sqlListarClientes();

               //print_r($clientes);
               foreach($clientes as $key=>$value){
                   echo"<tr>";
                       echo'<td>'.$value['fechaRegistro'].'</td>';
                       echo'<td>'.$value['nombre'].'</td>';
                       echo'<td>'.$value['apellido'].'</td>';
                       echo'<td>'.$value['correo'].'</td>';
                       echo'<td><i class="fa fa-fw fa-list-alt"></i></td>';
                       echo'<td><i class="fa fa-fw fa-list-alt"></i></td>';
                        echo'<td>
                                <i class="fa fa-pencil editCliente" aria-hidden="true"  data-toggle="modal" data-target="#modalEditarCliente" 
                                                                                        data-id="'.$value['id'].'" 
                                                                                        data-nombre="'.$value['nombre'].'" 
                                                                                        data-apellido="'.$value['apellido'].'">
                                </i>
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