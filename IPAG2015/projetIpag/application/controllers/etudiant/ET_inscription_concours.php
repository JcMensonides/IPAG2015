<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_inscription_concours extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model('ET_inscription_concours_model');
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
				if($this->session->userdata('numEtudiant')!=="admin")
				{
					$data['listEditionConcours'] = $this->ET_inscription_concours_model->getEditionConcoursList();

					$this->load->view('templates/header_etudiant');
					$this->load->view('etudiant/ET_consulter_concours', $data);
				}
			}
		}
		
		public function inscription() {
			if($this->session->userdata('numEtudiant')!=="admin"){
				$this->ET_inscription_concours_model->inscriptionEditionConcours();
				//redirect("etudiant/ET_inscription_edition_concours");
			}
		}
		
		public function moreInfos() {
			if($this->session->userdata('numEtudiant')!=="admin"){
				$data['infos'] = $this->ET_inscription_concours_model->getMoreInfos();
				
				//Sur certaines requetes, le numero d'edition est renvoye comme null, bien qu'il trouve le bon tuple
				//Nous ne savons pas d'ou vient le probleme, nous modifions donc la valeur du numero d'edition ici, apres la requete
				$data['infos'][0]['numEditionConcours'] = $this->input->post('NumEditionConcours');
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_etudiant');
				$this->load->view('etudiant/ET_more_infos', $data);
			}
		}
		
		public function mesConcours(){
			if($this->session->userdata('numEtudiant')!=="admin"){
				$data['listEditionConcours'] = $this->ET_inscription_concours_model->getMesConcours();
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_etudiant');
				$this->load->view('etudiant/ET_mes_concours', $data);
			}
		}
		
		public function renseigner(){
			if($this->session->userdata('numEtudiant')!=="admin"){
			
				$data['infos'] = $this->ET_inscription_concours_model->getResultatEdition();
				$data['numEditionConcours'] = $this->input->post('NumEditionConcours');
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_etudiant');
				$this->load->view('etudiant/ET_renseigner', $data);
			}
		}
		
		public function updateInfos() {
			if($this->session->userdata('numEtudiant')!=="admin") {
				//callback sur l'ordre des concours
				//On ne peut etre admis a l'ecrit que si on est admis au qcm
				//On ne peut etre admis a l'oral que si on est admis a l'ecrit
				$this->form_validation->set_rules('ordreConcoursValide', 'ordre concours valide', 'callback_ordreConcoursValide');
				if($this->form_validation->run() == false){
					$this->renseigner();
				}
				else {
					$this->ET_inscription_concours_model->updateInfos();
					$this->mesConcours();
				}
				
			}
		}
		
		//Vérifie que l'on est bien admis au qcm avant d'etre admis aux ecrits
		//Vérifie que l'on est bien admis aux ecrits avant d'etre admis aux oraux
		public function ordreConcoursValide() {
			$result = true;
			//si il y a un QCM et que l'etudiant n'est pas admis
			if(isset($_POST['admisQCM']) && $_POST['admisQCM'] !=='admis'){
				if((isset($_POST['admisEpreuvesEcrites']) && $_POST['admisEpreuvesEcrites'] !=='non renseigne') || (isset($_POST['admisEpreuvesOrales']) && $_POST['admisEpreuvesOrales'] !=='non renseigne')){
					$this->form_validation->set_message('ordreConcoursValide', 'Vous devez etre admis au qcm pour renseigner les ecrits ou les oraux');
					$result= false;
				}
			}
			//sinon si il y a une epreuve ecrite et que l'etudiant n'est pas admis
			elseif(isset($_POST['admisEpreuvesEcrites']) && $_POST['admisEpreuvesEcrites'] !=='admis'){
				if(isset($_POST['admisEpreuvesOrales']) && $_POST['admisEpreuvesOrales'] !=='non renseigne'){
					$this->form_validation->set_message('ordreConcoursValide', 'Vous devez etre admis aux ecrits pour renseigner les oraux');
					$result= false;
				}
			}
			return $result;
		}
}
		
		
