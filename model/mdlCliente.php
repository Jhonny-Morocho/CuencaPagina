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


		 public static  function sql_lisartar_proveedor(){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT  *FROM proveedor where estado ='1' ORDER by id desc ");

			$stmt->execute();
			return $stmt->fetchAll();

			$stmt->close();

		}


		public static function sql_login_proveedor($tabla,$correo){

			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT *FROM $tabla where correo ='$correo' ");
		
			$stmt->execute();


			return $stmt->fetch();

			$stmt->close();
		}


		
		public static function sql_individual_proveedor($tabla,$id){

			$db=new Conexion();

			$stmt= $db->conectar()->prepare("SELECT *FROM $tabla where id ='$id' ");
		
			$stmt->execute();


			return $stmt->fetch();

			$stmt->close();
		}

		//============================ACTUALIZAR O EDITAR PROVEEDOR IMG========================================//
		public static function sql_individual_editarImg($arrayProveedorImg){
			$db=new Conexion();
		
			
			//.1 SUbir la imganen
			$directorio="../img/proveedores/";// la direecion donde quiero q se guarde
		
			if(move_uploaded_file($_FILES['fileLogoDj']['tmp_name'], $directorio.$_FILES['fileLogoDj']['name'])){
				// para acceder al archiv q se alamceno con el siguiente comando
				$respuesta=array(
					'respuesta'=>'fileGuardado',
					'urlLogoDj'=>$_FILES['fileLogoDj']['name']
				);

				$urLogoDj=$_FILES['fileLogoDj']['name'];
				
			
			}else{
				$respuesta=array('respuesta'=>'filFallo',
									'error'=>error_get_last()
					);// imprime el ultimo error que haya registrado al intentar subi este archivo
			
			}//end File
			
			//========datos del formuarlio================
			$idProveedor=$arrayProveedorImg['idProveedor'];
				try {
					
						$stmt= $db->conectar()->prepare("UPDATE proveedor SET 
																	img='$urLogoDj'
																WHERE id='$idProveedor' ");
						
				} catch (Exception $e) {
					echo "Error".$e->getMessage();
				}
			
				$stmt->execute();

				if($stmt){
					//si se realizo la inserccion
					$respuesta=array(
						'respuesta'=>'exito',
						'img'=>$urLogoDj
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

		//============================ACTUALIZAR O EDITAR PROVEEDOR DATOS========================================//
		public static function sql_individual_editar($arrayProveedor){
			$db=new Conexion();
			
			//========datos del formuarlio================
			$nombreProveedor=$arrayProveedor['inputNombre'];
			$apellidoProveedor=$arrayProveedor['inputApeliidor'];
			$correoProveedor=$arrayProveedor['inputCorreo'];
			$passwordProveedor=$arrayProveedor['inputPassword'];
			$apodo=$arrayProveedor['inputPseudoNombre'];
			$idProveedor=$arrayProveedor['idProveedor'];

				
				try {
					
						$bandera_password=false;
						if(empty($passwordProveedor)){//si viene vacio no actulizo el password
							$stmt= $db->conectar()->prepare("UPDATE proveedor SET 
																	nombre='$nombreProveedor', 
																	apellido='$apellidoProveedor',
																	apodo='$apodo',
																	correo='$correoProveedor'
																WHERE id='$idProveedor' ");
						}else{
							$bandera_password=true;
							$opciones=array(
								'cost'=>12
							);

							$hash_password=password_hash($passwordProveedor,
											PASSWORD_BCRYPT,$opciones);

							$stmt=$db->conectar()->prepare(" UPDATE proveedor  SET 
																	nombre='$nombreProveedor', 
																	apellido='$apellidoProveedor',
																	apodo='$apodo',
																	correo='$correoProveedor' ,
																	password='$hash_password'
															WHERE id='$idProveedor' ");
						}
				} catch (Exception $e) {
					echo "Error".$e->getMessage();
				}
			
				$stmt->execute();

				if($stmt){
					//si se realizo la inserccion
					$respuesta=array(
						'respuesta'=>'exito',
						'nombre'=>$nombreProveedor,
						'apellido'=>$apellidoProveedor,
						'correo'=>$correoProveedor,
						'apodo'=>$apodo,
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