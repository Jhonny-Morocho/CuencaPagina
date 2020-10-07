 
   <?php

date_default_timezone_set('America/Guayaquil');
// numero de dias q tiene el mes actual
$numDiasMesActual=date("t");
//me actual 
$mesActual=date("m");
// año actual 
$añoActual=date("Y");
$formatoFechaActual=$añoActual."-".$mesActual."-01";



// echo "la fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y");
    $clientes=ModeloCliente::sqlListarClientes();
    //print_r($clientes);
    $numClientesMes=0;
    $fecha_actual=date("Y-m-d");
    foreach ($clientes as $key => $value) {
      if($formatoFechaActual<$value['fechaRegistro']){
        $numClientesMes++;
      }
    }

    

    //compras realiadas en el mes
    $facturas=ModeloFacura::sqlListarFacturasTodos();
    $numFacturasMes=0;
    $totalVendidoMes=0.0;
    foreach ($facturas as $key => $value) {
       //operacion para caluclar los 30 dias de diferencia 
       if($formatoFechaActual<$value['fechaFacturacion']){
          $numFacturasMes++;
          $totalVendidoMes=$value['totalCancelar']+$totalVendidoMes;
        }
    }
 ?>
 
 
 <!-- Main content -->
<section class="content">

<div class="row">
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php  echo $numFacturasMes?><sup style="font-size: 20px">#</sup></h3>

            <p>New Orders in the month</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <!-- <a href="../view/admin/listarVentas.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php  echo $numClientesMes ?><sup style="font-size: 20px">#</sup></h3>

            <p>Registered users in the month </p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <!-- <a href="../view/admin/listarClientes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php  echo $totalVendidoMes ?><sup style="font-size: 20px">$</sup></h3>

            <p>Registered buy in the month </p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
