<?php
class Concours_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function ajoutConcours(){
        	
        	
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
        			'LibelleConcours' => $this->input->post('nomConcours'),
        			'NumTheme' => $numTheme,
        			'NumCategorie' => $numCategorie,
        	);
        			
        	
        	$this->db->insert('concours', $data);
        }
        
        public function nomConcoursDisponible()
        {
        	$sql = "SELECT LibelleConcours FROM concours WHERE LibelleConcours = ?";
        	$query = $this->db->query($sql, array($this->input->post('nomConcours')));
        
        	return(empty($query->result()));
        }
        
        public function getConcoursList() {
        	$sql = "SELECT NumConcours, LibelleConcours, LibelleTheme, LibelleCategorie FROM concours LEFT JOIN Theme ON concours.NumTheme=Theme.NumTheme LEFT JOIN categorie ON concours.NumCategorie=Categorie.NumCategorie ORDER BY LibelleTheme, LibelleCategorie";
        	$query = $this->db->query($sql);
        	
        	return($query->result_array());
        }
        
        public function supprimerConcours() {
        	$sql = "DELETE FROM  concours WHERE NumConcours = ?";
        	$query = $this->db->query($sql, array($this->input->post('NumConcours')));
        }
        
        public function updateConcours() {
        	$sql = "UPDATE concours SET LibelleConcours = ? WHERE NumConcours = ?";
        	$query = $this->db->query($sql, array($this->input->post('nomConcours'),$this->input->post('NumConcours')));
        }
}