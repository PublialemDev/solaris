<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class CRemisiones extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('remisiones/mremisiones');
		$this->load->library('table');
	}
	
	/*
	 * Muestra el formulario para generar una remision
	 * @author Luis Briseño
	 * 
	 * */
	public function insertRemisionForm(){		
		$datos['sucursales'] = $this->mremisiones->selectSucursales();
		$datos['tipopagos'] = $this->mremisiones->selectTipoPagos();

		$this->load->view('remisiones/vremisionesinsert',$datos);
	}
	
	/*
	 * Muestra el formulario para generar una remision
	 * @author Luis Briseño
	 * 
	 * */
	public function insertRemision(){
		$remi_data=array(
		'idSucursal'=>$this->input->post('IDSUCURSAL'),
		'idCliente'=>$this->input->post('CLIENTE_TXT'),
		'idTipoPago'=>$this->input->post('IDTIPOPAGO'),
		'fecha'=>$this->input->post('FECHA_TXT'),
		'instalacion'=>$this->input->post('INSTALACION'),
		'total'=>$this->input->post('TOTAL_TXT'),
		'iva'=>$this->input->post('IVA_TXT'));		
		$generated=$this->mremisiones->insertRemision($remi_data);
		echo 'SUCCESS;'.$generated;
	}
	
	
	
	public function modalClientes(){
		
		$this->load->view('clientes/vClientesSelectModal');
	}
	
	public function modalProductos(){
		$this->load->view('productos/vProductosSelectModal');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('idSucursal' => $this->input->post('sucursal'), 
		'idCliente' => $this->input->post('cliente_txt'), 
		'idTipoPago' => $this->input->post('tipopago'), 
		'fecha' => $this->input->post('fecha_txt'), 
		'instalacion' => $this->input->post('instalacion'), 
		'total' => $this->input->post('total_txt'), 
		'iva' => $this->input->post('iva_txt'),
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$this->mremisiones->insertRemision($datos);
	}
	
	public function selectRemisiones(){
		$consulta['query'] = $this->mremisiones->selectremisiones();
		$this->load->view('remisiones/vremisionesselect',$consulta);
	}
			
} 
?>