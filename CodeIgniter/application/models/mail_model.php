<?php
class Mail_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	function cambiarPass($pass, $email)
	{
		$sql = "UPDATE usuario SET password='".$pass."' WHERE email = '".$email."'";
		$query=$this->db->query($sql);
	}
	
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