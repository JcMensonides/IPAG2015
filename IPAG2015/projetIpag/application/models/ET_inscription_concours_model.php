<?php
class ET_inscription_concours_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        
        public function getEditionConcoursList() {
        	$sql = "SELECT IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire, c.NumConcours, ec.NumEditionConcours, ec.dateResultatsEditionConcours, LibelleConcours, LibelleTheme, LibelleCategorie, ec.dateDebutInscriptionEditionConcours, ec.dateFinInscriptionEditionConcours
					FROM concours c
					JOIN editionconcours ec ON c.NumConcours=ec.NumConcours
					LEFT JOIN Theme ON c.NumTheme=Theme.NumTheme
					LEFT JOIN categorie ON c.NumCategorie=Categorie.NumCategorie
        			WHERE ec.NumEditionConcours NOT IN 
        									(SELECT p.NumEditionConcours FROM participer p WHERE p.NumEtudiant= ?)
					ORDER BY debutAnneeScolaire, LibelleTheme, ec.dateResultatsEditionConcours, LibelleCategorie";
        	$query = $this->db->query($sql, array($this->session->userdata('numEtudiant')));
        	
        	return($query->result_array());
        }
        
        public function getMesConcours() {
        	$sql = "SELECT IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire, c.NumConcours, ec.NumEditionConcours, ec.dateResultatsEditionConcours, LibelleConcours, LibelleTheme, LibelleCategorie, ec.dateDebutInscriptionEditionConcours, ec.dateFinInscriptionEditionConcours
					FROM concours c
					JOIN editionconcours ec ON c.NumConcours=ec.NumConcours
					LEFT JOIN Theme ON c.NumTheme=Theme.NumTheme
					LEFT JOIN categorie ON c.NumCategorie=Categorie.NumCategorie
        			WHERE ec.NumEditionConcours IN
        									(SELECT p.NumEditionConcours FROM participer p WHERE p.NumEtudiant= ?)
					ORDER BY debutAnneeScolaire, LibelleTheme, ec.dateResultatsEditionConcours, LibelleCategorie";
        	$query = $this->db->query($sql, array($this->session->userdata('numEtudiant')));
        	 
        	return($query->result_array());
        }
        
        public function inscriptionEditionConcours() {
        	
        	//inscription de l'etudiant au concours
        	$data = array(
        			'NumEtudiant' => $this->session->userdata('numEtudiant'),
        			'numEditionConcours' => $this->input->post('NumEditionConcours'),
        	);
        	
        	$this->db->insert('participer', $data);
        	
        	//recuperation des informations sur les epreuves
        	$sql = "SELECT *
					from editionconcours ec
					join concours c on c.numconcours=ec.numconcours
					left join epreuvesecrites ee on ee.numepreuvesecrites=ec.numepreuvesecrites
					left join epreuvesorales eo on eo.numepreuvesorales=ec.numepreuvesorales
					left join qcm on qcm.numqcm=ec.numqcm
					left join testsphysiques tph on tph.numtestsphysiques=ec.numtestsphysiques
					left join testspsychotechniques tps on tps.numtestspsychotechniques=ec.numtestspsychotechniques
        			WHERE ec.numeditionconcours= ?";
        	$infos = $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array();
        	
        	//insertion des valeurs "non renseigne" pour le QCM
        	if($infos[0]['numQCM'] !== null) {
        		$data= array(
        				'NumEtudiant' => $this->session->userdata('numEtudiant'),
        				'numQCM' => $infos[0]['numQCM'],
        				'admisQCM' => "non renseigne",
        				'noteQCM' => null,
        		);
        		$this->db->insert('etreadmisqcm', $data);
        	}
        	
        	//insertion des valeurs "non renseigne" pour l epreuve ecrite
        	if($infos[0]['numEpreuvesEcrites'] !== null) {
        		$data= array(
        				'NumEtudiant' => $this->session->userdata('numEtudiant'),
        				'numEpreuvesEcrites' => $infos[0]['numEpreuvesEcrites'],
        				'admisEcrits' => "non renseigne",
        		);
        		$this->db->insert('etreadmisecrits', $data);
        		
        		//insertion des valeurs null pour les notes aux epreuves ecrites
        		if($infos[0]['numEpreuvesEcrites']!== null){
        			$sql= "select NumMatiere, libelleMatiere
						from matiere
						where numEpreuvesEcrites = ?";
        			$listMatieresEcrites = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
        		}
        		else {
        			$listMatieresEcrites = null;
        		}
        		//pour chaque matiere, on insere null
        		if($listMatieresEcrites!== null){
        			foreach($listMatieresEcrites as $ME){
        				$data= array(
        						'NumEtudiant' => $this->session->userdata('numEtudiant'),
        						'NumMatiere' => $ME['NumMatiere'],
        						'noteMatiere' => null,
        				);
        				$this->db->insert('noter', $data);
        			}
        		}
        	}
        	
        	//insertion des valeurs "non renseigne" pour l epreuve orale
        	if($infos[0]['numEpreuvesOrales'] !== null) {
        		$data= array(
        				'NumEtudiant' => $this->session->userdata('numEtudiant'),
        				'numEpreuvesOrales' => $infos[0]['numEpreuvesOrales'],
        				'admisOraux' => "non renseigne",
        		);
        		$this->db->insert('etreadmisoraux', $data);
        	
        		//insertion des valeurs null pour les notes aux epreuves orales
        		if($infos[0]['numEpreuvesOrales']!== null){
        			$sql= "select NumMatiere, libelleMatiere
						from matiere
						where numEpreuvesOrales = ?";
        			$listMatieresOrales = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
        		}
        		else {
        			$listMatieresOrales = null;
        		}
        		//pour chaque matiere, on insere null
        		if($listMatieresOrales!== null){
        			foreach($listMatieresOrales as $ME){
        				$data= array(
        						'NumEtudiant' => $this->session->userdata('numEtudiant'),
        						'NumMatiere' => $ME['NumMatiere'],
        						'noteMatiere' => null,
        				);
        				$this->db->insert('noter', $data);
        			}
        		}
        	}
        	
        	//insertion des valeurs "non renseigne" pour le test physique
        	if($infos[0]['numTestsPhysiques'] !== null) {
        		$data= array(
        				'NumEtudiant' => $this->session->userdata('numEtudiant'),
        				'numTestsPhysiques' => $infos[0]['numTestsPhysiques'],
        				'admisTestsPhysiques' => "non renseigne",
        		);
        		$this->db->insert('etreadmistestsphysiques', $data);
        	}
        	
        	//insertion des valeurs "non renseigne" pour le test psychotechnique
        	if($infos[0]['numTestsPsychoTechniques'] !== null) {
        		$data= array(
        				'NumEtudiant' => $this->session->userdata('numEtudiant'),
        				'numTestsPsychoTechniques' => $infos[0]['numTestsPsychoTechniques'],
        				'admisTestsPsycho' => "non renseigne",
        		);
        		$this->db->insert('etreadmistestspsycho', $data);
        	}
        }
        
        public function getMoreInfos(){
        	$sql = "SELECT *
					from editionconcours ec
					join concours c on c.numconcours=ec.numconcours
					left join epreuvesecrites ee on ee.numepreuvesecrites=ec.numepreuvesecrites
					left join epreuvesorales eo on eo.numepreuvesorales=ec.numepreuvesorales
					left join qcm on qcm.numqcm=ec.numqcm
					left join testsphysiques tph on tph.numtestsphysiques=ec.numtestsphysiques
					left join testspsychotechniques tps on tps.numtestspsychotechniques=ec.numtestspsychotechniques
        			WHERE ec.numeditionconcours= ?";
        	
        	$query = $this->db->query($sql, array($this->input->post('NumEditionConcours')));
        	return($query->result_array());
        	
        }
        
        public function getResultatEdition(){
        	$sql = "SELECT *
					from editionconcours ec
					join concours c on c.numconcours=ec.numconcours
					left join epreuvesecrites ee on ee.numepreuvesecrites=ec.numepreuvesecrites
					left join epreuvesorales eo on eo.numepreuvesorales=ec.numepreuvesorales
					left join qcm on qcm.numqcm=ec.numqcm
					left join testsphysiques tph on tph.numtestsphysiques=ec.numtestsphysiques
					left join testspsychotechniques tps on tps.numtestspsychotechniques=ec.numtestspsychotechniques
        			WHERE ec.numeditionconcours= ?";
        	 
        	$infos = $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array();
        	
        	
        	//infos sur l'admission et la note au QCM
        	if($infos[0]['numQCM']!== null){
        		$sql= "select admisqcm, noteQCM
					from etreadmisqcm
        			where numetudiant=? and numQCM=?";
        		$admisQCM = $this->db->query($sql, array($this->session->userdata('numEtudiant'), $infos[0]['numQCM']))->result_array();
        	}
        	else {
        		$admisQCM =null;
        	}
        	
        	//infos sur l'admission aux ecrits
        	if($infos[0]['numEpreuvesEcrites']!== null){
        		$sql= "select admisEcrits
					from etreadmisecrits
        			where numetudiant=? and numEpreuvesEcrites=?";
        		$admisEcrits = $this->db->query($sql, array($this->session->userdata('numEtudiant'), $infos[0]['numEpreuvesEcrites']))->result_array();
        	}
        	else {
        		$admisEcrits = null;
        	}
        	//liste des matieres ecrites et des notes
        	if($infos[0]['numEpreuvesEcrites']!== null){
        		$sql= "select matiere.numMatiere, matiere.libelleMatiere, noteMatiere
						from matiere
						left join noter on noter.numMatiere=matiere.numMatiere
						where numEpreuvesEcrites = ? and numEtudiant=?";
        		$listMatieresEcrites = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites'], $this->session->userdata('numEtudiant')))->result_array();
        	}
        	else {
        		$listMatieresEcrites = null;
        	}
        	
        	//infos sur l'admission aux orales
        	if($infos[0]['numEpreuvesOrales']!== null){
        		$sql= "select admisOraux
					from etreadmisoraux
        			where numetudiant=? and numEpreuvesOrales=?";
        		$admisOraux = $this->db->query($sql, array($this->session->userdata('numEtudiant'), $infos[0]['numEpreuvesOrales']))->result_array();
        	}
        	else {
        		$admisOraux = null;
        	}
        	//liste des matieres orales et des notes
        	if($infos[0]['numEpreuvesOrales']!== null){
        		$sql= "select matiere.numMatiere, matiere.libelleMatiere, noteMatiere
						from matiere
						left join noter on noter.numMatiere=matiere.numMatiere
						where numEpreuvesOrales = ? and numEtudiant=?";
        		$listMatieresOrales = $this->db->query($sql, array($infos[0]['numEpreuvesOrales'], $this->session->userdata('numEtudiant')))->result_array();
        	}
        	else {
        		$listMatieresOrales = null;
        	}
        	
        	//infos sur l'admission au test physique
        	if($infos[0]['numQCM']!== null){
        		$sql= "select admisTestsPhysiques
					from etreadmistestsphysiques
        			where numetudiant=? and numtestsphysiques=?";
        		$admisTestsPhysiques = $this->db->query($sql, array($this->session->userdata('numEtudiant'), $infos[0]['numTestsPhysiques']))->result_array();
        	}
        	else {
        		$admisTestsPhysiques =null;
        	}
        	
        	//infos sur l'admission au test psychotechnique
        	if($infos[0]['numTestsPsychoTechniques']!== null){
        		$sql= "select admisTestsPsycho
					from etreadmistestspsycho
        			where numetudiant=? and numtestspsychotechniques=?";
        		$admisTestsPsycho = $this->db->query($sql, array($this->session->userdata('numEtudiant'), $infos[0]['numTestsPsychoTechniques']))->result_array();
        	}
        	else {
        		$admisTestsPsycho =null;
        	}
        	
        	return array(
        			'infos' => $infos,
        			'admisQCM' => $admisQCM,
        			'admisEcrits' => $admisEcrits,
        			'listMatieresEcrites' => $listMatieresEcrites,
        			'admisOraux' => $admisOraux,
        			'listMatieresOrales' => $listMatieresOrales,
        			'admisTestsPhysiques' => $admisTestsPhysiques,
        			'admisTestsPsycho' => $admisTestsPsycho,
        	);
        }
}