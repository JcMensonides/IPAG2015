<li>
					<strong>Resultat du TestsPhysiques</strong><br/>
					<select name = admisTestsPsycho>
							 		<option <?php if($infos['admisTestsPsycho'] == null || $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='non renseigne') echo "selected=\"selected\"";?>>non renseigne</option>
							 		<option <?php if($infos['admisTestsPsycho'] != null && $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='admis') echo "selected=\"selected\"";?>>admis</option>
							 		<option <?php if($infos['admisTestsPsycho'] != null && $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='non admis') echo "selected=\"selected\"";?>>non admis</option>
							 		<option <?php if($infos['admisTestsPsycho'] != null && $infos['admisTestsPsycho'][0]['admisTestsPsycho']=='abandon') echo "selected=\"selected\"";?>>abandon</option>
					</select>
				</li>