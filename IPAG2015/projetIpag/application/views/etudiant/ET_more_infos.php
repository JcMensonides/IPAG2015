<div class="container">

	<h1 class="page-header">Consulter un concours</h1>
	<div class="row flat">

		<div style="width: 100%" class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name"> <?php echo $infos[0]['LibelleConcours'];?></li>

				<li class="plan-action">

				<li><strong> Dates d'inscriptions </strong> <br /> <br />
					Du <?php if($infos[0]['dateDebutInscriptionEditionConcours'] == null)
							echo "\"non renseigne\"";
							else echo $infos[0]['dateDebutInscriptionEditionConcours']; ?>
					 <br/>
					 Au <?php if($infos[0]['dateFinInscriptionEditionConcours'] == null)
								echo "\"non renseigne\"";
								else echo $infos[0]['dateFinInscriptionEditionConcours']; ?>
					 <br/>

				<li><strong> Date de resultats du concours(*) </strong> <br />
					<?php echo $infos[0]['dateResultatsEditionConcours'] ?>
				</li>


			</ul>
		</div>

		<?php if ($infos[0]['numQCM'] !== null){?>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">QCM</li>

				<li class="plan-action">
					<strong>Date du QCM</strong><br/>
					<?php if($infos[0]['dateQCM'] == null)
							echo "non renseigne";
							else echo $infos[0]['dateQCM']; ?>

				</li>
				<li>
					<strong> Date de resultat du QCM</strong><br/>
					<?php echo $infos[0]['dateResultatQCM'];?>
				</li>
			</ul>
		</div>
		<?php }?>
		
		<?php if ($infos[0]['numEpreuvesEcrites'] !== null){?>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves ecrites</li>

				<li class="plan-action">
					<strong>Dates des epreuves ecrites</strong><br/>
					Du <?php if($infos[0]['dateDebutEpreuvesEcrites'] == null)
							echo "\"non renseigne\"";
							else echo $infos[0]['dateDebutEpreuvesEcrites']; ?>
					 <br/>
					 Au <?php if($infos[0]['dateFinEpreuvesEcrites'] == null)
								echo "\"non renseigne\"";
								else echo $infos[0]['dateFinEpreuvesEcrites']; ?>
					 <br/>
				<li>
					<strong>Date de resultat des epreuves ecrites</strong><br/>
					<?php echo $infos[0]['dateResultatEpreuvesEcrites'];?>
				</li>
			</ul>
		</div>
		<?php }?>
		
		<?php if ($infos[0]['numEpreuvesOrales'] !== null){?>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves orales</li>

				<li class="plan-action">
					<strong>Dates des epreuves orales</strong><br/>
					Du <?php if($infos[0]['dateDebutEpreuvesOrales'] == null)
							echo "\"non renseigne\"";
							else echo $infos[0]['dateDebutEpreuvesOrales']; ?>
					 <br/>
					 Au <?php if($infos[0]['dateFinEpreuvesOrales'] == null)
								echo "\"non renseigne\"";
								else echo $infos[0]['dateFinEpreuvesOrales']; ?>
					 <br/>
				<li>
					<strong>Date de resultat des epreuves orales</strong><br/>
					<?php echo $infos[0]['dateResultatEpreuvesOrales'];?>
				</li>
			</ul>
		</div>
		<?php }?>
		
		<?php if ($infos[0]['numTestsPhysiques'] !== null || $infos[0]['numTestsPsychoTechniques'] !== null){?>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves Speciales</li>

				
				<?php if ($infos[0]['numTestsPhysiques'] !== null) {?>
				<li class="plan-name">Tests physiques</li>
				<li class="plan-action">
				<strong>Date du test physique</strong><br/>
				<?php if($infos[0]['dateTestsPhysiques'] == null)
							echo "\"non renseigne\"";
							else echo $infos[0]['dateTestsPhysiques'];?> <br/><br/>
					<strong>Date de resultat du test physique</strong><br/>
				<?php if($infos[0]['dateResultatsTestsPhysiques'] == null)
							echo "\"non renseigne\"";
							else echo $infos[0]['dateResultatsTestsPhysiques']; ?>
				
					<?php }?>
				</li>
				
				<?php if ($infos[0]['numTestsPsychoTechniques'] !== null) {?>
				<li class="plan-name">Tests psychoTechniques</li>
				<li class="plan-action">
				<strong>Date du test psychoTechnique</strong><br/>
				<?php if($infos[0]['dateTestsPsychoTechniques'] == null)
							echo "\"non renseigne\"";
							else echo $infos[0]['dateTestsPsychoTechniques'];?> <br/><br/>
					<strong>Date de resultat du test psychoTechnique</strong><br/>
				<?php if($infos[0]['dateResultatPsychoTechniques'] == null)
							echo "\"non renseigne\"";
							else echo $infos[0]['dateResultatPsychoTechniques']; ?>
				
					<?php }?>
				</li>
			</ul>
		</div>
		<?php }?>
			
			<?php echo form_open('etudiant/ET_inscription_concours/inscription')?>
                    		<input type="hidden" name=NumEditionConcours
				value="<?php echo $infos[0]['numEditionConcours'];?>" /> <input style="width:100%"
				class="btn btn-danger btn-lg" type="submit" name="inscription"
				value="M'inscrire" />
				</form>

	</div>
	
</div>


