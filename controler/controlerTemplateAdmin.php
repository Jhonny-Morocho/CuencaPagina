<?php 
ini_set('display_errors', 'On');


 class controlerPlantillaAdmin{

    public  function ctr_header(){
        require"../../view/admin/templateAdmin/header.php";
        //require"Animacion/animacion_espera.php";
       
    }
    public  function ctr_footer(){
        require"../../view/admin/templateAdmin/footer.php";
    }

    public  function ctr_navegador_Izquierda(){
            
        require"../../view/admin/templateAdmin/navegadorIzquierda.php";
        
    }

    public  function ctr_tabla_genero(){
            
        require"../../view/admin/tablas/tablaGenero.php";
        
    }

}

?>