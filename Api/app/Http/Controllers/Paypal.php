<?php

namespace App\Http\Controllers;
use PayPal\Rest\ApiContex;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Http\Request;
use App\Traits\Encriptar;
use App\Models\Producto;

 use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
//require __DIR__ .'/bootstrap.php';
class Paypal extends Controller
{   use Encriptar;
    public function productosPaypal(Request $request){
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
        $compra=new Payer();
        $compra->setPaymentMethod('paypal');
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
        print_r($arregloProductos);
        return;
        die(json_encode($arregloProductos));
        return;
        //echo "este son lo ids de los producto";
        //echo"<br>". $articulo0->getPrice();//nombre del tema selecionado
        $listaArticulos=new ItemList();
        $listaArticulos->setItems($arregloProductos);
        //print_r($listaArticulos->getItems());

        $cantidad=new Amount();
        $cantidad->setCurrency('USD')
                ->setTotal((double)$sumaTotalCancelar);//total a pagar con 3 producto(2 cancio9n y un boton)
        //print_r($cantidad-> getTotal());

        //=================caractersiticas de la trsaccion=============
        $transaccion= new Transaction();
        $transaccion->setAmount($cantidad)
                    ->setItemList($listaArticulos)
                    ->setDescription('LatinEdit.com')
                    ->setInvoiceNumber(uniqid()); //registro numero unico de esa trasaccion
                    //echo "este es unico".$transaccion->getInvoiceNumber();
                    $ID_registro=$transaccion->getInvoiceNumber();

    }
}
