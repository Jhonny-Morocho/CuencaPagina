
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Pagos no efecuados a Dj <?php echo $_GET['nombreProveedor'] ?> </h3>
        <!-- form start -->
            <form role="form" class="" method="post" action="../controler/ctrPagosProveedor.php" id="idFiltrarFechaPago">
                <div class="box-body ">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Fucha Inicio</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" required name="fechaInicio" value="2020-07-25">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputPassword1">Fecha Fin</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" required name="fechaFin" value="2020-07-25">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="hidden" name="idProveedor" value="<?php echo $_GET['idProveedor'] ?>">
                        <input type="hidden" name="FiltroPagoProveedor" value="FiltrarFechas">
                        <button type="submit" class="btn bg-purple btn-flat margin" title="Filtrar"><i class="fa fa-fw fa-search"></i></button>
                    </div>
                </div>
            </form>
            <form role="form" class="col-md-3" method="post" action="../controler/ctrPagosProveedor.php" id="idGenerarPdf" target="alt">
                <div class="box-body ">
                 
                        <div class="form-group ">
                            <label for="exampleInputEmail1">Comision %</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" required name="comision" value="60">
                            <input type="hidden" name="FiltroPagoProveedor" value="GenerarPdf">
                            <input type="hidden" name="nombreDj" value="<?php echo $_GET['nombreProveedor']?>">
                        <button type="submit" class="btn bg-navy margin" title="Generar Reporte PDF"><i class="fa fa-fw fa-file-pdf-o"></i></button> 
                    </div>
                </div>
            </form>
            
            <form role="form" class="col-md-2" method="post" action="../controler/ctrPagosProveedor.php" id="idFormVerTodo">
                <div class="box-body ">
               
                    <div class="form-group ">

                        <button type="submit" class="btn bg-olive margin" title="Ver todos los resultados"><i class="fa fa-fw fa-th-list"></i></button> 
                    </div>
                </div>
            </form>
            <form role="form" class="col-md-2" method="post" action="../controler/ctrPagosProveedor.php" id="idCambiarEstado">
                <div class="box-body ">
                    <div class="form-group ">
                    
                     
                        <button type="submit" class="btn bg-maroon margin" title="Cambiar de estado pendiente a pagado"><i class="fa fa-fw fa-pencil"></i></i></button> 
                
                    </div>
                </div>
            </form>

        </div>
        <!-- /.box-header -->
        <div class="box-body ">
        <table id="example2_wrapper" class="table table-striped table-bordered dt-responsive nowrap table-hover"  width="100%"  >
            <thead>
                <tr>
                    <th>#</th>
                    <th>id Cli_Prod</th>
                    <th>Id Factura</th>
                    <th>Producto</th>
                    <th>Tipo Pago</th>
                    <th>Precio de Venta</th>
                    <th>Fecha de venta</th>
                    <th>Estado Pago</th>
                </tr>
            </thead>
            <tbody class="cuerpoTabla">

                <?php
                    $cont=1;
                    $suma_total=0;
                    $productos_vendidos=ModeloClienteProducto::sqlListarProductosVendidosProveedor(@$_GET['idProveedor']);
                        foreach($productos_vendidos as $key=>$value){

                            if($_GET['idProveedor']==$value['idProveedor'] && $value['estadoPagoProveedor']==0 ){

                                echo'<tr>
                                            <td> '.$cont.'</td>
                                            <td class="idClienteProducto">'.( $value['id'] ).'</td>
                        
                                            <td>'.( $value['idFactura'] ).'</td>
                                            <td class="nombrePista">'.( $value['nombrePista'] ).'</td>
                                        
                                            <td class="metodoCompra">'.( $value['metodoCompra'] ).'</td>
                                            <td class="precioCompra">$'.( $value['precioCompra'] ).'</td>
                                            <td class="fechaCompra">'.( $value['fechaCompra'] ).'</td>';
                                        
                                            
                                            if($value['estadoPagoProveedor'] ==0){
                                              echo'<td><small class="label  bg-yellow">Pendiente</small> </td>';
                                        
                                            }
                                    
                                    echo"</tr>";
                                    $suma_total=$value['precioCompra']+$suma_total;
                                    $cont++;

                            }
                        }

                ?>

            </tbody>
        </table>
        <div class="small-box bg-aqua">
            <div class="inner">
              <h3 class="sumaTotal"><?php echo "Suma total: $ ".$suma_total;?></h3>
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