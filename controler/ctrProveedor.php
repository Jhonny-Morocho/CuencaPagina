<?php 
ini_set('display_errors', 'On');
ini_set('session.cache_expire', 600);
ini_set('session.gc_maxlifetime', 36000);
ini_set('session.cookie_lifetime',36000);

require'../model/conexion.php';
require'../model/mdlProveedor.php';
require'../controler/ctrValidarCampos.php';




switch (@$_POST['Proveedor']) {


    case 'addProveedor':

        //1.Verificar si el archivo del logo existe, 
            //si existe no deja guardar el registro
            //si no existe entonces si deja guardar
        $nombre_fichero = "../img/proveedores/".$_FILES['fileLogoDj']['name'];

        if (file_exists($nombre_fichero)) {
            //si existe debe cambiarle el nombre del archivo
            $respuesta=array('respuesta'=>'existeArchivo');
            
        } else {
            
            //$respuesta= array('archivo'=>'noExiste');
            //si no existe entonces si puede guardar
            $respuesta=ModeloProveedor::sql__agrgar_proveedor(@$_POST);
        }

     
        die(json_encode($respuesta));
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

        case 'loginAdmin':
 

                //=================Validcacion de Campos=========================
                //=================Validcacion de Campos=========================
                //=================Validcacion de Campos=========================
                $objValidacionCampos= new CtrValidarCampos();
                $boolean_validacion=true;
                $ValidarCampos=array(
                    'validacion_correo'=>$objValidacionCampos->validaEmail(@$_POST['inputEmail']),
                    'validacion_password_longitud'=>$objValidacionCampos->validar_password(@$_POST['inputPassword'])
                 );
                 foreach ($ValidarCampos as $key => $value) {// recorrer todas las respueta de los campos vacios
			
                    if($value==false){//si llega vacio hacer imprimir
                        
                        //echo'<br>'.$key .' '.$value;
                        $boolean_validacion=false;
                    }
                }

                //=================Verificar el password para darle ingreso al sistema=========================
                //=================Verificar el password para darle ingreso al sistema=========================
                //=================Verificar el password para darle ingreso al sistema=========================
                if($boolean_validacion==true){//validacion de campos campos ññenps
                    $respuesta=ModeloProveedor::sql_login_Admin(@$_POST['inputEmail']);

                    //print_r($respuesta);
                    if ($respuesta) {//verificar si existe el correo del usuario
                        if( password_verify(@$_POST['inputPassword'],@$respuesta['password']) ){
                    //seteo la vida de la session en 7200 segundos    
                                //inicio la session
                                
                                session_cache_expire(600);
                                session_set_cookie_params(36000);
                                session_start();
    
                                @$_SESSION['id_proveedor']=$respuesta['id'];
                                @$_SESSION['usuario']=$respuesta['nombre'];
                                @$_SESSION['tipo_usuario']=$respuesta['rol'];
                                @$_SESSION['apodo']=$respuesta['apodo'];
                                @$_SESSION['apellido']=$respuesta['apellido'];
                                @$_SESSION['img']=$respuesta['img'];
                                @$_SESSION['fechaRegistro']=$respuesta['fechaRegistro'];
    
                                 $respuesta=array(
                                     'respuesta'=>'true_password',
                                     'usuario'=>$respuesta['nombre'],
                                     'rol'=>$respuesta['rol'],
                                     'apellido'=>$respuesta['apellido'],
                                     'apodo'=>$respuesta['apodo']
                                 );
                        
    
                            }
    
                            else{
                                $respuesta=array(
                                    'respuesta'=>'Contraseña Incorrecta'
                                );
                            
                            }
                    }else{
                            $respuesta=array(
                                'respuesta'=>'Correo Incorrecto'
                            );
                        
                        }
                }else{
                    $respuesta=array('respuesta'=>" Caracteres no permitidos ","arrayValidacion"=>$ValidarCampos);
                   
                }

            die(json_encode($respuesta));
            
            break;
    
    default:
        # code...
        break;
}

?>