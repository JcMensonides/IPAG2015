

				<?php echo validation_errors(); ?>

				<?php echo form_open('Categories/ajoutCategorie') ?>		
					    <label for="nomCategorie">Nom de la categorie a ajouter : </label>
    					<input type="input" name="nomCategorie" /><br />
					    <input type="submit" name="ajout_categorie" value="Ajouter" />
				</form>
                
        </body>
</html>