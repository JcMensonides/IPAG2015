

<div class="container">

        <h1 class="page-header">Modifier une catégorie</h1>
		<div class="row flat">
		
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Categorie a modifier
                    </li>
                    
                    <li class="plan-action">
                    	
                        	<strong>Nom actuel</strong> <br/> <?php echo $ancienNomCategorie;?>
                    	
                    

					<?php echo form_open('Categories/updateCategorie') ?>
						<li>		
					    	<strong><label for="nomCategorie">Nouveau nom</label></strong>
					    	<?php echo validation_errors(); ?>
    					</li>
    					<input type="hidden" name=NumCategorie value="<?php echo $NumCategorie;?>"/>
                    	<input type="hidden" name=ancienNomCategorie value="<?php echo $ancienNomCategorie;?>"/>
    					<input type="input" name="nomCategorie" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="update_categorie" value="Modifier" />
					</form>
                    </li>
                 
                    
                </ul>
            </div>

		</div>
</div>