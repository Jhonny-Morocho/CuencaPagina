<?php

namespace App\Http\Controllers;
use PayPal\Rest\ApiContex;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Http\Request;
use App\Traits\PaypalBootstrap;
use App\Traits\Encriptar;
use App\Models\Producto;
use JsonSchema\Uri\Retrievers\Curl;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;

//require __DIR__ .'/bootstrap.php';
class Paypal extends Controller{
    use Encriptar;
    use PaypalBootstrap;

    public function productosPaypal(Request $request){
        try {
            if(!($request->json())){
                return response()->json(["sms"=>"La data no tiene el formato requerido","Siglas"=>"ONE",'res'=>null]);
            }
            //descincrpatar los productos
            $productos=$request->json()->all();
            $auxProductos=[];
            foreach ($productos as $key => $value) {
                $desencriptado=$this->desencriptar($productos[$key]['idProducto']);
                $bdProducto=Producto::where('id', $desencriptado)->first();
                if(!$bdProducto){
                    return response()->json(["sms"=>"El producto ".$productos[$key]['nombreProducto']." con el identificador ".$productos[$key]['idProducto']." no ha sido encontrado","Siglas"=>"ONE",'res'=>null]);
                }
                //desencripto los productos
                $auxProductos[$key]['idProducto']=$bdProducto->id;
                $auxProductos[$key]['nombreProducto']=$productos[$key]['nombreProducto'];
                $auxProductos[$key]['precio']=$productos[$key]['precio'];
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
            //ruta para realizar el pago
            $rutaPago=new RedirectUrls();
            $rutaPago->setReturnUrl(getenv("DOMINIO_WEB")."/Api/public/index.php/paypal/finalizarCompraProducto/")//pago exitoso
                                  ->setCancelUrl(getenv("DOMINIO_WEB")."/resultado.php?exito=false&idpago{$ID_registro}");
            //redireccionar a la pagina de paypal
            $pago=new Payment();
            $pago->setIntent("sale")
                ->setPayer($ObjPayerCompra)
                ->setRedirectUrls($rutaPago)
                ->setTransactions(array($transaccion));
            $pago->create($this->modoDev());
            $aprobado=$pago->getApprovalLink();
            $respuesta=array('urlPaypal'=>$aprobado,
                                'total'=>$sumaTotalCancelar);
            return response()->json(["sms"=>"Operación exitosa","Siglas"=>"OE",'res'=>$respuesta]);

        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ONE",'res'=>null]);
        }
    }
    public function finalizarCompraProducto(Request $request){


        if(!isset($request['paymentId']) && !isset($request['PayerID']) ){
            //return redirect('http://localhost/CuencaPagina/resultado.php?estado=false&error');
            die("todo mal ");
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
             //var_dump($result);

            if($result->state != "approved") {
            // redirrecciona a una pagina de 'error'
            //echo '<script>window.location ="../resultado.php?estado=false"; </script>';

            die("PAGO NO APROBADO");

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

            //header("Location:../resultado.php?estado=false");
            die("TODO CON EXITO PRODUCTO ENTREGADO");
            return redirect('http://localhost/CuencaPagina/resultado.php?estado=TRUE');


        } catch (\Throwable $th) {
            return response()->json(["sms"=>$th->getMessage(),"Siglas"=>"ONE",'res'=>null]);
        }

    }
    public function paypal(){
        echo "2;xx";

    }
}
