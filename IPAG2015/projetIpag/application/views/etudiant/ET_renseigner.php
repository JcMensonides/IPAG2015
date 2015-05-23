<?php echo form_open('etudiant/ET_inscription_concours/updateInfos')?>
<div class="container">

	<h1 class="page-header">Renseigner mes resultats</h1>
	<div class="row flat">

		<div style="width: 100%" class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name"> <?php echo $infos['infos'][0]['LibelleConcours']?></li>

				<li class="plan-action">

				<li><strong> Dates d'inscriptions </strong> <br /> <br />
					Du <?php if($infos['infos'][0]['dateDebutInscriptionEditionConcours'] == null)
							echo "\"non renseigne\"";
							else echo $infos['infos'][0]['dateDebutInscriptionEditionConcours']; ?>
					 <br/>
					 Au <?php if($infos['infos'][0]['dateFinInscriptionEditionConcours'] == null)
								echo "\"non renseigne\"";
								else echo $infos['infos'][0]['dateFinInscriptionEditionConcours']; ?>
					 <br/>

				<li><strong> Date de resultats du concours(*) </strong> <br />
					<?php echo $infos['infos'][0]['dateResultatsEditionConcours'] ?>
				</li>


			</ul>
		</div>

		<?php if ($infos['infos'][0]['numQCM'] !== null){?>
		<input type="hidden" name="numQCM" value= <?php echo $infos['infos'][0]['numQCM'];?>>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">QCM</li>

				<li class="plan-action">
					<strong>Date du QCM</strong><br/>
					<?php if($infos['infos'][0]['dateQCM'] == null)
							echo "non renseigne";
							else echo $infos['infos'][0]['dateQCM']; ?>

				</li>
				<li>
					<strong> Date de resultat du QCM</strong><br/>
					<?php echo $infos['infos'][0]['dateResultatQCM'];?>
				</li>
				<li>
					<strong>Resultat du QCM</strong><br/>
					<select name = admisQCM>
							 		<option <?php if($infos['admisQCM'] == null || $infos['admisQCM'][0]['admisqcm']=='non renseigne') echo "selected=\"selected\"";?>>non renseigne</option>
							 		<option <?php if($infos['admisQCM'] != null && $infos['admisQCM'][0]['admisqcm']=='admis') echo "selected=\"selected\"";?>>admis</option>
							 		<option <?php if($infos['admisQCM'] != null && $infos['admisQCM'][0]['admisqcm']=='non admis') echo "selected=\"selected\"";?>>non admis</option>
							 		<option <?php if($infos['admisQCM'] != null && $infos['admisQCM'][0]['admisqcm']=='abandon') echo "selected=\"selected\"";?>>abandon</option>
					</select>
				</li>
				<li>
					<strong>Note au QCM</strong><br/>
					<select name = noteQCM>
									<option>non renseigne</option>
									<?php for($i=1; $i<=20; $i++){?>
										<option <?php if($infos['admisQCM'] !== null && $infos['admisQCM'][0]['noteQCM']==$i) echo "selected=\"selected\"";?>><?php echo $i;?></option>
								<?php }?>
					</select>
				</li>
			</ul>
		</div>
		<?php }?>
		
		<?php if ($infos['infos'][0]['numEpreuvesEcrites'] !== null){?>
		<input type="hidden" name="numEpreuvesEcrites" value= <?php echo $infos['infos'][0]['numEpreuvesEcrites'];?>>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves ecrites</li>

				<li class="plan-action">
					<strong>Dates des epreuves ecrites</strong><br/>
					Du <?php if($infos['infos'][0]['dateDebutEpreuvesEcrites'] == null)
							echo "\"non renseigne\"";
							else echo $infos['infos'][0]['dateDebutEpreuvesEcrites']; ?>
					 <br/>
					 Au <?php if($infos['infos'][0]['dateFinEpreuvesEcrites'] == null)
								echo "\"non renseigne\"";
								else echo $infos['infos'][0]['dateFinEpreuvesEcrites']; ?>
					 <br/>
				<li>
					<strong>Date de resultat des epreuves ecrites</strong><br/>
					<?php echo $infos['infos'][0]['dateResultatEpreuvesEcrites'];?>
				</li>
				<li>
					<strong>Resultat de l'epreuve</strong><br/>
					<select name = admisEpreuvesEcrites>
							 		<option <?php if($infos['admisEcrits'] == null || $infos['admisEcrits'][0]['admisEcrits']=='non renseigne') echo "selected=\"selected\"";?>>non renseigne</option>
							 		<option <?php if($infos['admisEcrits'] != null && $infos['admisEcrits'][0]['admisEcrits']=='admis') echo "selected=\"selected\"";?>>admis</option>
							 		<option <?php if($infos['admisEcrits'] != null && $infos['admisEcrits'][0]['admisEcrits']=='non admis') echo "selected=\"selected\"";?>>non admis</option>
							 		<option <?php if($infos['admisEcrits'] != null && $infos['admisEcrits'][0]['admisEcrits']=='abandon') echo "selected=\"selected\"";?>>abandon</option>
					</select>
				</li>
				<li>
					<strong>Notes aux matieres</strong><br/>
					<?php $i=1;
						foreach($infos['listMatieresEcrites'] as $uneMatiereEcrite){
						echo $uneMatiereEcrite['libelleMatiere'];?>
						<input type="hidden" value=<?php echo $uneMatiereEcrite['numMatiere'];?> name=ecrit<?php echo $i;?>>
						<select name=me<?php echo $i;?>>
							<option>non renseigne</option>
							<?php for($j=1; $j<=20; $j++){?>
										<option <?php if($uneMatiereEcrite['noteMatiere']==$j) echo "selected=\"selected\"";?>><?php echo $j;?></option>
								<?php }?>
						</select><br/>
							
							<?php $i++;}?>
				</li>
			</ul>
		</div>
		<?php }?>
		
		<?php if ($infos['infos'][0]['numEpreuvesOrales'] !== null){?>
		<input type="hidden" name="numEpreuvesOrales" value= <?php echo $infos['infos'][0]['numEpreuvesOrales'];?>>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves orales</li>

				<li class="plan-action">
					<strong>Dates des epreuves orales</strong><br/>
					Du <?php if($infos['infos'][0]['dateDebutEpreuvesOrales'] == null)
							echo "\"non renseigne\"";
							else echo $infos['infos'][0]['dateDebutEpreuvesOrales']; ?>
					 <br/>
					 Au <?php if($infos['infos'][0]['dateFinEpreuvesOrales'] == null)
								echo "\"non renseigne\"";
								else echo $infos['infos'][0]['dateFinEpreuvesOrales']; ?>
					 <br/>
				<li>
					<strong>Date de resultat des epreuves orales</strong><br/>
					<?php echo $infos['infos'][0]['dateResultatEpreuvesOrales'];?>
				</li>
				<li>
					<strong>Resultat de l'epreuve</strong><br/>
					<select name = admisEpreuvesOrales>
							 		<option <?php if($infos['admisOraux'] == null || $infos['admisOraux'][0]['admisOraux']=='non renseigne') echo "selected=\"selected\"";?>>non renseigne</option>
							 		<option <?php if($infos['admisOraux'] != null && $infos['admisOraux'][0]['admisOraux']=='admis') echo "selected=\"selected\"";?>>admis</option>
							 		<option <?php if($infos['admisOraux'] != null && $infos['admisOraux'][0]['admisOraux']=='non admis') echo "selected=\"selected\"";?>>non admis</option>
							 		<option <?php if($infos['admisOraux'] != null && $infos['admisOraux'][0]['admisOraux']=='abandon') echo "selected=\"selected\"";?>>abandon</option>
					</select>
				</li>
				<li>
					<strong>Notes aux matieres</strong><br/>
					<?php $i=1;
						foreach($infos['listMatieresOrales'] as $uneMatiereOrale){
						echo $uneMatiereOrale['libelleMatiere'];?>
						<input type="hidden" value=<?php echo $uneMatiereOrale['numMatiere'];?> name=oral<?php echo $i;?>>
						<select name=mo<?php echo $i;?>>
							<option>non renseigne</option>
							<?php for($j=1; $j<=20; $j++){?>
										<option <?php if($uneMatiereOrale['noteMatiere']==$j) echo "selected=\"selected\"";?>><?php echo $j;?></option>
								<?php }?>
						</select><br/>
							
							<?php $i++;}?>
				</li>
			</ul>
		</div>
		<?php }?>
		
		
		<?php if ($infos['infos'][0]['numTestsPhysiques'] !== null || $infos['infos'][0]['numTestsPsychoTechniques'] !== null){?>
		<div style="padding: 3px; width =: 24%"
			class="col-lg-3 col-md-3 col-xs-6">
			<ul class="plan plan1">
				<li class="plan-name">Epreuves Speciales</li>

				
				<?php if ($infos['infos'][0]['numTestsPhysiques'] !== null) {?>
				<input type="hidden" name="numTestsPhysiques" value= <?php echo $infos['infos'][0]['numTestsPhysiques'];?>>
				<li class="plan-name">Tests physiques</li>
				<li class="plan-action">
				<strong>Date du test physique</strong><br/>
				<?php if($infos['infos'][0]['dateTestsPhysiques'] == null)
							echo "\"non renseigne\"";
							else echo $infos['infos'][0]['dateTestsPhysiques'];?> <br/><br/>
					<strong>Date de resultat du test physique</strong><br/>
				<?php if($infos['infos'][0]['dateResultatsTestsPhysiques'] == null)
							echo "\"non renseigne\"";
							else echo $infos['infos'][0]['dateResultatsTestsPhysiques']; ?>
				
				<li>
					<strong>Resultat du test physique</strong><br/>
					<select name = admisTestsPhysiques>
							 		<option <?php if($infos['admisTestsPhysiques'] == null || $infos['admisTestsPhysiques'][0]['admisTestsPhysiques']=='non renseigne') echo "selected=\"selected\"";?>>non renseigne</option>
							 		<option <?php if($infos['admisTestsPhysiques'] != null && $infos['admisTestsPhysiques'][0]['admisTestsPhysiques']=='admis') echo "selected=\"selected\"";?>>admis</option>
							 		<option <?php if($infos['admisTestsPhysiques'] != null && $infos['admisTestsPhysiques'][0]['admisTestsPhysiques']=='non admis') echo "selected=\"selected\"";?>>non admis</option>
							 		<option <?php if($infos['admisTestsPhysiques'] != null && $infos['admisTestsPhysiques'][0]['admisTestsPhysiques']=='abandon') echo "selected=\"selected\"";?>>abandon</option>
					</select>
				</li>
					<?php }?>
				</li>
				
				<?php if ($infos['infos'][0]['numTestsPsychoTechniques'] !== null) {?>
				<input type="hidden" name="numTestsPsychoTechniques" value= <?php echo $infos['infos'][0]['numTestsPsychoTechniques'];?>>
				<li class="plan-name">Tests psychoTechniques</li>
				<li class="plan-action">
				<strong>Date du test psychoTechnique</strong><br/>
				<?php if($infos['infos'][0]['dateTestsPsychoTechniques'] == null)
							echo "\"non renseigne\"";
							else echo $infos['infos'][0]['dateTestsPsychoTechniques'];?> <br/><br/>
					<strong>Date de resultat du test psychoTechnique</strong><br/>
				<?php if($infos['infos'][0]['dateResultatPsychoTechniques'] == null)
							echo "\"non renseigne\"";
							else echo $infos['infos'][0]['dateResultatPsychoTechniques']; ?>
				<li>
					<strong>Resultat du test psychotechnique</strong><br/>
					<select name = admisTestsPsycho>
							 		<option <?php if($infos['admisTestsPsycho'] == null || $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='non renseigne') echo "selected=\"selected\"";?>>non renseigne</option>
							 		<option <?php if($infos['admisTestsPsycho'] != null && $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='admis') echo "selected=\"selected\"";?>>admis</option>
							 		<option <?php if($infos['admisTestsPsycho'] != null && $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='non admis') echo "selected=\"selected\"";?>>non admis</option>
							 		<option <?php if($infos['admisTestsPsycho'] != null && $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='abandon') echo "selected=\"selected\"";?>>abandon</option>
					</select>
				</li>
					<?php }?>
				</li>
			</ul>
		</div>
		<?php }?>

			
                    		<input type="hidden" name=NumEditionConcours
				value="<?php echo $infos['infos'][0]['numEditionConcours'];?>" /> <input style="width:100%"
				class="btn btn-danger btn-lg" type="submit" name="inscription"
				value="Confirmer mes resultats" />
				</form>

	</div>
	
</div>