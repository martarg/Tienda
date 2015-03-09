<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Tienda extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		//cargo el modelo de productos
		$this->load->model('Producto_model');
	}
	
	function index()
	{	
		$this->destacados($inicio=0);	
	}
	
	/**
	 * Carga la plantilla html (encabezado, menu, cuerpo y pie).
	 * @param unknown $cuerpo
	 */
	protected function showPlantilla($cuerpo)
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
		
		//Pido las categorías al modelo
		$categorias = $this->Producto_model->ListaCategorias();
		$menu_izq = $this->load->view('menu_izq', array('rs_categorias' => $categorias), TRUE);
		
		$pie = $this->load->view('footer', '', TRUE);
		
		//Creo una plantilla con los apartados a mostrar
		$this->load->view('plantilla', array(
				'encabezado' => $encabezado,
				'menu_izq' => $menu_izq,
				'cuerpo' => $cuerpo,
				'pie' => $pie
		));		
	}
	
	/**
	 * Muestra los detalles de un producto. 
	 * @param unknown $id
	 */
	function muestraDetalles($id)
	{
		$this->load->helper('url');
		
		$arrayProductos = $this->Producto_model->detallesProd($id);
		
		if(!$arrayProductos)
		{
			show_404();
		}
		else
		{
			if(isset($arrayProductos['descuento']) && $arrayProductos['descuento'] != 0)
			{
				$desc = $arrayProductos['descuento']*$arrayProductos['precio']/100;
				$precioDesc = round(($arrayProductos['precio'] - $desc)*100)/100;
								
				$arrayProductos['preciofinal'] = $precioDesc;
			}
			
			$this->showPlantilla(
					$this->load->view('vista_detalles', $arrayProductos, TRUE));
		}
	}
	
	/**
	 * Función que carga la vista de los productos por categoría.
	 * @param unknown $id
	 */
	function muestraCategoria($id, $offset=0)
	{
		//Carga la biblioteca paginación
		$this->load->library('pagination');
		$limit = 2;
		
		//Obtenemos el total de productos por categoría
		$totalProd = $this->Producto_model->totalProdCategoria($id);
		
		//Parámetros de configuración
		$config['base_url'] = site_url('tienda/muestraCategoria/'.$id);
		$config['total_rows'] = $totalProd;
		$config['per_page'] = $limit;
		
		/*Configuración paginación bootstrap*/
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = FALSE;
		$config['first_link'] = FALSE;
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['uri_segment'] = 4;
		
		//Inicializamos
		$this->pagination->initialize($config);
		
		$prodCategoria = $this->Producto_model->ProductosPorCategoria($id, $offset, $limit);
		
		$porCategoria = array ('rs_prod' => $prodCategoria);

		$datos = array (
			'productos' => $porCategoria,
			'paginacion' => $this->pagination->create_links()
		);
		
		
		$this->showPlantilla(
				$this->load->view('vista_categoria', $datos, TRUE));
	}
	
	/**
	 * Carga la vista con los productos destacados.
	 * @param number $inicio
	 */
	public function destacados($inicio=0)
	{	
		//Carga la biblioteca paginación
		$this->load->library('pagination');
		$limit = 3;
		
		$totalProd = $this->Producto_model->totalDestacados();
		
		//Parámetros de configuración
		$config['base_url'] = site_url('tienda/destacados');
		$config['total_rows'] = $totalProd;
		$config['per_page'] = $limit;
		
		/*Configuración paginación bootstrap*/
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = FALSE;
		$config['first_link'] = FALSE;
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		//Inicializamos
		$this->pagination->initialize($config);
		
		
		//pido los productos destacados al modelo
		$destacados = $this->Producto_model->ProductosDestacados($inicio, $limit);
		
		$prodDest = array('rs_articulos' => $destacados);
		
		$data = array(
			'productos' => $prodDest,
			'paginador' => $this->pagination->create_links()
		);
		
		//creo el array con datos de configuración para la vista
		$this->showPlantilla(
				$this->load->view('cuerpo', $data, TRUE));
	}	
}