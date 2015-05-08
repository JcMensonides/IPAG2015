

<div class="container">

        <h1 class="page-header">Modifier un theme</h1>
		<div class="row flat">
		
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Theme a modifier
                    </li>
                    
                    <li class="plan-action">
                    	
                        	<strong>Nom actuel</strong> <br/> <?php echo $ancienNomTheme;?>
                    	
                    

					<?php echo form_open('Themes/updateTheme') ?>
						<li>		
					    	<strong><label for="nomTheme">Nouveau nom</label></strong>
					    	<?php echo validation_errors(); ?>
    					</li>
    					<input type="hidden" name=NumTheme value="<?php echo $NumTheme;?>"/>
                    	<input type="hidden" name=ancienNomTheme value="<?php echo $ancienNomTheme;?>"/>
    					<input type="input" name="nomTheme" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="update_theme" value="Modifier" />
					</form>
                    </li>
                 
                    
                </ul>
            </div>

		</div>
</div>