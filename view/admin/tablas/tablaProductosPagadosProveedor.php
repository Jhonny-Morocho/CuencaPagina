<section class="content">
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Pagos efecuados a Dj <?php echo $_GET['nombreProveedor'] ?> </h3>
          <!-- form start -->
          <form role="form">
            <div class="box-body">
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Email address</label>
                <input type="date" class="form-control" id="exampleInputEmail1" required name="fechaInicio" value="">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">Password</label>
                <input type="date" class="form-control" id="exampleInputPassword1" required name="fechaFin" value="">
              </div>
              <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary">Filtrar</button>
              </div>
            </div>
          </form>
        </div>
  
        
        <div class="box-body">
        <table id="example2" class="table table-striped table-bordered dt-responsive nowrap table-hover"  width="100%"  >
            <thead>
                <tr>
                    <th># Producto </th>
                    <th>Producto</th>
                    <th>Id Factura</th>
                    <th>Tipo Pago</th>
                    <th>Precio de Venta</th>
                    <th>Fecha de venta</th>
                    <th>Estado Pago</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $cont=1;
                    $suma_total=0;
                    $productos_vendidos=ModeloClienteProducto::sqlListarProductosVendidosProveedor(@$_GET['idProveedor']);
                        foreach($productos_vendidos as $key=>$value){

                            if($_GET['idProveedor']==$value['idProveedor'] && $value['estadoPagoProveedor']==1 ){

                                echo'<tr>
                                            <td>'.( $value['idProducto'] ).'</td>
                        
                                            <td>'.( $value['nombrePista'] ).'</td>
                                        
                                            <td>'.( $value['idFactura'] ).'</td>
                                            <td>'.( $value['metodoCompra'] ).'</td>
                                            <td>$'.( $value['precioCompra'] ).'</td>
                                            <td>'.( $value['fechaCompra'] ).'</td>';
                                        
                                            
                                            if($value['estadoPagoProveedor'] ==1){
                                              echo ' <td><small class="label  bg-green">Pagado</small> </td>';
                                        
                                            }
                                    
                                    echo"</tr>";
                                    $suma_total=$value['precioCompra']+$suma_total;

                            }
                        }

                ?>

            </tbody>
        </table>
        <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo "Suma total: $ ".$suma_total;?></h3>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
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