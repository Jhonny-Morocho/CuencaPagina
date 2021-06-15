<?php
 require'../model/conexion.php';
 require'../model/mdlCliente.php';
    try {
        //code...
        $respuesta=ModeloCliente::buscarUsuario($_GET['correo']);
        if($respuesta['estado']==0){
            $estado=ModeloCliente::estadoCuentaCliente(1,$_GET['correo']);
            print_r($estado);
            if($estado['respuesta']==true){
                //entonces actualizamos el estado del usuario y ahora esta activo
                header('Location: ../estado-validacion-correo.php?estado=true');
            }else{
                //el usuario no esta activo
                header('Location: ../estado-validacion-correo.php?estado=false');
            }
        }
        // si el usuario ya esta validado
        if($respuesta['estado']==1){
            //ya esta validado
            header('Location: ../estado-validacion-correo.php?estado=validado');
        }

    } catch (\Throwable $th) {
        echo $th;
        header('Location: ../estado-validacion-correo.php?estado=error');
    } 
?>