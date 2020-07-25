<?php 
    require __DIR__ .'/vendor/autoload.php';
    use PayPal\Rest\ApiContex;
    use PayPal\Auth\OAuthTokenCredential;
   

    
	


    
    $modDev = true;//false para q este en modo real

    if($modDev) {

    	define('URL_SITIO','http://localhost/CuencaPagina');
        
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                    'AU9i9nbVJv4j1pf-AytaMqSWw_5jXXpfKZSccADUMF5w86gHangspAt7vDmqG5sPECRhemYWRvNioxwP',
                    'EHFOIpNnimC4lbSyhPMPe8MuUaRmmpoM27hjWY_5p4WLcFco-HkLuXgNZFH3neXL9snHF2ZsS0wNVsyN'
                )
        );

        $apiContext->setConfig(
            array(
                    'mode' => 'sandbox',
                    'log.LogEnabled' => true,
                    'log.FileName' => 'PayPal.log',
                    'log.LogLevel' => 'DEBUG'
                )
        );

    } else {

    	define('URL_SITIO','http://latinedit.com');
	 	
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                    'ARIq1R0UM6r98VPIpCiLOgz8UB4vlLX_Y9XJS9k_6lqJWQlErzqGIjBxvsmR0pP2iEIvtOaosBuonZjQ',
                    'ELSyoQp5HTnfMhkD-JKzsciR2x8JjIiahVs1uz4VugTKX6L6g7XJzpo8lCGXzVLTeDGLPuclyElEPaFN'
                )
        );

        $apiContext->setConfig(
            array(
                    'mode' => 'live',
                    'log.LogEnabled' => true,
                    'log.FileName' => 'PayPal.log',
                    'log.LogLevel' => 'DEBUG'
                )
        );
    }

 ?>