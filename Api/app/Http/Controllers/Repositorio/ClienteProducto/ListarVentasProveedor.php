<?php
namespace App\Http\Controllers\Repositorio\ClienteProducto;
use App\Models\ClienteProducto;
use Illuminate\Http\Request;
class ListarVentasProveedor {


  public static  function listarTodas(Request $request,$idProveedor) {
    try {
        $fechaInicio = $request['fechaInicio'];
        $fechaFin = $request['fechaFin'];
        $clienteProducto= ClienteProducto::join('producto','producto.idProveedor',$idProveedor)
                                        ->where('cliente_producto','cliente_producto.iProducto','producto.id')
                                        ->whereBetween('cliente_producto.fechaCompra', [$fechaInicio, $fechaFin])
                                        ->get();
        return response()->json(["data"=>$clienteProducto,"succes"=>True,"message"=>"Listado de declaraciones"],200);
    } catch (\Throwable $th) {
        return response()->json(["succes"=>false,"message"=>$th->getMessage(),"data"=>[]],404);
    }
  }



}
