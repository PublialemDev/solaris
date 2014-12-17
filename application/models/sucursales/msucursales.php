<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MSucursales extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("mdeletedata");
	}
	function insertSucursales($datosSucursales){
		$this->db->trans_begin();
		$sysdate=new DateTime();
		$returned=$this->db->insert('sucursales',
		array(
			'nombre_sucursal' => $datosSucursales['nombre'],
			'pagina_web' => $datosSucursales['paginaweb'],			
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => base64_decode($_SESSION['USUARIO_ID']))
		);
		//insertar log para auditoria
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mlogs->insertLog(array('tipo_log'=>'insert_sucursal','descripcion_log'=>'alta de la sucursal: '.$returned));
		}
		
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
	
	function updateSucursales($sucu_data_form){
		$this->db->trans_begin();
		$sysdate=new DateTime();
		$returned=0;
		$sucu_data=array(
			'nombre_sucursal' => $sucu_data_form['nombre'],
			'pagina_web' => $sucu_data_form['paginaweb'],
			//'estatus_sucursal' => $sucu_data_form['estatus'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned=$this->db->update('sucursales',$sucu_data,array('id_sucursal'=>$sucu_data_form['sucu_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_sucursales','descripcion_log'=>'update de la sucursal: '.$sucu_data_form['sucu_id']));
		}
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

	function deleteSucursales($sucu_id){
		$this->db->trans_begin();

		$sysdate=new DateTime();
		
		//$returned=$this->db->delete('sucursales',array('id_sucursal'=>$sucu_id));
		
		$suc_data = array(
			'estatus_sucursal'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('sucursales',$suc_data,array('id_sucursal'=>$sucu_id));			
		
		if($returned == 1){
			$returned = $this->mdeletedata->deleteData($sucu_id,"suc");//actualiza el estatus a inactivo de direccion,telefono y correo 
			if($returned == 1){
				$remi_estatus = array('estatus_remision'=>'I',			
				'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
				'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
				
				$usr_estatus = array('estatus_usuario'=>'I',			
				'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
				'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
				
				$returned = $this->db->update('remisiones',$remi_estatus,array('id_sucursal'=>$sucu_id));			
				if($returned == 1){
					$returned = $this->mdeletedata->deleteProduRemi();	
					if($returned == 1){
						$returned = $this->db->update('usuarios',$usr_estatus,array('id_sucursal'=>$sucu_id));
						if($returned == 1){
							$query = $this->db->query("SELECT id_usuario FROM usuarios WHERE estatus_usuario = 'I'");
							foreach ($query->result() as $value) {
								$returned = $this->mdeletedata->deleteUser($value->id_usuario);	
							}
						}
												
																							
					}																				
				}			
			}	
		}
		
		if($returned>0){
			return true;;
		}
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}
		return false;
	}
	

	function selectSucursales($where_clause){
		
		if(isset($where_clause['sucu_id'])){
			$this->db->where('id_sucursal',$where_clause['sucu_id']);
		}
		if(isset($where_clause['sucu_nombre'])){
			$this->db->like('nombre_sucursal',$where_clause['sucu_nombre']);
		}
		if(isset($where_clause['sucu_paginaweb'])){
			$this->db->like('pagina_web',$where_clause['sucu_paginaweb']);
		}
		
		$this->db->where('estatus_sucursal','A');
		$query = $this->db->get('sucursales');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectSucursalesById($id_sucu){
		$where_clause=array('id_sucursal'=>$id_sucu);
		$query = $this->db->get_where('sucursales',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
}
?>
