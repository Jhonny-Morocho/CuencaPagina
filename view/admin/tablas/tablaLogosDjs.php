 
   
   
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Logos Djs </h3>
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-12 carrusel">
            </div>
        </div>

        <div class="box-body">
            <?php
            $logosDjs=ModeloLogosDjs::sqlListarLogosDJs();
            if(count($logosDjs)>0){
                foreach($logosDjs as $key=>$value){
                    echo' 
                        <div class="padreCarrusel">
                            <span class="label label-success x">
                            '.($key+1).'
                            </span>
                            <img src="../img/logosDjs/'.$value['img'].'" width="25%" height="15%" class="img-fluid ml-2" alt="Responsive image">
                        
                            <!-- Card Actions -->
                            <div class="card-footer iconImg">
                                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary editarLogoDj" type="button" data-toggle="modal" data-target="#idEditarLogoDj" data-nombreViejo="'.$value['img'].'" data-id="'.$value['id'].'"><i class="fa fa-fw fa-pencil-square"></i></button>
                                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary elimarLogoDj" type="button" data-nombreViejo="'.$value['img'].'" data-id="'.$value['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </div>
                        </div>';
                }
            }else{
                echo "<div class='alert alert-warning' role='alert'> Ahun no se han cargado img en el carrusel </div>";
            }
            ?>
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
<style>
.iconImg button i{
    font-size: 30px;
}
.label-success{
    font-size: 20px;
}
</style>

