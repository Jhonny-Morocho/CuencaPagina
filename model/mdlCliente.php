<?php 

ini_set('display_errors', 'On');
//require'class_mdl_bd_conexion.php';



	/**
	 * 
	 */
	class ModeloCliente {
		//satic cuando recibo algo siempre van como static

		//1Login de cliente
		public static function sqlLoginCliente($correo){

			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT *FROM cliente where correo ='$correo' ");

			$stmt->execute();


			return $stmt->fetch();

			$stmt->close();
		}

		public static  function sqlAddCliente($arrayCliente){
		$db=new Conexion();
		//========datos del formuarlio================
		$nombreCliente=$arrayCliente['inpuNameCliente'];
		$apellidoCliente=$arrayCliente['inputApellidoCliente'];
		$correoCliente=$arrayCliente['inputEmailCliente'];
		$passwordCliente=$arrayCliente['inputPasswordCliente'];
		//encriptar el password
		$opciones=array('cost'=>12);
		$password_hashed=password_hash($passwordCliente,PASSWORD_BCRYPT,$opciones);
        
		//1.Compravamos si el usariop ya existe con el mismo correo
			$stmtExisteProveedor= $db->conectar()->prepare("SELECT *FROM cliente where correo ='$correoCliente' ");
            $stmtExisteProveedor->execute();
            
			if($stmtExisteProveedor->rowCount()>0 ){// si existe en la columa entonces no deja registar
				$respuesta=array(
                    'respuesta'=>'correoRepetido',
                    'mensaje'=>'Ya existe un registro con el mismo correo'
                    );
                    return $respuesta;//regrso la respuesta 
			}else{
					//2. Guardamos los datos del Proveedor en la tabla
					date_default_timezone_set('America/Guayaquil');
					$fecha_actual=date("Y-m-d");
			
					$stmt= $db->conectar()->prepare("INSERT INTO cliente 
															(nombre, apellido,
															correo,	password, rol,fechaRegistro
															) 
		
														VALUES(
															'$nombreCliente','$apellidoCliente',
															'$correoCliente','$password_hashed',
												        	'cliente','$fecha_actual'
			
															) 
													");
			
						$stmt->execute();
						$id=$db->lastInsertId();
						if ( $stmt->rowCount() > 0) {
							//Se grabo bien en la base de datos
							$respuesta=array(
                                'respuesta'=>'exito',
                                'mensaje'=>'Registro Exitoso',
								'idRegistro'=>$id,
								'nombre'=>$nombreCliente
                                );
                                @session_start();//inicio la sesion
                                $_SESSION['id_cliente']=$id;
                                $_SESSION['usuario']=$nombreCliente;
                                $_SESSION['tipo_usuario']='cliente';
                                $_SESSION['apellido']=$apellidoCliente;
                                return $respuesta;//regrso la respuesta 
						
						 }else{
							$respuesta=array(
                                'respuesta'=>'fallidoRegistroBd',
                                'mensaje'=>'Registro Fallido',
								);
                            return $respuesta;//regrso la respuesta
                         }
                         
			
						
			}//end else

		//
		
		$stmt->close();
    

		}


		 public static  function sqlListarClientes(){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT  *FROM cliente  ORDER by id desc ");

			$stmt->execute();
			return $stmt->fetchAll();

			$stmt->close();

		}


		//============================EDITAR DATOS DE CLIENTE========================================//
		public static function sqlEditarCliente($arrayCliente){
			$db=new Conexion();

			//========datos del formuarlio================
			$nombreCliente=$arrayCliente['inpuNameCliente'];
			$apellidoCliente=$arrayCliente['inputApellidoCliente'];
			$passwordCliente=$arrayCliente['inputPasswordCliente'];
			$idClente=$arrayCliente['idCliente'];

				
				try {
					
						$bandera_password=false;
						if(empty($passwordCliente)){//si viene vacio no actulizo el password
							$stmt= $db->conectar()->prepare("UPDATE cliente SET 
																	nombre='$nombreCliente', 
																	apellido='$apellidoCliente'
																WHERE id='$idClente' ");
						}else{
							$bandera_password=true;
							$opciones=array(
								'cost'=>12
							);

							$hash_password=password_hash($passwordCliente,
											PASSWORD_BCRYPT,$opciones);

							$stmt=$db->conectar()->prepare(" UPDATE cliente  SET 
																	nombre='$nombreCliente', 
																	apellido='$apellidoCliente',
																	password='$hash_password'
															WHERE id='$idClente' ");
						}
				} catch (Exception $e) {
					echo "Error".$e->getMessage();
				}
			
				$stmt->execute();

				if($stmt){
					//si se realizo la inserccion
					$respuesta=array(
						'respuesta'=>'exito',
						'nombre'=>$nombreCliente,
						'apellido'=>$apellidoCliente,
						'password'=>$bandera_password
						);
						return $respuesta;
				}else{
					$respuesta=array(
						'respuesta'=>'false'
						);
						return $respuesta;
				}
			

				//si alguna fila se modifico entonces si se edito

				$stmt->close();
		}

		//============================ELIMINAR LOGICAMENTE  AL PROVEEDOR PROVEEDOR========================================//
	public static function sql_individual_eliminar($arrayProveedorImg){
			$db=new Conexion();
			//1. Debo borrar el archivo anterior antes de actulizar el nuevo
			$dir='../img/proveedores/'.$arrayProveedorImg['img'];
			$bandera_borrar=false;
			if(file_exists($dir)){
				if(unlink($dir)){
					$bandera_borrar=true; 
				}
			}
			 	
			try {
			$idProveedor=$arrayProveedorImg['id'];
			$stmt= $db->conectar()->prepare("UPDATE proveedor SET 
													estado='0'
												WHERE id='$idProveedor' ");

			} catch (Exception $e) {
				echo "Error".$e->getMessage();
			}
		
			
			$stmt->execute();

			if($stmt){
				//si se realizo la inserccion
				$respuesta=array(
					'respuesta'=>'exito'
					);
					return $respuesta;
			}else{
				$respuesta=array(
					'respuesta'=>'false'
					);
					return $respuesta;
			}
		
			//si alguna fila se modifico entonces si se edito
			$stmt->close();
		}

	}



 ?>