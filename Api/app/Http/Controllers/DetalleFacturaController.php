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
                                   ->setCancelUrl(getenv("DOMINIO_WEB")."/resultado.php?estado=FALSE&idpago{$ID_registro}");
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

    //crear factura para dataFast
    public function crearFacturaProductosDataFast(Request $request,$idCliente){

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
            $sumaTotalCancelar=0;
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
                $sumaTotalCancelar=(double)$auxProductos[$key]['precio']+$sumaTotalCancelar;
            }
            $formCliente=($request->json()->all())['formCliente'];
            //extraigo el primer
            $formCliente=$formCliente[0];
            $ultimoRegistroFactura=DetalleFactura::latest()->select('id')->limit(1)->first();
            $datosFactura=array(
                'amount'=>$sumaTotalCancelar,
                'currency'=>'USD',
                'paymentType'=>'DB',
                'customer_givenName'=>$formCliente['nombre'],
                'customer_middleName'=>'',
                'customer_surname'=>$formCliente['apellido'],
                'customer_ip'=>$formCliente['ipCliente'],
                'customer_merchantCustomerId'=>$idDesencriptado,
                'merchantTransactionId'=>'trsaction_'.($ultimoRegistroFactura->id+1),
                'customer_email'=>$formCliente['correoFacturacion'],
                'customer_identificationDocType'=>'IDCARD',
                'customer_identificationDocId'=>$formCliente['documentoIdentidad'],
                'customer_phone'=>$formCliente['telefono'],
                'billing_street1'=>'Direcion del cliente los rosales',
                'billing_country'=>'EC',
                'billing_postcode'=>'003',
                'shipping_street1'=>'EN peru es la entrega',
                'shipping_country'=>'PE',
                'risk_parameters_USER_DATA2'=>'LATINEDIT',
                'customParameters_SHOPPER_MID'=>'1000000505',
                'customParameters_SHOPPER_TID'=>'PD100406',
                'customParameters_SHOPPER_ECI'=>'0103910',
                'customParameters_SHOPPER_PSERV'=>'17913101',
                'customParameters_SHOPPER_VAL_BASE0'=>5,
                'customParameters_SHOPPER_VAL_BASEIMP'=>0,
                'customParameters_SHOPPER_VAL_IVA'=>0,
            );
            return $datosFactura;
            $item=[
                [ 'id'=>1,'product_name'=>'Traicinera- Javito.mp3',
                    'product_price'=>2,'quantity'=>1],

                [ 'id'=>2,'product_name'=>'Gerardo moral- Antony Sanchez.mp3','product_price'=>1,'quantity'=>1],
                    ['id'=>3,'product_name'=>'Farruko - Daddy Yanke.mp3','product_price'=>2,'quantity'=>1]
            ];
            $url = "https://test.oppwa.com/v1/checkouts";
            $data = "entityId=8ac7a4ca7af1cb93017af38fb8da0afe".
            "&amount=".$datos['amount'].
            "&currency=".$datos['currency'].
            "&paymentType=".$datos['paymentType'].
            "&customer.givenName=".$datos['customer_givenName'].
            "&customer.middleName=".$datos['customer_middleName'].
            "&customer.surname=".$datos['customer_surname'].
            "&customer.ip=".$datos['customer_ip'].
            "&customer.merchantCustomerId=".$datos['customer_merchantCustomerId'].
            "&merchantTransactionId=".$datos['merchantTransactionId'].
            "&customer.email=".$datos['customer_email'].
            "&customer.identificationDocType=".$datos['customer_identificationDocType'].
            "&customer.identificationDocId=".$datos['customer_identificationDocId'].
            "&customer.phone=".$datos['customer_phone'].
            "&billing.street1=".$datos['billing_street1'].
            "&billing.country=".$datos['billing_country'].
            "&billing.postcode=".$datos['billing_postcode'].
            "&shipping.street1=".$datos['shipping_street1'].
            "&shipping.country=".$datos['shipping_country'].
            "&risk.parameters[USER_DATA2]=".$datos['risk_parameters_USER_DATA2'].
            "&customParameters[SHOPPER_MID]=".$datos['customParameters_SHOPPER_MID'].
            "&customParameters[SHOPPER_TID]=".$datos['customParameters_SHOPPER_TID'].
            "&customParameters[SHOPPER_ECI]=".$datos['customParameters_SHOPPER_ECI'].
            "&customParameters[SHOPPER_PSERV]=".$datos['customParameters_SHOPPER_PSERV'].
            "&customParameters[SHOPPER_VAL_BASE0]=".$datos['customParameters_SHOPPER_VAL_BASE0'].
            "&customParameters[SHOPPER_VAL_BASEIMP]=".$datos['customParameters_SHOPPER_VAL_BASEIMP'].
            "&customParameters[SHOPPER_VAL_IVA]=".$datos['customParameters_SHOPPER_VAL_IVA'];
            foreach ($productos as $key => $value) {

                $data.="&cart.items[".$key."].name=".$value['product_name'];
                $data.="&cart.items[".$key."].description="."Descripcion: ".$value['product_name'];
                $data.="&cart.items[".$key."].price=".$value['product_price'];
                $data.="&cart.items[".$key."].quantity=".$value['quantity'];
            }
            $data.="&customParameters[SHOPPER_VERSIONDF]=2";
            $data.="&testMode=EXTERNAL";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             'Authorization:Bearer
             OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
            return curl_error($ch);
            }
            curl_close($ch);
            print_r($responseData);
            return TRUE;

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
