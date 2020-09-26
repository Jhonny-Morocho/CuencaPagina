 
   
   
   <!-- Main content -->
   <section class="content">
  
  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Carrsuel </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php
                $carrusel=ModeloCarrusel::sqlListarImgCarrusel();
            foreach($carrusel as $key=>$value){
            echo' 
                <span class="label label-success">
                    '.($key+1).'
                </span>
                <div class="pmd-card-media">
                    <img src="../img/carrosul/'.$value['img'].'" width="80%" height="40%" class="img-fluid">
                </div>
                <!-- Card Actions -->
                <div class="card-footer iconImg">
                    <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="fa fa-fw fa-pencil-square"></i></button>
                    <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary eliminarImgCarrusel" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </div>
                ';
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

