<?php

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRemisionNote extends CI_Controller {

	public function __construct(){
	parent::__construct();
	$this->load->helper('form');
	$this->load->model('reportes/mremisionnote');
	
	}
	
	public function index(){
		$this->load->view('reportes/generarpdf');
	}
	
	
	public function generarPDF(){		
		$this->load->library('pdf');
		
		$id_remision = $this->input->post('id_remision');
		
		//obtener resultado de la query 
		$resul['resultado'] = $this->mremisionnote->getValues($id_remision);
		
		if($resul['resultado'] != null){
			$remi_data=$resul['resultado']->first_row();
			$remi_nombre_data = $remi_data->nombre_cliente;
			$remi_dir_data = $remi_data->calle.' ext. #'.$remi_data->numero_ext.' int. #'.$remi_data->numero_int;
			$remi_mun_data = $remi_data->municipio.', '.$remi_data->nombre_estado;
			$remi_tp_data = $remi_data->nombre_tipoPago;
			$remi_usr_data = $remi_data->nombre_usuario;
			$remi_suc_data = $remi_data->nombre_sucursal;
			$remi_fecha_data = $remi_data->fecha;
			$subtotal= $remi_data->subtotal;
			$iva= $remi_data->iva;
			$total= $remi_data->total;
		}
		
		list($año, $mes, $dia) = preg_split('/[: -]/', $remi_fecha_data);
		
		// create new PDF document
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Solaris de México');
		$pdf->SetTitle('Remisión');
		$pdf->SetSubject('Remisión');
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
		
		//fecha cabecera
		$pdf->MultiCell(110, 0, '', 0, 'C',0,0);
		$pdf->MultiCell(20, 0, 'Dia', 1, 'C',0,0);
		$pdf->MultiCell(30, 0, 'Mes', 1, 'C',0,0);
		$pdf->MultiCell(20, 0, 'Año', 1, 'C',0,1);
		//fecha cuerpo
		$pdf->MultiCell(110, 0, '', 0, 'C',0,0);
		$pdf->MultiCell(20, 10, $dia, 1, 'C',0,0);
		$pdf->MultiCell(30, 10, $mes, 1, 'C',0,0);
		$pdf->MultiCell(20, 10, $año, 1, 'C',0,1);
		//numero de nota
		$pdf->MultiCell(110, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(70, 10, 'No.', 1, 'L',0,1);
		$pdf->Ln(5);
		
		// test Cell stretching
		$pdf->Cell(0, 10, 'Sr.(es): '.$remi_nombre_data, 1, 1, 'L', 0, '', 0);
		$pdf->Cell(0, 10, 'Dirección: '.$remi_dir_data, 1, 1, 'L', 0, '', 0);
		$pdf->Cell(0, 10, 'Ciudad: '.$remi_mun_data, 1, 1, 'L', 0, '', 0);	
		$pdf->Cell(0, 10, 'Tipo de Pago: '.$remi_tp_data, 1, 1, 'L', 0, '', 0);	
		$pdf->Ln(5);
		
		$pdf->MultiCell(90, 10, 'Sucursal: '.$remi_suc_data, 0, 'L',0,0);
		$pdf->MultiCell(90, 10, 'Usuario: '.$remi_usr_data, 0, 'L',0,1);
		$pdf->Ln(5);
		
		//headers
		$pdf->MultiCell(30, 10, 'CANTIDAD: ', 1, 'C',0,0);
		$pdf->MultiCell(90, 10, 'ARTICULO: ', 1, 'C',0,0);
		$pdf->MultiCell(30, 10, 'PRECIO: ', 1, 'C',0,0);
		$pdf->MultiCell(30, 10, 'IMPORTE: ', 1, 'C',0,1);
		
		//table
		foreach($resul['resultado']->result() as $value){
			$pdf->MultiCell(30, 7, $value->cantidad, 1, 'C',0,0);
			$pdf->MultiCell(90, 7, $value->nombre_producto, 1, 'C',0,0);
			$pdf->MultiCell(20, 7, $value->precio_actual, 1, 'C',0,0);
			$pdf->MultiCell(10, 7, '', 1, 'C',0,0);
			$pdf->MultiCell(20, 7, $value->importe, 1, 'C',0,0);
			$pdf->MultiCell(10, 7, '', 1, 'C',0,1);
		}
		
		$datos = array('SUBTOTAL $','I.V.A. %','TOTAL $');
		$values = array($subtotal,$iva,$total);
		$i = 0;
		foreach($datos as $dato){
			$pdf->MultiCell(120, 7, '', 0, 'C',0,0);
			$pdf->MultiCell(30, 7, $dato, 1, 'C',0,0);
			$pdf->MultiCell(20, 7, $values[$i++], 1, 'C',0,0);
			$pdf->MultiCell(10, 7, '', 1, 'C',0,1);
		}


		//Close and output PDF document
		$pdf->Output('nota_remision.pdf', 'I');
		
		//============================================================+
		// END OF FILE
		//============================================================+
	}

} ?>