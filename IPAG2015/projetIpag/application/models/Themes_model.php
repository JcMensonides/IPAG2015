<?php
class Themes_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function ajoutTheme(){
        	$sql = "INSERT INTO theme (LibelleTheme) VALUES (?)";
        	$query = $this->db->query($sql, array($this->input->post('nomTheme')));
        }
        
        public function nomThemeDisponible()
        {
        	$sql = "SELECT LibelleTheme FROM theme WHERE LibelleTheme = ?";
        	$query = $this->db->query($sql, array($this->input->post('nomTheme')));
        
        	return(empty($query->result()));
        }
        
        public function getThemesList() {
        	$sql = "SELECT NumTheme, LibelleTheme FROM theme";
        	$query = $this->db->query($sql);
        	
        	return($query->result_array());
        }
        
        public function supprimerTheme() {
        	$sql = "DELETE FROM  theme WHERE NumTheme = ?";
        	$query = $this->db->query($sql, array($this->input->post('NumTheme')));
        }
        
        public function updateTheme() {
        	$sql = "UPDATE theme SET LibelleTheme = ? WHERE NumTheme = ?";
        	$query = $this->db->query($sql, array($this->input->post('nomTheme'),$this->input->post('NumTheme')));
        }
}