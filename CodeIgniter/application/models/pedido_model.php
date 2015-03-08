<?php
class Pedido_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function insertaPedido($datos)
	{
		$sql = "INSERT INTO pedido (usuario_id, fecha, estado, nombre, apellidos, dni, direccion, cp, provincia)
					VALUES ('".$datos['id']."', now(), 'P', '".$datos['nombre']."','".$datos['apellidos']."','".$datos['dni']."',
						'".$datos['direccion']."','".$datos['cp']."','".$datos['provincia']."')";
		
		//ejecutamos la setencia de inserción
		$this->db->query($sql);
		
		//return $this->db->insert_id();
	}
	
	
	function datosCompra($pedido, $usuario)
	{
		$this->db->from('pedido');
		$this->db->where('id', $pedido);
		$this->db->where('usuario_id', $usuario);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function insertaLinea($datos)
	{
		$sql = "INSERT INTO linea (pedido_id, producto_id, precio_venta, cantidad)
					VALUES ('".$datos['pedido_id']."', '".$datos['producto_id']."','".$datos['precio_venta']."','".$datos['cantidad']."')";
		
		//ejecutamos la setencia de inserción
		$this->db->query($sql);
	}
}