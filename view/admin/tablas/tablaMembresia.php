 
   
   <?php     $membresias=ModeloMembresia::sqlListarMembresias(); ?>
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tipos de membresias </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Membresia</th>
                  <th>Descargas</th>
                  <th>Precio</th>
                  <th>Unidad (10% Paypal)</th>
                  <th>Editar</th>
                </tr>
               <?php
                $cont=1;
                foreach ($membresias as $key => $value) {
                echo'<tr>
                      <td>'.$cont.'</td>
                      <td>'.$value['nombreMembresia'].'</td>
                      <td>'.$value['numDescargas'].'</td>
                      <td>$ '.$value['precio'].'</td>
                      <td>$ '.round((($value['precio']-($value['precio'])*(0.10)))/($value['numDescargas']),2).'</td>
                      <td><i class="fa fa-fw fa-pencil editMembresia" data-id="'.$value['id'].'" data-titulo="'.$value['nombreMembresia'].'" data-numDescargas="'.$value['numDescargas'].'" data-precio="'.$value['precio'].'" data-toggle="modal" data-target="#modalEditarMembresia" ></i></td>
                    </tr>';
                    $cont++;
                }
               ?>
              </tbody></table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div> 
  <!-- /.row -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->