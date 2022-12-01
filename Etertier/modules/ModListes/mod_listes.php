<?php

class ModListes {
	
	public $affichage;

	public function __construct(){
		require_once "controleur_listes.php";
		$cont = new ControleurListes();

		switch($cont->get_action()){
			case "details": $cont->details();
				break;
			case "envoieComm": $cont->envoyer_commentaire("commentaire_liste"); 
				$cont->details();
				break;
			case "liker":{$cont->liker("listes");}
				break;
			case "disliker":{$cont->disliker("listes");}
				break;
			case "enleverLikeDislike":{$cont->enlever("listes");}
				break;
			case "likerCom":{$cont->liker_com("listes");}
				break;
			case "dislikerCom":{$cont->disliker_com("listes");}
				break;
			case "enleverLikeDislikeCom":{$cont->enlever_com("listes");}
				break;
			default: $cont->liste();
		}


		$this->affichage = $cont->vue->getAffichage();
	}
}
	
?>