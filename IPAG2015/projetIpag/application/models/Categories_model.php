<?php
class Categories_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function ajoutCategorie(){
        	$sql = "INSERT INTO categorie (LibelleCategorie) VALUES (?)";
        	$query = $this->db->query($sql, array($this->input->post('nomCategorie')));
        }
        
        public function nomCategorieDisponible()
        {
        	$sql = "SELECT LibelleCategorie FROM categorie WHERE LibelleCategorie = ?";
        	$query = $this->db->query($sql, array($this->input->post('nomCategorie')));
        
        	return(empty($query->result()));
        }
        
        public function getCategoriesList() {
        	$sql = "SELECT NumCategorie, LibelleCategorie FROM categorie";
        	$query = $this->db->query($sql);
        	
        	return($query->result_array());
        }
        
        public function supprimerCategorie() {
        	$sql = "DELETE FROM  categorie WHERE NumCategorie = ?";
        	$query = $this->db->query($sql, array($this->input->post('NumCategorie')));
        }
}