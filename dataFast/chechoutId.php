<?php
$datos=array(
    'amount'=>5,
    'currency'=>'USD',
    'paymentType'=>'DB',
    'customer_givenName'=>'Jhonny',
    'customer_middleName'=>'Michael',
    'customer_surname'=>'Morocho',
    'customer_ip'=>'192.10.10.10',
    'customer_merchantCustomerId'=>9,
    'merchantTransactionId'=>'trsaction_'.'05111',
    'customer_email'=>'jhonnymichaeldj2011@hotmail.com',
    'customer_identificationDocType'=>'IDCARD',
    'customer_identificationDocId'=>'1105116899',
    'customer_phone'=>'0998202201',
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
    return $responseData;
 }
 request($datos,$item);
?>

