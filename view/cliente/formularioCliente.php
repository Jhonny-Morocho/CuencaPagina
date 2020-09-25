<style>

  .view {
    height: 100%;
  }

  @media (max-width: 740px) {

    .view {
      height: 1000px;
    }
  }
  @media (min-width: 800px) and (max-width: 850px) {

    .view {
      height: 600px;
    }
  }

  
  
  .card {
    background-color: rgba(126, 123, 215, 0.2);
  }

  .md-form label {
    color: #ffffff;
  }

  h6 {
    line-height: 1.7;
  }
 
.contenedorFormularioLogin{

}
</style>


  <!-- Navbar -->
  <!-- Full Page Intro -->
  <div class="view " style="background-image: url('../../img/fondo.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
      <!-- Content -->
      <div class="container contenedorFormularioLogin">
        <!--Grid row-->
        <div class="row mt-5">
          <!--Grid column-->
          <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left">
            <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">LOGIN </h1>
            <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
            <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">Con tu cuenta podrás acceder a todos nuestros productos, beneficios y ofertas exclusivas.
            Espero que lo que encuentres aquí te ayude a construir el camino que tú quieres en el mundo del deejay.  <br>
            Nosotros nos seguiremos esforzando al máximo para poder ofrecerte siempre lo mejor <br>
            ¡!!!Un Abrazo!!! 
            #TEAMLATINEDIT</h6>
            <a class="btn btn-indigo btn-rounded wow fadeInLeft" data-wow-delay="0.3s" href="../../registro.php">CREATE ACCOUNT</a>
          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">
            <!--Form-->
            <form action="../../controler/ctrCliente.php" method="post" id="login-cliente">     
                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                    <div class="card-body">
                        <!--Header-->
                        <div class="text-center">
                            <h3 class="white-text font-weight-bold">
                                <i class="fa fa-user white-text"></i> LOGIN:</h3>
                            <hr class="hr-light">
                        </div>
                        <!--Body-->
                        <div class="md-form">
                            <i class="fa fa-envelope prefix white-text active"></i>
                            <input type="email" id="form2" class="white-text form-control" name="inputEmailCliente" id="materialLoginFormEmail" required>
                            <label for="materialLoginFormEmail" class="active">Your email</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-lock prefix white-text active"></i>
                            <input type="password" id="form4" class="white-text form-control"  name="inputPasswordCliente" required="" maxlength="20">
                            <label for="materialLoginFormPassword">Your password</label>
                        </div>

                        <div class="md-form form-sm mb-4">
                          <div class="smsEsperaLogin"></div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-indigo btn-rounded">Sign up</button>
                            <hr class="hr-light mb-3 mt-4">
                        </div>
                            <!-- Register -->

                        <div class="md-form">
                          <center>
                            <a href="" style="color: white;" data-toggle="modal" data-target="#modalLoginAvatar">
                              <p  style="color: white;">Not a member?
                              </p>
                            
                            </a>
                          </center>
                        </div>

                        <input type="hidden" name="Cliente" value="loginCliente">
                    </div>
                </div>
            </form>
            <!--/.Form-->
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Content -->
    </div>
    <!-- Mask & flexbox options-->
  </div>
  <!-- Full Page Intro -->

<!-- 
  ======================= RECUPERAR MI CONTRASEÑA MODAL ================================= -->

  <!--Modal: Login with Avatar Form-->
<div class="modal fade" id="modalLoginAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
    <!--Content-->
    <div class="modal-content">


      <!--Body-->
      <form action="../../controler/ctrCliente.php" method="post" id="idFormularioRecuperarPassword">
        <div class="modal-body text-center mb-1">
  
          <h5 class="mt-1 mb-4">Recover my password</h5>
  
          <div class="md-form ml-0 mr-0">
            <input type="email" type="text"  class="form-control form-control-sm validate ml-0" style="color: black !important;"  name="inputEmailCliente" value="jhonnymichaeldj2011@hotmail.com">
            <label data-error="wrong" data-success="right"  class="ml-0" style="color: black;">Enter email</label>
          </div>
          <input type="hidden" name="Cliente" value="recuperarContraseña">
          <div class="text-center mt-4">
            <button class="btn btn-cyan mt-1">Enviar <i class="fas fa-sign-in ml-1"></i></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>

    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login with Avatar Form-->

