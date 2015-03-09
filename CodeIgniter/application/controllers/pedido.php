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

	/**
	 * Si el usuario está logueado, procede al trámite de compra
	 * Si no, muestra el login para iniciar la sesión.
	 */
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
	
	
	/**
	 * Crea el pedido, crea una línea por cada producto y elimina el carrito
	 */
	function crearPedido()
	{	
		//recoge los datos del usuario
		$datos=$this->datosusuario();
		
		//inserta los datos del pedido
		$this->Pedido_model->insertaPedido($datos);
		
		//recogemos los productos del carrito
		$carrito = $this->cart->contents();
		
		//por cada producto del carrito inserta una linea nueva
		foreach($carrito as $valor)
		{
			$idusuario=$datos['id'];
			
			//recuperamos los datos del pedido
			$pedido=$this->datosPedido($idusuario);
			
			$idpedido=$pedido['pedido_id'];
			
			//Datos para insertar una linea nueva.
			$detalles['pedido_id']=$idpedido;	
			$detalles['producto_id']=$valor['id'];
			$detalles['precio']=$valor['price'];
			$detalles['cantidad']=$valor['qty'];
			
			$producto = $this->datosProducto($detalles['producto_id']);
			
			//Inserta linea
			$this->Pedido_model->insertaLinea($detalles);
			
			//Al comprar, actualizamos la cantidad al stock
			$this->Pedido_model->actualizarStock($detalles['producto_id'], $detalles['cantidad']);
		}
		
		$datospedido = array('datospedido' => $pedido);
		$datosproducto = array('datosproducto' => $producto);
		
		
		$data = array (
			'usuario' => $datos,
			'pedido' => $datospedido,
			'carrito' => $detalles,
			'producto' => $datosproducto,
			'exito' => 'Su compra ha sido realizada.'
		);
		
		//Borramos el carrito
		$this->cart->destroy();
		//cargamos la vista
		$this->plantilla($this->load->view('comprado', $data, TRUE));
		
	}
	
	/**
	 * Devuelve los datos de un pedido determinado.
	 * @param $idusuario
	 * @return datos de un pedido
	 */
	function datosPedido($idusuario)
	{
		$result = $this->Pedido_model->datosCompra($idusuario);
	
		if ($result == TRUE)
		{
			$datos = array (
					'pedido_id' => $result [0]->id,
					'producto_id' => $result [0]->usuario_id,
					'estado' => $result [0]->estado,
					'fecha' => $result [0]->fecha,
					'nombre' => $result [0]->nombre,
					'apellidos' => $result [0]->apellidos,
					'dni' => $result [0]->dni,
					'direccion' => $result [0]->direccion,
					'cp' => $result [0]->cp,
					'provincia' => $result [0]->provincia
			);
		}
		return($datos);
	}
	
	/**
	 * Recoge los datos de un producto determinado.
	 * @param unknown $idProd
	 * @return multitype:NULL
	 */
	function datosProducto($idProd)
	{
		$result = $this->Pedido_model->datosProducto($idProd);
		
		if ($result == TRUE)
		{
			$datos = array (
					'idproducto' => $result [0]->id,
					'idcategoria' => $result [0]->categoria_id,
					'nombre' => $result [0]->nombre,
					'precio' => $result [0]->precio,
					'descuento' => $result [0]->descuento,
					'imagen' => $result [0]->imagen,
					'descripcion' => $result [0]->descripcion,
					'anuncio' => $result [0]->anuncio
			);
		}
		return($datos);
	}
	
	/**
	 * Muestra los pedidos de un usuario.
	 */
	function verPedidos()
	{
		$datos=$this->datosusuario();
		$idusuario=$datos['id'];
		$pedidos = $this->Pedido_model->muestraPedidos($idusuario);
		
		$lista = array('rsPedidos' => $pedidos);
		$data = array('pedidos' => $lista);
		
		$this->plantilla($this->load->view('pedidos', $data, TRUE));
	}
}