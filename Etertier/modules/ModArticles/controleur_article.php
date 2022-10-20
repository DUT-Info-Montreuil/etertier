<?php

class ControleurArticle{

	public $vue;
	private $modele;

	private $action;
	
	public function __construct(){
		require_once "vue_article.php";
		$this->vue = new VueArticle();
		require_once "modele_article.php";
		$this->modele = new ModeleArticle();

		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
	}

	public function liste(){
		$this->vue->afficher_liste($this->modele->get_liste());
	}

	public function details(){
		$this->vue->afficher_details($this->modele->get_details());
	}

	public function erreur(){
		$this->vue->afficher_erreur();
	}

	public function get_action(){
		return $this->action;
	}

	public function redaction() {
		$this->vue->form_redac();
	}

	public function redige() {
		$this->modele->redige();
	}

}



?>