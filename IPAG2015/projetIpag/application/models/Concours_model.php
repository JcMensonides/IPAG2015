<?php
class Concours_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function ajoutConcours(){
        	$sql = "INSERT INTO concours (LibelleConcours) VALUES (?)";
        	$query = $this->db->query($sql, array($this->input->post('nomConcours')));
        }
        
        public function nomConcoursDisponible()
        {
        	$sql = "SELECT LibelleConcours FROM concours WHERE LibelleConcours = ?";
        	$query = $this->db->query($sql, array($this->input->post('nomConcours')));
        
        	return(empty($query->result()));
        }
        
        public function getConcoursList() {
        	$sql = "SELECT NumConcours, LibelleConcours FROM concours";
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