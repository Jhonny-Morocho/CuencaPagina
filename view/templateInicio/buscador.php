<form class="text-center "  method="get" action="../../" id="song__input">
        
        <div class="form-row">
            
            <div class="col">
                <!--=================== BUSCADOR ========================-->
                <div class="md-form ">
                    <?php if(@$_GET['busqueda']) {?>
                        <input class="form-control form-control-sm ml-3 w-120"  name="busqueda"  type="text" 
                        placeholder="Buscar por nombre de pista"
                        aria-label="Buscar..." value="<?php echo $_GET['busqueda']  ?>">
                    <?php }else{ ?>
                      <input class="form-control form-control-sm ml-3 w-120"  
                      name="busqueda"  type="text" placeholder="Buscar por nombre de pista"
                        aria-label="Buscar.." maxlength="100">
                    <?php }?>
                </div>
            </div>

            <div class="col ">
                <!-- GENERO -->
                <div class="md-form ">
                  <?php if(@$_GET['genero']){?>
                    <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="genero" >
                        <?php 
                            $genero=ModeloGenero::sql_lisartar_genero();
                            //busca las concidencias con el genero del get
                            foreach ($genero as $key => $value) {
                              if($_GET['genero']==$value['id']){ 
                                echo '<option value="'.$value['id'].'" >'.$value['genero'].'</option>';
                              }
                            }
                            echo '<option value="" >GENERO</option>';
                            foreach($genero as $key=>$value){ ?>
                               <?php if($_GET['genero']!=$value['id']){ ?>
                                <option value="<?php echo$value['id'] ?>" > <?php echo$value['genero'] ?> </option>
                                <?php }?>
                            <?php }?>
                    </select>
                  <?php }else{?>
                    <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="genero" >
                        <option value="" >GENERO</option>
                        <?php 
                            $genero=ModeloGenero::sql_lisartar_genero();
                            foreach($genero as $key=>$value){ ?>
                                <option value="<?php echo$value['id'] ?>" > <?php echo $value['genero'] ?> </option>
                        <?php }?>
                    </select>
                    <?php }?>
                </div>
            </div>

            <div class="col ">
                <!-- REMIXER -->
                <div class="md-form ">
                      <?php if(@$_GET['remixer']){?>
                          <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer " name="remixer">
                                <?php 
                                    $remixer=ModeloProveedor::sql_lisartar_proveedor();
                                    print_r($remixer);
                                    foreach ($remixer as $key => $value) {
                                      if(@$_GET['remixer']==$value['id']){ 
                                        echo '<option value="'.$value['id'].'" >'.$value['apodo'].'</option>';
                                      }
                                    }
                                    echo '<option value="" >EDITOR</option>';
                                    foreach(@$remixer as $key=>$value){ ?>
                                          <?php if(@$_GET['remixer']!==$value['id']){ ?>
                                              <option value="<?php echo$value['id'] ?>" > <?php echo$value['apodo'] ?> </option>
                                             
                                          <?php } ?>
                                    
                                    <?php } ?>
                          </select>
                        <?php }else{ ?>
                        <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="remixer">
                                <option value="" >EDITOR</option>
                                <?php 
                                    $remixer=ModeloProveedor::sql_lisartar_proveedor();
                                    foreach($remixer as $key=>$value){ ?>
                                        <option value="<?php echo$value['id'] ?>" > <?php echo$value['apodo'] ?> </option>
                                        
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