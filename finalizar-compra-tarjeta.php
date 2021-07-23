<?php
ini_set('display_errors', 'On');
ini_set('session.cache_expire', 600);
ini_set('session.gc_maxlifetime', 36000);
ini_set('session.cookie_lifetime',36000);

session_cache_expire(600);
session_set_cookie_params(36000);

session_start();
//si no existe session no puede entrar
if (!isset($_SESSION['datosOrden'])) {
  header('location: index.php');
}
require'model/conexion.php';

require'model/mdlProveedor.php';
 //require'model/conexion.php';

 $datos=json_decode(json_encode(@$_SESSION["datosOrden"]), true);

 //Dirección a BotónPagos con los datos de la orden
 $url = 'https://portal.botonpagos.com/api/datafast/setOrder?'.http_build_query($datos);

 //Consulta vía CURL
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
     'code: 607ef3bf6edfe'//ID provisto por BotónPagos
 ));

 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $responseData = curl_exec($ch);


 //Si existe un error de conexión
 if(curl_error($ch)){
     echo curl_error($ch);
 }

 curl_close($ch);
 //Paso a array los datos obtenidos en Json
 $responseData = json_decode($responseData, true);

?>
    <div class="container " style="margin-top: 150px;">
      <div class="row ">
          <div class="col-3">

            <ul class="list-group">
                <li class="list-group-item"><b>Número de pedido:</b> <br> <?php echo $datos['order_id'] ?></li>
                <li class="list-group-item"><b>Fecha:</b><br> <?php echo $datos['date'] ?></li>
                <li class="list-group-item"><b>
                    Total USD: </b>$<?php echo ($datos['subtotal0']-0.30) ?>
                    <br>
                    +$ 0.30<span style="font-size: 15px;" class="text-primary"> Costo por uso del servicio </span>=<span class="text-success font-weight-bold">$<?php echo $datos['total']?></span>
                </li>
                <li class="list-group-item"><b>Nombre del cliente:</b><br><?php echo $datos['first_name'] ." ".$datos['last_name']  ?></li>
                <li class="list-group-item"><b>Correo cliente:</b> <br> <?php echo $datos['email']  ?></li> 
            </ul>
          </div>
        <div class="col-9">
            <!-- Llamo al Botón de Pagos en mi página -->
             <iframe src="https://portal.botonpagos.com/api/datafast/botonV3/<?= $responseData['code'] ?>" width="100%" style="height: 766px; border: none;"></iframe> 
        </div>
      </div>
    </div>

<?php
require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
$plantilla->ctr_footer();



?>
