<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class EditionConcours extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model('EditionConcours_model');
                $this->load->model('Concours_model');
                $this->load->model('Themes_model');
                $this->load->model('Categories_model');
                
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
					$data['listEditionConcours'] = $this->EditionConcours_model->getEditionConcoursList();

					$this->load->view('templates/header_admin');
					$this->load->view('EditionConcours/afficher_concours', $data);
				}
			}
		}

		
		public function ajoutEditionConcours()
		{
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomEditionConcours', 'Nom du concours', 'required|callback_nomEditionConcoursDisponible');
				
				if ($this->form_validation->run() === FALSE)
				{
					$data['listConcours'] = $this->Concours_model->getConcoursList();
					
					$this->load->view('templates/deconnexion');
					$this->load->view('templates/header_admin');
					$this->load->view('EditionConcours/ajout_EditionConcours', $data);
					echo $this->input->post('dateResultatsEditionConcours');
				}
				else
				{
					$this->EditionConcours_model->ajoutEditionConcours();
					echo "<script>alert(\"EditionConcours ajoute avec succes\")</script>";
					redirect('EditionConcours', 'refresh');
						
				}
			}	
		}
		
		public function nomEditionConcoursDisponible()
		{
			if($this->EditionConcours_model->nomEditionConcoursDisponible()){
				return TRUE;
			}
			else {
				$this->form_validation->set_message('nomEditionConcoursDisponible', 'Un concours avec ce nom existe deja!');
				return FALSE;
			}
		}
		
		
		public function supprimerEditionConcours() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->EditionConcours_model->supprimerEditionConcours();
				redirect("EditionConcours");
			}
			
		}
		
		public function modifierEditionConcours() {
			if($this->session->userdata('numEtudiant')=="admin") {
				
				$data['NumEditionConcours'] = $this->input->post('NumEditionConcours');
				$data['ancienNomEditionConcours'] = $this->input->post('ancienNomEditionConcours');
				$data['listThemes'] = $this->Themes_model->getThemesList();
				$data['listCategories'] = $this->Categories_model->getCategoriesList();
				$data['ceEditionConcoursTheme']= $this->EditionConcours_model->getEditionConcoursTheme();
				$data['ceEditionConcoursCategorie']= $this->EditionConcours_model->getEditionConcoursCategorie();
				
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_admin');
				$this->load->view('EditionConcours/EditionConcours_update', $data);
			
			}
		}
		
		public function updateEditionConcours() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomEditionConcours', 'Nom du concours', 'required|callback_nomEditionConcoursDisponible');
			
				if ($this->form_validation->run() === FALSE)
				{
					$this->modifierEditionConcours();
				}
				else
				{
					$this->EditionConcours_model->updateEditionConcours();
					echo "<script>alert(\"EditionConcours modifie avec succes\")</script>";
					redirect('EditionConcours', 'refresh');
			
				}
			}
		}
}
