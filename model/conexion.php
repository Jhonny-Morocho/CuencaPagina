<?php
    //require'class_mdl_bd_conexion.php';
    ini_set('display_errors', 'On');
    
    class Conexion{
        
        private $link;

        public function __construct(){

            @$modo_developer=true;//aqui cambio el modo

            if($modo_developer){
                try{
                    $this->link = new PDO("mysql:host=localhost;dbname=bd_latin_edit",
                    "root",
                    "root",
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
                    );
                }
                catch (PDOException $e){
                    print_r($e);
                }
        
                $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }else{
                    try{
                        $this->link = new PDO("mysql:host=127.0.0.1;dbname=pro_edit",
                        "jhonnydj",
                        "ky4lkexwbsc8",
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                            PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
                        );
                    }
                    catch (PDOException $e){
                        print_r($e);
                    }
            
                    $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
        }//fin del contructor


        //el id insertado
        public  function  lastInsertId(){
            return $this->link->lastInsertId();
        }

        //la consulta prepare
        public   function  conectar(){
            return $this->link;
        }

     
     
    
    }//end class conexion
?>