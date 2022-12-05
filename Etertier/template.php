<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/all.css">
	<link rel="stylesheet" href="bootstrap/css/perso.css">


	<title>ETERTIER</title>
	
</head>
<body>
	<script src ="bootstrap/js/bootstrap.bundle.min.js"></script>
    <header>
		<?php echo $menu->affiche();?>


    </header>

    <main>
		<?php
			if(isset($module)){echo $module->affichage;}
		?>
	</main>

	<footer id ="footer">
		<br>
		<p>ETERTIER : Tous droits réservés.</p>
	</footer>	

</body>
</html>
