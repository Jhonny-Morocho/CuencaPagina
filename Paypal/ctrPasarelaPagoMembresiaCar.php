<?php

ini_set('display_errors', 'On');


include'ctrProductoItem.php';// para poder filtrar los datos
require'ctrEntregarProductoCliente.php';
require'../model/mdlClienteMembresia.php';
//Saco el numero de factura
//require'../model/mdlFactura.php';
@session_start();// simepre inicializo session par apoder hacr la compracion, si el cliente esta logado
$descripcionProducto="";

//print_r($_POST);

    //==========comprobar si exite un session o el cliente esta logiando==================//
    if( isset($_SESSION['usuario']) and $_SESSION['tipo_usuario']=='cliente' and isset($_SESSION['id_cliente']) ){
        //========OpcionPago
        $FiltroIdProducto=ModeloProductoItem::SeperacionDatos(@$_POST['idProducto'],'idProducto');
        $FiltroNombreProducto=ModeloProductoItem::SeperacionDatos(@$_POST['nombreProducto'],'nombreProducto');
        $FiltroPrecioProducto=ModeloProductoItem::SeperacionDatos(@$_POST['precioUnitarioProducto'],'idProducto');
        $i=0;
        $sumaTotalCancelar=0;
        //$arrayMembresiaCliente=Modelo_Membresia::comprobarEstadoMembresiaCliente($_SESSION['id_cliente']);
        $membresiaCliente =Modelo_Membresia::sqlListarMembresiasCliente($_SESSION['id_cliente']);

        //recorro las membresias para ver cual de todas tiene decargas
        $idMembresia=0;
        $rangoDescargas=0;
        $fechaCompra="";
        $fechaExpira="";
        $precioUnitario=0;
        $nombreMembresia="";
        $banderaNumeroDescargas=false;

        date_default_timezone_set('America/Guayaquil');
        $fecha_actual=date("Y-m-d");

        foreach ($membresiaCliente as $key => $value) {
            #si el numero de descargas es mayor a cero etonces puede comprar
            $date1 = new DateTime($value['fechaCompra']);
            $date2 = new DateTime($fecha_actual);
            $diff = $date1->diff($date2);
            // comprobar caducidad 
            // si resto los 30 dias me va a dar 0 , x por lo tanto caduca en <1
            if($value['numDescargas']>0 && $diff->days<=30){
                $idMembresia=$value['id'];
                $rangoDescargas=$value['numDescargas'];
                $fechaCompra=$value['fechaCompra'];
                $fechaExpira=$value['fechaExpiracion'];
                $precioUnitario=$value['precioUnitario'];
                $nombreMembresia=$value['tipoPago'];
                $banderaNumeroDescargas=true;
            }
        }


    
        switch ($banderaNumeroDescargas) {
            case 1:
                
                //ClassEntregarProductoCliente::comproMusica($_SESSION['id_cliente'],);
                if ($rangoDescargas>=count($FiltroIdProducto)) {
                    $montoCancelar=$precioUnitario*count($FiltroIdProducto);
                    // cambiamos los precios a los productos, escojo cualqueir arya solo para iterar
                    $arrayAuxPrecio=array();
                    foreach ($FiltroPrecioProducto as $key => $value) {
                       $arrayAuxPrecio[$key]=$precioUnitario;
                    }
                    // actualizo el numero de descargas
                    try {
                        //code...
                        Modelo_Membresia::sqlActualizarMembresiaCliente($idMembresia,($rangoDescargas-count($FiltroIdProducto)));
                        // entrego los prodictos


                        ClassEntregarProductoCliente::comproMusica($_SESSION['id_cliente'],$montoCancelar,$arrayAuxPrecio,$FiltroIdProducto,'Membresia');

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
                            $products[$i]['total'] =$arrayAuxPrecio[$i];
                            // //Cantidad del producto
                            $products[$i]['cantidad'] = 1;
                        }
                        //obtengo el numero de factura
                        //Id de la orden interna de la tienda puede ser alfajumérico //0038
                        $ultimoRegistroFactura=ModeloFacura::sqlUltimoRegistro();

                        $order = (($ultimoRegistroFactura[0]['id'])+1)."-". time();
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

                        die(json_encode(array('respuesta'=>'exito','urlPanel'=>'../../Paypal/pagoFinalizadoMembresiaCar.php')));
                    } catch (\Throwable $th) {
                        //throw $th;
                        die(json_encode(array('respuesta'=>$th)));
                    }
                    
                }else{
                    die(json_encode(array('respuesta'=>'numInferiorDescargas','numDescagasActual'=>$rangoDescargas)));
                }
                
                break;
            case 0:
                # code...
                die(json_encode(array('respuesta'=>'fall','numDescargasActual'=>$rangoDescargas)));
            
                break;
            default:
                # code...
                break;
        }


    }else{
            $respuesta=array('respuesta'=>'noExiseLogin');
            die(json_encode($respuesta));
    }

   
   
?>