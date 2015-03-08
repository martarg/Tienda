<?php	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Pedido extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//cargo los modelos
		$this->load->model('Pedido_model');
		$this->load->model('Producto_model');
		$this->load->model('Usuario_model');
		$this->load->model('Carrito_model');
		$this->load->library('cart');
	}
	
	/**
	 * Carga la plantilla html (encabezado, menu, cuerpo y pie).
	 * @param unknown $cuerpo
	 */
	protected function plantilla($cuerpo)
	{
		if(isset($this->session->userdata['valido']))
		{
			$sesion = $this->session->userdata['valido'];
				
			//Carga del encabezado
			$encabezado = $this->load->view('header', $sesion,TRUE);
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

	function tramitar()
	{
		if(isset($this->session->userdata['valido']))
		{
			$this->plantilla($this->load->view('tramite', '', TRUE));
		}
		else 
		{
			$this->plantilla($this->load->view('login', '', TRUE));
		}
	}
	
	
	/**
	 * Devuelve los datos del usuario
	 * @return multitype:NULL
	 */
	function datosUsuario()
	{
		$result = $this->Usuario_model->informacionUsuario($this->session->userdata('valido'));
	
		if ($result != false)
		{
			$data = array (
					'id' => $result[0]->id,
					'nombre' => $result [0]->nombre,
					'apellidos' => $result [0]->apellidos,
					'dni' => $result [0]->dni,
					'direccion' => $result [0]->direccion,
					'cp' => $result [0]->cp,
					'provincia_id' => $result [0]->provincia_id,
					'provincia' => $this->Usuario_model->NombreProvincia($result [0]->provincia_id),
					'usuario' => $result [0]->usuario,
					'email' => $result [0]->email,
					'password' => $result [0]->password
			);
		}
	
		return $data;
	}
	
	
	function crearPedido()
	{
		$datosUsuario = $this->datosUsuario();

		$usuario = $datosUsuario['id']; 
		
		//insertamos los datos del pedido
		$this->Pedido_model->insertaPedido($datosUsuario);
		
		//$compra = $this->Pedido_model->datosCompra($pedido, $usuario);
		
		$this->plantilla($this->load->view('comprado', array('pedido'=>$compra), TRUE));
		
	}
}