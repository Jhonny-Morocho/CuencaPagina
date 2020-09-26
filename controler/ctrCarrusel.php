<?php 
ini_set('display_errors', 'On');


require'../model/conexion.php';
require'../model/mdlCarrusel.php';

//  $respuesta=array('post'=> $_POST , 
//                               'file'=> $_FILES );
//   print_r($respuesta);

// die(json_encode($_POST));

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

        case 'editProveedor':
       
           
            $respuesta=ModeloProveedor::sql_individual_editar(@$_POST);
            die(json_encode($respuesta));
            break;

        case 'editProveedorImg':
            
       
            $respuesta=ModeloProveedor::sql_individual_editarImg(@$_POST);
            die(json_encode($respuesta));
            break;
        case 'eliminarProveedor':
          
            $respuesta=ModeloProveedor::sql_individual_eliminar(@$_POST);
            die(json_encode($respuesta));
            break;

      
    
    default:
        # code...
        break;
}

?>