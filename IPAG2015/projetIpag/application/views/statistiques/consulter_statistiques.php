<?php
$previous_AS = false;
$previous_LibTheme = false;
$premiere_AS = true;
$i = 1;

foreach ( $listEditionConcours as $uneEdition ) {
	
	if ($previous_AS !== $uneEdition ['debutAnneeScolaire']) {
		if (! $premiere_AS) {
			?>
</div>
</div>
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "critere".$i; ?>');">Pour l'ensemble des concours</h1>
	<div id="<?php echo "critere".$i; ?>" style="display: none">
	
	
		<?php echo form_open('Statistiques/stats_tous_concours')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="Sans criteres" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_sexe')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction du sexe" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_boursier')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En de la situation boursiere" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_origine')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction de la provenance" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_age')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction de l'age" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_dernierdiplome')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction du dernier diplome obtenu" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_diplomenationalcourant')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction du diplome national courant" />
		</form>
		
	</div>
	
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "cat".$i; ?>');"> Pour une categorie de concours</h1>
	<div id="<?php echo "cat".$i; ?>" style="display: none">
		<?php foreach($categorie_de_l_annee as $uneCategorie) {?>
		<?php echo form_open('Statistiques/stats_une_categorie')?>
			<input type="hidden" name= categorie value="<?php if($uneCategorie != "Sans Categorie"){echo $uneCategorie;}else{echo "";}?>" />
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="<?php echo $uneCategorie;?>" />
		</form>
		<?php }?>
	</div>
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "th".$i; ?>');"> Pour un theme de concours</h1>
	<div id="<?php echo "th".$i; ?>" style="display: none">
		<?php foreach($theme_de_l_annee as $unth) {?>
			<?php echo form_open('Statistiques/stats_un_theme')?>
			<input type="hidden" name= theme value="<?php if($unth != "Sans Theme"){echo $unth;}else{echo "";}?>" />
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="<?php echo $unth;?>" />
		</form>
		<?php }?>
	</div>
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "coupleThemeCat".$i; ?>');"> Pour un couple theme categorie</h1>
	<div id="<?php echo "coupleThemeCat".$i; ?>" style="display: none">
		<?php foreach($categorie_de_l_annee as $uneCategorie) {
			foreach($theme_de_l_annee as $unth) {?>
			<?php echo form_open('Statistiques/stats_couple_theme_cat')?>
			<input type="hidden" name= categorie value="<?php if($uneCategorie != "Sans Categorie"){echo $uneCategorie;}else{echo "";}?>" />
			<input type="hidden" name= theme value="<?php if($unth != "Sans Theme"){echo $unth;}else{echo "";}?>" />
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="<?php echo "Cat: ".$uneCategorie."  /  Theme: ".$unth;?>" />
		</form>
			<?php }
			
		}?>
	</div>
</div>
</div>


<?php
		}
		$premiere_AS = false;
		$previous_LibTheme = false;
		$premier_theme = true;
		$categorie_de_l_annee= array();
		$theme_de_l_annee= array();
		?>


<div class="container">
	<h1 class="themeButton" style="background-color: #841C1C"
		onclick="toggle_visibility('<?php echo "AS".$i; ?>');"><?php echo "Annee scolaire ".$uneEdition['debutAnneeScolaire']." - ".($uneEdition['debutAnneeScolaire']+1);?></h1>
		<div id="<?php echo "AS".$i; ?>" style="display: none">
		
		<h1 class="themeButton" style="width: 90%;margin-left: auto"
		onclick="toggle_visibility('<?php echo "Stat".$i; ?>');">Pour un concours</h1>
		<div id="<?php echo "Stat".$i; ?>" style="display: none">
		
		
		<?php
	
}
	//On repertorie les categories presentes pour l'annee scolaire
	if($uneEdition['LibelleCategorie'] == null) {
		$categorieTMP= "Sans Categorie";
	}
	else {
		$categorieTMP = $uneEdition['LibelleCategorie'];
	}
	if(!in_array($categorieTMP, $categorie_de_l_annee)){
		array_push($categorie_de_l_annee, $categorieTMP);
	}

	//On repertorie les themes presents pour l'annee scolaire
	if($uneEdition['LibelleTheme'] == null) {
		$themeTMP= "Sans Theme";
	}
	else {
		$themeTMP = $uneEdition['LibelleTheme'];
	}
	if(!in_array($themeTMP, $theme_de_l_annee)){
		array_push($theme_de_l_annee, $themeTMP);
	}
	

	//on check si l'annee scolaire est la meme que la precedente
	$previous_AS = $uneEdition ['debutAnneeScolaire'];
	
	if ($previous_LibTheme !== $uneEdition['LibelleTheme']) {
		 
		if(! $premier_theme){
			echo "</div>";
		}
		$premier_theme=false;?>
				
<h1 class="themeButton" style="width: 80%;margin-left: auto; background-color: #4D6687"
	onclick="toggle_visibility('<?php echo $i; ?>');"><?php
		
if ($uneEdition ['LibelleTheme'] == null) {
			echo "Sans theme";
		} else {
			echo $uneEdition ['LibelleTheme'];
		}
		?></h1>
<div class="row flat" style="display: none; width: 80%;margin-left: auto" id="<?php echo $i; ?>">
				
				<?php
		
$previous_LibTheme = $uneEdition ['LibelleTheme'];
	}
	?>
		
		<div class="col-lg-3 col-md-3 col-xs-6">
		<ul class="plan plan1">
			<li class="plan-name">
                        <?php echo $uneEdition['LibelleConcours']?>
                    </li>
            <li>
				<strong>Date de resultats</strong><br/>
				<?php echo $uneEdition['dateResultatsEditionConcours'];?>
			</li>
			<li>
				<strong>Inscriptions</strong><br/>
				Du : <?php if($uneEdition['dateDebutInscriptionEditionConcours']){
					echo $uneEdition['dateDebutInscriptionEditionConcours'];
				}
				else {
					echo "non renseigne";
				}?> <br/>
				au : <?php if($uneEdition['dateFinInscriptionEditionConcours']){
					echo $uneEdition['dateFinInscriptionEditionConcours'];
				}
				else {
					echo "non renseigne";
				}?>
			</li>
			<li class="plan-action">
                    	<?php echo form_open('Statistiques/stats_un_concours')?>
                    		<input type="hidden" name=NumEditionConcours
				value="<?php echo $uneEdition['NumEditionConcours'];?>" /> <input
				class="btn btn-danger btn-lg" type="submit" name="stats_un_concours"
				value="Statistiques" />
				</form>
			</li>

		</ul>
	</div>

		

	<?php $i++;
	$last_As = $uneEdition['debutAnneeScolaire'];} ?>
	
