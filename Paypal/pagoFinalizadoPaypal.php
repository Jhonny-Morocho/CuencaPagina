
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
        //correo api
        use PHPMailer\PHPMailer\PHPMailer;
 


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
                //echo '<script>window.location ="../resultado.php?estado=false"; </script>';
                header("Location:../resultado.php?estado=false");//
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
                  //===========Coemente esto x el producto no sera el numero 1====
                    // if($value->sku=='1'){//comprobar si el producto es una membresia===Siempr el id de la membresia sera 1, o el id del producto, por q asi lo define yo= programador
                    //   $tipoMembresia=$value->name;
                    //   $precioMembresia=$value->price;
                    //   $bandera_mebresia=true;//ha comprado una membresia
                    // }
                }

                //print_r($itemsClient);              
                // ===================Asignar productos al cliente=======================
                //primero se inicia la session para que la plantilla pueda cargar esos datos
                @session_start();// simepre inicializo session par apoder hacr la compracion, si el cliente esta logado
                //traigo a php mailes
                require'../PHPMailer/vendor/autoload.php';
                //requiero el template de la factura 
                require'../PayAgile/facturaPayAgile.php';


                require'ctrEntregarProductoCliente.php';
                //print_r($_GET);
                //se realiza el pago y se direcciona al cliente a visualizar sus productos
                ClassEntregarProductoCliente::comproMusica($_GET['idCliente'],$total_paypal,$array_precio,$array_id_tema,'PayPal');
                
                //========= Entregamos productos al cliente mediante el correo ===//
                
                //Plantilla para generar factura
       
                $factura=ClassPlantilla::templateFactura('PayPal');

                function enviarCorre($correo,$factura){
                  $mail=new PHPMailer();
                  $mail->CharSet='UTF-8';
                  $mail->isMail();
                  $mail->setFrom('support@latinedit.com','LATINEDIT.COM');
                  $mail->addReplyTo('support@latinedit.com','LatinEdit.com');
                  $mail->Subject=('Factura de Compra latinedit.com');
                  $mail->addAddress($correo);
                  $mail->msgHTML($factura);
                  $envio=$mail->Send();
                  if ($envio==true) {
                      # code...
                      return "true";
                     // echo "correo enviado";
                  }else{
                      //echo "correo no enviado";
                      return "false";
                  }
  
                }
                //enviamos correo al cliente
                enviarCorre(@$_SESSION['datosOrden']['email'],$factura);
                //enviamos correo al administrador
                enviarCorre('djmarkoarias@hotmail.com',$factura);
       
                //echo '<script>localStorage.clear();</script>';
                  // le hago con php para que no se muera la session
                //echo '<script>window.location ="../resultado.php?resultado.php?estado=true"; </script>';
                
                header("Location:../resultado.php?estado=true");//
                //echo '<script>window.location ="../adminCliente.php"; </script>';//direcciono al penel de administracion del 

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
