    <?php 
          ini_set('display_errors', 'On');
          //validacion de campos
          require'controler/ctrValidarCampos.php';
          require'controler/ctrPaginacion.php';
          require'model/mdlPaginacion.php';
          require'model/mdlGenero.php';
          require'model/mdlProveedor.php';
          
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


        $numeroFilas=7;
        
       
        
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
         //(@$_GET['busqueda'] && $respuestaValidacionBuscador['respuesta_validacion']=="TRUE" )?  Pagination::config($page, $numeroFilas, " producto , proveedor , genero  ", $where2, null , 10,'todo'): Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $where1, null , 10,'inicio'); 
          
          //2. Caso// select con el genero musical // en esta busqueda solo se buscara todos los resultados con el genero de coincidencia, validamos si no es entero entonces se va  la pagina de inicio
          // convierto el idGenero a entero , ya que siempre vienen en formato string
          //$idGenero=intval($_GET['genero']);// convierto en entero
          //(is_int($idGenero)=="TRUE" && !$_GET['remixer']) ? Pagination::config($page, $numeroFilas, " producto , proveedor , genero  ", $whereGenero, null , 10,'todo'): Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $where1, null , 10,'inicio'); 

          //3. Caso// select con el genero remixer // en esta busqueda solo se buscara todos los resultados con el remixer de coincidencia, validamos si no es entero entonces se va  la pagina de inicio
          // convierto el idGenero a entero , ya que siempre vienen en formato string
          //$idRemixer=intval($_GET['remixer']);// convierto en entero
          //(is_int($idRemixer)=="TRUE" && !$_GET['genero']) ? Pagination::config($page, $numeroFilas, " producto , proveedor , genero  ", $whereRemixer, null , 10,'todo'): Pagination::config($page,$numeroFilas, " producto , proveedor , genero ", $where1, null , 10,'inicio'); 

          try {
            //code...
            $data = Pagination::data();// si exite un error q reenvie al index
          } catch (\Throwable $th) {
            header('Location: ./');
          }
          
      ?> 

    <div class="container-fluid">
      <div class="row">
        <div class="contenedorReproductos">
          <div class="col-lg-12">
              <!-- ===================================Reproductor de Audio=================== -->
              <?php require'jPlayer Flat Audio Theme/reproductor.php' ?>
              <!-- ===================================Reproductor de Audio=================== -->
          </div>
        </div>
      </div>
    </div>

<!--Main Layout-->

<div class="container-fluid">
      <div class="row">
          <div class="col-lg-2 container">
            <table class="table table-hover table-sm table-responsive table-dark">
            <thead class="black white-text">
                <tr>
                <th scope="col">Top Viral</th>
                <th scope="col">REMIXER</th>
      
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <th scope="row">2020/06/1</th>
                    <td>Dj Reto</td>
                  </tr>
                  <tr>
                    <th scope="row">2020/06/2</th>
                    <td>Dj Deyzer</td>
                  </tr>
              </tbody>
            </table>
          </div> 
         
          <div class="col-lg-10">
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
                                    aria-label="Search">
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
                              <button class="form-control form-control-sm  ml-3 w-60 " type="submit">Buscar</button>
                            </div>
                        </div>
                        
                    </div>

                  </form>

             </div>
       
                <!-- </div>
              </div> -->
              <table id="dtBasicExample" class="table  table-striped table-bordered table-sm" cellspacing="0" width="100%">
             
                <thead class="black white-text">
                    <tr>
                    <th >Date</th>
                    <th >REMIXER</th>
                    <th >ARTIST</th>
                    <th >TITLE</th>
                    <th >BPM</th>
                    <th >GENER</th>
                    <th >BUY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (Pagination::show_rows("id") as $row): ?>
                    <?php  $banderaError=false; if( $row['apodo']!== 'Error: vacío' ){ ?>
                        <tr>
                          <th><?php echo $row['fecha']?></th>
                          <td><?php echo $row['apodo']?></td>
                          <td><?php echo $row['artista']?></td>
                          <td ><?php echo $row['nombrePista']?></td>
                          <td><?php echo $row['bpm']?></td>
                          <td><?php echo $row['genero']?></td>
                          <td>
                             <div class="cotenedorBuy" >
                                <div class="row">
                                     <div class="col-lg-4 reproducirContenedor" data-demo="../../editDemos/<?php echo $row['demo']?>">
                                        <span class="reproducir">
                                          <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </span>
                                      </div>

                                      <div  class="col-lg-3 buy " data-id="<?php echo $row['id']?>" data-nombre="<?php echo $row['nombrePista']?>" data-precio="<?php echo $row['precio']?>">
                                          <span class="addcarrito">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                          </span>
                                      </div>

                                      <div class="col-lg-5 price">
                                          <!-- <button class="btn btn-primary text-nowrap" type="button">
                                            <span class="spinner-border spinner-border-sm mr-2"></span>
                                            Enviando datos...
                                          </button> -->
                                          <span class="precio">$
                                            <?php echo $row['precio']?>
                                          </span>
                                      </div>
                                      
                                </div>
                             </div>
                          </td>
                        </tr>
                    <?php }else{
                          echo '<div class="alert alert-primary" role="alert">
                                  No existe resultado para la cadena de busqueda 
                              </div>';
                          $banderaError=true;
                      } ?>	
                  <?php endforeach; ?>
                </tbody>

                </table>

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

