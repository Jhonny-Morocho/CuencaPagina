<?php
  //codigo del establecimiento
  //traigo a php mailes
  use PHPMailer\PHPMailer\PHPMailer;
  require'../PHPMailer/vendor/autoload.php';
  //requiero el template de la factura 
  include'template/templateFacturaCompra.php';
  //clase para separ los prodcutos por item
  include'../Paypal/ctrProductoItem.php';// para poder filtrar los datos

  //llamo a la factura para crear la factura para enviar al correo del cliente
  require'../model/conexion.php';
  require'../model/mdlFactura.php';

  $FiltroIdProducto=ModeloProductoItem::SeperacionDatos(@$_POST['idProducto'],'idProducto');
  $FiltroNombreProducto=ModeloProductoItem::SeperacionDatos(@$_POST['nombreProducto'],'nombreProducto');
  $FiltroPrecioProducto=ModeloProductoItem::SeperacionDatos(@$_POST['precio'],'idProducto');

  //Id de la orden interna de la tienda puede ser alfajumérico //0038
  $ultimoRegistroFactura=ModeloFacura::sqlUltimoRegistro();
  //el numero de la orde la tomo de la tabla factura
  $order = (($ultimoRegistroFactura[0]['id'])+1)."-". time();
  for ($i=0; $i < count($FiltroIdProducto) ; $i++) {
    //id del producto 
    $products[$i]['id'] = $FiltroIdProducto[$i];
    //Nombre del Producto
    $products[$i]['nombre'] = $FiltroNombreProducto[$i];
    //Valor sin TAX del producto
    $products[$i]['subtotal'] = 0;
    // Impuesto del producto
    $products[$i]['tax'] = 0;
    //Valor total del producto
    $products[$i]['total'] =$FiltroPrecioProducto[$i];
    // //Cantidad del producto
    $products[$i]['cantidad'] = 1;
  }

  $datosCliente=array("nombre"=>$_POST['nombre'],
                      "apellido"=>$_POST['apellido'],
                      "correo"=>$_POST['correo'],
                      "direccion"=>$_POST['direccion'],
                      "telefono"=>$_POST['telefono'],
                      "fecha"=>date('Y-m-d'),
                      "documentoIdentidad"=>$_POST['documentoIdentidad'],
                      "orden"=>$order);

  $HtmlFactura=ClassPlantilla::templateFactura($_POST['metodoPago'],$products,$datosCliente);
  //envio notificacion al adminsitrador
  enviarCorreo('djmarkoarias@hotmail.com',$HtmlFactura);
  //envio notificacion al cliente
  enviarCorreo($_POST['correo'],$HtmlFactura);
  function enviarCorreo($correo,$factura){
      $mail=new PHPMailer();
      $mail->CharSet='UTF-8';
      $mail->isMail();
      $mail->setFrom('support@latinedit.com','LATINEDIT.COM');
      $mail->addReplyTo('support@latinedit.com','LatinEdit.com');
      $mail->Subject=('Factura de Compra latinedit.com');
      $mail->addAddress($correo);
      $mail->msgHTML($factura);
      $envio=$mail->Send();
      if ($envio) {
          # code...
          echo "true";
      }else{
          echo "false";
      }
  }


?>