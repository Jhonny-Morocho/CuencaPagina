 
   
   
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Clientes</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example5" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Date</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Compras</th>
              <th>Membresias</th>
              <th>Monedero</th>
              <th>Editar</th>
            </tr>
            </thead>
            <tbody>
            <a href=""></a>
            <?php
                $clientes=ModeloCliente::sqlListarClientes();

               //print_r($clientes);
               foreach($clientes as $key=>$value){
                   echo"<tr>";
                       echo'<td>'.$value['fechaRegistro'].'</td>';
                       echo'<td>'.$value['nombre'].'</td>';
                       echo'<td>'.$value['apellido'].'</td>';
                       echo'<td>'.$value['correo'].'</td>';
                       echo'<td><a href="../view/admin/listarComprasProductosCliente.php?correo='.$value['correo'].'&idCliente='.$value['id'].'"><i class="fa fa-fw fa-list-alt"></i></a></td>';
                       echo'<td><a href="../view/admin/listarMembresiasCliente.php?corroCliente='.$value['correo'].'&idCliente='.$value['id'].'"><i class="fa fa-fw fa-folder-o"></i></i></a></td>';
                      echo '<td><i class="fa fa-fw fa-money editClienteMonedero" aria-hidden="true"  
                                                                                                    data-id="'.$value['id'].'"  
                                                                                                    data-saldo="'.$value['saldoActual'].'"  
                                                                                                    data-nombre="'.$value['nombre'].'" 
                                                                                                    data-apellido="'.$value['apellido'].'" 
                                                                                                    data-correo="'.$value['correo'].'" 
                                                                                                    data-toggle="modal" 
                                                                                                    data-target="#modalEditarMonederoCliente" ></i>
                              </td>';
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