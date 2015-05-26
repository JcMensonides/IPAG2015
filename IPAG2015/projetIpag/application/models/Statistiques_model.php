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
       	
       	//etudiants inscrits au concours
       	$sql = "select *
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?";
       	$listeInscrits= $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array();
       	
       	//nomdre d'admis au qcm
       	if($infos[0]['numQCM'] !== null) {
       		$sql= "select count(*) as nbAdmisQCM
					from etreadmisqcm
					where numqcm= ? and admisqcm='admis'";
       		$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array()[0]['nbAdmisQCM'];
       		//etudiants ayant reussi le qcm
       		$sql= "select *
					from etreadmisqcm, etudiant e
					where numqcm= ? and admisqcm='admis' and etreadmisqcm.numetudiant=e.numetudiant";
       		$listeAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array();
       	}
       	else {
       		$nbAdmisQCM = null;
       		$listeAdmisQCM = null;
       	}
       	
       	//nombre d'admis a l'ecrit
       	if($infos[0]['numEpreuvesEcrites'] !== null) {
       		$sql= "select count(*) as nbAdmisEcrits
					from etreadmisecrits
					where numepreuvesecrites= ? and admisecrits='admis'";
       		$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array()[0]['nbAdmisEcrits'];
       		//etudiants ayant reussi l'ecrit
       		$sql= "select *
					from etreadmisecrits, etudiant e
					where numepreuvesecrites= ? and admisecrits='admis' and etreadmisecrits.numetudiant=e.numetudiant";
       		$listeAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
       	}
       	else {
       		$nbAdmisEcrits = null;
       		$listeAdmisEcrits = null;
       	}
       	
       	//nombre d'admis a l'oral
       	if($infos[0]['numEpreuvesOrales'] !== null) {
       		$sql= "select count(*) as nbAdmisOraux
					from etreadmisoraux
					where numepreuvesorales= ? and admisoraux='admis'";
       		$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array()[0]['nbAdmisOraux'];
       	//liste admis oraux
       		$sql= "select *
					from etreadmisoraux, etudiant e
					where numepreuvesorales= ? and admisoraux='admis' and etreadmisoraux.numetudiant=e.numetudiant";
       		$listeAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
       	}
       	else {
       		$nbAdmisOraux = null;
       		$listeAdmisOraux = null;
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
       			'listeInscrits' => $listeInscrits,
       			'listeAdmisQCM' => $listeAdmisQCM,
       			'listeAdmisEcrits' => $listeAdmisEcrits,
       			'listeAdmisOraux' => $listeAdmisOraux,
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
       	
       	public function stats_un_concours_par_sexe($numEditionConcours){
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
       		$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array();
       		
       		//liste des modalites sexe
       		$modalites = array();
       		foreach($nbInscrits as $uneModalite) {
       			array_push($modalites, $uneModalite['sexe']);
       		}
       	
       		//nomdre d'admis au qcm
       	if($infos[0]['numQCM'] !== null) {
       		$sql= "select sexe, count(*) as nbAdmisQCM
					from etreadmisqcm, etudiant e
					where numqcm= ? and admisqcm='admis' and etreadmisqcm.numetudiant=e.numetudiant
       				group by sexe";
       		$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array();
       	}
       	else {
       		$nbAdmisQCM = null;
       	}
       	
       	//nombre d'admis a l'ecrit
       	if($infos[0]['numEpreuvesEcrites'] !== null) {
       		$sql= "select sexe, count(*) as nbAdmisEcrits
					from etreadmisecrits, etudiant e
					where numepreuvesecrites= ? and admisecrits='admis' and etreadmisecrits.numetudiant=e.numetudiant
       				group by sexe";
       		$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
       	}
       	else {
       		$nbAdmisEcrits = null;
       	}
       	
       	//nombre d'admis a l'oral
       	if($infos[0]['numEpreuvesOrales'] !== null) {
       		$sql= "select sexe, count(*) as nbAdmisOraux
					from etreadmisoraux, etudiant e
					where numepreuvesorales= ? and admisoraux='admis' and etreadmisoraux.numetudiant=e.numetudiant
       				group by sexe";
       		$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
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
       			'modalites' => $modalites,
       	);
       	
       	return $result;
       	}
       	
       	public function stats_tous_concours_par_sexe() {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       		 
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_par_sexe($uneEdition['numEditionConcours']));
       		}
       		 
       		return $result;
       	}
       	
       	public function stats_un_concours_par_boursier($numEditionConcours){
       		//les infos generales du concours
       		$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       		$infos = $this->db->query($sql, array($numEditionConcours))->result_array();
       	
       		//combien d'inscrits au concours?
       		$sql = "select boursier, count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?
       			group by boursier";
       		$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array();
       		 
       		//liste des modalites boursier
       		$modalites = array();
       		foreach($nbInscrits as $uneModalite) {
       			array_push($modalites, $uneModalite['boursier']);
       		}
       	
       		//nomdre d'admis au qcm
       		if($infos[0]['numQCM'] !== null) {
       			$sql= "select boursier, count(*) as nbAdmisQCM
					from etreadmisqcm, etudiant e
					where numqcm= ? and admisqcm='admis' and etreadmisqcm.numetudiant=e.numetudiant
       				group by boursier";
       			$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array();
       		}
       		else {
       			$nbAdmisQCM = null;
       		}
       	
       		//nombre d'admis a l'ecrit
       		if($infos[0]['numEpreuvesEcrites'] !== null) {
       			$sql= "select boursier, count(*) as nbAdmisEcrits
					from etreadmisecrits, etudiant e
					where numepreuvesecrites= ? and admisecrits='admis' and etreadmisecrits.numetudiant=e.numetudiant
       				group by boursier";
       			$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
       		}
       		else {
       			$nbAdmisEcrits = null;
       		}
       	
       		//nombre d'admis a l'oral
       		if($infos[0]['numEpreuvesOrales'] !== null) {
       			$sql= "select boursier, count(*) as nbAdmisOraux
					from etreadmisoraux, etudiant e
					where numepreuvesorales= ? and admisoraux='admis' and etreadmisoraux.numetudiant=e.numetudiant
       				group by boursier";
       			$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
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
       				'modalites' => $modalites,
       		);
       	
       		return $result;
       	}
       	
       	public function stats_tous_concours_par_boursier() {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       	
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_par_boursier($uneEdition['numEditionConcours']));
       		}
       	
       		return $result;
       	}
       	
       	public function stats_un_concours_par_origine($numEditionConcours){
       		//les infos generales du concours
       		$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       		$infos = $this->db->query($sql, array($numEditionConcours))->result_array();
       	
       		//combien d'inscrits au concours?
       		$sql = "select origine, count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?
       			group by origine";
       		$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array();
       		 
       		//liste des modalites origine
       		$modalites = array();
       		foreach($nbInscrits as $uneModalite) {
       			array_push($modalites, $uneModalite['origine']);
       		}
       	
       		//nomdre d'admis au qcm
       		if($infos[0]['numQCM'] !== null) {
       			$sql= "select origine, count(*) as nbAdmisQCM
					from etreadmisqcm, etudiant e
					where numqcm= ? and admisqcm='admis' and etreadmisqcm.numetudiant=e.numetudiant
       				group by origine";
       			$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array();
       		}
       		else {
       			$nbAdmisQCM = null;
       		}
       	
       		//nombre d'admis a l'ecrit
       		if($infos[0]['numEpreuvesEcrites'] !== null) {
       			$sql= "select origine, count(*) as nbAdmisEcrits
					from etreadmisecrits, etudiant e
					where numepreuvesecrites= ? and admisecrits='admis' and etreadmisecrits.numetudiant=e.numetudiant
       				group by origine";
       			$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
       		}
       		else {
       			$nbAdmisEcrits = null;
       		}
       	
       		//nombre d'admis a l'oral
       		if($infos[0]['numEpreuvesOrales'] !== null) {
       			$sql= "select origine, count(*) as nbAdmisOraux
					from etreadmisoraux, etudiant e
					where numepreuvesorales= ? and admisoraux='admis' and etreadmisoraux.numetudiant=e.numetudiant
       				group by origine";
       			$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
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
       				'modalites' => $modalites,
       		);
       	
       		return $result;
       	}
       	
       	public function stats_tous_concours_par_origine() {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       	
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_par_origine($uneEdition['numEditionConcours']));
       		}
       	
       		return $result;
       	}
       	
       	public function stats_un_concours_par_dernierdiplome($numEditionConcours){
       		//les infos generales du concours
       		$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       		$infos = $this->db->query($sql, array($numEditionConcours))->result_array();
       	
       		//combien d'inscrits au concours?
       		$sql = "select dernierdiplome, count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?
       			group by dernierdiplome";
       		$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array();
       		 
       		//liste des modalites dernierdiplome
       		$modalites = array();
       		foreach($nbInscrits as $uneModalite) {
       			array_push($modalites, $uneModalite['dernierdiplome']);
       		}
       	
       		//nomdre d'admis au qcm
       		if($infos[0]['numQCM'] !== null) {
       			$sql= "select dernierdiplome, count(*) as nbAdmisQCM
					from etreadmisqcm, etudiant e
					where numqcm= ? and admisqcm='admis' and etreadmisqcm.numetudiant=e.numetudiant
       				group by dernierdiplome";
       			$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array();
       		}
       		else {
       			$nbAdmisQCM = null;
       		}
       	
       		//nombre d'admis a l'ecrit
       		if($infos[0]['numEpreuvesEcrites'] !== null) {
       			$sql= "select dernierdiplome, count(*) as nbAdmisEcrits
					from etreadmisecrits, etudiant e
					where numepreuvesecrites= ? and admisecrits='admis' and etreadmisecrits.numetudiant=e.numetudiant
       				group by dernierdiplome";
       			$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
       		}
       		else {
       			$nbAdmisEcrits = null;
       		}
       	
       		//nombre d'admis a l'oral
       		if($infos[0]['numEpreuvesOrales'] !== null) {
       			$sql= "select dernierdiplome, count(*) as nbAdmisOraux
					from etreadmisoraux, etudiant e
					where numepreuvesorales= ? and admisoraux='admis' and etreadmisoraux.numetudiant=e.numetudiant
       				group by dernierdiplome";
       			$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
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
       				'modalites' => $modalites,
       		);
       	
       		return $result;
       	}
       	
       	public function stats_tous_concours_par_dernierdiplome() {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       	
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_par_dernierdiplome($uneEdition['numEditionConcours']));
       		}
       	
       		return $result;
       	}
       	
       	public function stats_un_concours_par_diplomenationalcourant($numEditionConcours){
       		//les infos generales du concours
       		$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       		$infos = $this->db->query($sql, array($numEditionConcours))->result_array();
       	
       		//combien d'inscrits au concours?
       		$sql = "select diplomenationalcourant, count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?
       			group by diplomenationalcourant";
       		$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array();
       		 
       		//liste des modalites diplomenationalcourant
       		$modalites = array();
       		foreach($nbInscrits as $uneModalite) {
       			array_push($modalites, $uneModalite['diplomenationalcourant']);
       		}
       	
       		//nomdre d'admis au qcm
       		if($infos[0]['numQCM'] !== null) {
       			$sql= "select diplomenationalcourant, count(*) as nbAdmisQCM
					from etreadmisqcm, etudiant e
					where numqcm= ? and admisqcm='admis' and etreadmisqcm.numetudiant=e.numetudiant
       				group by diplomenationalcourant";
       			$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array();
       		}
       		else {
       			$nbAdmisQCM = null;
       		}
       	
       		//nombre d'admis a l'ecrit
       		if($infos[0]['numEpreuvesEcrites'] !== null) {
       			$sql= "select diplomenationalcourant, count(*) as nbAdmisEcrits
					from etreadmisecrits, etudiant e
					where numepreuvesecrites= ? and admisecrits='admis' and etreadmisecrits.numetudiant=e.numetudiant
       				group by diplomenationalcourant";
       			$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
       		}
       		else {
       			$nbAdmisEcrits = null;
       		}
       	
       		//nombre d'admis a l'oral
       		if($infos[0]['numEpreuvesOrales'] !== null) {
       			$sql= "select diplomenationalcourant, count(*) as nbAdmisOraux
					from etreadmisoraux, etudiant e
					where numepreuvesorales= ? and admisoraux='admis' and etreadmisoraux.numetudiant=e.numetudiant
       				group by diplomenationalcourant";
       			$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
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
       				'modalites' => $modalites,
       		);
       	
       		return $result;
       	}
       	
       	public function stats_tous_concours_par_diplomenationalcourant() {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       	
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_par_diplomenationalcourant($uneEdition['numEditionConcours']));
       		}
       	
       		return $result;
       	}
       	
       	public function stats_un_concours_par_age($numEditionConcours){
       		//les infos generales du concours
       		$sql = "select *, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
				from editionconcours ec
				left join concours c on c.numconcours=ec.numconcours
				left join categorie cat on cat.numcategorie=c.numcategorie
				left join theme on theme.numtheme=c.numtheme
				where numeditionconcours=?";
       	
       		$infos = $this->db->query($sql, array($numEditionConcours))->result_array();
       	
       		//combien d'inscrits au concours?
       		$sql = "select YEAR(datedenaissance), count(*) as nbInscrits
				from participer p, etudiant e
				where p.numetudiant=e.numetudiant and numeditionconcours=?
       			group by YEAR(datedenaissance)";
       		$nbInscrits= $this->db->query($sql, array($numEditionConcours))->result_array();
       		 
       		//liste des modalites YEAR(datedenaissance)
       		$modalites = array();
       		foreach($nbInscrits as $uneModalite) {
       			array_push($modalites, $uneModalite['YEAR(datedenaissance)']);
       		}
       	
       		//nomdre d'admis au qcm
       		if($infos[0]['numQCM'] !== null) {
       			$sql= "select YEAR(datedenaissance), count(*) as nbAdmisQCM
					from etreadmisqcm, etudiant e
					where numqcm= ? and admisqcm='admis' and etreadmisqcm.numetudiant=e.numetudiant
       				group by YEAR(datedenaissance)";
       			$nbAdmisQCM = $this->db->query($sql, array($infos[0]['numQCM']))->result_array();
       		}
       		else {
       			$nbAdmisQCM = null;
       		}
       	
       		//nombre d'admis a l'ecrit
       		if($infos[0]['numEpreuvesEcrites'] !== null) {
       			$sql= "select YEAR(datedenaissance), count(*) as nbAdmisEcrits
					from etreadmisecrits, etudiant e
					where numepreuvesecrites= ? and admisecrits='admis' and etreadmisecrits.numetudiant=e.numetudiant
       				group by YEAR(datedenaissance)";
       			$nbAdmisEcrits = $this->db->query($sql, array($infos[0]['numEpreuvesEcrites']))->result_array();
       		}
       		else {
       			$nbAdmisEcrits = null;
       		}
       	
       		//nombre d'admis a l'oral
       		if($infos[0]['numEpreuvesOrales'] !== null) {
       			$sql= "select YEAR(datedenaissance), count(*) as nbAdmisOraux
					from etreadmisoraux, etudiant e
					where numepreuvesorales= ? and admisoraux='admis' and etreadmisoraux.numetudiant=e.numetudiant
       				group by YEAR(datedenaissance)";
       			$nbAdmisOraux = $this->db->query($sql, array($infos[0]['numEpreuvesOrales']))->result_array();
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
       				'modalites' => $modalites,
       		);
       	
       		return $result;
       	}
       	
       	public function stats_tous_concours_par_age() {
       		$sql = "select numEditionConcours, IF(MONTH(ec.dateResultatsEditionConcours)<9, YEAR(ec.dateResultatsEditionConcours) - 1, YEAR(ec.dateResultatsEditionConcours)) AS debutAnneeScolaire
					from editionconcours ec
					having debutAnneeScolaire=?";
       		$listEditions = $this->db->query($sql, array($this->input->post('debutAnneeScolaire')))->result_array();
       	
       		$result= array();
       		foreach($listEditions as $uneEdition) {
       			array_push($result, $this->stats_un_concours_par_age($uneEdition['numEditionConcours']));
       		}
       	
       		return $result;
       	}
       	

}