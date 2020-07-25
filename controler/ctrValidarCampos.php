<?php
    ini_set('display_errors', 'On');

    class CtrValidarCampos{



        function solo_letras($cadena){ 
      
            
            $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙÑñ\s]+$/";

            //validar la longitudde de la cadena
        
            if(preg_match($patron_texto, $cadena) and strlen($cadena)<=20){//debe ser solo texto
                return true; 
            
            }else{
                return false; 
            
            }


        }  

        function soloTextoBuscador($cadena){ 
      
            
            $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙÑñ() .1234567890&\s-]+$/";

            //validar la longitudde de la cadena
        
            if(preg_match($patron_texto, $cadena) and strlen($cadena)<=100){//debe ser solo texto
                return true; 
            
            }else{
                return false; 
            
            }


        }  
         
        function validaEmail($valor){

  
            if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
                return false;
            }else{
                return true;
            }

            
         }
          
        

        //validar campor vacios
        function validar_campos_vacios($valor){
            if(trim($valor) == ''){
               return false;//los campos son vacios
            }else{
               return true;//los campos no estan vacio
            }
         }

        //validar password
        function validar_password($cadena){
          
            if(strlen($cadena)<=20 and strlen($cadena)>=1){
                return true; 
            }else{
                return false; 
            }
         }
        
        
		
    }

    // Arrays para guardar mensajes y errores:
    //  $aErrores = array();
    //  $aMensajes = array();

    //  $nombre="http:\2427505545545139194.owasp.org";
    // // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
    //  $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙÑñ\s]+$/";

    //     // Comprobar si llegaron los campos requeridos:
  
    //     // Nombre:
    
    //     // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
    //     if( preg_match($patron_texto, $nombre) )
    //         $aMensajes[] = "Nombre: [".$nombre."]";
    //     else
    //     $aErrores[] = "El nombre sólo puede contener letras y espacios";
    
   
  
     
    //     // Si han habido errores se muestran, sino se mostrán los mensajes
    //      if( count($aErrores) > 0 )
    //     {
    //         echo "<p>ERRORES ENCONTRADOS:</p>";
    //         // Mostrar los errores:
    //         for( $contador=0; $contador < count($aErrores); $contador++ )
    //             echo $aErrores[$contador]."<br/>";
    //     }
    //     else
    //     {
    //         // Mostrar los mensajes:
    //         for( $contador=0; $contador < count($aMensajes); $contador++ )
    //             echo $aMensajes[$contador]."<br/>";
    //     }
    
   
    



?>