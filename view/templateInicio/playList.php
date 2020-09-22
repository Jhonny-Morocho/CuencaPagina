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