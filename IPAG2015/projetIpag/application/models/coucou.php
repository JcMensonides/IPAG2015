//creation de l'epreuve orale
				if($this->input->post('DateResultatEpreuveOrale') !== "null"){
					if($this->input->post('DateDebutEpreuveOrale')== "") {
						$DateDebutEpreuveOrale = null;
					}
					else{
						$DateDebutEpreuveOrale = $this->input->post('DateEpreuveOrale');
					}
					
					if($this->input->post('DateFinEpreuveOrale')== "") {
						$DateFinEpreuveOrale = null;
					}
					else{
						$DateFinEpreuveOrale = $this->input->post('DateFinEpreuveOrale');
					}
					
					
					$EpreuveOrale = array(
							'dateDebutEpreuvesOrales' => $DateDebutEpreuveOrale,
							'dateFinEpreuvesOrales' => $DateFinEpreuveOrale,
							'dateResultatEpreuvesOrales' => $this->input->post('DateResultatEpreuveOrale'),
							'numEditionConcours' => $numEdition,
					);
					$this->db->insert('epreuvesorales', $EpreuveOrale);
					$numEpreuveOrale = $this->db->insert_id();
				}
				else {
					$numEpreuveOrale = null;
				}