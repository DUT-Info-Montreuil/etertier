<?php

class ModArticle{
	
	public $affichage;

	public function __construct(){
		
		require_once "controleur_article.php";
		$cont = new ControleurArticle();

		switch($cont->get_action()){
			
			case "details": $cont->details();
				break;
			case "envoieComm": $cont->envoyer_commentaire("commentaire_article"); 
				$cont->details();
				break;
			case "redaction": if(isset($_SESSION['login']) && isset($_SESSION['redacteur']) && $_SESSION['redacteur']==1){$cont->redaction();}else{$cont->erreur();}
				break;
			case "redige": if(isset($_SESSION['login']) && isset($_SESSION['redacteur']) && $_SESSION['redacteur']==1){$cont->redige();}else{$cont->erreur();}
				break;
			case "liker":{$cont->liker("articles");}
				break;
			case "disliker":{$cont->disliker("articles");}
				break;
			case "enleverLikeDislike":{$cont->enlever("articles");}
				break;
			case "likerCom":{$cont->liker_com("articles");}
				break;
			case "dislikerCom":{$cont->disliker_com("articles");}
				break;
			case "enleverLikeDislikeCom":{$cont->enlever_com("articles");}
				break;
			default: $cont->liste();

		}


		$this->affichage = $cont->vue->getAffichage();
	}
}
	
?>