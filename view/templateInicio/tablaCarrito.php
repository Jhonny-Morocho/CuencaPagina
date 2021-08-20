

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn" style="margin-top: 50px;">
      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Tu Carrito</h2>
      <!--Grid row-->

      <div class="row" >
        <!--Grid column-->
        <div class="col-md-7 mb-4" >
          <!--Card-->
          <div class="card">
            <!--Card content-->
        
            <form class="card-body needs-validation" 
                  novalidate 
                  method="post"
                  ref="formFactura"
                  id="formularioFactura"
                  @submit="checkForm">
              <!--Grid row-->
              <div class="row">
                <!--Grid column-->
          
                <div class="col-md-6 mb-2">
                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" 
                            v-model="nombre"
                            id="firstName"
                            class="form-control">
                    <label for="firstName" class="">nombre: </label>
                    <span class="text-danger" v-if="!nombre">El campo nombre es requerido *</span>
                    <br>
                    <span class="text-danger" v-if="soloTexto(nombre)">El campo solo admite letras *</span>
                    <br>
                    <span class="text-danger" v-if="longitudCadena(nombre,20)">El campo no debe exeder de los 20 caracteres *</span>
                  </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--lastName-->
                  <div class="md-form">
                    <input type="text" 
                          maxlength="50"
                          id="lastName"
                          pattern="[a-zA-Z ]{2,254}"
                          v-model="apellido"
                          class="form-control">
                    <label for="lastName" class="">Apellidos:</label>
                    <span class="text-danger" v-if="!apellido">El campo Apellido es requerido *</span>
                    <br>
                    <span class="text-danger" v-if="soloTexto(apellido)">El campo solo admite letras *</span>
                    <br>
                    <span class="text-danger" v-if="longitudCadena(apellido,20)">El campo no debe exeder de los 20 caracteres *</span>
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->


              <!--email-->
              <div class="md-form mb-5">
                <input type="email" 
                       class="form-control" 
                       v-model="correo"
                       id="email">
                <label for="email" class="">Correo de facturación:</label>
                <span class="text-danger" v-if="!correo">El campo correo es requerido *</span>
                <br>
                <span class="text-danger" v-if="!validCorreo(correo) && correo!=''">El correo no es valido *</span>
              </div>

              <!--address-2-->
              <div class="md-form mb-5">
                <input type="text" 
                        class="form-control" 
                        id="address-2"
                        v-model="direccion">
                <label for="address-2" class="">Dirección:</label>
                <span class="text-danger" v-if="!direccion">El campo dirección es requerido *</span>
                <br>
                <span class="text-danger" v-if="longitudCadena(nombre,50)">El campo no debe exeder de los 50 caracteres *</span>
              </div>

             <!--address-2-->
             <div class="md-form mb-5">
                <input type="text" 
                       id="phone"
                       class="form-control" 
                       v-model="telefono">
                <label for="phone" class="">Teléfono:</label>
                <span class="text-danger" v-if="!telefono">El campo telefono es requerido *</span>
                <br>
                <span class="text-danger" v-if="soloNumeros(telefono)">El campo solo admite numeros *</span>
                <br>
                <span class="text-danger" v-if="longitudCadena(telefono,15)">El campo no debe exeder de los 15 números *</span>
              </div>

              <div class="md-form mb-5">
                <input type="text" 
                        class="form-control"
                        id="document" 
                        v-model="documentoIdentidad">
                <label for="document" class="">Documento de identidad:</label>
                <span class="text-danger" v-if="!documentoIdentidad">El campo documento de indentidad es requerido *</span>
                <br>
                <span class="text-danger" v-if="longitudCadena(documentoIdentidad,20)">El campo no debe exeder de los 20 caracteres *</span>
              </div>

              <div class="opcionPago">
                    <h4>Método de pago</h4>
                    <span class="text-danger" v-if="!metodoPago">El método de pago es requerido *</span>
                  <div class="col-lg-12 form-group">
                        <input type="radio"  class="minimal"  value="tarjeta" v-model="metodoPago">
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-diners-club"></i>
                            <i class="fab fa-cc-discover"></i>
                            <i class="far fa-credit-card"></i>
                            Tarjeta de Crédito/Débito
                    </div>  
                    <div class="col-lg-3 form-group">
                        <input type="radio" class="minimal"  value="paypal" v-model="metodoPago" >
                        <i class="fab fa-cc-paypal"></i> Paypal 
                    </div>
                    <div class="col-lg-3 form-group">
                      <input type="radio" class="minimal"  value="productoCompradoMembresia" v-model="metodoPago">
                        <i class="fas fa-folder"></i> Membresia
                    </div> 
                     <div class="col-lg-3 form-group">
                        <input type="radio"  class="minimal"  value="monedero" v-model="metodoPago">
                        <i class="fas fa-wallet"></i> Monedero
                    </div> 
                </div>
              <hr class="mb-4">
              <button type="submit" id="btn-one" class="btn btn-primary btn-lg btn-block">Continuar con la compra</button>
              
              <!-- <button class="btn btn-primary btn-lg btn-block" type="submit">Continuar con el compra</button> -->
            </form>

            

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-5 mb-4 " id="carritoCompras">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Tu pedido</span>
          </h4>

          <div class="cart-table card">
                <table id="dtBasicExample" class="table  ttable table-hover " cellspacing="0" width="100%">
                    <thead class="black white-text">
                        <tr >
                            <th >#</th>
                            <th >Producto</th>
                            <th >Precio USD</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody v-for="(item,index) in arrayProductos">
                      <tr>
                        <td>{{index + 1}}</td>
                        <td>{{ item.nombreProducto }}</td>
                        <td>{{ item.precio }}</td>
                        <td>
                          <i  class="fa fa-trash deleItemCar" 
                              v-on:click="eliminarProducto(item.idProducto)"
                              aria-hidden="true" >
                          </i>
                        </td>
                      </tr>
                    </tbody >
                </table>

                <!-- ==============cupon de descuento=========== -->
                    <!-- Promo code -->
                        <div class="card p-2 ">
                            <div class="input-group cuponDescuento" >
                                <input type="text" 
                                    class="form-control"
                                    id="inputCupon" 
                                    placeholder="Tienes cupon de descuento" 
                                    aria-label="Recipient's username" 
                                    name="inputCupon"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md waves-effect m-0 BtnaplicarCupon" type="button">Aplicar Cupon</button>
                            </div>
                        </div>

                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items " >
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr class="trTotalPagar">
                                            <td>Total </td>
                                            <h4>
                                                <td class="total-amount"> <strong>$ <span id="total">0</span></strong></td>
                                            </h4>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!-- end cupon de descuento-->
                </div>
         </div>  
          <!-- Cart -->

        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->


<style>
.md-form .form-control {
    color: #212529 !important;
}
main{
  background-color: white!important;
}




</style>


<!-- Frame Modal Bottom -->
<div class="modal fade top " id="modalInfoTarjeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-frame and then add class .modal-bottom (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-frame modal-top" role="document">


    <div class="modal-content">
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

          <p class="pt-3 pr-2"style="font-size: 30px;"><i class="fas fa-info-circle"></i> <b>Si su método de pago es Tarjeta, por favor  los nombres apellidos, identificación y correo de la factura deben coincidir con la información de la tarjeta de crédito que se esta usando.</b>
          </p>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Frame Modal Bottom -->


