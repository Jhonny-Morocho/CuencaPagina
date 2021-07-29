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
    'customer.merchanCustomerId'=>'9',
    'merchanTransactionId'=>'trsaction_'.'05111',
    'customer.email'=>'jhonnymichaeldj2011@hotmail.com',
    'customer.identificationDocType'=>'IDCARD',
    'customer.identificationDocId'=>'1105116899',
    'customer.phone'=>'0998202201',
    'billing.street1'=>'Direcion del cliente los rosales',
    'billing.country'=>'EC',
    'billing.postcode'=>'003',
    'shipping.street1'=>'EN peru es la entrega',
    'shipping.country'=>'PE',
    'risk.parameters[USER_DATA2]'=>'LATINEDIT',
    'custon.Parameters[SHOPPER_MID]'=>'100000505',
    'custon.Parameters[SHOPPER_TID]'=>'PD100406',
    'custon.Parameters[SHOPPER_ECI]'=>'0103910',
    'custon.Parameters[SHOPPER_PSERV]'=>'17913101',
    'custon.Parameters[SHOPPER_VAL_BASE0]'=>'10',
    'custon.Parameters[SHOPPER_VAL_BASEIMP]'=>'0',
    'custon.Parameters[SHOPPER_VAL_IVA]'=>'0',
  );

  $item=[
     [ 'id'=>1,'product_name'=>'Traicinera- Javito.mp3','product_price'=>2,'quantity'=>1],
     [ 'id'=>2,'product_name'=>'Gerardo moral- Antony Sanchez.mp3','product_price'=>3,'quantity'=>1],
      ['id'=>3,'product_name'=>'Farruko - Daddy Yanke.mp3','product_price'=>1,'quantity'=>1]]
  ;


  function request($datos,$productos) {
    $url = "https://test.oppwa.com/".$_GET['resourcePath'];
    $url .= "?entityId=8a829418533cf31d01533d06f2ee06fa".
    "&amount=".$datos['amount'].
    "&currency=".$datos['currency'].
    "&paymentType=".$datos['paymentType'].
    "&customer.givenName=".$datos['customer.givenName'].
    "&customer.middleName=".$datos['customer.middleName'].
    "&customer.surname=".$datos['customer.surname'].
    "&customer.ip=".$datos['customer.ip'].
    "&customer.merchanCustomerId=".$datos['customer.merchanCustomerId'].
    "&merchanTransactionId=".$datos['merchanTransactionId'].
    "&customer.email=".$datos['customer.email'].
    "&customer.identificationDocType=".$datos['customer.identificationDocType'].
    "&customer.identificationDocId=".$datos['customer.identificationDocId'].
    "&customer.phone=".$datos['customer.phone'].
    "&billing.street1=".$datos['billing.street1'].
    "&billing.country=".$datos['billing.street1'].
    "&billing.postcode=".$datos['billing.postcode'].
    "&shipping.street1=".$datos['shipping.street1'].
    "&shipping.country=".$datos['shipping.country'].
    "&risk.parameters[USER_DATA2]=".$datos['risk.parameters[USER_DATA2]'].
    "&custon.Parameters[SHOPPER_MID]=".$datos['custon.Parameters[SHOPPER_MID]'].
    "&custon.Parameters[SHOPPER_TID]=".$datos['custon.Parameters[SHOPPER_TID]'].
    "&custon.Parameters[SHOPPER_ECI]=".$datos['custon.Parameters[SHOPPER_ECI]'].
    "&custon.Parameters[SHOPPER_PSERV]=".$datos['custon.Parameters[SHOPPER_PSERV]'].
    "&custon.Parameters[SHOPPER_VAL_BASE0]=".$datos['custon.Parameters[SHOPPER_VAL_BASE0]'].
    "&custon.Parameters[SHOPPER_VAL_BASEIMP]=".$datos['custon.Parameters[SHOPPER_VAL_BASEIMP]'].
    "&custon.Parameters[SHOPPER_VAL_IVA]=".$datos['custon.Parameters[SHOPPER_VAL_IVA]'];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
     'Authorization:Bearer 
    OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA=='));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if(curl_errno($ch)) {
    return curl_error($ch);
    }
    curl_close($ch);
    echo "<code>";
    var_dump(($responseData));
    echo "</code>";
    return $responseData;
 }
 request($datos,$item);


?>