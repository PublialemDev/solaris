<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CClientes extends CI_Controller {

	/**
	 * Controlador para actualizar y consultar la información de los clientes.
	 *
	 * @author Luis Briseño
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('pagina');//carga el helper bsico para las view
		$this->load->model('estados/mestados');
		$this->load->model('clientes/mclientes');
		$this->load->model('direcciones/mdirecciones');
		$this->load->model('telefonos/mtelefonos');
		$this->load->model('correos/mcorreos');
		$this->load->model('logs/mlogs');
		//$this->load->helper('url');
		//$this->load->library('javascript');
		//$this->load->view('JS/clientes.js');
	}
	
	public function index()
	{
		$this->load->view('clientes/vClientesUpdate');
	}
	 /* Form Insert Cliente
	 *
	 * Crea el formulario para insertar un cliente
	 * 
	 * @author Luis Briseño
	 * @access	public
	 * 
	 */
	public function formInsertCliente(){
		$this->load->helper('form');//carga el helper para los formularios
		$data['estados']= $this->mestados->selectEstados();
		$this->load->view('clientes/vClientesInsert',$data);
	}
	/**
	 * Insertar Cliente
	 *
	 * Inserta un cliente, recibe los datos en tres arreglos.
	 *
	 * @access	public
	 * @param	array los datos del cliente
	 * @param	array los datos de los telefonos del cliente
	 * @param	array los datos de la direccion del cliente
	 * @return	int
	 */
	public function insertCliente()
	{
		$cli_id=0;//Almacenara el ID generado en la insercion
		$cli_data;//Almacenara el array de datos del cliente para la insercion
		$dir_data;//Almacenara el array de datos de la direccion para la insercion
		$returned;
		
		//establece los datos del cliente para la insercion
		$cli_data=array(
		'nombre'=>$this->input->post('NOMBRE'),
		'rfc'=>$this->input->post('RFC')
		);
		//inserta y recibe el id generado en la insercion
		$cli_id= $this->mclientes->insertCliente($cli_data);
		
		//inserta la direccion para le cliente
		if($cli_id>0 and $cli_id!= null){
			//establece los datos del cliente para la insercion
			$dir_data=array(
			'cli_id'=>$cli_id,
			'dir_estado'=>$this->input->post('DIR_ESTADO'),
			'dir_calle'=>$this->input->post('DIR_CALLE'),
			'dir_num_ext'=>$this->input->post('DIR_NUM_EXT'),
			'dir_num_int'=>$this->input->post('DIR_NUM_INT'),
			'dir_col'=>$this->input->post('DIR_COL'),
			'dir_muni'=>$this->input->post('DIR_MUNI'),
			'dir_cp'=>$this->input->post('DIR_CP')
			);
			
			//inserta y recibe el id generado en la insercion
			$returned= $this->mdirecciones->insertDireccion($dir_data,'cli');
		}
		else{
			echo $returned;
		}
		
		//inserta los telefonos para el cliente
		if($cli_id>0 and $cli_id!= null and $returned>0){
			//genera el array de los numeros de telefono
			$tel_numeros = explode('#',$this->input->post('TEL_NUM'));
			$tel_data;
			$total_telefonos=0;
			foreach ($tel_numeros as $tel_num) {
				if($tel_num>0 and $tel_num!= null){
					$tel_data=array(
						'cli_id'=>$cli_id,
						'tel_numero'=>$tel_num
					);
					
					$returned=$this->mtelefonos->insertTelefono($tel_data,'cli');
					if($returned==1){
						$total_telefonos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_telefonos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'insert_telefonos','descripcion_log'=>$total_telefonos.' telefonos para el perfil: '.$cli_id));
			}
		}else{
			echo $returned;
		}
		
		//inserta los correos para el cliente
		if($cli_id>0 and $cli_id!= null  and $returned>0){
			//genera el array de los correos
			$corr_correos = explode('#',$this->input->post('CORR_CORREO'));
			$corr_data;
			$total_correos=0;
			foreach ($corr_correos as $corr_correo) {
				if($corr_correo !='' and $corr_correo!= null){
					$corr_data=array(
						'cli_id'=>$cli_id,
						'corr_correo'=>$corr_correo
					);
					$returned=$this->mcorreos->insertCorreo($corr_data,'cli');
					if($returned==1){
						$total_correos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_correos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'insert_correos','descripcion_log'=>$total_correos.' correos para el perfil: '.$cli_id));
			}
		}else{
			echo $returned;
		}
		
		echo 'SUCCESS;'.$cli_id;
	}
	
	/* Form Select/Update Cliente
	 *
	 * Crea el formulario para seleccionar/actualizar un cliente
	 * 
	 * @author Luis Briseño
	 * @access	public
	 * 
	 */
	public function formSelectCliente(){
		$this->load->helper('form');//carga el helper para los formularios
		$data['estados']= $this->mestados->selectEstados();
		$this->load->view('clientes/vClientesSelect',$data);
	}
	/**
	 * Select cliente Json
	 *
	 * regresa los clientes que coinciden con las condiciones en formato json.
	 * @author Luis Briseño
	 * @access	public
	 * @return	string
	 */
	public function selectClienteJson()
	{
		$cli_id=$this->input->post('cli_id');
		$cli_nombre=$this->input->post('cli_nombre');
		$cli_rfc=$this->input->post('cli_rfc');
		$where_clause=array();
		if($cli_id!= null and $cli_id!=''){
			$where_clause['cli_id']=$cli_id;
		}
		if($cli_nombre!= null and $cli_nombre!=''){
			$where_clause['cli_nombre']=$cli_nombre;
		}
		if($cli_rfc!= null and $cli_rfc!=''){
			$where_clause['cli_rfc']=$cli_rfc;
		}
		
		$res=$this->mclientes->selectClientes($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $cliente) {
				$json.='{';
				$json.='"id":'.'"'.$cliente->id_cliente.'",';
				$json.='"nombre":'.'"'.$cliente->nombre_cliente.'",';
				$json.='"rfc":'.'"'.$cliente->rfc.'"';
				$json.='}';
				if($cliente->id_cliente!=$last->id_cliente){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}
	}
	
	/* Form Select/Update Cliente
	 *
	 * Crea el formulario para seleccionar/actualizar un cliente
	 * 
	 * @author Luis Briseño
	 * @access	public
	 * 
	 */
	public function formUpdateCliente(){
		$this->load->helper('form');//carga el helper para los formularios
		$id_cliente=$this->input->get('id_cliente');
		$data['estados']= $this->mestados->selectEstados();
		$data['cliente']=$this->mclientes->selectClienteById($id_cliente);
		$data['direccion']=$this->mdirecciones->selectDireccionByCliId($id_cliente,'cli');
		$data['telefono']=$this->mtelefonos->selectTelefonosByCliId($id_cliente,'cli');
		$data['correo']=$this->mcorreos->selectCorreosByCliId($id_cliente,'cli');
		$this->load->view('clientes/vClientesUpdate',$data);
	}
	
	/**
	 * Actualiza Cliente
	 *
	 * Actualiza un cliente, recibe los datos en tres arreglos.
	 *
	 * @access	public
	 * @param	array los datos del cliente
	 * @param	array los datos de los telefonos del cliente
	 * @param	array los datos de la direccion del cliente
	 * @return	int
	 */
	public function updateCliente()
	{
		$cli_id=$this->input->post('CLI_ID');//Almacenara el ID generado en la actualizacion
		$cli_data;//Almacenara el array de datos del cliente para la actualizacion
		$dir_data;//Almacenara el array de datos de la direccion para la actualizacion
		$response=0;
		
		//establece los datos del cliente para la actualizacion
		$cli_data=array(
		'cli_id'=>$cli_id,
		'nombre'=>$this->input->post('NOMBRE'),
		'rfc'=>$this->input->post('RFC')
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->mclientes->updateCliente($cli_data);
		
		//inserta la direccion para le cliente
		if($cli_id>0 and $cli_id!= null and $response>0){
			//establece los datos del cliente para la actualizacion
			$dir_data=array(
			'cli_id'=>$cli_id,
			'dir_estado'=>$this->input->post('DIR_ESTADO'),
			'dir_calle'=>$this->input->post('DIR_CALLE'),
			'dir_num_ext'=>$this->input->post('DIR_NUM_EXT'),
			'dir_num_int'=>$this->input->post('DIR_NUM_INT'),
			'dir_col'=>$this->input->post('DIR_COL'),
			'dir_muni'=>$this->input->post('DIR_MUNI'),
			'dir_cp'=>$this->input->post('DIR_CP')
			);
			
			//inserta y recibe el id generado en la actualizacion
			$response=$this->mdirecciones->updateDireccion($dir_data,'cli');
		}else{
			echo $response;
		}
		
		//actualiza los telefonos para el cliente
		if($cli_id>0 and $cli_id!= null and $response>0){
			//genera el array de los numeros de telefono
			$tel_numeros = explode('#',$this->input->post('TEL_NUM'));
			$response=$this->mtelefonos->deleteTelefonosAll($cli_id,'cli');
			$tel_data;
			$total_telefonos=0;
			foreach ($tel_numeros as $tel_num) {
				if($tel_num>0 and $tel_num!= null){
					$tel_data=array(
						'cli_id'=>$cli_id,
						'tel_numero'=>$tel_num
					);
					
					$response=$this->mtelefonos->insertTelefono($tel_data,'cli');
					if($response==1){
						$total_telefonos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_telefonos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'update_telefonos','descripcion_log'=>$total_telefonos.' telefonos para el perfil: '.$cli_id));
			}
		}else{
			echo $response;
		}
		
		//actualiza los correos para el cliente
		if($cli_id>0 and $cli_id!= null and $response>0){
			//genera el array de los correos
			$corr_correos = explode('#',$this->input->post('CORR_CORREO'));
			$response=$this->mcorreos->deleteCorreosAll($cli_id,'cli');
			$corr_data;
			$total_correos=0;
			foreach ($corr_correos as $corr_correo) {
				if($corr_correo !='' and $corr_correo!= null){
					$corr_data=array(
						'cli_id'=>$cli_id,
						'corr_correo'=>$corr_correo
					);
					$response=$this->mcorreos->insertCorreo($corr_data,'cli');
					if($response==1){
						$total_correos+=1;
					}
				}
			}
			//inserta log para auditoria
			if($total_correos>0){
				$this->mlogs->insertLog(array('tipo_log'=>'update_correos','descripcion_log'=>$total_correos.' correos para el perfil: '.$cli_id));
			}
		}else{
			echo $response;
		}
		
		echo 'SUCCESS;'.$response;
	}
	
	/* Delete Cliente
	 *
	 * Elimina el Cliente de la Base de datos
	 * 
	 * @author Luis Briseño
	 * @access	public
	 * 
	 */
	public function deleteCliente(){
		$cli_id=$this->input->post('CLI_ID');
		
		$returned=$this->mclientes->deleteCliente($cli_id);
		if($returned)
		$returned=$this->mdirecciones->deleteDireccion($cli_id,'cli');
		if($returned)
		$returned=$this->mtelefonos->deleteTelefonosAll($cli_id,'cli');
		if($returned)
		$returned=$this->mcorreos->deleteCorreosAll($cli_id,'cli');
		
		if($returned){
			$this->mlogs->insertLog(array('tipo_log'=>'delete_cliente','descripcion_log'=>'se elimino el cliente: '.$cli_id));
		}
		echo 'Mensage: '.$returned;
	}
	
}
/* End of file cClientes.php */
/* Location: ./application/controllers/clientes/cClientes.php */
?>

