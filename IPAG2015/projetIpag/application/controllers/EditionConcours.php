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
					$this->load->view('EditionConcours/afficher_EditionConcours', $data);
				}
			}
		}
		
		public function moreInfos() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data['infos'] = $this->EditionConcours_model->getInfosEditionConcours();
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_admin');
				$this->load->view('EditionConcours/plus_d_infos', $data);
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
		
		public function validateDate( $date)
		{
			if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
				list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date );
				return checkdate( $m, $d, $y );
			}
			elseif (preg_match("/^[0-9]{4}-([1-9]|1[0-2])-([1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
				list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date );
				return checkdate( $m, $d, $y );
			}
			else
				return false;
			
		}
		
		public function ajoutEditionConcours()
		{
			if($this->session->userdata('numEtudiant')=="admin") {
		
				$this->form_validation->set_rules('dateFinInscriptionEditionConcours', 'Date de fin d\'inscription', 'required|callback_valider_dateInscriptionEditionConcours');
				$this->form_validation->set_rules('dateResultatsEditionConcours', 'Date de resultat du concours', 'required|callback_valider_dateResultatsEditionConcours');
				
				//check si on veut ajouter un QCM
				if($this->input->post('DateResultatQCM') !== "null"){
					$this->form_validation->set_rules('DateResultatQCM', 'Date de resultat du QCM', 'required|callback_valider_dateResultatQCM');
				}
				
				//check si on veut ajouter une epreuve ecrite
				if($this->input->post('DateResultatEpreuveEcrite') !== "null"){
					$this->form_validation->set_rules('DateResultatEpreuveEcrite', 'Date de l\'epreuve ecrite', 'required|callback_valider_DateResultatEpreuveEcrite');
				}
				
				//check si on veut ajouter une epreuve orale
				if($this->input->post('DateResultatEpreuveOrale') !== "null"){
					$this->form_validation->set_rules('DateResultatEpreuveOrale', 'Date de l\'epreuve orale', 'required|callback_valider_DateResultatEpreuveOrale');
				}
				
				//check si on veut ajouter un test physique
				if($this->input->post('DateResultatEpreuvePhysique') !== "null"){
					$this->form_validation->set_rules('DateResultatEpreuvePhysique', 'Date de resultat de l\'epreuve physique', 'required|callback_valider_dateResultatEpreuvePhysique');
				}
				
				//check si on veut ajouter un test psychoTechnique
				if($this->input->post('DateResultatEpreuvePsychoTechnique') !== "null"){
					$this->form_validation->set_rules('DateResultatEpreuvePsychoTechnique', 'Date de resultat de l\'epreuve psychoTechnique', 'required|callback_valider_dateResultatEpreuvePsychoTechnique');
				}
		
				if ($this->form_validation->run() === FALSE)
				{
					$data['listConcours'] = $this->Concours_model->getConcoursList();
						
					$this->load->view('templates/deconnexion');
					$this->load->view('templates/header_admin');
					$this->load->view('EditionConcours/ajout_EditionConcours', $data);
				}
				else
				{
					$this->EditionConcours_model->ajoutEditionConcours();
					redirect('EditionConcours', 'refresh');
		
				}
			}
		}
		
		public function valider_dateInscriptionEditionConcours() {
			if (!$this->validateDate($this->input->post('dateFinInscriptionEditionConcours'))){
				$this->form_validation->set_message('valider_dateInscriptionEditionConcours', 'La date de fin d\'inscription n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('dateDebutInscriptionEditionConcours') != "" && !$this->validateDate($this->input->post('dateDebutInscriptionEditionConcours'))){
				$this->form_validation->set_message('valider_dateInscriptionEditionConcours', 'La date de de debut d\'inscription au concours n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif(strtotime($this->input->post('dateDebutInscriptionEditionConcours'))> strtotime($this->input->post('dateFinInscriptionEditionConcours'))){
				$this->form_validation->set_message('valider_dateInscriptionEditionConcours', 'La date de de debut d\'inscription au concours doit etre inferieur a celle de fin d\'inscription.');
				return false;
			}
			else{
				return true;
			}
		}
		
		public function valider_dateResultatsEditionConcours() {
			if (!$this->validateDate($this->input->post('dateResultatsEditionConcours'))){
				$this->form_validation->set_message('valider_dateResultatsEditionConcours', 'La date de resultat du concours n\'est pas valide. Verifiez son format');
				return false;
			}
			else{
				return true;
			}
		}
		
		public function valider_dateResultatQCM(){
			if (!$this->validateDate($this->input->post('DateResultatQCM'))){
				$this->form_validation->set_message('valider_dateResultatQCM', 'La date de resultat du QCM n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('DateQCM') != "" && !$this->validateDate($this->input->post('DateQCM'))){
				$this->form_validation->set_message('valider_dateResultatQCM', 'La date du QCM n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif(strtotime($this->input->post('DateQCM'))> strtotime($this->input->post('DateResultatQCM'))){
				$this->form_validation->set_message('valider_dateResultatQCM', 'La date du QCM doit etre inferieur a celle du resultat du QCM.');
				return false;
			}
			else{
				return true;
			}
		}
		
		public function valider_DateResultatEpreuveEcrite(){
			if (!$this->validateDate($this->input->post('DateResultatEpreuveEcrite'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveEcrite', 'La date de resultat de l\'epreuve ecrite n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('DateDebutEpreuveEcrite') != "" && !$this->validateDate($this->input->post('DateDebutEpreuveEcrite'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveEcrite', 'La date de debut de l\'epreuve ecrite n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('DateFinEpreuveEcrite') != "" && !$this->validateDate($this->input->post('DateFinEpreuveEcrite'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveEcrite', 'La date de fin de l\'epreuve ecrite n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif(strtotime($this->input->post('DateDebutEpreuveEcrite'))> strtotime($this->input->post('DateFinEpreuveEcrite'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveEcrite', 'La date de debut de l\'epreuve ecrite doit etre inferieur a celle de fin de l\'epreuve ecrite.');
				return false;
			}
			elseif(strtotime($this->input->post('DateFinEpreuveEcrite'))> strtotime($this->input->post('DateResultatEpreuveEcrite'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveEcrite', 'La date de fin de l\'epreuve ecrite doit etre inferieur a celle de resultat de l\'epreuve ecrite.');
				return false;
			}
			else{
				return true;
			}
		}
		
		public function valider_DateResultatEpreuveOrale(){
			if (!$this->validateDate($this->input->post('DateResultatEpreuveOrale'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveOrale', 'La date de resultat de l\'epreuve orale n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('DateDebutEpreuveOrale') != "" && !$this->validateDate($this->input->post('DateDebutEpreuveOrale'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveOrale', 'La date de debut de l\'epreuve orale n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('DateFinEpreuveOrale') != "" && !$this->validateDate($this->input->post('DateFinEpreuveOrale'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveOrale', 'La date de fin de l\'epreuve orale n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif(strtotime($this->input->post('DateDebutEpreuveOrale'))> strtotime($this->input->post('DateFinEpreuveOrale'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveOrale', 'La date de debut de l\'epreuve orale doit etre inferieur a celle de fin de l\'epreuve orale.');
				return false;
			}
			elseif(strtotime($this->input->post('DateFinEpreuveOrale'))> strtotime($this->input->post('DateResultatEpreuveOrale'))){
				$this->form_validation->set_message('valider_DateResultatEpreuveOrale', 'La date de fin de l\'epreuve orale doit etre inferieur a celle de resultat de l\'epreuve orale.');
				return false;
			}
			else{
				return true;
			}
		}
		
		public function valider_dateResultatEpreuvePhysique(){
			if (!$this->validateDate($this->input->post('DateResultatEpreuvePhysique'))){
				$this->form_validation->set_message('valider_dateResultatEpreuvePhysique', 'La date de resultat de l\'epreuve physique n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('DateEpreuvePhysique') != "" && !$this->validateDate($this->input->post('DateEpreuvePhysique'))){
				$this->form_validation->set_message('valider_dateResultatEpreuvePhysique', 'La date de l\'epreuve physique n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif(strtotime($this->input->post('DateEpreuvePhysique'))> strtotime($this->input->post('DateResultatEpreuvePhysique'))){
				$this->form_validation->set_message('valider_dateResultatEpreuvePhysique', 'La date de l\'epreuve physique doit etre inferieur a celle du resultat de l\'epreuve physique.');
				return false;
			}
			else{
				return true;
			}
		}
		
		public function valider_dateResultatEpreuvePsychoTechnique(){
			if (!$this->validateDate($this->input->post('DateResultatEpreuvePsychoTechnique'))){
				$this->form_validation->set_message('valider_dateResultatEpreuvePsychoTechnique', 'La date de resultat de l\'epreuve psychoTechnique n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif ($this->input->post('DateEpreuvePsychoTechnique') != "" && !$this->validateDate($this->input->post('DateEpreuvePsychoTechnique'))){
				$this->form_validation->set_message('valider_dateResultatEpreuvePsychoTechnique', 'La date de l\'epreuve psychoTechnique n\'est pas valide. Verifiez son format');
				return false;
			}
			elseif(strtotime($this->input->post('DateEpreuvePsychoTechnique'))> strtotime($this->input->post('DateResultatEpreuvePsychoTechnique'))){
				$this->form_validation->set_message('valider_dateResultatEpreuvePsychoTechnique', 'La date de l\'epreuve psychoTechnique doit etre inferieur a celle du resultat de l\'epreuve psychoTechnique.');
				return false;
			}
			else{
				return true;
			}
		}
}
