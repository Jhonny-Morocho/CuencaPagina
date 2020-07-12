	<?php

		require __DIR__ .'/bootstrap.php';
		ini_set('display_errors', 'On');
		//LAS CLASES DE PAY PAL
		use PayPal\Api\Payer;
		use PayPal\Api\Item;
		use PayPal\Api\ItemList;
		use PayPal\Api\Details;
		use PayPal\Api\Amount;
		use PayPal\Api\Transaction;
		use PayPal\Api\RedirectUrls;
		use PayPal\Api\Payment;

	//comprobqamos la respuest a true o folse de la funcion revisar usuario
	session_start();


	 ?>


<?php

	//1.
	if(isset($_SESSION['usuario']) and $_SESSION['tipo_usuario']=='Cliente' and isset($_SESSION['id_cliente']) ){// si exite una session caso contrario no permitir entrar

		$id_cliente=$_SESSION['id_cliente'];
		$opcion=@$_POST['value_radio'];

		

			switch ($opcion) {

								//==========================PAGO PAYPAL=============================//
								//==========================PAGO PAYPAL=============================//
				// CASE 1.paypal
			   case "paypal":

			   		if(isset($_POST["id_cancion"])){//cualquier variable post

							//obtengo los datos desde el post y los guardo en la variablbes

					 		$id_cancion=$_POST['id_cancion'];
						 	$nombre_cancion=$_POST['nombre_cancion'];
							$precio_cancion=$_POST['precio_cancion'];

							//**************guardo todos los datos en un arreglo
							$datos=array(
									"id"=>$id_cancion,
									"nombre"=>$nombre_cancion,
									"precio"=>$precio_cancion
							);


							//separamos los datos del datos que es un arrayt
							$titulo_final=explode(",", $datos["nombre"]);
							$id_final=explode(",", $datos["id"]);
							$precio_final=explode(",", $datos["precio"]);//para separar remplazo la comas por guione y hago una cadena


							$i=0;
							$precio_total=0;
							$compra=new Payer();
							$compra->setPaymentMethod('paypal');
							/*print_r($precio_final);*/
							$arreglo_canciones=array();



							foreach ($precio_final as  $key => $value) {
								//echo "<br>key ".$key."<br>";
								//echo "key ".$value;
								//creamos varios articulos
								${"articulo$key"}=new Item();
								$arreglo_canciones[]=${"articulo$key"};

								${"articulo$key"}->setName('Nombre Cancion: '.$titulo_final[$key])//el i lleva el nombre de la cancion
												->setCurrency('USD')//la moneda a cobrar
												->setQuantity((int)1)//siempre la cancion va hacer (1)
												->setSku($id_final[$key])
												->setPrice((double)$precio_final[$key] );//precio de la cancion

											$precio_total=(double)$precio_final[$key]+$precio_total;


							}


								//echo "este son lo ids de los producto";
								//echo"<br>". $articulo0->getSku();//nombre del tema selecionado
								//echo "<br>".$articulo1->getSku();//nombre del tema selecionado
								//echo "<br>".$articulo2->getSku();//nombre del tema selecionado

								$listaArticulos=new ItemList();
								$listaArticulos->setItems($arreglo_canciones);

								$cantidad=new Amount();
								$cantidad->setCurrency('USD')
								        ->setTotal((double)$precio_total);//total a pagar con 3 producto(2 cancio9n y un boton)


								//caractersiticas de la trsaccion
								$transaccion= new Transaction();
								$transaccion->setAmount($cantidad)
								            ->setItemList($listaArticulos)
								            ->setDescription('Pro Edits Club')
								            ->setInvoiceNumber(uniqid()); //registro numero unico de esa trasaccion
								            //echo "este es unico".$transaccion->getInvoiceNumber();
								            $ID_registro=$transaccion->getInvoiceNumber();
							/*	echo "LA TRANSACCION:".$transaccion->getInvoiceNumber();*/

								//datos extras
								$total_cancelar_ajax=$_POST['total_cancelar'];
								$precio_cancion_final=str_replace(",","-", $datos["precio"]);
						/*		echo "precio final productos: ";
								var_dump($precio_cancion_final);*/

								$redireccionar=new RedirectUrls();
								$redireccionar->setReturnUrl(URL_SITIO."/Pay_Pal/pago_finalizado_paypal.php?id_cliente=$id_cliente")//pago exitoso
											  ->setCancelUrl(URL_SITIO."/Pay_Pal/pago_finalizado_paypal.php?exito=false&id_pago{$ID_registro}");
								//$redireccionar->setReturnUrl(URL_SITIO."/Pay_Pal/pago_finalizado_paypal.php?exito=true&id_pago{$ID_registro}&productos=".$id_final."&total_cancelar=".$total_cancelar_ajax."&productos_precio=".$precio_cancion_final)//pago exitoso
								//            ->setCancelUrl(URL_SITIO."/Pay_Pal/pago_finalizado_paypal.php?exito=false&id_pago{$ID_registro}");//cancelar no quiso pagar


								$pago=new Payment();
								$pago->setIntent("sale")
								    ->setPayer($compra)
								    ->setRedirectUrls($redireccionar)
								    ->setTransactions(array($transaccion));



									try{
									    $pago->create($apiContext);
									}catch(PayPal\Exception\PayPalConnectionException $pce){
									    echo"<pre>";
									    print_r(json_decode($pce->getData()));
									    exit;
									    echo"</pre>";
									}

								$aprobado=$pago->getApprovalLink();
								//echo $aprobado;//imprimo la url de paypal para que el ajax de respuesta lo capte y me direccione a paypal
								$array_paypal=array('url_paypal'=>$aprobado,
													'respuesta'=>'exito',
													'tipo_respuesta'=>'paypal',
													'totoal_cancelar'=>$total_cancelar_ajax);
								die(json_encode($array_paypal));

						}else{
							echo "no llego el sbumit";
					}// fin del if del post


				break;
			

			   case "saldo":
			   pagar_productos_saldo();
					 break;

				case "membresia":
				pagar_productos_membresia();
					 break;
			}

	}else{// ===============si no existe session no ingresa=====//


		$array_session=array('respuesta_session'=>'no_exite_session',
								'tipo_respuesta'=>'session');
		die(json_encode($array_session));

	}/// fin del if pregunta si existe sexxion






