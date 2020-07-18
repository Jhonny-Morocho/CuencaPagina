
<?php
//require'class_mdl_bd_conexion.php';
ini_set('display_errors', 'On');

/**
 *
 */
class ModeloFacura {


    //* listar compras de cliente
    public static  function sqlListarFacturas($id){
        $db=new Conexion();
        $stmt= $db->conectar()->prepare("SELECT *FROM detalle_factura
        WHERE idCliente= '$id'   ORDER by id DESC ");

        $stmt->execute();
        return $stmt->fetchAll();

        $stmt->close();

    }

        //* listar compras de todos los cliente
        public static  function sqlListarFacturasTodos(){//
            $db=new Conexion();
            $stmt= $db->conectar()->prepare("SELECT  detalle_factura.idCliente,
                                                     detalle_factura.id,
                                                     detalle_factura.totalCancelar,
                                                     detalle_factura.fechaFacturacion,
                                                     cliente.correo,
                                                     cliente.apellido,
                                                     cliente.nombre
                                            FROM detalle_factura,cliente 
                                            where  detalle_factura.idCliente=cliente.id
                                            ORDER by detalle_factura.id DESC ");
    
            $stmt->execute();
            return $stmt->fetchAll();
    
            $stmt->close();
    
        }

    public static function sqlGerarFactura($idCliente,$total){
        $db=new Conexion();
        date_default_timezone_set('America/Guayaquil');
        $fechaActual=date("Y-m-d H:i:s");
        try {
            $stmt= $db->conectar()->prepare("INSERT INTO  detalle_factura
                                                        (totalCancelar,
                                                        idCliente,
                                                        fechaFacturacion
                                                        )
                                                VALUES('$total',
                                                        '$idCliente',
                                                        '$fechaActual') ");


                $stmt->execute();
                $id=$db->lastInsertId();

                if ( $stmt->rowCount() > 0) {
                    //Se grabo bien en la base de datos
                    $respuesta=array(
                        'respuesta'=>'exito',
                        'idFactura'=>$id
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
