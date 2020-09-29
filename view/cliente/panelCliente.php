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
    $clienteProductos=ModeloClienteProducto::sqlListarProductosCliente(@$_SESSION['id_cliente'],$value['id']);
    $mebresiasCliente=Modelo_Membresia::sqlListarMembresiasCliente(@$_SESSION['id_cliente']);
    
?>

<!-- breadcrumb area start -->
<div class="breadcrumb-area">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb-wrap">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb" style="color: black;">
                        <li class="breadcrumb-item"><a href="../../adminCliente.php" style="color: black;">Mi Cuenta</a></li>
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
                    <div class="col-lg-3 col-md-4 ">
                        <div class="myaccount-tab-menu nav " role="tablist">
                            <a href="#dashboad"  data-toggle="tab"><i class="fas fa-table"></i> Tablero</a>
                            <a href="#membresia"  data-toggle="tab"><i class="fa fa-folder" aria-hidden="true"></i>Membresias</a>
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
                                <div class="myaccount-content ">
                                    <div class="row">
                                        <div class="col-md-8 ">
                                            <h3>Tablero</h3>
                                            <div class="welcome">
                                                 <p>Hello, <strong><?php echo $_SESSION['usuario']." ".$_SESSION['apellido']?></strong></p>
                                            </div>
                                            <p class="mb-0">Desde el tablero de su cuenta, puede gestionar  su informacion y productos adquiridos, tambien editar sus datos personales</p>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div id="draggable-snap-1" class="card">
                                                    <h5 class="card-header primary-color white-text">Monedero</h5>
                                                <div class="card-body ">
                                                    <?php
                                                    $saldo=ModeloCliente::sqlListarClientes();
                                                    foreach($saldo as $key=>$value){
                                                        if(@$_SESSION['id_cliente']==$value['id']){
                                                            echo'   <div class="middle">            
                                                                        <span class="length badge badge-primary" style="font-size: 28px;">$ '.$value['saldoActual'].'</span>
                                                                    </div>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>


                            <div class="tab-pane fade " id="membresia" role="tabpanel">
                                <div class="myaccount-content ">
                                    <h3>Membresias</h3>

                                          <div class="row">
                                            <?php
                                            if (count($mebresiasCliente)>0) {
                                                foreach ($mebresiasCliente as $key => $value) {
                                                    # code...
                                                    echo'<!-- Grid column -->
                                                    <div class="col-lg-4 col-md-6 mb-4">
                                                    <!--Panel-->
                                                        <div class="card text-center"">
                                                            <div class=" card-header success-color white-text">
                                                                Membresia
                                                            </div>
                                                            <div class="card-body descripcionMembresia">
                                                                <h4 class="card-title">'.$value['tipo'].'</h4>
                                                                <p class="card-text">Fecha Adquisicion : '.$value['fechaCompra'].'</p>
                                                                <p class="card-text">Fecha Expira : '.$value['fechaExpiracion'].'</p>
                                                            </div>
                                                            <div class="card-footer text-muted success-color white-text">
                                                                <p class="mb-0">Descargas : '.$value['numDescargas'].'</p>
                                                            </div>
                                                        </div>
                                                        <!--/.Panel-->
                                                    </div>
                                                    <!-- Grid column -->';
                                                }
                                                # code...
                                            }else{
                                                echo '
                                                    <div class="alert alert-warning" role="alert">
                                                    Your membresias Is empty
                                                    </div>';
                                            }
                                            ?>
                                        </div>
                                        <!-- Grid row -->
                                </div>
                            </div>

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active " id="download" role="tabpanel">
                                    <div class="myaccount-content ">
                                        <h3>Productos</h3>
                                        <?php 
                                            if(count($clienteProductos)==0){
                                                echo '<div class="alert alert-warning " role="alert">
                                                Your producto Is empty
                                                </div>';
                                            }
                                        ?>
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



<style>
.myaccount-page-wrapper{
    margin-bottom: 50px;
}
.myaccount-tab-menu a:hover{
    background-color: black;
    color: white;
}
.my-account-wrapper .active{
    background-color: black;
    color: white;
}
.breadcrumb-area{
    margin-top: 150px;
}
.descripcionMembresia h4{
    color: black;
}
.descripcionMembresia p{
    color: black;
}
</style>


