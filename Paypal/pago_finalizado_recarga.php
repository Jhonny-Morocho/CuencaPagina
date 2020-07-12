

    <?php
        ini_set('display_errors', 'On');

        var_dump($_GET);
        $resultado=$_GET['exito'];

        session_start();
        if($resultado=="true"){//llega el mensaje de confirmacion del pago(true)

            $productos_id=explode("-", $_GET['productos_id']);
            $productos_precio=explode("-", $_GET['productos_precio']);


            $id_Cliente=$_SESSION['id_cliente'];
            $metodo="Recarga";
            $cliente_pay="";


            $producto_final=0;


            //=============================iNGRESAR DATOS FACTURA DE COMPRA EN LA BASE DE DATOS===========
            //=============================iNGRESAR DATOS FACTURA DE COMPRA EN LA BASE DE DATOS===========
            //=============================iNGRESAR DATOS FACTURA DE COMPRA EN LA BASE DE DATOS===========
            require'../Modelo/class_mdl_bd_conexion.php';
            require'../Modelo/class_mdl_cliente_producto.php';
            require'../Modelo/class_mdl_cliente.php';

            include'../Controlador/class_ctr_cliente_producto.php';
            include'../Controlador/class_ctr_cliente.php';

            $total_cancelar=$_GET['total_cancelar'];

            $respuesta_factura=CtrCliente_Producto::ctr_crear_factura($id_Cliente,$total_cancelar);
            print_r($respuesta_factura['id_factura']);//regrsa el bojeto una respuesta
            $id_factura=$respuesta_factura['id_factura'];


            //==========================DEBITO EL SALDO EN LA CUENTA DEL CLIENTE===================//
            $saldo_actual_cliente=$_GET['saldo_actual_cliente'];

            $total_actulizar=(double)$saldo_actual_cliente-(double)$total_cancelar;
            /*echo "el total a cancelar es ".$total_cancelar;
            echo "total debitado es :".$total_actulizar;*/

            $respuesta_saldo_actualizado=CtrCliente::ctr_editar_cliente_saldo($id_Cliente,$total_actulizar);
            print_r($respuesta_saldo_actualizado);

            //================================Ingresar Cliente Producto================
            //================================Ingresar Cliente Producto================

            $contador=0;
            while ( $contador<count($productos_precio)) {

                $respuesta_cliente_producto=CtrCliente_Producto::ctr_agregar_productos_adquiridos_cliente($id_factura,
                                            $id_Cliente,
                                            $productos_id[$contador],
                                            $metodo,
                                            $cliente_pay,
                                            $productos_precio[$contador]
                                                    );//guardo productos del cliente q compro




                $contador++;
                print_r($respuesta_cliente_producto);
            }//fin del while
                    echo"se ingreso todo correctamente";
                       //============BORRO LA CESTA=================//
                    echo '<script>
                            localStorage.removeItem("listaProductos");
                            localStorage.removeItem("cantidadCesta");
                    </script>';

                            header("Location:../admin_cliente.php");// direcciono al lugar donde estan los productos
                           /* die(json_encode($respuesta));*/


        }else{
            echo"El pago no se realizo";
        }


?>


