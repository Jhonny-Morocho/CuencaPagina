$(document).ready(function(){



    //====================FILTRAR PAGOS =========================//
    //====================FILTRAR PAGOS =========================//
    //====================FILTRAR PAGOS =========================//
    
    $('#idFiltrarFechaPago').on('submit',function(e){
        e.preventDefault();

        // obtnemos los datos del formulario
        var datos=$(this).serializeArray();
        var etiquetaPago="";
        var suma=0;
        animacion();
        console.log(datos);//imprimr los valores
            $.ajax({
                type:$(this).attr('method'),
                data:datos,
                url:$(this).attr('action'),
                dataType:'json',//json
                success:function(data){
                    //console.log(JSON.stringify(data));//el usuario si existe
                    
                    $('.cuerpoTabla tr').remove(); // si existe la tabla ya filtrada entonces q la borre para q no se repita
                    console.log(data.length);
                    console.log(data);
                    //console.log(data[0]['estadoPagoProveedor']);
                      for (let i = 0; i < data.length; i++) {

                            if (data[i]['estadoPagoProveedor']==0) {

                              suma=suma+Number(data[i]['precioCompra']);
                              etiquetaPago='<small class="label  bg-yellow">Pendiente</small>';
                              TD='<tr >'+
                              '<td >'+(i+1)+'</td>'+
                              '<td class="idClienteProducto">'+data[i]['id']+'</td>'+
                              '<td>'+data[i]['idFactura']+'</td>'+
                              '<td >'+data[i]['nombrePista']+'</td>'+
                              '<td >'+data[i]['metodoCompra']+'</td>'+
                              '<td>$'+data[i]['precioCompra']+'</td>'+
                              '<td >'+data[i]['fechaCompra']+'</td>'+
                              '<td >'+etiquetaPago+'</td>'+
                             // '<td >'+data[i]['estadoPagoProveedor']+'</td>'+
                              '/<tr>';
                              $('.cuerpoTabla').append(TD);
                            }
                      }

                      $('.sumaTotal').html(suma.toFixed(2));

                }
            });    
    });

    $('#idFormVerTodo').on('submit',function(e){
      e.preventDefault();
      location.reload();

    });
    //====================CAMBIAR DE ESTADO A  PAGADO =========================//
    //====================CAMBIAR DE ESTADO A  PAGADO =========================//
    //====================CAMBIAR DE ESTADO A  PAGADO =========================//
    $('#idCambiarEstado').on('submit',function(e){
        e.preventDefault();

        // obtnemos los datos del formulario
        var datos=$(this).serializeArray();
        //animacion();
        var nodoIdClienteProducto=$('.idClienteProducto');
       
        var arrayNodosConValorId=[];
        for (let index = 0; index < nodoIdClienteProducto.length; index++) {
            arrayNodosConValorId[index]=nodoIdClienteProducto[index].innerText;
            
        }

        console.log(arrayNodosConValorId);

        // comprobar si existen datos para enviar caso contrario monstramos mensaje

        if (!arrayNodosConValorId) {
          console.log("si");
          Swal({
              title: 'Esta seguro  ?',
              text: "Se cambiara el estado de pendiente a pagado",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, deseo cambiar el estado'
            }).then((result) => {
              if (result.value) {
  
                $.ajax({
                  type:$(this).attr('method'),
                  data:{idProductos:arrayNodosConValorId, FiltroPagoProveedor:'CambiarEstadoPagado'},
                  url:$(this).attr('action'),
                  dataType:'text',//json
                  success:function(data){
                    console.log(data);
                // confirmacion 
                    Swal(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                  }
              });    
              }
            })
        }else{
          alert();
        }

    });


});

// $('tbody').append('<tr><td>xxxxxxxx</td></tr>');

// TD='<tr class="dataTablaEstimaciones">'+
			
// '<td>'++1+'</td>'+
// '<td>'+1+'</td>'+
// '<td class="soloc">'+1+'</td>'+
// '<td>'+1+'</td>'+
// '<td >'+1+'</td>'+

// '/<tr>';
// //añadir nodos a la tabla  Formulario para la estimación de esfuerzo y tiempo de desarrollo utilizando 
// $('.dataAfter').after(TD);

