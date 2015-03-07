<?php
session_start();
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMensual extends CI_Controller {

	public function __construct(){
	parent::__construct();
	$this->load->helper('form');
	$this->load->helper('pagina');
	$this->load->model('reportes/mmensual');
	
	}
	
	public function formMensual(){
		$this->load->view('reportes/vmensual');
	}
	
	public function reporteVacio(){
		$fecha_inicial =(String) $this->input->post('fecha_ini');
		$fecha_final = (String)$this->input->post('fecha_fin');
		
		//obtener resultado de la query 
		$resul['resultado'] = $this->mmensual->getValues($fecha_inicial,$fecha_final);
		
		if($resul['resultado']!=false){
			echo 'FALSE';
		}else{
			echo 'TRUE';
		}
		
	}
	
	public function reporteMensual(){		
		$this->load->library('pdf');
		
		$fecha_inicial =(String) $this->input->post('fecha_ini');
		$fecha_final = (String)$this->input->post('fecha_fin');

		
		//obtener resultado de la query 
		$resul['resultado'] = $this->mmensual->getValues($fecha_inicial,$fecha_final);
		$cantidad_data=0;
		$total_data=0;
		if($resul['resultado']!=false){
			foreach($resul['resultado']->result() as $value){
				$total_data+=$value->total;
				$cantidad_data++;
			}
		}
		

		// create new PDF document
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Solaris de México');
		$pdf->SetTitle('Reporte Mensual');
		$pdf->SetSubject('Reporte Mensual');
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
		$pdf->MultiCell(15, 10, '#', 1, 'C',0,0);
		$pdf->MultiCell(20, 10, 'IMPORTE', 1, 'C',0,0);
		$pdf->MultiCell(40, 10, 'CLIENTE', 1, 'C',0,0);
		$pdf->MultiCell(35, 10, 'SUCURSAL', 1, 'C',0,0);
		$pdf->MultiCell(35, 10, 'USUARIO', 1, 'C',0,0);
		$pdf->MultiCell(35, 10, 'FECHA', 1, 'C',0,1);
		
		//table
		foreach($resul['resultado']->result() as $value){
			$pdf->MultiCell(15, 10, $value->id_remision, 1, 'L',0,0);
			$pdf->MultiCell(20, 10, $value->total, 1, 'L',0,0);
			$pdf->MultiCell(40, 10, $value->nombre_cliente, 1, 'L',0,0);
			$pdf->MultiCell(35, 10, $value->nombre_sucursal, 1, 'L',0,0);
			$pdf->MultiCell(35, 10, $value->nombre_usuario, 1, 'L',0,0);
			$pdf->MultiCell(35, 10, $value->fecha, 1, 'L',0,1);
			
		}
		
		$pdf->MultiCell(30, 10, 'CANTIDAD DE VENTAS', 1, 'C',0,0);	
		$pdf->MultiCell(20, 10, $cantidad_data, 1, 'C',0,1);	
		$pdf->MultiCell(30, 10, 'TOTAL $', 1, 'C',0,0);		
		$pdf->MultiCell(20, 10, $total_data, 1, 'C',0,1);

		//Close and output PDF document
		$pdf->Output('reporte_mensual.pdf', 'I');
		
		//============================================================+
		// END OF FILE
		//============================================================+
	}

} ?>