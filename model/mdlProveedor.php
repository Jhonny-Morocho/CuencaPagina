<?php 

ini_set('display_errors', 'On');
//require'class_mdl_bd_conexion.php';

	/**
	 * 
	 */
	class ModeloProveedor {
		//satic cuando recibo algo siempre van como static


		public static  function sql__agrgar_proveedor($arrayProveedor){
		$db=new Conexion();
			
		//========datos del formuarlio================
		$nombreProveedor=$_POST['inputNombre'];
		$apellidoProveedor=$_POST['inputApeliidor'];
		$correoProveedor=$_POST['inputCorreo'];
		$passwordProveedor=$_POST['inputPassword'];
		$apodo=$_POST['inputPseudoNombre'];
		
		//encriptar el password
		$opciones=array(
			'cost'=>12
		);
		$password_hashed=password_hash($passwordProveedor,PASSWORD_BCRYPT,$opciones);
	

		//1.Compravamos si el usariop ya existe con el mismo correo
			$stmtExisteProveedor= $db->conectar()->prepare("SELECT *FROM proveedor where correo ='$correoProveedor' ");
			$stmtExisteProveedor->execute();
			
			if($stmtExisteProveedor->rowCount()>0 ){// si existe en la columa entonces no deja registar
				$respuesta=array(
					'respuesta'=>'correo_repetido'
					);
			}else{
			//si no exite el proveedor entonces lo registra
					//1.Guardamos el logo del dj en la carpeta de img/proveedor/
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
					
					//2. Guardamos los datos del Proveedor en la tabla
					date_default_timezone_set('America/Guayaquil');
					$fecha_actual=date("Y-m-d");
			
					$stmt= $db->conectar()->prepare("INSERT INTO proveedor 
															(
															nombre,	apellido,
															correo,		password,
															img,		rol,
															fechaRegistro, apodo,
															estado
															) 
		
														VALUES(
															'$nombreProveedor',	'$apellidoProveedor',
															'$correoProveedor',		'$password_hashed',
															'$urLogoDj',			'proveedor',
															'$fecha_actual',		'$apodo',
															'1'
															) 
													");
			
						$stmt->execute();
						$id=$db->lastInsertId();
						if ( $stmt->rowCount() > 0) {
							//Se grabo bien en la base de datos
							$respuesta=array(
								'respuesta'=>'exitoRegistroBd',
								'idRegistro'=>$id,
								'Proveedor'=>$apodo
								);
						
						 }else{
							$respuesta=array(
								'respuesta'=>'fallidoRegistroBd'
								);
							
						 }
			
						
			}//end else

		//
		return $respuesta;//regrso la respuesta 
		$stmt->close();
    

		}


		 public static  function sql_lisartar_proveedor($tabla){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT  *FROM $tabla where estado ='1' ORDER by apodo ");

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

		//============================ACTUALIZAR O EDITAR PROVEEDOR========================================//
		public static function sql_individual_update($tabla,$id_proveedor,$nombre,$apellido,$correo,$apodo,$password,$img){
			$db=new Conexion();
			try {
				//	
				$bandera_password=false;
					if(empty($password)){//si viene vacio no actulizo el password
						$stmt= $db->conectar()->prepare("UPDATE $tabla SET 
																nombre='$nombre', 
																apellido='$apellido',
																apodo='$apodo',
																correo='$correo' , 
																img='$img',
																editado=NOW()
															WHERE id='$id_proveedor' ");
					}else{
						$bandera_password=true;
						$opciones=array(
							'cost'=>12
						);

						$hash_password=password_hash($password,
										PASSWORD_BCRYPT,$opciones);

						$stmt=$db->conectar()->prepare(" UPDATE $tabla SET 
																nombre='$nombre', 
																apellido='$apellido',
																apodo='$apodo',
																correo='$correo' ,
																img='$img', 
																password='$hash_password',
																editado=NOW()
														WHERE id='$id_proveedor' ");
					}
			} catch (Exception $e) {
				echo "Error".$e->getMessage();
			}
		
			

			
			$stmt->execute();

			if($stmt){
				//si se realizo la inserccion
				$respuesta=array(
					'respuesta'=>'exito',
					'nombre'=>$nombre,
					'apellido'=>$apellido,
					'correo'=>$correo,
					'apodo'=>$apodo,
					'img'=>$img,
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
		public static function sql_individual_eliminar($tabla,$id_proveedor){
			$db=new Conexion();
			try {
			$stmt= $db->conectar()->prepare("UPDATE $tabla SET 
													estado='0', 
													editado=NOW()
												WHERE id='$id_proveedor' ");

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