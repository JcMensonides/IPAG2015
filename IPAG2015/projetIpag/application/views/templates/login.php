<html>
        <head>
                <title>Le Mastodonte</title>
        </head>
        <body>
				<?php echo validation_errors(); ?>

				<?php echo form_open('Home/seConnecterAdmin') ?>		
					    <input type="submit" name="submit" value="Se connecter en tant qu'admin" />
				</form>
				
				<?php echo form_open('Home/seConnecterEtudiant') ?>
					    <label for="numeroEtudiant">Numero etudiant : </label>
    					<input type="input" name="numeroEtudiant" /><br />
					    <input type="submit" name="submit" value="Se connecter en tant qu'etudiant" />
				</form>
                
        </body>
</html>