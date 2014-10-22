<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CProductos extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('productos/mProductos');
	}
	
	public function nuevoProducto(){
		$datos['categorias'] = $this->mProductos->consultarCategoria();
		$this->load->view('productos/vProductosInsert',$datos);
	}
	
	public function recibirDatos(){
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'categoria' => $this->input->post('categoria'), 
		'precio' => $this->input->post('precio_txt'), 
		'proveedor' => $this->input->post('proveedor_txt'), 
		'estatus' => $this->input->post('estatus'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => '9999-12-31 23:59:59', 
		'creado_por' =>  01);
		
		$this->mProductos->insertarProducto($datos);

	}
	
} 
?>