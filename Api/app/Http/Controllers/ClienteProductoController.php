<?php

namespace App\Http\Controllers;
use App\Traits\Encriptar;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteProducto;
use App\Models\DetalleFactura;
use PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;
use App\Traits\PaypalBootstrap;
class ClienteProductoController extends Controller{
    use Encriptar;
    use PaypalBootstrap;
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
    public function compraPaypal(Request $request){

        if(!isset($request['paymentId']) && !isset($request['PayerID']) ){
            $res="No existe las variables paymentId & PayerID";
            return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=FALSE&sms='.$res);
        }
        $paymentId = $request['paymentId'];
        $payment = Payment::get($paymentId, $this->modoDev());
        $payerId = $request['PayerID'];
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        try {

            // aqui completas la transaccion
            // $payment->execute consulta en segundo plano si la transaccion fue exitosa
            // Si fue exitosa retorna un HTTP 200 y devuelve un objeto
            // que se almacena el $result
            // Si el procedo no fue completado con exito retorna un HTTP 4XX y un objeto
            // con los posibles motivos del error
            // aqui tienes un ejemplo https://paypal.github.io/PayPal-PHP-SDK/sample/doc/payments/ExecutePayment.html
            $result = $payment->execute($execution, $this->modoDev());

            // haces un dump del objeto para que veras toda la
            // info que proporciona
            var_dump($result);
            //pago no aprobado
            if($result->state != "approved") {
                return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=FALSE&sms='.$result->state);
            }
            /////////////OBTENGO LOS DATOS DEL OBJETO Q ME REGRESA PAYPAL
            $transactionsClient = $result->transactions[0];
            $itemListClient     = $transactionsClient->item_list;
            $itemsClient        = $itemListClient->items;
            //////////precio de compra
            $detalleCompraPaypal=$result->transactions[0];
            $total_paypal=$detalleCompraPaypal->amount->total;
            /* echo "<br> el detalle es ".$detalleCompraPaypal;
            echo "<br>el precio ".$total_paypal."<br>";*/
            $arrayNombreProducto=[];
            $array_id_tema=[];
            $array_precio=[];

            //para agregar el modulo de membresia voy a usar una variable booleana
            foreach ($itemsClient as $key => $value) {
                /*echo $value->name.'<br>';*/
                $arrayNombreProducto[$key]=$value->name;

                /*echo $value->sku.'<br>';*/
                $array_id_tema[$key]=$value->sku;

                /*echo $value->price.'<br>';*/
                $array_precio[$key]=$value->price;
                /* echo '----';*/
            }
            //crear la factura
            return "TDO BIEN";
            $DetalleFactura=new DetalleFactura();
            $DetalleFactura->totalCancelar="";
            $DetalleFactura->idCliente ="";
            $DetalleFactura->totalCancelar="";
            $DetalleFactura->fechaFacturacion="";
            die($DetalleFactura);
            return;
         /*    $objClienteProducto=new ClienteProducto();
            $ObjEstudiante->fk_usuario=$ObjUsuario->id;
            return;
            $ObjEstudiante->fk_usuario=$ObjUsuario->id;
            $ObjEstudiante->nombre=$datos["nombre"];
            $ObjEstudiante->apellido=$datos["apellido"];
            $ObjEstudiante->cedula=$datos["cedula"];
            $ObjEstudiante->telefono=$datos["telefono"];
            $ObjEstudiante->genero=$datos["genero"];
            $ObjEstudiante->fecha_nacimiento=$datos["fecha_nacimiento"];
            $ObjEstudiante->direccion_domicilio=$datos["direccion_domicilio"];
            $ObjEstudiante->observaciones=$datos["observaciones"];
            $ObjEstudiante->external_es="Es".Utilidades\UUID::v4();
            $ObjEstudiante->estado=$datos["estado"];
            $ObjEstudiante->save(); */
            die("TODO CON EXITO PRODUCTO ENTREGADO");
            return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=TRUE');


        } catch (\Throwable $th) {
            return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=FALSE&sms='.$th->getMessage());
        }

    }
}
