<?php 

ini_set('display_errors', 'On');
//require'class_mdl_bd_conexion.php';

	/**
	 * 
	 */


	class ModeloProducto {
        //satic cuando recibo algo siempre van como static
        
        

		public static  function sql__agrgar_prodcuto($arrayProductos,$demo,$remixCompleto){
		$db=new Conexion();
			
        //========datos del formuarlio================

		$tituloProducto=$arrayProductos['inputTitulo'];
		$idProveedor=$_POST['id_proveedor'];
		$artistaProducto=$arrayProductos['inputArtista'];
		$generoProducto=$arrayProductos['id_genero'];
		$bpmProducto=$arrayProductos['inputBpm'];
        $precioProducto=$arrayProductos['inputDolares'].".".$arrayProductos['inputCentavos'];
        //print_r($arrayProductos);
   
        date_default_timezone_set('America/Guayaquil');
        $fecha_actual=date("Y-m-d");

        $stmt= $db->conectar()->prepare("INSERT INTO producto
                                                (
                                                idProveedor, artista,
                                                nombrePista, fecha,
                                                bpm, idGenero, precio,
                                                estado, demo, remixCompleto
                                                ) 

                                            VALUES(
                                                '$idProveedor', '$artistaProducto',
                                                '$tituloProducto','$fecha_actual',
                                                '$bpmProducto',	'$generoProducto','$precioProducto',
                                                '1', '$demo', '$remixCompleto'
                                                ) 
                                        ");

            $stmt->execute();
            $id=$db->lastInsertId();
            if ( $stmt->rowCount() > 0) {
                //Se grabo bien en la base de datos
                $respuesta=array(
                    'respuesta'=>'exitoRegistroBd',
					'idRegistro'=>$id,
					'idProveedor'=>$idProveedor,
                    'urlDemo'=>$demo,
                    'urlRemixCompleto'=>$remixCompleto
                    );
            
                }else{
                $respuesta=array(
                    'respuesta'=>'fallidoRegistroBd'
                    );
                
                }
			
						
	

		//
		return $respuesta;//regrso la respuesta 
		$stmt->close();
    

		}


		 public static  function sql_lisartar_productos(){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT  
                                                    producto.id,
                                                    producto.idProveedor,
                                                    producto.artista,
                                                    producto.nombrePista,
                                                    producto.fecha,
                                                    producto.bpm,
                                                    producto.idGenero,
                                                    producto.precio,
                                                    producto.demo,
                                                    producto.remixCompleto,
                                                    producto.precio,

                                                    proveedor.apodo,

                                                    genero.genero


                                                    FROM producto,proveedor,genero 

                                                    where producto.idProveedor=proveedor.id and
                                                          producto.idGenero=genero.id and 
                                                          producto.estado=1 

                                                          ORDER by  producto.id  desc
                                                   ");

			$stmt->execute();
			return $stmt->fetchAll();

			$stmt->close();

		}


	
	

		//============================EDITAR PRODUCTO========================================//
		public static function sql_editar_Producto($arrayDatosProducto,$casoActulizar,$ubicacionDemo,$ubicacionCompleto){
			$db=new Conexion();
		
				//echo"soy modelo";
				//die(json_encode($arrayDatosProducto));
				try {
						//$idProveedor=$arrayDatosProducto['id_proveedor'];
						$idProducto=$arrayDatosProducto['id_producto'];
						$tituloProducto=$arrayDatosProducto['inputTitulo'];
						$artistaProducto=$arrayDatosProducto['inputArtista'];
						$generoProducto=$arrayDatosProducto['id_genero'];
						$bpmProducto=$arrayDatosProducto['inputBpm'];
						$precioProducto=$arrayDatosProducto['inputDolares'].".".$arrayDatosProducto['inputCentavos'];


						switch ($casoActulizar) {
							case 'soloDatos':
								$stmt= $db->conectar()->prepare("UPDATE producto SET 
																	artista='$artistaProducto',
																	nombrePista='$tituloProducto',
																	bpm='$bpmProducto', idGenero='$generoProducto', precio='$precioProducto'
																WHERE id='$idProducto' ");
								break;
							case 'achivoDemo':
								$stmt= $db->conectar()->prepare("UPDATE producto SET 
																	artista='$artistaProducto',demo='$ubicacionDemo',
																	nombrePista='$tituloProducto',
																	bpm='$bpmProducto', idGenero='$generoProducto', precio='$precioProducto'
																WHERE id='$idProducto' ");
								break;
							
							case 'achivoCompleto':
								$stmt= $db->conectar()->prepare("UPDATE producto SET 
																	artista='$artistaProducto',remixCompleto='$ubicacionCompleto',
																	nombrePista='$tituloProducto',
																	bpm='$bpmProducto', idGenero='$generoProducto', precio='$precioProducto'
																WHERE id='$idProducto' ");
								break;
								
							case 'todosLosArchivos':
							$stmt= $db->conectar()->prepare("UPDATE producto SET 
																artista='$artistaProducto',remixCompleto='$ubicacionCompleto',demo='$ubicacionDemo',
																nombrePista='$tituloProducto',
																bpm='$bpmProducto', idGenero='$generoProducto', precio='$precioProducto'
															WHERE id='$idProducto' ");
							break;
						
							default:
								# code...
								break;
						}
						
				} catch (Exception $e) {
					echo "Error".$e->getMessage();
				}
			
				$stmt->execute();

				if($stmt){
					//si se realizo la inserccion
					$respuesta=array(
						'respuesta'=>'exito',
						'caso'=>$casoActulizar
						
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

	

	//============================ELIMINAR LOGICAMENTE  AL PRDICTO========================================//
	public static function sqlEliminarProducto($arrayProducto){
			$db=new Conexion();
		
			try {
			$idProducto=$arrayProducto['id'];
			$stmt= $db->conectar()->prepare("UPDATE producto SET 
													estado='0'
												WHERE id='$idProducto' ");

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