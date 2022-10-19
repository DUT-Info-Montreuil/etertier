<?php

class ModArticle{
	
	public $affichage;

	public function __construct(){
		require_once "controleur_article.php";
		$cont = new ControleurArticle();

		switch($cont->get_action()){
			case "details": $cont->details();
				break;
			default: $cont->liste();
		}


		$this->affichage = $cont->vue->getAffichage();
	}
}
	
?>