<?php

namespace App\Http\Controllers;
use App\Traits\Encriptar;
use App\Traits\TemplateCorreoNotificacion;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteProducto;
use App\Models\DetalleFactura;
use App\Models\Proveedor;
use PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;
use App\Traits\PaypalBootstrap;
use COM;

class ClienteProductoController extends Controller{
    use Encriptar;
    use PaypalBootstrap;
    use TemplateCorreoNotificacion;
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
            //pago no aprobado
            if($result->state != "approved") {
                return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=FALSE&sms='.$result->state);
            }


            //activamos el estado de la factura para que esten activos
            $objDetalleFactura=DetalleFactura::where("id",$request['idFactura'])->
                            update(array(
                                    "estado"=>1
                                ));
            //enviar notificacion de compra exitosa al correo del cliente

            if(!$objDetalleFactura==TRUE){
                $sms="NO SE PUDO ACTULIZAR EL ESTADO DE SU FACTURA, PARA MAS INFORMACIÓN CONTACTESE CON LATINEDIT";
                return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=FALSE&sms='.$sms);
            }
            $idClienteDesencriptado=$this->desencriptarCliete($request['idCliente']);
            $usuarioCliente=Cliente::where('id',$idClienteDesencriptado)->first();
            //prepara la factura
            $facturaCorreo=$this->templateFacturaPaypalProductos($request['idFactura']);
            //enviar al cliente
            $this->enviarCorreo($facturaCorreo,$usuarioCliente->correo,"CONFIRMACIÓN DE COMPRA LATINEDIT.COM");
            //enviar al administrador
            $this->enviarCorreo($facturaCorreo,getenv("CORREO_ADMIN"),"CONFIRMACIÓN DE COMPRA LATINEDIT.COM");
            return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=TRUE');


        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect(getenv("DOMINIO_WEB").'/resultado.php?estado=FALSE&sms='.$th->getMessage());
        }

    }
}
