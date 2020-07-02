    <?php 
          //validacion de campos
          require'controler/ctrValidarCampos.php';
          require'controler/ctrPaginacion.php';
          require'model/mdlPaginacion.php';
          $respuestaValidacion=Pagination::validarCamposBuscador(@$_GET['busqueda']);


          //falra el de paginacion
          //print_r($respuestaValidacion);
  

          $where1=" where producto.idProveedor=proveedor.id and
                          producto.idGenero=genero.id and 
                          producto.estado=1 

                          "; 

          $where2="WHERE 
                              productos.id_proveedor=proveedor.id 
                      and     productos.id_biblioteca=biblioteca.id 
                      and     productos.activo=1 

                      and productos.tipo='audio' 
                      and proveedor.estado='1' and  productos.url_directorio LIKE '%".@$_GET['busqueda']."%'";    
                      
                      
          if(@$_GET['busqueda'] && $respuestaValidacion['respuesta_validacion']=="TRUE"){// este ahun falta congigurar
              
              $page = (isset($_GET["page"]) )? $_GET["page"] : 1;
              Pagination::config($page, 20, " productos , proveedor , biblioteca ", $where2, null , 10); 
              $data = Pagination::data(); 
              //print_r($data);
          }else{
              
              //cuando la pagina inicia solo presenta los datos normales
              $page = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
              Pagination::config($page, 1, " producto , proveedor , genero ", $where1, null , 10); 
              $data = Pagination::data(); 
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
             
        <form class="text-center" style="color: #757575;" action="#!">

<div class="form-row">

    <div class="col">
        <!-- First name -->
        <div class="md-form">
            <!-- <i class="fas fa-search" aria-hidden="true"></i> -->
            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
              aria-label="Search">
        </div>
    </div>
    <div class="col">
        <!-- First name -->
        <div class="md-form">
            <select class="browser-default custom-select mb-3">
                <option value="" disabled>Choose option</option>
                <option value="1" selected>Feedback</option>
                <option value="2">Report a bug</option>
                <option value="3">Feature request</option>
                <option value="4">Feature request</option>
            </select>
            
        </div>
    </div>
    <div class="col">
        <!-- Last name -->
        <div class="md-form">
          <select class="browser-default custom-select mb-3">
                <option value="" disabled>Choose option</option>
                <option value="1" selected>Feedback</option>
                <option value="2">Report a bug</option>
                <option value="3">Feature request</option>
                <option value="4">Feature request</option>
            </select>
        </div>
      
    </div><div class="col">
        <!-- Last name -->
        <div class="md-form">
          <button class="btn btn-info  btn-block" type="submit">Buscar</button>
        </div>
    </div>
    
</div>





</form>
                <!-- </div>
              </div> -->
              <table class="table table-hover table-sm table-responsive table-dark text-nowrap">
                <thead class="black white-text">
                    <tr>
                    <th scope="col">Date</th>
                    <th scope="col">REMIXER</th>
                    <th scope="col">ARTIST</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">BPM</th>
                    <th scope="col">GENER</th>
                    <th scope="col">BUY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (Pagination::show_rows("id") as $row): ?>
                    <?php  $banderaError=false; if( $row['apodo']!== 'Error: vacío' ){ ?>
                        <tr>
                          <th scope="row"><?php echo $row['fecha']?></th>
                          <td><?php echo $row['apodo']?></td>
                          <td><?php echo $row['artista']?></td>
                          <td class="overflow-ellipsis"><?php echo $row['nombrePista']?></td>
                          <td><?php echo $row['bpm']?></td>
                          <td><?php echo $row['genero']?></td>
                          <td>
                            <div class="container">
                                  <div class="row">
                                    <div class="col-lg-3 reproducirContenedor" data-demo="../../editDemos/<?php echo $row['demo']?>">
                                        <span class="reproducir">
                                          <i class="fa fa-play-circle" aria-hidden="true"></i>
                                        </span>
                                      </div>
                                      <div class="col-lg-9 buy">
                                          <span class="addcarrito">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                          </span>
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
                <?php if( $banderaError==false){  // si no exite resultado osea marcar erro entonces no presentra paginacion?>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pg-blue">
                                <?php if ($data["actual-section"] != 1): ?> 		  			
                                    <li class="page-item" ><a class="page-link" href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&page=1">Inicio</a></li>
                                    <li class="page-item" ><a class="page-link"" href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&page=<?php echo $data['previous']; ?>">&laquo;</a></li>
                                <?php endif; ?>

                                <?php for ($i = $data["section-start"]; $i <= $data["section-end"]; $i++): ?>					
                                <?php if ($i > $data["total-pages"]): break; endif; ?>
                                <?php $active = ($i == $data["this-page"]) ? "active" : ""; ?>			    
                                    <li class="page-item <?php echo $active; ?>">
                                    <a class="page-link" href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&page=<?php echo $i; ?>">
                                        <?php echo $i; ?>			    		
                                    </a>
                                    </li>
                                    <?php endfor; ?>
                                
                                <?php if ($data["actual-section"] != $data["total-sections"]): ?>
                                    <li  class="page-item"  ><a lass="page-link"  href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&page=<?php echo $data['next']; ?>">&raquo;</a></li>
                                    <li  class="page-item"><a class="page-link"  href="../../?busqueda=<?php echo @$_GET['busqueda'] ?>&page=<?php echo $data['total-pages']; ?>">Final</a></li>
                                    <?php endif; ?>
                            </ul>
                        </nav>
                    <?php }  ?>
           </div>

    </div> <!-- end row -->
</div> <!-- end container fluid -->

