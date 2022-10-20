<?php

class ControleurConnexion{

	public $vue;
	private $modele;

	public function __construct(){
		require_once "vue_connexion.php";
		$this->vue = new VueConnexion();
		require_once "modele_connexion.php";
		$this->modele = new ModeleConnexion();

	}


	public function form_connexion(){
		$this->vue->form_connexion();
	}

	public function form_inscription(){
		$this->vue->form_inscription();
	}


	public function connecter(){
		$this->modele->connecter();
		$this->vue->resultat_connexion();
	}

	public function inscrire(){
		if($this->modele->verifInscription()){
			$this->vue->loginDejaPris();
		}
		else{
			$this->modele->inscrire();
			$this->vue->resultat_inscription();
		}
	}

	public function deconnexion(){
		unset($_SESSION['login']);
		unset($_SESSION['redacteur']);
		$this->vue->deconnexion();
	}

	public function dejaConnecte(){
		$this->vue->dejaConnecte();
	}

	public function erreur(){
		$this->vue->afficher_erreur();
	}


}



?>