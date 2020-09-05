
//$(document).ready(function(){
        //localStorage.clear();
        //inicia el sistema  en car.php se imprime los datoscargando los datos del local store y definiendo la variables listaCarrito
        var  listaCarrito,precioUnitarioProducto;

        iniciarTabla();// tabla del carrito de compras
        // produce un error por que cuando voy al index de productos no hay los span del total por lo tanto controlo ese erro
        try {
          sumarProducto();
        } catch (error) {
          //console.log(error);
        }
      
        function iniciarTabla(){
          if(localStorage.getItem("listProduct")!=null){
            listaCarrito=JSON.parse(localStorage.getItem("listProduct"));// obtengo todos los items del local sotarage
            //console.log(listaCarrito);
            $(".cart-notification").html(listaCarrito.length);//
            listaCarrito.forEach(ForEachImprimirdProductoTableCar);
            
          }else{//si esta vacio el localSotarge mosntrar mensaje no exiten productos
            $(".cart-table").after('<div class="alert alert-warning carritoVacio" role="alert">'+
            'Your cart is empty</div>');
            //escondo el total casillero
            $(".cart-calculator-wrapper").hide();
            $(".opcionPago").hide();
            $('.BtnaplicarCupon').hide();
            $('.cuponDescuento').hide();
          }
        }

        function ForEachImprimirdProductoTableCar(item,index){// imprimir datos en la tabla de car.php
        $(".dataProductos").append(
    
            '<tr>'+'<td>'+(index+1)+'</td>'+
            
            '<TD  class="classNomProducto" nombre_cancion='+item.nombreProducto+'><p>'+item.nombreProducto+'</p</TD>'+
            '<TD class="classPrecioCancion"><p>$<span>'+item.precio+'</span></p></TD>'+
            ' <TD>'+
                '<i  class="fa fa-trash deleItemCar btnCarrito"  aria-hidden="true"  data-precioCancion='+item.precio+' data-id-Producto='
                +item.idProducto+'></i>'
            +'</TD>'+
            '</tr>'
          );

          
      }

      
      function sumarProducto(){
        var nodosPrecio,arrayPrecioProduct=[],nodoPrecioProduc,sumaTotal;
        nodosPrecio=$('.classPrecioCancion p span');
       
         for (let index = 0; index < nodosPrecio.length; index++) {
           //console.log(Number(nodosPrecio[index].innerText));
           nodoPrecioProduc=nodosPrecio[index].innerText;
           arrayPrecioProduct.push(Number(nodoPrecioProduc));//guardo el valor de cada producto precio
          
         }
        // obtengo la suma de los productos
     
        
        function sumaArraySubtotal(total,numero){//recibe dos parametros por default
          return total+numero;
        } 
        sumaTotal=arrayPrecioProduct.reduce(sumaArraySubtotal);//ete metodo sirve suma los valores entre sii
        
        $(".SpanTotalPagar").html(sumaTotal.toFixed(2));
        // sumo los valores guardados en el array
      }

      // ========================añadir productos al carrito================================//
      // ========================añadir productos al carrito================================//
      $('.buy').on('click',function(e){// 
        e.preventDefault();// 
     
        //1.//Añadir al carrito
        var idProducto=$(this).attr("data-id");
        var nombreProducto=$(this).attr("data-nombre");
        var precio=$(this).attr("data-precio");
       //notificacion se agrego producto
        bootoast.toast({
          message: 'Se agrego '+nombreProducto,
          type: 'success'
        });
       //si no tiene datos en local store , encones inicializo el array
       //console.log(localStorage.getItem("listProduct"));
       (localStorage.getItem("listProduct")==null)? listaCarrito=[]: listaCarrito.concat(localStorage.getItem("listProduct"));
        //console.log("listaCarrito",listaCarrito);
        listaCarrito.push({"idProducto"     :idProducto,
							"nombreProducto":nombreProducto,
							"precio"        :precio});
        //pinta items en el carrito de compras
        $(".cart-notification").html(listaCarrito.length);
        //guardo esos datos en el localstorage
        localStorage.setItem("listProduct",JSON.stringify(listaCarrito));//asignamos en el localSotre el itemn listarProductos con el dato q tiene el array
        //console.log(localStorage.getItem);
        //contar la cantidad de producots en la cesta
        var cantidadCesta= Number($(".cart-notification").html());//traigo lo q tiene la cesta
        //console.log(cantidadCesta);
			  // agrego una nueva variable para saber cuantos productos tengo en el localstore y la suma=========//
        var canridadCesta= Number($(".cart-notification").html());//traigo lo q tiene la cesta
        //console.log(cantidadCesta);
      });


      //===================borrar producto carrito=====================
      $(".deleItemCar").on('click',function(e){
        e.preventDefault();
        $(this).parent().parent().remove();//quitamos visualmente
        funcionRecorrerItemBorrar();
        //pintar cantidad de productos en el cesta
        $(".cart-notification").html(localStorage.getItem("cantidadCesta"));//no se que es
        //window.location.href = "../carrito_compras.php";
      });

