
<div class="container">

        <h1 class="page-header">Ajouter un theme</h1>
		<div class="row flat">
		
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Nouveau Theme
                    </li>
                    
                    <li class="plan-action">
                    <?php echo validation_errors(); ?>

					<?php echo form_open('Themes/ajoutTheme') ?>
						<li>		
					    	<strong><label for="nomTheme">Nom du theme a ajouter</label></strong>
    					</li>
    					<input type="input" name="nomTheme" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="ajout_theme" value="Ajouter" />
					</form>
                    </li>
                 
                    
                </ul>
            </div>

		</div>
</div>