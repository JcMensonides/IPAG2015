<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves ecrites</li>

				<li class="plan-action">
					<div id="addEpreuveEcrite" style="display: block">
						<div>
							<label> Pas d'epreuve ecrite</label> <label
								class="Ajout-round-button"
								onclick="toggle_visibility('addEpreuveEcrite');"> + </label>
						</div>
					</div>
					<div id="addEpreuveEcriteDelete" style="display: none">
						<div class="Delete-round-button"
							onclick="toggle_visibility('addEpreuveEcrite'); delete_all_matieres_ecrites();">X</div>
						<br /> <label> Du</label> <input type="date"
							class="addEpreuveEcriteDeleteClass" name="DateEpreuveEcrite" /> <br />
						<label> au (*)</label> <input type="date"
							class="addEpreuveEcriteDeleteClass"
							name="DateResultatEpreuveEcrite" /> <br /> <br /> <label> Date de
							resultat des epreuves ecrites</label> <input type="date"
							class="addEpreuveEcriteDeleteClass"
							name="DateResultatEpreuveEcrite" /> <br /> <br />
							
							
							
							<div id="addMatiereEcrite" style="display: block">
							<div>
								<label> Matieres Ecrites</label> <label
									class="Ajout-round-button" id = "addMatiereButton"
									onclick="add_matiere_ecrite('nouvelleMatiereEcrite')"> + </label>
							</div>
						</div>
						<div id="nouvelleMatiereEcrite"></div>
						<div id="addMatiereEcriteDelete">
						<div class="Delete-round-button" id= "deleteMatiereButton" style= "display:none"
							onclick="delete_matiere_ecrite();">X</div>
						</div>
						
					</div>
			
			</ul>
		</div>
		
		<script>
		nbMatiereEcrite= 0;
	function add_matiere_ecrite(id) {
		nbMatiereEcrite++;
		var deleteMatiereButton = document.getElementById("deleteMatiereButton");
		deleteMatiereButton.style.display='block';
		
		var element = document.getElementById(id);
		var matiereLabel = document.createElement("label");
		matiereLabel.setAttribute("id", "labelEcrite" + nbMatiereEcrite);
		matiereLabel.innerHTML = "Matiere " + nbMatiereEcrite + " :";
		
		var matiereInput = document.createElement("input");
		matiereInput.setAttribute("id", "matiereEcrite" + nbMatiereEcrite);
		matiereInput.setAttribute("placeholder", "Nom de la matiere " + nbMatiereEcrite);
		

		element.appendChild(matiereLabel);
		element.appendChild(matiereInput);
	}

	function delete_matiere_ecrite() {
		if(nbMatiereEcrite >0) {
			var parent = document.getElementById("nouvelleMatiereEcrite");
			var inputADelete = document.getElementById("matiereEcrite" + nbMatiereEcrite);
			var labelADelete = document.getElementById("labelEcrite" + nbMatiereEcrite);
			parent.removeChild(inputADelete);
			parent.removeChild(labelADelete);
			nbMatiereEcrite --;
		}
		if(nbMatiereEcrite == 0) {
			var deleteMatiereButton = document.getElementById("deleteMatiereButton");
			deleteMatiereButton.style.display='none';
		}
	}

	function delete_all_matieres_ecrites() {
		while(nbMatiereEcrite>0) {
			var parent = document.getElementById("nouvelleMatiereEcrite");
			var inputADelete = document.getElementById("matiereEcrite" + nbMatiereEcrite);
			var labelADelete = document.getElementById("labelEcrite" + nbMatiereEcrite);
			parent.removeChild(inputADelete);
			parent.removeChild(labelADelete);
			nbMatiereEcrite --;
		}
		var deleteMatiereButton = document.getElementById("deleteMatiereButton");
		deleteMatiereButton.style.display='none';
	}
	
		
</script>