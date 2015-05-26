<?php
class Statistiques_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
       public function stats_un_concours() {
       	//les infos generales du concours
       	$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       	$infos = $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array();
       	
       	//combien d'inscrits au concours?
       	$sql = "select count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?";
       	$nbInscrits= $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array()[0]['nbInscrits'];
       	
       	//nomdre d'admis au qcm
       	if($infos[0]['numQCM'] !== null) {
       		$sql= "select count(*) as nbAdmisQCM
					from etreadmisqcm
					where numqcm= ? and admisqcm='admis'";
       		$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array()[0]['nbAdmisQCM'];
       	}
       	else {
       		$nbAdmisQCM = null;
       	}
       	
       	//nombre d'admis a l'ecrit
       	if($infos[0]['numEpreuvesEcrites'] !== null) {
       		$sql= "select count(*) as nbAdmisEcrits
					from etreadmisecrits
					where numepreuvesecrites= ? and admisecrits='admis'";
       		$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array()[0]['nbAdmisEcrits'];
       	}
       	else {
       		$nbAdmisEcrits = null;
       	}
       	
       	//nombre d'admis a l'oral
       	if($infos[0]['numEpreuvesOrales'] !== null) {
       		$sql= "select count(*) as nbAdmisOraux
					from etreadmisoraux
					where numepreuvesorales= ? and admisoraux='admis'";
       		$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array()[0]['nbAdmisOraux'];
       	}
       	else {
       		$nbAdmisOraux = null;
       	}
       	
       	$result= array(
       			'concours' => $infos[0]['LibelleConcours'],
       			'categorie' => $infos[0]['LibelleCategorie'],
       			'theme' => $infos[0]['LibelleTheme'],
       			'anneeScolaire' => $infos[0]['debutAnneeScolaire'],
       			'nbInscrits' => $nbInscrits,
       			'nbAdmisQCM' => $nbAdmisQCM,
       			'nbAdmisEcrits' => $nbAdmisEcrits,
       			'nbAdmisOraux' => $nbAdmisOraux,
       	);

       	return $result;
       }
       
       public function stats_un_concours_avec_param($numEditionConcours){
       	//les infos generales du concours
       	$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       	$infos = $this->db->query($sql, array($numEditionConcours))->result_array();
       	
       	//combien d'inscrits au concours?
       	$sql = "select count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?";
       	$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array()[0]['nbInscrits'];
       	
       	//nomdre d'admis au qcm
       	if($infos[0]['numQCM'] !== null) {
       		$sql= "select count(*) as nbAdmisQCM
					from etreadmisqcm
					where numqcm= ? and admisqcm='admis'";
       		$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array()[0]['nbAdmisQCM'];
       	}
       	else {
       		$nbAdmisQCM = null;
       	}
       	
       	//nombre d'admis a l'ecrit
       	if($infos[0]['numEpreuvesEcrites'] !== null) {
       		$sql= "select count(*) as nbAdmisEcrits
					from etreadmisecrits
					where numepreuvesecrites= ? and admisecrits='admis'";
       		$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array()[0]['nbAdmisEcrits'];
       	}
       	else {
       		$nbAdmisEcrits = null;
       	}
       	
       	//nombre d'admis a l'oral
       	if($infos[0]['numEpreuvesOrales'] !== null) {
       		$sql= "select count(*) as nbAdmisOraux
					from etreadmisoraux
					where numepreuvesorales= ? and admisoraux='admis'";
       		$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array()[0]['nbAdmisOraux'];
       	}
       	else {
       		$nbAdmisOraux = null;
       	}
       	
       	$result= array(
       			'concours' => $infos[0]['LibelleConcours'],
       			'categorie' => $infos[0]['LibelleCategorie'],
       			'theme' => $infos[0]['LibelleTheme'],
       			'anneeScolaire' => $infos[0]['debutAnneeScolaire'],
       			'nbInscrits' => $nbInscrits,
       			'nbAdmisQCM' => $nbAdmisQCM,
       			'nbAdmisEcrits' => $nbAdmisEcrits,
       			'nbAdmisOraux' => $nbAdmisOraux,
       	);
       	
       	return $result;
       	}
       	
       	public function stats_tous_concours() {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       		
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_avec_param($uneEdition['numEditionConcours']));
       		}
       		
       		return $result;
       	}
       	
       	public function stats_une_categorie() {
       		if($this->input->post('categorie') !="") {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec, concours c, categorie cat
					where ec.numconcours=c.numconcours and c.numcategorie=cat.numcategorie and cat.libellecategorie=?
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('categorie'),$this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		else {
       			$sql = "select distinct numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
		       		from editionconcours ec, concours c, categorie cat
		       		where ec.numconcours=c.numconcours and c.numcategorie is null
		       		having debutAnneeScolaire=?";
       			$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		
       		
       		 
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_avec_param($uneEdition['numEditionConcours']));
       		}
       		 
       		return $result;
       	}
       	
		public function stats_un_theme() {
       		if($this->input->post('theme') !="") {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec, concours c, theme t
					where ec.numconcours=c.numconcours and c.numtheme=t.numtheme and t.libelletheme=?
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('theme'),$this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		else {
       			$sql = "select distinct numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
		       		from editionconcours ec, concours c, theme t
		       		where ec.numconcours=c.numconcours and c.numtheme is null
		       		having debutAnneeScolaire=?";
       			$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		
       		
       		 
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_avec_param($uneEdition['numEditionConcours']));
       		}
       		 
       		return $result;
       	}
       	
       	public function stats_couple_theme_cat() {
       		if($this->input->post('categorie') !="" && $this->input->post('theme') !="") {
       			$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec, concours c, categorie cat, theme t
					where ec.numconcours=c.numconcours and c.numcategorie=cat.numcategorie and c.numtheme=t.numtheme and cat.libellecategorie=? and t.libelletheme=?
					having debutAnneeScolaire=?";
       			$listEditions = $this->db->query($sql, array($this->input->post('categorie'), $this->input->post('theme'),$this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		elseif($this->input->post('categorie') !="" && $this->input->post('theme') =="") {
       			$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec, concours c, categorie cat, theme t
					where ec.numconcours=c.numconcours and c.numcategorie=cat.numcategorie and c.numtheme is null and cat.libellecategorie=?
					having debutAnneeScolaire=?";
       			$listEditions = $this->db->query($sql, array($this->input->post('categorie'),$this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		elseif($this->input->post('categorie') =="" && $this->input->post('theme') !="") {
       			$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec, concours c, categorie cat, theme t
					where ec.numconcours=c.numconcours and c.numcategorie is null and c.numtheme=t.numtheme and t.libelletheme=?
					having debutAnneeScolaire=?";
       			$listEditions = $this->db->query($sql, array($this->input->post('theme'),$this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		elseif($this->input->post('categorie') =="" && $this->input->post('theme') =="") {
       			$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec, concours c
					where ec.numconcours=c.numconcours and c.numcategorie is null and c.numtheme is null
					having debutAnneeScolaire=?";
       			$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       		}
       		
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_avec_param($uneEdition['numEditionConcours']));
       		}
       		
       		return $result;
       		
       	}
       	
       	public function stats_un_concours_avec_critere($numEditionConcours, $critere){
       		//les infos generales du concours
       		$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       		$infos = $this->db->query($sql, array($numEditionConcours))->result_array();
       	
       		//combien d'inscrits au concours?
       		$sql = "select sexe, count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?
       			group by sexe";
       		$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array()[1]['nbInscrits'];
       	
       		//nomdre d'admis au qcm
       		if($infos[0]['numQCM'] !== null) {
       			$sql= "select count(*) as nbAdmisQCM
					from etreadmisqcm
					where numqcm= ? and admisqcm='admis'";
       			$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array()[0]['nbAdmisQCM'];
       		}
       		else {
       			$nbAdmisQCM = null;
       		}
       	
       		//nombre d'admis a l'ecrit
       		if($infos[0]['numEpreuvesEcrites'] !== null) {
       			$sql= "select count(*) as nbAdmisEcrits
					from etreadmisecrits
					where numepreuvesecrites= ? and admisecrits='admis'";
       			$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array()[0]['nbAdmisEcrits'];
       		}
       		else {
       			$nbAdmisEcrits = null;
       		}
       	
       		//nombre d'admis a l'oral
       		if($infos[0]['numEpreuvesOrales'] !== null) {
       			$sql= "select count(*) as nbAdmisOraux
					from etreadmisoraux
					where numepreuvesorales= ? and admisoraux='admis'";
       			$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array()[0]['nbAdmisOraux'];
       		}
       		else {
       			$nbAdmisOraux = null;
       		}
       	
       		$result= array(
       				'concours' => $infos[0]['LibelleConcours'],
       				'categorie' => $infos[0]['LibelleCategorie'],
       				'theme' => $infos[0]['LibelleTheme'],
       				'anneeScolaire' => $infos[0]['debutAnneeScolaire'],
       				'nbInscrits' => $nbInscrits,
       				'nbAdmisQCM' => $nbAdmisQCM,
       				'nbAdmisEcrits' => $nbAdmisEcrits,
       				'nbAdmisOraux' => $nbAdmisOraux,
       		);
       	
       		return $result;
       	}
       	
       	public function stats_tous_concours_avec_critere($critere) {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       		 
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_avec_critere($uneEdition['numEditionConcours'], $critere));
       		}
       		 
       		return $result;
       	}
       	

}