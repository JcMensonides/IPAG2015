

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
							<strong> Categorie du concours </strong> <br/>
							 <select name = numCategorie>
							 		<option <?php if ($ceConcoursCategorie[0]['NumCategorie'] == null) echo "selected = \"selected\"";?>></option>
							 		<?php foreach($listCategories as $uneCategorie) { ?>
							 			<option <?php if ($ceConcoursCategorie[0]['NumCategorie'] == $uneCategorie['NumCategorie']) { echo "selected = \"selected\"";}?> value="<?php echo $uneCategorie['NumCategorie'];?>"><?php echo $uneCategorie['LibelleCategorie'];?></option>
							 		<?php }?>
							</select> 
						</li>
						<li>
							<strong> Theme du concours </strong> <br/>
							 <select name = numTheme>
							 		<option <?php if ($ceConcoursTheme[0]['NumTheme'] == null) echo "selected = \"selected\"";?>></option>
							 		<?php foreach($listThemes as $unTheme) { ?>
							 			<option <?php if ($ceConcoursTheme[0]['NumTheme'] == $unTheme['NumTheme']) { echo "selected = \"selected\"";}?> value="<?php echo $unTheme['NumTheme'];?>"><?php echo $unTheme['LibelleTheme'];?></option>
							 		<?php }?>
							</select> 
						</li>
						<li>		
					    	<strong><label for="nomConcours">Nouveau nom</label></strong>
					    	<?php echo validation_errors(); ?>
    					</li>
    					<input type="hidden" name=NumConcours value="<?php echo $NumConcours;?>"/>
                    	<input type="hidden" name=ancienNomConcours value="<?php echo $ancienNomConcours;?>"/>
    					<input type="input" value = "<?php echo $ancienNomConcours;?>"  name="nomConcours" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="update_concours" value="Modifier" />
					</form>
                    </li>
           
                </ul>
            </div>

		</div>
</div>