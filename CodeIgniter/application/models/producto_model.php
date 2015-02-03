<?php
class Producto_model extends CI_Model
{
	function __construct()
	{	
		$this->load->database();
	}
	
	function ultimosProductos()
	{
		$query = $this->db->query('select * from producto');
		return $query->result_array();
	}
	
	function detallesProd($id)
	{
		$sql = "select * from producto where id=".$id;
		$rs = $this->db->query($sql);
		
		if($rs->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$row = $rs->row_array();
			return $row;
		}
	}
	
}