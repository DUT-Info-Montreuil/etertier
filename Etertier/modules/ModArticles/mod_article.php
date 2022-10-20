<?php

class ModArticle{
	
	public $affichage;

	public function __construct(){
		require_once "controleur_article.php";
		$cont = new ControleurArticle();

		switch($cont->get_action()){
			case "details": $cont->details();
				break;
			case "redaction": $cont->redaction();
				break;
			case "redige": $cont->redige();
				break;
			default: $cont->liste();

		}


		$this->affichage = $cont->vue->getAffichage();
	}
}
	
?>