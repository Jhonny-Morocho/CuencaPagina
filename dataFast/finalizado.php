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

  //var_dump('GET');
  function request(){
    $url = "https://test.oppwa.com/v1/checkouts/".$_GET['id']."/payment";
    $url.="?entityId=8ac7a4ca7af1cb93017af38fb8da0afe";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
     'Authorization:Bearer 
     OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if(curl_errno($ch)) {
    return curl_error($ch);
    }
    print_r($responseData);
    return $responseData;
  }
  request();
?>