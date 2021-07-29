<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    PAGO FINALIZADO
</body>
</html>

<?php

echo "<pre>";
var_dump($_GET);
echo "</pre>";

/* array(2) {
    ["id"]=>
    string(46) "3E8D1A2D28DAB86CA08DC75BC29DA922.uat01-vm-tx01"
    ["resourcePath"]=>
    string(68) "/v1/checkouts/3E8D1A2D28DAB86CA08DC75BC29DA922.uat01-vm-tx01/payment"
  } */

  
  $datos=array(
    'amount'=>10,
    'currency'=>'USD',
    'paymentType'=>'DB',
    'customer.givenName'=>'Jhonny',
    'customer.middleName'=>'Michael',
    'customer.surname'=>'Morocho',
    'customer.ip'=>'192.10.10.10',
    'customer.merchantCustomerId'=>'9',
    'merchantTransactionId'=>'trsaction_'.'05111',
    'customer.email'=>'jhonnymichaeldj2011@hotmail.com',
    'customer.identificationDocType'=>'IDCARD',
    'customer.identificationDocId'=>'1105116899',
    'customer.phone'=>'0998202201',
    'billing.street1'=>'Direcion del cliente los rosales',
    'billing.country'=>'EC',
    'billing.postcode'=>'003',
    'shipping.street1'=>'EN peru es la entrega',
    'shipping.country'=>'PE',
    'risk.parameters_USER_DATA2'=>'LATINEDIT',
    'customParameters_SHOPPER_MID'=>'100000505',
    'customParameters_SHOPPER_TID'=>'PD100406',
    'customParameters_SHOPPER_ECI'=>'0103910',
    'customParameters_SHOPPER_PSERV'=>'17913101',
    'customParameters_SHOPPER_VAL_BASE0'=>'10',
    'customParameters_SHOPPER_VAL_BASEIMP'=>'0',
    'customParameters_SHOPPER_VAL_IVA'=>'0',
  );

  $item=[
     [ 'id'=>1,'product_name'=>'Traicinera- Javito.mp3',
        'product_price'=>2,'quantity'=>1],

     [ 'id'=>2,'product_name'=>'Gerardo moral- Antony Sanchez.mp3','product_price'=>3,'quantity'=>1],
      ['id'=>3,'product_name'=>'Farruko - Daddy Yanke.mp3','product_price'=>1,'quantity'=>1]
      ]
  ;
    echo $_GET['resourcePath'];
    echo "<br>";
    echo "<br>";
  function request($datos,$productos) {
    $url = "https://test.oppwa.com/v1/checkouts";
    $data = "entityId=8a829418533cf31d01533d06f2ee06fa".
    "&amount=".$datos['amount'].
    "&currency=".$datos['currency'].
    "&paymentType=".$datos['paymentType'].
    "&customer.givenName=".$datos['customer.givenName'].
    "&customer.middleName=".$datos['customer.middleName'].
    "&customer.surname=".$datos['customer.surname'].
    "&customer.ip=".$datos['customer.ip'].
    "&customer.merchantCustomerId=".$datos['customer.merchantCustomerId'].
    "&merchantTransactionId=".$datos['merchantTransactionId'].
    "&customer.email=".$datos['customer.email'].
    "&customer.identificationDocType=".$datos['customer.identificationDocType'].
    "&customer.identificationDocId=".$datos['customer.identificationDocId'].
    "&customer.phone=".$datos['customer.phone'].
    "&billing.street1=".$datos['billing.street1'].
    "&billing.country=".$datos['billing.country'].
    "&billing.postcode=".$datos['billing.postcode'].
    "&shipping.street1=".$datos['shipping.street1'].
    "&shipping.country=".$datos['shipping.country'].
    "&risk.parameters[USER_DATA2]=".$datos['risk.parameters_USER_DATA2'].
    "&customParameters[SHOPPER_MID]=".$datos['custom.Parameters_SHOPPER_MID'].
    "&customParameters[SHOPPER_TID]=".$datos['custom.Parameters_SHOPPER_TID'].
    "&customParameters[SHOPPER_ECI]=".$datos['custom.Parameters_SHOPPER_ECI'].
    "&customParameters[SHOPPER_PSERV]=".$datos['custom.Parameters_SHOPPER_PSERV'].
    "&customParameters[SHOPPER_VAL_BASE0]=".$datos['custom.Parameters_SHOPPER_VAL_BASE0'].
    "&customParameters[SHOPPER_VAL_BASEIMP]=".$datos['custom.Parameters_SHOPPER_VAL_BASEIMP'].
    "&customParameters[SHOPPER_VAL_IVA]=".$datos['custom.Parameters_SHOPPER_VAL_IVA'];
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
    OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA=='));
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
    return $responseData;
 }
 request($datos,$item);


?>