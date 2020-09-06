<?php
class ClassPlantilla{
  
  public static function funcionPlantilla($nombreProducto,$fechaCompra,$precioVenta,$metodoPago,$nombreDj){

    $nombreDueño="Sr. Marco Arias";
    date_default_timezone_set('America/Guayaquil');
    $fecha_actual=date("Y-m-d");
    $empresa="WWW.LATINEDITS.COM";

    $correo="";
    
    $htmlPlantilla1='<body id="content">
      <header class="clearfix">
        <div id="logo">
          <img src="../generarReportePdf/plantillaReporte/logo-png-pagina.png" width="20%">
        </div>
        <h1>'.$empresa.'</h1>
        <div id="company" class="clearfix">
          <div>'.$empresa.'</div>
          <div>455 Foggy Heights,<br /> AZ 85004, US</div>
          <div>(602) 519-0450</div>
          <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div>
        <div id="project">
          <div><span>PROJECT</span>'.$nombreDueño.'</div>
          <div><span>CLIENT</span>'.$nombreDj.'</div>
          <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
          <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
          <div><span>DATE</span>'.'</div>
          <div><span>DUE DATE</span> September 17, 2015</div>
        </div>
      </header>
      <main>
        <table>
          <thead>
            <tr>
              <th>#ID</th>
              <th class="service">PRODUCTO</th>
              <th class="desc">DATE/th>
              <th>PRICE</th>
              <th>METHOD PAYMET</th>
            </tr>
          </thead>
          <tbody>';
          
        $htmlPlantillaItem="";
        $tabla="";
          for ($i=0; $i < count($nombreProducto); $i++) { 
            $htmlPlantillaItem= '<tr>
                        <td class="service">'.(count($nombreProducto)-$i).'</td>
                        <td class="desc">'.$nombreProducto[$i].'</td>
                        <td class="unit">'.$fechaCompra[$i].'</td>
                        <td class="qty">'.$precioVenta[$i].'</td>
                        <td class="total">'.$metodoPago[$i].'</td>
                      </tr>';
            $tabla=$htmlPlantillaItem.$tabla;
          }
  


$htmlPlantillaComision='<tr>
              <td colspan="4">SUBTOTAL</td>
              <td class="total">$5,200.00</td>
            </tr>';



$htmlPlantillaComision='<tr>
              <td colspan="4">TAX 25%</td>
              <td class="total">$1,300.00</td>
            </tr>
            <tr>
              <td colspan="4" class="grand total">GRAND TOTAL</td>
              <td class="grand total">$6,500.00</td>
            </tr>';



 $htmlPlantilla2='</tbody>
        </table>
        <div id="notices">
          <div>NOTICE:</div>
          <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
      </main>
      <footer>
        Invoice was created on a computer and is valid without the signature and seal.
      </footer>
    </body>';
  
    return $htmlPlantilla1.$tabla.$htmlPlantilla2;
  
  }
  
}
?>
