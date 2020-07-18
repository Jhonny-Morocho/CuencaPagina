
 
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Compras</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

       <?php 
         $cliente = new ModeloCliente();// para el formulario de informacion del cliente
   
         $facturas=ModeloFacura::sqlListarFacturasTodos();
         //print_r($facturas);
        $cont_2=1;
       ?>
        <?php  foreach($facturas as $key=>$value){?>
                <div class="box">
                    <table id="dtBasicExample" class="table  table-striped table-bordered table-sm"  width="100%">
                    <p> <br> Fecha de compra: <?php echo $value['fechaFacturacion'] ?> </p>
                    <p>Total : <?php echo $value['totalCancelar'] ?></p>
                    <p>Cliente : <?php echo $value['correo'] ?></p>
                    <p>Nombre : <?php echo $value['nombre'] ?></p>
                    <p>Apeliido : <?php echo $value['apellido'] ?></p>
                        <thead class="thead-light ">
                        <tr>
                            <th>#</th>
                            <th>Download</th>
                            <th>REMIXER</th>
                            <th>ARTIST</th>
                            <th>TITLE</th>
                            <th>PRICE</th>
                            <th>METHOD PAYMENT</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                
                        <?php 
                            foreach ($facturas as $key => $value) {
                            
                                $clienteProductos=ModeloClienteProducto::sqlListarProductosCliente($value['idCliente'],$value['id']);
                                //print_r($clienteProductos);
                                foreach($clienteProductos as $key=>$value){
                                    echo'<tr>   
                                            <th scope="row">'.$cont_2.'</th>
                                            <td><a download   href="../../editCompletos/'.$value['remixCompleto'].'?download_csv=../editCompletos/'.$value['remixCompleto'].'" class="bontIconosProducto"><i class="fa fa-fw fa-cloud-download"></i></a></td>      
                                            <td>'.$value['apodo'].'</td>
                                            <td>'.$value['artista'].'</td>
                                            <td>'.$value['nombrePista'].'</td>
                                            <td>$ '.$value['precioCompra'].'</td>
                                            <td>'.$value['metodoCompra'].'</td>
                                        </tr>';
                                    $cont_2++;
                                } 
                            }
                
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-->
                  
              <?php  } ?>
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