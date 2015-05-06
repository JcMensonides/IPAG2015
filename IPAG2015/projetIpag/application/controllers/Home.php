<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model('Login_model');
        }

		public function index()
		{
			//Si la session n'existe pas
			if(!$this->session->userdata('numEtudiant'))
			{
				$this->load->view('templates/login');
			}
			else { //sinon
				$this->load->view('templates/deconnexion');
			}
		}
		
		public function seConnecterAdmin()
		{
			//On genere la session admin
			$donneesDeSession = array(
				'numEtudiant' => "admin",
			);
			$this->session->set_userdata($donneesDeSession);
			redirect('/Home', 'refresh');
		}
		
		public function seConnecterEtudiant()
		{
			$this->form_validation->set_rules('numeroEtudiant', 'Numero Etudiant', 'required|callback_ExistNumEtudiant');
			//$this->form_validation->set_rules('numeroEtudiant', 'Numero Etudiant', 'callback_ExistNumEtudiant');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/login');
			}
			else
			{
				if (!($this->Login_model->ExistNumEtudiant()))
						{
							
						}
				else {
					//On genere la session etudiant
					$donneesDeSession = array(
							'numEtudiant' => $this->input->post('numeroEtudiant'),
					);
					$this->session->set_userdata($donneesDeSession);
					redirect('/Home', 'refresh');
				}
			}
		}
		
		function ExistNumEtudiant($numEtudiant)
		{
			if($this->Login_model->ExistNumEtudiant($numEtudiant)){
				return TRUE;
			}
			else {
				$this->form_validation->set_message('ExistNumEtudiant', 'Le numero etudiant n\'existe pas');
				return FALSE;
			}
		}
		
		public function seDeconnecter() {
			$this->session->sess_destroy();
			redirect('/Home', 'refresh');
		}
		

	public function view()
	{
			$this->load->view('templates/login');
	}
}