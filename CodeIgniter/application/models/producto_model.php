<?php
class Producto_model extends CI_Model
{
	function __construct()
	{	
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Devuelve los productos destacados.
	 */
	function ultimosProductos()
	{
		$query = $this->db->query('select * from producto where destacado = 1
										AND fecha_inicio < now()
											AND fecha_fin > now()');
		return $query->result_array();
	}
	
	/**
	 * Devuelve los detalles de un producto.
	 * @param unknown $id
	 * @return boolean|unknown
	 */
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
	
	/**
	 * Devuelve la lista de las categorías.
	 */
	function Categorias()
	{
		$sql = "select * from categoria order by nombre";
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}
	
	/**
	 * Devuelve todos los productos de una categoría.
	 * @param unknown $id
	 */
	function ProductosPorCategoria($id)
	{
		$sql = "select * from producto where categoria_id = ".$id;
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}
}