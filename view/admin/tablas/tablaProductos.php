
   <!-- Main content -->
   <section class="content">

  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Productos</h3>
          
        </div>

        <?php 

        // =============EXPORTAMOS EL REPRODUCTOR=================
        //require'../../MediaElement/mediaElement.php';
        
        ?>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2"  class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
              <th>Fecha</th>
              <th>Titulo</th>
              <th>Artista</th>
              <th>Genero</th>
              <th>Bpm</th>
              <th>Editor</th>
              <th>Precio</th>
              <th>Acciones</th>
              <th>Archivo</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>

                <!-- <div class="players" id="player2-container"> -->
                 
<!-- 
                    <div class="bontIconosProducto reproducirContenedor" data-demo="../editDemos/Rossy War - Mujer Solitaria (intro Outro) Mixsao Dj - 102 Bpm.mp3" ><i class="fa fa-fw fa-play-circle"></i></div>';
                    <div class="bontIconosProducto reproducirContenedor" data-demo="../editDemos/Sech Ft Darell - Otro Trago - Romax $ EditioN - 88Bpm.mp3" ><i class="fa fa-fw fa-play-circle"></i></div>
              
                     -->
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

