<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use App\Models\Producto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\Encriptar;

use function PHPUnit\Framework\isEmpty;

class CuponController extends Controller{
    use Encriptar;
    public function aplicarCupon(Request $request,$nombreCupon){
        try {
            if(!($request->json())){
                return response()->json(["sms"=>"La data no tiene el formato requerido","Siglas"=>"ONE",'res'=>null]);
            }
            $ObjCupon=Cupon::first();
            //debemos comprobar si el nombre del cupon es el correcto
            if(!($ObjCupon->nombreCupon==$nombreCupon)){
                return response()->json(["sms"=>"El cupon ".$nombreCupon." no es valido ","Siglas"=>"ONE",'res'=>null]);
            }
            //debemos contatar si esta activo el cupon
            if(!($ObjCupon->fechaExpiracion >= Carbon::now())){
                return response()->json(["sms"=>"El cupon ".$ObjCupon->nombreCupon." ha caducado en la fecha ".$ObjCupon->fechaExpiracion,"Siglas"=>"ONE",'res'=>null]);
            }
            //comprobar si el motonto es el permitido para hacer la compra
            $productos=$request->json()->all();
            $total=0;
            foreach ($productos as $key => $value) {
                $desencriptado=$this->desencriptar($productos[$key]['idProducto']);
                $bdProducto=Producto::where('id', $desencriptado)->first();
                if(!$bdProducto){
                    return response()->json(["sms"=>"El producto ".$productos[$key]['nombreProducto']." con el identificador ".$productos[$key]['idProducto']." no ha sido encontrado","Siglas"=>"ONE",'res'=>null]);
                }
                $total=$bdProducto->precio+$total;
            }
            // el monto debe ser mayor al total de los productos del cliente
            if(!($ObjCupon->consumo <=$total)){
                return response()->json(["sms"=>"El monto debe ser mayor o igual a ".$ObjCupon->consumo ,"Siglas"=>"ONE",'res'=>null]);
            }
        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ONE",'res'=>null]);
        }

    }
}
