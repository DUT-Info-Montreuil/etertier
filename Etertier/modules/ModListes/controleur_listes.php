<?php
require_once "modules/ModPageAvecCommentaires/controleur_pageAvecCommentaires.php";
class ControleurListes extends ControleurPageAvecCommentaires{

	private $action;
	
	public function __construct(){
		require_once "vue_listes.php";
		require_once "modele_listes.php";
		parent::__construct( new VueListes(),new ModeleListes());
		


		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
	}

	public function liste(){
		$this->vue->afficher_liste($this->modele->get_liste());
	}

	public function details(){
		$details = $this->modele->get_details();
		$this->vue->afficher_details($details, $this->modele->get_classement());
		if(isset($details)){
			$this->commentaires("commentaire_liste", "listes");
		}
	}

	public function erreur(){
		$this->vue->afficher_erreur();
	}

	public function get_action(){
		return $this->action;
	}



}



?>