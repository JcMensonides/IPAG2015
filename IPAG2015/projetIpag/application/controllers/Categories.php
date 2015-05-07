<?php
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
					$this->load->view('templates/header_admin');
					$this->load->view('categories/categories_ajout');
				}
			}
		}

		
		public function ajoutCategorie()
		{
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
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_admin');
				$this->load->view('categories/categories_ajout');
				echo "<script>alert(\"Categorie ajoutee avec succes\")</script>";
			
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
		
		public function afficherCategories(){
			//$listCategories = $this->Categories_model->getCategoriesList();
			//$this->load->view('categories/afficher_categories', $listCategories);
			
			$data['listCategories'] = $this->Categories_model->getCategoriesList();
			//$data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
			$this->load->view('templates/deconnexion');
			$this->load->view('templates/header_admin');
			$this->load->view('categories/afficher_categories', $data);
		}
}
