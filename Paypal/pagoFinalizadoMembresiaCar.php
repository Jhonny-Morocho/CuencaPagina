<?php
    ini_set('display_errors', 'On');
    use PHPMailer\PHPMailer\PHPMailer;
    @session_start();
    require'../PHPMailer/vendor/autoload.php';
     //plantilla para generar factura
     require'../PayAgile/facturaPayAgile.php';
    try {
        $factura=ClassPlantilla::templateFactura('Membresia');
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
               // return "true";
                echo "correo si enviado";
            }else{
                echo "correo no enviado";
               // return "false";
            }
        }
        //enviamos correo al cliente
        $res=enviarCorre(@$_SESSION['datosOrden']['email'],$factura);
        //enviamos correo al administrador
        enviarCorre('djmarkoarias@hotmail.com',$factura);
        //redirecciono
        header("Location:../resultado.php?estado=true");//
      
    } catch (Exception $ex) {
       header("Location:../resultado.php?estado=".$ex);//
    }

?>