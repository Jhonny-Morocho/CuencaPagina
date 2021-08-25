<?php
namespace App\Traits;

trait PaypalBootstrap {
    public function modoDev(){
        $modDev = true;//false para q este en modo real
        if($modDev) {

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
            return $apiContext;


        }
        $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                        'ARIq1R0UM6r98VPIpCiLOgz8UB4vlLX_Y9XJS9k_6lqJWQlErzqGIjBxvsmR0pP2iEIvtOaosBuonZjQ',
                        'ELSyoQp5HTnfMhkD-JKzsciR2x8JjIiahVs1uz4VugTKX6L6g7XJzpo8lCGXzVLTeDGLPuclyElEPaFN'
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
        return $apiContext;
    }

}
