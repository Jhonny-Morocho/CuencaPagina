
    ///////////////////////////////AGREGAR LOGO DJS /////////////////////////////////////////////////////////////////
    ///////////////////////////////AGREGAR LOGO DJS /////////////////////////////////////////////////////////////////
    ///////////////////////////////AGREGAR LOGO DJS /////////////////////////////////////////////////////////////////

    $("#idFormAddImgLogosDjs").on('submit',function(e){
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
// ============================EDITAR IMG CARRUSEL ================================//
// ============================EDITAR IMG CARRUSEL ================================//
// ============================EDITAR IMG CARRUSEL ================================//


$(".editarLogoDj").on('click',function(e){
    e.preventDefault();
    //obtengo el id y lo escribo en el formulacio
    var idCarrusel=$(this).attr('data-id');
    var nombreArchivo=$(this).attr('data-nombreViejo');
    $('#idImgCarrsuel').val(idCarrusel);
    $('#nombreArchivoViejo').val(nombreArchivo);
    //console.log(idCarrusel);
    //aqui llenar formulario con post para enviar los datos
    $("#idFormEditarImgCarrusel").on('submit',function(e){
        var datos=new FormData(this);
        $(':input[type="submit"]').prop('disabled', true);
        e.preventDefault();
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


    
});


// ============================BOORAR IMG CARRUSEL ================================//
// ============================BOORAR IMG CARRUSEL ================================//
// ============================BOORAR IMG CARRUSEL ================================//

$(".elimarLogoDj").on('click',function(e){
    e.preventDefault();
    //obtengo el id y lo escribo en el formulacio
    var idCarrusel=$(this).attr('data-id');
    var nombreArchivo=$(this).attr('data-nombreViejo');
    $('#idImgCarrsuel').val(idCarrusel);
    $('#nombreArchivoViejo').val(nombreArchivo);
    console.log(idCarrusel);
    //aqui llenar formulario con post para enviar los datos


    e.preventDefault();
    swal.fire({
        title: 'Estás seguro en eliminar?',
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
                        'id':idCarrusel,
                        'nombreArchivo':nombreArchivo,
                        'LogosDjs':'eliminarLogoDj'

                    },
                        url:'../controler/ctrLogosDjs.php',// mando al servidor con la opcion que sea(modelo_proveedor.php)
                        success:function(data){// si el llamado es correcto nos regresa uno datos
                        //console.log(data);// me regresa un string y solo con convierto
                        console.log(data);
                        var resultado=JSON.parse(data);// lo convierto en objeto
                        /*			console.log("EL bojeto ahora el id :"+resultado.id_eliminado);*/
                        if(resultado.respuesta=='exito'){
                        $('[data-id="'+idCarrusel+'"]').parents('.padreCarrusel').remove();	
                            Swal.fire(
                                'Registro Borrado',
                                'Your file has been deleted.',
                                'success'
                            )

                        }else{// si no se puede elimnar presenta este mensaje
                            // presenta eset mensaje si no se elimina de la base de datos
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href>Why do I have this issue?</a>'
                            })
                        }				
                    }
                });/// fin ajax
        }
    });
});