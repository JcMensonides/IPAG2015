
<div class="container">

	<h1 class="page-header">Ajouter une edition de concours</h1>
	<div class="row flat">

		<div style="width: 100%" class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Nouvelle edition</li>

				<li class="plan-action">
                    <?php echo validation_errors(); ?>

					<?php echo form_open('EditionConcours/ajoutEditionConcours')?>
						
				
				
				
				
				
				
				
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
				</label> <input type="date" placeholder="JJ/MM/AAAA"
					name="dateDebutInscriptionEditionConcours"> <label> au (*)</label>
					<input type="date" placeholder="JJ/MM/AAAA"
					name="dateFinInscriptionEditionConcours"></li>

				<li><strong> Date de resultats du concours(*) </strong> <br /> <input
					type="date" placeholder="JJ/MM/AAAA"
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
							class="addQCMDeleteClass" name="DateQCM" /> <br /> <br /> <label>
							Date de resultat du QCM</label> <br /> <input type="date"
							class="addQCMDeleteClass" name="DateResultatQCM" />
					</div>
				</li>
			</ul>
		</div>


		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Nouvelle edition</li>

				<li class="plan-action">
                    <?php echo validation_errors(); ?>

					<?php echo form_open('EditionConcours/ajoutEditionConcours')?>
						
				
				
				
				
				
				
				
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
				</label> <input type="date" placeholder="JJ/MM/AAAA"
					name="dateDebutInscriptionEditionConcours"> <label> au (*)</label>
					<input type="date" placeholder="JJ/MM/AAAA"
					name="dateFinInscriptionEditionConcours"></li>

				<li><strong> Date de resultats du concours(*) </strong> <br /> <input
					type="date" placeholder="JJ/MM/AAAA"
					name="dateResultatsEditionConcours"></li>
				<li><strong>QCM</strong> <br />
					<div id="addQCM" style="display: block">
						<div>
							<label class="Ajout-round-button"
								onclick="toggle_visibility('addQCM');"> + </label>
						</div>
					</div>
					<div id="addQCMDelete" style="display: none">
						<div class="Delete-round-button"
							onclick="toggle_visibility('addQCM');">X</div>
						<br /> <label> Date du QCM</label> <input type="date"
							class="cachable" name="DateQCM" /> <label> Date Resultat du QCM</label>
						<input type="date" class="cachable" name="DateResultatQCM" />
					</div>
					<div></div></li>
				<li><input class="btn btn-danger btn-lg" type="submit"
					name="ajout_EditionConcours" value="Ajouter" />
					</form></li>


			</ul>
		</div>

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
							onclick="toggle_visibility('addEpreuveOrale');">X</div>
						<br /> <label> Du</label> <input type="date"
							class="addEpreuveOraleDeleteClass" name="DateEpreuveOrale" /> <br />
						<label> au (*)</label> <input type="date"
							class="addEpreuveOraleDeleteClass"
							name="DateResultatEpreuveOrale" /> <br /> <br /> <label> Date de
							resultat des epreuves orales</label> <input type="date"
							class="addEpreuveOraleDeleteClass"
							name="DateResultatEpreuveOrale" /> <br /> <br />
							
							
							
							<div id="addMatiereOrale" style="display: block">
							<div>
								<label> Pas d'epreuve orale</label> <label
									class="Ajout-round-button"
									onclick="toggle_visibility('addMatiereOrale');"> + </label>
							</div>
						</div>
						<div id="addMatiereOraleDelete" style="display: none">
							<div class="Delete-round-button"
								onclick="toggle_visibility('addMatiereOrale');">X</div>
							<br /> <label> Du</label> <input type="date"
								class="addMatiereOraleDeleteClass" name="DateMatiereOrale" /> <br />
							<label> au (*)</label> <input type="date"
								class="addMatiereOraleDeleteClass"
								name="DateResultatMatiereOrale" /> <br /> <br /> <label> Date de
								resultat des epreuves orales</label> <input type="date"
								class="addEMatiereOraleDeleteClass"
								name="DateResultatMatiereOrale" /> <br /> <br />
						</div>
					
					</div>
			
			</ul>
		</div>



		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Nouvelle edition</li>

				<li class="plan-action">
                    <?php echo validation_errors(); ?>

					<?php echo form_open('EditionConcours/ajoutEditionConcours')?>
						
				
				
				
				
				
				
				
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
											?> </optgroup>
							 			<option value="<?php echo $unConcours['NumConcours'];?>"><?php echo $unConcours['LibelleConcours'];?></option>
							 		<?php }?>
							
				
				
				
				
				
				
				
				</select></li>
				<li><strong> Dates d'inscriptions </strong> <br /> <br /> <label>Du
				</label> <input type="date" placeholder="JJ/MM/AAAA"
					name="dateDebutInscriptionEditionConcours"> <label> au (*)</label>
					<input type="date" placeholder="JJ/MM/AAAA"
					name="dateFinInscriptionEditionConcours"></li>

				<li><strong> Date de resultats du concours(*) </strong> <br /> <input
					type="date" placeholder="JJ/MM/AAAA"
					name="dateResultatsEditionConcours"></li>
				<li><strong>QCM</strong> <br />
					<div id="addQCM" style="display: block">
						<div>
							<label class="Ajout-round-button"
								onclick="toggle_visibility('addQCM');"> + </label>
						</div>
					</div>
					<div id="addQCMDelete" style="display: none">
						<div class="Delete-round-button"
							onclick="toggle_visibility('addQCM');">X</div>
						<br /> <label> Date du QCM</label> <input type="date"
							class="cachable" name="DateQCM" /> <label> Date Resultat du QCM</label>
						<input type="date" class="cachable" name="DateResultatQCM" />
					</div>
					<div></div></li>
				<li><input class="btn btn-danger btn-lg" type="submit"
					name="ajout_EditionConcours" value="Ajouter" />
					</form></li>


			</ul>
		</div>






		<input style="width: 100%" class="btn btn-danger btn-lg" type="submit"
			name="ajout_EditionConcours" value="Ajouter" />



	</div>
