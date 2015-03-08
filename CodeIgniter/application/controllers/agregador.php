<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . '/libraries/JSON_WebServer_Controller.php');

class Agregador extends JSON_WebServer_Controller 
{
    public function __construct() 
	{
        parent::__construct();
        $this->load->model('Producto_model');
        $this->load->database();
        $this->RegisterFunction('Total()', 'Devuelve el número de elementos que tenemos en la tienda');
        $this->RegisterFunction('Lista(offset, limit)', 'Devuelve una lista de productos de tamaño máximo [limit] comenzando desde la posición desde [offset]');
    }

    public function Total() 
	{
        $condicion = "fecha_inicio < now() AND fecha_fin >= now()";
        
        $this->db->from('producto');
		$this->db->where('destacado', 1);
        $this->db->where($condicion);
		$total_rows = $this->db->count_all_results();
	
		return $total_rows;
    }

    public function Lista($offset, $limit) 
	{
        $lista = array();
        //$destacados = $this->Producto_model->ProductosDestacados($offset=0, $limit=0);
        $condicion = "fecha_inicio < now() AND fecha_fin >= now()";
        $this->db->where($condicion);
        
        $this->db->where('destacado', 1);
        $this->db->where('oculto', 0);
        $query= $this->db->get('producto', $limit, $offset);
        $destacados = $query->result_array();

        //var_dump($destacados);
        foreach ($destacados as $key => $valor) 
        {
            $lista[$key]['nombre'] = $valor['nombre'];
            $lista[$key]['descripcion'] = $valor['descripcion'];
            $lista[$key]['precio'] = $valor['precio'];
            $lista[$key]['img'] = base_url().$valor['imagen'];
            $lista[$key]['url'] = site_url('/tienda/muestraDetalles/'.$valor['id']);
        }
        
        /*echo "<pre>";
        print_r($lista);
        echo "</pre>";*/
        return $lista;
    }
}