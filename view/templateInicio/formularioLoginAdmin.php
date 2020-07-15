

<div class="row d-flex justify-content-center">
    <div class="col-lg-4 contenedorLogin">
            <!-- Material form login -->
            <div class="card ">

                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Sign in</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-4">

                        <!-- Form -->
                        <form class="text-center" style="color: #757575;"  method="post" action="../../controler/ctrProveedor.php" id="login-admin">
                                <!-- Email -->
                                <div class="md-form">
                                    <input type="email" id="materialLoginFormEmail" class="form-control" required="" name="inputEmail">
                                    <label for="materialLoginFormEmail" >E-mail</label>
                                </div>

                                <!-- Password -->
                                <div class="md-form">
                                    <input type="password" id="id_password_login" class="form-control" name="inputPassword" required="" maxlength="20">
                                    <label for="materialLoginFormPassword">Password</label>
                                </div>

                                <div class="d-flex justify-content-around">
                                    <div>
                                    <!-- Remember me -->
                                    <div class="form-check">
                                        <div class="alertConfirmacion"></div>
                                    </div>
                                    </div>
                                </div>
                                <input type="hidden" name="Proveedor" value="loginAdmin">
                                <!-- Sign in button -->
                                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>
                        </form>
                    </div> <!--end card body-->
            </div><!-- end card main -->
    </div> <!-- endl-col-lg -->
</div> <!-- end row -->
