<?php
	
	session_start();
	// if(isset($_POST['token'])) {
	// 	unset($_POST['token']);
	// 	echo 'Token supprimer';
	// }
	include_once('controleur.php');
    include_once('connexion.php');  

	$affichage;
    Connexion::initConnexion();

	$controleur = new Controleur();
	$controleur->exec();

	include_once('template.php');
?>