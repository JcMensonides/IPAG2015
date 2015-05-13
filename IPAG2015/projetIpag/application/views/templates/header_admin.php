<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?php echo base_url();?>/menu_style/styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>/menu_style/script.js"></script>
   <title>CSS MenuMaker</title>
   
   <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>
<body>

<div id='cssmenu'>
<ul>
   <li class='active has-sub'><a href='#'><span>Editions de concours</span></a>
      <ul>
         <li class='last'><a href='<?php echo base_url();?>index.php/EditionConcours'><span>Consulter les editions existantes</span></a>
         </li>
         <li class='last'><a href='<?php echo base_url();?>index.php/EditionConcours/ajoutEditionConcours'><span>Creer une nouvelle edition</span></a>
         </li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Concours</span></a>
      <ul>
         <li class='last'><a href='<?php echo base_url();?>index.php/Concours'><span>Consulter les concours existants</span></a></li>
         <li class='last'><a href='<?php echo base_url();?>index.php/Concours/ajoutConcours'><span>Creer un nouveau concours</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Themes de concours</span></a>
      <ul>
         <li class='last'><a href='<?php echo base_url();?>index.php/Themes'><span>Consulter les themes existants</span></a></li>
         <li class='last'><a href='<?php echo base_url();?>index.php/Themes/ajoutTheme'><span>Creer un nouveau theme</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Categories de concours</span></a>
      <ul>
         <li class='last'><a href='<?php echo base_url();?>index.php/Categories'><span>Consulter les categories existantes</span></a></li>
         <li class='last'><a href='<?php echo base_url();?>index.php/Categories/ajoutCategorie'><span>Creer une nouvelle categorie</span></a></li>
      </ul>
   </li>
   <li><a href='#'><span>Statistiques</span></a></li>
</ul>
</div>

