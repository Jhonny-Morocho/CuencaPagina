 
   <?php

//clientes regisrados en este por mes
$clientes=ModeloCliente::sqlListarClientes();
$numClientesMes=0;
date_default_timezone_set('America/Guayaquil');
$fecha_actual=date("Y-m-d");
foreach ($clientes as $key => $value) {
   //operacion para caluclar los 30 dias de diferencia 
$date1 = new DateTime($value['fechaRegistro']);
$date2 = new DateTime($fecha_actual);
$diff = $date1->diff($date2);
   if(30> $diff->days){
      $numClientesMes++;
    }
}

//compras realiadas en el mes
$facturas=ModeloFacura::sqlListarFacturasTodos();
$numFacturasMes=0;
foreach ($facturas as $key => $value) {
   //operacion para caluclar los 30 dias de diferencia 
$date1 = new DateTime($value['fechaFacturacion']);
$date2 = new DateTime($fecha_actual);
$diff = $date1->diff($date2);
   if(30> $diff->days){
      $numFacturasMes++;
    }
}
?>

<!-- Main content -->
<section class="content">

<div class="row">
  <div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php  echo $numFacturasMes?></h3>

        <p>New Orders in the month</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <!-- <a href="../view/admin/listarVentas.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
    </div>
  </div>

  <!-- ./col -->
  <div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php  echo $numClientesMes ?></h3>

        <p>Registered users in the month </p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <!-- <a href="../view/admin/listarClientes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <!-- ./col -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
