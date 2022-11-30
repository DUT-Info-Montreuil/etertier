<?php
require_once "modules/ModPageAvecCommentaires/controleur_pageAvecCommentaires.php";

class ControleurArticle extends ControleurPageAvecCommentaires{
	
	private $action;
	
	public function __construct(){
		require_once "vue_article.php";
		require_once "modele_article.php";
		parent::__construct(new VueArticle(), new ModeleArticle());
	


		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
	}

	public function liste(){
		$this->vue->afficher_liste($this->modele->get_liste());
	}

	public function details(){
		$this->vue->afficher_details($this->modele->get_details());
		$this->commentaires("commentaire_article", "articles");
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
		//Si la création d'article a réussi, on est redirigé vers une autre page
		//donc l'appelle au message d'erreur ne s'effectue que si la création d'article n'a pas marché
		$this->erreur(); 
	}

}



?>