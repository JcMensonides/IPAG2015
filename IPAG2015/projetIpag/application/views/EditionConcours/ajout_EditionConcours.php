
<div class="container">

        <h1 class="page-header">Ajouter une edition de concours</h1>
		<div class="row flat">
		
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Nouvelle edition
                    </li>
                    
                    <li class="plan-action">
                    <?php echo validation_errors(); ?>

					<?php echo form_open('EditionConcours/ajoutEditionConcours') ?>
						<li>
							<strong> Concours </strong> <br/>
							 <select name = numConcours>
							 		<?php $previous_libTheme = false;
							 		foreach($listConcours as $unConcours) { 
								 		if($unConcours['LibelleTheme'] !== $previous_libTheme) { ?>
								 			<optgroup label="<?php echo $unConcours['LibelleTheme'];?>">
								 			<?php $previous_libTheme = $unConcours['LibelleTheme'];
								 		}?>
							 			<option value="<?php echo $unConcours['NumConcours'];?>"><?php echo $unConcours['LibelleConcours'];?></option>
							 		<?php }?>
							</select> 
						</li>
						<li>
							<strong> Date de debut des inscriptions </strong> <br/>
							 <input type="date" name="dateDebutInscriptionEditionConcours">
						</li>
						<li>
							<strong> Date de fin des inscriptions(*) </strong> <br/>
							 <input type="date" name="dateFinInscriptionEditionConcours">
						</li>		
						<li>
							<strong> Date de resultat du concours(*) </strong> <br/>
							 <input type="date" name="dateResultatsEditionConcours">
						</li>
					    	<strong><label for="nomEditionConcours">Nom du concours a ajouter</label></strong>
    					</li>
    					<input type="input" name="nomEditionConcours" /><br />
					    <input class="btn btn-danger btn-lg" type="submit" name="ajout_concours" value="Ajouter" />
					</form>
                    </li>
                 
                    
                </ul>
            </div>

		</div>
</div>