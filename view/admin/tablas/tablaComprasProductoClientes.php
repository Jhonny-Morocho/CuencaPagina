 
   <!-- Single Tab Content End -->
   <?php
    
    // obtener la informacion del cliente para que pueda editar su informacion
    $cliente = new ModeloCliente();// para el formulario de informacion del cliente

    foreach($cliente->sqlListarClientes() as $key=>$value){
        if($_GET['idCliente']==$value['id']){
            //variables para el formulario
            $nombre=$value['nombre'];
            $apellido=$value['apellido'];
            $correo=$value['correo'];
        }
    }


    // obtenermos todas las facturas con el id del cliente, para luego realizar un filtro
    $facturas=ModeloFacura::sqlListarFacturas($_GET['idCliente']);

    
?>
   
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Compras del cliente : <?php  echo $_GET['correo']?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <?php $cont=1; foreach($facturas as $key=>$value){?>      
                  <table id="dtBasicExample" class="table  table-striped table-bordered table-sm"  width="100%">
                  <p> <br> Fecha de compra: <?php echo $value['fechaFacturacion'] ?> </p>
                  <p>Total : <?php echo $value['totalCancelar'] ?></p>
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
                          $cont_2=1;  
                          // imprimir todos los productos que ha comprado el cliente
                          $clienteProductos=ModeloClienteProducto::sqlListarProductosCliente($_GET['idCliente'],$value['id']);
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
                          ?>
                      </tbody>
                  </table>
              <?php $cont++; } ?>
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