<!--Modal: Login / Register Form-->
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Modal cascading tabs-->
      <div class="modal-c-tabs">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
              Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
              Register</a>
          </li>
        </ul>

        <!-- Tab panels -->
        <div class="tab-content">
          <!--Panel 7-->
          <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

            <!--Body-->

              <form action="../../controler/ctrCliente.php" method="post" id="login-cliente">
                <div class="modal-body mb-1">
                  <div class="md-form form-sm mb-5">
                    <i class="fas fa-envelope prefix"></i>
                    <input type="email" id="modalLRInput1" class="form-control form-control-sm validate" required="" name="inputEmailCliente" placeholder="Your Email">
                    
                  </div>

                  <div class="md-form form-sm mb-4">
                    <i class="fas fa-lock prefix"></i>
                    <input type="password" id="modalLRInput19" class="form-control form-control-sm validate" maxlength="20" required="" name="inputPasswordCliente" placeholder="Your Password">
               
                  </div>

                  <div class="md-form form-sm mb-4">
                    <div class="smsEsperaLogin"></div>
                  </div>
         
                  <div class="text-center mt-2">
                    <button class="btn btn-info">Log in <i class="fas fa-sign-in ml-1"></i></button>
                  </div>
                </div>
              
                <!--Footer-->
                <div class="modal-footer">
                  <!-- <div class="options text-center text-md-right mt-1">
                    <p>Not a member? <a href="#" class="blue-text">Sign Up</a></p>
                    <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                  </div> -->
                  <input type="hidden" name="Cliente" value="loginCliente">
                  <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                </div>
              </form>
          </div>
          <!--/.Panel 7-->
          <!-- ===============FORM REGISTRAR CLIENTE ========================-->
          <!-- ===============FORM REGISTRAR CLIENTE ========================-->
          <!-- ===============FORM REGISTRAR CLIENTE ========================-->
          <!--Panel 8-->
          <div class="tab-pane fade" id="panel8" role="tabpanel">

            <!--Body-->

            <form action="../../controler/ctrCliente.php" method="post" id="registro-cliente">
              <div class="modal-body">


                <div class="md-form form-sm mb-5">
                  <!-- <i class="fas fa-envelope prefix"></i> -->
                  <i class="fas fa-user prefix"></i>
                  <input type="text" maxlength="20" id="idRegistroName" class="form-control form-control-sm validate" required="" name="inpuNameCliente" placeholder="Your Name">
                
                </div>

                <div class="md-form form-sm mb-5">
                  <i class="fas fa-user prefix"></i>
                  <input type="text" id="idRegistroLastName" maxlength="20" class="form-control form-control-sm validate" required="" name="inputApellidoCliente" placeholder="Your Laste Name">
                 
                </div>

                <div class="md-form form-sm mb-5">
                  <i class="fas fa-envelope prefix"></i>
                  <input type="email" id="modalLRInput12"  class="form-control form-control-sm validate" required="" name="inputEmailCliente" placeholder="Your Email">
                 
                </div>

                <div class="md-form form-sm mb-5">
                  <i class="fas fa-lock prefix"></i>
                  <input type="password" id="modalLRInput13" maxlength="20" class="form-control form-control-sm validate" name="inputPasswordCliente" required="" placeholder="Your Password">
                 
                </div>

                <div class="md-form form-sm mb-5">
                  <div class="smsEspera"></div>
                </div>

                <div class="text-center form-sm mt-2">
                <input type="hidden" name="Cliente" value="addCliente">
                  <button class="btn btn-info" type="submit">Sign up <i class="fas fa-sign-in ml-1"></i></button>
                </div>

              </div>
            </form>
   
            <!--Footer-->
            <div class="modal-footer">
              <!-- <div class="options text-right">
                <p class="pt-1">Already have an account? <a href="#" class="blue-text">Log In</a></p>
              </div> -->
              <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!--/.Panel 8-->
        </div>

      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login / Register Form-->

<!-- <div class="text-center">
Siver para llamar al modal
  <a href="" class="btn btn-default btn-rounded my-3" data-toggle="modal" data-target="#modalLRForm">Launch
    Modal LogIn/Register</a>
</div> -->