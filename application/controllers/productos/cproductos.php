<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cproductos extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('pagina');
		$this->load->helper('form');
		$this->load->model('productos/mproductos');
		$this->load->model('productos/mcategoriaproductos');
		$this->load->library('table');
	}
	//muestra la vista para crear un producto
	public function insertProductoForm(){
		$datos['categorias'] = $this->mproductos->selectCategorias();
		$this->load->view('productos/vProductosInsert',$datos);
	}
	//inserta el producto
	public function insertProducto()
	{
		$prod_id=0;//Almacenara el ID generado en la insercion
		$prod_data;//Almacenara el array de datos del cliente para la insercion
		$returned;
		
		//establece los datos del cliente para la insercion
		$prod_data=array(
		'prod_cat'=>$this->input->post('PROD_CATEGORIA'),
		'prod_nombre'=>$this->input->post('PROD_NOMBRE'),
		'prod_desc'=>$this->input->post('PROD_DESC'),
		'prod_precio_nor'=>$this->input->post('PROD_PRECIO_NOR'),
		'prod_precio_adv'=>$this->input->post('PROD_PRECIO_ADV'),
		'prod_precio_pre'=>$this->input->post('PROD_PRECIO_PRE')
		);
		//inserta y recibe el id generado en la insercion
		$prod_id= $this->mproductos->insertProducto($prod_data);
		if($prod_id>0){
			echo 'SUCCESS;'.$prod_id;
		}else{
			echo 'ERROR;'.$prod_id;
		}
	}
	
	/**
	 * Actualiza Producto
	 *
	 * Actualiza un producto, recibe los datos en un arreglo.
	 *
	 * @access	public
	 * @param	array los datos del cliente
	 * @return	int
	 */
	public function updateProducto()
	{
		$prod_id=$this->input->post('PROD_ID');//Almacenara el ID generado en la actualizacion
		$prod_data;//Almacenara el array de datos del producto para la actualizacion
		$response=0;
		
		//establece los datos del producto para la actualizacion
		$prod_data=array(
		'prod_id'=>$prod_id,
		'prod_cat'=>$this->input->post('PROD_CATEGORIA'),
		'prod_nombre'=>$this->input->post('PROD_NOMBRE'),
		'prod_desc'=>$this->input->post('PROD_DESC'),
		'prod_precio_nor'=>$this->input->post('PROD_PRECIO_NOR'),
		'prod_precio_adv'=>$this->input->post('PROD_PRECIO_ADV'),
		'prod_precio_pre'=>$this->input->post('PROD_PRECIO_PRE'),
		'prod_estatus'=>$this->input->post('PROD_ESTATUS')
		);
		//inserta y recibe el id generado en la actualizacion
		$response = $this->mproductos->updateProducto($prod_data);
		
		if($response>0){
			echo 'SUCCESS;'.$response;
		}else{
			echo 'ERROR;'.$response;
		}
	}
	
	//regresa todos los productos
	public function getValues(){
		$sysdate=new DateTime();
		
		$datos = array('nombre' => $this->input->post('nombre_txt'), 
		'categoria' => $this->input->post('categoria'), 
		'precio' => $this->input->post('precio_txt'), 
		'proveedor' => $this->input->post('proveedor_txt'), 
		'estatus' => $this->input->post('estatus'), 
		'descripcion' => $this->input->post('descripcion_txt'), 
		'creado_en' => $sysdate->format('Y-m-d H:i:s'));
		
		$this->mproductos->insertProducto($datos);

	}
	
	/**
	 * Select Producto Json
	 *
	 * regresa los clientes que coinciden con las condiciones en formato json.
	 * @author Luis Briseño
	 * @access	public
	 * @return	string
	 */
	public function selectProductoJson()
	{
		$prod_id=$this->input->post('PROD_ID');
		$prod_nombre=$this->input->post('PROD_NOMBRE');
		$prod_desc=$this->input->post('PROD_DESC');
		$where_clause=array();
		if($prod_id!= null and $prod_id!=''){
			$where_clause['prod_id']=$prod_id;
		}
		if($prod_nombre!= null and $prod_nombre!=''){
			$where_clause['prod_nombre']=$prod_nombre;
		}
		if($prod_desc!= null and $prod_desc!=''){
			$where_clause['prod_desc']=$prod_desc;
		}
		
		$res=$this->mproductos->selectProductos($where_clause);
		if($res!=false){
			$json='[';
			$last=$res->last_row();
			foreach ( $res->result() as $producto) {
				$json.='{';
				$json.='"prod_id":'.'"'.$producto->id_producto.'",';
				$json.='"prod_cat":'.'"'.$producto->id_categoriaProducto.'",';
				$json.='"prod_nombre":'.'"'.$producto->nombre_producto.'",';
				$json.='"prod_desc":'.'"'.$producto->descripcion_producto.'",';
				$json.='"prod_precio_nor":'.'"'.$producto->precio1.'",';
				$json.='"prod_precio_adv":'.'"'.$producto->precio2.'",';
				$json.='"prod_precio_pre":'.'"'.$producto->precio3.'",';
				$json.='"prod_estatus":'.'"'.$producto->estatus_producto.'"';
				$json.='}';
				if($producto->id_producto!=$last->id_producto){
					$json.=',';
				}
			}
			$json.=']';
					
			echo $json;
		}else{
			echo "NO_DATA_FOUND";
		}
	}
	
	//muestra el form para consultar los productos
	public function selectProductosForm(){
		$this->load->view('productos/vProductosSelect');
	}
	
	/* Form Select/Update Producto
	 *
	 * Crea el formulario para seleccionar/actualizar un Producto
	 * 
	 * @author Luis Briseño
	 * @access	public
	 * 
	 */
	public function formUpdateProducto(){
		$id_producto=$this->input->get('prod_id');
		$data['producto']=$this->mproductos->selectProductoById($id_producto);
		$data['categorias']=$this->mcategoriaproductos->selectCategoriaProductos();
		$this->load->view('productos/vProductosUpdate',$data);
	}

	/* Delete Producto
	 *
	 * Elimina el Producto de la Base de datos
	 * 
	 * @author Luis Briseño
	 * @access	public
	 * 
	 */
	public function deleteProducto(){
		$prod_id=$this->input->post('PROD_ID');
		
		$returned=$this->mproductos->deleteProducto($prod_id);
		
		if($returned){
			$this->mlogs->insertLog(array('tipo_log'=>'delete_producto','descripcion_log'=>'se elimino el producto: '.$prod_id));
			echo 'SUCCESS;';
		}else{
			echo 'ERROR;'.$returned;
		}
	}
	
			
} 
?>