<?php


class ModConnexion{
	

	public $affichage;

	public function __construct(){
		require_once "controleur_connexion.php";
		$cont = new ControleurConnexion();

		if(isset($_GET['action'])){

			if(isset($_SESSION['login'])){
				if($_GET['action'] == "deconnexion"){$cont->deconnexion();}
				else{$cont->dejaConnecte();}
			}
			else{
			switch($_GET['action']){
				case "connexion": $cont->form_connexion();
					break;
				case "connecter": $cont->connecter();
					break;
				case "inscription": $cont->form_inscription();
					break;
				case "inscrire": $cont->inscrire();
					break;
				default: $cont->erreur();
			}
			}
		}
		else{
			$cont->erreur();
		}
		$this->affichage = $cont->vue->getAffichage();
	}
}
	


?>