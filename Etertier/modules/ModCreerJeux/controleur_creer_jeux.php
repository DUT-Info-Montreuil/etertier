<?php

class ControleurCreerJeux{

	public $vue;
	private $modele;

	public function __construct(){
		require_once "vue_creer_jeux.php";
		$this->vue = new VueCreerJeux();
		require_once "modele_creer_jeux.php";
		$this->modele = new ModeleCreerJeux();
	}

	public function ajouter_jeu() {
		$this->vue->form_ajout_jeu();
		$this->modele->ajouter_jeu();
	}

}



?>