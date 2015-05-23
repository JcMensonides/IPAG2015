
<div class="container">

	<h1 class="page-header">Ajouter une edition de concours</h1>
	<div class="row flat">
	
	<?php echo validation_errors(); ?>

					<?php echo form_open('EditionConcours/ajoutEditionConcours')?>

		<div style="width: 100%" class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Nouvelle edition</li>

				<li class="plan-action">
                    
						
				
				
				
				
				
				
				
				<li><strong> Concours </strong> <br /> <select name=numConcours>
							 		<?php
										
										$previous_libTheme = false;
										foreach ( $listConcours as $unConcours ) {
											if ($unConcours ['LibelleTheme'] !== $previous_libTheme) {
												?>
								 			<optgroup label="<?php echo $unConcours['LibelleTheme'];?>">
								 			<?php
												
												$previous_libTheme = $unConcours ['LibelleTheme'];
											}
											?></optgroup>
						<option value="<?php echo $unConcours['NumConcours'];?>"><?php echo $unConcours['LibelleConcours'];?></option>
							 		<?php }?>
							
				
				</select></li>
				<li><strong> Dates d'inscriptions </strong> <br /> <br /> <label>Du
				</label> <input type="date" placeholder="AAAA-MM-JJ"
					name="dateDebutInscriptionEditionConcours"> <label> au (*)</label>
					<input type="date" placeholder="AAAA-MM-JJ"
					name="dateFinInscriptionEditionConcours"></li>

				<li><strong> Date de resultats du concours(*) </strong> <br /> <input
					type="date" placeholder="AAAA-MM-JJ"
					name="dateResultatsEditionConcours"></li>


			</ul>
		</div>


		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">QCM</li>

				<li class="plan-action">
					<div id="addQCM" style="display: block">
						<div>
							<label>Pas de QCM</label> <br /> <label
								class="Ajout-round-button"
								onclick="toggle_visibility('addQCM');"> + </label>
						</div>
					</div>
					<div id="addQCMDelete" style="display: none">
						<div class="Delete-round-button"
							onclick="toggle_visibility('addQCM');">X</div>
						<br /> <label> Date du QCM</label> <br /> <input type="date"
							class="addQCMDeleteClass" name="DateQCM" value ="null" placeholder="AAAA-MM-JJ"/> <br /> <br /> <label>
							Date de resultat du QCM (*)</label> <br /> <input type="date"
							class="addQCMDeleteClass" name="DateResultatQCM" value="null" placeholder="AAAA-MM-JJ" />
					</div>
				</li>
			</ul>
		</div>


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
							class="addEpreuveEcriteDeleteClass" name="DateDebutEpreuveEcrite" value="null" placeholder="AAAA-MM-JJ" /> <br />
						<label> au</label> <input type="date"
							class="addEpreuveEcriteDeleteClass"
							name="DateFinEpreuveEcrite" value="null" placeholder="AAAA-MM-JJ"/> <br /> <br /> <label> Date de
							resultat des epreuves ecrites (*)</label> <input type="date"
							class="addEpreuveEcriteDeleteClass"
							name="DateResultatEpreuveEcrite" value="null" placeholder="AAAA-MM-JJ"/> <br /> <br />
							
							
							
							<div id="addMatiereEcrite" style="display: block">
							<div>
								<label> Matieres Ecrites</label> <label
									class="Ajout-round-button" id = "addMatiereEcriteButton"
									onclick="add_matiere_ecrite('nouvelleMatiereEcrite')"> + </label>
							</div>
						</div>
						<div id="nouvelleMatiereEcrite"></div>
						<div id="addMatiereEcriteDelete">
						<div class="Delete-round-button" id= "deleteMatiereEcriteButton" style= "display:none"
							onclick="delete_matiere_ecrite();">X</div>
						</div>
						
					</div>
			
			</ul>
		</div>
		
		<script>
		nbMatiereEcrite= 0;
	function add_matiere_ecrite(id) {
		nbMatiereEcrite++;
		var deleteMatiereEcriteButton = document.getElementById("deleteMatiereEcriteButton");
		deleteMatiereEcriteButton.style.display='block';
		
		var element = document.getElementById(id);
		var matiereLabel = document.createElement("label");
		matiereLabel.setAttribute("id", "labelEcrite" + nbMatiereEcrite);
		matiereLabel.innerHTML = "Matiere " + nbMatiereEcrite + " :";
		
		var matiereInput = document.createElement("input");
		matiereInput.setAttribute("id", "matiereEcrite" + nbMatiereEcrite);
		matiereInput.setAttribute("placeholder", "Nom de la matiere " + nbMatiereEcrite);
		matiereInput.setAttribute("name", "matiereEcrite" + nbMatiereEcrite);
		

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
			var deleteMatiereEcriteButton = document.getElementById("deleteMatiereEcriteButton");
			deleteMatiereEcriteButton.style.display='none';
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
		var deleteMatiereEcriteButton = document.getElementById("deleteMatiereEcriteButton");
		deleteMatiereEcriteButton.style.display='none';
	}
	
		
