<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLogs extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();		
	}
	
	/**
	 * Insertar Logs
	 *
	 * Inserta un registro en la tabla LOGS, 
	 * recibe un arreglo como parametro, 
	 * con los argumentos(id_usuario, tipo_log, descripcion_log, fecha_hora).
	 *
	 * @access	public
	 * @param	array los datos del log	
	 */
	public function insertLog($datos = array()){
		$this->db->insert('logs',array('id_usuario'=>$datos[0],'tipo_log'=>$datos[1],
			'descripcion_log'=>$datos[2],'fecha_hora'=>$datos[3]));
	}
}
?>