</div>
</div>
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "critere".$i; ?>');">Pour l'ensemble des concours</h1>
	<div id="<?php echo "critere".$i; ?>" style="display: none">
	
	
		<?php echo form_open('Statistiques/stats_tous_concours')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="Sans criteres" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_sexe')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction du sexe" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_boursier')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En de la situation boursiere" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_origine')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction de la provenance" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_age')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction de l'age" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_dernierdiplome')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction du dernier diplome obtenu" />
		</form>
		
		<?php echo form_open('Statistiques/stats_tous_concours_par_diplomenationalcourant')?>
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="En fonction du diplome national courant" />
		</form>
		
	</div>
	
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "cat".$i; ?>');"> Pour une categorie de concours</h1>
	<div id="<?php echo "cat".$i; ?>" style="display: none">
		<?php foreach($categorie_de_l_annee as $uneCategorie) {?>
		<?php echo form_open('Statistiques/stats_une_categorie')?>
			<input type="hidden" name= categorie value="<?php if($uneCategorie != "Sans Categorie"){echo $uneCategorie;}else{echo "";}?>" />
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="<?php echo $uneCategorie;?>" />
		</form>
		<?php }?>
	</div>
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "th".$i; ?>');"> Pour un theme de concours</h1>
	<div id="<?php echo "th".$i; ?>" style="display: none">
		<?php foreach($theme_de_l_annee as $unth) {?>
			<?php echo form_open('Statistiques/stats_un_theme')?>
			<input type="hidden" name= theme value="<?php if($unth != "Sans Theme"){echo $unth;}else{echo "";}?>" />
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="<?php echo $unth;?>" />
		</form>
		<?php }?>
	</div>
	<h1 class="themeButton" style="width: 90%;margin-left: auto" onclick="toggle_visibility('<?php echo "coupleThemeCat".$i; ?>');"> Pour un couple theme categorie</h1>
	<div id="<?php echo "coupleThemeCat".$i; ?>" style="display: none">
		<?php foreach($categorie_de_l_annee as $uneCategorie) {
			foreach($theme_de_l_annee as $unth) {?>
			<?php echo form_open('Statistiques/stats_couple_theme_cat')?>
			<input type="hidden" name= categorie value="<?php if($uneCategorie != "Sans Categorie"){echo $uneCategorie;}else{echo "";}?>" />
			<input type="hidden" name= theme value="<?php if($unth != "Sans Theme"){echo $unth;}else{echo "";}?>" />
			<input type="hidden" name= debutAnneeScolaire value="<?php echo $last_As;?>" />
          <input class="themeButton" style="width: 80%;margin-left: 20%; background-color: #4D6687" type="submit" name="stats_un_concours" value="<?php echo "Cat: ".$uneCategorie."  /  Theme: ".$unth;?>" />
		</form>
			<?php }
			
		}?>
	</div>
</div>
</div>
	
	
	<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>