<?php
use Dompdf\Dompdf;
class Barcode_pdf {
    function pdf($html, $filename){
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename, array('Attcahment' => 0));
    }
}
?>