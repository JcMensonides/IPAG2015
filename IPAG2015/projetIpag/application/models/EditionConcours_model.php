<?php
class EditionConcours_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function getInfosEditionConcours(){
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
        	 
        	 
        	
        	//liste des matieres ecrites
        	if($infos[0]['numEpreuvesEcrites']!== null){
        		$sql= "select matiere.numMatiere, matiere.libelleMatiere
						from matiere
						where numEpreuvesEcrites = ?";
        		$listMatieresEcrites = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
        	}
        	else {
        		$listMatieresEcrites = null;
        	}
        	 
        
        	//liste des matieres orales
        	if($infos[0]['numEpreuvesOrales']!== null){
        		$sql= "select matiere.numMatiere, matiere.libelleMatiere
						from matiere
						where numEpreuvesOrales = ?";
        		$listMatieresOrales = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
        	}
        	else {
        		$listMatieresOrales = null;
        	}
        	 
        	return array(
        			'infos' => $infos,
        			'listMatieresEcrites' => $listMatieresEcrites,
        			'listMatieresOrales' => $listMatieresOrales,
        	);
        }
        
        public function ajoutEditionConcours(){
        	
        	//creation de l'edition
        	if($this->input->post('dateDebutInscriptionEditionConcours') !== ""){
        		$dateDebutInscriptionEditionConcours = $this->input->post('dateDebutInscriptionEditionConcours');
        	}
        	else{
        		$dateDebutInscriptionEditionConcours = null;
        	}
        	$data = array(
        			'NumConcours' =>  $this->input->post('numConcours'),
        			'dateDebutInscriptionEditionConcours' => $dateDebutInscriptionEditionConcours,
        			'dateFinInscriptionEditionConcours' => $this->input->post('dateFinInscriptionEditionConcours'),
        			'dateResultatsEditionConcours' => $this->input->post('dateResultatsEditionConcours'),
        	);
        		
        	$this->db->insert('editionconcours', $data);
        	$numEdition = $this->db->insert_id();
        	
        		//creation du QCM
				if($this->input->post('DateResultatQCM') !== "null"){
					if($this->input->post('DateQCM')== "") {
						$DateQCM = null;
					}
					else{
						$DateQCM = $this->input->post('DateQCM');
					}
					$QCM = array(
							'dateQCM' => $DateQCM,
							'dateResultatQCM' => $this->input->post('DateResultatQCM'),
							'numEditionConcours' => $numEdition,
					);
					$this->db->insert('qcm', $QCM);
					$numQCM = $this->db->insert_id();
				}
				else {
					$numQCM = null;
				}
				
				
				//creation de l'epreuve ecrite
				if($this->input->post('DateResultatEpreuveEcrite') !== "null"){
					if($this->input->post('DateDebutEpreuveEcrite')== "") {
						$DateDebutEpreuveEcrite = null;
					}
					else{
						$DateDebutEpreuveEcrite = $this->input->post('DateEpreuveEcrite');
					}
					
					if($this->input->post('DateFinEpreuveEcrite')== "") {
						$DateFinEpreuveEcrite = null;
					}
					else{
						$DateFinEpreuveEcrite = $this->input->post('DateFinEpreuveEcrite');
					}
					
					
					$EpreuveEcrite = array(
							'dateDebutEpreuvesEcrites' => $DateDebutEpreuveEcrite,
							'dateFinEpreuvesEcrites' => $DateFinEpreuveEcrite,
							'dateResultatEpreuvesEcrites' => $this->input->post('DateResultatEpreuveEcrite'),
							'numEditionConcours' => $numEdition,
					);
					$this->db->insert('epreuvesecrites', $EpreuveEcrite);
					$numEpreuveEcrite = $this->db->insert_id();
					
					//ajout des matieres ecrites
					$i = 1;
					while(isset($_POST['matiereEcrite'.$i])){
						$matiereEcrite = array(
								'LibelleMatiere' => $this->input->post('matiereEcrite'.$i),
								'numEpreuvesEcrites' => $numEpreuveEcrite,
						);
						$this->db->insert('matiere', $matiereEcrite);
						$i++;
					}
				}
				else {
					$numEpreuveEcrite = null;
				}
				
				//creation de l'epreuve orale
				if($this->input->post('DateResultatEpreuveOrale') !== "null"){
					if($this->input->post('DateDebutEpreuveOrale')== "") {
						$DateDebutEpreuveOrale = null;
					}
					else{
						$DateDebutEpreuveOrale = $this->input->post('DateEpreuveOrale');
					}
						
					if($this->input->post('DateFinEpreuveOrale')== "") {
						$DateFinEpreuveOrale = null;
					}
					else{
						$DateFinEpreuveOrale = $this->input->post('DateFinEpreuveOrale');
					}
						
						
					$EpreuveOrale = array(
							'dateDebutEpreuvesOrales' => $DateDebutEpreuveOrale,
							'dateFinEpreuvesOrales' => $DateFinEpreuveOrale,
							'dateResultatEpreuvesOrales' => $this->input->post('DateResultatEpreuveOrale'),
							'numEditionConcours' => $numEdition,
					);
					$this->db->insert('epreuvesorales', $EpreuveOrale);
					$numEpreuveOrale = $this->db->insert_id();
					
					//ajout des matieres orales
					$i = 1;
					while(isset($_POST['matiereOrale'.$i])){
						$matiereOrale = array(
								'LibelleMatiere' => $this->input->post('matiereOrale'.$i),
								'numEpreuvesOrales' => $numEpreuveOrale,
						);
						$this->db->insert('matiere', $matiereOrale);
						$i++;
					}
				}
				else {
					$numEpreuveOrale = null;
				}
				
				//creation du test physique
				if($this->input->post('DateResultatEpreuvePhysique') !== "null"){
					if($this->input->post('DateEpreuvePhysique')== "") {
						$DateEpreuvePhysique = null;
					}
					else{
						$DateEpreuvePhysique = $this->input->post('DateEpreuvePhysique');
					}
					$EpreuvePhysique = array(
							'dateTestsPhysiques' => $DateEpreuvePhysique,
							'dateResultatsTestsPhysiques' => $this->input->post('DateResultatEpreuvePhysique'),
							'numEditionConcours' => $numEdition,
					);
					$this->db->insert('testsphysiques', $EpreuvePhysique);
					$numEpreuvePhysique = $this->db->insert_id();
				}
				else {
					$numEpreuvePhysique = null;
				}
				
				///creation du test psychotechnique
				if($this->input->post('DateResultatEpreuvePsychoTechnique') !== "null"){
					if($this->input->post('DateEpreuvePsychoTechnique')== "") {
						$DateEpreuvePsychotechnique = null;
					}
					else{
						$DateEpreuvePsychotechnique = $this->input->post('DateEpreuvePsychoTechnique');
					}
					$EpreuvePsychotechnique = array(
							'dateTestsPsychoTechniques' => $DateEpreuvePsychotechnique,
							'dateResultatPsychoTechniques' => $this->input->post('DateResultatEpreuvePsychoTechnique'),
							'numEditionConcours' => $numEdition,
					);
					$this->db->insert('testspsychotechniques', $EpreuvePsychotechnique);
					$numEpreuvePsychotechnique = $this->db->insert_id();
				}
				else {
					$numEpreuvePsychotechnique = null;
				}
				
				//On indique a l'edition de quelles epreuves elle dispose
				$listNumEpreuves = array(
						'numEpreuvesEcrites' => $numEpreuveEcrite,
						'numEpreuvesOrales' => $numEpreuveOrale,
						'numQCM' => $numQCM,
						'numTestsPsychoTechniques' => $numEpreuvePsychotechnique,
						'numTestsPhysiques' => $numEpreuvePhysique,
				);
				$this->db->where('numEditionConcours', $numEdition);
				$this->db->update('editionconcours', $listNumEpreuves);
        }
        
        public function nomEditionConcoursDisponible()
        {
        	if(isset($_POST['NumEditionConcours'])) {
        		$sql = "SELECT LibelleEditionConcours FROM concours WHERE LibelleEditionConcours = ? AND NumEditionConcours <> ?";
        		$query = $this->db->query($sql, array($this->input->post('nomEditionConcours'), $this->input->post('NumEditionConcours')));
        	}
        	else{
        		$sql = "SELECT LibelleEditionConcours FROM concours WHERE LibelleEditionConcours = ?";
        		$query = $this->db->query($sql, array($this->input->post('nomEditionConcours')));
        	}
        	
        
        	return(empty($query->result()));
        }
        
        public function getEditionConcoursList() {
        	$sql = "SELECT IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire, c.NumConcours, ec.NumEditionConcours, ec.dateResultatsEditionConcours, LibelleConcours, LibelleTheme, LibelleCategorie, ec.dateDebutInscriptionEditionConcours, ec.dateFinInscriptionEditionConcours, ec.numEpreuvesEcrites, ec.numEpreuvesOrales, ec.numQCM, ec.numTestsPsychoTechniques, ec.numTestsPhysiques
					FROM concours c
					JOIN editionconcours ec ON c.NumConcours=ec.NumConcours
					LEFT JOIN Theme ON c.NumTheme=Theme.NumTheme
					LEFT JOIN categorie ON c.NumCategorie=Categorie.NumCategorie
					ORDER BY debutAnneeScolaire, LibelleTheme, ec.dateResultatsEditionConcours, LibelleCategorie";
        	$query = $this->db->query($sql);
        	
        	return($query->result_array());
        }
        
        public function supprimerEditionConcours() {
        	$sql = "DELETE FROM  concours WHERE NumEditionConcours = ?";
        	$query = $this->db->query($sql, array($this->input->post('NumEditionConcours')));
        }
        
        public function updateEditionConcours() {
        	
        	if(($this->input->post('numTheme'))) {
        		$numTheme = $this->input->post('numTheme');
        	}
        	else
        	{
        		$numTheme = null;
        	}
        	 
        	if(($this->input->post('numCategorie'))) {
        		$numCategorie = $this->input->post('numCategorie');
        	}
        	else
        	{
        		$numCategorie = null;
        	}
        	 
        	$data = array(
        			'LibelleEditionConcours' => $this->input->post('nomEditionConcours'),
        			'NumTheme' => $numTheme,
        			'NumCategorie' => $numCategorie,
        	);
        	
        	$this->db->where('NumEditionConcours', $this->input->post('NumEditionConcours'));
        	$this->db->update('concours', $data);
        }
        
        public function getEditionConcoursTheme() {
        	$sql = "SELECT NumTheme FROM concours WHERE NumEditionConcours = ?";
        	$query = $this->db->query($sql, array($this->input->post('NumEditionConcours')));
        	 
        	return($query->result_array());
        }
        
        public function getEditionConcoursCategorie() {
        	$sql = "SELECT NumCategorie FROM concours WHERE NumEditionConcours = ?";
        	$query = $this->db->query($sql, array($this->input->post('NumEditionConcours')));
        
        	return($query->result_array());
        }
}