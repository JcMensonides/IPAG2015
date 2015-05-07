
<div class="container">

        <h1 class="page-header">Ajouter une categorie</h1>
		<div class="row flat">
		
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Nouvelle Categorie
                    </li>
                    
                    <li class="plan-action">
                    <?php echo validation_errors(); ?>

					<?php echo form_open('Categories/ajoutCategorie') ?>
						<li>		
					    	<strong><label for="nomCategorie">Nom de la categorie a ajouter</label></strong>
    					</li>
    					<input type="input" name="nomCategorie" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="ajout_categorie" value="Ajouter" />
					</form>
                    </li>
                 
                    
                </ul>
            </div>

		</div>
</div>