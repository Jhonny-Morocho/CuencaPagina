 
   
   
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
              <th>Img</th>
              <th>Apodo</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Acciones</th>
              <th>Ventas</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $proveedor=ModeloProveedor::sql_lisartar_proveedor();

               //print_r($genero);
               foreach($proveedor as $key=>$value){

               echo"<tr>";
                    echo'<td>
                          <div class="col-lg-12">
                              <div class="product-thumb">
                                <div class="product-label">
                                    <span class="fa fa-pencil editProveedorImg " aria-hidden="true" data-toggle="modal" data-target="#modalEditarProveedorImg"  data-id="'.$value['id'].'"></span>
                                </div>
                                <img src="../img/proveedores/'.$value['img'].'?v='.$value['fechaRegistro'].'" class="img-thumbnail" alt="Cinque Terre" width="30%" >
                              </div>
                          </div>
                    </td>';

                    echo'<td>'.$value['apodo'].'</td>';
                    echo'<td>'.$value['nombre'].'</td>';
                    echo'<td>'.$value['apellido'].'</td>';
                    echo'<td>'.$value['correo'].'</td>';
                    echo'<td>
                          <div class="">
                                <button type="button" class="btn btn-primary editProveedor" data-toggle="modal" data-target="#modalEditarProveedor" 
                                                                                                                data-id="'.$value['id'].'" 
                                                                                                                data-nombre="'.$value['nombre'].'" 
                                                                                                                data-apodo="'.$value['apodo'].'" 
                                                                                                                data-apellido="'.$value['apellido'].'"  
                                                                                                                data-correo="'.$value['correo'].'">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                  </button>
                                <button type="button" class="btn btn-danger deletProveedor"  data-id="'.$value['id'].'" data-apodo="'.$value['apodo'].'" data-img="'.$value['img'].'">
                                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                                  </button>
                              </div>
                    </td>';
                    echo'<td><a target="_blank" href="../view/admin/listarProductosVendidosProveedor.ph.php?apodo='.$value['apodo'].'&idProveedor='.$value['id'].'"><i class="fa fa-fw fa-list-alt"></i></a></td>';
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