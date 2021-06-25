<?php
    ini_set('display_errors', 'On');
    //use PHPMailer\PHPMailer\PHPMailer;

    //entregar producto al cliente//esta clase se encuentra en paypal
    try {
        
        require'../Paypal/ctrEntregarProductoCliente.php';
        //plantilla para generar factura
        //require'facturaPayAgile.php';
        //require'../PHPMailer/vendor/autoload.php';
        //primero envaimos el correo al cliente con la factura
        //print_r($_SESSION);
        
        $code='607ef3bf6edfe';
        $order=$_GET['order'];

        $url = "https://portal.botonpagos.com/api/datafast/tienda/getOrder/".$code."/".$order;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);

        if(curl_error($ch)){
            echo curl_error($ch);
        }

        curl_close($ch);
        $responseData = json_decode($responseData, true);

        // si hay error entonces no se realiza la entrega del producto
        if($responseData["error_code"]){
            header("Location:../resultado.php?estado=".$responseData ["error_description"] );//

        }else{
            //Se entrega el producto
            @session_start(); 
            //aqui esta los productos y el total de la factura
            $datosOrden=@$_SESSION['datosOrden'];
            //los productos que compro el cliente
            
            $productos=json_decode(@$_SESSION['datosOrden']['products'], true);
            // creamos un array para elimin ar el producots con el id CPUS, ya que este producto solo es 
            // para cobrar comisión
            //si reduce el precio del producto a los djs/ por el uso de la tarjeta entonces en un 10%
            
            $array_precio=[];
            $array_id_tema=[];
            $total=0;
            for ($i=0; $i < (count($productos)-1); $i++) { 
                $float = ($productos[$i]['total']-($productos[$i]['total'])*0.30);
                $array_precio[$i]=sprintf("%.2f", $float);
                $array_id_tema[$i]=$productos[$i]['id'];
                //total de la suma de los nuevos precios 
                $total=$total+sprintf("%.2f", $float);
            }
            $idCliente= @$_SESSION['id_cliente'];
            //entrego producto al cliente
            ClassEntregarProductoCliente::comproMusica($idCliente,$total,$array_precio,$array_id_tema,'Tarjeta');
            //borro el carrito

            //Entregamos productos al cliente mediante el correo
            // $factura=ClassPlantilla::templateFactura('Tarjeta');

            // function enviarCorre($correo,$factura){
            //     $mail=new PHPMailer();
            //     $mail->CharSet='UTF-8';
            //     $mail->isMail();
            //     $mail->setFrom('support@latinedit.com','LATINEDIT.COM');
            //     $mail->addReplyTo('support@latinedit.com','LatinEdit.com');
            //     $mail->Subject=('Factura de Compra latinedit.com');
            //     $mail->addAddress($correo);
            //     $mail->msgHTML($factura);
            //     $envio=$mail->Send();
            //     if ($envio) {
            //         echo  "true";
            //     }else{
            //         echo "false";
            //     }

            // }
            //enviamos correo al cliente
            // enviarCorre(@$_SESSION['datosOrden']['email'],$factura);
            // //enviamos correo al administrador
            // enviarCorre('djmarkoarias@hotmail.com',$factura);

            //echo '<script>localStorage.clear();</script>';
            //redireccionar
            //echo '<script>window.location ="../resultado.php?estado=true"; </script>';
            echo '<script>window.location ="../resultado.php?estado=true&metodoPago=Tarjeta"; </script>';//direcciono al penel de administracion del 
            //header("Location:../resultado.php?estado=true");//

        }
    } catch (Exception $ex) {
        header("Location:../resultado.php?estado=".$ex);//
    }

?>