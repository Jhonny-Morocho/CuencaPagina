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
 
  .smsEspera{
    text-align: center;
  }
</style>


  <!-- Navbar -->
  <!-- Full Page Intro -->
  <div class=" mt-5" style="background-image: url('../../img/FONDO-ABRIL.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
      <!-- Content -->
      <div class="container contenedorFormularioLogin">
        <!--Grid row-->
        <div class="row mt-5">
          <!--Grid column-->
          <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left">
            <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">REGISTRARME </h1>
            <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
            <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">Estaremos muy contento de que formes parte de nuestra plataforma y sobre todo de nuestra comunidad y selecta lista de clientes. 
Latinedit.com, es una plataforma para djs y productores, con un extenso catálogo de edits, remixes y herramientas para ayudar a el dj en el desempeño de su performance o siguiente fiesta.</h6>

          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">
            <!--Form-->
            <form action="../../controler/ctrCliente.php" method="post" id="registro-cliente">     
                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                    <div class="card-body">
                        <!--Header-->
                        <div class="text-center">
                            <h3 class="white-text font-weight-bold">
                                <i class="fa fa-user white-text"></i> REGISTRARME :</h3>
                            <hr class="hr-light">
                        </div>
                        <!--Body-->
                        <div class="md-form">
                            <i class="fa fa-user prefix white-text"></i>
                            <input type="textx" id="form1" class="white-text form-control" name="inpuNameCliente" id="materialLoginFormnNombre" required>
                            <label for="materialLoginName" class="active">Tu Nombre </label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-user prefix white-text"></i>
                            <input type="textx" id="form2" class="white-text form-control" name="inputApellidoCliente" id="materialLoginFormApellido" required>
                            <label for="materialLoginFormApellido" class="active">Tu Apellido</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-envelope prefix white-text active"></i>
                            <input type="email" id="form3" class="white-text form-control" name="inputEmailCliente" id="materialLoginFormEmail" required>
                            <label for="materialLoginFormEmail" class="active">Tu Correo </label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-lock prefix white-text active"></i>
                            <input type="password" id="form4" class="white-text form-control"  name="inputPasswordCliente" required="" maxlength="20">
                            <label for="materialLoginFormPassword">Tu Contraseña</label>
                        </div>

                        <div class="md-form form-sm mb-4">
                          <div class="smsEspera"></div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-indigo btn-rounded">Iniciar Sesión </button>
                            <hr class="hr-light mb-3 mt-4">
                        </div>
                        <input type="hidden" name="Cliente" value="addCliente">
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
