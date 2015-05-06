<html>
        <head>
                <title>Le Mastodonte</title>
        </head>
        <body>
        
        		<?php echo "connecte en tant que : " .$this->session->userdata('numEtudiant'); ?>
				<?php echo validation_errors(); ?>

				<?php echo form_open('Home/seDeconnecter') ?>		
					    <input type="submit" name="submit" value="Se Deconnecter" />
				</form>
                
        </body>
</html>