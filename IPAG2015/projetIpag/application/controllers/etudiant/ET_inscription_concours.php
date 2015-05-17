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
				
				$this->load->view('templates/deconnexion');
				$this->load->view('templates/header_etudiant');
				$this->load->view('etudiant/ET_consulter_concours', $data);
			}
		}
}
		
		
