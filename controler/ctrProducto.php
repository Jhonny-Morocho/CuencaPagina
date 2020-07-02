<?php 
ini_set('display_errors', 'On');


require'../model/conexion.php';
require'../model/mdlProducto.php';


//  $respuesta=array('post'=> $_POST , 
//                             'file'=> $_FILES );
// print_r($respuesta);


//die(json_encode($_POST));
switch (@$_POST['Producto']) {


    case 'addProducto':

        function subirArchivoMusica($ubicacionCarpeta,$inputFile){
            //echo "La ubicacion de la carpeta es :[".$ubicacionCarpeta."]";
            $directorio=$ubicacionCarpeta;// la direecion donde quiero q se guarde
            if(move_uploaded_file($_FILES[$inputFile]['tmp_name'], $directorio.$_FILES[$inputFile]['name'])){
                // para acceder al archiv q se alamceno con el siguiente comando
                $respuesta=array(
                    'respuesta'=>'fileGuardado',
                    'urlUbicacion'=>$_FILES[$inputFile]['name']
                );
                return $respuesta;
            
            }else{
                $respuesta=array('respuesta'=>'filFallo',
                                    'error'=>error_get_last()
                    );// imprime el ultimo error que haya registrado al intentar subi este archivo
                    return $respuesta;
            }//end File
            
        }
        
        //Mediante subir Archivos
        $editDemo=subirArchivoMusica('../editDemos/','filesEditDemo'); 
        $editCompleto=subirArchivoMusica('../editCompletos/','filesEditCompleto');
        $respuesta=ModeloProducto::sql__agrgar_prodcuto(@$_POST,$editDemo['urlUbicacion'],$editCompleto['urlUbicacion']);
        die(json_encode($respuesta));
        break;

        case 'editarProducto':

                function subirArchivoMusica($ubicacionCarpeta,$inputFile){
                    //echo "La ubicacion de la carpeta es :[".$ubicacionCarpeta."]";
                    $directorio=$ubicacionCarpeta;// la direecion donde quiero q se guarde
                    if(move_uploaded_file($_FILES[$inputFile]['tmp_name'], $directorio.$_FILES[$inputFile]['name'])){
                        // para acceder al archiv q se alamceno con el siguiente comando
                        $respuesta=array(
                            'respuesta'=>'fileGuardado',
                            'urlUbicacion'=>$_FILES[$inputFile]['name']
                        );
                        return $respuesta;
                    
                    }else{
                        $respuesta=array('respuesta'=>'filFallo',
                                            'error'=>error_get_last()
                            );// imprime el ultimo error que haya registrado al intentar subi este archivo
                            return $respuesta;
                    }//end File
                    
                }

                //Mediante un boolean defino que archivos son los que se van actulizar
                $actualizarArchivoDemo=true;
                $actualizarArchivoCompleto=true;
                ($_FILES['filesEditDemo']['name'] != null) ? $editDemo=subirArchivoMusica('../editDemos/','filesEditDemo') : $actualizarArchivoDemo=false; // 
                ($_FILES['filesEditCompleto']['name'] != null) ? $editCompleto=subirArchivoMusica('../editCompletos/','filesEditCompleto') : $actualizarArchivoCompleto=false; // 

                
               //Ahora veremos los diferentes casos
               //1.No actuliza ningun archivo solo los datos ambas deben ser false, solo datos 
               ($actualizarArchivoDemo==false &&  $actualizarArchivoCompleto==false ) ? $respuesta=ModeloProducto::sql_editar_Producto(@$_POST,"soloDatos","","") : $smmActualizar="SoloDatos"; // 
               //2.Se actuliza solo el archivo demo 
               ($actualizarArchivoDemo==true && $actualizarArchivoCompleto==false ) ? $respuesta=ModeloProducto::sql_editar_Producto(@$_POST,"achivoDemo",$editDemo['urlUbicacion'],"") : $smmActualizar="SoloDemo"; // 
               //3.Se actuliza solo el archivo completo 
               ($actualizarArchivoCompleto==true  && $actualizarArchivoDemo==false ) ? $respuesta=ModeloProducto::sql_editar_Producto(@$_POST,"achivoCompleto","",$editCompleto['urlUbicacion']) : $smmActualizar="SoloRemixCompleto"; // 
               //4. Se actuliza los dos archivos 
               ($actualizarArchivoCompleto==true  && $actualizarArchivoDemo==true ) ? $respuesta=ModeloProducto::sql_editar_Producto(@$_POST,"todosLosArchivos",$editDemo['urlUbicacion'],$editCompleto['urlUbicacion']) : $smmActualizar="SoloRemixCompleto"; // 
               
                die(json_encode($respuesta));
                break;
        case 'eliminarProducto':

            //1. Debo borrar los archivos
        


           
            function EliminarArchivos($ubicacionCarpeta,$titulo_arhivo){
                $dir=$ubicacionCarpeta.$titulo_arhivo; //puedes usar dobles comillas si quieres 
                
                if(file_exists($dir)) 
                { 
                    if(unlink($dir)) 
                    return true; 
                }
            }
            //inicalizo las variables de estado
            $borrarDemo=false;
            $borrarRemixCompleto=false;

            //Actualizo las varibales boolenas con la respuesta
            $borrarDemo=EliminarArchivos('../editDemos/',@$_POST['demo']);
            $borrarRemixCompleto=EliminarArchivos('../editDemos/',@$_POST['remixCompleto']);
            //2.Borro los datos de la base de datos
            $respuesta=ModeloProducto::sqlEliminarProducto(@$_POST);
            die(json_encode($respuesta));
            break;
    
    default:
        # code...
        break;
}

?>