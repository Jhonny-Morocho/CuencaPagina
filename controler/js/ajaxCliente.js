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

        console.log("soy tu formulario registro cliente");

        var datosCliente=$(this).serializeArray();

        console.log("datos_formulaio",datosCliente);
        animacion();
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
                        '<h4><i class="icon fa fa-warning"></i> Registro Exitoso </h4> Bienvenido '+data.nombre+
                        '</div>');

                    setTimeout(function(){
                        window.location.href='../../adminCliente.php';
                    },2000);//tiempo de espera


                }else{
                    $(".smsEspera").html('<div class="alert alert-warning alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+data.mensaje+
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