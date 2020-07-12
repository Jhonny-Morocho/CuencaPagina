
    <?php
        // ANTES DE CONTINUAR CON EL PROCESO DEBES
        // VERIFICAR EL PAGO
        require __DIR__ .'/bootstrap.php';

        ini_set('display_errors', 'On');

        use \PayPal\Api\Amount;
        use \PayPal\Api\Details;
        use \PayPal\Api\ExecutePayment;
        use \PayPal\Api\Payment;
        use \PayPal\Api\PaymentExecution;
        use \PayPal\Api\Transaction;



        if(!isset($_GET['paymentId']) && !isset($_GET['PayerID']) ) {
            $resultado = 'false';
        } else {
            $resultado='true';// par que lo convierta en boleano


            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);
            $payerId = $_GET['PayerID'];

            /*echo "yo soy el payer id".$paymentId;*/

            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);


            try {

              // aqui completas la transaccion
              // $payment->execute consulta en segundo plano si la transaccion fue exitosa
              // Si fue exitosa retorna un HTTP 200 y devuelve un objeto
              // que se almacena el $result
              // Si el procedo no fue completado con exito retorna un HTTP 4XX y un objeto
              // con los posibles motivos del error
              // aqui tienes un ejemplo https://paypal.github.io/PayPal-PHP-SDK/sample/doc/payments/ExecutePayment.html
              $result = $payment->execute($execution, $apiContext);

              // haces un dump del objeto para que veras toda la
              // info que proporciona
              // var_dump($result);

              if($result->state != "approved") {
                // redirrecciona a una pagina de 'error'
                die('El pago no se realizo');
              } else {


                /////////////OBTENGO LOS DATOS DEL OBJETO Q ME REGRESA PAYPAL
                $transactionsClient = $result->transactions[0];
                $itemListClient     = $transactionsClient->item_list;
                $itemsClient        = $itemListClient->items;

                //////////precio de compra
                $detalleCompraPaypal=$result->transactions[0];
                $total_paypal=$detalleCompraPaypal->amount->total;
               /* echo "<br> el detalle es ".$detalleCompraPaypal;
                echo "<br>el precio ".$total_paypal."<br>";*/
                $array_nombre_tema;
                $array_id_tema;
                $array_precio;

                //esto es para las membresias
                $tipo_membresia="";
                $precio_membresia=0;

                //para agregar el modulo de membresia voy a usar una variable booleana
                $bandera_mebresia=false;
                foreach ($itemsClient as $key => $value) {
                    /*echo $value->name.'<br>';*/
                    $array_nombre_tema[$key]=$value->name;

                    /*echo $value->sku.'<br>';*/
                    $array_id_tema[$key]=$value->sku;

                    /*echo $value->price.'<br>';*/
                    $array_precio[$key]=$value->price;
                   /* echo '----';*/

                    if($value->sku=='1'){
                      $tipo_membresia=$value->name;
                      $precio_membresia=$value->price;
                      $bandera_mebresia=true;//ha comprado una membresia
                    }
                }


              /*echo "<pre>";
              var_dump($result);
              echo "</pre>";*/
              /*die('TODO BIEN');*/
              require'../Modelo/class_mdl_bd_conexion.php';
              require'../Modelo/class_mdl_cliente_producto.php';
              require'../Modelo/class_mdl_membresia.php';

              include'../Controlador/class_ctr_cliente_producto.php';
              include'../Controlador/class_ctr_membresia.php';
              $id_Cliente=$_GET['id_cliente'];
              $total_cancelar=$total_paypal;


              switch ($bandera_mebresia) {
                  case true:
                      echo "compro_membresia";
                      $metodo="PayPal";
                      $respuesta_membresia=CtrMembresia::ctr_agregar_membresia($tipo_membresia,$id_Cliente,$total_cancelar,$metodo);
                      print_r($respuesta_membresia);
                  
                      header("Location:../admin_cliente.php");//
                      break;
                  case false:
                      echo "no compro membresia";//compro canciones por unidad
                      //=============================iNGRESAR DATOS FACTURA DE COMPRA EN LA BASE DE DATOS===========

                      $respuesta_factura=CtrCliente_Producto::ctr_crear_factura($id_Cliente,$total_cancelar);
                      print_r($respuesta_factura['id_factura']);
                      $id_factura=$respuesta_factura['id_factura'];

                      //================================Ingresar Cliente Producto================
                      //================================Ingresar Cliente Producto================
                      $metodo="PayPal";
                      $paymentId = $_GET['paymentId'];
                      $contador=0;
                      while ( $contador<count($array_precio)) {
                          //insertar datos en la base de datos
                          $respuesta_cliente_producto=CtrCliente_Producto::ctr_agregar_productos_adquiridos_cliente($id_factura,
                                                                                                                  $id_Cliente,
                                                                                                                  $array_id_tema[$contador],
                                                                                                                  $metodo,
                                                                                                                  $paymentId,
                                                                                                                  $array_precio[$contador]
                      );//guardo productos del cliente q compro

                      $contador++;
                      print_r($respuesta_cliente_producto);

                  }//fin del while
                          echo"exito ";
                             //============BORRO LA CESTA=================//
                    
                    echo '<script>
                            localStorage.removeItem("listaProductos");
                            localStorage.removeItem("cantidadCesta");
                          </script>';
                          //print_r($result->payer->payer_info->email);
                          header("Location:../admin_cliente.php");//

                      break;

              }




            }//end else

            } catch (PayPal\Exception\PayPalConnectionException $ex) {
              echo $ex->getCode();
              echo $ex->getData();
              die($ex);
              } catch (Exception $ex) {
              die($ex);
          }
      }

?>
