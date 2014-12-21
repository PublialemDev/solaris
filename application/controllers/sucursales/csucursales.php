<?php
session_start();
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CSucursales extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('pagina');//carga el helper bsico para las view
		$this->load->model('estados/mestados');
		$this->load->model('sucursales/msucursales');
		$this->load->model('direcciones/mdirecciones');
		$this->load->model('telefonos/mtelefonos');
		$this->load->model('correos/mcorreos');
		$this->load->model('logs/mlogs');

	}
	
	public function index()
	{
		//$this->load->view('sucursales/vClientesUpdate');
	}

	public function formInsertSucursales(){
		$this->load->helper('form');//carga el helper para los formularios
		$data['estados']= $this->mestados->selectEstados();
		$this->load->view('sucursales/vsucursalesinsert',$data);
	}

	public function insertSucursales()
	{
		$sucu_id=0;//Almacenara el ID generado en la insercion
		$sucu_data;
		$dir_data;//Almacenara el array de datos de la direccion para la insercion
		$returned;
		
		//establece los datos del cliente para la insercion
		$sucu_data=array(
		'nombre'=>$this->input->post('NOMBRE'),
		'paginaweb'=>$this->input->post('PAGINAWEB')
		//'estatus'=>$this->input->post('SUCU_ESTATUS')
		);
		//inserta y recibe el id generado en la insercion
		$sucu_id= $this->msucursales->insertSucursales($sucu_data);
		
		//inserta la direccion para le cliente
		if($sucu_id>0 and $sucu_id!= null){
			//establece los datos del cliente para la insercion
			$dir_data=array(
			'cli_id'=>$sucu_id,
			'dir_estado'=>$this->input->post('DIR_ESTADO'),
			'dir_calle'=>$this->input->post('DIR_CALLE'),
			'dir_num_ext'=>$this->input->post('DIR_NUM_EXT'),
			'dir_num_int'=>$this->input->post('DIR_NUM_INT'),
			'dir_col'=>$this->input->post('DIR_COL'),
			'dir_muni'=>$this->input->post('DIR_MUNI'),
			'dir_cp'=>$this->input->post('DIR_CP'),
			'dir_ref'=>$this->input->post('DIR_REF')
			);
			
			//inserta y recibe el id generado en la insercion
			$returned= $this->mdirecciones->insertDireccion($dir_data,'suc');
		}
		else{
			echo $returned;
		}
		
		//inserta los telefonos para el cliente
		if($sucu_id>0 and $sucu_id!= null and $returned>0){
			//genera el array de los numeros de telefono
			$tel_numeros = explode('#',$this->input->post('TEL_NUM'));
			$tel_data;
			$total_telefonos=0;
			foreach ($tel_numeros as $tel_num) {
				if($tel_num>0 and $tel_num!= null){
					$tel_data=array(
						'cli_id'=>$sucu_id,
						'tel_numero'=>$tel_num
					);
					
					$returned=$this->mtelefonos->insertTelefono($tel_data,'suc');
					if($returned==1){
						$total_telefonos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_telefonos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'insert_telefonos','descripcion_log'=>$total_telefonos.' telefonos para el perfil: '.$sucu_id));
			}
		}else{
			echo $returned;
		}
		
		//inserta los correos para el cliente
		if($sucu_id>0 and $sucu_id!= null  and $returned>0){
			//genera el array de los correos
			$corr_correos = explode('#',$this->input->post('CORR_CORREO'));
			$corr_data;
			$total_correos=0;
			foreach ($corr_correos as $corr_correo) {
				if($corr_correo !='' and $corr_correo!= null){
					$corr_data=array(
						'cli_id'=>$sucu_id,
						'corr_correo'=>$corr_correo
					);
					$returned=$this->mcorreos->insertCorreo($corr_data,'suc');
					if($returned==1){
						$total_correos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_correos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'insert_correos','descripcion_log'=>$total_correos.' correos para el perfil: '.$sucu_id));
			}
		}else{
			echo $returned;
		}
		
		echo 'SUCCESS;'.$sucu_id;
	}
	

	public function formSelectSucursales(){
		$this->load->helper('form');//carga el helper para los formularios
		$data['estados']= $this->mestados->selectEstados();
		$this->load->view('sucursales/vsucursalesselect',$data);
	}

	public function selectSucursalesJson()
	{
		$sucu_id=$this->input->post('sucu_id');
		$sucu_nombre=$this->input->post('sucu_nombre');
		$sucu_paginaweb=$this->input->post('sucu_paginaweb');
		$where_clause=array();
		if($sucu_id!= null and $sucu_id!=''){
			$where_clause['sucu_id']=$sucu_id;
		}
		if($sucu_nombre!= null and $sucu_nombre!=''){
			$where_clause['sucu_nombre']=$sucu_nombre;
		}
		if($sucu_paginaweb!= null and $sucu_paginaweb!=''){
			$where_clause['sucu_paginaweb']=$sucu_paginaweb;
		}
		
		$res=$this->msucursales->selectSucursales($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $sucursal) {
				$json.='{';
				$json.='"id":'.'"'.$sucursal->id_sucursal.'",';
				$json.='"nombre":'.'"'.$sucursal->nombre_sucursal.'",';
				$json.='"paginaweb":'.'"'.$sucursal->pagina_web.'"';
				$json.='}';
				if($sucursal->id_sucursal!=$last->id_sucursal){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}
	}
	

	public function formUpdateSucursales(){
		$this->load->helper('form');//carga el helper para los formularios
		$id_sucursal=$this->input->get('id_sucursal');
		$data['estados']= $this->mestados->selectEstados();
		$data['sucursal']=$this->msucursales->selectSucursalesById($id_sucursal);
		$data['direccion']=$this->mdirecciones->selectDireccionByCliId($id_sucursal,'suc');
		$data['telefono']=$this->mtelefonos->selectTelefonosByCliId($id_sucursal,'suc');
		$data['correo']=$this->mcorreos->selectCorreosByCliId($id_sucursal,'suc');
		$this->load->view('sucursales/vsucursalesupdate',$data);
	}


	public function updateSucursales()
	{
		$sucu_id=$this->input->post('SUCU_ID');//Almacenara el ID generado en la actualizacion
		$sucu_data;//Almacenara el array de datos del cliente para la actualizacion
		$dir_data;//Almacenara el array de datos de la direccion para la actualizacion
		$response=0;
		
		//establece los datos del cliente para la actualizacion
		$sucu_data=array(
		'sucu_id'=>$sucu_id,
		'nombre'=>$this->input->post('NOMBRE'),
		'paginaweb'=>$this->input->post('PAGINAWEB')
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->msucursales->updateSucursales($sucu_data);
		
		//inserta la direccion para le cliente
		if($sucu_id>0 and $sucu_id!= null and $response>0){
			//establece los datos del cliente para la actualizacion
			$dir_data=array(
			'cli_id'=>$sucu_id,
			'dir_estado'=>$this->input->post('DIR_ESTADO'),
			'dir_calle'=>$this->input->post('DIR_CALLE'),
			'dir_num_ext'=>$this->input->post('DIR_NUM_EXT'),
			'dir_num_int'=>$this->input->post('DIR_NUM_INT'),
			'dir_col'=>$this->input->post('DIR_COL'),
			'dir_muni'=>$this->input->post('DIR_MUNI'),
			'dir_cp'=>$this->input->post('DIR_CP'),
			'dir_ref'=>$this->input->post('DIR_REF')
			);
			
			//inserta y recibe el id generado en la actualizacion
			$response=$this->mdirecciones->updateDireccion($dir_data,'suc');
		}else{
			echo $response;
		}
		
		//actualiza los telefonos para el cliente
		if($sucu_id>0 and $sucu_id!= null and $response>0){
			//genera el array de los numeros de telefono
			$tel_numeros = explode('#',$this->input->post('TEL_NUM'));
			$response=$this->mtelefonos->deleteTelefonosAll($sucu_id,'suc');
			$tel_data;
			$total_telefonos=0;
			foreach ($tel_numeros as $tel_num) {
				if($tel_num>0 and $tel_num!= null){
					$tel_data=array(
						'cli_id'=>$sucu_id,
						'tel_numero'=>$tel_num
					);
					
					$response=$this->mtelefonos->insertTelefono($tel_data,'suc');
					if($response==1){
						$total_telefonos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_telefonos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'update_telefonos','descripcion_log'=>$total_telefonos.' telefonos para el perfil: '.$sucu_id));
			}
		}else{
			echo $response;
		}
		
		//actualiza los correos para el cliente
		if($sucu_id>0 and $sucu_id!= null and $response>0){
			//genera el array de los correos
			$corr_correos = explode('#',$this->input->post('CORR_CORREO'));
			$response=$this->mcorreos->deleteCorreosAll($sucu_id,'suc');
			$corr_data;
			$total_correos=0;
			foreach ($corr_correos as $corr_correo) {
				if($corr_correo !='' and $corr_correo!= null){
					$corr_data=array(
						'cli_id'=>$sucu_id,
						'corr_correo'=>$corr_correo
					);
					$response=$this->mcorreos->insertCorreo($corr_data,'suc');
					if($response==1){
						$total_correos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_correos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'update_correos','descripcion_log'=>$total_correos.' correos para el perfil: '.$sucu_id));
			}
		}else{
			echo $response;
		}
		
		echo 'SUCCESS;'.$response;
	}
	

	public function deleteSucursales(){
		$sucu_id=$this->input->post('SUCU_ID');
		
		$returned=$this->msucursales->deleteSucursales($sucu_id);
		/*if($returned)
		$returned=$this->mdirecciones->deleteDireccion($sucu_id,'suc');
		if($returned)
		$returned=$this->mtelefonos->deleteTelefonosAll($sucu_id,'suc');
		if($returned)
		$returned=$this->mcorreos->deleteCorreosAll($sucu_id,'suc');*/
		
		if($returned){
			$this->mlogs->insertLog(array('tipo_log'=>'delete_sucursal','descripcion_log'=>'se elimino la sucursal: '.$sucu_id));
		}
		echo 'SUCCESS;'.$returned;
	}
	
}

?>