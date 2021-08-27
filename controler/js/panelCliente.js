// ===============================LOGIN CLIENTE============================
// ===============================LOGIN CLIENTE============================
// ===============================LOGIN CLIENTE============================


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
      dominio:"../../Api/public/index.php/membresiaCliente/verMembresia"
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
        } )
        .catch(error => {
            console.log(error);
            toastr.error (`Error: ${error.message}`);
        });

    }


    },
    //cuando se cargue la pagina cargar los datos del local sotorage
    created:function(){
      //al cargar la pagina pregunto si existe el item producto
        let usuario=JSON.parse(localStorage.getItem("usuario"));
        if(!usuario){
            toastr.warning ("DEBE INICIAR SESIÓN");
            return;
        }
        //ver la informacion de tablero
        this.nombre=usuario['nombre'];
        this.apellido=usuario['apellido'];
        this.saldo=usuario['saldo'];
        this.idCliente=usuario['id'];
    }
    ,

  })
   
