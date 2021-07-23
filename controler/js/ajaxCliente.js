// ===============================LOGIN CLIENTE============================
// ===============================LOGIN CLIENTE============================
// ===============================LOGIN CLIENTE============================

$('#login-cliente').on('submit',function(e){
    e.preventDefault();

    animacion();
    // obtnemos los datos del formulario
    var datos=$(this).serializeArray();

    console.log(datos);//imprimr los valores
        $.ajax({
            type:$(this).attr('method'),
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',//json
            success:function(data){
                console.log(data);//el usuario si existe
                if(data.respuesta=='true_password'){
                    $(".smsEsperaLogin").html('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Hola , Bienvenido </h4> Bienvenido '+data.usuario+
                    '</div>');
                  
                    setTimeout(function(){
                        window.location.href='../../adminCliente.php';
                    },2000);//tiempo de espera
                }else{
                    $(".smsEsperaLogin").html('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+data.respuesta+
                    '</div>');
                   
                }
            }
        });

   



});
    ///////////////////////////////REGISTRO CLIENTE/////////////////////////////////////////////////////////////////
    ///////////////////////////////REGISTRO CLIENTE/////////////////////////////////////////////////////////////////
    ///////////////////////////////REGISTRO CLIENTE/////////////////////////////////////////////////////////////////

    $("#registro-cliente").on('submit',function(e){
        e.preventDefault();
        var datosCliente=$(this).serializeArray();
        $(':input[type="submit"]').prop('disabled', true);
        $.ajax({
            type:$(this).attr('method'),
            data:datosCliente,
            url:$(this).attr('action'),
            dataType:'json',//json
            success:function(data){
                console.log(data);
                if(data.respuesta=='exito'){
                    $(".smsEspera").html('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Registro Exitoso </h4> Se ha enviado un correo de verificación para que pueda activar su cuenta, revise su bandeja de entrada '+data.nombre+
                    '</div>');
                }else{
                    $(".smsEspera").html('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Aviso! </h4>'+data.mensaje+
                    '</div>');
                }
                $(':input[type="submit"]').prop('disabled', false);
            }
        });
    });
// ============================EDITAR CLIENTE DESDE EL PANEL DE ADMIN================================//
// ============================EDITAR CLIENTE DESDE EL PANEL DE ADMIN================================//
// ============================EDITAR CLIENTE DESDE EL PANEL DE ADMIN================================//


$('.editCliente').on('click',function(e){
    //console.log("xxxxxx");
    e.preventDefault();
//     var table = $('#example2').DataTable();

    // obtenemos los atrivutos de la etiqueta , en donde se encuentran alojados los datos solo para llenar el formulario
    var id=$(this).attr('data-id');
    var nombre=$(this).attr('data-nombre');
    var apellido=$(this).attr('data-apellido');

 
    // asignamos los datos al formulario
    $('#idRegistroName').val(nombre);
    $('#idRegistroLastName').val(apellido);
    $('.idCliente').val(id);

    //enviamos los datos mediante el metodo Post
    $("#idEditarCliente").on('submit',function(e){
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
                  
                    $(".smsConfirmacion").html('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                    'Datos guardos exitosamente'+
                    '</div>');
                    setTimeout(function(){ 
                        location.reload();             
                    },4000);
                    
                }else{
                    
                    $(".smsConfirmacion").html('<div class="alert alert-danger alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                    'No se puede realizar los Cambios'+
                    '</div>');
                }
            }
        });
    })

});


// ============================EDITAR MONEDERO CLIENTE================================//
// ============================EDITAR MONEDERO CLIENTE================================//
// ============================EDITAR MONEDERO CLIENTE================================//

$('.editClienteMonedero').on('click',function(e){
    e.preventDefault();
//     var table = $('#example2').DataTable();

    // obtenemos los atrivutos de la etiqueta , en donde se encuentran alojados los datos solo para llenar el formulario
    var id=$(this).attr('data-id');
    var nombre=$(this).attr('data-nombre');
    var correo=$(this).attr('data-correo');
    var saldo=$(this).attr('data-saldo');
    var apellido=$(this).attr('data-apellido');
    console.log('id',id);
    console.log('nombre',nombre);
    console.log('correo',correo);
    console.log('saldo',saldo);
    console.log('apellido',apellido);
 
    // asignamos los datos al formulario
    $('#idInputNombreCliente').val(nombre);
    $('#idInputApellidoCliente').val(apellido);
    $('#idInputCorreoCliente').val(correo);
    $('#idInputSaldoAntiguoCliente').val(saldo);

    $("#idFormMonederoCliente").on('submit',function(e){
        e.preventDefault();
        var datos=$(this).serializeArray();
        console.log(datos);
        console.log(datos[0].value);
        //enviamos los datos mediante el metodo Post
        var nuevoMonto=(parseFloat( datos[0].value)+ parseFloat(saldo)).toFixed(2);
        Swal.fire({
            title: 'Are you sure?',
            text: "Se agregara $"+ datos[0].value+ ' al monto actual de $'+saldo+' en total sera $'+nuevoMonto,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:$(this).attr('method'),
                    data:{
                        'nuevoMonto':nuevoMonto,
                        'idCliente':id,
                        'Cliente':'monedero'
                    },
                    url:$(this).attr('action'),
                    dataType:'json',//json/text
                    success:function(data){
                        console.log(data);
                        if(data.respuesta=='exito'){
                          
                            $(".smsConfirmacion").html('<div class="alert alert-success alert-dismissible">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                            'Datos guardos exitosamente'+
                            '</div>');
                            setTimeout(function(){ 
                                location.reload();             
                            },4000);
                            
                        }else{
                            
                            $(".smsConfirmacion").html('<div class="alert alert-danger alert-dismissible">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                            'No se puede realizar los Cambios'+
                            '</div>');
                        }
                    }
                });
            }
          })
   
    })

});
// ============================EDITAR CLIENTE SIN HACER CLICK DIRECTO DESDE EL PANEL DE CLIENTE===============================//
// ============================EDITAR CLIENTE SIN HACER CLICK DIRECTO DESDE EL PANEL DE CLIENTE===============================//
// ============================EDITAR CLIENTE SIN HACER CLICK DIRECTO DESDE EL PANEL DE CLIENTE===============================//

