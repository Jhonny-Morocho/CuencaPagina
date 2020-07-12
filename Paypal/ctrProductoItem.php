<?php
//require'class_mdl_bd_conexion.php';
ini_set('display_errors', 'On');

/**
 *
 */
class ModeloProductoItem {


    //satic cuando recibo algo siempre van como static
     public static  function SeperacionDatos($arrayDatosSinProcesar,$keyName){// los productos recien adquieridos el top 15
        //guardo el tring en un array para poder separar los datos
         $datos=array($keyName=>$arrayDatosSinProcesar);
         //filtroDatos seperando por comas
         return explode(",", $datos[$keyName]);

       //return $arrayDatosSinProcesar;

    }


}
