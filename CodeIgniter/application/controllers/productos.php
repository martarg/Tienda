<?php
class Productos extends CI_Controller
{
	function index()
	{
		//cargo el helper de url, con funciones para trabajo con URL del sitio
		$this->load->helper('url');
		
		//cargo el modelo de productos
		$this->load->model('Producto_model');
		
		//pido los ultimos artículos al modelo
		$ultimosArticulos = $this->Producto_model->ultimosProductos();
		
		//creo el array con datos de configuración para la vista
		$datos_vista = array('rs_articulos' => $ultimosArticulos);
		
		$this->load->view('header');
		$this->load->view('cuerpo', $datos_vista);
		
		
	}
	
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
			$this->load->view('vista_detalles', $arrayProductos);
		}
		
		
	}
}