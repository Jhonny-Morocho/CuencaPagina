<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteProducto;
use App\Models\DetalleFactura;
use Illuminate\Http\Request;
use App\Traits\PaypalBootstrap;
use App\Traits\Encriptar;
use App\Models\Producto;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use Illuminate\Support\Facades\Crypt;
class DetalleFacturaController extends Controller{
    use Encriptar;
    use PaypalBootstrap;
    public function crearFacturaProductosPaypal(Request $request,$idCliente){
        //creamos la factura
        try {

            if(!($request->json())){
                return response()->json(["sms"=>"La data no tiene el formato requerido","Siglas"=>"ONE",'res'=>null]);
            }
            //verificar si el id del usuario existe
            $idDesencriptado=$this->desencriptarCliente($idCliente);
            $existesUsuario=Cliente::where("id",$idDesencriptado)->first();
            if(!$existesUsuario){
                return response()->json(["sms"=>"El usuario ".$idCliente." no existe en la base de datos","Siglas"=>"ONE",'res'=>null]);
            }
            $productos=($request->json()->all())['productos'];
            $auxProductos=[];
            foreach ($productos as $key => $value) {
                $desencriptado=$this->desencriptar($value['idProducto']);
                $bdProducto=Producto::where('id', $desencriptado)->first();
                if(!$bdProducto){
                    return response()->json(["sms"=>"El producto ".$value['nombreProducto']." con el identificador ".$productos[$key]['idProducto']." no ha sido encontrado","Siglas"=>"ONE",'res'=>null]);
                }
                //desencripto los productos
                $auxProductos[$key]['idProducto']=$bdProducto->id;
                $auxProductos[$key]['nombreProducto']=$value['nombreProducto'];
                $auxProductos[$key]['precio']=$value['precio'];
            }
            //enviamos los datos a la api de paypal
            $ObjPayerCompra=new Payer();
            $ObjPayerCompra->setPaymentMethod('paypal');
            $arregloProductos=array();
            $descripcionProducto="Producto";
            $sumaTotalCancelar=0;
            foreach ($auxProductos as  $key => $value) {
                ${"articulo$key"}=new Item();
                $arregloProductos[]=${"articulo$key"};

                ${"articulo$key"}->setName($descripcionProducto.' : '.$auxProductos[$key]['nombreProducto'])//el i lleva el nombre de la cancion
                                ->setCurrency('USD')//la moneda a cobrar
                                ->setQuantity((int)1)//siempre la cancion va hacer (1)
                                ->setSku($auxProductos[$key]['idProducto'])
                                ->setPrice((double)$auxProductos[$key]['precio'] );//precio de la cancion

                            $sumaTotalCancelar=(double)$auxProductos[$key]['precio']+$sumaTotalCancelar;
            }

            $listaArticulos=new ItemList();
            $listaArticulos->setItems($arregloProductos);

            $cantidad=new Amount();
            $cantidad->setCurrency('USD')
                    ->setTotal((double)$sumaTotalCancelar);//total a pagar con 3 producto(2 cancio9n y un boton)


             //=================caractersiticas de la transaccion=============
             $transaccion= new Transaction();
             $transaccion->setAmount($cantidad)
                         ->setItemList($listaArticulos)
                         ->setDescription('LatinEdit.com')
                         ->setInvoiceNumber(uniqid()); //registro numero unico de esa trasaccion
             $ID_registro=$transaccion->getInvoiceNumber();

            //crear factura
            $formCliente=($request->json()->all())['formCliente'];
            $arrayFormCliente=array("productos"=>$auxProductos,
                                    'idTrasanccion'=>$ID_registro,
                                    "formCliente"=>$formCliente);
            $objFactura=new DetalleFactura();
            $objFactura->totalCancelar=$sumaTotalCancelar;
            $objFactura->idCliente=$idDesencriptado;
            $objFactura->estado=0;
            $objFactura->metodoPago="Paypal";
            $objFactura->formFactura=json_encode($arrayFormCliente);
            $objFactura->save();

            //cliente producto
            foreach ($auxProductos as $key => $value) {
                $objClienteProducto=new ClienteProducto();
                $objClienteProducto->idCliente=$idDesencriptado;
                $objClienteProducto->idProducto =$value['idProducto'];
                $objClienteProducto->idFactura=$objFactura->id;
                $objClienteProducto->metodoCompra="Paypal";
                $objClienteProducto->precioCompra=$value['precio'];;
                $objClienteProducto->estadoPagoProveedor=0;
                $objClienteProducto->save();
            }


             //ruta para realizar el pago
             $rutaPago=new RedirectUrls();
             $rutaDeConfirmacionPago=getenv("DOMINIO_WEB")."/Api/public/index.php/clienteProducto/compraPaypal/?idFactura=".$objFactura->id."&idCliente=".$idCliente;
             $rutaPago->setReturnUrl($rutaDeConfirmacionPago)//pago exitoso
                                   ->setCancelUrl(getenv("DOMINIO_WEB")."/resultado.php?estado=false&idpago{$ID_registro}");
             //redireccionar a la pagina de paypal
             $pago=new Payment();
             $pago->setIntent("sale")
                 ->setPayer($ObjPayerCompra)
                 ->setRedirectUrls($rutaPago)
                 ->setTransactions(array($transaccion));
             $pago->create($this->modoDev());
             $aprobado=$pago->getApprovalLink();
             $respuesta=array('urlPaypal'=>$aprobado,
                                 'idTrasanccion'=>$ID_registro,
                                 'total'=>$sumaTotalCancelar);
            return response()->json(["sms"=>"Operación exitosa","Siglas"=>"OE",'res'=>$respuesta]);

        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ONE",'res'=>null]);
        }
    }
    public function listarFacturaCliente($idCliente){
        try {
            $idClienteDesencriptado=$this->desencriptarCliente($idCliente);
            //1.Preguntamos si existe el usuario
            $existeUsuario=Cliente::where('id',$idClienteDesencriptado)->where('estado',1)->first();
            if(!$existeUsuario){
                return response()->json(["sms"=>"El usuario ".$idCliente." no ha sido encontrado","Siglas"=>"UNE"]);
            }
            //cliente factura
            $detalleFactura=DetalleFactura::where("detalle_factura.idCliente",$idClienteDesencriptado)->get();
            return response()->json(["sms"=>'Operación exitosa',"Siglas"=>"OE",'res'=>$detalleFactura]);

        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ERROR"]);
        }

    }
}
