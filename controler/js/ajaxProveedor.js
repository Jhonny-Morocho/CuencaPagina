

$(document).ready(function(){
console.log("SOY AJAX PROVEEDOR");


//====================AGREGAR PROVEEDOR=========================//
//====================AGREGAR PROVEEDOR=========================//
//====================AGREGAR PROVEEDOR=========================//

$('#idAgregarProveedor').on('submit',function(e){
    e.preventDefault();
    //console.log("Click");
    var datos=new FormData(this);
    for (var pair of datos.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
        $.ajax({
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				// Upload progress.
				xhr.upload.addEventListener("progress", function(evt){
					if (evt.lengthComputable) {
						var porcentaje = Math.floor(evt.loaded / evt.total * 100);

						$(".progress-bar").attr("aria-valuenow", porcentaje);
						$(".progress-bar").css("width", porcentaje + "%");
						$(".sr-only").html(porcentaje + "% Completado");
						$(".porcentaje_h4").html(porcentaje + "% Completado");
						console.log(porcentaje);
						console.log(porcentaje);
					}
				}, false);
				
				return xhr;
			},
			type:"post",
			data:datos,
			url:$(this).attr('action'),
			dataType:'json',
			// datos asicionales
			contentType:false,
			processData:false,
			async:true,
			cache:false,
			success:function(data){
				/*console.log(data);*/
				var resultado=data;
				console.log("Este es la data "+data);
				console.log("Resultado "+resultado.respuesta);
				/*console.log("Resultado "+resultado.post);*/
				/*console.log("Resultado "+resultado.file);*/

				/////////////////AGREGO ANIMACION DE CARGA///////////////////////
                switch (data.respuesta) {
                    case 'existeArchivo':
                        kkMessgae.warning('Ya existe Archivo Imagen con el mismo nombre');
                      break;
                      
                    case 'exitoRegistroBd':
                        kkMessgae.success('Registro Guardado Exitosamente');
                        $('#idInputNomProveedor').val('');
                        $('#idInputApeliidoProveedor').val('');
                        $('#idInputPseudoNombreProve').val('');
                        $('#idInputCorreo').val('');
                        $('#idInputPassword').val('');
                        $('#files').val('');

                        $(".progress-bar").css("width", "0" + "%");
                        $(".porcentaje_h4").html('0' + "% Completado");
                        //borramos los campos 
                        $('.thumb').remove();
                            break;

                    case 'correo_repetido':
                        kkMessgae.warning('Ya existe un Proveedor con el mismo correo');
                            break;
                    default:
                        kkMessgae.error('Error al guardar');
                    break;
                }
				///////////////////remover nodo////////////////
				if(resultado.respuesta=='exito'){
			
				}else{
				
                }
        	}
		});
            


});

/*------------------------LOGIN PROVEEDOR-----------------------*/
/*------------------------LOGIN PROVEEDOR-----------------------*/
/*------------------------LOGIN PROVEEDOR-----------------------*/
/*------------------------LOGIN PROVEEDOR-----------------------*/

$('#login-proveedor').on('submit',function(e){
e.preventDefault();



console.log("Click en el login");

var datos=$(this).serializeArray();
console.log(datos);//imprimr los valores
console.log("Este es el correo",datos[0].value);
var correo_validar=datos[0].value;




if(validar_email(correo_validar)==true){
    /////////////SI EL CORREO ES CORRECTO DEJAR ACCEDER
        $.ajax({
            type:$(this).attr('method'),
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',//json

            success:function(data){
                console.log(data);//el usuario si existe
                var resultado_login=data;
                console.log(resultado_login.respuesta);
                if(resultado_login.respuesta=='true_password'){
                    swal(
                        'Hola:  '+resultado_login.usuario,
                        'Bienvenido a ProEditsClub.com ! ',
                        'success'
                        )
                    setTimeout(function(){
                        window.location.href='../Vista/admin/index_admin.php';
                    },2000);//tiempo de espera
                }else{
                    swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Revisa Tu Contraseña o tu Correo!',
                    footer: '<a href>Ingresastes correctamente lo datos?</a>'
                    })
                }
            }
        });

}else{
////////////////////CORREO FALSO NO DEJAR ENTRAR//////////////
////////////////////CORREO FALSO NO DEJAR ENTRAR//////////////
////////////////////CORREO FALSO NO DEJAR ENTRAR//////////////
swal({
type: 'error',
title: 'Oops...',
text: 'Intenta de nuevo!',
footer: '<a href>Verifica que todos los campos esten con check</a>'
})

}
  



});


/*---------------------EDITAR PROVEEDOR----------------------*/
/*---------------------EDITAR PROVEEDOR----------------------*/
/*---------------------EDITAR PROVEEDOR----------------------*/
/*---------------------EDITAR PROVEEDOR----------------------*/




$('#id_editar_proveedor').on('submit',function(e){
    e.preventDefault();
    //document.forms["editar_proveedor"].submit();
   
    console.log("Click en editar proveeedor");
    // obtnemos los datos del formulario
    var datos=$(this).serializeArray();
    console.log(datos);

        $.ajax({
            type:$(this).attr('method'),
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',//json
            success:function(data){
                console.log(data);
                var password="";
                if(data.password=='true'){
                    password="El password se actulizo";
                }else{
                    password="El password sigue siendo el actual";
                    
                }

                if(data.respuesta=='exito'){
                    swal(
                          'Registro Exitoso! <br>Nombre: '+data.nombre+" <br>Apellido :"+data.apellido+" <br> Password: "+password+" <br> Apodo: "+data.apodo,
                          'Correo ! '+data.correo +' <br> Imagen: '+data.img,
                          'success'
                        )
                }else{
                    console.log("No se actualizo el registro");
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Revise bien los datos ingresado!',
                      footer: '<a href>Ingresastes correctamente lo datos?</a>'
                    })
                }
            }
        });

});

// ================================Eliminar Proveedor===============================
// ================================Eliminar Proveedor===============================
// ================================Eliminar Proveedor===============================

$('.borrar_registro_proveedor').on('click',function(e){
e.preventDefault();// es para q cuando haga click no brinque 

var id=$(this).attr('data-id');
var apodo=$(this).attr('data-apodo');
var tipo=$(this).attr('data-tipo');// pueden venir n tipo de dara tipo
console.log("ID :"+ id);
console.log("Tipo: "+ tipo);
//BOTON DE ALERTA
    swal({
        title: 'Estás seguro que desea Eliminar a :<br>  '+apodo,
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
                      'id':id,
                      'proveedor':'eliminar'

                  },
                      url:'../Vista/admin/agregar_editar_ajax.php',// mando al servidor con la opcion que sea(modelo_proveedor.php)
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


function validar_email( email ){
var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
return regex.test(email) ? true : false;
}

});// fin document