</div>

<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       var eDelete = document.getElementById(id + 'Delete');
       if(e.style.display == 'block'){
    	   e.style.display = 'none';
    	   eDelete.style.display = 'block';
       }
       		
       else {
    	   eDelete.style.display = 'none';
    	   var aReset =document.getElementsByClassName(id + 'DeleteClass');
    	   for(var i = 0; i<aReset.length; i++) {
        	   aReset[i].value = "";
    	   }
    	   e.style.marginLeft = 'auto';
    	   e.style.marginRight = 'auto';
           e.style.display = 'block';
       }
    }
//-->
</script>



<div class="formulairePopUp" id="abc">
	<!-- Popup Div Starts Here -->
	<div id="popupContact">
		<!-- Contact Us Form -->
		<form action="#" id="form" method="post" name="form">
			<img id="close" src="images/3.png" onclick="div_hide()">
			<h2>Contact Us</h2>
			<hr>
			<input id="name" name="name" placeholder="Name" type="text"> <input
				id="email" name="email" placeholder="Email" type="text">
			<textarea id="msg" name="message" placeholder="Message"></textarea>
			<a href="javascript:%20check_empty()" id="submit">Send</a>
		</form>
	</div>
	<!-- Popup Div Ends Here -->
</div>
<!-- Display Popup Button -->
<h1>Click Button To Popup Form Using Javascript</h1>
<button class="formulairePopUp" id="popup" onclick="div_show()">Popup</button>

<script>
// Validating Empty Field
function check_empty() {
if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
alert("Fill All Fields !");
} else {
document.getElementById('form').submit();
alert("Form Submitted Successfully...");
}
}
//Function To Display Popup
function div_show() {
document.getElementById('abc').style.display = "block";
}
//Function to Hide Popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}
</script>