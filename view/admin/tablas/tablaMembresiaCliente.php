 
   
   
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Membresia Cliente <?php echo $_GET['corroCliente'] ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Membresia</th>
              <th>Fecha Compra</th>
              <th>Fecha Expira</th>
              <th>Precio</th>
              <th>Numero Descargas</th>
              <th>Precio Unitario Tema</th>
            </tr>
            </thead>
            <tbody>
            <a href=""></a>
            <?php
                 $mebresiasCliente=Modelo_Membresia::sqlListarMembresiasCliente($_GET['idCliente']);
               foreach($mebresiasCliente as $key=>$value){
                   echo"<tr>";
                       echo'<td>'.$value['tipo'].'</td>';
                       echo'<td>'.$value['fecha_inicio'].'</td>';
                       echo'<td>'.$value['fecha_culminacion'].'</td>';
                       echo'<td>'.$value['precio'].'</td>';
                       echo'<td>'.$value['rango'].'</td>';
                       echo'<td>'.$value['precio_unidad'].'</td>';
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