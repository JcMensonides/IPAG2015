

<div class="container">

        <h1 class="page-header">Modifier un concours</h1>
		<div class="row flat">
		
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Concours a modifier
                    </li>
                    
                    <li class="plan-action">
                    	
                        	<strong>Nom actuel</strong> <br/> <?php echo $ancienNomConcours;?>
                    	
                    

					<?php echo form_open('Concours/updateConcours') ?>
						<li>		
					    	<strong><label for="nomConcours">Nouveau nom</label></strong>
					    	<?php echo validation_errors(); ?>
    					</li>
    					<input type="hidden" name=NumConcours value="<?php echo $NumConcours;?>"/>
                    	<input type="hidden" name=ancienNomConcours value="<?php echo $ancienNomConcours;?>"/>
    					<input type="input" name="nomConcours" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="update_concours" value="Modifier" />
					</form>
                    </li>
                 
                    
                </ul>
            </div>

		</div>
</div>