<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CUsuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('pagina');//carga el helper bsico para las view
		$this->load->model('estados/mestados');
		$this->load->model('usuarios/musuarios');
		$this->load->model('direcciones/mdirecciones');
		$this->load->model('telefonos/mtelefonos');
		$this->load->model('correos/mcorreos');
		$this->load->model('logs/mlogs');

	}
	
	public function index()
	{
		//$this->load->view('sucursales/vClientesUpdate');
	}

	public function formInsertUsuarios(){
		$this->load->helper('form');//carga el helper para los formularios
		$data['estados']= $this->mestados->selectEstados();
		$data['sucursales']= $this->musuarios->selectSucursales();
		$data['tipousuarios']= $this->musuarios->selectTipoUsuarios();
		$this->load->view('usuarios/vusuariosinsert',$data);
	}

	public function insertUsuarios()
	{
		$usr_id=0;//Almacenara el ID generado en la insercion
		$usr_data;
		$dir_data;//Almacenara el array de datos de la direccion para la insercion
		$returned;
		
		//establece los datos del cliente para la insercion
		$usr_data=array(
		'nombre'=>$this->input->post('NOMBRE'),
		'password'=>$this->input->post('PASSWORD'),
		'id_tipousuario'=>$this->input->post('USR_TIPOUSUARIO'),
		'id_sucursal'=>$this->input->post('USR_SUCURSAL'),
		'estatus'=>$this->input->post('USR_ESTATUS')
		);
		//inserta y recibe el id generado en la insercion
		$usr_id= $this->musuarios->insertUsuarios($usr_data);
		
		//inserta la direccion para le usuario
		if($usr_id>0 and $usr_id!= null){
			//establece los datos del cliente para la insercion
			$dir_data=array(
			'cli_id'=>$usr_id,
			'dir_estado'=>$this->input->post('DIR_ESTADO'),
			'dir_calle'=>$this->input->post('DIR_CALLE'),
			'dir_num_ext'=>$this->input->post('DIR_NUM_EXT'),
			'dir_num_int'=>$this->input->post('DIR_NUM_INT'),
			'dir_col'=>$this->input->post('DIR_COL'),
			'dir_muni'=>$this->input->post('DIR_MUNI'),
			'dir_cp'=>$this->input->post('DIR_CP')
			);
			
			//inserta y recibe el id generado en la insercion
			$returned= $this->mdirecciones->insertDireccion($dir_data,'usr');
		}
		else{
			echo $returned;
		}
		
		//inserta los telefonos para el usuario
		if($usr_id>0 and $usr_id!= null and $returned>0){
			//genera el array de los numeros de telefono
			$tel_numeros = explode('#',$this->input->post('TEL_NUM'));
			$tel_data;
			$total_telefonos=0;
			foreach ($tel_numeros as $tel_num) {
				if($tel_num>0 and $tel_num!= null){
					$tel_data=array(
						'cli_id'=>$usr_id,
						'tel_numero'=>$tel_num
					);
					
					$returned=$this->mtelefonos->insertTelefono($tel_data,'usr');
					if($returned==1){
						$total_telefonos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_telefonos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'insert_telefonos','descripcion_log'=>$total_telefonos.' telefonos para el perfil: '.$usr_id));
			}
		}else{
			echo $returned;
		}
		
		//inserta los correos para el cliente
		if($usr_id>0 and $usr_id!= null  and $returned>0){
			//genera el array de los correos
			$corr_correos = explode('#',$this->input->post('CORR_CORREO'));
			$corr_data;
			$total_correos=0;
			foreach ($corr_correos as $corr_correo) {
				if($corr_correo !='' and $corr_correo!= null){
					$corr_data=array(
						'cli_id'=>$usr_id,
						'corr_correo'=>$corr_correo
					);
					$returned=$this->mcorreos->insertCorreo($corr_data,'usr');
					if($returned==1){
						$total_correos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_correos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'insert_correos','descripcion_log'=>$total_correos.' correos para el perfil: '.$usr_id));
			}
		}else{
			echo $returned;
		}
		
		echo 'SUCCESS;'.$usr_id;
	}
	

	public function formSelectUsuarios(){
		$this->load->helper('form');//carga el helper para los formularios
		$data['estados']= $this->mestados->selectEstados();
		$this->load->view('usuarios/vusuariosselect',$data);
	}

	public function selectUsuariosJson()
	{
		$usr_id=$this->input->post('usr_id');
		$usr_nombre=$this->input->post('usr_nombre');
		$usr_tipousuario=$this->input->post('usr_tipo');
		$where_clause=array();
		if($usr_id!= null and $usr_id!=''){
			$where_clause['usr_id']=$usr_id;
		}
		if($usr_nombre!= null and $usr_nombre!=''){
			$where_clause['usr_nombre']=$usr_nombre;
		}
		if($usr_tipousuario!= null and $usr_tipousuario!=''){
			$where_clause['usr_tipousuario']=$usr_tipousuario;
		}
		
		$res=$this->musuarios->selectUsuarios($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $usuario) {
				$json.='{';
				$json.='"id":'.'"'.$usuario->id_usuario.'",';
				$json.='"nombre":'.'"'.$usuario->nombre_usuario.'",';
				$json.='"tipousuario":'.'"'.$usuario->nombre_tipousuario.'"';
				$json.='}';
				if($usuario->id_usuario!=$last->id_usuario){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}
	}
	
	public function formUpdateUsuarios(){
		$this->load->helper('form');//carga el helper para los formularios
		$id_usr=$this->input->get('id_usuario');
		$data['estados']= $this->mestados->selectEstados();
		$data['sucursales']= $this->musuarios->selectSucursales();
		$data['tipousuarios']= $this->musuarios->selectTipoUsuarios();
		$data['usuarios']=$this->musuarios->selectUsuariosById($id_usr);
		$data['direccion']=$this->mdirecciones->selectDireccionByCliId($id_usr,'usr');
		$data['telefono']=$this->mtelefonos->selectTelefonosByCliId($id_usr,'usr');
		$data['correo']=$this->mcorreos->selectCorreosByCliId($id_usr,'usr');
		$this->load->view('usuarios/vusuariosupdate',$data);
	}


	public function updateUsuarios()
	{
		$usr_id=$this->input->post('USR_ID');//Almacenara el ID generado en la actualizacion
		$usr_data;//Almacenara el array de datos del cliente para la actualizacion
		$dir_data;//Almacenara el array de datos de la direccion para la actualizacion
		$response=0;
		
		//establece los datos de la sucursal para la actualizacion
		$usr_data=array(
		'usr_id'=>$usr_id,
		'nombre'=>$this->input->post('NOMBRE'),
		'password'=>$this->input->post('PASSWORD'),
		'id_tipousuario'=>$this->input->post('USR_TIPOUSUARIO'),
		'id_sucursal'=>$this->input->post('USR_SUCURSAL'),
		'estatus'=>$this->input->post('USR_ESTATUS')
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->musuarios->updateUsuarios($usr_data);
		
		//inserta la direccion para le cliente
		if($usr_id>0 and $usr_id!= null and $response>0){
			//establece los datos del cliente para la actualizacion
			$dir_data=array(
			'cli_id'=>$usr_id,
			'dir_estado'=>$this->input->post('DIR_ESTADO'),
			'dir_calle'=>$this->input->post('DIR_CALLE'),
			'dir_num_ext'=>$this->input->post('DIR_NUM_EXT'),
			'dir_num_int'=>$this->input->post('DIR_NUM_INT'),
			'dir_col'=>$this->input->post('DIR_COL'),
			'dir_muni'=>$this->input->post('DIR_MUNI'),
			'dir_cp'=>$this->input->post('DIR_CP')
			);
			
			//inserta y recibe el id generado en la actualizacion
			$response=$this->mdirecciones->updateDireccion($dir_data,'usr');
		}else{
			echo $response;
		}
		
		//actualiza los telefonos para el cliente
		if($usr_id>0 and $usr_id!= null and $response>0){
			//genera el array de los numeros de telefono
			$tel_numeros = explode('#',$this->input->post('TEL_NUM'));
			$response=$this->mtelefonos->deleteTelefonosAll($usr_id,'usr');
			$tel_data;
			$total_telefonos=0;
			foreach ($tel_numeros as $tel_num) {
				if($tel_num>0 and $tel_num!= null){
					$tel_data=array(
						'cli_id'=>$usr_id,
						'tel_numero'=>$tel_num
					);
					
					$response=$this->mtelefonos->insertTelefono($tel_data,'usr');
					if($response==1){
						$total_telefonos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_telefonos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'update_telefonos','descripcion_log'=>$total_telefonos.' telefonos para el perfil: '.$usr_id));
			}
		}else{
			echo $response;
		}
		
		//actualiza los correos para el cliente
		if($usr_id>0 and $usr_id!= null and $response>0){
			//genera el array de los correos
			$corr_correos = explode('#',$this->input->post('CORR_CORREO'));
			$response=$this->mcorreos->deleteCorreosAll($usr_id,'usr');
			$corr_data;
			$total_correos=0;
			foreach ($corr_correos as $corr_correo) {
				if($corr_correo !='' and $corr_correo!= null){
					$corr_data=array(
						'cli_id'=>$usr_id,
						'corr_correo'=>$corr_correo
					);
					$response=$this->mcorreos->insertCorreo($corr_data,'usr');
					if($response==1){
						$total_correos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_correos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'update_correos','descripcion_log'=>$total_correos.' correos para el perfil: '.$usr_id));
			}
		}else{
			echo $response;
		}
		
		echo 'SUCCESS;'.$response;
	}
	

	public function deleteUsuarios(){
		$usr_id=$this->input->post('USR_ID');
		
		$returned=$this->musuarios->deleteUsuarios($usr_id);
		if($returned)
		$returned=$this->mdirecciones->deleteDireccion($usr_id,'usr');
		if($returned)
		$returned=$this->mtelefonos->deleteTelefonosAll($usr_id,'usr');
		if($returned)
		$returned=$this->mcorreos->deleteCorreosAll($usr_id,'usr');
		
		if($returned){
			$this->mlogs->insertLog(array('tipo_log'=>'delete_usuario','descripcion_log'=>'se elimino el usuario: '.$usr_id));
		}
		echo 'Mensage: '.$returned;
	}

}

?>

