<?php

class ModArticle{
	
	public $affichage;

	public function __construct(){
		require_once "controleur_article.php";
		$cont = new ControleurArticle();

		$cont->menu();

		switch($cont->get_action()){
			case "liste": $cont->liste();
				break;
			case "details": $cont->details();
				break;
			default: $cont->erreur();
		}


		$this->affichage = $cont->vue->getAffichage();
	}
}
	
?>