

<div class="container">

        <h1 class="page-header">Concours</h1>
		<div class="row flat">
		
			<?php foreach($listConcours as $unConcours) { ?>
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
            <?php }?>

		</div>
</div>