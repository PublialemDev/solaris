<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdirecciones extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertDireccion($datosDir){
		$sysdate=new DateTime();//obtener el sysdate
		$returned=$this->db->insert('direcciones',
		array(
			'id_perfil' => $datosDir['cli_id'],
			'id_estado' => $datosDir['dir_estado'],
			'calle' => $datosDir['dir_calle'],
			'numero_ext' => $datosDir['dir_num_ext'],
			'numero_int' => $datosDir['dir_num_int'],
			'colonia' => $datosDir['dir_col'],
			'municipio' => $datosDir['dir_muni'],
			'cp' => $datosDir['dir_cp'],
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => base64_decode($_SESSION['USUARIO_ID']))
		);
		//insertar log para auditoria
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mlogs->insertLog(array('tipo_log'=>'insert_direcciones','descripcion_log'=>'alta de direccion para el perfil: '.$returned));
		}
		return $returned;
	}
	/*
	 * Actualiza la direccion para el id de perfil
	 * @author Luis Briseño
	 * @param array
	 * @return string 
	 * */
	function updateDireccion($datosDir){
		$sysdate=new DateTime();//obtener el sysdate
		$returned=$this->db->update('direcciones',
		array(
			'id_perfil' => $datosDir['cli_id'],
			'id_estado' => $datosDir['dir_estado'],
			'calle' => $datosDir['dir_calle'],
			'numero_ext' => $datosDir['dir_num_ext'],
			'numero_int' => $datosDir['dir_num_int'],
			'colonia' => $datosDir['dir_col'],
			'municipio' => $datosDir['dir_muni'],
			'cp' => $datosDir['dir_cp'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])),
			array('id_perfil'=>$datosDir['cli_id'])
		);
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_direcciones','descripcion_log'=>'actualizacion de direccion del perfil : '.$datosDir['cli_id']));
		}
		return $returned;
	}
	/*
	 * Elimina un registro 
	 * @author Luis Briseño
	 * @param int
	 * @return int 
	 * */
	function deleteDireccion($cli_id){
		//session_start();
		$returned=$this->db->delete('direcciones',array('id_perfil'=>$cli_id));
		return $returned;
	}
	
	/*
	 * Regresa el requistro de la direccion para el id del cliente o false si no se encuentra
	 * @author Luis Briseño
	 * @param int
	 * @return array 
	 * */
	function selectDireccionByCliId($id_cliente){
		$where_clause=array('id_perfil'=>$id_cliente);
		$query = $this->db->get_where('direcciones',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
}
?>