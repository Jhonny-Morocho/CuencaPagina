<?php

ini_set('display_errors', 'On');

require'../Paypal/ctrEntregarProductoCliente.php';
include'../Paypal/ctrProductoItem.php';// para poder filtrar los datos
//llamo al modelo
require'../model/mdlFactura.php';
require'../model/mdlCliente.php';
@session_start();// simepre inicializo session par apoder hacr la compracion, si el cliente esta logado
$descripcionProducto="";


//==========comprobar si exite un session o el cliente esta logiando==================//
if( isset($_SESSION['usuario']) and $_SESSION['tipo_usuario']=='cliente' and isset($_SESSION['id_cliente']) ){
    //========OpcionPago

        $FiltroIdProducto=ModeloProductoItem::SeperacionDatos(@$_POST['idProducto'],'idProducto');
        $FiltroNombreProducto=ModeloProductoItem::SeperacionDatos(@$_POST['nombreProducto'],'nombreProducto');
        $FiltroPrecioProducto=ModeloProductoItem::SeperacionDatos(@$_POST['precioUnitarioProducto'],'idProducto');
        $arrayClientes=ModeloCliente::sqlListarClientes();
        
        
        //filtramos al cliente para conocer su saldo
        $banderaEncontradoCliente=false;

      
        foreach ($arrayClientes as $key => $value) {
            #si el numero de descargas es mayor a cero etonces puede comprar
            if($value['id']==$_SESSION['id_cliente']){
                $banderaEncontradoCliente=true;
            }
        }

        //============ parametros de configracion de la api de pagos ============

        //Armo los productos de mi orden
        //llenamos el array de productos para enviar a la api
        for ($i=0; $i < count($FiltroIdProducto) ; $i++) {
            //id del producto 
            $products[$i]['id'] = $FiltroIdProducto[$i];
            //Nombre del Producto//expresion regular por que no acepta caracteres
            $nombreProducto=preg_replace('/[(-)-&]{1}/', ' ', $FiltroNombreProducto[$i]);
            $products[$i]['nombre'] = $nombreProducto;
            //Valor sin TAX del producto
            $products[$i]['subtotal'] = 0;
            // Impuesto del producto
            $products[$i]['tax'] = 0;
            //Valor total del producto
            $products[$i]['total'] =$FiltroPrecioProducto[$i];
            // //Cantidad del producto
            $products[$i]['cantidad'] = 1;

            //Subtotal 0 es la suma de los subtototales de los productos que no gravan IVA

            $sumaTotal=$FiltroPrecioProducto[$i]+ $sumaTotal;
        }
        
        //==== vamos agregar un producto mas para poder cobrar los recargos ===//
        $posicion=(count($FiltroIdProducto))+1;

        $products[ $posicion]['id'] = 'CPUS';
        //Nombre del Producto //COSTO POR TRANSACCION
        $products[ $posicion]['nombre'] = 'COSTO POR USO DEL SERVICIO';
        //Valor sin TAX del producto
        $products[ $posicion]['subtotal'] = 0;
        // Impuesto del producto
        $products[ $posicion]['tax'] = 0;
        //Valor total del producto
        $products[ $posicion]['total'] =0.30;
        // //Cantidad del producto
        $products[ $posicion]['cantidad'] = 1;
        //le vuelvo a sumar los 0.30 centavos
        $sumaTotal=0.30+ $sumaTotal;



        //Subtotal 0 es la suma de los subtototales de los productos que no gravan IVA
        $subtotal_order_0 = number_format($sumaTotal, 2, '.', '');

        //Subtotal 0 es la suma de los subtototales de los productos que si gravan IVA + el valor del Envio (si aplica)
        $subtotal_order_12 = number_format(0, 2, '.', '');

        //Tax es el valor del impuesto a partir del Subtotal
        $tax_order = number_format($subtotal_order_12*0.0, 2, '.', '');
        //Total es la suma del Subtotal + Tax
        $total_order = number_format($subtotal_order_0+$subtotal_order_12+$tax_order, 2, '.', '');

        /**
         * Función que permite obtener la ip del cliente que realiza el pago
         * 
         * */
        function get_client_ip() 
        {
            $ipaddress = "";
            if (getenv("HTTP_CLIENT_IP"))
                $ipaddress = getenv("HTTP_CLIENT_IP");
            else if(getenv("HTTP_X_FORWARDED_FOR"))
                $ipaddress = getenv("HTTP_X_FORWARDED_FOR");
            else if(getenv("HTTP_X_FORWARDED"))
                $ipaddress = getenv("HTTP_X_FORWARDED");
            else if(getenv("HTTP_FORWARDED_FOR"))
                $ipaddress = getenv("HTTP_FORWARDED_FOR");
            else if(getenv("HTTP_FORWARDED"))
            $ipaddress = getenv("HTTP_FORWARDED");
            else if(getenv("REMOTE_ADDR"))
                $ipaddress = getenv("REMOTE_ADDR");
            else
                $ipaddress = "UNKNOWN";
            return $ipaddress;
        }

        //Id de la orden interna de la tienda puede ser alfajumérico //0038
        $ultimoRegistroFactura=ModeloFacura::sqlUltimoRegistro();
        //el numero de la orde la tomo de la tabla factura
        $order = (($ultimoRegistroFactura[0]['id'])+1)."-". time();
        //Armo el array a enviar

        $datos = array(
            'products' => json_encode($products),
            'total' => $total_order,
            'tax' => $tax_order,
            'subtotal12' => $subtotal_order_12,
            'subtotal0' => $subtotal_order_0, //Subtotal de los productos que no gravan IVA
            'email' => $_POST['correoFc'],
            'first_name' => $_POST['nombreFc'],
            'last_name' => $_POST['apellidoFc'],
            'document' => $_POST['documentoIdentidadFc'], //Cédulo o RUC del cliente
            'phone' => $_POST['telefonoFc'],//Teléfono del cliente
            'address' =>  $_POST['direccionFc'],
            'ip_address' => get_client_ip(),//Función con la IP del cliente
            'order_id' => $order,
            'shipping' => 0.0, //Valor del envío sin impuestos
            'shipping_tax' => 0.0,//Valor del impuesto del envío, si existe valor de envío el impuesto es obligatorio por los Bancos
            'gateway' => 'botonpagos',
            'status' => 'pending ',
            'date' => date('Y-m-d'),
            'url_response' => 'https://www.latinedit.com/PayAgile/pagoFinalizadoPayAgile.php?order='.$order //Este campo es opcional en el caso de APPS Móviles
        );
        //creamos una variable de sesion con la data 
        @$_SESSION["datosOrden"]=null;
        @$_SESSION["datosOrden"]=$datos;


        //validacion para realizar la compra
        if ($banderaEncontradoCliente==true) {
            try {
          
                die(json_encode(array(
                                'clienteEncotrado'=>$banderaEncontradoCliente,
                                'respuesta'=>'exito',
                                'finalizarCompraTarjeta'=>'../../finalizar-compra-tarjeta.php',
                                )));
            } catch (\Throwable $th) {
                //throw $th;
                //AVECES NO IMPRIME EL ERROr
                die(json_encode(array('respuesta'=>$th)));
            }

        }else{
            die(json_encode(array('clienteEncotrado'=>$banderaEncontradoCliente)));
        }
     

    }else{
            $respuesta=array('respuesta'=>'noExiseLogin');
            die(json_encode($respuesta));
    }

   
   
?>