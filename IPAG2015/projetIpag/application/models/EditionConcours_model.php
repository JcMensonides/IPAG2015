<?php
class EditionConcours_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function ajoutEditionConcours(){
        	
        	
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
        			
        	
        	$this->db->insert('concours', $data);
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
        	$sql = "SELECT NumEditionConcours, LibelleEditionConcours, LibelleTheme, LibelleCategorie FROM concours LEFT JOIN Theme ON concours.NumTheme=Theme.NumTheme LEFT JOIN categorie ON concours.NumCategorie=Categorie.NumCategorie ORDER BY LibelleTheme, LibelleCategorie";
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