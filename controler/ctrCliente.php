<?php 
ini_set('display_errors', 'On');


require'../model/conexion.php';
require'../model/mdlCliente.php';
require'../controler/ctrValidarCampos.php';


$objValidacionCampos= new CtrValidarCampos();



switch (@$_POST['Cliente']) {


    case 'addCliente':
            $boolean_validacion=true;
            $ValidarCampos=array(
                'validacion_correo'=>$objValidacionCampos->validaEmail(@$_POST['inputEmailCliente']),
                'soloLetrasInputNombre'=>$objValidacionCampos->solo_letras(@$_POST['inpuNameCliente']),
                'soloLetrasInputApellido'=>$objValidacionCampos->solo_letras(@$_POST['inputApellidoCliente']),
                'CamposVaciosInputApellido'=>$objValidacionCampos->validar_campos_vacios(@$_POST['inputApellidoCliente']),
                'CamposVaciosInputNombre'=>$objValidacionCampos->validar_campos_vacios(@$_POST['inpuNameCliente']),
                'CamposVaciosInputCoreeo'=>$objValidacionCampos->validar_campos_vacios(@$_POST['inputEmailCliente']),
                'CamposVaciosInputPassword'=>$objValidacionCampos->validar_campos_vacios(@$_POST['inputPasswordCliente']),
                'longitudCaracteresNombre'=>$objValidacionCampos->validar_campos_vacios(@$_POST['inpuNameCliente']),
                'longitudCaracteresApellido'=>$objValidacionCampos->validar_campos_vacios(@$_POST['inputApellidoCliente']),
                'validacion_password_longitud'=>$objValidacionCampos->validar_password(@$_POST['inputPasswordCliente'])
            );
            foreach ($ValidarCampos as $key => $value) {// recorrer todas las respueta de los campos vacios
                
                if($value==false){//si llega vacio hacer imprimir
                    
                    //echo'<br>'.$key .' '.$value;
                    $boolean_validacion=false;
                }
            }
            //=====Verificar Validacion
            ($boolean_validacion==true)? $respuesta=ModeloCliente::sqlAddCliente(@$_POST):$respuesta=array('mensaje'=>"Caracteres no permitidos ","arrayValidacion"=>$ValidarCampos);
            die(json_encode($respuesta));
            // die(json_encode($respuesta));
            break;

            case 'editProveedor':
       
           
            $respuesta=ModeloProveedor::sql_individual_editar(@$_POST);
            die(json_encode($respuesta));
            break;


        case 'loginCliente':
 

                //=================Validcacion de Campos=========================
                //=================Validcacion de Campos=========================
                $boolean_validacion=true;
                $ValidarCampos=array(
                    'validacion_correo'=>$objValidacionCampos->validaEmail(@$_POST['inputEmailCliente']),
                    'validacion_password_longitud'=>$objValidacionCampos->validar_password(@$_POST['inputPasswordCliente'])
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
                    $respuesta=ModeloCliente::sqlLoginCliente(@$_POST['inputEmailCliente']);

                    //print_r($respuesta);
                    if ($respuesta) {//verificar si existe el correo del usuario
                        if( password_verify(@$_POST['inputPasswordCliente'],@$respuesta['password']) ){

                                @session_start();
                                @$_SESSION['id_cliente']=$respuesta['id'];
                                @$_SESSION['usuario']=$respuesta['nombre'];
                                @$_SESSION['tipo_usuario']=$respuesta['rol'];
                                @$_SESSION['apellido']=$respuesta['apellido'];
                                @$_SESSION['fechaRegistro']=$respuesta['fechaRegistro'];
    
                                 $respuesta=array(
                                     'respuesta'=>'true_password',
                                     'usuario'=>$respuesta['nombre'],
                                     'rol'=>$respuesta['rol'],
                                     'apellido'=>$respuesta['apellido']
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