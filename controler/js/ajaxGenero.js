$(document).ready(function(){


    //=================AGREGAR GENERO=============================//
    //=================AGREGAR GENERO=============================//
    //=================AGREGAR GENERO=============================//

	$('#idFormAddgenero').on('submit',function(e){
        e.preventDefault();
        
		var datos=$(this).serializeArray();
		console.log(datos);
		$.ajax({
			type:$(this).attr('method'),
			data:datos,
			url:$(this).attr('action'),
			dataType:'json',
			success:function(data){
				console.log(data);
				if(data.respuesta==('exito')){
                    console.log("exito");
                    kkMessgae.success('SUCCESS');
                    $('#idInputNombreGenero').val('');

				}else{
					console.log("Ubo un error");
                    kkMessgae.error('ERROR ');
				}
			}
		});
	});



///////////////////////////////////EDITAR BIBLIOTECA/////////////////////////////////////////
///////////////////////////////////EDITAR BIBLIOTECA/////////////////////////////////////////

	$('.editGenero').on('click',function(e){
        e.preventDefault();
        //alert("Xxx");
		// obtnemos los datos del formulario
		var id=$(this).attr('data-id');
		var genero=$(this).attr('data-genero');
        console.log(id);

        $('#idInputNombreGenero').val(genero);
        $('.idGenero').val(id);

        $('#idFormEditgenero').on('submit',function(e){
            e.preventDefault();
            
            var datos=$(this).serializeArray();
            console.log(datos);
            $.ajax({
                type:$(this).attr('method'),
                data:datos,
                url:$(this).attr('action'),
                dataType:'json',
                success:function(data){
                    console.log(data);
                    switch (data.respuesta) {
                        case 'exito':
                            console.log("exito");
							kkMessgae.success('SUCCESS Actulizado');
							kkMessgae.loading('Loading...');
                            
                            setTimeout(function(){ window.location.href  = '../view/admin/listarGenero.php';}, 4000);
                            //window.location='../view/admin/listarGenero.php';
                            break;
                        case 'noExisteCambios': // foo es 0, por lo tanto se cumple la condición y se ejecutara el siguiente bloque
                            console.log("noExisteCambios");
							kkMessgae.warning('WARNING Es el mismo nombre');
							break;
                            // NOTA: el "break" olvidado debería estar aquí
                        case 'error': // No hay sentencia "break" en el 'case 0:', por lo tanto este caso también será ejecutado
                            console.log("error try");
                            kkMessgae.error('ERROR');
                            break; // Al encontrar un "break", no será ejecutado el 'case 2:'
                        default:
                            console.log('default');
                    }
                }
            });
        });

	});


	///////////////////////////////////BORRAR BIBLIOTECA/////////////////////////////////////////
///////////////////////////////////BORRAR BIBLIOTECA/////////////////////////////////////////

	$('.deleteGenero').on('click',function(e){
		e.preventDefault();
		var id=$(this).attr('data-id');
		var genero=$(this).attr('data-genero');
		console.log("ID :"+ id);
		console.log("genero: "+ genero);
		//BOTON DE ALERTA
			swal({
				title: 'Estás seguro en eliminar '+genero,
				text: "No podrass revertir esto!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, Eliminar!'
			  }).then((result) => {
				if (result.value) {
	  
					  $.ajax({
						  type:'post',// si no hay formulario entonces seria por pos
						  data:{
							  //aqui envio los datos al servidor
							  'idGenero':id,
							  'Genero':'delet'
						  },
							  url:'../controler/crtGenero.php',// mando al servidor con la opcion que sea(modelo_proveedor.php)
							  success:function(data){// si el llamado es correcto nos regresa uno datos
							  //console.log(data);// me regresa un string y solo con convierto
							  console.log(data);
							  var resultado=JSON.parse(data);// lo convierto en objeto
							  /*			console.log("EL bojeto ahora el id :"+resultado.id_eliminado);*/
							  if(resultado.respuesta=='exito'){
							  $('[data-id="'+id+'"]').parents('tr').remove();	
	  
							  }else{// si no se puede elimnar presenta este mensaje
								  // presenta eset mensaje si no se elimina de la base de datos
								  swal({
									type: 'error',
									title: 'Oops...',
									text: 'Algo salió mal!',
									footer: '<a href>Why do I have this issue?</a>'
								  })
							  }				
						  }
					  });/// fin ajaxa
				  swal(// si se elimno presenta el mensaje de confirmacion
	  
					'Eliminado!',
					'Tu archivo ha sido eliminado.',
					'success'
				  )
				}
			  })    
				


	});

});// fin document


