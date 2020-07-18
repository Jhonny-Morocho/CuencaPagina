<?php
//require'class_mdl_bd_conexion.php';
ini_set('display_errors', 'On');

/**
 *
 */
class ModeloClienteProducto {


    //satic cuando recibo algo siempre van como static
     public static  function sqlListarTop(){// los productos recien adquieridos el top 15
        $db=new Conexion();
        $stmt= $db->conectar()->prepare("SELECT  DISTINCT 
        cliente_producto.idProducto,
        cliente_producto.fechaCompra,
        producto.nombrePista,
        producto.demo,
        proveedor.apodo,
        proveedor.img,
        genero.id,
        genero.genero,
        proveedor.apodo,
        producto.idProveedor,
        producto.id,
        producto.precio
        
        FROM 			cliente_producto,proveedor,producto,genero

        WHERE 			cliente_producto.idProducto=producto.id 
                    AND producto.idGenero=genero.id
                    AND producto.idProveedor=proveedor.id
                    AND proveedor.id=producto.idProveedor
                    AND proveedor.estado=1 ORDER by  cliente_producto.fechaCompra desc");

        $stmt->execute();
        return $stmt->fetchAll();

        $stmt->close();

    }

    //este metodo es para saeber los productos q a comprado el cliente las facturas
    public static  function sqlListarProductosCliente($idCliente,$idFactura){//los productos del cliente adquirido
        $db=new Conexion();
        try {
            $stmt= $db->conectar()->prepare("SELECT
                                                        cliente_producto.idCliente,
                                                        cliente_producto.idProducto,
                                                        cliente_producto.metodoCompra,
                                                        cliente_producto.precioCompra,
                                                        
                                                        producto.artista,
                                                        producto.nombrePista,
                                                        producto.remixCompleto,

                                                        proveedor.apodo
                                                    from
                                                        cliente_producto,
                                                        detalle_factura,
                                                        proveedor,
                                                        producto
                                                    WHERE
                                                            detalle_factura.idCliente='$idCliente'
                                                    and     cliente_producto.idFactura=detalle_factura.id
                                                    and     detalle_factura.id='$idFactura'
                                                    and     proveedor.id=producto.idProveedor
                                                    and     producto.id=cliente_producto.idProducto ORDER by cliente_producto.idCliente ");

            $stmt->execute();
        } catch (Exception $e) {
                $error=$e->getMessage();
                echo $error;

            }
        return $stmt->fetchAll();

        $stmt->close();

    }

    

    //saber los productos vendidos por el proveedor
    public static function sqlListarProductosVendidosProveedor($idProveedor){
        $db=new Conexion();
        try {
            $stmt= $db->conectar()->prepare("SELECT
                                                        cliente_producto.idProducto,
                                                        cliente_producto.idFactura,
                                                        producto.nombrePista,
                                                        cliente_producto.precioCompra,
                                                        producto.idProveedor,

                                                        cliente_producto.fechaCompra,
                                                        cliente_producto.metodoCompra,	
                                                        cliente_producto.idCliente
                                                from
                                                        cliente_producto,
                                                        producto

                                                WHERE
                                                        producto.idProveedor='$idProveedor'

                                                and     cliente_producto.idProducto=producto.id


                                                ORDER by  cliente_producto.fechaCompra desc
                ");


                $stmt->execute();

            } catch (Exception $e) {
                $error=$e->getMessage();
                echo $error;

              }

        return $stmt->fetchAll();

        $stmt->close();


    }


     //asiganr los productos al cliente
     public static function sqlAsignarProductoCliente($arrayInfoFactura,$idProducto,$precioUnidadProducto){
        $db=new Conexion();
        date_default_timezone_set('America/Guayaquil');
        $fecha_actual=date("Y-m-d H:i:s");
        $idFactura=$arrayInfoFactura['idFactura'];
        $idCliente=$arrayInfoFactura['idCliente'];
        $metodoPago=$arrayInfoFactura['metodoPago'];
        try {
            $stmt= $db->conectar()->prepare("INSERT INTO cliente_producto
                                                        (idCliente,idProducto,fechaCompra,
                                                        metodoCompra,precioCompra,idFactura
                                                        )
                                                VALUES('$idCliente','$idProducto','$fecha_actual',
                                                        '$metodoPago','$precioUnidadProducto','$idFactura') 
                                            ");


                $stmt->execute();
                $id=$db->lastInsertId();

                if ( $stmt->rowCount() > 0) {
                    //Se grabo bien en la base de datos
                    $respuesta=array(
                        'respuesta'=>'exito',
                        'idProducto'=>$idProducto,
                        'idClienteProducto'=>$id,
                        'precioUnidadProducto'=>$precioUnidadProducto,
                        'idFactura'=>$idFactura
                        );

                 }else{
                    $respuesta=array(
                        'respuesta'=>'fallido'
                        );

                 }


            } catch (Exception $e) {
                $error=$e->getMessage();
                // echo $error;
                $respuesta=array(
                    'respuesta'=>'erro_try_cacth',
                    'error'=>$error
                    );

              }

        return $respuesta;


    }


    public static function sql_agregar_productos_cliente_adquiridos($tabla,$id_factura,$id_cliente,
                                                                $id_producto,$metodo_compra,
                                                                $cliente_pay,
                                                                $precio_compra){
        $db=new Conexion();
        date_default_timezone_set('America/Guayaquil');
        $fecha_actual=date("Y-m-d H:i:s");
        try {
            $stmt= $db->conectar()->prepare("INSERT INTO $tabla
                                                        (id_cliente,
                                                        id_producto,
                                                        metodo_compra,
                                                        cliente_pay,
                                                        id_factura,
                                                        precio_compra,
                                                        fecha_compra
                                                        )
                                                VALUES('$id_cliente',
                                                        '$id_producto',
                                                        '$metodo_compra',
                                                        '$cliente_pay',
                                                        '$id_factura',
                                                        '$precio_compra',
                                                        '$fecha_actual'

                                                    )          ");


                $stmt->execute();
                $id=$db->lastInsertId();

                if ( $stmt->rowCount() > 0) {
                    //Se grabo bien en la base de datos
                    $respuesta=array(
                        'respuesta'=>'exito',
                        'id_tabla_cliente_producto'=>$id
                        );

                 }else{
                    $respuesta=array(
                        'respuesta'=>'fallido'
                        );

                 }


            } catch (Exception $e) {
                $error=$e->getMessage();
                // echo $error;
                $respuesta=array(
                    'respuesta'=>'erro_try_cacth',
                    'error'=>$error
                    );

              }

        return $respuesta;


    }




}
