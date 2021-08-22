<?php

namespace App\Http\Controllers;

//llamar los modelos q voy a ocupar

//permite traer la data del apirest
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;



class ProveedorController extends Controller
{
    //Registrar Usuario
    //correo de le emplesa


    public function RegistrarUsuario(Request $request){


    }
    public function listasProveedores(){
        try {
            $proveedor=Proveedor::where('estado',1)->get();
            if(!$proveedor){
                return response()->json(["sms"=>'Operación no exitosa',"Siglas"=>"ONE",'res'=>null]);
            }
            return response()->json(["sms"=>'Operación exitosa',"Siglas"=>"OE",'res'=>$proveedor]);
        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ONE",'res'=>null]);
        }
    }

    public function face(Request $request)
    {
       echo "SOY FACEBOOK";
    }

    public function login(Request $request){
        try {
            if(!($request->json())){
                return response()->json(["sms"=>"Los datos no tienene el formato deseado","Siglas"=>"DNF"]);
            }
            //1.Preguntamos si existe el usuario
            $existeUsuario=Proveedor::where('correo',$request['correo'])->where('estado',1)->first();
            if(!$existeUsuario){
                return response()->json(["sms"=>"El usuario con el correo".$request['correo']." no ha sido encontrado","Siglas"=>"UNE"]);
            }
            //2.verificar si la contraseña es la correcta
            if(!(password_verify($request['password'],$existeUsuario->password))){
                return response()->json(["sms"=>"Contraseña incorrecta","Siglas"=>"PI"]);
            }

            $respUsuario=array(
                "id"=>Crypt::encrypt($existeUsuario->id),
                "nombre"=>$existeUsuario->nombre,
                "apellido"=> $existeUsuario->apellido,
                "apodo"=>$existeUsuario->apodo,
                "correo"=>$existeUsuario->correo,
                "tipo_usuario"=>$existeUsuario->tipo_usuario,
                "editado"=>$existeUsuario->editado,
                "estado"=>$existeUsuario->estado,
                "img"=>$existeUsuario->img
            );
            return response()->json(["sms"=>'Operación exitosa',"Siglas"=>"OE",'res'=>$respUsuario]);
        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ERROR"]);
        }
    }

}
