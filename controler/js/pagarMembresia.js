
var urlControlerPaypal="../../Paypal/ctrPasarelaPago.php";
var data_type="json";
var membresia;

$(".pricing-action").on('click',function(e){
    e.preventDefault();

	var precio=$(this).attr("data-precio");
	var tipo=$(this).attr("data-tipo");
    var numDescargas=$(this).attr("data-numDescargas");
	var idMembresia=$(this).attr("data-id");
	
	//envio de esta forma con la finalidad de q se adapte a la otra configurion
    membresia = {   'idProducto':idMembresia,
                    'nombreProducto':tipo,
                    'numDescargas':numDescargas,
                    'totalCancelar':precio,
                    'precioUnitarioProducto':precio,
                    'valueRadio':'membresia'
                };

    //1. Pregunta si la membresia q hizo clik es la q el desea

	Swal.fire({
		title:" Tu has seleccionado  "+tipo ,
		text: "Confirme para realizar el pago",
		type: 'warning',
		 	showCancelButton: true,
		 	confirmButtonColor: '#3085d6',
		 	cancelButtonColor: '#d33',
		 	confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value) {
				animacion();
				prepararDatosApiPaypal();//controles
		 	}
		 })
});



function prepararDatosApiPaypal(){// controlar que no compre una nueva membresia mientras no haya terminado la actual

   // window.location=urlControlerPaypal;

	$.ajax({
		type:'post',
        data:membresia,
		url:urlControlerPaypal,
		success:function(data){
			console.log(data);
			var resultado=JSON.parse(data);// si da un error pre es q esta mal la respuesta del host
			console.log(resultado.respuesta);

				 switch (resultado.respuesta) {
				 	case 'exito':
						 toastr.success('solicitud aceptada');
						 Swal.fire(
							 'Solicitud Aceptada',
							 'Un momento porfavor..',
							 'success'
						   )
							 window.location=resultado.urlPaypal;
				 		break;
					case 'noExiseLogin':
					
						toastr.warning('Debe iniciar su sesión ');
						break;
					default:
						toastr.danger('Error al ejecutar la petición');
						break;
				 }
			
		}

	});
}


// $(".xxx").hover(function() {
// 	console.log('xxx');
// 	$('.xxx').addClass('animated pulse');
//   });