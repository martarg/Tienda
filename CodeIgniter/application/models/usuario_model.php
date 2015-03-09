<?php
class Usuario_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Función que saca la lista de provincias
	 * @return multitype:unknown
	 */
	function ListaProvincias()
	{
		$sql = "select * from provincias";
		$rs = $this->db->query($sql);
	
		if($rs->num_rows()>0)
		{
			foreach ($rs->result() as $row)
			{
				$provincias[$row->id] = $row->nombre;
				$rs->free_result();
			}
			return $provincias;
		}
	}
	
	/**
	 * Saca los nombres de las provincias
	 * @param unknown $idprov
	 * @return string
	 */
	function NombreProvincia($idprov)
	{
		$sql = "select nombre from provincias where id=$idprov";
		$rs = $this->db->query($sql);
		if ($rs) {
			$reg=$rs->row();
			return $reg->nombre; 
		}
		else 
		{
			return "**** ERROR ***";
		}
	}
	
	/**
	 * Inserta un usuario pasándole los datos del formulario
	 * @param unknown $campos
	 */
	function insertarUsuario($campos)
	{
		//sentencia sql que nos inserta en la tabla usuario
		$sql="INSERT INTO usuario (usuario, password, email, nombre, apellidos, dni, direccion, cp, provincia_id, borrado)
			   VALUES ('".$campos['usuario']."','".$campos['password']."',
			   '".$campos['email']."', '".$campos['nombre']."',
			   '".$campos['apellidos']."', '".$campos['dni']."',
			   '".$campos['direccion']."', '".$campos['cp']."',
			   '".$campos['provincia']."', 0)";
		
		//ejecutamos la setencia de inserción
		$this->db->query($sql);
	}
	
	/**
	 * Comprueba que el login es válido
	 * @param unknown $usuario
	 * @param unknown $password
	 * @return boolean
	 */
	function loginValido($usuario, $password)
	{
		$sql = "select * from usuario where usuario = '".$usuario."' AND password = '".$password."' AND borrado != 1";
		
		$query = $this->db->query($sql);

		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/**
	 * Lee los datos de un usuario determinado
	 */
	public function informacionUsuario($sess_array) {
		$condition = "usuario =" . "'" .$sess_array['usuario']. "'";
		
		$this->db->from ( 'usuario' );
		$this->db->where ( $condition );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
	
		if ($query->num_rows () == 1)
		{
			return $query->result ();
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Modifica los datos de un usuario determinado con los datos del formulario
	 * @param unknown $id
	 * @param unknown $datos
	 */
	function modificarUsuario($id, $datos)
	{
		$campos = '';
		
		foreach ($datos as $clave => $valor)
		{
			if($campos!='')
			{
				$campos.=', ';
			}
			$campos.= $clave.'="'.$valor.'"';
		}
		
		$sql = "update usuario set ".$campos." where id=".$id;
		$this->db->query($sql);
		
	} 
	
	/**
	 * Dar de baja a un usuario. (Ocultarlo)
	 * @param unknown $id
	 */
	function borrarUsuario($id)
	{
		$sql = "UPDATE usuario SET borrado = 1 WHERE id =".$id;
		$this->db->query($sql);
	}
	
	/**
	 * Comprueba el nombre del usuario
	 * @param unknown $id
	 */
	function compruebaNombre($id)
	{
		$sql = "SELECT usuario FROM usuario WHERE id=".$id;
		$rs = $this->db->query($sql);
		return $rs->result();
	}
}