<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CClientes extends CI_Controller {

	/**
	 * Controlador para actualizar la información de los clientes.
	 *
	 * @author Luis Briseño
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('pagina');//carga el helper bsico para las view
		$this->load->model('estados/mestados');
		$this->load->model('clientes/mclientes');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('clientes/vClientesUpdate');
	}
	/*
	 * crear el formulario para insertar el cliente
	 * */
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
	public function insertCliente($datosCliente,$telCliente,$dirCliente)
	{
		$idCliente=0;//Almacenara el ID generado en la insercion
		//$this->input->post('cli_nombre'); toma los datos enviados
		//$this->load->view('clientes/vClientesUpdate');
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'rfc' => $this->input->post('rfc_txt'), 
		'creado_en' => '9999-12-31 23:59:59', 
		'creado_por' =>  01);
		
		$this->mClientes->insertarCliente($datos);
		return $idCliente;
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
	{
		$this->load->view('clientes/vClientesUpdate');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>

