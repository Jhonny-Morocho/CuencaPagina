 
   
   
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
            </tr>
            </thead>
            <tbody>
            <?php
                $proveedor=ModeloProveedor::sql_lisartar_proveedor();

               //print_r($genero);
               foreach($proveedor as $key=>$value){

               echo"<tr>";
                    echo'<td>
                          
               
                                <div class="product-label">
                                    <span class="fa fa-pencil editProveedorImg " aria-hidden="true" data-toggle="modal" data-target="#modalEditarProveedorImg"  data-id="'.$value['id'].'"></span>
                                </div>
                          
                                <img src="../img/proveedores/'.$value['img'].'" class="img-thumbnail imgProveedor" >
                              
                          
                    </td>';

                    echo'<td>'.$value['apodo'].'</td>';
                    echo'<td>'.$value['nombre'].'</td>';
                    echo'<td>'.$value['apellido'].'</td>';
                    echo'<td>'.$value['correo'].'</td>';
                    echo'<td>
                          
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


<style>
  .product-label {
    position: absolute;
    margin-top: 10px;
    margin-left: 10px;
    color: white;
    font-size: 20px;
}
.imgProveedor{
  width: 30%;
 
}
.product-label:hover {
    position: absolute;
    color: greenyellow;
    font-size: 25px;
}
</style>