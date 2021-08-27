<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Encriptar;
use App\Models\Cliente;
use App\Models\MembresiaCliente;
class MembresiaClienteController extends Controller{
    use Encriptar;

    public function verMembresia(Request $request){
        try {
            //verificar si existe ese usuario
            $this->validate($request, [
                'id' => 'required'
            ]);
            if(!($request->json())){
                return response()->json(["sms"=>"Los datos no tienene el formato deseado","Siglas"=>"DNF"]);
            }

            $idCliente=$this->desencriptarCliete($request['id']);
            //1.Preguntamos si existe el usuario
            $existeUsuario=Cliente::where('id',$idCliente)->where('estado',1)->first();
            if(!$existeUsuario){
                return response()->json(["sms"=>"El usuario con el correo".$request['correo']." no ha sido encontrado","Siglas"=>"UNE"]);
            }
            $membresiaCliente=MembresiaCliente::where("idCliente",22)->get();
            return response()->json(["sms"=>'Operación exitosa',"Siglas"=>"OE",'res'=>$membresiaCliente]);

        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ERROR"]);
        }
    }
}
