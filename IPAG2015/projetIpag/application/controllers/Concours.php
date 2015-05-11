<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Concours extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
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
					$data['listConcours'] = $this->Concours_model->getConcoursList();

					$this->load->view('templates/header_admin');
					$this->load->view('concours/afficher_concours', $data);
				}
			}
		}

		
		public function ajoutConcours()
		{
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomConcours', 'Nom du concours', 'required|callback_nomConcoursDisponible');
				
				if ($this->form_validation->run() === FALSE)
				{
					$data['listThemes'] = $this->Themes_model->getThemesList();
					$data['listCategories'] = $this->Categories_model->getCategoriesList();
					$this->load->view('templates/deconnexion');
					$this->load->view('templates/header_admin');
					$this->load->view('concours/concours_ajout', $data);
				}
				else
				{
					$this->Concours_model->ajoutConcours();
					echo "<script>alert(\"Concours ajoute avec succes\")</script>";
					redirect('Concours', 'refresh');
						
				}
			}	
		}
		
		public function nomConcoursDisponible()
		{
			if($this->Concours_model->nomConcoursDisponible()){
				return TRUE;
			}
			else {
				$this->form_validation->set_message('nomConcoursDisponible', 'Un concours avec ce nom existe deja!');
				return FALSE;
			}
		}
		
		
		public function supprimerConcours() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->Concours_model->supprimerConcours();
				redirect("Concours");
			}
			
		}
		
		public function modifierConcours() {
			if($this->session->userdata('numEtudiant')=="admin") {
				
				$data['NumConcours'] = $this->input->post('NumConcours');
				$data['ancienNomConcours'] = $this->input->post('ancienNomConcours');
				$data['listThemes'] = $this->Themes_model->getThemesList();
				$data['listCategories'] = $this->Categories_model->getCategoriesList();
				$data['ceConcoursTheme']= $this->Concours_model->getConcoursTheme();
				$data['ceConcoursCategorie']= $this->Concours_model->getConcoursCategorie();
				
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_admin');
				$this->load->view('concours/concours_update', $data);
			
			}
		}
		
		public function updateConcours() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomConcours', 'Nom du concours', 'required|callback_nomConcoursDisponible');
			
				if ($this->form_validation->run() === FALSE)
				{
					$this->modifierConcours();
				}
				else
				{
					$this->Concours_model->updateConcours();
					echo "<script>alert(\"Concours modifie avec succes\")</script>";
					redirect('Concours', 'refresh');
			
				}
			}
		}
}
