<?php
function request() {
    $url = "https://test.oppwa.com/v1/checkouts";
    $data = 
     "entityId=8a829418533cf31d01533d06f2ee06fa" .
     "&amount=92.00" .
     "&currency=USD" .
     "&paymentType=DB";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
     'Authorization:Bearer 
    OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA=='));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if(curl_errno($ch)) {
    return curl_error($ch);
    }
  
    return $responseData;
}
$json=request();
echo $json;

?>