$("#idEditarCliente").on('submit',function(e){
    e.preventDefault();
    
    var datos=$(this).serializeArray();
    console.log(datos);
    $.ajax({
        type:$(this).attr('method'),
        data:datos,
        url:$(this).attr('action'),
        dataType:'json',//json/text
        success:function(data){
            console.log(data);
            if(data.respuesta=='exito'){
              
                $(".smsConfirmacion").html('<div class="alert alert-success alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                'Datos guardos exitosamente'+
                '</div>');
                setTimeout(function(){ 
                    location.reload();             
                },4000);
                
            }else{
                
                $(".smsConfirmacion").html('<div class="alert alert-danger alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                'No se puede realizar los Cambios'+
                '</div>');
            }
        }
    });
})

// ============================RECUPERAR CONTRASEÑA DEL CLIENTE===============================//
// ============================RECUPERAR CONTRASEÑA DEL CLIENTE===============================//
// ============================RECUPERAR CONTRASEÑA DEL CLIENTE===============================//

$("#idFormularioRecuperarPassword").on('submit',function(e){
    e.preventDefault();

    var datos=$(this).serializeArray();
    //console.log(datos);
    $('.smsRecuperacionContraseña').html('<div class="preloader-wrapper active">'+
                                            '<div class="spinner-layer spinner-blue-only">'+
                                                '<div class="circle-clipper left">'+
                                                '<div class="circle"></div>'+
                                                '</div>'+
                                                '<div class="gap-patch">'+
                                                '<div class="circle"></div>'+
                                                '</div>'+
                                                '<div class="circle-clipper right">'+
                                                '<div class="circle"></div>'+
                                                '</div>'+
                                            '</div>'+
                                            '</div>');

    $.ajax({
        type:$(this).attr('method'),
        data:datos,
        url:$(this).attr('action'),
        dataType:'json',//json/text
        success:function(data){
            console.log(data);
            switch (data.respuesta) {
                case 'caracteresNoPermitidos':
                    $('.smsRecuperacionContraseña').html('<div class="alert alert-danger" role="alert">Caracteres no permitidos</div>');
                    break;
                case 'correoNoExiste':
                    $('.smsRecuperacionContraseña').html('<div class="alert alert-warning" role="alert">Este correo no se encuentra registrado</div>');
                    break;
                case 'noSeActualizoPasswordBD':
                    $('.smsRecuperacionContraseña').html('<div class="alert alert-warning" role="alert">No se puede realizar su peticion , intente de nuevo</div>');
                    break;
                case 'noSeActualizoPasswordBD':
                    $('.smsRecuperacionContraseña').html('<div class="alert alert-warning" role="alert">No se puede realizar su peticion , intente de nuevo</div>');
                    break;
                case 'correoNoEnviado':
                    $('.smsRecuperacionContraseña').html('<div class="alert alert-warning" role="alert">No se puede enviar su nueva contraseña a su correo, intente nuevamente</div>');
                    break;
                case 'correoEnviado':
                    $('.smsRecuperacionContraseña').html('<div class="alert alert-success" role="alert">¡ Éxito ! :Se ha enviado su nueva contraseña a su correo, revise su bandeja de entrada o su span</div>');
                    break;

                default:
                    break;
            }
          
        }
    });


});

  // ============================EDITAR PRODUCTO IMG================================//
    // ============================EDITAR PRODUCTO IMG================================//
    // ============================EDITAR PRODUCTO IMG================================//
    $('.editProductoImg').on('click',function(e){
        e.preventDefault();

        // obtener el id del proveedor
        var id=$(this).attr('data-id');
        var inputNameCaratula= $(this).attr('data-name');
    
        console.log(id);
        console.log(inputNameCaratula);

        //asignar el id del proveedor en el formulario de editar Img
        $('.idProducto').val(id);
        $('#idNombreArchivoViejo').val(inputNameCaratula);
        //aqui llenar formulario con post para enviar los datos
        $("#idEditarCaratulaProducto").on('submit',function(e){
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
                        Swal.fire(
                            'Actualizado!',
                            'Se actualizo el archivo.',
                            'success'
                        )
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