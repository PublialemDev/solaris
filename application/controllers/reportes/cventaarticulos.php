<?php
session_start();
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CVentaArticulos extends CI_Controller {

	public function __construct(){
	parent::__construct();
	$this->load->helper('form');
	$this->load->helper('pagina');
	$this->load->model('reportes/mventaarticulos');
	
	}
	
	public function formArticulos(){
		$datos['categorias'] = $this->mventaarticulos->selectCategorias();
		$this->load->view('reportes/vventaarticulos',$datos);
	}
		

	public function reporteVentaArticulos(){
		$mes = $this->input->post('mes');
		$anio = $this->input->post('anio');
		$categoria = $this->input->post('prod_categoria');
		$mes2 = '';
		
		if($mes == 'january'){
			$mes2 = 'Enero';
		}else if($mes == 'february'){
			$mes2 = 'Febrero';
		}else if($mes == 'march'){
			$mes2 = 'Marzo';
		}else if($mes == 'april'){
			$mes2 = 'Abril';
		}else if($mes == 'may'){
			$mes2 = 'Mayo';
		}else if($mes == 'june'){
			$mes2 = 'Junio';
		}else if($mes == 'july'){
			$mes2 = 'Julio';
		}else if($mes == 'august'){
			$mes2 = 'Agosto';
		}else if($mes == 'september'){
			$mes2 = 'Septiembre';
		}else if($mes == 'october'){
			$mes2 = 'Octubre';
		}else if($mes == 'november'){
			$mes2 = 'Noviembre';
		}else if($mes == 'december'){
			$mes2 = 'Diciembre';
		}
		
		
		$i = 0;
		$j = 0;
		$i2 = 0;
		$j2 = 0;
		$i3 = 0;
		$j3 = 0;
		$k3 = 0;
		$total = 0;		
		$total_sucursal = 0;
		$sucursal = "";
		$instalacion = "";
		
		$array_sucu = array(0);
		$array_totales = array(0);
		$ins_si = array(0);
		$ins_no = array(0);
		$lvl_nor = array(0);
		$lvl_adv = array(0);
		$lvl_pre = array(0);
		$total_nor=0;
		$total_adv=0;
		$total_pre=0;
		$total_si=0;
		$total_no=0;
		$categoria2 = 0;
		
		$resul['resultado'] = $this->mventaarticulos->getValues($mes,$anio,$categoria);
		
		$nombre_Categoria['cate'] = $this->mventaarticulos->selectNombreCategoria($categoria);
		
		if($resul['resultado'] != null){
			$remi_data=$resul['resultado']->first_row();
			$sucursal = $remi_data->nombre_sucursal;			
		}
		if($nombre_Categoria['cate'] != null){
			$remi_data=$nombre_Categoria['cate']->first_row();
			$categoria2 = $remi_data->nombre_categoriaProducto;			
		}
		
		if($resul['resultado'] != null){
			foreach($resul['resultado']->result() as $value){
				$total += $value->cantidad;
				if($sucursal == $value->nombre_sucursal){						
					$array_sucu[$i] = $sucursal;
					$total_sucursal += $value->cantidad;
					$array_totales[$j] = $total_sucursal;
					
					if( $value->instalacion == 'S'){
						$total_si += $value->cantidad;
						$ins_si[$i2] = $total_si;
					}else if($value->instalacion == 'N'){
						$total_no += $value->cantidad;
						$ins_no[$j2] = $total_no;			
					}
					
					if($value->nivel_cliente == 'nor'){
						$total_nor += $value->cantidad;
						$lvl_nor[$i3] = $total_nor;
					}else if($value->nivel_cliente == 'adv'){
						$total_adv += $value->cantidad;
						$lvl_adv[$j3] = $total_adv;
					}else if($value->nivel_cliente == 'pre'){
						$total_pre += $value->cantidad;
						$lvl_pre[$k3] = $total_pre;
					}
					
				}else{
					$i++;	
					$j++;	
					$i2++;
					$j2++;
					$i3++;
					$j3++;
					$k3++;
					$total_si = $value->cantidad;
					$total_no = 0;
					$total_nor = $value->cantidad;
					$total_adv = 0;
					$total_pre = 0;
					$total_sucursal =$value->cantidad;				
					$sucursal = $value->nombre_sucursal;																					
				}								
			}//fin del for						
		}//fin del if
				
			
		$this->load->library('pdf');
				

		// create new PDF document
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Solaris de México');
		$pdf->SetTitle('Reporte Mensual de Articulos');
		$pdf->SetSubject('Reporte Mensual de Articulos');
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
		$pdf->SetFont('times', 'B', 14);
		$pdf->MultiCell(60, 10,'CATEGORIA', 0, 'C',0,0);
		$pdf->MultiCell(40, 10,'', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, 'FECHA', 0, 'C',0,1);
		
		$pdf->SetFont('times', '', 14);
		$pdf->MultiCell(60, 10,$categoria2, 0, 'C',0,0);
		$pdf->MultiCell(40, 10,'', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, $mes2.' '.$anio, 0, 'C',0,1);

		$pdf->MultiCell(60, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(40, 10,'', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, '', 0, 'C',0,0);
		$pdf->MultiCell(40, 10, '', 0, 'C',0,1);
		
		$pdf->SetFont('times', 'B', 16);
		$pdf->MultiCell(100, 10, 'Total Productos Vendidos', 1, 'C',0,0);
		$pdf->SetFont('times', '', 14);
		$pdf->MultiCell(40, 10,$total, 1, 'C',0,0);
		$pdf->MultiCell(40, 10, '', 1, 'C',0,1);
		
		$j = 0;$i = 0;$i2 = 0;$i3 = 0;$i4 = 0;$i5 = 0;		
		foreach ($array_sucu as $indice) {
			$pdf->SetFont('times', 'B', 15);
			$pdf->MultiCell(100, 9,'Sucursal '. $indice, 1, 'C',0,0);			
			$pdf->SetFont('times', '', 11);
			$pdf->MultiCell(40, 9, $array_totales[$j++], 0, 'C',0,0);
			$pdf->MultiCell(40, 9,'', 1, 'C',0,1);	
			
			$pdf->SetFont('times', 'B', 14);
			$pdf->MultiCell(100, 8, 'Instalacion', 1, 'C',0,0);			
			$pdf->SetFont('times', '', 14);
			$pdf->MultiCell(40, 8, '', 1, 'C',0,0);
			$pdf->MultiCell(40, 8,'', 1, 'C',0,1);	
			
			$pdf->SetFont('times', '', 12);
			$pdf->MultiCell(100, 7, 'SI', 1, 'C',0,0);			
			$pdf->MultiCell(40, 7, '', 1, 'C',0,0);
			$pdf->MultiCell(40, 7,$ins_si[$i++], 1, 'C',0,1);	
			
			$pdf->MultiCell(100, 7, 'NO', 1, 'C',0,0);			
			$pdf->MultiCell(40, 7, '', 1, 'C',0,0);
			$pdf->MultiCell(40, 7,$ins_no[$i2++], 1, 'C',0,1);	
			
			$pdf->SetFont('times', 'B', 14);
			$pdf->MultiCell(100, 8, 'Tipo de Cliente', 1, 'C',0,0);			
			$pdf->SetFont('times', '', 14);
			$pdf->MultiCell(40, 8, '', 1, 'C',0,0);
			$pdf->MultiCell(40, 8,'', 1, 'C',0,1);	
			
			$pdf->SetFont('times', '', 12);
			$pdf->MultiCell(100, 7, 'Normal', 1, 'C',0,0);			
			$pdf->MultiCell(40, 7, '', 1, 'C',0,0);
			$pdf->MultiCell(40, 7,$lvl_nor[$i3++], 1, 'C',0,1);	
			
			$pdf->MultiCell(100, 7, 'Avanzado', 1, 'C',0,0);			
			$pdf->MultiCell(40, 7, '', 1, 'C',0,0);
			$pdf->MultiCell(40, 7,$lvl_adv[$i4++], 1, 'C',0,1);	
			
			$pdf->MultiCell(100, 7, 'Premium', 1, 'C',0,0);			
			$pdf->MultiCell(40, 7, '', 1, 'C',0,0);
			$pdf->MultiCell(40, 7,$lvl_pre[$i5++], 1, 'C',0,1);	
					
		
		}
		

		//Close and output PDF document
		$pdf->Output('reporte_ventaarticulos_'.$mes2.'.pdf', 'I');
		
		//============================================================+
		// END OF FILE
		//============================================================+
	}

} ?>