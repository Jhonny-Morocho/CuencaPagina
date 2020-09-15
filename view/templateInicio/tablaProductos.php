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

<div class="container-fluid">
      <div class="row">

  
          <div class="col-lg-12">
             <div class="col-lg-12 ">
                  <form class="text-center " style="color: #757575;" method="get" action="../../">
        
                    <div class="form-row">
                        
                        <div class="col">
                            <!-- First name -->
                            <div class="md-form">
                                <!-- <i class="fas fa-search" aria-hidden="true"></i> -->
                                <?php if(@$_GET['busqueda']) {?>
                                    <input class="form-control form-control-sm ml-3 w-120"  name="busqueda"  type="text" placeholder="Search"
                                    aria-label="Search" value="<?php echo $_GET['busqueda']  ?>">
                                <?php }else{ ?>
                                  <input class="form-control form-control-sm ml-3 w-120"  name="busqueda"  type="text" placeholder="Search"
                                    aria-label="Search" maxlength="100">
                                <?php }?>
                            </div>
                        </div>
                        <div class="col">
                            <!-- First name -->
                            <div class="md-form">
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
                        <div class="col">
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
                          
                        </div><div class="col">
                            <div class="md-form">
                              <button class="form-control form-control-sm  ml-3 w-60 btnBuscar" type="submit">Buscar</button>
                            </div>
                        </div>
                        
                    </div>

                  </form>

             </div>
       
                <!-- </div>
                
              </div> -->


        <div class="likes-this">
                Ty Stelmach listens to this 
          <a class="tooltips" href="#">
            <span>Ty Stelmach</span>
          <img class="tooltips" src="https://scontent.xx.fbcdn.net/hphotos-xfp1/v/t1.0-9/10998045_1798369970387402_1856748562792294014_n.jpg?oh=fbc7eca2fe190f5919fa121836e5814c&oe=55DA3885"></a>
          </div>
          
        <section id="first-tab-group" class="tabgroup">
            <div class="overview playlist" id="tab1">
            <div class="popular">
                <h4>Popular</h4>
                <ul class="popular-songs">
                    <li><div class="album-cover"><img src="http://newnoisemagazine.com/wp-content/uploads/2014/04/Expire-Pretty-Low-cover.jpg"></div> <span class="number" onClick = "newSrc = 'http://bridge9.bandcamp.com/track/pretty-low'; playTrack()"><span>1</span></span> <span>+</span><span class="title">Pretty Low</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">163,957</span></li>
                    
                    <li><div class="album-cover"><img src="https://f1.bcbits.com/img/a1012212014_10.jpg"></div> <span class="number"><span>2</span></span> <span>+</span><span class="title">Just Fine</span><span class="explicit">explicit</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">288,903</span></li>
                    
                    <li><div class="album-cover"><img src="https://f1.bcbits.com/img/a1012212014_10.jpg"></div> <span class="number"><span>3</span></span> <span>+</span><span class="title">Abyss</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">230,744</span></li>
                    
                    <li><div class="album-cover"><img src="http://newnoisemagazine.com/wp-content/uploads/2014/04/Expire-Pretty-Low-cover.jpg"></div> <span class="number"><span>4</span></span> <span>+</span><span class="title">Just Don't</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">110,322</span></li>
                    
                    <li><div class="album-cover"><img src="https://f1.bcbits.com/img/a1012212014_10.jpg"></div> <span class="number"><span>5</span></span> <span>+</span><span class="title">Spit Out</span><span class="explicit">explicit</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">193,433</span></li>
                    <ul class="five-more popular-songs" style="display: none;">
                    <li><div class="album-cover"><img src="http://newnoisemagazine.com/wp-content/uploads/2014/04/Expire-Pretty-Low-cover.jpg"></div> <span class="number"><span>6</span></span> <span>+</span><span class="title">Fiction</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">92,666</span></li>
                    
                    <li><div class="album-cover"><img src="http://newnoisemagazine.com/wp-content/uploads/2014/04/Expire-Pretty-Low-cover.jpg"></div> <span class="number"><span>7</span></span> <span>+</span><span class="title">Gravity</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">88,384</span></li>
                    
                    <li><div class="album-cover"><img src="http://newnoisemagazine.com/wp-content/uploads/2014/04/Expire-Pretty-Low-cover.jpg"></div> <span class="number"><span>8</span></span> <span>+</span><span class="title">Forgetting</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">81,923</span></li>
                    
                    <li><div class="album-cover"><img src="http://newnoisemagazine.com/wp-content/uploads/2014/04/Expire-Pretty-Low-cover.jpg"></div> <span class="number"><span>4</span></span> <span>+</span><span class="title">Old Habits</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">78,636</span></li>
                    
                    <li class="doubles"><div class="album-cover"><img src="https://f1.bcbits.com/img/a1012212014_10.jpg"></div> <span class="number"><span>10</span></span> <span class="plus">+</span><span class="title">Reputation</span><span class="misc"><i class="fa fa-ellipsis-h"></i></span><span class="total-plays">174,608</span></li>
                    </ul>
                    <button id="show-five">Show 5 More</button>

                </ul>
            </div>
                        
            <div class="related-artist">
                <h4>Related Artist</h4>
                <ul>
                    <li><div class="album-cover"><img src="https://revhq.com/images/covers/250/reap048.jpg"></div><span class="title">Backtrack</span></li>
                    <li><div class="album-cover"><img src="https://f1.bcbits.com/img/a2096683780_10.jpg"></div><span class="title">Suburban Scum</span></li>
                    <li><div class="album-cover"><img src="http://blowthescene.com/files/2011/09/Rotting-Out-street-prowl-cover.jpg"></div><span class="title">Rotting Out</span></li>
                    <li><div class="album-cover"><img src="https://f1.bcbits.com/img/0001314837_10.jpg"></div><span class="title">Incendiary</span></li>
                    <li><div class="album-cover"><img src="http://www.metalkingdom.net/album/cover/d38/71614_twitching_tongues_demo_2010.jpg"></div><span class="title">Twitching Tongues</span></li>
                    <ul class="five-more" style="display: none;">
                    <li><div class="album-cover"><img src="http://lgoat.com/i/news/Turnstile_nonstop_feeling_cover.jpg"></div><span class="title">Turnstile</span></li>
                    <li><div class="album-cover"><img src="http://www.altpress.com/images/uploads/news/Cruel_Hand_-_The_Negatives.jpg"></div><span class="title">Cruel Hand</span></li>
                    <li><div class="album-cover"><img src="http://i.ytimg.com/vi/vF67KfKQ7EY/hqdefault.jpg"></div><span class="title">Dead End Path</span></li>
                    <li><div class="album-cover"><img src="http://www.metalsucks.net/wp-content/uploads/2012/08/Xibalba-Hasta-La-Muerte.jpeg"></div><span class="title">Xibalba</span></li>
                    </ul>
                </ul>
            </div>  
    










 

                <div class="d-flex justify-content-center">
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
               
           </div>

    </div> <!-- end row -->
</div> <!-- end container fluid -->

 
