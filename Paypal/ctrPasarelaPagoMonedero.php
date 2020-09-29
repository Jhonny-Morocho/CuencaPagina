<?php

ini_set('display_errors', 'On');


require'ctrEntregarProductoCliente.php';
include'ctrProductoItem.php';// para poder filtrar los datos
require'../model/mdlCliente.php';
@session_start();// simepre inicializo session par apoder hacr la compracion, si el cliente esta logado
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
                
                die(json_encode(array('clienteEncotrado'=>$banderaEncontradoCliente,'respuesta'=>'exito',
                                        'urlPanel'=>'../../adminCliente.php','saldoActualizado'=>$respuestaSaldoActualizado['respuesta'],
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