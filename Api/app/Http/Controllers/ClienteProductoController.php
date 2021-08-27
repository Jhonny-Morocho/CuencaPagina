<?php

namespace App\Http\Controllers;
use App\Traits\Encriptar;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteProducto;

class ClienteProductoController extends Controller{
    use Encriptar;
    public function listarProductoCliente(Request $request){
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
                return response()->json(["sms"=>"El usuario ".$request['id']." no ha sido encontrado","Siglas"=>"UNE"]);
            }
            $clienteProducto=ClienteProducto::where("idCliente",22)->get();
            return response()->json(["sms"=>'Operación exitosa',"Siglas"=>"OE",'res'=>$clienteProducto]);

        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ERROR"]);
        }
    }
}
