<?php

ini_set('display_errors', 'On');

	class ModeloMembresia {
        public static  function sqlListarMembresias(){// las membresias disponibles es stock
            $db=new Conexion();
            try {
                    $stmt= $db->conectar()->prepare("SELECT * FROM  membresia ");
            } catch (Exception $e) {
                $respuesta=array(
                    'respuesta'=>$e->getMessage()
                    );
            }
            $stmt->execute();

            return $stmt->fetchAll();
			$stmt->close();

        }
        
        public static  function sqlEditarMembresia ($arrayMembresias){
            $db=new Conexion();
            $nombreMembresia=$arrayMembresias['inputNomMembresia'];
            $numDescargas=$arrayMembresias['inputNumeroDescargas'];
            $precio=$arrayMembresias['inputPrecio'];
            $idMembresia=$arrayMembresias['idMembresia'];

            //========datos del formuarlio===============
        
    
            $stmt= $db->conectar()->prepare("UPDATE  membresia SET
                                                    nombreMembresia=:pdoNombreMembresia,
                                                    precio=:pdoPrecio,
                                                    numDescargas=:pdoNumDescargas
                                                    WHERE id=:podId
                                     
                                            ");
            $stmt->bindParam(':pdoNombreMembresia',$nombreMembresia);
            $stmt->bindParam(':pdoPrecio',$precio);
            $stmt->bindParam(':pdoNumDescargas',$numDescargas);
            $stmt->bindParam(':podId',$idMembresia);
            $stmt->execute();
    
            if ( $stmt->rowCount() > 0) {
                //Se grabo bien en la base de datos
                $respuesta=array(
                    'respuesta'=>'exitoRegistroBd'
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
  
     }
    




 ?>