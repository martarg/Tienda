<?php
session_start();

class Usuario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//cargo el modelo de productos
		$this->load->model('Usuario_model');
	}
	
	function index()
	{
		
	}
	
	/**
	 * Carga la plantilla html (encabezado, menu, cuerpo y pie).
	 * @param unknown $cuerpo
	 */
	protected function plantilla($cuerpo)
	{
		if(isset($this->session->userdata['valido']))
		{
			$sesion = $this->session->userdata['valido'];
			
			//Carga del encabezado
			$encabezado = $this->load->view('header', $sesion,TRUE);
		}
		else 
		{
			//Carga del encabezado
			$encabezado = $this->load->view('header', '',TRUE);
		}
		$pie = $this->load->view('footer', '', TRUE);
		
		//Creo una plantilla con los apartados a mostrar
		$this->load->view('plantilla', array(
				'encabezado' => $encabezado,
				'menu_izq' => '',
				'cuerpo' => $cuerpo,
				'pie' => $pie
		));
	}
	
	/**
	 * Carga el formulario para registrar un nuevo usuario.
	 */
	function registro()
	{
		//Carga la lista de las provincias
		$provincias = $this->Usuario_model->ListaProvincias();
		
		//Carga la librería para validar formulario.
		$this->load->library('form_validation');
	
		//Configurar las reglas de validación
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
		$this->form_validation->set_rules('apellidos', 'apellidos', 'trim|required');
		$this->form_validation->set_rules('dni', 'dni', 'trim|required|callback_validarDNI');
		$this->form_validation->set_rules('direccion', 'direccion', 'trim|required');
		$this->form_validation->set_rules('cp', 'código postal', 'trim|required|numeric|exact_length[5]');
		$this->form_validation->set_rules('selprovincias', 'provincia', 'required');
		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'contraseña', 'trim|required|matches[pConfirm]|md5');
		$this->form_validation->set_rules('pConfirm', 'confirma contraseña', 'trim|required');
		
		//Dar estilo al error.
		$this->form_validation->set_error_delimiters('<div class="alert-sm alert-danger">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->plantilla(
				$this->load->view('registro_form', array('provincias' => $provincias), TRUE));
		}
		else
		{
			$datos['nombre'] = $this->input->post('nombre');
			$datos['apellidos'] = $this->input->post('apellidos');
			$datos['dni'] = $this->input->post('dni');
			$datos['direccion'] = $this->input->post('direccion');
			$datos['cp'] = $this->input->post('cp');
			$datos['provincia'] = $this->input->post('selprovincias');
			$datos['usuario'] = $this->input->post('usuario');
			$datos['email'] = $this->input->post('email');
			$datos['password'] = $this->input->post('password');
			
			$this->Usuario_model->insertarUsuario($datos);
			
			$this->plantilla(
				$this->load->view('exito', '', TRUE));
		}
	}
	
	/**
	 * Valida el campo DNI
	 * @param unknown $str
	 * @return boolean
	 */
	public function validarDNI($str)
	{
		$str = trim($str);
		$str = str_replace("-","",$str);
		$str = str_ireplace(" ","",$str);
	
		if ( !preg_match("/^[0-9]{7,8}[a-zA-Z]{1}$/" , $str) )
		{
			return FALSE;
		}
		else
		{
			$n = substr($str, 0 , -1);
			$letter = substr($str,-1);
			$letter2 = substr ("TRWAGMYFPDXBNJZSQVHLCKE", $n%23, 1);
			if(strtolower($letter) != strtolower($letter2))
				return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * Iniciar sesión
	 */
	function login()
	{		
		//Carga la librería para validar formulario.
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('password', 'contraseña', 'trim|required|md5');
		
		//Dar estilo al error.
		$this->form_validation->set_error_delimiters('<div class="alert-sm alert-danger">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->plantilla(
				$this->load->view('login', '', TRUE));
		}
		else
		{
			$usuario = $this->input->post('usuario');
			$password = $this->input->post('password');
			
			if($this->Usuario_model->loginValido($usuario, $password))
			{		
				$sess_arr = array (
						'usuario' => $this->input->post('usuario')
						);
				
				//Añade usuario a la session
				$this->session->set_userdata('valido', $sess_arr);
				
				$result = $this->Usuario_model->informacionUsuario($sess_arr);
				
				if ($result != false)
				{
					$data = array (
							'nombre' => $result [0]->nombre,
							'usuario' => $result [0]->usuario,
							'email' => $result [0]->email,
							'password' => $result [0]->password
					);
					
					//$this->plantilla($this->load->view('dentro', $data, TRUE));
					redirect('tienda/destacados');
				}
			}
			else
			{
				$data = array (
						'error_message' => '<strong>Usuario o contraseña incorrectos.</strong> Intentelo de nuevo.'
						);
				$this->plantilla(
						$this->load->view('login', $data, TRUE));
			}
		}
	}
	
	/**
	 * Cerrar sesión usuario
	 */
	public function logout() {
	
		//Borra los datos de la sesion
		$sess_arr = array (
				'usuario' => ''
		);
		
		$this->session->unset_userdata('valido', $sess_arr);
		
		$data['logout'] = 'Sesión cerrada.';
		
		redirect('tienda/destacados');
		//$this->plantilla($this->load->view('login', $data, TRUE));
	}
	
}