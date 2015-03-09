<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Carrito extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Carrito_model');
		$this->load->model('Producto_model');
		$this->load->library('cart');
	}
	
	function index()
	{
		$this->verPlantilla($this->load->view('carro', '', TRUE));
	}
	
	/**
	 * Carga la plantilla html
	 * @param unknown $cuerpo
	 */
	function verPlantilla($cuerpo)
	{
		if(isset($this->session->userdata['valido']))
		{
			$sesion = $this->session->userdata['valido'];
				
			//Carga del encabezado
			$encabezado = $this->load->view('header', $sesion, TRUE);
		}
		else
		{
			//Carga del encabezado
			$encabezado = $this->load->view('header', '',TRUE);
		}
		$pie = $this->load->view('footer', '', TRUE);
		
		//Creo una plantilla con los apartados a mostrar
		$this->load->view('plantilla', array(
				'encabezado' => $encabezado,
				'menu_izq' => '',
				'cuerpo' => $cuerpo,
				'pie' => $pie
		));
	}
	
	/**
	 * Añade productos al carrito
	 */
	function agregarProducto()
	{
		//Recogemos el id y la cantidad del producto.
		$id = $this->input->post('id');
		$cantidad = $this->input->post('cantidad');
		
		$producto = $this->Carrito_model->agregarProd($id);
		
		$carrito = $this->cart->contents();
		
		foreach ($carrito as $item)
		{
			if($item['id'] == $id)
			{
				$cantidad = $cantidad + $item['qty'];
			}
		}
		
		//Comprueba si hay descuento y calcula el precio
		if(($producto->descuento != NULL) && ($producto->descuento !=0))
		{
			$descuento = ($producto->precio * $producto->descuento/100);
			$preciofinal = round($producto->precio - $descuento,2);
		}
		else
		{
			$preciofinal = $producto->precio;
		}
		
		//cogemos los productos en un array para insertarlos en el carrito
		$data = array(
				'id' => $id,
				'qty' => $cantidad,
				'price' => $preciofinal,
				'name' => $producto->nombre
		);
		
		//insertamos al carrito
		$this->cart->insert($data);
		
		//cogemos la url para redirigir a la página en la que estabamos
		$uri = $this->input->post('uri');
		
		$this->session->set_flashdata('agregado', 'El producto ha sido añadido al carrito.');
		redirect('tienda'.$uri, 'refresh');
	}
	
	/**
	 * Elimina UN producto del carrito
	 * @param unknown $rowid
	 */
	function eliminaProducto($rowid)
	{
		//para eliminar un producto en especifico lo que hacemos es conseguir su id
		//y actualizarlo poniendo qty que es la cantidad a 0
		$producto = array(
				'rowid' => $rowid,
				'qty' => 0
		);
		//después simplemente utilizamos la función update de la librería cart
		//para actualizar el carrito pasando el array a actualizar
		$this->cart->update($producto);
	
		$this->session->set_flashdata('productoEliminado', 'El producto fue eliminado correctamente');
		redirect('carrito', 'refresh');
	}
	
	/**
	 * Vacía el carrito
	 */
	function eliminaCarrito()
	{
		$this->cart->destroy();
		$this->session->set_flashdata('destruido', 'El carrito fue eliminado correctamente');
		redirect('carrito', 'refresh');
	}
}