<form class="text-center "  method="get" action="../../" id="song__input">
        
        <div class="form-row">
            
            <div class="col">
                <!--=================== BUSCADOR ========================-->
                <div class="md-form  ">
                    <?php if(@$_GET['busqueda']) {?>
                        <input class="form-control form-control-sm ml-3 w-120"  name="busqueda"  type="text" placeholder="Search by track name"
                        aria-label="Search" value="<?php echo $_GET['busqueda']  ?>">
                    <?php }else{ ?>
                      <input class="form-control form-control-sm ml-3 w-120"  name="busqueda"  type="text" placeholder="Search by track name"
                        aria-label="Search" maxlength="100">
                    <?php }?>
                </div>
            </div>

            <div class="col ">
                <!-- First name -->
                <div class="md-form ">
                  <?php if(@$_GET['genero']){?>
                    <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="genero" >
                        
                        <!-- xxx<option value="1" selected>Feedback</option> -->
                        <?php 
                            $genero=ModeloGenero::sql_lisartar_genero();

                            foreach ($genero as $key => $value) {
                              if($_GET['genero']==$value['id']){ 
                                echo '<option value="'.$value['id'].'" >'.$value['genero'].'</option>';
                              }
                            }
                            //print_r($genero);
                            echo '<option value="" >GENER</option>';
                            foreach($genero as $key=>$value){ ?>
                              
                               <?php if($_GET['genero']!=$value['id']){ ?>
                                <option value="<?php echo$value['id'] ?>" > <?php echo$value['genero'] ?> </option>
                                <?php }?>
                            <?php }?>
                    </select>

                  <?php }else{?>
                    <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="genero" >
                        <option value="" >GENER</option>
                        
                        <!--777 <option value="1" selected>Feedback</option> -->
                        <?php 
                            $genero=ModeloGenero::sql_lisartar_genero();
                         
                            foreach($genero as $key=>$value){ ?>
                                <option value="<?php echo$value['id'] ?>" > <?php echo$value['genero'] ?> </option>
                        <?php }?>
                    </select>
                    <?php }?>
                </div>
            </div>

            <div class="col ">
                <div class="md-form ">
                      <?php if(@$_GET['remixer']){?>
                          <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer " name="remixer">
                                <option value="" >REMIXER</option>
                                <?php 
                                    $remixer=ModeloProveedor::sql_lisartar_proveedor();
                                    foreach ($remixer as $key => $value) {
                                      if($_GET['remixer']==$value['id']){ 
                                        echo '<option value="'.$value['id'].'" >'.$value['apodo'].'</option>';
                                      }
                                    }
                                    echo '<option value="" >REMIXER</option>';
                                    foreach($remixer as $key=>$value){ ?>
                                          <?php if($_GET['remixer']!=$value['id']){ ?>
                                              <option value="<?php echo$value['id'] ?>" > <?php echo$value['apodo'] ?> </option>
                                          <?php } ?>
                                    
                                    <?php } ?>
                          </select>
                        <?php }else{ ?>
                        <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="remixer">
                                <option value="" >REMIXER</option>
                                <?php 
                                    $remixer=ModeloProveedor::sql_lisartar_proveedor();
                                    foreach($remixer as $key=>$value){ ?>
                                        <option value=" <?php echo$value['id'] ?> " > <?php echo$value['apodo'] ?> </option>
                                <?php }?>
                          </select>
                        <?php } ?>
                </div>
            </div>
            <div class="col ">
                <div class="md-form  ">
                  <button class="form-control form-control-sm  ml-3 w-60 btnBuscar" type="submit">Buscar</button>
                </div>
            </div>
            
        </div>

      </form>