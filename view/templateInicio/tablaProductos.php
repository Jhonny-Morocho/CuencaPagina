    <?php 


// will output 2 days

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










<div class="">
  <div class="">
    <div class="">


    </div>

    <div class="row black">
            <div class="col-lg-9">
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

                    <div class="song__item song__th">

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
                        <div class="song__item" >

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
            </div>
            <div class="col-lg-3 topViral "  >

        
            
    
      

            <div class="contentTop">
    <div class="descripcionNav card">
     Top 15 
    </div>
    <nav class="nav flex-column blue lighten-5 py-4 ">
        <!-- Rotating card -->
            <!-- Rotating card -->
            <?php 
                 $top=ModeloClienteProducto::sqlListarTop(); 
               
                $cont_2=0;
                foreach($top as $key=>$value){
                    if($cont_2<15){
                        echo'


                        <!--Card Regular-->
                        <div class="card card-cascade">
                          <!--Card image-->
                          <div class="view view-cascade overlay">
                            <img src="../../img/proveedores/'.$value['img'].'" class="card-img-top" alt="normal">
                            <a>
                              <div class="mask rgba-white-slight"></div>
                            </a>
                          </div>
                          <!--/.Card image-->
                          <!--Card content-->
                          <div class="card-body card-body-cascade text-center">
                            <!--Title-->
                            <h4 class="card-title"><strong>Billy Cullen</strong></h4>
                            <h5>Web developer</h5>
                            <!--Facebook-->
                            <a type="button" class="btn-floating btn-small btn-fb"><i class="fab fa-facebook-f"></i></a>
                          </div>
                          <!--/.Card content-->
                        </div>
                        
                        <!--Section: Author Box-->
                        <a href=""><div class="media mt-4 px-1 itemTop15">
                                <img class="card-img-100 d-flex z-depth-1 mr-3" src="../../img/proveedores/'.$value['img'].'"
                                alt="Generic placeholder image">
                                <div class="media-body">
                                <h5 class="font-weight-bold mt-0">
                                    <span style="color:#fff">$'.$value['precio'].'</span>
                                </h5>
                                    <span class="topSonf article__content">'.($value['nombrePista']).'</span>
                                </div>
                            </div></a>
                        <!--Section: Author Box-->';
                    }
                    $cont_2++; 
                }
            ?>
    </nav>

</div>
            </div>
    </div>

  </div>
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


        


  <style>

}
select.form-control.form-control-sm.ml-3.w-60.selectGeneroRemixer {
   
    padding: 10px;
}


  </style>


<!-- ===================================SILIDER CON IMAGNES ============================== -->
<!-- ===================================SILIDER CON IMAGNES ============================== -->
<!-- ===================================SILIDER CON IMAGNES ============================== -->
<link rel="stylesheet" href="../../Logo-carousel/css/style.css">
<script src="../../Logo-carousel/js/jquery.rcbrand.js"></script>

<style>
  .rc-rcbrand-inner {
 
    background: #121314 !important;
   border-color:  #121314 !important;
}


</style>



<style>
  /* ============================= RESPONSIBE DISEÑO ==================================== */
/* ============================= RESPONSIBE DISEÑO ==================================== */
/* ============================= RESPONSIBE DISEÑO ==================================== */
@media only screen and (max-width: 1920px) {
  /* .song__buy {
      width: auto;
      flex-grow: 1;
      min-width: 200px;
      padding: 0 20px;
      overflow: hidden;
  } */

}
@media only screen and (max-width: 1366px) {
    /* .song__buy {
      width: auto;
      flex-grow: 1;
      min-width: 200px;
      padding: 0 20px;
      overflow: hidden;
  } */
}
@media only screen and (max-width: 1024px) {
 
  
}
@media only screen and (max-width: 990px) {
 

}

@media only screen and (max-width: 768px) {

}
@media only screen and (max-width: 480px) {

}
/* ========================================== boton de buscar ===========================
========================================== boton de buscar ===========================
========================================== boton de buscar =========================== */
button.form-control.form-control-sm.ml-3.w-60.btnBuscar {
    margin: 10px !important;
    padding: 7.01px;
}
.md-form .form-control {

    color: white !important;

}

option {
  
  color: black;
}
/* ================================= TITLE DE LA TABLA DE PRODUCTOS =========================== */
/* ================================= TITLE DE LA TABLA DE PRODUCTOS =========================== */
/* ================================= TITLE DE LA TABLA DE PRODUCTOS =========================== */
.song__title.cabezeraTitle {
    margin-left: -70px !important;
}
.song__buy {
    min-width: 115px;
    overflow: hidden;
    display: flex;
}

.song__like {

    width: -4px !important;
 
}
</style>



