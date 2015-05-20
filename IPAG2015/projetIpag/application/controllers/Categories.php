<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
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
					$data['listCategories'] = $this->Categories_model->getCategoriesList();

					$this->load->view('templates/header_admin');
					$this->load->view('categories/afficher_categories', $data);
				}
			}
		}

		
		public function ajoutCategorie()
		{
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomCategorie', 'Nom de la categorie', 'required|callback_nomCategorieDisponible');
				
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/deconnexion');
					$this->load->view('templates/header_admin');
					$this->load->view('categories/categories_ajout');
				}
				else
				{
					$this->Categories_model->ajoutCategorie();
					redirect('Categories', 'refresh');
						
				}
			}	
		}
		
		public function nomCategorieDisponible()
		{
			if($this->Categories_model->nomCategorieDisponible()){
				return TRUE;
			}
			else {
				$this->form_validation->set_message('nomCategorieDisponible', 'Une categorie avec ce nom existe deja!');
				return FALSE;
			}
		}
		
		
		public function supprimerCategorie() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->Categories_model->supprimerCategorie();
				redirect("Categories");
			}
			
		}
		
		public function modifierCategorie() {
			if($this->session->userdata('numEtudiant')=="admin") {
				
				$data['NumCategorie'] = $this->input->post('NumCategorie');
				$data['ancienNomCategorie'] = $this->input->post('ancienNomCategorie');
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_admin');
				$this->load->view('categories/categories_update', $data);
			}
		}
		
		public function updateCategorie() {
			if($this->session->userdata('numEtudiant')=="admin") {
				$this->form_validation->set_rules('nomCategorie', 'Nom de la categorie', 'required|callback_nomCategorieDisponible');
			
				if ($this->form_validation->run() === FALSE)
				{
					$this->modifierCategorie();
				}
				else
				{
					$this->Categories_model->updateCategorie();
					echo "<script>alert(\"Categorie modifiée avec succès\")</script>";
					redirect('Categories', 'refresh');
			
				}
			}
		}
}
