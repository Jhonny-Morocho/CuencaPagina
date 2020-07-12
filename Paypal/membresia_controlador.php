<?php
ini_set('display_errors', 'On');

require'../Modelo/class_mdl_bd_conexion.php';

require'../Modelo/class_mdl_membresia.php';

include'../Controlador/class_ctr_membresia.php';

session_start();



//print_r($_POST);

if(isset($_SESSION['usuario']) and $_SESSION['tipo_usuario']=='Cliente' and isset($_SESSION['id_cliente']) ){

    //el cliente puede compar las membresias q el quiera sin limite  aqui dejo comprar la membresia sin limite de tiempo

    $respuesta=array("respuesta"=>'false',
    );

    //teneimoas un control para q el cliente olo pueda comprar una membresia por mes pero le comennbte
    
    //$respuesta=CtrMembresia::ctr_controlar_compra_membresia($_SESSION['id_cliente']);
        
        
    }else{
        $respuesta=array('respuesta'=>'no_existe_session');
     

    }

    die(json_encode($respuesta));
?>