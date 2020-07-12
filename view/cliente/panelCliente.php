<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../admin_cliente.php">Mi Cuenta</a></li>
                            <!-- <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['usuario']." ".$_SESSION['apellido']?></li> -->
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
                                <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Tablero</a>
                                <a href="#download" data-toggle="tab"><i class="fa fa-cart-arrow-down" ></i> Productos Adquiridos</a>

                                <!-- <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
                                    Method</a> -->
                                <!-- <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a> -->
                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Detalles de Mi cuenta</a>
                                <a href="../admin_cliente.php?cerrar_session=true"><i class="fa fa-sign-out"></i> Cerrar Session</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">

                                            <div class="opciones_pagox">
                                                <div class="row ">
                                              
                                                        <!-- //=============Membresia=============================// -->
                                                        <div class="col-lg-6 pull-right ">
                                                            <h2 class="sqr-btn d-block">Membresia Adquiridas</h2>
                                                                <div class="membresia" >
                                                          
                                                                    <?php
                                                                        // $listar_membresia=CtrMembresia::ctr_listar_membresia();
                                                                        // $tipo_membresia="";
                                                    
                                                                        // foreach($listar_membresia as $key=>$value){
                                                                        
                                                                        //     if(@$_SESSION['id_cliente']==$value['id_cliente']){

                                                                        //         switch (@$value['tipo']) {

                                                                        //             case 'Nombre Cancion: Basico':

                                                                        //                 $tipo_membresia="Basico";
                                                                                    
                                                                        //                 break;
                                                                    
                                                                        //             case 'Nombre Cancion: Premium':
                                                                        //                 $tipo_membresia="Premium";
                                                                                        
                                                                        //                 break;
                                                                    
                                                                    
                                                                        //             case 'Nombre Cancion: Ultimate':
                                                                        //                     $tipo_membresia="Ultimate";
                                                                                        
                                                                        //                 break;
                                                                        //         }
                                                                        //             echo'<div class="alert alert-success" role="alert">';   
                                                                        //                 echo '<br><label style="color: red">Tipo Membresia : </label>'.$tipo_membresia;
                                                                        //                 echo '<br><label style="color: red">Fecha Adquisicion de la membresia : </label>'.$value['fecha_inicio'];
                                                                        //                 echo '<br><label style="color: red">Fecha Culmininacion Membresia: </label>'.$value['fecha_culminacion'];
                                                                        //                 echo '<br><label style="color: red">Descargas Disponibles : </label>'.$value['rango'];
                                                                        //             echo"</div>";
                                                                        //             echo"<br>";
                                                                                    
                                                                        //     }
                                                                        // }

                                                                    ?>
                                                                       
                                                                </div>        

                                                        </div>
                                                </div>

                                            </div>
                                        <h3>Tablero</h3>
                                        <div class="welcome">
                                            <!-- <p>Hello, <strong><?php echo $_SESSION['usuario']." ".$_SESSION['apellido']?></strong></p> -->
                                        </div>
                                        <p class="mb-0">Desde el tablero de su cuenta, puede gestionar  su informacion y productos adquiridos, tambien editar sus datos personales</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Gestionar Editores</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Ordzzesr</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Aug 22, 2018</td>
                                                        <td>Pending</td>
                                                        <td>$3000</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>July 22, 2018</td>
                                                        <td>Approved</td>
                                                        <td>$200</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>June 12, 2017</td>
                                                        <td>On Hold</td>
                                                        <td>$990</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <?php

                                $nombre="";
                                $apellido="";
                                $correo="";



                                // $plantilla= new ControladorPlantilla();//traigo la tabla
                                // $cliente =new CtrCliente();// para el formulario de informacion del cliente



                                // foreach($cliente->ctr_listar_cliente() as $key=>$value){

                                //     if($_SESSION['id_cliente']==$value['id']){
                                //         //variables para el formulario
                                //         $nombre=$value['nombre'];
                                //         $apellido=$value['apellido'];
                                //         $correo=$value['correo'];

                                //     }


                                // }


                                // $plantilla->ctr_tabla_descargar_productos_cliente();
                                ?>

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>
                                        <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Billing Address</h3>
                                        <address>
                                            <p><strong>Alex Tuntuni</strong></p>
                                            <p>1355 Market St, Suite 900 <br>
                                                San Francisco, CA 94103</p>
                                            <p>Mobile: (123) 456-7890</p>
                                        </address>
                                        <a href="#" class="check-btn sqr-btn "><i class="fa fa-edit"></i> Edit Address</a>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start Detalle de mi cuenta -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>
                                        <div class="account-details-form">
                                                <form  method="post" action="../registro_login_ajax.php"  id="id_editar_cliente">
                                                <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item ">
                                                            <p class="p_nombre"></p>
                                                                <input type="text" placeholder="Pirmer Nombre" required="" name="nombre" id="id_nombre" value="<?php echo $nombre?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                            <p class="p_epellido"></p>
                                                                <input type="text" placeholder="Primer Apellido" required=""  name="apellido" id="id_apellido" value="<?php echo $apellido?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="single-input-item">
                                                                <p class="p_correo"></p>
                                                            <input type="email" placeholder="Correro" required="" name="correo" id="id_correo" value="<?php echo $correo?>">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row contraseña_check">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item ">
                                                            <label for="">Cambiar contraseña <input  id='bmm" + (i + 1) + "' rel='canvas" + (i + 1) + "' type='checkbox' class='squaredThreex fantasma hh' name='check' value='0'></label>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="single-input-item">
                                                    <input type="hidden" name="cliente" value="editar">
                                                    <input type="hidden" name="id_cliente" value="<?php echo $_SESSION['id_cliente']?>">
                                                    <button class="sqr-btn">Guardar datos editados</button>
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


