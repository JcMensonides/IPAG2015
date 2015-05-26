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
						if($data['nbInscrits'] == 0){
							$contenu .="1".";";
						}
						else {
							$contenu .=($data['nbAdmisEcrits']/$data['nbInscrits']).";";
						}
					}
					elseif($presenceQCM=="oui") {
						if($data['nbInscrits'] == 0){
							$contenu .="1".";";
						}
						else {
							$contenu .=($data['nbAdmisQCM']/$data['nbInscrits']).";";
						}
					}
					else {
						$contenu .="1".";";
					}		
				}
				
				
				//taux d'admis
				if($presenceOraux=="oui"){
					if($data['nbInscrits'] == 0)
						$contenu .="1".";";
					else
						$contenu .=($data['nbAdmisOraux']/$data['nbInscrits']).";";
				}
				elseif($presenceEcrits=="oui"){
					if($data['nbInscrits'] == 0)
						$contenu .="1".";";
					else
						$contenu .=($data['nbAdmisEcrits']/$data['nbInscrits']).";";
				}
				elseif($presenceQCM=="oui"){
					if($data['nbInscrits'] == 0)
						$contenu .="1".";";
					else
						$contenu .=($data['nbAdmisQCM']/$data['nbInscrits']).";";
				}
				else {
					$contenu .="1".";";
				}
					
				$contenu .=PHP_EOL.PHP_EOL;
				
				
				$name = 'Statistiques_'.$data['concours']."_".$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu); 
				
			}
		}
		
		public function stats_tous_concours() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_tous_concours();
				
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer($uneEdition);
				}
				
				$name = 'Statistiques_Tous_Concours_'.$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		public function preparer_chaine_a_inserer($data){
			//On prepare l'entete du fichier
			$contenu = "Concours; Categorie; Theme; Annee Scolaire; Presence de QCM; Presence d'epreuves ecrites; Presence d'epreuves orales".";";
			
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
			
			$contenu .="Nombre d'inscrits".";";
			if($presenceQCM=="oui")
				$contenu .="Nombre d'admis au QCM".";";
			if($presenceEcrits=="oui")
				$contenu .="Nombre d'admis aux ecrits".";";
			if($presenceOraux=="oui")
				$contenu .="Nombre d'admis aux oraux".";";
				
			if($presenceOraux=="oui")
				$contenu .="taux d'admissibles".";";
			$contenu .="taux d'admis".";".PHP_EOL;
			
			
			
			
			//On rempli le contenu du fichier
			$contenu .= $data['concours'].";".$nomCategorie.";".$nomTheme.";".$data['anneeScolaire']." - ".($data['anneeScolaire']+1).";".$presenceQCM.";".$presenceEcrits.";".$presenceOraux.";";
			
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
					if($data['nbInscrits'] == 0){
						$contenu .="1".";";
					}
					else {
						$contenu .=($data['nbAdmisEcrits']/$data['nbInscrits']).";";
					}
				}
				elseif($presenceQCM=="oui") {
					if($data['nbInscrits'] == 0){
						$contenu .="1".";";
					}
					else {
						$contenu .=($data['nbAdmisQCM']/$data['nbInscrits']).";";
					}
				}
				else {
					$contenu .="1".";";
				}
			}
			
			
			//taux d'admis
			if($presenceOraux=="oui"){
				if($data['nbInscrits'] == 0)
					$contenu .="1".";";
				else
					$contenu .=($data['nbAdmisOraux']/$data['nbInscrits']).";";
			}
			elseif($presenceEcrits=="oui"){
				if($data['nbInscrits'] == 0)
					$contenu .="1".";";
				else
					$contenu .=($data['nbAdmisEcrits']/$data['nbInscrits']).";";
			}
			elseif($presenceQCM=="oui"){
				if($data['nbInscrits'] == 0)
					$contenu .="1".";";
				else
					$contenu .=($data['nbAdmisQCM']/$data['nbInscrits']).";";
			}
			else {
				$contenu .="1".";";
			}
				
			$contenu .=PHP_EOL.PHP_EOL;
			
			return $contenu;
		}
		
		public function stats_une_categorie(){
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_une_categorie();
			
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer($uneEdition);
				}
			
				$name = 'Statistiques_Categorie_'.$this->input->post('categorie')."_".$data[0]['anneeScolaire']."_".($data[0]['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		public function stats_un_theme() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_un_theme();
					
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer($uneEdition);
				}
				//.$data['anneeScolaire']."_".($data['anneeScolaire']+1).
				$name = 'Statistiques_Theme_'.$this->input->post('theme')."_".$data[0]['anneeScolaire']."_".($data[0]['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		public function stats_couple_theme_cat(){
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_couple_theme_cat();
				
					
				$contenu = "";
				if(!empty($data)){
					foreach ($data as $uneEdition) {
						$contenu .= $this->preparer_chaine_a_inserer($uneEdition);
					}
				}
				else {
					$contenu="Pas de concours correspondants";
				}

				$name = 'Statistiques_Categorie_'.$this->input->post('categorie').'_Theme_'.$this->input->post('theme').".csv";
				force_download($name, $contenu);
				
				
			}
		}
		
		
		
		public function preparer_chaine_a_inserer_avec_critere($data, $nomDuCritere){
			//On prepare l'entete du fichier
			$contenu = $nomDuCritere."; Concours; Categorie; Theme; Annee Scolaire; Presence de QCM; Presence d'epreuves ecrites; Presence d'epreuves orales".";";
				
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
				
			$contenu .="Nombre d'inscrits".";";
			if($presenceQCM=="oui")
				$contenu .="Nombre d'admis au QCM".";";
			if($presenceEcrits=="oui")
				$contenu .="Nombre d'admis aux ecrits".";";
			if($presenceOraux=="oui")
				$contenu .="Nombre d'admis aux oraux".";";
		
			if($presenceOraux=="oui")
				$contenu .="taux d'admissibles".";";
			$contenu .="taux d'admis".";".PHP_EOL;
				
				
				
				
			//On rempli le contenu du fichier
			$i=0;
			foreach($data['nbInscrits'] as $uneLigne){
			$contenu .= $data['modalites'][$i].";".$data['concours'].";".$nomCategorie.";".$nomTheme.";".$data['anneeScolaire']." - ".($data['anneeScolaire']+1).";".$presenceQCM.";".$presenceEcrits.";".$presenceOraux.";";
				
				$contenu .=$data['nbInscrits'][$i]['nbInscrits'].";";
				if($presenceQCM=="oui")
					$contenu .=$data['nbAdmisQCM'][$i]['nbAdmisQCM'].";";
				if($presenceEcrits=="oui")
					$contenu .=$data['nbAdmisEcrits'][$i]['nbAdmisEcrits'].";";
				if($presenceOraux=="oui")
					$contenu .=$data['nbAdmisOraux'][$i]['nbAdmisOraux'].";";
				
				//admissibles
				if($presenceOraux=="oui"){
					if($presenceEcrits=="oui"){
						if($data['nbInscrits'][$i]['nbInscrits'] == 0){
							$contenu .="1".";";
						}
						else {
							$contenu .=($data['nbAdmisEcrits'][$i]['nbAdmisEcrits']/$data['nbInscrits'][$i]['nbInscrits']).";";
						}
					}
					elseif($presenceQCM=="oui") {
						if($data['nbInscrits'][$i]['nbInscrits'] == 0){
							$contenu .="1".";";
						}
						else {
							$contenu .=($data['nbAdmisQCM'][$i]['nbAdmisQCM']/$data['nbInscrits'][$i]['nbInscrits']).";";
						}
					}
					else {
						$contenu .="1".";";
					}
				}
				
				
				//taux d'admis
				if($presenceOraux=="oui"){
					if($data['nbInscrits'][$i]['nbInscrits'] == 0)
						$contenu .="1".";";
					else
						$contenu .=($data['nbAdmisOraux'][$i]['nbAdmisOraux']/$data['nbInscrits'][$i]['nbInscrits']).";";
				}
				elseif($presenceEcrits=="oui"){
					if($data['nbInscrits'][$i]['nbInscrits'] == 0)
						$contenu .="1".";";
					else
						$contenu .=($data['nbAdmisEcrits'][$i]['nbAdmisEcrits']/$data['nbInscrits'][$i]['nbInscrits']).";";
				}
				elseif($presenceQCM=="oui"){
					if($data['nbInscrits'][$i]['nbInscrits'] == 0)
						$contenu .="1".";";
					else
						$contenu .=($data['nbAdmisQCM'][$i]['nbAdmisQCM']/$data['nbInscrits'][$i]['nbInscrits']).";";
				}
				else {
					$contenu .="1".";";
				}
				
				$contenu .=PHP_EOL;
				$i++;
			}
			$contenu .=PHP_EOL.PHP_EOL.PHP_EOL;
				
			return $contenu;
		}
		
		public function stats_tous_concours_par_sexe() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_tous_concours_par_sexe();
					
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer_avec_critere($uneEdition, "Sexe");
				}
					
				$name = 'Statistiques_Tous_Concours_par_sexe'.$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		public function stats_tous_concours_par_boursier() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_tous_concours_par_boursier();
					
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer_avec_critere($uneEdition, "Boursier");
				}
					
				$name = 'Statistiques_Tous_Concours_par_boursier'.$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		public function stats_tous_concours_par_origine() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_tous_concours_par_origine();
					
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer_avec_critere($uneEdition, "Origine");
				}
					
				$name = 'Statistiques_Tous_Concours_par_origine'.$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		
		public function stats_tous_concours_par_dernierdiplome() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_tous_concours_par_dernierdiplome();
					
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer_avec_critere($uneEdition, "Dernier diplome");
				}
					
				$name = 'Statistiques_Tous_Concours_par_dernierdiplome'.$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		public function stats_tous_concours_par_diplomenationalcourant() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_tous_concours_par_diplomenationalcourant();
					
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer_avec_critere($uneEdition, "Diplome national courant");
				}
					
				$name = 'Statistiques_Tous_Concours_par_diplomenationalcourant'.$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
		
		public function stats_tous_concours_par_age() {
			if($this->session->userdata('numEtudiant')=="admin"){
				$data = $this->Statistiques_model->stats_tous_concours_par_age();
					
				$contenu = "";
				foreach ($data as $uneEdition) {
					$contenu .= $this->preparer_chaine_a_inserer_avec_critere($uneEdition, "Annee de naissance");
				}
					
				$name = 'Statistiques_Tous_Concours_par_age'.$data['anneeScolaire']."_".($data['anneeScolaire']+1).".csv";
				force_download($name, $contenu);
			}
		}
}
