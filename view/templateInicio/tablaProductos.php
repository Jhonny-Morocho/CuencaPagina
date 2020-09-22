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

                    <!-- ===================== BUSCADOR =========================== -->
                    <!-- ===================== BUSCADOR =========================== -->
                    <!-- ===================== BUSCADOR =========================== -->
                    <?php
                      require'buscador.php';
                    ?>

                    <!-- ===================== PLAY LIST =========================== -->
                    <!-- ===================== PLAY LIST =========================== -->
                    <!-- ===================== PLAY LIST =========================== -->
                    <?php
                      require'playList.php';
                    ?>
             
             
                  
                  
                  </main>
            </div> <!-- end colg-lg-10 --> 
            
            <div class="col-lg-2 topViral "  >
                <!-- ===================== HOT TRACK  =========================== -->
                <!-- ===================== HOT TRACK  =========================== -->
                <!-- ===================== HOT TRACK  =========================== -->
                <?php
                  require'listaHotTrack.php';
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
    


    



        



