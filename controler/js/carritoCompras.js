

const  CarritoCompras = new Vue({
  el: '#carritoCompras',
  data: {
    arrayProductos:[],
    producto:{},
    cuponDescuento:false,
    cupon:"",
    nombre:"Jhonny",
    apellido:"Morocho",
    correo:"jhonnymichaeldj2011@hotmaial.com",
    direccion:"Los rosales",
    telefono:"0998202201",
    documentoIdentidad:"11105116899",
    metodoPago:null
  },
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
        toastr.success('Se agrego '+nombreProducto);
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
    },
    sumarTotal(){
      //sumar total 
      let total=0;
      for (let index = 0; index < this.arrayProductos.length; index++) {
        const precio=Number((this.arrayProductos[index]['precio']));
        total=precio+total;
      }
      $('#total').html(total.toFixed(2));
      return total;
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
        }
      }
      
    },
    formFactura: function (e) {
      e.preventDefault();
      try {
        const formFactura=[
            {
                name:'nombre',
                valid:this.validVacio(this.nombre) && !this.longitudCadena(this.nombre,20),
                value:this.nombre
           
            },
            {
                name:'apellido',
                valid:this.validVacio(this.nombre) && !this.longitudCadena(this.apellido,20),
                value:this.apellido
            },
            {
                
                name:'correo',
                valid:this.validCorreo(this.correo),
                value:this.correo
            },
            {
                
                name:'direccion',
                valid:this.validVacio(this.nombre) && !this.longitudCadena(this.direccion,50),
                value:this.direccion
  
            },
            {
                
                name:'telefono',
                valid:this.validVacio(this.telefono) && !this.longitudCadena(this.telefono,15),
                value:this.telefono
  
            },
            {
                
                name:'documentoIdentidad',
                valid:this.validVacio(this.documentoIdentidad) && !this.longitudCadena(this.documentoIdentidad,20),
                value:this.documentoIdentidad
  
            },
            {
                
                name:'metodoPago',
                valid:this.validVacio(this.metodoPago),
                value:this.metodoPago
  
            }
        ]
      
        //validar que todos lo no este vacios
        for (const i in formFactura) {
            if(formFactura[i]['valid']==false){
            toastr.warning("Debe completar todos los campos correctamente");
            return;
            }
        }
   
        $('#btn-ContinuarCompra').html('<span class="spinner-border spinner-border-sm mr-2" id="spinerBtnAplicarOferta" role="status" aria-hidden="true"></span>Cargando..').addClass('disabled');
        let endPoint="";
        //comprobar si tiene session o no
        if(!localStorage.getItem("usuario")){
          toastr.warning ("DEBE INICIAR SESIÓN");
          return;
        }
        let usuario=JSON.parse(localStorage.getItem("usuario"));
  
        // prepara boton para metodo de pago
        switch (this.metodoPago) {
          case "paypal":
             endPoint="../../Api/public/index.php/detalleFactura/crearFacturaProductosPaypal/"+usuario.id;
            break;
          case "membresia":
            //endPoint="Api/public/index.php/paypal/productosPaypal";
            break;
          case "monedero":
            //endPoint="Api/public/index.php/paypal/productosPaypal";
            break;
          case "tarjeta":
            //endPoint="Api/public/index.php/paypal/productosPaypal";
            break;
          default:
            toastr.error ("No existe método de pago selecionado");
            break;
        }
        

        let dataProducto={
            productos:[this.arrayProductos],
            formCliente:[
                {
                    "nombre":this.nombre,
                    "apellido":this.apellido,
                    "correoFacturacion":this.correo,
                    "direccion":this.direccion,
                    "telefono":this.telefono,
                    "total":10,
                    "documentoIdentidad":this.documentoIdentidad,
                    "metodoPago":this.metodoPago
                }
            ]
        };

        axios.post(endPoint,  JSON.stringify(dataProducto))
        .then(response =>{
          console.log(response);
            const data=response['data'];
            $('#btn-ContinuarCompra').html('Continuar con la compra').removeClass('disabled');
            //$('#btn-ContinuarCompra').html("").hide();
            if(!(data['Siglas']=='OE')){
              return toastr.warning (data['sms']);
            }
            //actuaizar el precio de los productos en el array en memoria
            toastr.success('Solicitud procesada con éxito');
            this.metodoPago="";
            setTimeout(function(){
              window.location.href=data['res']['urlPaypal'];
            },2000);//tiempo de espera
        } )
        .catch(error => {
            console.log(error);
            toastr.error (`Error: ${error.message}`);
        });
        
      } catch (error) {
        console.error(error);
      }
 
    },
    aplicarCupon(){
      if(!this.cupon){
        toastr.warning ("El cupon es requerido");
        return;
      }

      axios.post('../../Api/public/index.php/cupon/aplicarCupon/'+this.cupon, this.arrayProductos)
      .then(response =>{
          console.log(response);
          $('#btn-aplicarOferta').html('<span class="spinner-border spinner-border-sm mr-2" id="spinerBtnAplicarOferta" role="status" aria-hidden="true"></span>Cargando..').addClass('disabled');
          const data=response['data'];
          if(!(data['Siglas']=='OE')){
            $('#btn-aplicarOferta').html('Aplicar cupon').removeClass('disabled');
            $('#btn-aplicarOferta span').html("").hide();
            return toastr.warning (data['sms']);
          }
          this.cuponDescuento=true;
          //actuaizar el precio de los productos en el array en memoria
          this.arrayProductos=data['res'];
          this.sumarTotal();
          toastr.success('Descuento efectuado exitosamente .');
      } )
      .catch(error => {
          console.log(error);
          toastr.error (`Error: ${error.message}`);
      });
    },
    validVacio(texto){
      try {
        if(texto.length>0){
            return true;
        }
        return false;
        
      } catch (error) {
        console.log(error);
      }
    },
    soloNumeros(numero){
        if(numero!=""){
            var re =/^[-]?[0-9]+[\.]?[0-9]+$/;
            return !(re.test(numero));
        }
        return false;
    },
    validCorreo: function (email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    },
    soloTexto(texto){
        var re =/^[a-zA-Z\ áéíóúÁÉÍÓÚñÑ\s]*$/
        return !(re.test(texto));
    },
    longitudCadena(texto,longitud){
      try {
        if(texto.length>=longitud){
            return true;
        }
        return false;
        
      } catch (error) {
        console.log(error);
      }
    }

  },
  //cuando se cargue la pagina cargar los datos del local sotorage
  created:function(){
    //al cargar la pagina pregunto si existe el item producto
    let arrayLocalStorage=JSON.parse(localStorage.getItem('productos'));
    try {
      if(arrayLocalStorage.length>0){
        //si es nullo entonces lo crea el item
        $('#numProductos').html(Number(arrayLocalStorage.length));
        //cargo los prodcutos en el pagina carrito
        this.arrayProductos=arrayLocalStorage;
        //sumar total 
        this.sumarTotal();
        return;
      }
    } catch (error) {
      console.log(error);
    }

  }
  //para retornar funciones
  ,
  mounted () {
   /*  axios
      .get('http://localhost/CuencaPagina/controler/api.php')
      .then(response => {
        this.info = response;
        console.log(this.info);
      }) */

  }
})
 