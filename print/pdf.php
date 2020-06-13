<?php
require 'pdfcrowd.php';

try
{
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("assiAkram", "6f61b219957f9538e5c701372be3ca91");

    // run the conversion and write the result to a file
    $pdf = $client->convertUrl("http://cmms.epizy.com/print/print.php?plate={$_GET['plate']}");
    header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"created.pdf\"");
    echo $pdf;

}
catch(\Pdfcrowd\Error $why)
{
    // report the error
error_log("Pdfcrowd Error: {$why}\n");

    // rethrow or handle the exception
    throw $why;
}

?>