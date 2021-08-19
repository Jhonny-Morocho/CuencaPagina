const  CarritoCompras = new Vue({
  el: '#carritoCompras',
  //variables globals
  data: {
    arrayProductos:[],
    producto:{},
  },
/*   data () {
    return {
      info: null
    }
  }, */
  //logica
  methods:{

    addCarrito(event){
      //obtengo el elemento
      elemento=event.target;
      

      //extraigo los datos de dicho elemento
      var idProducto=elemento.getAttribute('data-id');
      var nombreProducto=elemento.getAttribute('data-nombre');
      var precio=elemento.getAttribute("data-precio");
      
      //guardamos en el localstorage
      this.producto={
        idProducto:idProducto,
        nombreProducto:nombreProducto,
        precio:precio
      }
      //obetener lo datos de localstorage
      let productoLocalStorage=localStorage.getItem('productos');
      if(productoLocalStorage==null){
        this.arrayProductos.push(this.producto);
        localStorage.setItem('productos',JSON.stringify(this.arrayProductos));
        toastr.info('Se agrego '+nombreProducto);
        event.path[1].innerHTML='<i class="fas fa-check  ml-1 mr-1" style="color:#39ff14"></i>';
        $('#numProductos').html(Number(this.arrayProductos.length));
        return;
      }
      //obtenemos los productos del local storage
      let auxArrayLocalSotorage=JSON.parse(productoLocalStorage);

      //recurremos el array auxiliar para verificar si existe productos repetidos
      for (let index = 0; index < auxArrayLocalSotorage.length; index++) {
          const element=auxArrayLocalSotorage[index];
          if(element['idProducto']==this.producto.idProducto){
            toastr.warning("Este producto ya esta agregado a tu carrito");
            return;
          }
      }
      //si no existe prodcutos repetidos entonces se agregar al carrito
      this.arrayProductos=auxArrayLocalSotorage;
      this.arrayProductos.push(this.producto);
      localStorage.setItem('productos',JSON.stringify(this.arrayProductos));
      toastr.info('Se agrego '+nombreProducto);
      event.path[1].innerHTML='<i class="fas fa-check  ml-1 mr-1" style="color:#39ff14"></i>';
      //actulizar el numero del carrito
      $('#numProductos').html(Number(this.arrayProductos.length));
      //end
  
      return;
      var nombreProducto=$(this).attr("data-nombre");
      var precio=$(this).attr("data-id");
      let formData=new FormData();
      const user={
        "inputEmailCliente": "jhonnymichaeldj2011@hotmail.com",
        "inputPasswordCliente": "/jhonnydj2011@/",
        "Cliente": "addCliente"
      }
      formData.append("inputEmailCliente","jhonnymichaeldj2011@hotmail.com");
      formData.append("inputPasswordCliente","/jhonnydj2011@/");
      formData.append("Cliente","addCliente");
      //console.log(formData);
      axios.post('http://localhost/CuencaPagina/controler/ctrCliente.php', formData)
      .then(response =>{
        //element.innerHTML = response.data.id;
        console.log(response);
      }  )
      .catch(error => {
          console.log(error);
          element.parentElement.innerHTML = `Error: ${error.message}`;
          console.error('There was an error!', error);
      });

    },
    sumarTotal(){
      //sumar total 
      let total=0;
      for (let index = 0; index < this.arrayProductos.length; index++) {
        const precio=Number((this.arrayProductos[index]['precio']));
        total=precio+total;
      }
      $('#total').html(total.toFixed(2));

    },
    eliminarProducto(idProducto){
      //obter la data del local stroge
      let arrayLocalStorage=JSON.parse(localStorage.getItem('productos'));
      if(arrayLocalStorage.length==0){
        alert("NO HAY PRODUCTOS EN TU CESTA");
        return ;
      }
      for (let index = 0; index < arrayLocalStorage.length; index++) {
        const element=arrayLocalStorage[index];
        if(idProducto==element['idProducto']){
          this.arrayProductos.splice(index,1);
          localStorage.setItem('productos',JSON.stringify(this.arrayProductos));
          $('#numProductos').html(Number(this.arrayProductos.length));
          //sumar total 
          this.sumarTotal();
          return;
        }
      }
      
    } 

  },
  //ciclo de vida de una app
  //cuando se cargue la pagina cargar los datos del local sotorage
  created:function(){
    //al cargar la pagina pregunto si existe el item producto
    let arrayLocalStorage=JSON.parse(localStorage.getItem('productos'));
    if(arrayLocalStorage.length>0){
      //si es nullo entonces lo crea el item
      $('#numProductos').html(Number(arrayLocalStorage.length));
      //cargo los prodcutos en el pagina carrito
      this.arrayProductos=arrayLocalStorage;
      //sumar total 
      this.sumarTotal();
    }
  }
  //para retornar funciones
  ,
/*   computed:{
    invertido(){
      return this.nuevaProducto;
    }
  }, */
  mounted () {
   /*  axios
      .get('http://localhost/CuencaPagina/controler/api.php')
      .then(response => {
        this.info = response;
        console.log(this.info);
      }) */

  }
})





      // ============================ CUPON DE DESCUENTO=======================
      var cuponDescuento=false;
      var nombreCupon="";
      var nuevoTotal=[];// suma de los valores
      var consumo=0;//consumo para aplicar cupon
      var ofertaActiva=false;
      var fechaExpiracion="";
      var porcentajeDescuento=0;
      //==desde la base de datos traemos los datos del cupon de descuento
      $.ajax({
        method: "POST",
        url: "../../controler/ctrCupon.php",
        dataType: "json",
        data: { Cupon: "listar"},
        success:function(respuesta){
          console.log(respuesta[0].fechaExpiracion);
          nombreCupon=respuesta[0].nombreCupon;
          consumo=respuesta[0].consumo;
          fechaExpiracion=respuesta[0].fechaExpiracion;
          porcentajeDescuento=Number((respuesta[0].descuento)/100);
          console.log(porcentajeDescuento);
          if(moment(fechaExpiracion)> moment.now()){
            ofertaActiva=true;
          }else{
            ofertaActiva=false;
          }
          
        }
      });
   
     //console.log( moment(fechaExpiracion)> moment.now() ); //Regresa un boolean

      $('.BtnaplicarCupon').on('click',function(e){
        e.preventDefault();
        var inputCupon=$('#inputCupon').val();//obtengo valores de radios
        //========Tipo de oferta mediante ajax preguntar q oferta esta activa
 
        //console.log(inputCupon);
        //console.log(nombreCupon);

        if(inputCupon==nombreCupon && ofertaActiva==true && Number($(".total-amount span").text()) >=consumo ){
          $('.BtnaplicarCupon').hide();
          $('.cuponDescuento').hide();
            toastr.success ('Descuento efectuado exitosamente .');
            //console.log(localStorage.getItem("listProduct"));
            var descuentoLocalSotorage=JSON.parse(localStorage.getItem("listProduct"));
            //console.log(descuentoLocalSotorage);
            //

            $(".dataProductos TR").remove();//remover los datos atenriroes
          
            descuentoLocalSotorage.forEach(functionDescuento);
        
            //$(".SpanTotalPagar").html(nuevaSumaDescuento);
              
          function nuevaSumaDescuento(total,numero){//recibe dos parametros por default
            return total+numero;
          } 
          var sumaDescuentoTotal=nuevoTotal.reduce(nuevaSumaDescuento);//ete metodo sirve suma los valores entre sii
          console.log(sumaDescuentoTotal.toFixed(2));

          $(".SpanTotalPagar").html(sumaDescuentoTotal.toFixed(2));
          //vacio el array
          sumaDescuentoTotal=0;
          nuevoTotal=[];
          
        }else{

            if(inputCupon!=nombreCupon  && ofertaActiva==true){
              //alert("Cupon no valido , el cupon actual es "+nombreCupon+ " y expira el "+fechaExpiracion);

              toastr.warning("El cupon actual es "+nombreCupon+ " y expira el "+fechaExpiracion);
            }

            if(ofertaActiva==false){
              //alert("Cupon no valido , el cupon actual es "+nombreCupon+ " y expira el "+fechaExpiracion);
              toastr.warning('Cupon no valido');
            }

            
            
            if(Number($(".total-amount span").text()) <=consumo){
              //alert("Tu compra debe ser mayor " +consumo + " para aplicar el cupon");
              toastr.info("Tu compra debe ser mayor $ " +consumo + " para aplicar el cupon");
            }

            
        }
      })


      function functionDescuento(item,index){
        
        $(".dataProductos").append(
    
          '<tr>'+'<td>'+(index+1)+'</td>'+
          
          '<TD  class="classNomProducto" nombre_cancion='+item.nombreProducto+'><p>'+item.nombreProducto+'</p</TD>'+
          '<TD class="classPrecioCancion colorDescuento"><p>$<span>'+(item.precio-((item.precio)*porcentajeDescuento)).toFixed(2)+'</span></p></TD>'+
          ' <TD>'+
              '<i  class="fa fa-trash deleItemCar btnCarrito disabledItemCupon"  aria-hidden="true"  data-precioCancion='+(item.precio-((item.precio)*porcentajeDescuento)).toFixed(2)+' data-id-Producto='
              +item.idProducto+'></i>'
          +'</TD>'+
          '</tr>'
        );
        //nuevaSumaDescuento(Number(item.precio*0.50).toFixed(2));
         nuevoTotal.push(item.precio-((item.precio)*porcentajeDescuento)).toFixed(2);
       // nuevoTotal=(item.precio*0.50).toFixed(2)+nuevoTotal;
      }

