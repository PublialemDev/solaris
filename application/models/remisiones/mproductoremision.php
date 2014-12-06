<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mproductoremision extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}
	
	public function insertProductoRemision($datos){
		$sysdate=new DateTime();
		$returned = $this->db->insert('productoremision',array(
		'id_producto'=> $datos['id_producto'],
		'id_remision'=> $datos['id_remision'],
		'cantidad'=> $datos['cantidad'],
		'precio_actual'=> $datos['precio_actual'],
		'descuento'=> $datos['descuento'],
		'estatus_productoRemision'=> 'A',
		'creado_en'=> $sysdate->format('Y-m-d H:i:s'), 
		'creado_por'=>base64_decode($_SESSION['USUARIO_ID']))
		);
		
		if($returned==1){
			$returned=$this->db->insert_id();			
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_REMISIONES','descripcion_log'=>'SE INSERTO REMISION'.$returned));
		}
		return $returned;
	}
	
	public function deleteProductoRemision($id_remision){
		$returned=$this->db->delete('productoremision',array('id_remision'=>$id_remision));
		//insertar log para auditoria
		if($returned>0){
			$this->mLogs->insertLog(array('tipo_log'=>'delete_productoremision','descripcion_log'=>'borrado de productos para la remision: '.$id_remision));
			return true;
		}
		return $returned;
	}
	
	public function selectProductoRemisionById($id_remision){
		$where_clause=array('id_remision'=>$id_remision,'estatus_productoRemision'=>'A');
		$this->db->where($where_clause);
		$this->db->select('id_remision,productoremision.id_producto,cantidad,precio_actual,descuento,nombre_producto,descripcion_producto');
		$this->db->from('productoremision');
		$this->db->join('productos','productoremision.id_producto = productos.id_producto ');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	/*
	public function selectRemisiones(){			
		$consulta = $this->db->query("SELECT clientes.nombre_cliente, sucursales.nombre_sucursal, tipopagos.nombre_tipopago, 
		remisiones.fecha, remisiones.instalacion, remisiones.total, remisiones.iva, remisiones.creado_en, remisiones.creado_por, remisiones.modificado_en,
		remisiones.modificado_por FROM remisiones 
		JOIN sucursales ON sucursales.id_sucursal = remisiones.id_sucursal
		JOIN tipopagos ON tipopagos.id_tipoPago = remisiones.id_tipoPago
		JOIN clientes ON clientes.id_cliente = remisiones.id_cliente");
		
			
		return $consulta;
	}
	*/
}