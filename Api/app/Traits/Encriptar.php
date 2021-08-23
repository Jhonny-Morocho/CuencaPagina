<?php
namespace App\Traits;

trait Encriptar {
    public function encriptarDatos($valor){
        return openssl_encrypt($valor,$this->getMethod(), $this->getClave(), false, $this->setIv());
    }
    private function desencriptar($valor){
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
}