<?php
class Mail_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Cambia la contraseña en la bd al enviarla por correo.
	 * @param unknown $pass
	 * @param unknown $email
	 */
	function cambiarPass($pass, $email)
	{
		$sql = "UPDATE usuario SET password='".$pass."' WHERE email = '".$email."'";
		$query=$this->db->query($sql);
	}
	
	/**
	 * Comprueba que el email existe en la bd
	 * @param unknown $email
	 * @return boolean
	 */
	function existeEmail($email)
	{
		$sql= "SELECT * FROM usuario WHERE email='".$email."'";
		
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
}