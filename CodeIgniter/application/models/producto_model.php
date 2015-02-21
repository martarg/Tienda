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
	function ProductosDestacados($inicio=0, $limit=0)
	{
		$query = $this->db->query('select * from producto where destacado = 1
										AND fecha_inicio < now()
											AND fecha_fin >= now() LIMIT '.$limit.' OFFSET '.$inicio);
		return $query->result_array();
	}
	
	/**
	 * 
	 * @return unknown
	 */
	function totalDestacados()
	{
		$this->db->from('producto');
		$this->db->where("destacado = 1	AND fecha_inicio < now() AND fecha_fin >= now()");
		$total_rows = $this->db->count_all_results();
	
		return $total_rows;
	}
	
	/**
	 * Devuelve la lista de las categorías.
	 */
	function ListaCategorias()
	{
		$sql = "select * from categoria order by nombre";
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}
	
	
	/**
	 * Devuelve todos los productos de una categoría.
	 * @param unknown $id Código categoría
	 */
	function ProductosPorCategoria($id, $offset=0, $limit=0)
	{
		$sql = "select * from producto where categoria_id = ".$id." LIMIT ".$limit." OFFSET ".$offset;
		$rs = $this->db->query($sql);

		return $rs->result_array();
	}
	
	
	/**
	 * 
	 * @param unknown $id
	 * @return unknown
	 */
	function totalProdCategoria($id)
	{
		$this->db->from('producto');
		$this->db->where('categoria_id', $id);
		$this->db->where('oculto', 0);
		$total_rows = $this->db->count_all_results();
		
		return $total_rows;
	}

	
	/**
	 * Devuelve los detalles de un producto.
	 * @param unknown $id Código producto
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
}