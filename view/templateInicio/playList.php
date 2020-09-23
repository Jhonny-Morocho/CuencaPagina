  <div class="song__item song__th ">

                        <div class="song__like"></div>


                        <div class="song__buy">BUY</div>
                        <div class="song__title cabezeraTitle">TITLE</div>
                        <div class="song__artist">ARTIST</div>
                        <div class="song__album">GENERO</div>
                        <div class="song__date">REMIXER</div>
                        <div class="song__duration">DATE</div>
                    </div>

              
                    <?php foreach (Pagination::show_rows("id") as $row): ?>
                      <?php  $banderaError=false; if( $row['apodo']!== 'Error: vacío' ){ ?>
                        <div class="song__item reproducirContenedor"  data-demo="../../editDemos/<?php echo $row['demo']?>">
                            <div class="song__buy" ><i class="fas fa-cart-plus song__like  mr-1  buy" data-id="<?php echo $row['id']?>" data-nombre="<?php echo $row['nombrePista']?>" data-precio="<?php echo $row['precio']?>"></i><?php echo ' $ '.$row['precio'] ?></div>
                            <div class="song__title"><?php echo $row['nombrePista'] ?></div>
                            <div class="song__artist"><?php echo $row['artista'] ?></div>
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
                        </div>
                    <?php }else{
                                    echo '<div class="alert alert-primary" role="alert">
                                            No existe resultado para la cadena de busqueda 
                                        </div>';
                                    $banderaError=true;
                                } ?>	
                    <?php endforeach; ?>

                    <style>

                      /* .playIcono{
                        display: block;
                      } */
                      .song__item.reproducirContenedor.active {
            background: #2196f3  !important;


/* 
   margin: 0;
  

     content: ''; 
     position: absolute; 
     height: 15px;
    top: 12.5px;
  
     align-items: center;
   flex-direction: row; 
    width: 15px;
     left: 20px;   
    background: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAw%0D%0AL3N2ZyI+CgogPGc+CiAgPHRpdGxlPmJhY2tncm91bmQ8L3RpdGxlPgogIDxyZWN0IGZpbGw9Im5v%0D%0AbmUiIGlkPSJjYW52YXNfYmFja2dyb3VuZCIgaGVpZ2h0PSI0MDIiIHdpZHRoPSI1ODIiIHk9Ii0x%0D%0AIiB4PSItMSIvPgogPC9nPgogPGc+CiAgPHRpdGxlPkxheWVyIDE8L3RpdGxlPgogIDxwYXRoIGZp%0D%0AbGw9IiNmZmZmZmYiIGlkPSJzdmdfMiIgZD0ibTQuOTkzLDIuNDk2Yy0wLjQ3NywtMC4yNzMgLTAu%0D%0AOTkzLC0wLjA0NiAtMC45OTMsMC41MDRsMCwyNmMwLDAuNTUgMC41MTYsMC43NzcgMC45OTMsMC41%0D%0AMDRsMjIuODI2LC0xMy4wMDhjMC40NzgsLTAuMjczIDAuNDQ2LC0wLjcxOSAtMC4wMzEsLTAuOTky%0D%0AbC0yMi43OTUsLTEzLjAwOHoiLz4KICA8cGF0aCBmaWxsPSIjZmZmZmZmIiBpZD0ic3ZnXzMiIGQ9%0D%0AIm00LjU4NSwzMC42MmwwLDBjLTAuOTA0LDAgLTEuNTg1LC0wLjY5NyAtMS41ODUsLTEuNjJsMCwt%0D%0AMjZjMCwtMC45MjMgMC42ODEsLTEuNjIgMS41ODUsLTEuNjJjMC4zMDksMCAwLjYyMSwwLjA4NSAw%0D%0ALjkwNCwwLjI0OGwyMi43OTQsMTMuMDA3YzAuNTU5LDAuMzE5IDAuODc4LDAuODIzIDAuODc4LDEu%0D%0AMzgyYzAsMC41NDggLTAuMzA5LDEuMDM5IC0wLjg0NywxLjM0N2wtMjIuODI2LDEzLjAwOWMtMC4y%0D%0AODIsMC4xNjEgLTAuNTk0LDAuMjQ3IC0wLjkwMywwLjI0N3ptMC40MTUsLTI2Ljk2OWwwLDI0LjY5%0D%0AOGwyMS42NTUsLTEyLjM0bC0yMS42NTUsLTEyLjM1OHoiLz4KIDwvZz4KPC9zdmc+);
     background-repeat: no-repeat;
     background-size: contain;   */


    
}


                    </style>