</script>

		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves orales</li>

				<li class="plan-action">
					<div id="addEpreuveOrale" style="display: block">
						<div>
							<label> Pas d'epreuve orale</label> <label
								class="Ajout-round-button"
								onclick="toggle_visibility('addEpreuveOrale');"> + </label>
						</div>
					</div>
					<div id="addEpreuveOraleDelete" style="display: none">
						<div class="Delete-round-button"
							onclick="toggle_visibility('addEpreuveOrale'); delete_all_matieres_orales();">X</div>
						<br /> <label> Du</label> <input type="date"
							class="addEpreuveOraleDeleteClass" name="DateDebutEpreuveOrale" value="null"  placeholder="AAAA-MM-JJ"/> <br />
						<label> au</label> <input type="date"
							class="addEpreuveOraleDeleteClass"
							name="DateFinEpreuveOrale" value="null" placeholder="AAAA-MM-JJ"/> <br /> <br /> <label> Date de
							resultat des epreuves orales (*)</label> <input type="date"
							class="addEpreuveOraleDeleteClass"
							name="DateResultatEpreuveOrale" value="null" placeholder="AAAA-MM-JJ" /> <br /> <br />
							
							
							
							<div id="addMatiereOrale" style="display: block">
							<div>
								<label> Matieres Orales</label> <label
									class="Ajout-round-button" id = "addMatiereOraleButton"
									onclick="add_matiere_orale('nouvelleMatiereOrale')"> + </label>
							</div>
						</div>
						<div id="nouvelleMatiereOrale"></div>
						<div id="addMatiereOraleDelete">
						<div class="Delete-round-button" id= "deleteMatiereOraleButton" style= "display:none"
							onclick="delete_matiere_orale();">X</div>
						</div>
						
					</div>
			
			</ul>
		</div>
		
		<script>
		nbMatiereOrale= 0; 
	function add_matiere_orale(id) {
		nbMatiereOrale++; 
		var deleteMatiereOraleButton = document.getElementById("deleteMatiereOraleButton");
		deleteMatiereOraleButton.style.display='block';
		
		var element = document.getElementById(id);
		var matiereLabel = document.createElement("label");
		matiereLabel.setAttribute("id", "labelOrale" + nbMatiereOrale);
		matiereLabel.innerHTML = "Matiere " + nbMatiereOrale + " :";
		
		var matiereInput = document.createElement("input");
		matiereInput.setAttribute("id", "matiereOrale" + nbMatiereOrale);
		matiereInput.setAttribute("placeholder", "Nom de la matiere " + nbMatiereOrale);
		matiereInput.setAttribute("name", "matiereOrale" + nbMatiereOrale);
		

		element.appendChild(matiereLabel);
		element.appendChild(matiereInput);
	}

	function delete_matiere_orale() {
		if(nbMatiereOrale >0) {
			var parent = document.getElementById("nouvelleMatiereOrale");
			var inputADelete = document.getElementById("matiereOrale" + nbMatiereOrale);
			var labelADelete = document.getElementById("labelOrale" + nbMatiereOrale);
			parent.removeChild(inputADelete);
			parent.removeChild(labelADelete);
			nbMatiereOrale --;
		}
		if(nbMatiereOrale == 0) {
			var deleteMatiereOraleButton = document.getElementById("deleteMatiereOraleButton");
			deleteMatiereOraleButton.style.display='none';
		}
	}

	function delete_all_matieres_orales() {
		while(nbMatiereOrale>0) {
			var parent = document.getElementById("nouvelleMatiereOrale");
			var inputADelete = document.getElementById("matiereOrale" + nbMatiereOrale);
			var labelADelete = document.getElementById("labelOrale" + nbMatiereOrale);
			parent.removeChild(inputADelete);
			parent.removeChild(labelADelete);
			nbMatiereOrale --;
		}
		var deleteMatiereOraleButton = document.getElementById("deleteMatiereOraleButton");
		deleteMatiereOraleButton.style.display='none';
	}
	
		
