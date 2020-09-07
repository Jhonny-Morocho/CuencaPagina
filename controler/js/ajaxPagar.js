//enviamos los datos al controlador de pagos para coprobar si existe una session 
// $.ajax({
// 	method: "POST",
// 	url: "../../Controlador/class_ctr_Oferta.php",
// 	dataType: "json",

// });7
//==== submit en pagar , traemos los datos de la tabla productos
var arrayNombreProducto=[];
var arrayPrecioProducto=[];
var arrayIdProducto=[];
var datos=new FormData();
var data_type="json";
var urlPasarelaPago="../../Paypal/ctrPasarelaPago.php";

$("#idFormCarrito").on('submit',function(e){
    
    e.preventDefault();
    //debo borrar el formulario del cupon para que me deje ejecutar el pago
    $('.BtnaplicarCupon').remove();
    $('.cuponDescuento').remove();
    
    var inputOptionPago=$(this).serializeArray();//obtengo valores de radios
    //console.log(inputOptionPago);
    //selecionodo todos los datos de la tabla
    var classNombreProducto=$(".classNomProducto");
    var classPrecioUnitarioProducto=$(".classPrecioCancion span");
    var classIdProducto=$(".btnCarrito");
    var classTotalCancelar=$(".total-amount span").text();//total q sale en la pagina de carrito color verde


    // filtrando datos de los nodos para guardos los valores en cada array
    for(var i=0;i< classNombreProducto.length;i++){
        arrayNombreProducto[i]=$(classNombreProducto[i]).text();
        arrayPrecioProducto[i]=$(classPrecioUnitarioProducto[i]).text();
        arrayIdProducto[i]=$(classIdProducto[i]).attr("data-id-Producto");
    }

    // creamos y  guardamos en un array data , todos los datos de los 3 array
    datos.append("idProducto",arrayIdProducto);//adicionamo cada valor por q es un objeto
    datos.append("nombreProducto",arrayNombreProducto);
    datos.append("precioUnitarioProducto",arrayPrecioProducto);
    datos.append("optionPago",inputOptionPago);
    datos.append("nameRadio",inputOptionPago[0].name);
    datos.append("valueRadio",inputOptionPago[0].value);
    datos.append("totalCancelar",classTotalCancelar);
   
    enviarDatosPasarelaPago(datos);//enviaar Data a la pasarela de pagos
    //  for (var pair of datos.entries()) {
    //      console.log(pair[0]+ ', ' + pair[1]); 
    //  }

});


function enviarDatosPasarelaPago(datos){
    console.log(datos);
    animacion();
    $.ajax({

        url:urlPasarelaPago,
        method:'post',
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        dataType:data_type,//json//data_type
        success:function(data){
            console.log(data);

            switch (data.respuesta) {
                case 'noExiseLogin':
                    //no exites session
                        bootoast.toast({
                            message: '¡ Para realizar la compra debes iniciar sesion !',
                            type: 'warning',
                        });
                    break;

                case 'exito':
                        bootoast.toast({
                            message: 'Tu solicitud ha sido  procesada ',
                            type: 'success'
                        });
                      
                        setTimeout(function(){
                            window.location.href=data.urlPaypal;
                        },2000);//tiempo de espera
                        break;
                default:
                    break;
            }
        }
    });
}

