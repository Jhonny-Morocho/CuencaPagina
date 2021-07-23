<?php

ini_set('display_errors', 'On');
ini_set('session.cache_expire', 600);
ini_set('session.gc_maxlifetime', 36000);
ini_set('session.cookie_lifetime',36000);

session_cache_expire(600);
session_set_cookie_params(36000);
@session_start();// simepre



require'ctrEntregarProductoCliente.php';
include'ctrProductoItem.php';// para poder filtrar los datos
require'../model/mdlCliente.php';
//Saco el numero de factura
//require'../model/mdlFactura.php';

$descripcionProducto="";

//print_r($_POST);

//==========comprobar si exite un session o el cliente esta logiando==================//
if( isset($_SESSION['usuario']) and $_SESSION['tipo_usuario']=='cliente' and isset($_SESSION['id_cliente']) ){
    //========OpcionPago
  
        $FiltroIdProducto=ModeloProductoItem::SeperacionDatos(@$_POST['idProducto'],'idProducto');
        $FiltroNombreProducto=ModeloProductoItem::SeperacionDatos(@$_POST['nombreProducto'],'nombreProducto');
        $FiltroPrecioProducto=ModeloProductoItem::SeperacionDatos(@$_POST['precioUnitarioProducto'],'idProducto');
        $arrayClientes=ModeloCliente::sqlListarClientes();
        
        //filtramos al cliente para conocer su saldo
        $banderaEncontradoCliente=false;
        $saldoMonedero=0;
        foreach ($arrayClientes as $key => $value) {
            #si el numero de descargas es mayor a cero etonces puede comprar
            if($value['id']==$_SESSION['id_cliente']){
                $saldoMonedero=$value['saldoActual'];
                $banderaEncontradoCliente=true;
            }
        }

   
        //validacion para realizar la compra
        if ($banderaEncontradoCliente==true && $saldoMonedero>$_POST['totalCancelar']) {

            # code...
            try {
                //code...
                // actualizo el saldo del cliente una vez que realiza la compra
                $saldoActualizar=($saldoMonedero-$_POST['totalCancelar']);
                $respuestaSaldoActualizado=ModeloCliente::sqlEditarSaldoCliente($_SESSION['id_cliente'],$saldoActualizar);
                // entrego los prodictos al cliente
                ClassEntregarProductoCliente::comproMusica($_SESSION['id_cliente'],$_POST['totalCancelar'],$FiltroPrecioProducto,$FiltroIdProducto,'Monedero');
                //Id de la orden interna de la tienda puede ser alfajumérico //0038
                $ultimoRegistroFactura=ModeloFacura::sqlUltimoRegistro();

                //obtengo el numero de factura
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
                
                $order = (($ultimoRegistroFactura[0]['id'])+1)."-". time();
                $datos = array(
                    'products' => json_encode($products),
                    'total' => $_POST['totalCancelar'],
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

                die(json_encode(array('clienteEncotrado'=>$banderaEncontradoCliente,'respuesta'=>'exito',
                                        'urlPanel'=>'../../resultado.php?estado=true&metodoPago=Monedero',    
                                        'saldoModeneroActualizafo'=>$saldoActualizar)));
            } catch (\Throwable $th) {
                //throw $th;
                //AVECES NO IMPRIME EL ERROr
                die(json_encode(array('respuesta'=>$th)));
            }

        }else{
            die(json_encode(array('clienteEncotrado'=>$banderaEncontradoCliente,'respuesta'=>'saldoInsuficiente',
            'saldoModenero'=>$saldoMonedero)));
        }
     

    }else{
            $respuesta=array('respuesta'=>'noExiseLogin');
            die(json_encode($respuesta));
    }

   
   
?>