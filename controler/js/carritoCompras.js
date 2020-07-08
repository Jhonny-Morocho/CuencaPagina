
//$(document).ready(function(){
 
        //inicia el sistema  en car.php se imprime los datoscargando los datos del local store y definiendo la variables listaCarrito

        if(localStorage.getItem("listaProductos")!=null){
          var listaCarrito=JSON.parse(localStorage.getItem("listaProductos"));
          $(".cart-notification").html(listaCarrito.length);//
          listaCarrito.forEach(funcionForEach);
          
        }else{//si esta vacio el localSotarge mosntrar mensaje no exiten productos
          $(".cart-table").after('<div class="alert alert-warning carritoVacio" role="alert">'+
          'Your cart is empty</div>');
          //escondo el total casillero
          $(".cart-calculator-wrapper").hide();
          $(".opciones_pago").hide();
        }

      // ========================añadir productos al carrito================================//
      // ========================añadir productos al carrito================================//
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
			
			  // agrego una nueva variable para saber cuantos productos tengo en el localstore y la suma=========//
        var canridadCesta= Number($(".cart-notification").html());//traigo lo q tiene la cesta
        console.log(cantidadCesta);
			
			  //  guardo el valor obtenido de la cesta
			  
			
      });

      $(".deleItemCar").on('click',function(e){
        e.preventDefault();
        $(this).parent().parent().remove();//quitamos visualmente
        
        funcionRecorrerItemBorrar();
        $(".cart-notification").html(listaCarrito.length);//no se que es
        
        
        //window.location.href = "../carrito_compras.php";
      
        
        
      });

//});

			function funcionForEach(item,index){// imprimir datos en la tabla de car.php

				var cantidadProductos=listaCarrito.length;//saber cuantos producto existe
				//console.log("longitud_array_productos",cantidadProductos);;
		
        console.log(cantidadProductos);
        console.log(item.nombreProducto);
				
        console.log(index);
				$(".dataProductos")
				.append(
		
						'<tr>'+'<td>'+(index+1)+'</td>'+
						
						'<TD  class="classNomProducto" nombre_cancion='+item.nombreProducto+'><p>'+item.nombreProducto+'</p</TD>'+
						'<TD class="classPrecioCancion"><p classs="classPrecioUnitario">$<span>'+item.precio+'</span></p></TD>'+
						' <TD>'+
						    '<i  class="fa fa-trash deleItemCar btnCarrito"  aria-hidden="true"  data-precioCancion='+item.precio+' data-id-Producto='
                +item.idProducto+'></i>'
						+'</TD>'+
						'</tr>'
					);
			}

      //

      function funcionRecorrerItemBorrar(){
        var idProducto=$(".btnCarrito");//caputuramos todos el botones
        var classNombreProducto=$(".classNomProducto");//todos los nodos
        console.log(idProducto);
        console.log(classNombreProducto);
        // recorrer items para borrar productos
        $(".cart-notification").html(listaCarrito.length);//
        // vaciar el array
        listaCarrito=[];// si ahun quedan productos actualizo el array7
      
        //
        var idProductoArray,nombreProductoArray,precioProductoArray,subTotalPagar;

        if(idProducto.length!=0){
          for (let index = 0; index < idProducto.length; index++) {
         
            idProductoArray=$(idProducto[index]).attr("data-id-Producto");
            nombreProductoArray=$(classNombreProducto[index]).text();//obtengo nombre cancion
            precioProductoArray=$(idProducto[index]).attr("data-precioCancion");

            console.log('idProductoArray',idProductoArray);
            console.log('nombreProductoArray',nombreProductoArray);
            console.log('precioProductoArray',precioProductoArray);

             listaCarrito.push({"idProducto":idProductoArray,
                                "nombreProducto":nombreProductoArray,
                                "precio":precioProductoArray
                                  });
            
          }
          // desopues de guardas los datos en el aarray plush, para  ese array al local tore
          localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));//actualizo el localstore
          cestaCarrito(idProducto.length);// envio el longitud o tamaño de datos 
          subTotalPagar=$('.classPrecionCancion');
          console.log(subTotalPagar);

        

        }
      }

      function cestaCarrito(cantidadProductos){
        //////////////////preguntamoos si hay productos en el carrito/////////////
        if(cantidadProductos!=0){
          console.log("cantidadProductos ",cantidadProductos);
          localStorage.setItem("cantidadCesta",cantidadProductos);
          console.log(localStorage.getItem("cantidadCesta"));
          $(".cart-notification").html(cantidadProductos);
          
        }else{
          console.log("xxxxxx");
        }
      }	


      iniciarTabla();

      function iniciarTabla(){
        var precioUnitarioProducto= $('.classPrecioCancion p span');// de todos los itemns
        console.log(precioUnitarioProducto);// traigo todos los precios unitarios de las canciones
         var arraySumaPrecioProductos=[];
         for (let index = 0; index < precioUnitarioProducto.length; index++) {

            var sumarTotalProductosArray=$(precioUnitarioProducto[index]).html();// obtener el atributo de texto 
            console.log(sumarTotalProductosArray);
            arraySumaPrecioProductos.push(Number(sumarTotalProductosArray));// guardo los precios de las canciones por unidad
            
         }
         console.log(arraySumaPrecioProductos);
      }
      