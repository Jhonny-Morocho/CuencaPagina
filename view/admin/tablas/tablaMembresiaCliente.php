 
   
   
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
              <th>Estado Membresia</th>
            </tr>
            </thead>
            <tbody>
            <a href=""></a>
            <?php
                 date_default_timezone_set('America/Guayaquil');
                 $fecha_actual=date("Y-m-d");
                 $mebresiasCliente=Modelo_Membresia::sqlListarMembresiasCliente($_GET['idCliente']);
               foreach($mebresiasCliente as $key=>$value){
                    $date1 = new DateTime($value['fechaCompra']);
                    $date2 = new DateTime($fecha_actual);
                    $diff = $date1->diff($date2);
                    $spanEstad="";
                    if ($diff->days<1) {
                        # code...
                        $spanEstad=' <span class="label pull-right bg-green">Activa</span>';
                    }else{
                        $spanEstad=' <span class="label pull-right bg-red">Caducada</span>';
                    }
                   echo"<tr>";
                       echo'<td>'.$value['tipo'].'</td>';
                       echo'<td>'.$value['fechaCompra'].'</td>';
                       echo'<td>'.$value['fechaExpiracion'].'</td>';
                       echo'<td>'.$value['totalCancelar'].'</td>';
                       echo'<td>'.$value['numDescargas'].'</td>';
                       echo'<td>'.$value['precioUnitario'].'</td>';
                       echo'<td>'.$spanEstad.'</td>';
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