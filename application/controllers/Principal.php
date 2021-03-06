<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 date_default_timezone_set("America/Mexico_city");

class Principal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('alcaraz_model');
		$this->load->library('session','email_class');
		$this->load->helper(array('download', 'file', 'url', 'html', 'form'));
		
		


	}

	public function index()
	{
		$this->load->view('paginaPrincipal');
	}
	public function empresa()
	{
		$this->load->view('empresa');
	}
	public function servicios()
	{
		$this->load->view('servicios');

	}
		public function contacto()
	{
		$this->load->view('contacto');

	}
			public function vistaLogin()
	{
		$this->load->view('login');
	}
			public function enviar()
		{
			

			
			$name = $this->input->post('name');
			$seconname = $this->input->post('seconname');
			$email = $this->input->post('email');
			$pregutnta = $this->input->post('pregutnta');
			$mensaje = $this->input->post('mensaje');

			// // create email body and send it	
			$to = 'smonti61@gmail.com'; // PUT YOUR EMAIL ADDRESS HERE
			$email_subject = $name; // EDIT THE EMAIL SUBJECT LINE HERE
			$email_body = $mensaje;
			
			$headers = "contacto@syscaja.com\n";
			$headers .= "Nombre: $name\n";
			$headers .= "Correo: $email\n";	
			mail($to,$email_subject,$email_body,$headers);
//Para adjuntar archivo
/*$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
$mail->MsgHTML($mensaje);*/
			$this->session->set_flashdata('enviado','Su mensaje ha Sido Enviado Correctamente');
			redirect('principal/contacto');
			
		      
		}

	public function login(){
					if($this->input->post()){
						$Usuario= $this->alcaraz_model->login($this->input->post('Usuario'),($this->input->post('Password')));

						if(!is_object($Usuario)){

							 $this->session->set_flashdata('resp','El usuario y/o contraseña son incorrectos');
							 $this->session->set_flashdata('user', $this->input->post('Usuario'));
							 $this->session->set_flashdata('psw', $this->input->post('Password'));
							
							redirect('Principal/vistaLogin');
						}else{
							$date=date("Y-m-d H:i:s");

							$this->session->set_userdata('Usuario',$Usuario->Nombre);
							$fechaHora=$date;
							$this->alcaraz_model->update($fechaHora,$Usuario->idUsuario);

							redirect('Principal/templateAdmin');
						}
					}
					else{
							$this->session->set_flashdata('resp','El usuario y/o contraseña son incorrectos');
							redirect('Principal/vistaLogin','refresh');
					}
		

	}//FIN LOGIN
	public function logout(){
		$this->session->sess_destroy();
		 redirect('Principal/index');
	}
	//FUNCIONES ADMINISTRADOR

	public function templateAdmin()
	{
		if($this->session->userdata('Usuario')){

		$this->load->view('admin/adminPrincipal');
		// $this->load->view('admin/productos',$data);
		}else
		{
			redirect('Principal/index');
		}
		

	}
	

}