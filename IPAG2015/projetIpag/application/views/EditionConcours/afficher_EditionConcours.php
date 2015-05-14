<?php
$previous_AS = false;
$previous_LibTheme = false;
$first_run = true;
$i = 1;

foreach ( $listEditionConcours as $uneEdition ) {
	
	if ($previous_AS !== $uneEdition ['debutAnneeScolaire']) {
		if (! $first_run) {
			?>
</div>
</div>
</div>


<?php
		}
		$first_run = false;
		$previous_LibTheme = false;
		$second_run = true;
		?>


<div class="container">
	<h1 class="themeButton" style="background-color: #841C1C"
		onclick="toggle_visibility('<?php echo "AS".$i; ?>');"><?php echo $uneEdition['debutAnneeScolaire'];?></h1>
		<div id="<?php echo "AS".$i; ?>" style="display: none">
		<?php
	
}
	$previous_AS = $uneEdition ['debutAnneeScolaire'];
	
	if ($previous_LibTheme !== $uneEdition['LibelleTheme']) {
		 
		if(! $second_run){
			echo "</div>";
		}
		$second_run=false;?>
				
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

			<li class="plan-action">
                    	<?php echo form_open('Concours/modifierConcours')?>
                    		<input type="hidden" name=NumConcours
				value="<?php echo $uneEdition['NumConcours'];?>" /> <input
				type="hidden" name=ancienNomConcours
				value="<?php echo $uneEdition['LibelleConcours'];?>" /> <input
				class="btn btn-danger btn-lg" type="submit" name="modifierConcours"
				value="Modifier" />
				</form>
			</li>
			<li class="plan-action">
                    	<?php echo form_open('Concours/supprimerConcours')?>
                    		<input type="hidden" name=NumConcours
				value="<?php echo $uneEdition['NumConcours'];?>" /> <input
				class="btn btn-danger btn-lg" type="submit" name="supprimerConcours"
				value="Supprimer" />
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