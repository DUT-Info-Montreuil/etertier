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
			case 'article':
				include_once('modules/ModArticles/mod_article.php');
				$module = new ModArticle();
				break;
			case 'jeuxListe';
			case 'jeux':
				include_once('modules/ModJeux/mod_jeux.php');
				$module = new ModJeux();
				break;
			case 'listes':
				include_once('modules/ModListes/mod_listes.php');
				$module = new ModListes();
				break;
			case 'pageuser':
				include_once('modules/ModUtilisateur/mod_utilisateur.php');
				$module = new ModUtilisateur();
				break;
			case 'creationListe':
				if(isset($_SESSION['login'])){
					include_once('modules/ModCreationListe/mod_creationListe.php');
					$module = new ModCreationListe();
				}
				else{
					include_once('modules/ModAccueil/mod_accueil.php');
					$module = new ModAccueil();
				}
				break;
			case 'creerjeu':
				if(isset($_SESSION['login']) && isset($_SESSION['redacteur']) && $_SESSION['redacteur']==1){
					include_once('modules/ModCreerJeux/mod_creer_jeux.php');
					$module = new ModCreerJeux();
				}
				else{
					include_once('modules/ModAccueil/mod_accueil.php');
					$module = new ModAccueil();
				}
				break;
			default:
				include_once('modules/ModAccueil/mod_accueil.php');
				$module = new ModAccueil();
		}
	}
	else{
		include_once('modules/ModAccueil/mod_accueil.php');
		$module = new ModAccueil();
	}


    require_once "composants/CompMenu/comp_menu.php";
    $menu = new CompMenu();
    


	include_once('template.php');
?>