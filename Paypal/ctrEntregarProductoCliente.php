<?php

ini_set('display_errors', 'On');

//============Conexion a la base datos=============//
require'../model/conexion.php';



class ClassEntregarProductoCliente {
    
    public static function comproMusica($idCliente,$montoCancelar,$arrayPrecio,$arrayIdProductos,$metodoPago){
        //============Traer  del producto de cliente producto para poder realizar la facturacion=============//
        require'../model/mdlFactura.php';
        //============Entregar los producots al cliente=============//
        require'../model/mdlClienteProducto.php';

        //1. Generar la factura , para ellos guardo el id de cliente,monto que canelo , en la tabla factura
        $respustaFactura=ModeloFacura::sqlGerarFactura($idCliente,$montoCancelar);

        //2. de la respuesta obtengo el idFactura para poder entregar los productos
        $arrayInfoFactura=array('idFactura'=>$respustaFactura['idFactura'],
                                            'idCliente'=>$idCliente,
                                            'metodoPago'=>$metodoPago);
        // guardar los datos o los productos para darle al cliente

        //print_r($arrayPrecio);
        foreach ($arrayPrecio as $key => $value) {
            //echo "[".$arrayIdProductos[$key]."]";
            //echo "[".$arrayPrecio[$key]."]";
            $respuestaClienteProducto=ModeloClienteProducto::sqlAsignarProductoCliente($arrayInfoFactura,
                                                                                        $arrayIdProductos[$key],
                                                                                        $arrayPrecio[$key] );

        }
      
    }

    // compra paquete de membresia
    public static function comproMembresia($arrayData){
        //=================Entregar membresia al cliente====
        require'../model/mdlClienteMembresia.php';
        $precioTotal=floatval($arrayData['totalCancelado']);
        $numeroDescargas=floatval($arrayData['get']['numDescargas']);
        $comisionPaypal=floatval($arrayData['totalCancelado']*0.19);
        $precioUnidad=floatval(($precioTotal-$comisionPaypal)/$numeroDescargas);
        $respuesta=Modelo_Membresia::sqlAgregarMembresiaCliente($arrayData,'Paypal',$precioUnidad);
        echo '<script>window.location = "../adminCliente.php"; </script>';//direcciono al penel de administracion del cliente
        
    }



   
    
}



?>