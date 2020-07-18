<?php

ini_set('display_errors', 'On');

//============Conexion a la base datos=============//
require'../model/conexion.php';
//============Traer  del producto de cliente producto para poder realizar la facturacion=============//
require'../model/mdlFactura.php';
//============Entregar los producots al cliente=============//
require'../model/mdlClienteProducto.php';

class ClassEntregarProductoCliente {

    public static function comproMusica($idCliente,$montoCancelar,$arrayPrecio,$arrayIdProductos){

        //1. Generar la factura , para ellos guardo el id de cliente,monto que canelo , en la tabla factura
        $respustaFactura=ModeloFacura::sqlGerarFactura($idCliente,$montoCancelar);

        //2. de la respuesta obtengo el idFactura para poder entregar los productos

        $arrayInfoFactura=array('idFactura'=>$respustaFactura['idFactura'],
                                            'idCliente'=>$idCliente,
                                            'metodoPago'=>'Paypal');
        // guardar los datos o los productos para darle al cliente

        //print_r($arrayPrecio);
        foreach ($arrayPrecio as $key => $value) {
            //echo "[".$arrayIdProductos[$key]."]";
            //echo "[".$arrayPrecio[$key]."]";
            $respuestaClienteProducto=ModeloClienteProducto::sqlAsignarProductoCliente($arrayInfoFactura,
                                                                                        $arrayIdProductos[$key],
                                                                                        $arrayPrecio[$key] );

        }
        //============BORRO LA CESTA=================//
        echo '<script>localStorage.clear();</script>';
        echo '<script>window.location = "../adminCliente.php"; </script>';//direcciono al penel de administracion del cliente
    }
    
}



?>