<?php

ini_set('display_errors', 'On');

require __DIR__ .'/bootstrap.php';
//LAS CLASES DE PAY PAL
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
session_start();// simepre inicializo session par apoder hacer la compracion, si el cliente esta logado
include'ctrProductoItem.php';// para poder filtrar los datos

//llamo a la factura para crear la factura para enviar al correo del cliente
require'../model/conexion.php';
require'../model/mdlFactura.php';


$descripcionProducto="";


    //==========comprobar si exite un session o el cliente esta logiando==================//
    if( isset($_SESSION['usuario']) and $_SESSION['tipo_usuario']=='cliente' and isset($_SESSION['id_cliente']) ){
        //========OpcionPago
        switch (@$_POST['valueRadio']) {
            case 'paypal':
                $descripcionProducto="Producto";
                break;
            case 'membresia':
                $descripcionProducto="Membresia";
                break;
            default:
                # code...
                break;
        }
    

    }else{
            $respuesta=array('respuesta'=>'noExiseLogin');
            die(json_encode($respuesta));
    }

    //==========================PREPARA DATA PARA ENVIAR A PAYPAL================
    if($descripcionProducto!=""){

        $FiltroIdProducto=ModeloProductoItem::SeperacionDatos(@$_POST['idProducto'],'idProducto');
        $FiltroNombreProducto=ModeloProductoItem::SeperacionDatos(@$_POST['nombreProducto'],'nombreProducto');
        $FiltroPrecioProducto=ModeloProductoItem::SeperacionDatos(@$_POST['precioUnitarioProducto'],'idProducto');
        $i=0;
        $sumaTotalCancelar=0;
        $compra=new Payer();
        $compra->setPaymentMethod('paypal');
        $arregloProductos=array();
    
        foreach ($FiltroPrecioProducto as  $key => $value) {
            ${"articulo$key"}=new Item();
            $arregloProductos[]=${"articulo$key"};
    
            ${"articulo$key"}->setName($descripcionProducto.' : '.$FiltroNombreProducto[$key])//el i lleva el nombre de la cancion
                            ->setCurrency('USD')//la moneda a cobrar
                            ->setQuantity((int)1)//siempre la cancion va hacer (1)
                            ->setSku($FiltroIdProducto[$key])
                            ->setPrice((double)$FiltroPrecioProducto[$key] );//precio de la cancion
    
                        $sumaTotalCancelar=(double)$FiltroPrecioProducto[$key]+$sumaTotalCancelar;
        }
        //echo "este son lo ids de los producto";
        //echo"<br>". $articulo0->getPrice();//nombre del tema selecionado
        $listaArticulos=new ItemList();
        $listaArticulos->setItems($arregloProductos);
        //print_r($listaArticulos->getItems());
    
        $cantidad=new Amount();
        $cantidad->setCurrency('USD')
                ->setTotal((double)$sumaTotalCancelar);//total a pagar con 3 producto(2 cancio9n y un boton)
        //print_r($cantidad-> getTotal());
    
        //=================caractersiticas de la trsaccion=============
        $transaccion= new Transaction();
        $transaccion->setAmount($cantidad)
                    ->setItemList($listaArticulos)
                    ->setDescription('LatinEdit.com')
                    ->setInvoiceNumber(uniqid()); //registro numero unico de esa trasaccion
                    //echo "este es unico".$transaccion->getInvoiceNumber();
                    $ID_registro=$transaccion->getInvoiceNumber();
    
        //print_r($transaccion);
        // =====================Redireccionar a la pagina de paypal o si cancelan no se ejcuta el pago===============
        
        //se crea diferentes archivos para la ejecucion del pago tanto por unidad y membresias
        
        //Id de la orden interna de la tienda puede ser alfajumérico //0038
        $ultimoRegistroFactura=ModeloFacura::sqlUltimoRegistro();
        //el numero de la orde la tomo de la tabla factura
        $order = (($ultimoRegistroFactura[0]['id'])+1)."-". time();
        switch ($descripcionProducto) {
            case 'Producto':
                # code...
                //llenamos el array de productos para entregar la factura
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

                $datos = array(
                    'products' => json_encode($products),
                    'total' => $sumaTotalCancelar,
                    'email' => $_POST['correoFc'],
                    'first_name' => $_POST['nombreFc'],
                    'last_name' => $_POST['apellidoFc'],
                    'document' => $_POST['documentoIdentidadFc'], //Cédulo o RUC del cliente
                    'phone' => $_POST['telefonoFc'],//Teléfono del cliente
                    'address' =>  $_POST['direccionFc'],
                    'order_id' => $order,
                    'date' => date('Y-m-d'),
                    
                );
                //creamos una variable de sesion con la data 
                @$_SESSION["datosOrden"]=null;
                @$_SESSION["datosOrden"]=$datos;
            
                $redireccionar=new RedirectUrls();
                $redireccionar->setReturnUrl(URL_SITIO."/Paypal/pagoFinalizadoPaypal.php?idCliente=".$_SESSION['id_cliente'])//pago exitoso
                              ->setCancelUrl(URL_SITIO."/Paypal/pagoFinalizadoPaypal.php?exito=false&idpago{$ID_registro}");
                break;

    
            case 'Membresia':
                $redireccionar=new RedirectUrls();
                $redireccionar->setReturnUrl(URL_SITIO."/Paypal/pagoFinalizadoPaypalMembresia.php?numDescargas=".$_POST['numDescargas']."&idCliente=".$_SESSION['id_cliente'])//pago exitoso
                              ->setCancelUrl(URL_SITIO."/Paypal/pagoFinalizadoPaypalMembresia.php?exito=false&idpago{$ID_registro}");
                break;
            default:
                # code...
                break;
        }
        // =====================Redireccionar a la pagina de paypal o si cancelan no se ejcuta el pago===============
      
    
        $pago=new Payment();
        $pago->setIntent("sale")
            ->setPayer($compra)
            ->setRedirectUrls($redireccionar)
            ->setTransactions(array($transaccion));
    
            try{
                $pago->create($apiContext);
            }catch(PayPal\Exception\PayPalConnectionException $pce){
                echo"<pre>";
                print_r(json_decode($pce->getData()));
                exit;
                echo"</pre>";
            
            }
            
            $aprobado=$pago->getApprovalLink();
            //echo $aprobado;//imprimo la url de paypal para que el ajax de respuesta lo capte y me direccione a paypal
            //print_r($_POST);
            $respuesta=array('urlPaypal'=>$aprobado,
                             'respuesta'=>'exito',
                             '$pce'=>$pce,
                            'tipoRespuesta'=>'paypal',
                            'totoal_cancelar'=>@$_POST['totalCancelar']);
             die(json_encode($respuesta));
    }
   
?>