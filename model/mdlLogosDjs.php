<?php 

ini_set('display_errors', 'On');
//require'class_mdl_bd_conexion.php';

	/**
	 * 
	 */
	class ModeloLogosDjs {
		//satic cuando recibo algo siempre van como static
		public static  function sqlAddLogoImg($dataCarrusel){
			$db=new Conexion();
			//========datos del formuarlio================
			$nombreArchivo=$dataCarrusel['nombreArchivo'];
			date_default_timezone_set('America/Guayaquil');
			$fecha_actual=date("Y-m-d");
			$estado=1;
			$stmt= $db->conectar()->prepare("INSERT INTO logos 
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


		 public static  function sqlListarLogosDJs(){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT  *FROM logos where estado=1");

			$stmt->execute();
			return $stmt->fetchAll();

			$stmt->close();

		}



		//============================EDITAR IMG ========================================//
		public static function sqlEditarLogosDjS($arrayDatos,$idImg){
			$db=new Conexion();
			$nombreArchivo=$arrayDatos['nombreArchivo'];
			try {
				
				$stmt= $db->conectar()->prepare("UPDATE logos SET 
															img=:nuevoImg
														WHERE id=:idImg ");
			$stmt->bindParam(':nuevoImg',$nombreArchivo);
			$stmt->bindParam(':idImg',$idImg);
			} catch (Exception $e) {
				echo "Error".$e->getMessage();
			}
		
				$stmt->execute();

				if($stmt){
					//si se realizo la inserccion
					$respuesta=array(
						'respuesta'=>'exito',
						'img'=>$nombreArchivo
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
		//============================elimnar imgen del carrusel ========================================//
		public static function sqlEliminarLogoDj($idImg,$banderaBorrar){
			$db=new Conexion();
			$estado=0;
			try {
				
				$stmt= $db->conectar()->prepare("UPDATE logos SET 
															estado=:estado
														WHERE id=:idImg ");
			$stmt->bindParam(':estado',$estado);
			$stmt->bindParam(':idImg',$idImg);
			} catch (Exception $e) {
				echo "Error".$e->getMessage();
			}
		
				$stmt->execute();

				if($stmt){
					//si se realizo la inserccion
					$respuesta=array(
						'respuesta'=>'exito',
						'banderaBorrar'=>$banderaBorrar
						);
						return $respuesta;
				}else{
					$respuesta=array(
						'respuesta'=>'false',
						'banderaBorrar'=>$banderaBorrar
						);
						return $respuesta;
				}
			

				//si alguna fila se modifico entonces si se edito

				$stmt->close();
		}


	

	}



 ?>