//});

      //
      function funcionRecorrerItemBorrar(){
        var idProducto=$(".btnCarrito");//caputuramos todos el botones
        var classNombreProducto=$(".classNomProducto");//todos los nodos
        listaCarrito=[];// si ahun quedan productos actualizo el array
        var idProductoArray,nombreProductoArray,precioProductoArray,subTotalPagar;
        //console.log(idProducto.length);
        if(idProducto.length!=0){
          for (let index = 0; index < idProducto.length; index++) {
            //console.log(index);
            idProductoArray=$(idProducto[index]).attr("data-id-Producto");
            nombreProductoArray=$(classNombreProducto[index]).text();//obtengo nombre cancion
            precioProductoArray=$(idProducto[index]).attr("data-precioCancion");
            listaCarrito.push({"idProducto":idProductoArray,
                                "nombreProducto":nombreProductoArray,
                                "precio":precioProductoArray
                                  });
            
          }
          // desopues de guardas los datos en el aarray push, pasamos eso datos del array al local store
          //console.log(listaCarrito);
          localStorage.setItem("listProduct",JSON.stringify(listaCarrito));//actualizo el localstore
          cestaCarrito(idProducto.length);// envio el longitud o tamaño de datos para que se visualice en la cesta
          //impprimo precio
         sumarProducto();
          // subTotalPagar=$('.classPrecionCancion');
          // console.log(subTotalPagar);
          // console.log(localStorage.getItem("listProduct"));
        }else{
          localStorage.removeItem("listProduct");
          localStorage.setItem("cantidadCesta","0");
          iniciarTabla();
        }
      }

      function cestaCarrito(cantidadProductos){
        //////////////////preguntamoos si hay productos en el carrito/////////////
        if(cantidadProductos!=0){
          //console.log("cantidadProductos ",cantidadProductos);
          localStorage.setItem("cantidadCesta",cantidadProductos);
          //console.log(localStorage.getItem("cantidadCesta"));
          $(".cart-notification").html(cantidadProductos);
          
        }else{
          console.log("xxxxxx");
        }
      }	


      // ============================ CUPON DE DESCUENTO=======================
      var cuponDescuento=false;
      var nombreCupon="";
      var nuevoTotal=[];// suma de los valores
      var consumo=0;//consumo para aplicar cupon
      var ofertaActiva=false;
      var fechaExpiracion="";
      var porcentajeDescuento=0;
      //==desde la base de datos traemos los datos del cupon de descuento
      $.ajax({
        method: "POST",
        url: "../../controler/ctrCupon.php",
        dataType: "json",
        data: { Cupon: "listar"},
        success:function(respuesta){
          //console.log(respuesta[0].fechaExpiracion);
          nombreCupon=respuesta[0].nombreCupon;
          consumo=respuesta[0].consumo;
          fechaExpiracion=respuesta[0].fechaExpiracion;
          porcentajeDescuento=Number((respuesta[0].descuento)/100);
          console.log(porcentajeDescuento);
          if(moment(fechaExpiracion)> moment.now()){
            ofertaActiva=true;
          }else{
            ofertaActiva=false;
          }
          
        }
      });
   
     //console.log( moment(fechaExpiracion)> moment.now() ); //Regresa un boolean

      $('.BtnaplicarCupon').on('click',function(e){
        e.preventDefault();
        var inputCupon=$('.inputCupon').val();//obtengo valores de radios

        //========Tipo de oferta mediante ajax preguntar q oferta esta activa
 
        //console.log(inputCupon);
        //console.log(nombreCupon);

        if(inputCupon==nombreCupon && ofertaActiva==true && Number($(".total-amount span").text()) >=consumo ){
          $('.BtnaplicarCupon').hide();
          $('.cuponDescuento').hide();
            bootoast.toast({
              message: 'Descuento efectuado exitosamente ',
              type: 'success'
            });
            //console.log(localStorage.getItem("listProduct"));
            var descuentoLocalSotorage=JSON.parse(localStorage.getItem("listProduct"));
            //console.log(descuentoLocalSotorage);
            //

            $(".dataProductos TR").remove();//remover los datos atenriroes
          
            descuentoLocalSotorage.forEach(functionDescuento);
        
            //$(".SpanTotalPagar").html(nuevaSumaDescuento);
              
          function nuevaSumaDescuento(total,numero){//recibe dos parametros por default
            return total+numero;
          } 
          var sumaDescuentoTotal=nuevoTotal.reduce(nuevaSumaDescuento);//ete metodo sirve suma los valores entre sii
          console.log(sumaDescuentoTotal.toFixed(2));

          $(".SpanTotalPagar").html(sumaDescuentoTotal.toFixed(2));
          //vacio el array
          sumaDescuentoTotal=0;
          nuevoTotal=[];
          
        }else{

            if(inputCupon!=nombreCupon || ofertaActiva==false){
              //alert("Cupon no valido , el cupon actual es "+nombreCupon+ " y expira el "+fechaExpiracion);
              bootoast.toast({
                message:"Cupon no valido , el cupon actual es "+nombreCupon+ " y expira el "+fechaExpiracion,
                type: 'warning',
                animationDuration: 1000
              });
            }
            
            if(Number($(".total-amount span").text()) <=consumo){
              //alert("Tu compra debe ser mayor " +consumo + " para aplicar el cupon");
              bootoast.toast({
                message:"Tu compra debe ser mayor $ " +consumo + " para aplicar el cupon",
                type: 'warning',
                animationDuration: 1000
              });
            }

            
        }
      })


      function functionDescuento(item,index){
        
        $(".dataProductos").append(
    
          '<tr>'+'<td>'+(index+1)+'</td>'+
          
          '<TD  class="classNomProducto" nombre_cancion='+item.nombreProducto+'><p>'+item.nombreProducto+'</p</TD>'+
          '<TD class="classPrecioCancion colorDescuento"><p>$<span>'+(item.precio-((item.precio)*porcentajeDescuento)).toFixed(2)+'</span></p></TD>'+
          ' <TD>'+
              '<i  class="fa fa-trash deleItemCar btnCarrito disabledItemCupon"  aria-hidden="true"  data-precioCancion='+(item.precio-((item.precio)*porcentajeDescuento)).toFixed(2)+' data-id-Producto='
              +item.idProducto+'></i>'
          +'</TD>'+
          '</tr>'
        );
        //nuevaSumaDescuento(Number(item.precio*0.50).toFixed(2));
         nuevoTotal.push(item.precio-((item.precio)*porcentajeDescuento)).toFixed(2);
       // nuevoTotal=(item.precio*0.50).toFixed(2)+nuevoTotal;
      }

