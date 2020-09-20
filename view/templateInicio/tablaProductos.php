    <?php 

          ini_set('display_errors', 'On');
          require'controler/ctrValidarCampos.php';
          require'controler/ctrPaginacion.php';
          require'model/mdlPaginacion.php';

             
          $respuestaValidacionBuscador=Pagination::validarCamposBuscador(@$_GET['busqueda']);
          

          $where1="  where producto.idProveedor=proveedor.id and
                      producto.idGenero=genero.id and 
                      producto.estado=1 

                          "; 

          $where2=" where producto.idProveedor=proveedor.id and
          producto.idGenero=genero.id and 
          producto.estado=1  and 
                                   producto.demo LIKE '%".@$_GET['busqueda']."%'
                                 ";
                                 
          

          $whereRemixer=" where producto.idProveedor=proveedor.id and
          producto.idGenero=genero.id and 
          producto.estado=1  and 
                                  proveedor.id=".intval(@$_GET['remixer']);
        // 1.Caso solo filtros de genero y remixer sin buscador
        $whereGenero=" where producto.idProveedor=proveedor.id and
             producto.idGenero=genero.id and 
             producto.estado=1  and 
                           genero.id=".intval(@$_GET['genero']);// conviuerrto en numero
          
        // 2.Caso solo filtros de genero y remixer sin buscado    
        $whereRemixerGenero=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                                proveedor.id=".intval(@$_GET['remixer'])." and  genero.id=".intval(@$_GET['genero']);

        $whereDemoGenero=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                                genero.id=".intval(@$_GET['genero'])." and   producto.demo LIKE '%".@$_GET['busqueda']."%'   ";
                                
        $whereDemoGeneroRemixer=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                                genero.id=".intval(@$_GET['genero'])." and   proveedor.id=".intval(@$_GET['remixer'])." and   producto.demo LIKE '%".@$_GET['busqueda']."%'   ";
        $whereDemoRemixer=" where producto.idProveedor=proveedor.id and
        producto.idGenero=genero.id and 
        producto.estado=1  and 
                             proveedor.id=".intval(@$_GET['remixer'])." and   producto.demo LIKE '%".@$_GET['busqueda']."%'   ";


        $numeroFilas=40;
        
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
      $validacionIdRemixer=validarNumeros(@$_GET['remixer']);
      $validacionIdPaginacion=validarNumeros(@$_GET['page']);
      //echo "VALIDACIONPaginacion : ".(validarNumeros(@$_GET['page']));
      
      $page = (validarNumeros(@$_GET['page'])=="true") ? $_GET["page"] : 1;



        $data="";

        
        //1. Caso//  buscador= vacio; genero=vacio; remixer=vacio
        if(!@$_GET['busqueda'] && !@$_GET['genero'] && !@$_GET['remixer'] ){// primer caso// no necesita validaciion x q la data es vacia
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $where1, null , 10,'inicio');
          //echo "caso 1";
        }

        //2.Caso// buscador=data; genero=vacio; remixer=vacio
          if(@$_GET['busqueda'] && !@$_GET['genero'] && !@$_GET['remixer'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE"){
            //echo "caso 2";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $where2, null , 10,'todo');
          }

        //3.Caso// buscador=data; genero=data; remixer=vacio;
        if(@$_GET['busqueda'] && @$_GET['genero'] && !@$_GET['remixer'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE" && validarNumeros(@$_GET['genero'])=="TRUE" ){
          //echo "caso 3";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereDemoGenero, null , 10,'todo');
          }

        //4.Caso// buscador=data; genero=data; remixer=data;
        if(@$_GET['busqueda'] && @$_GET['genero'] && @$_GET['remixer'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE" && validarNumeros(@$_GET['genero'])=="TRUE" && validarNumeros(@$_GET['remixer'])=="TRUE" ){
          //echo "caso 4";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereDemoGeneroRemixer, null , 10,'todo');
          }
        //5.Caso// buscador=data;genero=vacio; remixer=data;
        if(@$_GET['busqueda'] && !@$_GET['genero'] && @$_GET['remixer'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE"  && validarNumeros(@$_GET['remixer'])=="TRUE"){
          //echo "caso 5";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereDemoRemixer, null , 10,'todo');
        }

        //6.Caso// buscador=vacio;genero=data; remixer=data;
        if(!@$_GET['busqueda'] && @$_GET['genero'] && @$_GET['remixer'] && validarNumeros(@$_GET['genero'])=="true" && validarNumeros(@$_GET['remixer'])=="true"){
          echo "caso 6";
          Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereRemixerGenero, null , 10,'todo');
        }

        //7.Caso// buscador=vacio;genero=vacio; remixer=data;
          if(!@$_GET['busqueda'] && !@$_GET['genero'] && @$_GET['remixer']  && validarNumeros(@$_GET['remixer'])=="TRUE"){
            //echo "caso 7";
            Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereRemixer, null , 10,'todo');
        }

        //8.Caso// buscador=vacio;genero=data; remixer=vacio;
          if(!@$_GET['busqueda'] && @$_GET['genero'] && !@$_GET['remixer'] && validarNumeros(@$_GET['genero'])=="TRUE"){
            //echo "caso 8";
            Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $whereGenero, null , 10,'todo');
        }
        try {
          //code...
          $data = Pagination::data();// si exite un error q reenvie al index
        } catch (\Throwable $th) {
         
          echo "<script>window.setTimeout(function() { window.location = '../../' });</script>";
        }
          
          
      ?> 


<!--Main Layout-->

    <div class="row black">
            <div class="col-lg-10">
              <main class="main" id="main">
           
                      <!-- <input class="song__input" type="text" placeholder="Buscar..." id="song__input"> -->

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
                        <div class="song__item"  data-demo="../../editDemos/<?php echo $row['demo']?>">

                            <div class="song__buy"><i class="fas fa-cart-plus song__like  mr-1 "></i><?php echo ' $ '.$row['precio'] ?></div>
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
                  
                  </main>
            </div> <!-- end colg-lg-10 --> 
            
            <div class="col-lg-2 topViral "  >
                                <h5>BEST SELLERS </h5>
              <!-- <h5 ><span class="underline-closing "> BEST SELLERS </span></h5> -->         
           
              <?php 
                  $top=ModeloClienteProducto::sqlListarTop(); 
      
                  $cont_2=0;
                  foreach($top as $key=>$value){
                      if($cont_2<6){
                          echo'

                          <div class="col-md-12 mb-12">

                          <div class="view z-depth-1  imgTop imghvr-zoom-out-left">
                            <img src="../../img/proveedores/'.$value['img'].'" class="img-fluid mx-auto" alt="smaple image">
                            <figcaption>
                              <ul class="list-unstyled d-flex justify-content-center mt-1 mb-0 text-muted listsaIconosTop">
                                <li><i class="fas fa-play"></i> </li>
                                <li><i class="fas fa-cart-plus"></i> </li>
                                <li><i class="fas fa-share-alt"></i> </li>
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
            </div><!-- end colg-lg-2 -->
    </div> <!-- end row -->

    <div class="d-flex justify-content-center mt-3">
      <?php if( $banderaError==false){  // si no exite resultado osea marcar erro entonces no presentra paginacion?>
              <nav aria-label="Page navigation example">
                  <ul class="pagination pg-blue">
                      <?php if ($data["actual-section"] != 1): ?> 		  			
                          <li class="page-item" ><a class="page-link" href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_GET['remixer'] ?>&page=1">Inicio</a></li>
                          <li class="page-item" ><a class="page-link"" href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_GET['remixer'] ?>&page=<?php echo $data['previous']; ?>">&laquo;</a></li>
                      <?php endif; ?>

                      <?php for ($i = $data["section-start"]; $i <= $data["section-end"]; $i++): ?>					
                      <?php if ($i > $data["total-pages"]): break; endif; ?>
                      <?php $active = ($i == $data["this-page"]) ? "active" : ""; ?>			    
                          <li class="page-item <?php echo $active; ?>">
                          <a class="page-link" href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_GET['remixer'] ?>&page=<?php echo $i; ?>">
                              <?php echo $i; ?>			    		
                          </a>
                          </li>
                          <?php endfor; ?>
                      
                      <?php if ($data["actual-section"] != $data["total-sections"]): ?>
                          <li  class="page-item"  ><a lass="page-link"  href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_GET['remixer'] ?>&page=<?php echo $data['next']; ?>">&raquo;</a></li>
                          <li  class="page-item"><a class="page-link"  href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&genero=<?php echo @$_GET['genero'] ?>&remixer=<?php echo @$_GET['remixer'] ?>&page=<?php echo $data['total-pages']; ?>">Final</a></li>
                          <?php endif; ?>
                  </ul>
              </nav>
          <?php }  ?>
    </div>
    
    <div class="row">
      <ul id="rcbrand2">
          <li><img src="../../Logo-carousel/images/wordpress.png" /></li>
          <li><img src="../../Logo-carousel/images/html5.png" /></li>
          <li><img src="../../Logo-carousel/images/css3.png" /></li>
          <li><img src="../../Logo-carousel/images/windows.png" /></li>
          <li><img src="../../Logo-carousel/images/jquery.png" /></li>
          <li><img src="../../Logo-carousel/images/js.png" /></li>
      </ul>
    </div>



    

<!-- ======================================= REPRODUCTOR DE ONDA ================================= -->
<!-- ======================================= REPRODUCTOR DE ONDA ================================= -->
<!-- ======================================= REPRODUCTOR DE ONDA ================================= -->

<link rel="stylesheet" href="../../view/estilos/audioPlayer.css">



<div id="audio-gallery-0" class="audiogallery" style="opacity:0">
    <div class="items">
    <?php foreach (Pagination::show_rows("id") as $row): ?>
    <?php  $banderaError=false; if( $row['apodo']!== 'Error: vacío' ){ ?>


      <div id="audioplayer-0_0" class="audioplayer-tobe" data-scrubbg="waves/scrubbg.png" data-scrubprog="waves/scrubprog.png" data-type="normal" data-source="../../editDemos/<?php echo $row['demo'] ?>" data-videoTitle="Audio Video"  data-fakeplayer="#stickyplayer">      
        <div class="meta-artist">
          <span class="the-artist">tangerine</span>
          <br/>
          <span class="the-name">title</span>
        </div>
        <div class="menu-description">
          <div class="menu-item-thumb-con">
            <div class="menu-item-thumb"></div>
          </div>
          <span class="the-artist"></span>
          <span class="the-name"><?php echo $row['nombrePista'] ?></span>
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
  

  <!------------------------>
<!-- sticky audio player-->
<div class="dzsap-sticktobottom-placeholder dzsap-sticktobottom-placeholder-for-skin-wave"></div>
<section class="dzsap-sticktobottom dzsap-sticktobottom-for-skin-wave">
    <div id="stickyplayer" class="audioplayer-tobe" style="width:100%;" data-type="fake" data-source="fake">
        <div class="the-comments">
        </div>
        <div class="meta-artist">
            <span class="the-artist"></span>
            <span class="the-name">
                <a href="http://codecanyon.net/item/zoomsounds-wordpress-audio-player/6181433?ref=ZoomIt" target="_blank"></a>
            </span>
            <div class="goto">
                <div class="btn-prev player-but">
                    <div class="the-icon-bg"></div>                 
                </div>
                <div class="btn-next player-but">
                    <div class="the-icon-bg"></div>                
                </div>
            </div>
        </div>
    </div>
</section>

        






