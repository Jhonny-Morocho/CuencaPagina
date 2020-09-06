<?php

require_once'vendor/autoload.php';
require_once'plantillaReporte/plantilla.php';
$css=file_get_contents('plantillaReporte/style.css');

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML(ClassPlantilla::funcionPlantilla(),\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();

?>