<?php
require_once "vendor/autoload.php";
$parser = new Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('../../../../uploads/2019/04/NewRulesForCybersecurity.pdf');
$text = $pdf->getText();
echo $text;//all text from mypdf.pdf
?>