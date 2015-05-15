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
        			WHERE c.NumConcours NOT IN 
        									(SELECT p.NumEditionConcours FROM participer p WHERE p.NumEtudiant= '1')
					ORDER BY debutAnneeScolaire, LibelleTheme, ec.dateResultatsEditionConcours, LibelleCategorie";
        	$query = $this->db->query($sql, array($this->session->userdata('numEtudiant')));
        	
        	return($query->result_array());
        }
        
        public function inscriptionEditionConcours() {
        	$data = array(
        			'NumEtudiant' => $this->session->userdata('numEtudiant'),
        			'numEditionConcours' => $this->input->post('NumEditionConcours'),
        	);
        	
        	$this->db->insert('participer', $data);
        }
}