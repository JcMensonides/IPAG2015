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
</div>


<?php
		}
		$premiere_AS = false;
		$previous_LibTheme = false;
		$premier_theme = true;
		?>


<div class="container">
	<h1 class="themeButton" style="background-color: #841C1C"
		onclick="toggle_visibility('<?php echo "AS".$i; ?>');"><?php echo "Annee scolaire ".$uneEdition['debutAnneeScolaire']." - ".($uneEdition['debutAnneeScolaire']+1);?></h1>
		<div id="<?php echo "AS".$i; ?>" style="display: none">
		<?php
	
}
	$previous_AS = $uneEdition ['debutAnneeScolaire'];
	
	if ($previous_LibTheme !== $uneEdition['LibelleTheme']) {
		 
		if(! $premier_theme){
			echo "</div>";
		}
		$premier_theme=false;?>
				
<h1 class="themeButton" style="width: 90%;margin-left: auto"
	onclick="toggle_visibility('<?php echo $i; ?>');"><?php
		
if ($uneEdition ['LibelleTheme'] == null) {
			echo "Sans theme";
		} else {
			echo $uneEdition ['LibelleTheme'];
		}
		?></h1>
<div class="row flat" style="display: none; width: 90%;margin-left: auto" id="<?php echo $i; ?>">
				
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
                    	<?php echo form_open('ET_inscription_concours/moreInfos')?>
                    		<input type="hidden" name=NumEditionConcours
				value="<?php echo $uneEdition['NumEditionConcours'];?>" /> <input
				class="btn btn-danger btn-lg" type="submit" name="moreInfos"
				value="Plus d'infos" />
				</form>
			</li>
	
			<li class="plan-action">
                    	<?php echo form_open('etudiant/ET_inscription_concours/inscription')?>
                    		<input type="hidden" name=NumEditionConcours
				value="<?php echo $uneEdition['NumEditionConcours'];?>" /> <input
				class="btn btn-danger btn-lg" type="submit" name="inscription"
				value="M'inscrire" />
				</form>
			</li>

		</ul>
	</div>

		
		
	<?php $i++;} ?>
	
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