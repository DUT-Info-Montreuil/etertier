<?php

class ControleurCreerJeux{

	public $vue;
	private $modele;
	private $action;

	public function __construct(){
		require_once "vue_creer_jeux.php";
		$this->vue = new VueCreerJeux();
		require_once "modele_creer_jeux.php";
		$this->modele = new ModeleCreerJeux();

		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
	}

	public function get_action() {
		return $this->action;
	}

	public function ajouter_jeu() {
		if(isset($_POST['nomNewJeu'])&& isset( $_POST['dateNewJeu']) && isset($_POST['descriNewJeu'])) {
			$this->modele->ajouterJeu();
		}
	}

	public function form_new_jeu() {
		$this->vue->form_ajout_jeu();
	}

}



?>