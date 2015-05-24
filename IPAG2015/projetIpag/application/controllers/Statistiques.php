<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistiques extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model('EditionConcours_model');
                $this->load->model('Concours_model');
                $this->load->model('Themes_model');
                $this->load->model('Categories_model');
                $this->load->model('Statistiques_model');
                $this->load->helper('download');
                
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
					$this->load->view('Statistiques/consulter_statistiques', $data);
				}
			}
		}
		
		public function stats_un_concours(){
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_un_concours();
				
				//On prepare le contenu du fichier
				$contenu = "Concours; Categorie; Theme; Annee Scolaire; Presence de QCM; Presence d'epreuves ecrites; Presence d'epreuves orales".PHP_EOL;
				
				if ($data['categorie'] !== null){
					$nomCategorie = $data['categorie'];
				}
				else {
					$nomCategorie = "Pas de categorie";
				}
				
				if ($data['theme'] !== null){
					$nomTheme = $data['theme'];
				}
				else {
					$nomTheme = "Pas de Theme";
				}
				
				if ($data['nbAdmisQCM'] !== null) {
					$presenceQCM = "oui";
				}
				else {
					$presenceQCM = "non";
				}
				
				if ($data['nbAdmisEcrits'] !== null) {
					$presenceEcrits = "oui";
				}
				else {
					$presenceEcrits = "non";
				}
				
				if ($data['nbAdmisOraux'] !== null) {
					$presenceOraux = "oui";
				}
				else {
					$presenceOraux = "non";
				}
				
				
				//On rempli le fichier avec les infos generales	
				$contenu .= $data['concours'].";".$nomCategorie.";".$nomTheme.";".$data['anneeScolaire']." - ".($data['anneeScolaire']+1).";".$presenceQCM.";".$presenceEcrits.";".$presenceOraux.";".PHP_EOL.PHP_EOL.PHP_EOL;
				
				$contenu .="Nombre d'inscrits".";";
				if($presenceQCM=="oui")
					$contenu .="Nombre d'admis au QCM".";";
				if($presenceEcrits=="oui")
					$contenu .="Nombre d'admis aux ecrits".";";
				if($presenceOraux)
					$contenu .="Nombre d'admis aux oraux".";";
				
				if($presenceOraux=="oui")
					$contenu .="taux d'admissibles".";";
				$contenu .="taux d'admis".";".PHP_EOL;
				
				$contenu .=$data['nbInscrits'].";";
				if($presenceQCM=="oui")
					$contenu .=$data['nbAdmisQCM'].";";
				if($presenceEcrits=="oui")
					$contenu .=$data['nbAdmisEcrits'].";";
				if($presenceOraux=="oui")
					$contenu .=$data['nbAdmisOraux'].";";
				
				//admissibles
				if($presenceOraux=="oui"){
					if($presenceEcrits=="oui"){
						if($data['nbInscrits'] == 0)
							$contenu .="1";
						else
							$contenu .=($data['nbAdmisEcrits']/$data['nbInscrits']).";";
					}
					else
						$contenu .="1";
				}
				
				//taux d'admis
				if($presenceOraux=="oui"){
					if($data['nbInscrits'] == 0)
						$contenu .="1";
					else
						$contenu .=($data['nbAdmisOraux']/$data['nbInscrits']).";";
				}
				elseif($presenceEcrits=="oui"){
					if($data['nbInscrits'] == 0)
						$contenu .="1";
					else
						$contenu .=($data['nbAdmisEcrits']/$data['nbInscrits']).";";
				}
				elseif($presenceQCM=="oui"){
					if($data['nbInscrits'] == 0)
						$contenu .="1";
					else
						$contenu .=($data['nbAdmisQCM']/$data['nbInscrits']).";";
				}
				else {
					$contenu .="1";
				}
					
				
				
				
				$name = 'Statistiques_'.$data['concours']."_".$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu); 
				
			}
		}
		
}
