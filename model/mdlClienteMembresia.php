<?php

ini_set('display_errors', 'On');

//require'class_mdl_bd_conexion.php';
	/**
	 *
	 */
	class Modelo_Membresia {


		//satic cuando recibo algo siempre van como static
		 public static  function sqlAgregarMembresiaCliente($arraDatosMembresia,$metodoPago,$precioUnidad){
            $db=new Conexion();

            //aplico los dias de promosion
            $fechaActual = date('Y-m-j');
            $fechaAddDays = strtotime ( '+30 day' , strtotime ( $fechaActual ) ) ;
            $fechaAddDays = date ( 'Y-m-j' , $fechaAddDays );
  
            try {
                    $stmt= $db->conectar()->prepare("INSERT INTO membresia_cliente

                                                    (tipo,
                                                    fechaCompra,
                                                    fechaExpiracion,
                                                    numDescargas,
                                                    idCliente,
                                                    totalCancelar,
                                                    tipoPago,
                                                    precioUnitario
                                                    )

                                                    VALUES(:nameMembresia,
                                                            :dateCompra,
                                                            :dateExperiracion,
                                                            :numDescargas,
                                                            :idCliente,
                                                            :precio,
                                                            :metodoPago,
                                                            :precioUnidad
                                                            )

                                                    ");
             $stmt->bindParam(':nameMembresia',$arraDatosMembresia['nombreMembresia'][0]);
             $stmt->bindParam(':dateCompra',$fechaActual);
             $stmt->bindParam(':dateExperiracion',$fechaAddDays);
             $stmt->bindParam(':numDescargas',$arraDatosMembresia['get']['numDescargas']);
             $stmt->bindParam(':idCliente',intval($arraDatosMembresia['get']['idCliente'])); 
             $stmt->bindParam(':precio',floatval($arraDatosMembresia['precioProducto'][0])); 
             $stmt->bindParam(':metodoPago',$metodoPago);
             $stmt->bindParam(':precioUnidad',floatval($precioUnidad));
             //settype($arraDatosMembresia['precioProducto'][0], 'float'); 
            } catch (Exception $e) {
                //echo "Error".$e->getMessage();
                $respuesta=array(
                    'respuesta'=>$e->getMessage()
                    );
            }

            $stmt->execute();
            $id=$db->lastInsertId();

            if($stmt){
				//si se realizo la inserccion
				$respuesta=array(
					'respuesta'=>'exito',
					);

			}else{
				$respuesta=array(
					'respuesta'=>'fallo la insercion'
					);

            }




            return $respuesta;
			$stmt->close();

        }
        public static  function sqlListarMembresiasCliente($idCliente){
            $db=new Conexion();


            try {
                    $stmt= $db->conectar()->prepare("SELECT * FROM  membresia_cliente where idCliente ='$idCliente' order by  id desc");
            } catch (Exception $e) {
                //echo "Error".$e->getMessage();
                $respuesta=array(
                    'respuesta'=>$e->getMessage()
                    );
            }

            $stmt->execute();

            return $stmt->fetchAll();
            $stmt->close();

        }   
        
        public static  function sqlActualizarMembresiaCliente($idMembresia,$numDescargas){// cuando adquiere productos se descuenta el numero de descargas
            $db=new Conexion();

            try {
                    $stmt= $db->conectar()->prepare("UPDATE membresia_cliente SET
                    rango='$numDescargas'
                WHERE id='$idMembresia' ");

            } catch (Exception $e) {
                //echo "Error".$e->getMessage();
                $respuesta=array(
                    'respuesta'=>$e->getMessage()
                    );
            }

            $stmt->execute();
            $id=$db->lastInsertId();
            if($stmt){
				//si se realizo la inserccion
				$respuesta=array(
					'respuesta'=>'exito',
                    'id_cliente'=>$id
				
					);

			}else{
				$respuesta=array(
					'respuesta'=>'no se inserto'
					);

            }
            return $respuesta;
			$stmt->close();

        }
        
	}



 ?>