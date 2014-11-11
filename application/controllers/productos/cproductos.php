<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cproductos extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('productos/mProductos');
		$this->load->library('table');
	}
	//muestra la vista para crear un producto
	public function insertProductoForm(){
		$datos['categorias'] = $this->mProductos->selectCategorias();
		$this->load->view('productos/vProductosInsert',$datos);
	}
	//inserta el producto
	public function insertProducto(){
		echo 'SUCCESS;datos recibidos';
	}
	
	//regresa todos los productos
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'categoria' => $this->input->post('categoria'), 
		'precio' => $this->input->post('precio_txt'), 
		'proveedor' => $this->input->post('proveedor_txt'), 
		'estatus' => $this->input->post('estatus'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$this->mProductos->insertProducto($datos);

	}
	
	//muestra el form para consultar los productos
	public function selectProductosForm(){
		$consulta['query'] = $this->mProductos->selectProductos();
		$this->load->view('productos/vProductosSelect',$consulta);
	}
			
} 
?>