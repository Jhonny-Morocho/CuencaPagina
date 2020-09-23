<h5>BEST SELLERS </h5>
<!-- <h5 ><span class="underline-closing "> BEST SELLERS </span></h5> -->         

<?php 
    $top=ModeloClienteProducto::sqlListarTop(); 

    $cont_2=0;
    foreach($top as $key=>$value){
        if($cont_2<7){
        echo'
        <div class="col-md-12 mb-12">
            <div class="view z-depth-1  imgTop imghvr-zoom-out-left">
                <img src="../../img/proveedores/'.$value['img'].'" class="img-fluid mx-auto" alt="smaple image">
                <figcaption>
                    <ul class="list-unstyled d-flex justify-content-center mt-1 mb-0 text-muted listsaIconosTop">
                        <li>
                            <i class="fas fa-play reproducirContenedor" style="cursor:pointer" data-demo="../../editDemos/'.$value['demo'].'">
                            </i> 
                        </li>
                        <li>
                            <i class="fas fa-cart-plus buy" style="cursor:pointer"  data-id="'.$value['id'].'" 
                                                                                    data-nombre="'.$value['nombrePista'].'" 
                                                                                    data-precio="'.$value['precio'].'">
                            </i> 
                        </li>

                        <li>  
                                <i class="fas fa-share-alt irDemo" style="cursor:pointer"  data-id="'.$value['id'].'" >
                                    
                                </i> 
                        </li>
                    </ul>
                </figcaption>
            </div>
            <h6 class="font-weight-bold topPrecio">$'.$value['precio']. '</h6>
            <small class="text-muted topNombreTema">'.$value['nombrePista'].'</small>
        </div>';
        }
        $cont_2++; 
    }
?>
