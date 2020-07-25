
<?php
//require'class_mdl_bd_conexion.php';
ini_set('display_errors', 'On');

/**
 *
 */
class ModeloCupon {


    //* listar cupon
    public static  function sqlListarCupon(){
        $db=new Conexion();
        $stmt= $db->conectar()->prepare("SELECT *FROM cupon ");

        $stmt->execute();
        return $stmt->fetchAll();

        $stmt->close();

    }

    public static  function sqlEditarCupon($arrayCupon){

        $nombreCupon=$arrayCupon['inputNombreCupon'];
        $consumo=$arrayCupon['inputLimite'];
        $fechaLimite=$arrayCupon['inputFechaLimite'];
        $idCupon=$arrayCupon['idCupon'];
        $descuento=$arrayCupon['inputDescuento'];
            
        $db=new Conexion();
        
        try {
            //code...
            $stmt= $db->conectar()->prepare("UPDATE cupon SET
                                                    nombreCupon='$nombreCupon',
                                                    consumo='$consumo',
                                                    descuento='$descuento',
                                                    fechaExpiracion	='$fechaLimite'
                                                    WHERE id='$idCupon' ");

            $stmt->execute();

            if ( $stmt->rowCount() > 0) {
                //Se grabo bien
                    $respuesta=array(
                        'respuesta'=>'exito',
                        'genero'=>$nombreCupon
                        );
                }else{
                    $respuesta=array(
                        'respuesta'=>'noExisteCambios',
                        'genero'=>$nombreCupon
                        );
                }
                   
             

        } catch (Exception $e) {
            $respuesta=array(
                'try'=>$e->getMessage(),
                'respuesta'=>'error'
                );
        }
    return $respuesta;
    $stmt->close();

    }


}
