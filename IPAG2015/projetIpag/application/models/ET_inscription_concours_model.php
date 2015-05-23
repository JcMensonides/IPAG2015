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
        			WHERE ec.numEditionConcours= ?
        			having ec.numEditionConcours IS NOT NULL";
        	
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
        
        public function updateInfos() {
        		
        	//si il y a un qcm
        	if(isset($_POST['admisQCM'])) {
        		$data = array(
        				'admisQCM' => $this->input->post('admisQCM'),
        				'noteQCM' => $this->input->post('noteQCM'),
        		);
        		$where = array('numQCM' => $this->input->post('numQCM'), 'numEtudiant' => $this->session->userdata('numEtudiant'));
        		$this->db->where($where);
        		$this->db->update('etreadmisqcm', $data);     	
        	}
        	
        	//si il y a une epreuve ecrite
        	if(isset($_POST['numEpreuvesEcrites'])) {
        		$data = array(
        				'admisEcrits' => $this->input->post('admisEpreuvesEcrites'),
        		);
        		$where = array('numEpreuvesEcrites' => $this->input->post('numEpreuvesEcrites'), 'numEtudiant' => $this->session->userdata('numEtudiant'));
        		$this->db->where($where);
        		$this->db->update('etreadmisecrits', $data);
        	}
        	//pour chaque matiere ecrite
        	$i = 1;
        	while(isset($_POST['me'.$i])){
        		if($this->input->post('me'.$i) == 'non renseigne'){
        			$noteEcrit = null;
        		}
        		else{
        			$noteEcrit = $this->input->post('me'.$i);
        		}
        		$data = array(
        				'noteMatiere' => $noteEcrit,
        		);
        		$where = array('numMatiere' => $this->input->post('ecrit'.$i), 'numEtudiant' => $this->session->userdata('numEtudiant'));
        		$this->db->where($where);
        		$this->db->update('noter', $data);
        		$i++;
        	}
        	
        	
        	//si il y a une epreuve orale
        	if(isset($_POST['numEpreuvesOrales'])) {
        		$data = array(
        				'admisOraux' => $this->input->post('admisEpreuvesOrales'),
        		);
        		$where = array('numEpreuvesOrales' => $this->input->post('numEpreuvesOrales'), 'numEtudiant' => $this->session->userdata('numEtudiant'));
        		$this->db->where($where);
        		$this->db->update('etreadmisoraux', $data);
        	}
        	//pour chaque matiere orale
        	$i = 1;
        	while(isset($_POST['mo'.$i])){
        		if($this->input->post('mo'.$i) == 'non renseigne'){
        			$noteOrale = null;
        		}
        		else{
        			$noteOrale = $this->input->post('mo'.$i);
        		}
        		$data = array(
        				'noteMatiere' => $noteOrale,
        		);
        		$where = array('numMatiere' => $this->input->post('oral'.$i), 'numEtudiant' => $this->session->userdata('numEtudiant'));
        		$this->db->where($where);
        		$this->db->update('noter', $data);
        		$i++;
        	}
        	
        	//si il y a un test physique
        	if(isset($_POST['numTestsPhysiques'])) {
        		$data = array(
        				'admisTestsPhysiques' => $this->input->post('admisTestsPhysiques'),
        		);
        		$where = array('numTestsPhysiques' => $this->input->post('numTestsPhysiques'), 'numEtudiant' => $this->session->userdata('numEtudiant'));
        		$this->db->where($where);
        		$this->db->update('etreadmistestsphysiques', $data);
        	}
        	
        	//si il y a un test psychotechnique
        	if(isset($_POST['numTestsPsychoTechniques'])) {
        		$data = array(
        				'admisTestsPsycho' => $this->input->post('admisTestsPsycho'),
        		);
        		$where = array('numTestsPsychoTechniques' => $this->input->post('numTestsPsychoTechniques'), 'numEtudiant' => $this->session->userdata('numEtudiant'));
        		$this->db->where($where);
        		$this->db->update('etreadmistestspsycho', $data);
        	}
        	
        }
}