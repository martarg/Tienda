<?php
class Carrito_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function agregarProd($id)
	{
		$this->db->from('producto');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		
		foreach($query->result() as $producto)
		{
			$data[]= $producto;
		}
		return $producto;
	}
}
