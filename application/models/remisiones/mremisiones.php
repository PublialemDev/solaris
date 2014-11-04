<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRemisiones extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		//$this->load->model('logs/mLogs');
	}
	
	public function insertRemision($datos){
		//session_start();
		$returned = $this->db->insert('remisiones',array('id_sucursal'=> $datos['idSucursal'],
		'id_cliente'=> $datos['idCliente'],'id_tipopago'=> $datos['idTipoPago'],
		'fecha'=> $datos['fecha'],'instalacion'=> $datos['instalacion'],
		'total'=> $datos['total'],'iva'=> $datos['iva'], 
		'creado_en'=> $datos['creado_en'], 'creado_por'=>1));
		
		/*if($returned==1){
			$returned=$this->db->insert_id();			
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_REMISIONES','descripcion_log'=>'SE INSERTO REMISION'.$returned));
		}*/
	}
	
	public function selectSucursales(){
		$query = $this->db->get('sucursales');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}

	public function selectTipoPagos(){
		$query = $this->db->get('tipopagos');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}
	
	public function selectRemisiones(){			
		$consulta = $this->db->query("SELECT sucursales.nombre_sucursal, tipopagos.nombre_tipopago, clientes.nombre_cliente,
		remisiones.fecha, remisiones.total, remisiones.iva, remisiones.creado_en, remisiones.creado_por, remisiones.modificado_en,
		remisiones.modificado_por FROM remisiones 
		JOIN sucursales ON sucursales.id_sucursal = remisiones.id_sucursal
		JOIN tipopagos ON tipopagos.id_tipoPago = remisiones.id_tipoPago
		JOIN clientes ON clientes.id_cliente = remisiones.id_cliente");
		
			
		return $consulta;
	}
	
}