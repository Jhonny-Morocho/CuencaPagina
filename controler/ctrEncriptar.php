<?php
//Configuración del algoritmo de encriptación
class Encriptar {
 
    public  function encriptarDatos($valor){
        
        return openssl_encrypt($valor,$this->getMethod(), $this->getClave(), false, $this->setIv());
    }


    public function desencriptar($valor){
        $encrypted_data = base64_decode($valor);
        return openssl_decrypt($valor,$this->getMethod(), $this->getClave(), false, $this->setIv());
    }
 
    private  function setIv(){
        return base64_decode("C9fBxl1EWtYTL1/M8jfstw==");
    }
    private  function getClave(){
        return '/latinEdit/@';
    }
    private  function getMethod(){
        return 'aes-256-cbc';
    }
   /*  $getIV = function () use ($method) {
        return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)));
    }; */
    
}

