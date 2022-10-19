<?php
	
	session_start();
	// if(isset($_POST['token'])) {
	// 	unset($_POST['token']);
	// 	echo 'Token supprimer';
	// }
    include_once('connexion.php');  
    Connexion::initConnexion();




	if(isset($_GET['module'])){
		switch($_GET['module']){	
			case 'connexion':
				include_once('modules/ModConnexion/mod_connexion.php');
				$module = new ModConnexion();
				break;
		}
	}


    require_once "composants/CompMenu/comp_menu.php";
    $menu = new CompMenu();
    


	include_once('template.php');
?>