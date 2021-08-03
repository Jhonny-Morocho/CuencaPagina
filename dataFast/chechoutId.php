<?php
$datos=array(
    'amount'=>5,
    'currency'=>'USD',
    'paymentType'=>'DB',
    'customer.givenName'=>'Jhonny',
    'customer.middleName'=>'Michael',
    'customer.surname'=>'Morocho',
    'customer.ip'=>'192.10.10.10',
    'customer.merchantCustomerId'=>9,
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
    'customParameters_SHOPPER_VAL_BASE0'=>5,
    'customParameters_SHOPPER_VAL_BASEIMP'=>0,
    'customParameters_SHOPPER_VAL_IVA'=>0,
  );

  $item=[
     [ 'id'=>1,'product_name'=>'Traicinera- Javito.mp3',
        'product_price'=>2,'quantity'=>1],

     [ 'id'=>2,'product_name'=>'Gerardo moral- Antony Sanchez.mp3','product_price'=>1,'quantity'=>1],
      ['id'=>3,'product_name'=>'Farruko - Daddy Yanke.mp3','product_price'=>2,'quantity'=>1]
      ]
  ;
 
  function request($datos,$productos) {
    $url = "https://test.oppwa.com/v1/checkouts";
    $data = "entityId=8ac7a4ca7af1cb93017af38fb8da0afe".
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
    return $responseData;
 }
 request($datos,$item);
?>

