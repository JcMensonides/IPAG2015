<?php
class Login_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function ExistNumEtudiant()
	{
		$sql = "SELECT NumEtudiant FROM etudiant WHERE NumEtudiant = ?";
		$query = $this->db->query($sql, array($this->input->post('numeroEtudiant')));
		
        return(!empty($query->result()));
	}
}