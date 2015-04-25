<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 
class Pdf extends TCPDF{
	
    function __construct()
    {
        parent::__construct();
    }
	
	
    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo.png';
        $this->Image($image_file, 0, 5, 70, '', 'PNG', '', 'L', false, 300, '', false, false, 0, false, false, false);
		$image_file2 = K_PATH_IMAGES.'fb.png';
        $this->Image($image_file2, 160, 6, 40, '', 'PNG', '', 'R', false, 300, '', false, false, 0, false, false, false);
		
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->MultiCell(0,0, 'SOLARIS DE MÉXICO',0,'C', 0, 1);	
	 	$this->SetFont('helvetica', 'B', 13);	
		$this->MultiCell(0,0, 'CALENTADORES SOLARES',0,'C', 0, 1);	
	 	$this->SetFont('helvetica', 'B', 10);	
        $this->MultiCell(0,0, 'Tel. (55) 21571957 / (55) 56412732',0,'C', 0, 1);		
		$this->SetFont('helvetica', 'B', 10);	
        $this->MultiCell(0,0, 'www.solarisdemexico.com',0,'C', 0, 1);
		
				
    }

    // Page footer
    public function Footer() {
        /* Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');*/
    }	

}