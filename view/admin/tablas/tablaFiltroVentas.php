
   <!-- Main content -->
   <section class="content">
  

  <div class="row">
    <div class="col-lg-12">
         <!-- DATA TABLE GENERO -->
         <div class="box">
        <div class="box-header">
          <h3 class="box-title">Filtrar ventas </h3>
          <!-- FORMULARIO DE FILTRO DE FECHAS  -->
            <form role="form"  method="post" action="../controler/ctrVentas.php" id="idVentasListarFiltro">
                <div class="box-body ">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Ficha Inicio</label>
                        <input type="date" class="form-control"  id="idFechaInicio" required name="fechaInicio" value="2020-07-20">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputPassword1">Fecha Fin</label>
                        <input type="date" class="form-control"  id="idFechaFin" required  name="fechaFin" value="2020-10-05">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="hidden" name="FiltrarVentas" value="ListarVentas">
                        <button type="submit" class="btn bg-purple btn-flat margin" title="Filtrar"><i class="fa fa-fw fa-search"></i></button>
                    </div>
                </div>
            </form>
     
            <div class="small-box bg-green">
                    <div class="inner">
                    <h3 class="infoTotal">0<sup style="font-size: 20px">$</sup></h3>
    
                    <p>Total</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
            </div>
        </div>
        <!-- /.box-body -->
          <!-- /.row -->
      </div>
    </div>
  </div> 


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->