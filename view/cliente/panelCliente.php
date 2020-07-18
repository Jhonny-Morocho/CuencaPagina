<!-- Single Tab Content End -->
    <?php
    
        // obtener la informacion del cliente para que pueda editar su informacion
        $cliente = new ModeloCliente();// para el formulario de informacion del cliente
    
        foreach($cliente->sqlListarClientes() as $key=>$value){
            if($_SESSION['id_cliente']==$value['id']){
                //variables para el formulario
                $nombre=$value['nombre'];
                $apellido=$value['apellido'];
                $correo=$value['correo'];
            }
        }

        // obtenermos todas las facturas con el id del cliente, para luego realizar un filtro
        $facturas=ModeloFacura::sqlListarFacturas(@$_SESSION['id_cliente']);

        
    ?>

<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../adminCliente.php">Mi Cuenta</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['usuario']." ".$_SESSION['apellido']?></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- my account wrapper start -->
<div class="my-account-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad"  data-toggle="tab"><i class="fas fa-table"></i> Tablero</a>
                                <a href="#download" data-toggle="tab" class="active"><i class="fa fa-cart-arrow-down" ></i> Productos Adquiridos</a>
                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Detalles de Mi cuenta</a>
                                <a href="../../adminCliente.php?cerrar_session=true" ><i class="fas fa-sign-out-alt"></i> Cerrar Session</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade " id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Tablero</h3>
                                        <div class="welcome">
                                             <p>Hello, <strong><?php echo $_SESSION['usuario']." ".$_SESSION['apellido']?></strong></p>
                                        </div>
                                        <p class="mb-0">Desde el tablero de su cuenta, puede gestionar  su informacion y productos adquiridos, tambien editar sus datos personales</p>
                                    </div>
                                </div>


                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active " id="download" role="tabpanel">
                                        <div class="myaccount-content ">
                                            <?php $cont=1; foreach($facturas as $key=>$value){?>
                                              
                                                <table id="dtBasicExample" class="table  table-striped table-bordered table-sm table-hover table-dark"  width="100%">
                                                <p> <br> Fecha de compra: <?php echo $value['fechaFacturacion'] ?> </p>
                                                <p>Total :$ <?php echo $value['totalCancelar'] ?></p>
                                                    <thead class="tablaCabezera">
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
                                                        $clienteProductos=ModeloClienteProducto::sqlListarProductosCliente(@$_SESSION['id_cliente'],$value['id']);
                                                        //print_r($clienteProductos);
                                                        foreach($clienteProductos as $key=>$value){
                                                            echo'<tr>   
                                                                    <th scope="row">'.$cont_2.'</th>
                                                                    <td><a download   href="../../editCompletos/'.$value['remixCompleto'].'?download_csv=../editCompletos/'.$value['remixCompleto'].'" class="bontIconosProducto"><i class="fas fa-cloud-download-alt"></i></a></td>      
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
                                 </div>
                                    <!-- Single Tab Content End -->


                                <!-- Single Tab Content Start Detalle de mi cuenta -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content ">
                                        <h3>Account Details</h3>
                                        <div class="account-details-form ">
                                                <form  method="post" action="../../controler/ctrCliente.php" id="idEditarCliente" name="FormAddProveedor" enctype="multipart/form-data" target="_blank">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="md-form">
                                                                <input type="text" maxlength="20" id="idRegistroName" class="form-control form-control-sm validate" required="" name="inpuNameCliente" value="<?php echo $nombre?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="md-form">
                                                                <input type="text" id="idRegistroLastName" maxlength="20" class="form-control form-control-sm validate" required="" name="inputApellidoCliente" value="<?php echo $apellido?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="md-form">
                                                                <input type="password" id="id_password_login" class="form-control" name="inputPasswordCliente"  maxlength="20">
                                                                <label for="materialLoginFormPassword">Password</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="md-form">
                                                                <input type="email" id="id_password_login" class="form-control"  value="<?php echo $correo ?>" disabled>
                                                                <label for="materialLoginFormPassword">Email</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="md-form">
                                                                <div class="smsConfirmacion">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <div class="md-form">
                                                    <input type="hidden" name="Cliente" value="editCliente">
                                                    <input type="hidden" name="idCliente" class="idCliente" value="<?php echo $_SESSION['id_cliente']?>">
                                                    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0">Guardar datos editados</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->


