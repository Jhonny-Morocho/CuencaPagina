$(document).ready(function(){


    ///////////////////////////////////EDITAR MEMBRESIA/////////////////////////////////////////
    ///////////////////////////////////EDITAR MEMBRESIA/////////////////////////////////////////
        
        $('.editMembresia').on('click',function(e){
            e.preventDefault();
            console.log("xxx");
            // obtnemos los datos del formulario
            var id=$(this).attr('data-id');
            var titulo=$(this).attr('data-titulo');
            var numDescargas=$(this).attr('data-numDescargas');
            var precio=$(this).attr('data-precio');
            console.log(id);
           
            $('#idInputNombreMembresia').val(titulo);
            $('#idMembresia').val(id);
            $('#idInputNumeroDescargas').val(numDescargas);
            $('#idInputPrecio').val(precio);
    
            $('#idFormEditMembresia').on('submit',function(e){
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
                        if(data.respuesta=='exitoRegistroBd'){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Se actualizaron los nuevos cambios',
                                showConfirmButton: false,
                                timer: 1500
                              })
                              setTimeout(function(){  location.reload()}, 2000);
    
                        }else{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'No existen cambios nuevo',
                                showConfirmButton: false,
                                timer: 1500
                              })
                        }
                 
                    }
                });
            
            });
    
        });
    
    });// fin document
    
    
    