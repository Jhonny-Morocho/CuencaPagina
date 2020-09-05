 
   
   
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Proveedores</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Apodo</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Pendiente</th>
              <th>Pagados</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $proveedor=ModeloProveedor::sql_lisartar_proveedor();

               //print_r($genero);
               foreach($proveedor as $key=>$value){

               echo"<tr>";
     
                    echo'<td>'.$value['apodo'].'</td>';
                    echo'<td>'.$value['nombre'].'</td>';
                    echo'<td>'.$value['apellido'].'</td>';
                    echo'<td>'.$value['correo'].'</td>';
                    echo'<td><a href="../view/admin/listarMisVentasNoPagadas.php?nombreProveedor='.$value['nombre'].'&idProveedor='.$value['id'].'" class="btn btn-danger "><i class="fa fa-fw fa-calendar-times-o" aria-hidden="true"></i></a> </td>';

                    echo'<td> <a href="../view/admin/listarMisVentasPagadas.php?nombreProveedor='.$value['nombre'].'&idProveedor='.$value['id'].'" class="btn btn-success "> <i class="fa fa-fw fa-calendar-check-o" aria-hidden="true"></i></a></td>';
                   
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