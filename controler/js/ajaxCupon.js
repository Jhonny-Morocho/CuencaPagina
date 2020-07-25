$(document).ready(function(){



///////////////////////////////////EDITAR CUPON/////////////////////////////////////////
///////////////////////////////////EDITAR CUPON/////////////////////////////////////////

	$('#idFormEditarCupon').on('submit',function(e){
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
                switch (data.respuesta) {
                    case 'exito':
                        console.log("exito");
                        kkMessgae.success('Datos Actualizados');
                       setTimeout(function(){  location.reload(); }, 3000);
                        //window.location='../view/admin/listarGenero.php';
                        break;
                    case 'noExisteCambios': // foo es 0, por lo tanto se cumple la condición y se ejecutara el siguiente bloque
                        console.log("noExisteCambios");
                        kkMessgae.warning('No se han registrado nuevos cambios');
                        break;
                        // NOTA: el "break" olvidado debería estar aquí
                    case 'error': // No hay sentencia "break" en el 'case 0:', por lo tanto este caso también será ejecutado
                        console.log("error try");
                        kkMessgae.error('ERROR');
                        break; // Al encontrar un "break", no será ejecutado el 'case 2:'
                    default:
                        console.log('default');
                        break;
                }
            }
        });
        

	});


});// fin document


