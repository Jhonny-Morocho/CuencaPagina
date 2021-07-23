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

  $resourcePath=$_GET['resourcePath'];
  $entityId=$_GET['id'];




  function request() {
    $url = "https://test.oppwa.com/".$_GET['resourcePath'];
    $url .= "?entityId=8a829418533cf31d01533d06f2ee06fa";
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

    print_r($responseData);
    return $responseData;
 }
 request();


?>