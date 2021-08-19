



<div  id="carritoCompras">

  <div class="song__item song__th ">
      <div class="song__like"></div>
      <div class="song__title cabezeraTitle">COVER</div>
      <div class="song__artist">TITLE</div> 
      <div class="song__album">GENERO</div> 
      <div class="song__date">REMIXER</div>
      <div class="song__duration">DATE</div>
      <div class="song__buy ml-2">BUY</div>
  </div>
  
  
  <!-- end hader tabla -->
  <div>
  
    <?php foreach (Pagination::show_rows("id") as $row): ?>
      <?php  $banderaError=false; if( $row['apodo']!== 'Error: vacío' ){ ?>
      <div class="song__item  reproducirContenedor"  data-demo="../../editDemos/<?php echo $row['demo']?>">
          <?php  
          //caratula o logos
              $imagen="";
              if ($row['caratula']=="") {
                  echo '
                  
                        <img src="../../img/proveedores/'.$row["img"].'" 
                        class="rounded float-left ml-1 mr-1" alt="..." width="90px" height="90px"> 
                      ';
              }else{
                  echo '<img src="../../img/caratulas/'.$row["caratula"].'" 
                      class="rounded float-left ml-1 mr-1" alt="..." width="90px" height="90px">  ';
              }
          ?>
  
  
          <div class="song__title">
              <div class="row">
                <div class="col-xl-12">
                  <span style="font-weight: bold;" class="nombrePista"><?php echo $row['nombrePista'] ?></span>
                </div>
                <div class="col-xl-12">
                
                  <span class="nombreArtista"><?php echo $row['artista'] ?></span> 
                </div>
              </div>
          </div>
  
          <div class="song__album"><?php echo $row['genero'] ?></div> 
          <div class="song__date"><?php echo $row['apodo'] ?></div>
          <div class="song__duration" title="<?php echo $row['fecha'] ?>">
              <?php  
              date_default_timezone_set('America/Guayaquil');
              $fecha_actual=date("Y-m-d");
              $date1 = new DateTime($row['fecha']);
              $date2 = new DateTime($fecha_actual);
              $diff = $date1->diff($date2);
                if ($diff->days==0) {
                  echo 'hoy';
                }else{
                  echo $diff->days . ' days';
                }
                ?>
          </div>

          <div class="song__buy" >
              <i  v-on:click="addCarrito"
                    class="fas fa-cart-plus song__like ml-2 mr-2"
                    data-id="<?php echo $row['id']?>" 
                    data-nombre="<?php echo $row['nombrePista']?>" 
                    data-precio="<?php echo $row['precio']?>">
              </i>
                      <?php echo '$ '.$row['precio'] ?>
            </div>
      </div>
      <?php }else{
                  echo '<div class="alert alert-primary" role="alert">
                          No existe resultado para la cadena de busqueda 
                      </div>';
                  $banderaError=true;
              } ?>	
    <?php endforeach; ?>
  </div>
  
</div>





<!-- hader tabla -->


<style>

/* .playIcono{
display: block;
} */
.song__item.reproducirContenedor {
font-size: 14px;
}
.song__item.reproducirContenedor.active {
background: #f07315  !important;


}


</style>