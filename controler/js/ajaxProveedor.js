

$(document).ready(function(){



//====================AGREGAR PROVEEDOR=========================//
//====================AGREGAR PROVEEDOR=========================//
//====================AGREGAR PROVEEDOR=========================//

$('#idAgregarProveedor').on('submit',function(e){
    e.preventDefault();
    // mostramos un mensaje de espera
    $(".smsEspera").html('<div class="alert alert-info alert-dismissible ">'+
    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
    '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
    'Espere por favor....'+
    '</div>');
    
    
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
                $(".smsEspera").html('<div class="alert alert-success alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                'Datos guardos exitosamente'+
                '</div>');
				/////////////////AGREGO ANIMACION DE CARGA///////////////////////
                switch (data.respuesta) {
                    case 'existeArchivo':
                        $(".smsEspera").html('<div class="alert alert-warning alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                        '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                        'Ya existe Archivo Imagen con el mismo nombre'+
                        '</div>');
                        
                      break;
                      
                    case 'exitoRegistroBd':

                        $(".smsEspera").html('<div class="alert alert-success alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                        '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                        'Datos guardos exitosamente'+
                        '</div>');

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
                        
                        $(".smsEspera").html('<div class="alert alert-warning alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                        '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                        'Ya existe un Proveedor con el mismo correo'+
                        '</div>');

                        $(".progress-bar").css("width", "0" + "%");
                        $(".porcentaje_h4").html('0' + "% Completado");
                            break;
                    default:
                         $(".smsEspera").html('<div class="alert alert-danger alert-dismissible">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                            'Error al guardar'+
                            '</div>');
                    break;
                }
        	}
		});
            


});



///////////////////////////////////   LOGIN   ADMIN//////////////////////////////////////////////////////////
///////////////////////////////////   LOGIN   ADMIN//////////////////////////////////////////////////////////
///////////////////////////////////   LOGIN   ADMIN//////////////////////////////////////////////////////////
///////////////////////////////////   LOGIN   ADMIN//////////////////////////////////////////////////////////



$('#login-admin').on('submit',function(e){
    e.preventDefault();

    animacion();
    // obtnemos los datos del formulario
    var datos=$(this).serializeArray();

    console.log(datos);//imprimr los valores

    // console.log("bandera_correo",bandera_correo);
    // console.log("bandera_password_login",bandera_password_login);


        $.ajax({
            type:$(this).attr('method'),
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',//json

            success:function(data){
                console.log(data);//el usuario si existe
                if(data.respuesta=='true_password'){
                    $(".alertConfirmacion").html( 
                        '<div class="alert  alert-success alert-dismissible fade show" role="alert">  <strong> Bienvenido  </strong>'+
                        data.usuario+
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                            '</button>'+
                        '</div>');
                  
                    setTimeout(function(){
                        window.location.href='../../view/admin/index_admin.php';
                    },2000);//tiempo de espera
                }else{
                    $(".alertConfirmacion").html( 
                                                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                                                    data.respuesta+
                                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                                            '<span aria-hidden="true">&times;</span>'+
                                                        '</button>'+
                                                    '</div>');
                   
                }
            }
        });

   



});

// ============================EDITAR PROVEEDOR IMG================================//
// ============================EDITAR PROVEEDOR IMG================================//
// ============================EDITAR PROVEEDOR IMG================================//
$('.editProveedorImg').on('click',function(e){
    e.preventDefault();

    // obtener el id del proveedor
    var id=$(this).attr('data-id');
 
    console.log(id);

    //asignar el id del proveedor en el formulario de editar Img
    $('.idProveedor').val(id);
  

    //aqui llenar formulario con post para enviar los datos
    $("#idEditarProveedorImg").on('submit',function(e){
        e.preventDefault();
        //es importate trabajar con FormData , es utilizado para archivos
        var datos=new FormData(this);
        for (var pair of datos.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        console.log(datos);
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
            type:'post',
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',//json
            // datos asicionales
			 contentType:false,
			 processData:false,
			 async:true,
			 cache:false,
            success:function(data){
                console.log(data);
                if(data.respuesta=='exito'){
                    kkMessgae.success('Registro Actualizado Exitosamente');
                    kkMessgae.loading('Loading...');
                    setTimeout(function(){ 
                        location.reload();             
                    },4000);
                }else{
                    
                    kkMessgae.error('Error al actulizar');
                }
            }
        });

    });
        
});
// ============================EDITAR PROVEEDOR DATOS================================//
// ============================EDITAR PROVEEDOR DATOS================================//
// ============================EDITAR PROVEEDOR DATOS================================//



$('.editProveedor').on('click',function(e){
    e.preventDefault();
    // obtenemos los atrivutos de la etiqueta , en donde se encuentran alojados los datos solo para llenar el formulario
    var id=$(this).attr('data-id');
    var nombre=$(this).attr('data-nombre');
    var apellido=$(this).attr('data-apellido');
    var apodo=$(this).attr('data-apodo');
    var correo=$(this).attr('data-correo');

 
    // asignamos los datos al formulario
    $('#idInputNomProveedor').val(nombre);
    $('#idInputApeliidoProveedor').val(apellido);
    $('#idInputPseudoNombreProve').val(apodo);
    $('#idInputCorreo').val(correo);
    $('.idProveedor').val(id);
    console.log();
    
    //enviamos los datos mediante el metodo Post
    $("#idEditarProveedor").on('submit',function(e){
        e.preventDefault();
        var datos=$(this).serializeArray();
        $.ajax({
            type:$(this).attr('method'),
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',//json/text
            success:function(data){
                console.log(data);
                if(data.respuesta=='exito'){
                    kkMessgae.success('Registro Actualizado Exitosamente');
                    kkMessgae.loading('Loading...');
                    setTimeout(function(){ 
                        location.reload();             
                    },4000);
                }else{
                    
                    kkMessgae.error('Error al actulizar');
                }
            }
        });
    })

});

// ================================Eliminar Proveedor===============================
// ================================Eliminar Proveedor===============================
// ================================Eliminar Proveedor===============================

$('.deletProveedor').on('click',function(e){
e.preventDefault();// es para q cuando haga click no brinque 

var id=$(this).attr('data-id');
var apodo=$(this).attr('data-apodo');
var img=$(this).attr('data-img');
console.log("ID :"+ id);
//BOTON DE ALERTA
    swal({
        title: 'Estás seguro en eliminar a   '+apodo,
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
                      'img':img,
                      'Proveedor':'eliminarProveedor'

                  },
                      url:'../controler/ctrProveedor.php',// mando al servidor con la opcion que sea(modelo_proveedor.php)
                      success:function(data){// si el llamado es correcto nos regresa uno datos
                      //console.log(data);// me regresa un string y solo con convierto
                      console.log(data);
                      var resultado=JSON.parse(data);// lo convierto en objeto
                      /*			console.log("EL bojeto ahora el id :"+resultado.id_eliminado);*/
                      if(resultado.respuesta=='exito'){
                      $('[data-id="'+id+'"]').parents('tr').remove();	

                      }else{// si no se puede elimnar presenta este mensaje
                          // presenta eset mensaje si no se elimina de la base de datos
                          kkMessgae.error('Error al actulizar');
                      }				
                  }
              });/// fin ajaxa
            kkMessgae.success('Registro Eliminado Exitosamente');
        }
      })        
    
});



});// fin document