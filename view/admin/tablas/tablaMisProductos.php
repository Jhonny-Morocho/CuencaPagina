<?php 
          ini_set('display_errors', 'On');
          //validacion de campos
  
          
          $respuestaValidacionBuscador=Pagination::validarCamposBuscador(@$_GET['busqueda']);
      

          $where1="  where producto.idProveedor=proveedor.id and
                      producto.idGenero=genero.id and 
                      producto.estado=1  and proveedor.id=".intval(@$_SESSION['id_proveedor']);

          $where2=" where producto.idProveedor=proveedor.id and
          producto.idGenero=genero.id and 
          producto.estado=1  and 
                                   producto.demo LIKE '%".@$_GET['busqueda']."%'
                                 ";
                                 
          

          $whereRemixer=" where producto.idProveedor=proveedor.id and
          producto.idGenero=genero.id and 
          producto.estado=1  and 
                                  proveedor.id=".intval(@$_SESSION['id_proveedor']);
        // 1.Caso solo filtros de genero y remixer sin buscador
        $whereGenero=" where producto.idProveedor=proveedor.id and
             producto.idGenero=genero.id and 
             producto.estado=1  and 
                           genero.id=".intval(@$_GET['genero']);// conviuerrto en numero
          
        // 2.Caso solo filtros de genero y remixer sin buscado    
        $whereRemixerGenero=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                                proveedor.id=".intval(@$_SESSION['id_proveedor'])." and  genero.id=".intval(@$_GET['genero']);

        $whereDemoGenero=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                                genero.id=".intval(@$_GET['genero'])." and   producto.demo LIKE '%".@$_GET['busqueda']."%'   ";
                                
        $whereDemoGeneroRemixer=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                                genero.id=".intval(@$_GET['genero'])." and   proveedor.id=".intval(@$_SESSION['id_proveedor'])." and   producto.demo LIKE '%".@$_GET['busqueda']."%'   ";
        $whereDemoRemixer=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                             proveedor.id=".intval(@$_SESSION['id_proveedor'])." and   producto.demo LIKE '%".@$_GET['busqueda']."%'   ";


        $numeroFilas=30;
        
       
        
      function validarNumeros($numero){

          if (filter_var($numero, FILTER_VALIDATE_INT)) {
              return true;
              //print "<p>Ha escrito un número entero: $numero.</p>\n";
          } else {
            return false;
              //print "<p>NO ha escrito un número entero: $numero.</p>\n";
          }

      }
     


      //echo "VALIDACION : ".(validarNumeros(@$_GET['genero']));
      $validacionIdGenero=validarNumeros(@$_GET['genero']);
      $validacionIdRemixer=validarNumeros(@$_SESSION['id_proveedor']);
      $validacionIdPaginacion=validarNumeros(@$_GET['page']);
      //echo "VALIDACIONPaginacion : ".(validarNumeros(@$_GET['page']));
      
      $page = (validarNumeros(@$_GET['page'])=="true") ? $_GET["page"] : 1;



        $data="";

        
        //1. Caso//  buscador= vacio; genero=vacio; remixer=vacio
        if(!@$_GET['busqueda'] && !@$_GET['genero'] && !@$_SESSION['id_proveedor'] ){// primer caso// no necesita validaciion x q la data es vacia
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $where1, null , 30,'inicio');
          //echo "caso 1";
        }

        //2.Caso// buscador=data; genero=vacio; remixer=vacio
          if(@$_GET['busqueda'] && !@$_GET['genero'] && !@$_SESSION['id_proveedor'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE"){
            //echo "caso 2";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $where2, null , 30,'todo');
          }

        //3.Caso// buscador=data; genero=data; remixer=vacio;
        if(@$_GET['busqueda'] && @$_GET['genero'] && !@$_SESSION['id_proveedor'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE" && validarNumeros(@$_GET['genero'])=="TRUE" ){
          //echo "caso 3";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereDemoGenero, null , 30,'todo');
          }

        //4.Caso// buscador=data; genero=data; remixer=data;
        if(@$_GET['busqueda'] && @$_GET['genero'] && @$_SESSION['id_proveedor'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE" && validarNumeros(@$_GET['genero'])=="TRUE" && validarNumeros(@$_SESSION['id_proveedor'])=="TRUE" ){
          //echo "caso 4";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereDemoGeneroRemixer, null , 30,'todo');
          }
        //5.Caso// buscador=data;genero=vacio; remixer=data;
        if(@$_GET['busqueda'] && !@$_GET['genero'] && @$_SESSION['id_proveedor'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE"  && validarNumeros(@$_SESSION['id_proveedor'])=="TRUE"){
          //echo "caso 5";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereDemoRemixer, null , 30,'todo');
        }

        //6.Caso// buscador=vacio;genero=data; remixer=data;
        if(!@$_GET['busqueda'] && @$_GET['genero'] && @$_SESSION['id_proveedor'] && validarNumeros(@$_GET['genero'])=="true" && validarNumeros(@$_SESSION['id_proveedor'])=="true"){
          echo "caso 6";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereRemixerGenero, null , 30,'todo');
        }

        //7.Caso// buscador=vacio;genero=vacio; remixer=data;
          if(!@$_GET['busqueda'] && !@$_GET['genero'] && @$_SESSION['id_proveedor']  && validarNumeros(@$_SESSION['id_proveedor'])=="TRUE"){
            //echo "caso 7";
            Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereRemixer, null , 30,'todo');
        }

        //8.Caso// buscador=vacio;genero=data; remixer=vacio;
          if(!@$_GET['busqueda'] && @$_GET['genero'] && !@$_SESSION['id_proveedor'] && validarNumeros(@$_GET['genero'])=="TRUE"){
            //echo "caso 8";
            Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereGenero, null , 30,'todo');
        }
        
          try {
            //code...
            $data = Pagination::data();// si exite un error q reenvie al index
          } catch (\Throwable $th) {
            header('Location: ./');
          }
          
  ?> 
   
   
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Productos</h3>
          <div id="myElement2"></div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form class="text-center " style="color: #757575;" method="get" action="../view/admin/listarMisProductos.php">
            <div class="form-row">
                <div class="col-lg-4">
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
                <div class="col-lg-4">
                    <!-- First name -->
                    <div class="md-form">
                      <?php if(@$_GET['genero']){?>                            
                            <!-- xxx<option value="1" selected>Feedback</option> -->
                        <select class=" form-control form-control-sm ml-3 w-60 selectGeneroRemixer" name="genero" >
                         
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
                </div><div class="col-lg-4">
                    <div class="form-group">
                      <button class="btn bg-olive margin" type="submit">Buscar</button>
                    </div>
                </div>
            </div>
          </form>
              <table id=""  class="table table-bordered table-striped table-responsive ">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Caratula</th>
                    <th>Titulo</th>
                    <th>Artista</th>
                    <th>Genero</th>
                    <th>Bpm</th>
                    <th>Editor</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                    <th>Archivo</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody>

                <?php foreach (Pagination::show_rows("id") as $row): ?>
                    <?php  $banderaError=false; if( $row['apodo']!== 'Error: vacío' ){ ?>
                        <tr>
                          <th><?php echo $row['fecha']?></th>
                          <th >
                            <?php
                              if ($row['caratula']=="") {
                                echo'  
                                <div class="attachment-block ">
                                  <img class="attachment-img" src="../img/proveedores/'.$row["img"].'" alt="Image" style="width: 60px;height: 60px;">
                                    <span class="editProductoImg" aria-hidden="true" data-toggle="modal" data-target="#modalEditarCaratulaProducto" data-name="'.$row["img"].'" data-id="'.$row["id"].'">
                                      <i class="fa fa-fw fa-pencil-square-o"></i>
                                    </span>
                                </div>';

                              }else{
                                echo'  
                                <div class="attachment-block ">
                                  <img class="attachment-img" src="../img/caratulas/'.$row["caratula"].'" alt="Image" style="width: 60px;height: 60px;">
                                    <span class="editProductoImg" aria-hidden="true" data-toggle="modal" data-target="#modalEditarCaratulaProducto" data-name="'.$row["img"].'" data-id="'.$row["id"].'">
                                      <i class="fa fa-fw fa-pencil-square-o"></i>
                                    </span>
                                </div>';

                              }
                              # code...

                  
                            ?>
                          </th>
                          <td><?php echo $row['nombrePista']?></td>
                          <td><?php echo $row['artista']?></td>
                          <td ><?php echo $row['genero']?></td>
                          <td><?php echo $row['bpm']?></td>
                          <td><?php echo $row['apodo']?></td>
                          <td><span>$<?php echo $row['precio']?></span></td>
                          <td><a download  href="../editCompletos/<?php echo $row['remixCompleto']?>" class="bontIconosProducto"><i class="fa fa-fw fa-cloud-download"></i></a></td>
                          <td>
                              <div class="bontIconosProducto reproducirContenedor" data-demo="../editDemos/<?php echo $row ['demo'] ?>" ><i class="fa fa-fw fa-play-circle"></i></div>
                          </td>
                          <td>
                              <div class="bontIconosProducto editProducto"  data-toggle="modal" data-target="#modalEditarProducto"  
                                  data-idProducto="<?php echo $row['id'] ?>"  data-idProveedor="<?php echo $row['idProveedor'] ?>"  
                                  data-idGenero="<?php echo $row['idGenero'] ?>"   data-bpm="<?php echo $row['bpm'] ?>"  
                                  data-precio="<?php echo $row['precio'] ?>" data-titulo="<?php echo $row['nombrePista'] ?>" data-artista="<?php echo $row['artista']?>"  >

                                  <i class="fa fa-fw fa-pencil">
                                  </i>
                              </div>
                          </td>
                    <?php }else{
                          echo '<div class="alert alert-primary" role="alert">
                                  No existe resultado para la cadena de busqueda 
                              </div>';
                          $banderaError=true;
                      } ?>	
                  <?php endforeach; ?>


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
                    
                    ?>
                </tfoot>
              </table>
              <!-- ===================================Reproductor de Audio=================== -->
                <?php require'../../jPlayer Flat Audio Theme/reproductor.php';  ?>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="container text-cente">
                          <?php if( $banderaError==false){  // si no exite resultado osea marcar erro entonces no presentra paginacion?>
                                  <nav aria-label="Page navigation example">
                                    <ul class="pagination pg-blue">
                                        <?php if ($data["actual-section"] != 1): ?> 		  			
                                            <li class="page-item" ><a class="page-link" href="../view/admin/listarMisProductos.php?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_SESSION['id_proveedor'] ?>&page=1">Inicio</a></li>
                                            <li class="page-item" ><a class="page-link"" href="../view/admin/listarMisProductos.php?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_SESSION['id_proveedor'] ?>&page=<?php echo $data['previous']; ?>">&laquo;</a></li>
                                        <?php endif; ?>

                                        <?php for ($i = $data["section-start"]; $i <= $data["section-end"]; $i++): ?>					
                                        <?php if ($i > $data["total-pages"]): break; endif; ?>
                                        <?php $active = ($i == $data["this-page"]) ? "active" : ""; ?>			    
                                            <li class="page-item <?php echo $active; ?>">
                                            <a class="page-link" href="../view/admin/listarMisProductos.php?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_SESSION['id_proveedor'] ?>&page=<?php echo $i; ?>">
                                                <?php echo $i; ?>			    		
                                            </a>
                                            </li>
                                            <?php endfor; ?>
                                        
                                        <?php if ($data["actual-section"] != $data["total-sections"]): ?>
                                            <li  class="page-item"  ><a lass="page-link"  href="../view/admin/listarMisProductos.php?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_SESSION['id_proveedor'] ?>&page=<?php echo $data['next']; ?>">&raquo;</a></li>
                                            <li  class="page-item"><a class="page-link"  href="../view/admin/listarMisProductos.php?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_SESSION['id_proveedor'] ?>&page=<?php echo $data['total-pages']; ?>">Final</a></li>
                                            <?php endif; ?>
                                     </ul>
                                  </nav>
                              <?php }  ?>
                          </div> <!--  end container text center -->
                      </div><!--  end col-12 -->
                 </div> <!--  end row -->
        </div><!-- end box-body -->
      </div> <!-- end box -->
    </div> <!-- end .col-12 -->
  </div>  <!-- end .row -->
</section> <!-- end section -->

<style>
  select.form-control.form-control-sm.ml-3.w-60.selectGeneroRemixer {
    color: black !important;
}
div#waveform {
    display: none!important;
}
</style>