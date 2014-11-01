<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CCategoriaProductos extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('productos/mCategoriaProductos');
		$this->load->library('table');
	}
	
	public function insertCategoria(){		
		$this->load->view('productos/vCategoriaProductosInsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'), 
		'creado_por' =>  1);
		
		$this->mCategoriaProductos->insertCategoria($datos);

	}
	
	public function selectCategorias(){
		$consulta['query'] = $this->mCategoriaProductos->selectCategorias();
		$this->load->view('categoriaproductos/vCategoriaProductosSelect',$consulta);
	}
}
?>