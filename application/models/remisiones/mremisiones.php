<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRemisiones extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}
	
	public function insertRemision($datos){
		$sysdate=new DateTime();
		$returned = $this->db->insert('remisiones',array(
		'id_sucursal'=> $datos['idSucursal'],
		'id_cliente'=> $datos['idCliente'],
		'id_tipopago'=> $datos['idTipoPago'],
		'fecha'=> $datos['fecha'],
		'instalacion'=> $datos['instalacion'],
		'total'=> $datos['total'],
		'iva'=> $datos['iva'], 
		'creado_en'=> $sysdate->format('Y-m-d H:i:s'), 
		'creado_por'=>base64_decode($_SESSION['USUARIO_ID']))
		);
		
		if($returned==1){
			$returned=$this->db->insert_id();			
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_REMISIONES','descripcion_log'=>'SE INSERTO REMISION'.$returned));
			return $returned;
		}else{
		return false;
		}
	}
	
	//actualizacion de remision
	public function updateRemision($datos){
		$sysdate=new DateTime();
		$returned=0;
		$data_Remision=array(
		'id_sucursal'=> $datos['idSucursal'],
		'id_cliente'=> $datos['idCliente'],
		'id_tipopago'=> $datos['idTipoPago'],
		'fecha'=> $datos['fecha'],
		'instalacion'=> $datos['instalacion'],
		'total'=> $datos['total'],
		'iva'=> $datos['iva'], 
		'modificado_en'=> $sysdate->format('Y-m-d H:i:s'), 
		'modificado_por'=>base64_decode($_SESSION['USUARIO_ID']));
		
		$returned=$this->db->update('remisiones',$data_Remision,array('id_remision'=>$datos['idRemision']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mLogs->insertLog(array('tipo_log'=>'update_remision','descripcion_log'=>'update de remision: '.$datos['idRemision']));
		}
		return $returned;
	}
	
	public function selectSucursales(){
		$query = $this->db->get('sucursales');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}
	
	function selectRemisiones($where_clause){
		
		if(isset($where_clause['cli_id'])){
			$this->db->where('clientes.id_cliente',$where_clause['cli_id']);
		}
		if(isset($where_clause['suc_id'])){
			$this->db->where('remisiones.id_sucursal',$where_clause['suc_id']);
		}
		if(isset($where_clause['tipopago_id'])){
			$this->db->where('remisiones.id_tipoPago',$where_clause['tipopago_id']);
		}
		if(isset($where_clause['fecha_inicio'])){
			$this->db->where('fecha >=',$where_clause['fecha_inicio']);
		}
		if(isset($where_clause['fecha_fin'])){
			$this->db->where('fecha <=',$where_clause['fecha_fin']);
		}
		/*if(isset($where_clause['cli_rfc'])){
			$this->db->where('rfc',$where_clause['cli_rfc']);
		}*/
		$this->db->select('id_remision,nombre_sucursal as id_sucursal,nombre_cliente as id_cliente,nombre_tipoPago as id_tipoPago,fecha,instalacion,total,iva,nombre_cliente');
		$this->db->from('remisiones');
		$this->db->join('clientes','remisiones.id_cliente=clientes.id_cliente');
		$this->db->join('sucursales','remisiones.id_sucursal=sucursales.id_sucursal');
		$this->db->join('tipopagos','remisiones.id_tipoPago=tipopagos.id_tipoPago');
		
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectRemisionById($id_remision){
		$where_clause=array('id_remision'=>$id_remision);
		$this->db->select('id_remision,id_sucursal,remisiones.id_cliente,id_tipoPago,fecha,instalacion,total,iva,nombre_cliente');
		$this->db->from('remisiones');
		$this->db->join('clientes','remisiones.id_cliente=clientes.id_cliente');
		$this->db->where($where_clause);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query;
		}
		else{
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


 function tipoUsuario($id_usuario){
		$query = $this->db->query('SELECT nombre_tipoUsuario FROM tipoUsuarios 
		JOIN usuarios ON usuarios.id_tipousuario = tipousuarios.id_tipousuario 
		WHERE usuarios.id_usuario = '.$id_usuario);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
}
	
	
function deleteRemision($id_Remision){
		$this->db->trans_begin();
		$sysdate=new DateTime();
						
		$remi_data = array(
			'estatus_remision'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('remisiones',$remi_data,array('id_remision'=>$id_Remision));			
		
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}
		return $returned;
		
	}
	/*public function selectRemisiones(){			
		$consulta = $this->db->query("SELECT clientes.nombre_cliente, sucursales.nombre_sucursal, tipopagos.nombre_tipopago, 
		remisiones.fecha, remisiones.instalacion, remisiones.total, remisiones.iva, remisiones.creado_en, remisiones.creado_por, remisiones.modificado_en,
		remisiones.modificado_por FROM remisiones 
		JOIN sucursales ON sucursales.id_sucursal = remisiones.id_sucursal
		JOIN tipopagos ON tipopagos.id_tipoPago = remisiones.id_tipoPago
		JOIN clientes ON clientes.id_cliente = remisiones.id_cliente");
		
			
		return $consulta;
	}*/
	
}