<?php
ini_set('display_errors', 'On');


class ControladorPlantillaInicio{

        public  function ctr_header(){
            require"view/templateInicio/header.php";
            require"animacionEspera/animacion_espera.php";
           
        }

         public  function ctr_slider(){
             require"view/templateInicio/carrusel.php";
          
            
            
         }

        // public  function ctr_categorias(){
        //     require"Vista/template/categorias.php";
        // }

        // public  function ctr_lista_update(){
        //     require"Vista/template/lista_update.php";
          
        // }

        public  function ctr_footer(){
            
            require"view/templateInicio/footer.php";

 
        }


        // public function reproductor(){
           
        //     require"Vista/template/reproductor.php";
        // }

         public function panelCliente(){
             //require"Vista/template/panel_admin.php";
             require'view/cliente/panelCliente.php';
         }


        // public function ctr_tabla_descargar_productos_cliente(){
        //     require'Vista/template/tabla_descargar_productos_cliente.php';
        // }



        // public function ctr_tabla_carrito_compras(){
        //      require'Vista/template/tabla_carrito_compras.php';
        // }

        public function ctr_tabla_productos(){
            require'view/templateInicio/tablaProductos.php';
        }

        public function ctr_tabla_carritoCompras(){
            require'view/templateInicio/tablaCarrito.php';
        }

        public function ctr_Formulario_LoginAdmin(){
                require'view/templateInicio/formularioLoginAdmin.php';
        }
         public function ctrFormularioCliente(){
                require'view/cliente/formularioCliente.php';
         }

        // public function wassap(){
        //     require'Wassap/wassap.php';
        // }


        // public function categoria_derecha(){
        //     require'Vista/template/cetegoria_derecha.php';
        // }
        
        // ==================Funciones para session==================
        // ==================Funciones para session==================
        public function usuario_autentificado(){

            @session_start();
            function revisar_usuario_session(){

                if($_SESSION['tipo_usuario']=='cliente'){

                    return isset($_SESSION['usuario']);
                }else{
                    return 0;
                }
            }

            if(!revisar_usuario_session()){
                header('location: ./');
                exit();
            }


        }


        public function cerrar_session($cerrar_session){
            $cerrar_session=@$_GET['cerrar_session'];
            if($cerrar_session){// si se emvio la session entonces destruir
            session_destroy();
            header('location: ./');
            }
        }


        
        // public static function url_producto(){
            
        //         return "../demo.php?id_producto=";
           
        // }

        // public static function url_update(){
        //     return "../update_demos.php?id_update=";
        // }

        // public static function url_dj_productos(){
          
        //     return "../dj_productos.php?id_proveedor=";
           
        // }

        // public static function url_biblioteca_productos(){
   
        //     return "../genero_productos.php?id_genero=";
            
        // }

        // public static function contadorOferta(){
   
        //     require"ContadorOferta/contadorOferta.php";
            
        // }


        







}


?>

