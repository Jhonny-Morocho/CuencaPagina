
$(document).ready(function(){
 
        //inicia el sistema cargando los datos del local store y definiendo la variables listaCarrito

        if(localStorage.getItem("listaProductos")!=null){
          var listaCarrito=JSON.parse(localStorage.getItem("listaProductos"));
          listaCarrito.forEach(funcionForEach);
          
        }else{//si esta vacio el localSotarge mosntrar mensaje no exiten productos
          $(".cart-table").after('<div class="alert alert-warning" role="alert">'+
          'Carrito Vacio</div>');
          //escondo el total casillero
          $(".cart-calculator-wrapper").hide();
          $(".opciones_pago").hide();
        }

        // añadir productos al carrito
      $('.buy').on('click',function(e){// 
        e.preventDefault();// 
        console.log("xxx");
       //1.//Añadir al carrito
       var idProducto=$(this).attr("data-id");
       var nombreProducto=$(this).attr("data-nombre");
       var precio=$(this).attr("data-precio");
       console.log('idProducto',idProducto);
       console.log('nombreProducto',nombreProducto);
       console.log('precio',precio);
       
       bootoast.toast({
        message: 'Se agrego '+nombreProducto,
        type: 'success'
      });


       //si no tiene datos en local store , encones inicializo el array
       if(localStorage.getItem("listaProductos")==null){//si todavia no existe en el localstore 
        //entonces el carrito puede estar vacio o inicio el array
        listaCarrito=[];
        }else{
            //entonces agrego o concadeno
            listaCarrito.concat(localStorage.getItem("listaProductos")); 
        }
        console.log("listaCarrito",listaCarrito);

        listaCarrito.push({"idProducto"     :idProducto,
							"nombreProducto":nombreProducto,
							"precio"        :precio});
        //pinta items en el carrito de compras
        $(".cart-notification").html(listaCarrito.length);
        //guardo esos datos en el localstorage
        localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));//asignamos en el localSotre el itemn listarProductos con el dato q tiene el array
        console.log(localStorage.getItem);
        //contar la cantidad de producots en la cesta
        var cantidadCesta= Number($(".cart-notification").html());//traigo lo q tiene la cesta
        console.log(cantidadCesta);
			
    
       

      });

});


	  //=========== funcionForEach se imprime en la tabla de detalle productos.php=======///
    //=========== funcionForEach se imprime en la tabla de detalle productos.php=======///
    //=========== funcionForEach se imprime en la tabla de detalle productos.php=======///
	
			function funcionForEach(item,index){

				var cantidadProductos=listaCarrito.length;//saber cuantos producto existe
				//console.log("longitud_array_productos",cantidadProductos);;
		
				console.log(cantidadProductos);
				
		
				if(oferta==true && listaCarrito.length>=limite){//adquiere la oferta
				$(".tablita")
				.append(
		
						'<tr>'+'<td>'+(cont_x++)+'</td>'+
						
						'<TD class="class_nombre_cancion" nombre_cancion='+item.nombre_producto+'><p>'+item.nombre_producto+'</p</TD>'+
						'<TD class="class_precio_cancion"><p classs="subtotales"><span>'+( (item.precio -(descuento*item.precio)).toFixed(2) )+'</span></p></TD>'+
						'<TD class="class_precio_cancionx"><p classs="subtotales"><del>'+(item.precio)+'</del></p></TD>'+
						' <TD>'+
							'<button  class="quitar_Item_Carrito button_carrito btn btn-danger" id_Producto='
							+item.idProducto+' precio_cancion='+item.precio+'><i  class="fa fa-trash" aria-hidden="true"></i></button>'
						+'</TD>'+
						'</tr>'
					);

				}else{
				$(".tablita")
				.append(
		
						'<tr>'+'<td>'+(cont_x++)+'</td>'+
						
						'<TD class="class_nombre_cancion" nombre_cancion='+item.nombre_producto+'><p>'+item.nombre_producto+'</p</TD>'+
						'<TD class="class_precio_cancion"><p classs="subtotales"><span>'+item.precio+'</span></p></TD>'+
						'<TD class="class_precio_cancionx"><p classs="subtotales">NO APLICA</p></TD>'+
						' <TD>'+
						'<button  class="quitar_Item_Carrito button_carrito btn btn-danger" id_Producto='
						+item.idProducto+' precio_cancion='+item.precio+'><i  class="fa fa-trash" aria-hidden="true"></i></button>'
						+'</TD>'+
						'</tr>'
					);
				}
		
		
			}

