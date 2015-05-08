<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Themes extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model('Themes_model');
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
				if($this->session->userdata('numEtudiant')=="admin")
				{
					$data['listThemes'] = $this->Themes_model->getThemesList();

					$this->load->view('templates/header_admin');
					$this->load->view('themes/afficher_themes', $data);
				}
			}
		}

		
		public function ajoutTheme()
		{
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomTheme', 'Nom du theme', 'required|callback_nomThemeDisponible');
				
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/deconnexion');
					$this->load->view('templates/header_admin');
					$this->load->view('themes/themes_ajout');
				}
				else
				{
					$this->Themes_model->ajoutTheme();
					echo "<script>alert(\"Theme ajoute avec succes\")</script>";
					redirect('Themes', 'refresh');
						
				}
			}	
		}
		
		public function nomThemeDisponible()
		{
			if($this->Themes_model->nomThemeDisponible()){
				return TRUE;
			}
			else {
				$this->form_validation->set_message('nomThemeDisponible', 'Un theme avec ce nom existe deja!');
				return FALSE;
			}
		}
		
		
		public function supprimerTheme() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->Themes_model->supprimerTheme();
				redirect("Themes");
			}
			
		}
		
		public function modifierTheme() {
			if($this->session->userdata('numEtudiant')=="admin") {
				
				$data['NumTheme'] = $this->input->post('NumTheme');
				$data['ancienNomTheme'] = $this->input->post('ancienNomTheme');
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_admin');
				$this->load->view('themes/themes_update', $data);
			}
		}
		
		public function updateTheme() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomTheme', 'Nom du theme', 'required|callback_nomThemeDisponible');
			
				if ($this->form_validation->run() === FALSE)
				{
					$this->modifierTheme();
				}
				else
				{
					$this->Themes_model->updateTheme();
					echo "<script>alert(\"Theme modifie avec succes\")</script>";
					redirect('Themes', 'refresh');
			
				}
			}
		}
}
