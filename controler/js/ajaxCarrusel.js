
    ///////////////////////////////AGREGAR UNA IMG AL SLIDER /////////////////////////////////////////////////////////////////
    ///////////////////////////////AGREGAR UNA IMG AL SLIDER /////////////////////////////////////////////////////////////////
    ///////////////////////////////AGREGAR UNA IMG AL SLIDER /////////////////////////////////////////////////////////////////

    $("#idFormAddImgCarrusel").on('submit',function(e){
        e.preventDefault();
        var datos=new FormData(this);
        $(':input[type="submit"]').prop('disabled', true);
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
                       
                        //console.log(porcentaje);
                        //console.log(porcentaje);
                    }
                }, false);
                
                return xhr;
            },
            contentType:false,
            processData:false,
            async:true,
            cache:false,
            type:$(this).attr('method'),
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',//json
            success:function(data){
                console.log(data);
                if(data.respuesta=='exito'){
                        $(".smsEspera").html('<div class="alert alert-success alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                        '<h4><i class="icon fa fa-warning"></i> Éxito datos guardados '+
                        '</div>');
                    setTimeout(function(){ 
                        location.reload();             
                    },4000);

                }else{
                    $(".smsEspera").html('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Aviso no se puede subir el archivo, intente nuevamente!</h4>'+
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
                    'No se puede subir el archivo, intente nuevamente'+
                    '</div>');
                }
            }
        });
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


})