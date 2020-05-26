<?php 
	//require'class_mdl_bd_conexion.php';
    ini_set('display_errors', 'On');

	class ModeloGenero {
		//satic cuando recibo algo siempre van como static
		 public static  function sql_lisartar_genero(){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("SELECT  *FROM genero where estado ='1' ORDER by genero");

			$stmt->execute();
			return $stmt->fetchAll();

			$stmt->close();

		}

		public static  function sql_editar_genero($id,$nameGenero){

            
            $db=new Conexion();
            
            try {
                //code...
                $stmt= $db->conectar()->prepare("UPDATE genero SET
                                                        genero='$nameGenero'
                                                        WHERE id='$id' ");
    
                $stmt->execute();
    
                if ( $stmt->rowCount() > 0) {
                    //Se grabo bien
                        $respuesta=array(
                            'respuesta'=>'exito',
                            'genero'=>$nameGenero
                            );
                    }else{
                        $respuesta=array(
                            'respuesta'=>'noExisteCambios',
                            'genero'=>$nameGenero
                            );
                    }
                       
                 

            } catch (Exception $e) {
                $respuesta=array(
                    'try'=>$e->getMessage(),
                    'respuesta'=>'error'
                    );
            }
        return $respuesta;
        $stmt->close();

		}

		public static  function sql_agregar_genero($genero){
			$db=new Conexion();
			$stmt= $db->conectar()->prepare("INSERT INTO genero (genero,estado) VALUES('$genero','1') ");

			$stmt->execute();

			if ( $stmt->rowCount() > 0) {
				//Se grabo bien
					$respuesta=array(
						'respuesta'=>'exito',
						'genero'=>$genero
						);
				return $respuesta;
			 }
			$stmt->close();

		

		}


		public static function sql_eliminar_genero($id){
			$db=new Conexion();
			try {
			$stmt= $db->conectar()->prepare("UPDATE genero SET 
													estado='0' 
												WHERE id=$id ");

			} catch (Exception $e) {
				echo "Error".$e->getMessage();
			}
		
			
			$stmt->execute();

			if ( $stmt->rowCount() > 0) {
				//Se grabo bien en la base de datos
                $respuesta=array(
                    'respuesta'=>'exito',
                    );
				return $respuesta;
			 }else{
                $respuesta=array(
                    'respuesta'=>'fallido'
                    );
				return $respuesta;
             }
		
			//si alguna fila se modifico entonces si se edito
			$stmt->close();
		}

	}



 ?>