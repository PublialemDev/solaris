<?php

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CReportSeguimiento extends CI_Controller {

	public function __construct(){
	parent::__construct();
	$this->load->helper('form');
	$this->load->model('reportes/mreportseguimiento');
	
	}
	
	public function index(){
		
	}
	
	
	public function reporteSeguimiento(){		
		$this->load->library('pdf');
		
		$id_cliente =$this->input->post('id_cliente');
		
		//obtener resultado de la query 
		$resul['resultado'] = $this->mreportseguimiento->getValues($id_cliente);
		

		// create new PDF document
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Solaris de México');
		$pdf->SetTitle('Reporte Seguimiento Clientes');
		$pdf->SetSubject('Reporte Seguimiento Clientes');
		$pdf->SetKeywords('TCPDF, PDF, remision');
		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		
		// ---------------------------------------------------------
		
		// set font
		$pdf->SetFont('times', '', 11);
		
		// add a page
		$pdf->AddPage();
		
		//headers
		$pdf->MultiCell(40, 10, 'CLIENTE', 1, 'C',0,0);
		$pdf->MultiCell(60, 10, 'COMENTARIO', 1, 'C',0,0);
		$pdf->MultiCell(40, 10, 'FECHA', 1, 'C',0,0);
		$pdf->MultiCell(40, 10, 'CATEGORIA', 1, 'C',0,1);

		
		//table
		foreach($resul['resultado']->result() as $value){
			$pdf->MultiCell(40, 10, $value->nombre_cliente, 1, 'L',0,0);
			$pdf->MultiCell(60, 10, $value->comentario, 1, 'L',0,0);
			$pdf->MultiCell(40, 10, $value->fecha, 1, 'L',0,0);
			$pdf->MultiCell(40, 10, $value->nombre_categoriaSeguimiento, 1, 'L',0,1);
	
			
		}

		//Close and output PDF document
		$pdf->Output('reporte_seguimiento.pdf', 'I');
		
		//============================================================+
		// END OF FILE
		//============================================================+
	}

} ?>