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