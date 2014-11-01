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
		$this->load->helper('jsClientes');//carga el helper bsico para las view
		$this->load->model('estados/mestados');
		$this->load->model('clientes/mclientes');
		$this->load->model('direcciones/mdirecciones');
		$this->load->model('telefonos/mtelefonos');
		$this->load->model('correos/mcorreos');
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
		
		//establece los datos del cliente para la insercion
		$cli_data=array(
		'nombre'=>$this->input->post('nombre'),
		'rfc'=>$this->input->post('rfc')
		);
		//inserta y recibe el id generado en la insercion
		$cli_id= $this->mclientes->insertCliente($cli_data);
		
		//inserta la direccion para le cliente
		if($cli_id>0 and $cli_id!= null){
			//establece los datos del cliente para la insercion
			$dir_data=array(
			'cli_id'=>$cli_id,
			'dir_estado'=>$this->input->post('dir_estado'),
			'dir_calle'=>$this->input->post('dir_calle'),
			'dir_num_ext'=>$this->input->post('dir_num_ext'),
			'dir_num_int'=>$this->input->post('dir_num_int'),
			'dir_col'=>$this->input->post('dir_col'),
			'dir_muni'=>$this->input->post('dir_muni'),
			'dir_cp'=>$this->input->post('dir_cp')
			);
			
			//inserta y recibe el id generado en la insercion
			$dir_id= $this->mdirecciones->insertDireccion($dir_data);
		}
		
		//inserta los telefonos para el cliente
		if($cli_id>0 and $cli_id!= null){
			//genera el array de los numeros de telefono
			$tel_numeros = explode('#',$this->input->post('tel_num'));
			$tel_data;
			foreach ($tel_numeros as $tel_num) {
				if($tel_num>0 and $tel_num!= null){
					$tel_data=array(
						'cli_id'=>$cli_id,
						'tel_numero'=>$tel_num
					);
					
					$this->mtelefonos->insertTelefono($tel_data);
				}
			}
		}
		
		//inserta los correos para el cliente
		if($cli_id>0 and $cli_id!= null){
			//genera el array de los correos
			$corr_correos = explode('#',$this->input->post('corr_correo'));
			$corr_data;
			foreach ($corr_correos as $corr_correo) {
				if($corr_correo !='' and $corr_correo!= null){
					$corr_data=array(
						'cli_id'=>$cli_id,
						'corr_correo'=>$corr_correo
					);
					$this->mcorreos->insertCorreo($corr_data);
				}
			}
		}
		
		echo $cli_id .'-'.$dir_id;
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
	public function selectCliente()
	{	$json='[';
		$res=$this->mclientes->selectClientes();
		if($res!=false){
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
			echo "no data found";
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
		$data['estados']= $this->mestados->selectEstados();
		$data['id_cliente']=$this->input->get('id_cliente');
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
		$data['string']= 'Hola mundo 22';
		$this->load->view('clientes/vClientesUpdate',$data);
	}
	
}
/* End of file cClientes.php */
/* Location: ./application/controllers/clientes/cClientes.php */
?>

