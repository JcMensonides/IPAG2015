
<div class="container">

        <h1 class="page-header">Ajouter un concours</h1>
		<div class="row flat">
		
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Nouveau Concours
                    </li>
                    
                    <li class="plan-action">
                    <?php echo validation_errors(); ?>

					<?php echo form_open('Concours/ajoutConcours') ?>
						<li>
							<strong> Categorie du concours </strong> <br/>
							 <select>
							 		<option value="null"></option>
							 		<?php foreach($listCategories as $uneCategorie) { ?>
							 			<option value="<?php echo $uneCategorie['NumCategorie'];?>"><?php echo $uneCategorie['LibelleCategorie'];?></option>
							 		<?php }?>
							</select> 
						</li>
						<li>
							<strong> Theme du concours </strong> <br/>
							 <select>
							 		<option value="null"></option>
							 		<?php foreach($listThemes as $unTheme) { ?>
							 			<option value="<?php echo $unTheme['NumTheme'];?>"><?php echo $unTheme['LibelleTheme'];?></option>
							 		<?php }?>
							</select> 
						</li>		
					    	<strong><label for="nomConcours">Nom du concours a ajouter</label></strong>
    					</li>
    					<input type="input" name="nomConcours" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="ajout_concours" value="Ajouter" />
					</form>
                    </li>
                 
                    
                </ul>
            </div>

		</div>
</div>