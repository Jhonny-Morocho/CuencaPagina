

    
 $(".contenedorInicial").hide();
 $('.preloader-wrapper').addClass('active');   
//reviso si existe data en e local sotaree// conrolo que solo se metodo de paypal , por el momneto
if(localStorage.getItem("metodoPago")=='PayPal' || localStorage.getItem("metodoPago")=='Tarjeta'){
  
    //alert("GRACIAS POR TU COMPRA");
    var  urlNotificarCompra="../../controler/controlerCorreoFactura.php";
    datos.append("nombre",localStorage.getItem("nombre"));
    datos.append("apellido",localStorage.getItem("apellido"));
    datos.append("correo",localStorage.getItem("correo"));
    datos.append("direccion",localStorage.getItem("direccion"));
    datos.append("telefono",localStorage.getItem("telefono"));
    datos.append("documentoIdentidad",localStorage.getItem("documentoIdentidad"));
    datos.append("metodoPago",localStorage.getItem("metodoPago"));
    
    //obtenemos los productos del local storage y los convierto en objeto
    const productos=JSON.parse( localStorage.getItem('listProduct'));
    
    //seoparo los datos en diferentes arrays
    var arrayNombreProducto=[];
    var arrayPrecioProducto=[];
    var arrayIdProducto=[]; 
    
    let claves = Object.keys(productos); 
    for(let i=0; i< claves.length; i++){
      let clave = claves[i];
      arrayIdProducto.push(productos[clave]['idProducto']);
      arrayNombreProducto.push(productos[clave]['nombreProducto']);
      arrayPrecioProducto.push(productos[clave]['precio']);
    }
    
    //preparamos los datos separados 
    datos.append("idProducto",arrayIdProducto);
    datos.append("nombreProducto",arrayNombreProducto);
    datos.append("precio",arrayPrecioProducto);
     $.ajax({
         url:urlNotificarCompra,
         method:'post',
         data:datos,
         cache:false,
         contentType:false,
         processData:false,
         dataType:'text',//json//data_type
         success:function(data){
             console.log(data);
    //         localStorage.getItem('nombre');
              //borramos el local storage
              $('.preloader-wrapper').removeClass('active');

              $(".contenedorInicial").show();
              localStorage.clear();

        }
     });

  }else{
// //     //borro el carrito de todas formas
      localStorage.clear();
      $('.preloader-wrapper').removeClass('active');
      $(".contenedorInicial").show();
 }