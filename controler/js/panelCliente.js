
Vue.filter('fechaFormato', function (value) {
  let fecha=moment(value).format('MMMM Do YYYY, h:mm:ss a');
  return fecha;
})



const  panelCliente = new Vue({
    el: '#panelCliente',
    //variables globals
    data: {
      idCliente:"",
      usuarioExiste:false,
      password:"",
      correo:"",
      nombre:"",
      saldo:"",
      apellido:"",
      membresiaCliente:[],
      dataFactura:[],
      existeMembresia:false
    },
    //logica
    methods:{
      verMembresia(){
          let cliente= new FormData();
          cliente.append('id',this.idCliente);
          axios.post(this.dominio, cliente)
          .then(response =>{
              const data=response['data'];
              if(!(data['Siglas']=='OE')){
                return toastr.warning (data['sms']);
              }
              //actuaizar el precio de los productos en el array en memori
              this.membresiaCliente=data['res'];
              if(!this.membresiaCliente.length ){
                this.existeMembresia=false;
                return;
              }
              this.existeMembresia=true;
          } )
          .catch(error => {
              console.log(error);
              toastr.error (`Error: ${error.message}`);
          });

      },
      
      listarFacturasCliente(){
        let endPoint="../../Api/public/index.php/clienteProducto/listarProductoCliente/";
        Swal.fire({
          allowOutsideClick: false,
          icon: 'info',
          text: 'Espere por favor...'
        });
        Swal.showLoading();
        axios.post(endPoint+this.idCliente)
        .then(response =>{
            Swal.close();
            console.log(response);
            const data=response['data'];
            if(!(data['Siglas']=='OE')){
              return toastr.warning (data['sms']);
            }
            this.dataFactura=data['res'];
            for (let index = 0; index < this.dataFactura.length; index++) {
              const element = array[index];
              console.log(element);
            }

        })
        .catch(error => {
            Swal.close();
            console.log(error);
            toastr.error (`Error: ${error.message}`);
        });
      },
      cerrrarSession(){
        Swal.fire({
          title: '¿ Estás seguro en cerrar su sesión ?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
        }).then((result) => {
          if (result.isConfirmed) {
            let eliminarUsuario=localStorage.removeItem("usuario");
            window.location.href='../../';
          }
        })
      }
    },
    //cuando se cargue la pagina cargar los datos del local sotorage
    created:function(){
      //al cargar la pagina pregunto si existe el item producto
        let usuario=JSON.parse(localStorage.getItem("usuario"));
        if(!usuario){
            //window.location.href='../../';
            return;
        }
        this.usuarioExiste=true;
        //ver la informacion de tablero
        this.nombre=usuario['nombre'];
        this.apellido=usuario['apellido'];
        this.saldo=usuario['saldo'];
        this.idCliente=usuario['id'];
        this.correo=usuario['correo'];
    }
    ,

  })
   
