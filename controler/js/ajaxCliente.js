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

    //////////////////////////////////EDITAR CLIENTE//////////////////////////////////
    //////////////////////////////////EDITAR CLIENTE//////////////////////////////////
    //////////////////////////////////EDITAR CLIENTE//////////////////////////////////
    //////////////////////////////////EDITAR CLIENTE//////////////////////////////////
    //////////////////////////////////EDITAR CLIENTE//////////////////////////////////
        $("#id_editar_cliente").on('submit',function(e){
            e.preventDefault();
            console.log("soy tu formulario editar");
            var datosCliente=$(this).serializeArray();
            console.log("daots_formulaio",datosCliente);

            //BOTON DE ALERTA
            swal({
                    title: 'Estás seguro en editar tus datos?',
                    text: "Se actualizara la informacion de tu cuenta!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!'
                }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type:$(this).attr('method'),
                        data:datosCliente,
                        url:$(this).attr('action'),
                        dataType:'json',//json
                        success:function(data){

                            console.log(data);

                            //////////////////mensaje si se cambio el password
                            if(data.respuesta=='exito'){


                                    swal(
                                        'Registro Editado con Exito!',
                                        ' Cierre su session y vuela ingresar, para verificar los cambios realizados ! ',
                                        'success'
                                        )

                                    setTimeout(function(){
                                        //window.location.href='admin_area.php';
                                    },2000);//tiempo de espera



                            }else{
                               
                                swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Revise bien los datos ingresado!',
                                footer: '<a href>Ingresastes correctamente lo datos?</a>'
                                })

                            }
                        }
                    });

                }//end del la pregunta
            })





            });

