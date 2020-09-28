<?php

    ini_set('display_errors', 'On');

    //require'Modelo/class_mdl_proveedor.php' lo llamo en al archivo q estan los casie ahi se cargan;

	class CtrMembresia{


        //* listar todos los clientes
        public static function ctr_agregar_membresia($tipo_membresia,$id_cliente,$precio,$tipo_pago){//listar cliente
            $tabla="membresia_cliente";
            $membresias=ModeloMembresia::sqlListarMembresias();
    
            //defino tipo de rango de descarga
            switch (@$tipo_membresia) {

                case 'Nombre Cancion: Basico':
                $rango=$membresias[0]['numDescargas'];

                $respuesta=Modelo_Membresia::sql_agregar_membresia($tabla,$tipo_membresia,$rango,$id_cliente,$precio,$tipo_pago);// el controlador le pide al modelo una respuesta

                return $respuesta;
                    break;

                case 'Nombre Cancion: Premium':
                
                $rango=$membresias[1]['numDescargas'];
               
                $respuesta=Modelo_Membresia::sql_agregar_membresia($tabla,$tipo_membresia,$rango,$id_cliente,$precio,$tipo_pago);// el controlador le pide al modelo una respuesta
                    return $respuesta;
                    break;


                case 'Nombre Cancion: Ultimate':
                $rango=$membresias[2]['numDescargas'];
                $respuesta=Modelo_Membresia::sql_agregar_membresia($tabla,$tipo_membresia,$rango,$id_cliente,$precio,$tipo_pago);// el controlador le pide al modelo una respuesta
                    return $respuesta;
                    break;


            }

        }

        public static function ctr_listar_membresia(){//listar cliente
            $tabla="membresia_cliente";

            $respuesta=Modelo_Membresia::sql_listar_membresia($tabla);
            return $respuesta;
       
        }

        public static function ctr_controlar_compra_membresia($id_cliente){// compruevo si la membresia a caducado q el cliente no tenga membresia para comprar una nueva
            $tabla="membresia_cliente";

           
            $listar_membresia=Modelo_Membresia::sql_listar_membresia($tabla);


            $tipo_membresia="";
            $estado_caducado=false;
            //$fecha_actual = date('Y-m-j');//fecha de hoy
            $estado_membresia="false";//no tiene membresia
            $fecha_culminacion="";
            $fecha_compra="";
            $id_membresia=0;
            $rango_descarga=0;
            $contador_membresia=0;
 

           // print_r($listar_membresia);
 

            //echo"fecha actual ".$fecha_actual;

            //el cliente solo puede comprar una membresia por mes por lo tanto cuando la bandera se active significa
            //que no puede comprar una nueva membresia hasta q se acabe la actuakl                                            
             foreach($listar_membresia as $key=>$value){

                //comente el if por q los clientes pueden compar membesias sin limite de tiemp
                //if($id_cliente==$value['id_cliente'] && $value['fecha_inicio']<=$value['fecha_culminacion'] ){
                 if($id_cliente==$value['id_cliente'] and $value['rango']>0){//termina la membrisia actual y pude comprar mas
                     //el cliente debe acabar la membrsia actual para seguir con la siguiente 
                
                    $estado_membresia="true";//ahun esta activa la membresia
                    $tipo_membresia=$value['tipo'];
                    $fecha_culminacion=$value['fecha_culminacion'];
                    $fecha_compra=$value['fecha_inicio'];
                    $id_membresia=$value['id'];
                    $rango_descarga=$value['rango'];
                    $contador_membresia++;
      
                 }
             }
   



             return $respuesta=array("respuesta"=>$estado_membresia,
                                     "fecha_inicio"=>$fecha_compra,
                                     "fecha_culminacion"=>$fecha_culminacion,
                                     "id_membresia"=>$id_membresia,
                                     "Tipo_membresia"=>$tipo_membresia,
                                     "contador_membresia"=>$contador_membresia,
                                       "rango_descarga"=>$rango_descarga

                                     );
       

        }

        public static function ctr_actualizar_membresia($id_membresia,$actualizar_descargas){//listar cliente
            $tabla="membresia_cliente";

           

            $respuesta=Modelo_Membresia::sql_actualizar_membresia($tabla,$id_membresia,$actualizar_descargas);
            return $respuesta;
       
        }

    }
    
    switch (@$_POST['Membresia']) {
        case 'edit':
            require'../model/conexion.php';
            require'../model/mdlMembresias.php';
            $respuesta=ModeloMembresia::sqlEditarMembresia($_POST);
            return die(json_encode($respuesta));
            break;
                
            default:
                die(json_encode('defecto en ctrMembresia'));
            break;
        }
 ?>
