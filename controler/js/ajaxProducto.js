

$(document).ready(function(){
   

    //====================AGREGAR PRODUCTO=========================//
    //====================AGREGAR PRODUCTO=========================//
    //====================AGREGAR PRODUCTO=========================//

  $('#idAgregarProducto').on('submit',function(e){
      e.preventDefault();
      var datos=new FormData(this);
      // una vez q aplastan subnit se desactiva el boton de enviar para controlar 

      // mostramos un mensaje de espera
      $(".smsEspera").html('<div class="alert alert-info alert-dismissible ">'+
      '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
      '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
      'Espere por favor....'+
      '</div>');
    
  
      $(':input[type="submit"]').prop('disabled', true);
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
                    console.log(data);
                    var resultado=data;
                    $('#content').fadeIn(1000).html(data);
                    console.log("Este es la data "+data);
                    console.log("Resultado "+resultado.respuesta);
                    /*console.log("Resultado "+resultado.post);*/
                    /*console.log("Resultado "+resultado.file);*/
                    //animacion();

                    $(".smsEspera").html('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                    '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                    'Datos guardos exitosamente'+
                    '</div>');
    
                    /////////////////AGREGO SMS DE CONFIRMACION///////////////////////
                    switch (data.respuesta) {
                   
                        case 'exitoRegistroBd':
                            $('#idInputTitulo').val('');
                            $('#idInputArtista').val('');
                            $('#idInputBm').val('0');
                            $('#idInputDolares').val('0');
                            $('#idInputCentavos').val('0');
                            $('#idInputDemo').val('');
                            $('#idInputRemixCompleto').val('');
    
                            $(".progress-bar").css("width", "0" + "%");
                            $(".porcentaje_h4").html('0' + "% Completado");
                            //borramos los campos 
                            $('.thumb').remove();
                                break;
    
                        default:
                           
                            $(".smsEspera").html('<div class="alert alert-danger alert-dismissible">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                            'Error al guardar'+
                            '</div>');
                        break;
                    }

                    // activamos el boton
                     $(':input[type="submit"]').prop('disabled', false);
                     // removemos el mensaje de aviso
                     
                     
                   
                }
            });
                
    
    
    });
    
   
    // ============================EDITAR PRODUCTO================================//
// ============================EDITAR PRODUCTO================================//
// ============================EDITAR PRODUCTO================================//


$('.editProducto').on('click',function(e){
    e.preventDefault();
    // obtenemos los atrivutos de la etiqueta , en donde se encuentran alojados los datos solo para llenar el formulario
    var idProducto=$(this).attr('data-idProducto');
    var dataTitulo=$(this).attr('data-titulo');
    var dataArtista=$(this).attr('data-artista');
    var dataIdProveedor=$(this).attr('data-idProveedor');
    var dataPrecio=$(this).attr('data-precio');
    var dataIdGenero=$(this).attr('data-idGenero');
    var dataBpm=$(this).attr('data-bpm');

 
    // asignamos los datos al formulario
    $('#idInputTitulo').val(dataTitulo);
    $('#idInputArtista').val(dataArtista);
    $('#idInputBm').val(dataBpm);
    console.log(dataPrecio);
    // dividir cadena
    var separador=".";
    var arrayDeCadenas = dataPrecio.split(separador);
    console.log(arrayDeCadenas[0]);// dolares
    console.log(arrayDeCadenas[1]);//centavos
    $('#idInputDolares').val(arrayDeCadenas[0]);
    $('#idInputCentavos').val(arrayDeCadenas[1]);
    $('#idProveedor').val(dataIdProveedor);
    $('#idProducto').val(idProducto);

   
    //enviamos los datos mediante el metodo Post
    $("#idEditarPrducto").on('submit',function(e){
        e.preventDefault();
        $(':input[type="submit"]').prop('disabled', true);
        var datos=new FormData(this);
        console.log(datos);
        $(".smsEspera").html('<div class="alert alert-info alert-dismissible ">'+
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
        '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
        'Espere por favor....'+
        '</div>');
        for (var pair of datos.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }
        console.log($(this).attr('action'));
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
                console.log(data);
                console.log(data.respuesta);
                /////////////////AGREGO SMS DE CONFIRMACION///////////////////////
                switch (data.respuesta) {
               
                    case 'exito':

                        $(".smsEspera").html('<div class="alert alert-success alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                        '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                        'Datos guardos exitosamente'+
                        '</div>');

                        $('#idInputTitulo').val('');
                        $('#idInputArtista').val('');
                        $('#idInputBm').val('0');
                        $('#idInputDolares').val('0');
                        $('#idInputCentavos').val('0');
                        $('#idInputDemo').val('');
                        $('#idInputRemixCompleto').val('');

                        $(".progress-bar").css("width", "0" + "%");
                        $(".porcentaje_h4").html('0' + "% Completado");
                        //borramos los campos 
                        $('.thumb').remove();
                            break;

                    default:
                       
                        $(".smsEspera").html('<div class="alert alert-danger alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                        '<h4><i class="icon fa fa-warning"></i> Aviso !</h4>'+
                        'Error al guardar'+
                        '</div>');
                    break;
                }

                // activamos el boton
                 $(':input[type="submit"]').prop('disabled', false);
                 // removemos el mensaje de aviso
                 
            }
        });
    })

});

  
    // ================================ELIMINAR  PRODUCTO===============================
    // ================================ELIMINAR  PRODUCTO===============================
    // ================================ELIMINAR  PRODUCTO===============================
    
    $('.deleteProducto').on('click',function(e){
    e.preventDefault();// es para q cuando haga click no brinque 
    
    var id=$(this).attr('data-id');
    var demo=$(this).attr('data-demo');
    var remixCompleto=$(this).attr('data-remixCompleto');
    console.log("ID :"+ id);
    console.log("Demo :"+ demo);
    console.log("RemixCompleto :"+ remixCompleto);
    //BOTON DE ALERTA
        swal({
            title: 'Estás seguro en eliminar a   '+demo,
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
                          'demo':demo,
                          'remixCompleto':remixCompleto,
                          'Producto':'eliminarProducto'
    
                      },
                          url:'../controler/ctrProducto.php',// mando al servidor con la opcion que sea(modelo_proveedor.php)
                          success:function(data){// si el llamado es correcto nos regresa uno datos
                          //console.log(data);// me regresa un string y solo con convierto
                          console.log(data);
                          var resultado=JSON.parse(data);// lo convierto en objeto
                          /*			console.log("EL bojeto ahora el id :"+resultado.id_eliminado);*/
                          if(resultado.respuesta=='exito'){
                          $('[data-id="'+id+'"]').parents('tr').remove();	
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
                  });/// fin ajaxa
               
            }
          })        
        
    });
    
    
});// fin document