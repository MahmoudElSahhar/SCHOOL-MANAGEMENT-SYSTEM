<?php
include "TCPDFLibrary/tcpdf.php";

class PDF_Generator
{
    public $HTML;

    public function __construct($HTML)
    {
        $this->HTML = $HTML;
    }

    public function Generate()
    {
         //Make TCPDF object
         $pdf = new TCPDF('P', 'mm', 'A4');

         //remove defaut header and footer because by default the are set to true
         $pdf->setPrintHeader(false);
         $pdf->setPrintHeader(false);

         //add page
         $pdf->AddPage();

         //add content
         //using cell
         //$pdf->Cell(190, 10, "this is a cell", 1, 1, 'C');

         //using html cell
         $pdf->writeHTML("<html>".$this->HTML."</html>", true, 0, true, 0);

         //output
         ob_clean();
         $pdf->Output();

         //save the file automatically when opening the page
         //$pdf->Output('saved', 'D');
    }
}
?>