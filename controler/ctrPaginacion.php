<?php
/**
* Clase para pedir los elementos que están en una página
* y ajustar la paginación dependiendo de la página actual
*/

require'ctrEncriptar.php';

class Pagination {
	private static $page;
	private static $range;
	private static $section_size;	
	private static $pagination_model;

	public static function config($page, $range, $table,$where, $custom_select = null, $section_size = 5,$tipo)
	{
		self::$page = (string)($page);
		self::$range = $range;
		self::$section_size = $section_size;						

		if ($custom_select == null && $table != null)
		{
			self::$pagination_model = new PaginationModel($table,$where,$tipo);			
		}
		else
		{
			self::$pagination_model = new PaginationModel($custom_select, true);			
		}
	}
	
	public static function show_rows($order_by, $sort = "DESC"){
		$page = self::$page;
		$range = self::$range;		
		$pagination_model = self::$pagination_model;		
		$start = ($page - 1) * $range;
		$rows = $pagination_model->get_rows($start, $range, $order_by, $sort);
		$names = $pagination_model->get_columns_names();
		$result = array(array());											
		
		if ($rows != null)
		{
			for ($i = 0; $i < count($rows); $i++)
			{
				for ($j = 0; $j < count($names); $j++)
				{
					$result[$i][$names[$j]] = $rows[$i][$j];
				}				
			}
		}
		else
		{			
			for ($j = 0; $j < count($names); $j++)
			{
				$result[0][$names[$j]] = "Error: vacío";
			}
		}
		//encriptar la data
		$arrayAux=array();
		$ObjEncriptar=new Encriptar();
		foreach ($result as $key => $value) {
			$idEncriptado=$ObjEncriptar->encriptarDatos($value['id']);
			$arrayAux[$key]['id']=$idEncriptado;
			$arrayAux[$key]['precio']=$value['precio'];
			$arrayAux[$key]['nombrePista']=$value['nombrePista'];
			$arrayAux[$key]['demo']=$value['demo'];
			$arrayAux[$key]['img']=$value['img'];
			$arrayAux[$key]['caratula']=$value['caratula'];
			$arrayAux[$key]['nombrePista']=$value['nombrePista'];
			$arrayAux[$key]['artista']=$value['artista'];
			$arrayAux[$key]['genero']=$value['genero'];
			$arrayAux[$key]['apodo']=$value['apodo'];
			$arrayAux[$key]['fecha']=$value['fecha'];
		}
		
		return $arrayAux;
	}

	public static function data()
	{
		$page = self::$page;
		$range = self::$range;
		$section_size = self::$section_size;	
		$pagination_model = self::$pagination_model;
		$actual_section = 1;
		$total_rows = $pagination_model->length();
		$total_pages = ceil($total_rows / $range);
		$total_sections = ceil($total_pages / $section_size);
		$section_count = $section_size;
		$error = false;

		do
		{
			if ($page > $section_count)
			{
				$section_count += $section_size;
				$actual_section++;
			}
		}
		while($page > $section_count);

		$section_end = $actual_section * $section_size;
		$section_start = ($section_end - $section_size) + 1;

		if ($page > $total_pages || $page <= 0 || !ctype_digit($page))
		{
			$error = ($total_rows == 0) ? false : true;
			
		}

		$pagination_data = array();
		$pagination_data["error"] = $error;
		$pagination_data["previous"] = $page - 1;
		$pagination_data["next"] = $page + 1;
		$pagination_data["this-page"] = $page;
		$pagination_data["total-pages"] = $total_pages;
		$pagination_data["section-start"] = $section_start;
		$pagination_data["section-end"] = $section_end;
		$pagination_data["actual-section"] = $actual_section;
		$pagination_data["total-sections"] = $total_sections;
		return $pagination_data;
	}

	public static function validarCamposBuscador($cadenaBusqueda){
		$Obj_validar= new CtrValidarCampos();

		//variables o banderas
		$boolean_validacion=true;
   
		$aValidarCampos=array(
			
		   'validacion_cadenaBusqueda_texto'=>$Obj_validar->soloTextoBuscador($cadenaBusqueda)
		);
   
		//================Recorrer validacion que no este vacio el campo para verificar que todos esten en TRUE
		 //================Recorrer validacion que no este vacio el campo para verificar que todos esten en TRUE
	   foreach ($aValidarCampos as $key => $value) {// recorrer todas las respueta de los campos vacios
	   
		   if($value==false){//si llega vacio hacer imprimir
			   
			   //echo'<br>'.$key .' '.$value;
			   $boolean_validacion=false;
		   }
	   }

	   
	   if($boolean_validacion==true){//validacion de campos campos ññenps
		$respuesta=array('respuesta_validacion'=>$boolean_validacion,'arrayValidaion'=>$aValidarCampos);//los campos campos estan vacios
		return $respuesta;
		   
	   }else{
		   $respuesta=array('respuesta_validacion'=>$boolean_validacion,'arrayValidaion'=>$aValidarCampos);//los campos campos estan vacios
		   return $respuesta;
	   }

	 

	}
}