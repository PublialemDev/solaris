<?php
session_start();
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRemisionNote extends CI_Controller {

	public function __construct(){
	parent::__construct();
	$this->load->helper('form');
	$this->load->helper('pagina');
	$this->load->model('reportes/mremisionnote');
	$this->load->model('remisiones/mremisiones');
	
	}
	
	public function formGenerarPDF(){
		$this->load->view('reportes/vremisionnote');
	}
	
	
	public function generarPDF(){		
		$this->load->library('pdf');
		
		$id_remision = $this->input->post('idRemision');
		$idUsuario = base64_decode($_SESSION['USUARIO_ID']);
		
		//obtener resultado de la query 
		$resul['resultado'] = $this->mremisionnote->getValues($id_remision,$idUsuario);
		
		if($resul['resultado'] != null){
			$remi_data=$resul['resultado']->first_row();
			$remi_nombre_data = $remi_data->nombre_cliente;
			$remi_dir_data = $remi_data->calle.' ext. #'.$remi_data->numero_ext.' int. #'.$remi_data->numero_int;
			$remi_mun_data = $remi_data->municipio.', '.$remi_data->nombre_estado;
			$remi_tp_data = $remi_data->nombre_tipoPago;
			$remi_usr_data = $remi_data->nombre_usuario;
			$remi_suc_data = $remi_data->nombre_sucursal;
			$remi_fecha_data = $remi_data->fecha;
			$subtotal= $remi_data->total;
			$iva= $remi_data->iva;
			$total= $remi_data->total+$remi_data->iva;
			$telefono = $remi_data->numero_telefono;
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
		
		//numero de nota
		$pdf->MultiCell(110, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(30, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, 'FOLIO ', 1, 'C',0,1);
		
		$pdf->MultiCell(73, 10, 'NOMBRE: '.$remi_nombre_data, 1, 'L',0,0);
		$pdf->MultiCell(62, 10, 'TELEFONO: '.$telefono, 1, 'L',0,0);
		$pdf->MultiCell(5, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, $id_remision, 1, 'C',0,1);	
		
		//fecha cabecera
		$pdf->MultiCell(135, 10, 'DOMICILIO: '.$remi_dir_data.' '.$remi_mun_data, 1, 'L',0,0);
		$pdf->MultiCell(5, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, 'FECHA ', 1, 'C',0,1);	

		//fecha cuerpo
		$pdf->MultiCell(135, 10, 'REFERENCIAS: ', 1, 'L',0,0);
		$pdf->MultiCell(5, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(13, 10, $dia, 1, 'C',0,0);
		$pdf->MultiCell(13, 10, $mes, 1, 'C',0,0);
		$pdf->MultiCell(14, 10, $año, 1, 'C',0,1);
		$pdf->Ln(5);
				
		
		$pdf->MultiCell(90, 10, 'SUCURSAL: '.$remi_suc_data, 0, 'L',0,0);
		$pdf->MultiCell(90, 10, 'ATENDIDO POR: '.$remi_usr_data, 0, 'L',0,1);
		$pdf->Ln(5);
		
		//headers
		$pdf->MultiCell(30, 10, 'CANTIDAD: ', 1, 'C',0,0);
		$pdf->MultiCell(90, 10, 'CONCEPTO: ', 1, 'C',0,0);
		$pdf->MultiCell(30, 10, 'PRECIO UNITARIO: ', 1, 'C',0,0);
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
		$datos = array('TOTAL','ACUENTA','RESTA');
		$values = array($total,$subtotal,$iva);
		$i = 0;
		foreach($datos as $dato){
			$pdf->MultiCell(120, 7, '', 0, 'C',0,0);
			$pdf->MultiCell(30, 7, $dato, 1, 'C',0,0);
			$pdf->MultiCell(20, 7, $values[$i++], 1, 'C',0,0);
			$pdf->MultiCell(10, 7, '', 1, 'C',0,1);
		}
		
		$pdf->Ln(3);
		$pdf->MultiCell(80, 20, 'CANTIDAD CON LETRA', 1, 'L',0,0);			
		$pdf->SetFont('times', 'B', 8);
		$pdf->MultiCell(78, 5, '*ACEPTO TERMINOS Y CONDICIONES', 0, 'L',0,0);
		$pdf->MultiCell(17, 5, 'EFECTIVO', 0, 'R',0,0);
		$pdf->MultiCell(5, 5, '', 1, 'C',0,1);

		
		$pdf->MultiCell(80, 20, '', 0, 'L',0,0);	
		$pdf->MultiCell(78, 5, '*EN CANCELACIONES NO HAY DEVOLUCIONES', 0, 'L',0,0);
		$pdf->MultiCell(17, 5, 'DEPOSITO', 0, 'R',0,0);
		$pdf->MultiCell(5, 5, '', 1, 'C',0,1);

		
		$pdf->MultiCell(80, 20, '', 0, 'L',0,0);	
		$pdf->MultiCell(78, 5, '*EN UNA MALA INSTALACION NO APLICA GARANTIA', 0, 'L',0,0);
		$pdf->MultiCell(17, 5, 'TARJETA', 0, 'R',0,0);
		$pdf->MultiCell(5, 5, '', 1, 'C',0,1);
		
		$pdf->SetFont('times', '', 11);
		$pdf->Ln(25);
		$pdf->MultiCell(180, 10, '______________________________', 0, 'C',0,1);	
		$pdf->MultiCell(180, 10, 'FIRMA DEL CLIENTE', 0, 'C',0,1);
		
		//Close and output PDF document
		$pdf->Output('nota_remision.pdf', 'I');
		
		//============================================================+
		// END OF FILE
		//============================================================+
	}
	
	public function remisionExists(){
		$rem_id=$this->input->post('rem_id');
		
		if($this->mremisiones->exists($rem_id)){
			echo 'EXISTS';
		}else{
			echo 'NOT_EXISTS';
		}
	}

} ?>