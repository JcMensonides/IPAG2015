

<div class="container">

        <h1 class="page-header">Categories</h1>
		<div class="row flat">
		
			<?php foreach($listCategories as $uneCategorie) { ?>
            <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        <?php echo $uneCategorie['LibelleCategorie'] ?>
                    </li>
                    
                    <li class="plan-action">
                    <form id="<?php echo $uneCategorie['LibelleCategorie'];?>" method="post" action="#"> <input type="hidden" name="<?php echo $uneCategorie['LibelleCategorie'];?>"/> <a class="btn btn-danger btn-lg" href="#" onclick="document.<?php echo $uneCategorie['LibelleCategorie'];?>.submit();">Modifier </a> </form>
                    </li>
                    <li class="plan-action">
                    <form id="<?php echo $uneCategorie['LibelleCategorie'];?>" method="post" action="#"> <input type="hidden" name="<?php echo $uneCategorie['LibelleCategorie'];?>"/> <a class="btn btn-danger btn-lg" href="#" onclick="document.<?php echo $uneCategorie['LibelleCategorie'];?>.submit();">Supprimer </a> </form>
                    </li>
                    
                </ul>
            </div>
            <?php }?>

		</div>
</div>