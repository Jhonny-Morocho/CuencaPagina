
$('#idVentasListarFiltro').on('submit',function(e){
    e.preventDefault()
    var datos=$(this).serializeArray();
    console.log(datos);
    $.ajax({
        type:$(this).attr('method'),
        data:datos,
        url:$(this).attr('action'),
        dataType:'json',
        success:function(data){
            var suma=0;
            data.forEach( function(valor, indice, data) {
            
                //console.log("En el índice " + indice + " hay este valor: " + valor.totalCancelar);
                suma=(parseFloat(valor.totalCancelar)+suma);
                //console.log(suma);
            });
            $('.infoTotal').html(suma.toFixed(2)+'<sup style="font-size: 20px">$</sup>');
        }
    });

});
