

<div class="container">

        <h1 class="page-header">Themes</h1>
		<div class="row flat">
		
			<?php foreach($listThemes as $unTheme) { ?>
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        <?php echo $unTheme['LibelleTheme'] ?>
                    </li>
                    
                    <li class="plan-action">
                    	<?php echo form_open('Themes/modifierTheme') ?>
                    		<input type="hidden" name=NumTheme value="<?php echo $unTheme['NumTheme'];?>"/>
                    		<input type="hidden" name=ancienNomTheme value="<?php echo $unTheme['LibelleTheme'];?>"/>		
					    	<input class="btn btn-danger btn-lg" type="submit" name="modifierTheme" value="Modifier" />
						</form>
                    </li>
                    <li class="plan-action">
                    	<?php echo form_open('Themes/supprimerTheme') ?>
                    		<input type="hidden" name=NumTheme value="<?php echo $unTheme['NumTheme'];?>"/>		
					    	<input class="btn btn-danger btn-lg" type="submit" name="supprimerTheme" value="Supprimer" />
						</form>
                    </li>
                    
                </ul>
            </div>
            <?php }?>

		</div>
</div>