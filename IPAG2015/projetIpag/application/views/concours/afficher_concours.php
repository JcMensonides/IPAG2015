
<?php $previous_LibTheme = false;
		$first_run = true;
		$i = 1;
		
	foreach ($listConcours as $unConcours){
		if($previous_LibTheme !== $unConcours['LibelleTheme']) { 
			if(!$first_run) { ?>
				</div>
				</div>
			<?php 
				}
				$first_run = false;?>
				
			<div class="container">		
						
				<h1 class="themeButton" onclick="toggle_visibility('<?php echo $i; ?>');"><?php if($unConcours['LibelleTheme'] == null) {
				echo "Sans theme";}
				else {
					echo $unConcours['LibelleTheme'];}?></h1>
				<div class="row flat" style = "display: none" id="<?php echo $i; ?>">
				<?php $previous_LibTheme = $unConcours['LibelleTheme'];
		 } ?>
		
		<div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        <?php echo $unConcours['LibelleConcours'] ?>
                    </li>
                    
                    <li class="plan-action">
                    	<?php echo form_open('Concours/modifierConcours') ?>
                    		<input type="hidden" name=NumConcours value="<?php echo $unConcours['NumConcours'];?>"/>
                    		<input type="hidden" name=ancienNomConcours value="<?php echo $unConcours['LibelleConcours'];?>"/>		
					    	<input class="btn btn-danger btn-lg" type="submit" name="modifierConcours" value="Modifier" />
						</form>
                    </li>
                    <li class="plan-action">
                    	<?php echo form_open('Concours/supprimerConcours') ?>
                    		<input type="hidden" name=NumConcours value="<?php echo $unConcours['NumConcours'];?>"/>		
					    	<input class="btn btn-danger btn-lg" type="submit" name="supprimerConcours" value="Supprimer" />
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
       
       




