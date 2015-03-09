<?php
class Pedido_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Inserta pedidos pasandole los datos
	 * @param unknown $datos
	 */
	function insertaPedido($datos)
	{
		$sql = "INSERT INTO pedido (usuario_id, fecha, estado, nombre, apellidos, dni, direccion, cp, provincia)
					VALUES ('".$datos['id']."', now(), 'P', '".$datos['nombre']."','".$datos['apellidos']."','".$datos['dni']."',
						'".$datos['direccion']."','".$datos['cp']."','".$datos['provincia']."')";
		
		//ejecutamos la setencia de inserción
		$this->db->query($sql);
	}
	
	
	/**
	 * Recoge los datos de la última compra de un usuario
	 * @param unknown $idusuario
	 * @return boolean
	 */
	function datosCompra($idusuario)
	{
		$sql = "SELECT * FROM pedido WHERE id=(SELECT MAX(id) FROM pedido WHERE usuario_id=".$idusuario.")";
		$query=$this->db->query($sql);
	
		if ($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Inserta los datos en la tabla linea
	 * @param unknown $datos
	 */
	function insertaLinea($datos)
	{
		$sql = "INSERT INTO linea (pedido_id, producto_id, precio_venta, cantidad)
					VALUES ('".$datos['pedido_id']."', '".$datos['producto_id']."','".$datos['precio']."','".$datos['cantidad']."')";
		
		//ejecutamos la setencia de inserción
		$this->db->query($sql);
	}
	
	/**
	 * Actualiza el stock después de una compra realizada.
	 * @param unknown $id
	 * @param unknown $cantidad
	 */
	function actualizarStock($id, $cantidad)
	{
		$sql = "UPDATE producto SET stock=stock-".$cantidad." WHERE id=".$id;
		$query=$this->db->query($sql);
	}
	
	/**
	 * Recoge los datos de un producto
	 * @param unknown $id
	 * @return boolean
	 */
	function datosProducto($id)
	{
		$sql = "SELECT * FROM producto WHERE id=".$id;
		$query=$this->db->query($sql);
		
		if ($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Recoge todos los pedidos de un usuario.
	 * @param unknown $idusuario
	 */
	function muestraPedidos($idusuario)
	{
		$sql = "SELECT * FROM pedido WHERE usuario_id=".$idusuario;
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}
	
}