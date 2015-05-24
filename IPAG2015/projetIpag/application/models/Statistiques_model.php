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
       		$nbAdmisQCM = $nbInscrits= $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array()[0]['nbAdmisQCM'];
       	}
       	else {
       		$nbAdmisQCM = null;
       	}
       	
       	//nombre d'admis a l'ecrit
       	if($infos[0]['numEpreuvesEcrites'] !== null) {
       		$sql= "select count(*) as nbAdmisEcrits
					from etreadmisecrits
					where numepreuvesecrites= ? and admisecrits='admis'";
       		$nbAdmisEcrits = $nbInscrits= $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array()[0]['nbAdmisEcrits'];
       	}
       	else {
       		$nbAdmisEcrits = null;
       	}
       	
       	//nombre d'admis a l'oral
       	if($infos[0]['numEpreuvesOrales'] !== null) {
       		$sql= "select count(*) as nbAdmisOraux
					from etreadmisoraux
					where numepreuvesorales= ? and admisoraux='admis'";
       		$nbAdmisOraux = $nbInscrits= $this->db->query($sql, array($this->input->post('NumEditionConcours')))->result_array()[0]['nbAdmisOraux'];
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
       
       
}