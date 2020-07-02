


    ///////////////////////////////REGISTRO CLIENTE/////////////////////////////////////////////////////////////////
    ///////////////////////////////REGISTRO CLIENTE/////////////////////////////////////////////////////////////////
    ///////////////////////////////REGISTRO CLIENTE/////////////////////////////////////////////////////////////////

    $("#id_agregar_cliente").on('submit',function(e){
        e.preventDefault();

        console.log("soy tu formulario registro cliente");

        var datos_cliente=$(this).serializeArray();

        console.log("datos_formulaio",datos_cliente);
        animacion();

        $.ajax({
            type:$(this).attr('method'),
            data:datos_cliente,
            url:$(this).attr('action'),
            dataType:'text',//json
            success:function(data){
                console.log(data);
                if(data.respuesta=='exito'){
                    swal(
                            'Registro Exitoso!'+data.nombre,
                            'Correo ! '+data.email,
                            'success'
                        )

                    setTimeout(function(){
                        window.location.href='../admin_cliente.php';
                    },2000);//tiempo de espera


                }else{
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'No se puede registar Posiblemente ingresastes mal tus datos o ya existe una cuenta con este correo',
                        footer: 'Comunicate con nostros en nuestras redes sociales'
                    })
                }
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
            var datos_cliente=$(this).serializeArray();
            console.log("daots_formulaio",datos_cliente);

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
                        data:datos_cliente,
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


            /////////////////////////////////BORRAR DEFINITIVO/////////////////////////////////
            /////////////////////////////////BORRAR DEFINITIVO/////////////////////////////////
            /////////////////////////////////BORRAR DEFINITIVO/////////////////////////////////


        // este caso es x que no uno un formulario aqui enviio los datos desde ajax
        // cuando hay un formulario el formulario lo envia a lo datos
            $('.borrar_registro_cliente').on('click',function(e){
                console.log("soy borrar cliente");
                e.preventDefault();// es para q cuando haga click no brinque
                var id=$(this).attr('data-id');
                var tipo=$(this).attr('data-tipo');// pueden venir n tipo de dara tipo
                console.log("ID :"+ id);
                console.log("Tipo: "+ tipo);

                //BOTON DE ALERTA
                swal({
                  title: 'Estás seguro?',
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
                                'registro':'eliminar'

                            },
                                url:'modelo_'+tipo+'.php',// mando al servidor con la opcion que sea(modelo_proveedor.php)
                                success:function(data){// si el llamado es correcto nos regresa uno datos
                                console.log(data);// me regresa un string y solo con convierto
                                var resultado=JSON.parse(data);// lo convierto en objeto
                                console.log(resultado);
                                //impirmir
                                console.log("Todo el resultado :",resultado.respuesta);
                                console.log("EL bojeto ahora el id :",resultado.id_producto);
                                /*console.log("EL ID EN JSON ES id :"+resultado.id_eliminado);*/
                                /*			console.log("EL bojeto ahora el id :"+resultado.id_eliminado);*/
                                if(resultado.respuesta=='exito'){
                                jQuery('[data-id="'+resultado.id_producto +'"]').parents('tr').remove();

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
                      'Tu archivo ha sido eliminado. id_cancion',
                      'success'
                    )
                  }
                })


            });



            //////////////////////////////////VALIDAR CORREO//////////////////////
            //////////////////////////////////VALIDAR CORREO//////////////////////
            //////////////////////////////////VALIDAR CORREO//////////////////////
            //////////////////////////////////VALIDAR CORREO//////////////////////
            //////////////////////////////////VALIDAR CORREO//////////////////////
            function validar_email( email ){
            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email) ? true : false;
            }

            ////////////////////////////////////////VALIDAR LONGITUD DE CORREO Y PASSWORD////////////////////
            ////////////////////////////////////////VALIDAR LONGITUD DE CORREO Y PASSWORD////////////////////
            function validar_longitude_correo(correo_longitud){
                if(correo_longitud.length<=40){
                    ///////////////////////CORREO MUY LARGO/////////////
                    ///////////////////////CORREO MUY LARGO/////////////
                    ///////////////////////CORREO MUY LARGO/////////////
                    ///////////////////////CORREO MUY LARGO/////////////
                return true;

                }else{
                    return false;
                }
            }


            function validar_longitude_password(password_longitud){
                if(password_longitud.length<=16){

                ///////////////////////PASSWORD MUY LARGO/////////////

                return true;

                }else{
                    return false;
                }

            }


            ////////////////////////////////////////VALIDAR CAMPOS VACIOS DE CORREO Y PASSWORD////////////////////
            ////////////////////////////////////////VALIDAR CAMPOS VACIOS DE CORREO Y PASSWORD////////////////////

            function validar_campos_vacio(campo_vacio){
                    if(campo_vacio==""){
                    /////////////////LOS CAMPOS ESTAN VACIOS DEBES COMPLETAR///////////
                    /////////////////LOS CAMPOS ESTAN VACIOS DEBES COMPLETAR///////////
                    /////////////////LOS CAMPOS ESTAN VACIOS DEBES COMPLETAR///////////
                    return false;

                }else{
                    return true;
                }
            }


        //===========================Validacion en tiempo real teclado=============================
         //===========================Validacion en tiempo real teclado=============================
         //===========================Validacion en tiempo real teclado=============================
         function solo_letras(value) {


            var regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
            return regex.test(value);

          }








        //activar y desactivar chekca para cambiar datos del cliente
        $('.fantasma').click(function(){

            if($(this).is(':checked')){
                $('.contentM').fadeToggle(1000);
                $('.contraseña_check').after('<div class="row contraseña">'
                                                    +'<div class="col-lg-6 contentM">'
                                                       +' <div class="single-input-item">'
                                                            +'<p class="p_password_1"></p>'
                                                            +'<input type="password" placeholder="Ingresa tu contraeña" required="" name="password_1" id="id_password_1">'
                                                        +'</div>'
                                                +'</div>'

                                            +'<div class="col-lg-6 contentM">'
                                                +'<div class="single-input-item">'
                                                    +'<p class="p_password_2"></p>'
                                                    +'<input type="password" placeholder="Repite tu contraseña" required="" name="password_2" id="id_password_2" >'
                                                +'</div>'
                                            +'</div>'
                                        +'</div>'

                                            );
                    //validad password 1
                    $("#id_password_1").on("keyup", function() {
                        var nombre = $(this).val().length;

                        if($(this).val().length>0 && validar_longitude_password($(this).val())==true ){//por facor llenar lo campos
                            text_password=$(this).val();
                            $(".p_password_1").html('<i class="fa fa-check registo_check_true" aria-hidden="true"></i>');

                        }else{
                            $(".p_password_1").html('<i class="fa fa-times registo_check_false" aria-hidden="true"></i><p>Password no valido</p>');
                        }
                    });


                    //validad password 22
                    $("#id_password_2").on("keyup", function() {
                        var nombre = $(this).val().length;
                        //validar_campos_vacio(nombre);

                        if($(this).val().length>0 && text_password==$(this).val()){//por facor llenar lo campos
                            bandera_password=true;
                            $(".p_password_2").html('<i class="fa fa-check registo_check_true" aria-hidden="true"></i>');
                        }else{
                            $(".p_password_2").html('<i class="fa fa-times registo_check_false" aria-hidden="true"><p>Password no coinciden</p></i>');
                        }
                    });


                }else{
                    $('.contentM').fadeToggle(1000);
                    $('.contraseña').remove();

            }
        });



        //});// fin document
