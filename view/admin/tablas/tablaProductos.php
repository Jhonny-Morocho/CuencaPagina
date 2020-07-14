
   <!-- Main content -->
   <section class="content">

  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Productos</h3>
          
        </div>
        <div class="box-body">
            <form class="text-center " style="color: #757575;" method="get" action="../view/admin/listarProductos.php">
            
            <div class="form-row">
                
                <div class="col-lg-3">
                    <!-- First name -->
                    <div class="md-form">
                        <!-- <i class="fas fa-search" aria-hidden="true"></i> -->
                        <?php if(@$_GET['busqueda']) {?>
                            <input class="form-control form-control-sm "  name="busqueda"  type="text" placeholder="Search"
                            aria-label="Search" value="<?php echo $_GET['busqueda']  ?>">
                        <?php }else{ ?>
                          <input class="form-control form-control-sm "  name="busqueda"  type="text" placeholder="Search"
                            aria-label="Search">
                        <?php }?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <!-- First name -->
                    <div class="md-form">
                      <?php if(@$_GET['genero']){?>                            
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
                        <select class="form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="genero" >
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
                <div class="col-lg-3">
                    <!-- Last name -->
                    <div class="md-form">
                    <?php if(@$_GET['remixer']){?>
                        <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="remixer">
                              <!-- <option value="" >REMIXER</option> -->
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
                  
                </div><div class="col-lg-3">
                    <div class="form-group">
                      <button class="btn bg-olive margin" type="submit">Buscar</button>
                    </div>
                </div>
                
            </div>
          </form>
          </div>
          <table id="example2cxxxxxc"  class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
              <th>Fecha</th>
              <th>Titulo</th>
              <th>Artista</th>
              <th>Genero</th>
              <th>Bpm</th>
              <th>Editor</th>
              <th>Precio</th>
              <th>Play</th>
              <th>Archivo</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
                    <?php
                    //function descargar($ubicacionArchivo){
                      if (isset($_GET['download_csv'])) {
                        $file_example = $_GET['download_csv'];
                        if (file_exists($file_example)) {
                            header('Content-Description: File Transfer');
                            header('Content-Type: text/html; charset=iso-8859-1');
                            header('Content-Type: text/html; charset=utf-8');
                            header('Content-Type: text/plain'); // plain text file
                            header('Content-Type: image/jpeg'); // JPG picture
                            header('Content-Type: application/zip'); // ZIP file
                            header('Content-Type: application/pdf'); // PDF file
                            header('Content-Type: audio/wav'); // Audio MPEG (MP3,...) file
                            header('Content-Type: audio/mp3'); // Audio MPEG (MP3,...) file
                            header('Content-Type: application/x-shockwave-flash'); // Flash animation
                            header('Content-Disposition: attachment; filename='.basename($file_example));
                            header('Content-Transfer-Encoding: binary');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate');
                            header('Pragma: public');
                            header('Content-Length: ' . filesize($file_example));
                            ob_clean();
                            flush();
                            //readfile($file_example);
                            exit;
                        }
                        else {
                            echo 'Archivo no disponible.';
                        }
                      }
                    //}
                    
                      $productos=ModeloProducto::sql_lisartar_productos();
                      
                      //print_r($productos);
                      foreach($productos as $key=>$value){
                      echo"<tr>";
                      
                          echo'<td>'.$value['fecha'].'</td>';
                          echo'<td>'.$value['nombrePista'].'</td>';
                          echo'<td>'.$value['artista'].'</td>';
                          echo'<td>'.$value['genero'].'</td>';
                          echo'<td>'.$value['bpm'].'</td>';
                          echo'<td>'.$value['apodo'].'</td>';
                          echo'<td><span>$ '.$value['precio'].'</span></td>';
                          
                          echo'<td>
                                    <div class="bontIconosProducto reproducirContenedor" data-demo="../editDemos/'.$value['demo'].'" ><i class="fa fa-fw fa-play-circle"></i></div>
                              </td>';
                          echo'<td><a download  href="../editCompletos/'.$value['remixCompleto'].'?download_csv=../editCompletos/'.$value['remixCompleto'].'" class="bontIconosProducto"><i class="fa fa-fw fa-cloud-download"></i></a></td>';
                          echo'<td>
                                    <div class="bontIconosProducto editProducto"  data-toggle="modal" data-target="#modalEditarProducto"  
                                        data-idProducto="'.$value['id'].'"  data-idProveedor="'.$value['idProveedor'].'"  
                                        data-idGenero="'.$value['idGenero'].'"   data-bpm="'.$value['bpm'].'"  
                                        data-precio="'.$value['precio'].'" data-titulo="'.$value['nombrePista'].'" data-artista="'.$value['artista'].'"  >

                                        <i class="fa fa-fw fa-pencil">
                                        </i>
                                    </div>
                                </td>';
                          echo'<td><div class="bontIconosProducto deleteProducto"  data-id="'.$value['id'].'"   
                                                                                  data-demo="'.$value['demo'].'"   
                                                                                  data-remixCompleto="'.$value['remixCompleto'].'" >
                                          <i class="fa fa-fw fa-trash"></i>
                                      </div>
                                  </td>';
                        echo"</tr>"; 
                      }
                    ?>
                    </tfoot>
                  </table>
                  
                    <!-- ===================================Reproductor de Audio=================== -->
                    <?php require'../../jPlayer Flat Audio Theme/reproductor.php';  ?>
               <!-- end div audio-->
        <!-- /.box-body -->
      </div>
    </div>
  </div> 
  <!-- /.row -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

