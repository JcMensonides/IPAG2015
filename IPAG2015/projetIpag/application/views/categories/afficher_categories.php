

<div class="container">

        <h1 class="page-header">Categories</h1>
		<div class="row flat">
		
			<?php foreach($listCategories as $uneCategorie) { ?>
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        <?php echo $uneCategorie['LibelleCategorie'] ?>
                    </li>
                    
                    <li class="plan-action">
                    	<?php echo form_open('Categories/modifierCategorie') ?>
                    		<input type="hidden" name=NumCategorie value="<?php echo $uneCategorie['NumCategorie'];?>"/>
                    		<input type="hidden" name=ancienNomCategorie value="<?php echo $uneCategorie['LibelleCategorie'];?>"/>		
					    	<input class="btn btn-danger btn-lg" type="submit" name="modifierCategorie" value="Modifier" />
						</form>
                    </li>
                    <li class="plan-action">
                    	<?php echo form_open('Categories/supprimerCategorie') ?>
                    		<input type="hidden" name=NumCategorie value="<?php echo $uneCategorie['NumCategorie'];?>"/>		
					    	<input class="btn btn-danger btn-lg" type="submit" name="supprimerCategorie" value="Supprimer" />
						</form>
                    </li>
                    
                </ul>
            </div>
            <?php }?>

		</div>
</div>