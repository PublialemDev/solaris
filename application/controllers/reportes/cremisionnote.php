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
	$this->load->model('telefonos/mtelefonos');
	
	}
	
	public function formGenerarPDF(){
		$this->load->view('reportes/vremisionnote');
	}
	
	
	public function generarPDF(){		
		$this->load->library('pdf');
		
		$id_remision = $this->input->post('idRemision');
		$idUsuario = base64_decode($_SESSION['USUARIO_ID']);
		
		$resul['sucursal'] = $this->mremisionnote->getSucursalData($id_remision);
		if($resul['sucursal'] != null){
			$sucu_data = $resul['sucursal']->first_row();
			$sucu_dir_data = $sucu_data->calle.' ext. #'.$sucu_data->numero_ext.' int. #'.$sucu_data->numero_int;
			$sucu_mun_data = $sucu_data->municipio.', '.$sucu_data->nombre_estado.', '.$sucu_data->comentarios;
		}else{
			show_error('ERROR CONSULTA VACIA' );
		}
		//obtener resultado de la query 
		$resul['resultado'] = $this->mremisionnote->getValues($id_remision);
		
		if($resul['resultado'] != null){
			$remi_data=$resul['resultado']->first_row();
			$remi_nombre_data = $remi_data->nombre_cliente;
			$remi_dir_data = $remi_data->calle.' ext. #'.$remi_data->numero_ext.' int. #'.$remi_data->numero_int.', '.$remi_data->colonia;
			$remi_mun_data = $remi_data->municipio.', '.$remi_data->nombre_estado;
			$remi_dir_comen = $remi_data->comentarios ;
			$remi_tp_data = $remi_data->nombre_tipoPago;
			$remi_usr_data = $remi_data->nombre_usuario;
			$remi_suc_data = $remi_data->nombre_sucursal;
			$remi_fecha_data = $remi_data->fecha;
			$total= $remi_data->total+$remi_data->iva;
			$remi_cli_id=$remi_data->id_cliente;
			//$telefono = $remi_data->numero_telefono;
		}
		
		$resul['telefono'] = $this->mtelefonos->selectTelefonosByCliId($remi_cli_id,'cli');
		$telefono='';
		if($resul['telefono'] != null){
			foreach($resul['telefono']->result() as $value){
				$telefono.= $value->numero_telefono . ' ';
			}
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
		
		$pdf->SetPrintHeader(false);     
		$pdf->AddPage();
		$texto = "FELICIDADES usted ahora es dueño del mejor calentador solar del mercado. La calidad de material en este calentador se rige bajo las mas estrictas normas internacionales ISO-9001. 

			SOLARIS ECO-SYSTEMS Responderá por defectos de fabrica en el equipo durante 3 años y reparará o cambiará componentes defectuosos. En ningún momento Solaris Eco-Systems estará obligado a instalar un equipo nuevo o devolver el costo del equipo. Para hacer una reclamación el cliente debe de presentar la factura o nota original.

			Excluidos de la garantía quedarán:
			*Daños ocasionados por el uso en climas corrosivos, como  en la costa o por agua clorada de piscinas.
			*Daños por instalaciones o usos que no cumplan con el manual.
			*Daños por alteraciones o reparaciones efectuadas por personas no autorizadas por la empresa.
			*Daño por mal uso o negligencia del cliente.
			*Daños por fenómenos por la naturaleza (Granizos, tormentas, huracanes, etc.).
			*Daños por actos de vandalismo, objetos y artefactos que pudieran dañar los componentes del sistema.
			*Cambiar la barra de magnesio mínimo cada 6 meses dependiendo de la condición del agua de la zona.
			
			SOLARIS ECO-SYSTEMS No acepta ninguna responsabilidad por daños ocurridos a personas o bienes durante la instalación o el uso del equipo.
			
			El sistema depende totalmente de una adecuada instalación, de no ser así se anulara la garantía.";
			
		$pdf->MultiCell(180, 10, $texto, 0, 'L',0,0);
		
		$pdf->SetPrintHeader(true);  
		// add a page
		$pdf->AddPage();
		
		//numero de nota
		$pdf->SetFont('helvetica', 'B', 10);
		$pdf->MultiCell(40, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(100, 10, $sucu_dir_data.', '.$sucu_mun_data, 0, 'C',0,0);
		$pdf->SetFont('times', 'B', '10');
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
		$pdf->MultiCell(135, 10, 'REFERENCIAS: '.$remi_dir_comen, 1, 'L',0,0);
		$pdf->MultiCell(5, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(13, 10, $dia, 1, 'C',0,0);
		$pdf->MultiCell(13, 10, $mes, 1, 'C',0,0);
		$pdf->MultiCell(14, 10, $año, 1, 'C',0,1);
		$pdf->Ln(5);
				
		
		$pdf->MultiCell(90, 10, 'SUCURSAL: '.$remi_suc_data, 0, 'L',0,0);
		$pdf->MultiCell(90, 10, 'ATENDIDO POR: '.$remi_usr_data, 0, 'L',0,1);
		$pdf->Ln(5);
		
		//headers
		$pdf->MultiCell(30, 10, 'CANTIDAD ', 1, 'C',0,0);
		$pdf->MultiCell(90, 10, 'CONCEPTO ', 1, 'C',0,0);
		$pdf->MultiCell(30, 10, 'PRECIO UNITARIO ', 1, 'C',0,0);
		$pdf->MultiCell(30, 10, 'IMPORTE ', 1, 'C',0,1);
		
		$resul['productos'] = $this->mremisionnote->getProductoRemision($id_remision);
		$cont= 0;
		//table
		if($resul['productos'] != null){
			foreach($resul['productos']->result() as $value){
				$pdf->MultiCell(30, 7, $value->cantidad, 1, 'C',0,0);
				$pdf->MultiCell(90, 7, $value->nombre_producto, 1, 'C',0,0);
				$pdf->MultiCell(20, 7, $value->precio_actual, 1, 'C',0,0);
				$pdf->MultiCell(10, 7, '', 1, 'C',0,0);
				$pdf->MultiCell(20, 7, $value->importe, 1, 'C',0,0);
				$pdf->MultiCell(10, 7, '', 1, 'C',0,1);
				$cont++;
			}	
						
		}
		if($cont < 10){
			for($i = $cont; $i<10; $i++){
				$pdf->MultiCell(30, 7, '', 1, 'C',0,0);
				$pdf->MultiCell(90, 7, '', 1, 'C',0,0);
				$pdf->MultiCell(20, 7, '', 1, 'C',0,0);
				$pdf->MultiCell(10, 7, '', 1, 'C',0,0);
				$pdf->MultiCell(20, 7, '', 1, 'C',0,0);
				$pdf->MultiCell(10, 7, '', 1, 'C',0,1);
			}
		}	
		//$datos = array('SUBTOTAL','IVA','TOTAL');
		//$values = array($subtotal,$iva,$total);
		//$i = 0;
		//foreach($datos as $dato){
			$pdf->MultiCell(120, 7, '', 0, 'C',0,0);
			$pdf->MultiCell(30, 7, 'TOTAL', 1, 'C',0,0);
			$pdf->MultiCell(20, 7, $total, 1, 'C',0,0);
			$pdf->MultiCell(10, 7, '', 1, 'C',0,1);
		//}
		
		$pdf->Ln(3);
		//$pdf->MultiCell(70, 20, 'CANTIDAD CON LETRA', 1, 'L',0,0);			
		$pdf->SetFont('times', 'B', 8);
		$pdf->MultiCell(148, 5, '*ACEPTO TERMINOS Y CONDICIONES', 0, 'L',0,0);
		$pdf->MultiCell(32, 5, 'TIPO DE PAGO', 0, 'C',0,1);


		
		//$pdf->MultiCell(70, 20, '', 0, 'L',0,0);	
		$pdf->MultiCell(148, 5, '*EN CANCELACIONES NO HAY DEVOLUCIONES', 0, 'L',0,0);
		$pdf->MultiCell(32, 5, $remi_tp_data, 0, 'C',0,1);


		
		//$pdf->MultiCell(70, 20, '', 0, 'L',0,0);	
		$pdf->MultiCell(148, 5, '*EN UNA MALA INSTALACION NO APLICA GARANTIA', 0, 'L',0,0);
		$pdf->MultiCell(32, 5, '', 0, 'C',0,0);

		
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