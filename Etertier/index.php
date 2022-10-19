<?php
	
	session_start();
	// if(isset($_POST['token'])) {
	// 	unset($_POST['token']);
	// 	echo 'Token supprimer';
	// }
    include_once('connexion.php');  

	$affichage;
    Connexion::initConnexion();

	if(isset($_GET['module'])){
		switch($_GET['module']){	
			case 'joueurs': 
				include_once('modules/mod_joueurs/mod_joueurs.php');
				$module = new ModJoueurs();
				break;
			case 'equipes': 
				include_once('modules/mod_equipes/mod_equipes.php');
				$module = new ModEquipe();
				break;
			case 'connexion':
				include_once('modules/mod_connexion/mod_connexion.php');
				$module = new ModConnexion();
				break;
		}
	}
	include_once('template.php');
?>