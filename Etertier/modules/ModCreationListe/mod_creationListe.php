<?php


class ModCreationListe{
	

	public $affichage;

	public function __construct(){
		require_once "controleur_creationListe.php";
		$cont = new ControleurCreationListe();
		
		switch($cont->get_action()){
			case "ajoutJeu": $cont->ajoutJeu();
				break;
			case "ajouter": $cont->ajouter();
				break;
			case "supprimerTout": $cont->supprimerTout();
				break;
			case "action": $cont->action();
				break;
			default: $cont->creationListe();
		}


		$this->affichage = $cont->vue->getAffichage();
	}
}
	


?>