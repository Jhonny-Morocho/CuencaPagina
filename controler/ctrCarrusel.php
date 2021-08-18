<?php 
ini_set('display_errors', 'On');


require'../model/conexion.php';
require'../model/mdlCarrusel.php';

//     $respuesta=array('post'=> $_POST , 
//                                  'file'=> $_FILES );
//      print_r($respuesta);

//    die(json_encode($_POST));

switch (@$_POST['Carrsuel']) {

    case 'AgregarImg':
        function subirArchivoImgCarrusel($ubicacionCarpeta,$inputFile){
            //echo "La ubicacion de la carpeta es :[".$ubicacionCarpeta."]";
            $directorio=$ubicacionCarpeta;// la direecion donde quiero q se guarde
            $nombreNuevoGuardado=(date("YmdHis")).$_FILES[$inputFile]['name'];
            if(move_uploaded_file($_FILES[$inputFile]['tmp_name'], $directorio.$nombreNuevoGuardado)){
                // para acceder al archiv q se alamceno con el siguiente comando
                $respuesta=array(
                    'respuesta'=>'fileGuardado',
                    'nombreArchivo'=>$nombreNuevoGuardado
                );
                return $respuesta;
                
            }else{
                $respuesta=array('respuesta'=>'filFallo',
                'error'=>error_get_last()
                );// imprime el ultimo error que haya registrado al intentar subi este archivo
                return $respuesta;
            }
        }
    
        $imgCarrusel=subirArchivoImgCarrusel('../img/carrosul/','fileImgCarrusel');
        
        //registar archivo en la bae de datos
        if ($imgCarrusel['respuesta']=='fileGuardado') {
         
           $respuestaBD=ModeloCarrusel::sqlAddCarruselImg($imgCarrusel);
           return die(json_encode(array('respuesta'=>'exito','mensaje'=>'Se guardo con exito en BD','arrayRespuesta'=>$respuestaBD)));
            
        } else {
            return die(json_encode(array('respuesta'=>'fallido','mensaje'=>'no se puede subir el archivo','arrayRespuesta'=>$imgCarrusel)));

        }

        break;

        case 'editarImgCarrusel':
     
            $dir='../img/carrosul/'.$_POST['nombreArchivoViejo']; //puedes usar dobles comillas si quieres 
            $bandera_borrar=false;
            if(file_exists($dir)) 
            { 
                if(unlink($dir)) 
                $bandera_borrar=true; 
            }

            function subirArchivoImgCarrusel($ubicacionCarpeta,$inputFile){
                //echo "La ubicacion de la carpeta es :[".$ubicacionCarpeta."]";
                $directorio=$ubicacionCarpeta;// la direecion donde quiero q se guarde
                $nombreNuevoGuardado=(date("YmdHis")).$_FILES[$inputFile]['name'];
                if(move_uploaded_file($_FILES[$inputFile]['tmp_name'], $directorio.$nombreNuevoGuardado)){
                    // para acceder al archiv q se alamceno con el siguiente comando
                    $respuesta=array(
                        'respuesta'=>'fileGuardado',
                        'nombreArchivo'=>$nombreNuevoGuardado
                    );
                    return $respuesta;
                    
                }else{
                    $respuesta=array('respuesta'=>'filFallo',
                    'error'=>error_get_last()
                    );// imprime el ultimo error que haya registrado al intentar subi este archivo
                    return $respuesta;
                }
            }

            $imgCarrusel=subirArchivoImgCarrusel('../img/carrosul/','fileImgCarrusel');
            //registar archivo en la bae de datos
            if ($imgCarrusel['respuesta']=='fileGuardado') {
                
                $respuestaBD=ModeloCarrusel::sqlEditarImgCarruselIndividual($imgCarrusel,$_POST['idImgCarrusel']);
                return die(json_encode(array('respuesta'=>'exito','banderaArchivoBorrado'=>$bandera_borrar,
                                            'mensaje'=>'Se actualizo con exito en BD',
                                            'arrayRespuesta'=>$respuestaBD)));
                
            } else {
                return die(json_encode(array('respuesta'=>'fallido','banderaArchivoBorrado'=>$bandera_borrar,
                                                'mensaje'=>'no se puede subir el archivo',
                                                'arrayRespuesta'=>$imgCarrusel)));
       
            }
            break;

        case 'eliminarImgCarrusel':
            $dir='../img/carrosul/'.$_POST['nombreArchivo']; //puedes usar dobles comillas si quieres 
            $bandera_borrar=false;
            if(file_exists($dir)) 
            { 
                if(unlink($dir)) 
                $bandera_borrar=true; 
            }
            $respuestaBD=ModeloCarrusel::sqlEliminarImgCarrusel($_POST['id'],$bandera_borrar);
            return die(json_encode($respuestaBD));
            break;

      
    
    default:
        # code...
        break;
}

?>