<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mail_model');
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
	 * Cambia contraseña y envía por correo.
	 */
	function recuperarPassw()
	{
		//Carga la librería para validar formulario.
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
	
		//Dar estilo al error.
		$this->form_validation->set_error_delimiters('<div class="alert-sm alert-danger">', '</div>');
	
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->plantilla($this->load->view('recuperar_form', '', TRUE));
		}
		else
		{
			$email = $this->input->post('email');
			
			if($this->Mail_model->existeEmail($email))
			{
				$this->load->library('email');
		
				// Utilizando sendmail
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.iessansebastian.com';
				$config['smtp_user'] = 'aula4@iessansebastian.com';
				$config['smtp_pass'] = 'daw2alumno';
					
				$this->email->initialize($config);
				$this->EnviaCorreo($email);
			}
			else 
			{
				$data['noExiste'] = 'No existe ningún usuario con ese email.';
				
				$this->plantilla(
						$this->load->view('recuperar_form', $data, TRUE));
			}
		}
	}
	
	/**
	 * Envía el email con la contraseña
	 * @param unknown $email
	 */
	private function EnviaCorreo($email)
	{
		$clave = $this->generaPassword();
	
		$this->email->from('aula4@iessansebastian.com', 'Music-All');
		$this->email->to($email);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
	
		$this->email->subject('Cambio de contraseña');
		$this->email->message('Su nueva contraseña es: '.$clave);
	
		if ( $this->email->send() )
		{
			$pass = md5($clave);
			$this->Mail_model->cambiarPass($pass, $email);
			$this->session->set_flashdata('envio', 'Email enviado correctamente');
		}
		else
		{
			$this->session->set_flashdata('envio', 'No se a enviado el email');
		}
	
		redirect(site_url("usuario/login"));
		//echo $this->email->print_debugger();
	}
	
	/**
	 * Genera una constraseña aleatoria de 8 caracteres.
	 * @return string password
	 */
	private function generaPassword()
	{
		//Se define una cadena de caractares
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	
		//Obtenemos la longitud de la cadena de caracteres
		$longitudCadena=strlen($cadena);
			
		//Se define la variable que va a contener la contraseña
		$pass = "";
	
		//Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
		$longitudPass=8;
			
		//Creamos la contraseña
		for($i=1 ; $i<=$longitudPass ; $i++)
		{
		//Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
		$pos = rand(0,$longitudCadena-1);
	
		//Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
		$pass .= substr($cadena,$pos,1);
		}
	
		return $pass;
	}
}