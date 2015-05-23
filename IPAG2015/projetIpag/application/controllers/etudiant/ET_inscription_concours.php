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
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_etudiant');
				$this->load->view('etudiant/ET_renseigner', $data);
			}
		}
		
		public function updateInfos() {
			if($this->session->userdata('numEtudiant')!=="admin") {
				$this->ET_inscription_concours_model->updateInfos();
				
				$this->mesConcours();
			}
		}
}
		
		
