<?php
    require __DIR__ .'/bootstrap.php';
    ini_set('display_errors', 'On');
    //LAS CLASES DE PAY PAL
    use PayPal\Api\Payer;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Details;
    use PayPal\Api\Amount;
    use PayPal\Api\Transaction;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Payment;

    require'ctrProductoItem.php';
   
    //print_r($_POST);

    //OpcionPago
    switch (@$_POST['valueRadio']) {
        case 'paypal':
            //print_r($_POST);
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

                ${"articulo$key"}->setName('Producto : '.$FiltroNombreProducto[$key])//el i lleva el nombre de la cancion
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
            $idCliente=1;//solo temportal
            $redireccionar=new RedirectUrls();
            $redireccionar->setReturnUrl(URL_SITIO."/Paypal/pagoFinalizadoPaypal.php?idCliente=$idCliente")//pago exitoso
                          ->setCancelUrl(URL_SITIO."/Paypal/pagoFinalizadoPaypal.php?exito=false&idpago{$ID_registro}");
        
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
                                 'aprobado'=>'exito',
                                'tipoRespuesta'=>'paypal',
                                'totoal_cancelar'=>@$_POST['totalCancelar']);
                die(json_encode($respuesta));

       
            break;
        
        default:
            # code...
            break;
    }
?>