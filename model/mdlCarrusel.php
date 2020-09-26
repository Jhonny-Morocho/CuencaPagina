<?php 

ini_set('display_errors', 'On');
//require'class_mdl_bd_conexion.php';

	/**
	 * 
	 */
	class ModeloCarrusel {
		//satic cuando recibo algo siempre van como static
		public static  function sqlAddCarruselImg($dataCarrusel){
			$db=new Conexion();
			//========datos del formuarlio================
			$nombreArchivo=$dataCarrusel['nombreArchivo'];
			date_default_timezone_set('America/Guayaquil');
			$fecha_actual=date("Y-m-d");
			$estado=1;
			$stmt= $db->conectar()->prepare("INSERT INTO carrusel 
													(img,fecha,estado) 

												VALUES(:imgUrl,:fechaRegistro,:estado) 
											");
			$stmt->bindParam(':imgUrl',$nombreArchivo);
			$stmt->bindParam(':fechaRegistro',$fecha_actual);
			$stmt->bindParam(':estado',$estado);
			$stmt->execute();
			$id=$db->lastInsertId();
			if ( $stmt->rowCount() > 0) {
				//Se grabo bien en la base de datos
				$respuesta=array(
					'respuesta'=>'exitoRegistroBd'
					);
				}//end else
				else{
				$respuesta=array(
					'respuesta'=>'fallidoRegistroBd'
					);
				
			}
			return $respuesta;//regrso la respuesta 
			$stmt->close();
		}


		 public static  function sqlListarImgCarrusel(){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT  *FROM carrusel ");

			$stmt->execute();
			return $stmt->fetchAll();

			$stmt->close();

		}



		//============================ACTUALIZAR O EDITAR PROVEEDOR IMG========================================//
		public static function sqlEditarImgCarruselIndividual($arrayProveedorImg){
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