<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccategoriaproductos extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('productos/mcategoriaproductos');
		$this->load->model('logs/mLogs');
	}
	
	public function insertCategoriaProductos(){		
		$this->load->view('productos/vcategoriaproductosinsert');
	}
	
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$catprodu_id = $this->mcategoriaproductos->insertCategoriaProductos($datos);
		
		echo 'SUCCESS;'.$catprodu_id;

	}
	
	
	public function formSelectCategoriaProductos(){		
		$this->load->view('productos/vcategoriaproductosselect');
	}
	
	public function selectCategoriaProductos(){		
		$catprodu_id=$this->input->post('catprodu_id');
		$catprodu_nombre=$this->input->post('catprodu_nombre');
		$where_clause=array();
		
		if($catprodu_id!= null and $catprodu_id!=''){
			$where_clause['catprodu_id']=$catprodu_id;
		}
		if($catprodu_nombre!= null and $catprodu_nombre!=''){
			$where_clause['catprodu_nombre']=$catprodu_nombre;
		}
		
		$res=$this->mcategoriaproductos->selectCategoriaProductos($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $catprodu) {
				$json.='{';
				$json.='"id":'.'"'.$catprodu->id_categoriaProducto.'",';
				$json.='"nombre":'.'"'.$catprodu->nombre_categoriaProducto.'",';
				$json.='"descripcion":'.'"'.$catprodu->descripcion_categoriaProducto.'"';
				$json.='}';
				if($catprodu->id_categoriaProducto!=$last->id_categoriaProducto){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}		
	}

	public function updateCategoriaProductos(){
		$catprodu_id=$this->input->post('idCatProducto');//Almacenara el ID(hidden) generado en la actualizacion
		$catprodu_data;
		$response;
		
		//establece los datos de la categoria para la actualizacion
		$catprodu_data = array(
		'idCatProducto'=>$catprodu_id,
		'nombre'=>$this->input->post('nombre_txt'),
		'descripcion'=>$this->input->post('descripcion_txt')
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->mcategoriaproductos->updateCategoriaProductos($catprodu_data);
		if($response == 1){
			echo "SUCCESS;".$response;
		}
		
	}
	
	public function formUpdateCategoriaProductos(){
		$id_catproducto=$this->input->get('id_categoriaProducto');
		$data['catproducto']=$this->mcategoriaproductos->selectCategoriaProductosById($id_catproducto);
		$this->load->view('productos/vcategoriaproductosupdate',$data);
	}
	
	public function deleteCategoriaProductos(){
		$id_catprodu = $this->input->post('idCatProducto');		
		$returned = $this->mcategoriaproductos->deleteCategoriaProductos($id_catprodu);
		
		if($returned>0){
			$this->mLogs->insertLog(array('tipo_log'=>'delete_categoriaproducto','descripcion_log'=>'se elimino la categoria de productos: '.$id_catprodu));
		}
		return 'SUCCESS;'.$returned;
	}
}
?>