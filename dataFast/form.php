<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script  src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=CE5B2096FF0968C1702090E21F1A4275.uat01-vm-tx03"></script> 
    
    <form  action="http://localhost:81/CuencaPagina/dataFast/finalizado.php" class="paymentWidgets" data-brands="VISA MASTER AMEX" target="alt" >

    </form>
    <ul>
        <li>
            card Number: 4200 0000 0000 0000
        </li>
        <li>
            card holder: Su Empresa
        </li>
        <li>
            Expiry Date: 12/22
        </li>
        <li>
            CVV: 123
        </li>
    </ul>
</body>
</html>

<style>
    form {
        width: 500px;
        height: 500px;
        background-color: red;

    }
</style>