</script>



		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves Speciales</li>

				<li class="plan-action">
					<div id="addEpreuvePhysique" style="display: block">
						<div>
							<label>Pas de test physique</label> <br /> <label
								class="Ajout-round-button"
								onclick="toggle_visibility('addEpreuvePhysique');"> + </label>
						</div>
					</div>
					<div id="addEpreuvePhysiqueDelete" style="display: none">
						<div class="Delete-round-button"
							onclick="toggle_visibility('addEpreuvePhysique');">X</div>
						<br /> <label> Date du test physique</label> <br /> <input type="date"
							class="addEpreuvePhysiqueDeleteClass" name="DateEpreuvePhysique" value="null" placeholder="AAAA-MM-JJ" /> <br /> <br /> <label>
							Date de resultat du test physique (*)</label> <br /> <input type="date"
							class="addEpreuvePhysiqueDeleteClass" name="DateResultatEpreuvePhysique" value="null" placeholder="AAAA-MM-JJ" />
					</div>
				</li>
				
				<li>
					<div id="addEpreuvePsychoTechnique" style="display: block">
							<div>
								<label>Pas de test psychotechnique</label> <br /> <label
									class="Ajout-round-button"
									onclick="toggle_visibility('addEpreuvePsychoTechnique');"> + </label>
							</div>
						</div>
						<div id="addEpreuvePsychoTechniqueDelete" style="display: none">
							<div class="Delete-round-button"
								onclick="toggle_visibility('addEpreuvePsychoTechnique');">X</div>
							<br /> <label> Date du test psychotechnique</label> <br /> <input type="date"
								class="addEpreuvePsychoTechniqueDeleteClass" name="DateEpreuvePsychoTechnique" value="null" placeholder="AAAA-MM-JJ"/> <br /> <br /> <label>
								Date de resultat du test psychotechnique (*)</label> <br /> <input type="date"
								class="addEpreuvePsychoTechniqueDeleteClass" name="DateResultatEpreuvePsychoTechnique" value="null" placeholder="AAAA-MM-JJ" />
						</div>
					</li>
			</ul>
		</div>






		<input style="width: 100%" class="btn btn-danger btn-lg" type="submit"
			name="ajout_EditionConcours" value="Ajouter" />
			</form>



	</div>
</div>

<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       var eDelete = document.getElementById(id + 'Delete');
       if(e.style.display == 'block'){
    	   e.style.display = 'none';
    	   var aDisplay =document.getElementsByClassName(id + 'DeleteClass');
    	   for(var i = 0; i<aDisplay.length; i++) {
        	   aDisplay[i].value = "";
    	   }
    	   eDelete.style.display = 'block';
       }
       		
       else {
    	   eDelete.style.display = 'none';
    	   var aReset =document.getElementsByClassName(id + 'DeleteClass');
    	   for(var i = 0; i<aReset.length; i++) {
        	   aReset[i].value = "null";
    	   }
    	   e.style.marginLeft = 'auto';
    	   e.style.marginRight = 'auto';
           e.style.display = 'block';
       }
    }
//-->
</script>
