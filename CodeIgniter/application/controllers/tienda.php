<?php
class Tienda extends CI_Controller
{
	function index()
	{	
		//cargo el modelo de productos
		$this->load->model('Producto_model');
		
		//pido los ultimos art�culos al modelo
		$ultimosArticulos = $this->Producto_model->ultimosProductos();
		//creo el array con datos de configuraci�n para la vista
		$this->showPlantilla(
				$this->load->view('cuerpo', array('rs_articulos' => $ultimosArticulos), TRUE));
	}
	
	/**
	 * Carga la plantilla html (encabezado, menu, cuerpo y pie).
	 * @param unknown $cuerpo
	 */
	protected function showPlantilla($cuerpo)
	{
		//Pido la carga del encabezado
		$encabezado = $this->load->view('header', '',TRUE);
		
		//Pido las categorías al modelo
		$categorias = $this->Producto_model->Categorias();
		$menu_izq = $this->load->view('menu_izq', array('rs_categorias' => $categorias), TRUE);
		
		
		//Creo una plantilla con los apartados a mostrar
		$this->load->view('plantilla', array(
				'encabezado' => $encabezado,
				'menu_izq' => $menu_izq,
				'cuerpo' => $cuerpo,
				'pie' => ''
		));		
	}
	
	/**
	 * Muestra los detalles de un producto. 
	 * @param unknown $id
	 */
	function muestraDetalles($id)
	{
		$this->load->helper('url');
		
		//cargo el modelo de productos
		$this->load->model('Producto_model');
		
		$arrayProductos = $this->Producto_model->detallesProd($id);
		
		if(!$arrayProductos)
		{
			show_404();
		}
		else
		{
			$this->showPlantilla(
					$this->load->view('vista_detalles', $arrayProductos, TRUE));
		}
	}
	
	/**
	 * Función que carga la vista de los productos por categoría.
	 * @param unknown $id
	 */
	function muestraCategoria($id)
	{
		$this->load->model('Producto_model');
		
		$prodCategoria = $this->Producto_model->ProductosPorCategoria($id);
		
		$this->showPlantilla(
				$this->load->view('vista_categoria', array('rs_prod' => $prodCategoria), TRUE));
	}
}