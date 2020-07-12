
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

}
