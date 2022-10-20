<?php

class ControleurListes{

	public $vue;
	private $modele;

	private $action;
	
	public function __construct(){
		require_once "vue_listes.php";
		$this->vue = new VueListes();
		require_once "modele_listes.php";
		$this->modele = new ModeleListes();

		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
	}

	public function liste(){
		$this->vue->afficher_liste($this->modele->get_liste());
	}

	public function details(){
		$this->vue->afficher_details($this->modele->get_details(), $this->modele->get_classement());
	}

	public function erreur(){
		$this->vue->afficher_erreur();
	}

	public function get_action(){
		return $this->action;
	}



}



?>