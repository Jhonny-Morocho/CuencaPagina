<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Traits\Encriptar;

class ClienteController extends Controller
{
    use Encriptar;
    public function login(Request $request){
        try {

            $this->validate($request, [
                'password' => 'required|max:20',
                'correo' => 'required|email'
            ]);

            if(!($request->json())){
                return response()->json(["sms"=>"Los datos no tienene el formato deseado","Siglas"=>"DNF"]);
            }
            //1.Preguntamos si existe el usuario
            $existeUsuario=Cliente::where('correo',$request['correo'])->where('estado',1)->first();
            if(!$existeUsuario){
                return response()->json(["sms"=>"El usuario con el correo".$request['correo']." no ha sido encontrado","Siglas"=>"UNE"]);
            }
            //2.verificar si la contraseña es la correcta
            if(!(password_verify($request['password'],$existeUsuario->password))){
                return response()->json(["sms"=>"Contraseña incorrecta","Siglas"=>"PI"]);
            }

            $respUsuario=array(
                "id"=>$this->encriptarDatosCliente($existeUsuario->id),
                "nombre"=>$existeUsuario->nombre,
                "apellido"=> $existeUsuario->apellido,
                "saldo"=>$existeUsuario->saldoActual,
                "rol"=>$existeUsuario->rol,
                "estado"=>$existeUsuario->estado
            );
            return response()->json(["sms"=>'Operación exitosa',"Siglas"=>"OE",'res'=>$respUsuario]);
        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ERROR"]);
        }
    }
 
}
