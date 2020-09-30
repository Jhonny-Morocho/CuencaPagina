
<?php

ini_set('display_errors', 'On');
session_start();
require'model/conexion.php';
require'model/mdlProveedor.php';
require'model/mdlGenero.php';
require'model/mdlClienteProducto.php';
require'model/mdlCarrusel.php';
require'model/mdlLogosDjs.php';
//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================
//=============================creacion de objetos IMPOTATANTE SIEMPRE VA LA CABEZERA PARA QUE EL HEADER NO ME DE PROBLEMA CON DIRECCIONAMIENTO==========================

require_once 'controler/ctrTemplateInicio.php';
$plantilla= new ControladorPlantillaInicio();
$plantilla->ctr_header();
$plantilla->ctr_slider();



?>


<?php 
    $top=ModeloClienteProducto::sqlListarTop(); 
    // print_r($top);
    if( isset($_GET['idProducto'])){
        $cont_2=0;
        foreach($top as $key=>$value){
            if($cont_2<7 && $_GET['idProducto']==$value['id']){
            
                echo'
                
                <!-- News jumbotron -->
                <div class=" text-center hoverable p-4">
                
                  <!-- Grid row -->
                  <div class="row">
                
                    <!-- Grid column -->
                    <div class="col-md-5 offset-md-1 mx-2 my-2">
                
                      <!-- Featured image -->
                      <div class="view overlay">
                        <img src="../../img/proveedores/'.$value['img'].'" class="img-fluid" alt="Sample image for first version of blog listing">
                        <a>
                          <div class="mask rgba-white-slight"></div>
                        </a>
                      </div>
                
                    </div>
                    <!-- Grid column -->
                
                    <!-- Grid column -->
                    <div class="col-md-5 text-md-left ml-1 mt-3">
                
                      <h4 class="h4 mb-4">  Track Name</h4>
                
                      <p class="font-weight-normal">
                        <span class="btn-floating btn-lg btn-default">
                            <i class="fas fa-play mr-2 reproducirContenedor " style="cursor:pointer; color:#fff; font-size:20px " data-demo="../../editDemos/'.$value['demo'].'" style="cursor:pointer"></i>
                        </span>
                
                         '.$value['nombrePista'].' - '.$value['apodo'].'
                      </p>
            
                        <span class="btn-floating btn-primary buy"   data-id="'.$value['id'].'" 
                                data-nombre="'.$value['nombrePista'].'" 
                                data-precio="'.$value['precio'].'">
                            <i class="fas fa-cart-plus"></i>
                            
                        </span>
                        <span class="badge badge-primary pt-1 pb-1 " style="font-size:16px">
                            
                                $ '.$value['precio'].'
                            
                        </span>
                    </div>
                    <!-- Grid column -->
                
                  </div>
                  <!-- Grid row -->
                
                </div>
                <!-- News jumbotron -->
    
    
    
         
            ';
            }
            $cont_2++; 
        }
    }else{
        echo '<div class="alert alert-info mt-5 text-center" role="alert">
                This product does not exist
            </div>';
    }



?>


<?php
$plantilla->sliderLogosDj();
$plantilla->ctr_footer();
$plantilla->reproductorAudio();
$plantilla->toTop();
?>

