<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_news($slug = FALSE)
        {
        	if ($slug === FALSE)
        	{
        		$query = $this->db->get('etudiant');
        		return $query->result_array();
        	}
        
        	$query = $this->db->get_where('etudiant', array('Nom' => "1"));
        	return $query->row_array();
        }
        
        public function ExistCategorie()
        {
        	$sql = "SELECT LibelleCategorie FROM categorie WHERE LibelleCategorie = ?";
        	$query = $this->db->query($sql, array($this->input->post('LibelleCategorie')));
        
        	return(!empty($query->result()));
        }
        public function CreateCategorie()
        {
        	$sql ="INSERT INTO categorie('LibelleCategorie') VALUES ('?')";
        	echo $this->input->post('LibelleCategorie');
        	$query = $this->db->query($sql ,array($this->input->post('LibelleCategorie')));
        }
}