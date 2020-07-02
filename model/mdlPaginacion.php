<?php  
/**
* Clase para obtener todos los registros de una o varias tablas
*/

class PaginationModel {
	private $query;

	public function __construct($query,$where, $custom = false){
       
		if ($custom){

			$this->query = $query;
			$this->where = $where;
			
		}
		else{

			//aqui hay q hacer las consultas 
			$this->query = "SELECT  
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


			FROM  " . addslashes($query) ." ". $where;
		}
	}

	public function get_rows($start, $range, $order_by, $sort){
		try
		{
			$db=new Conexion();

			$query = $this->query
				 . " ORDER BY " 
				 . addslashes($order_by) . " " 
				 . addslashes($sort)
				 . " LIMIT :START, :RANGE";
				 
			$query = $db->conectar()->prepare($query);
			$query->bindParam(":START", $start, PDO::PARAM_INT);
			$query->bindParam(":RANGE", $range, PDO::PARAM_INT);				 
			$query->execute();
			$rows = $query->fetchAll(PDO::FETCH_NUM);
			$query->closeCursor();		
			return $rows;
		}
		catch (Exception $ex)
		{
			return null;
		}
	}

	public function get_columns_names()
	{
		try
		{  $db=new Conexion();
			$query = $this->query;
			$query = $db->conectar()->query($query);			
			$columns = $query->columnCount();
			$result = array();
						
			for ($i = 0; $i < $columns; $i++)
			{
				$column_info = $query->getColumnMeta($i);
				$result[] = $column_info["name"];
			}
			
			$query->closeCursor();
			return $result;			
		}
		catch (Exception $e)
		{
			return null;
		}		
	}

	public function length()
	{
		try
		{  $db=new Conexion();
			$query = $this->query;
			$query = $db->conectar()->query($query);
			$rows = $query->fetchAll(PDO::FETCH_NUM);
			$query->closeCursor();
			return count($rows);
		}
		catch (Exception $e)
		{
			return null;
		}		
	}
}
?>