//==========================FUNCION SALDO=============================//
//==========================FUNCION SALDO=============================//
//==========================FUNCION SALDO=============================//
	function pagar_productos_saldo(){//

			if(isset($_POST["id_cancion"])){//si es un post

				include'../Modelo/class_mdl_bd_conexion.php';
				include'../Modelo/class_mdl_cliente.php';

				require'../Controlador/class_ctr_cliente.php';

				$id_cliente=$_SESSION['id_cliente'];

				$respuesta_cliente=CtrCliente::ctr_listar_cliente();
				$saldo_actual_cliente=0;//decalro la variable para guardar el saldo9


				//print_r($respuesta_cliente);
				 foreach($respuesta_cliente as $key=>$value){//filtro los datos del cliente para preguntar si tiene saldo
					if($id_cliente==$value['id']){
						$saldo_actual_cliente=$value['saldo_actual'];
					}
				}

				//=============VERIFICAR SI TIENE SALDO==============/
				$total_cancelar_ajax=$_POST['total_cancelar'];//

				if($saldo_actual_cliente>=$total_cancelar_ajax){

					/////////////////SALDO DISPONIBLE PARA HACER COMPRA//////////////////
					$id_cancion=$_POST['id_cancion'];
				 	$nombre_cancion=$_POST['nombre_cancion'];
					$precio_cancion=$_POST['precio_cancion'];

					$datos=array(
							"id"=>$id_cancion,
							"nombre"=>$nombre_cancion,
							"precio"=>$precio_cancion
					);


					$titulo_final=explode(",", $datos["nombre"]);
					$id_final=str_replace(",","-", $datos["id"]);
					$precio_final=explode(",", $datos["precio"]);//para separar remplazo la comas por guione y hago una cadena
					$precio_cancion_final=str_replace(",","-", $datos["precio"]);



					//envio el array de respuesta
					$array_saldo=array('tipo_respuesta'=>'saldo',
										'url_pago_finalizado_saldo'=>'../Pay_Pal/pago_finalizado_recarga.php?exito=true&metodo_pago=saldo&productos_id='.$id_final.'&productos_precio='.$precio_cancion_final.'&total_cancelar='.$total_cancelar_ajax.'&saldo_actual_cliente='.$saldo_actual_cliente,
										'total_saldo'=>$saldo_actual_cliente);
				}else{
					/*echo "saldo insuficiente";*/
					$array_saldo=array('tipo_respuesta'=>'saldo',
										'respuesta_saldo'=>'saldo_insuficiente',
										'total_saldo'=>$saldo_actual_cliente);
				}

			}//fin if opcion pago recarga
			
			die(json_encode($array_saldo));
	}//en funcion


	function pagar_productos_membresia(){//

		
		if(isset($_POST["id_cancion"])){//si es un post
			include'../Modelo/class_mdl_bd_conexion.php';
			include'../Modelo/class_mdl_membresia.php';
			require'../Controlador/class_ctr_membresia.php';
			
			//1. preguntar si la membria ahun no ha caducado
			$id_cliente=$_SESSION['id_cliente'];
			//=============VERIFICAR SI TIENE SALDO==============/
			$total_cancelar_ajax=$_POST['total_cancelar'];//

			//=============AHORA EL CLIENTE PUEDE COMPAR LA MEMBRESIA SIN LIMITE DE TIEMPO X ESO COMENTE ESTA LNEA
			$respuesta_membresia=CtrMembresia::ctr_controlar_compra_membresia($id_cliente);
			//=============AHORA EL CLIENTE PUEDE COMPAR LA MEMBRESIA SIN LIMITE DE TIEMPO X ESO COMENTE ESTA LNEA
			
			//obtengo los datos desde el post y los guardo en la variablbes

			$id_cancion=$_POST['id_cancion'];
			$nombre_cancion=$_POST['nombre_cancion'];
			$precio_cancion=$_POST['precio_cancion'];

			//**************guardo todos los datos en un arreglo
			$datos=array(
					"id"=>$id_cancion,
					"nombre"=>$nombre_cancion,
					"precio"=>$precio_cancion
			);

			$titulo_final=explode(",", $datos["nombre"]);
			$id_final=str_replace(",","-", $datos["id"]);
			$precio_final=explode(",", $datos["precio"]);//para separar remplazo la comas por guione y hago una cadena
			$precio_cancion_final=str_replace(",","-", $datos["precio"]);


			//=============AHORA EL CLIENTE PUEDE COMPAR LA MEMBRESIA SIN LIMITE DE TIEMPO X ESO COMENTE ESTA LNEA
		// 	switch ($respuesta_membresia['respuesta']) {//verificar si la membresia esta activada o no activa
		// 		case "true"://la membresia activa 

		// 	$array_membresia=array('tipo_respuesta'=>'membresia',
		// 							'estado_membresia'=>'activa',
		// 							'id_membresia'=>$respuesta_membresia['id_membresia'],
		// 							'rango_descarga'=>$respuesta_membresia['rango_descarga'],
		// 'url_pago_finalizado_membresia'=>'../Pay_Pal/pago_finalizado_membresia.php?exito=true&metodo_pago=Membresia&productos_id='.$id_final.'&productos_precio='.$precio_cancion_final.'&rango_actual_descarga='.$respuesta_membresia['rango_descarga'].'&total_cancelar='.$total_cancelar_ajax.'&id_membresia='.$respuesta_membresia['id_membresia'] );
		// 			break;
		// 		case "false"://membresiica caducada
		// 		$array_membresia=array('estado_membresia'=>'no_activa','tipo_respuesta'=>'membresia');//no cuenta con membresia activa
		// 			break;


		// 	}
			//=============AHORA EL CLIENTE PUEDE COMPAR LA MEMBRESIA SIN LIMITE DE TIEMPO X ESO COMENTE ESTA LNEA
	
			//=============NEUVO LINEA DE CODIFO Q REMPLAZA LA ANTERIOR==============================//

			//print_r($respuesta_membresia);
		
			//echo"soy paypal contrroladore";
			$array_membresia=array('tipo_respuesta'=>'membresia',
									'estado_membresia'=>'activa',
									'id_membresia'=>$respuesta_membresia['id_membresia'],
									'rango_descarga'=>$respuesta_membresia['rango_descarga'],
		'url_pago_finalizado_membresia'=>'../Pay_Pal/pago_finalizado_membresia.php?exito=true&metodo_pago=Membresia&productos_id='.$id_final.'&productos_precio='.$precio_cancion_final.'&rango_actual_descarga='.$respuesta_membresia['rango_descarga'].'&total_cancelar='.$total_cancelar_ajax.'&id_membresia='.$respuesta_membresia['id_membresia'] );


			

		}//fin if opcion pago recarga

		//=============NEUVO LINEA DE CODIFO Q REMPLAZA LA ANTERIOR=====================
		die(json_encode($array_membresia));
	}// end de la funcion

 ?>